<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingEditRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Admin;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'roomListing'])->orderBy('id', 'desc')->paginate(15);
        
        /** @var \App\Models\Admin $user */
        $user = Auth::guard('admin')->user();
        
        // Get pending edit requests count for supervisors and super admins
        $pendingEditRequestsCount = 0;
        if ($user->canApproveBookingEdits()) {
            $pendingEditRequestsCount = BookingEditRequest::where('status', 'pending')->count();
        }
        
        // Get rejected edit requests count for front desk
        $rejectedEditRequestsCount = 0;
        if ($user->isFrontDesk()) {
            $rejectedEditRequestsCount = BookingEditRequest::where('requested_by', $user->id)
                ->where('status', 'rejected')
                ->whereNull('acknowledged_at')
                ->count();
        }

        return view('admin.booking.list', [
            'bookings' => $bookings,
            'pendingEditRequestsCount' => $pendingEditRequestsCount,
            'rejectedEditRequestsCount' => $rejectedEditRequestsCount
        ]);
    }


    public function show($id)
    {
        $booking = Booking::with(['user', 'roomListing'])->findOrFail($id);
        
        // Get pending edit request if exists
        $pendingEditRequest = BookingEditRequest::with('requestedBy')
            ->where('booking_id', $id)
            ->where('status', 'pending')
            ->first();
        
        return view('admin.booking.show', [
            'booking' => $booking,
            'pendingEditRequest' => $pendingEditRequest
        ]);
    }


    public function edit($id)
    {
        $booking = Booking::with(['user', 'roomListing'])->findOrFail($id);
        
        // Check if there's already a pending edit request
        $hasPendingRequest = BookingEditRequest::where('booking_id', $id)
            ->where('status', 'pending')
            ->exists();
        
        if ($hasPendingRequest) {
            Alert::warning('Pending Request', 'This booking has a pending edit request awaiting approval.');
        }
        
        return view('admin.booking.edit', [
            'booking' => $booking,
            'hasPendingRequest' => $hasPendingRequest
        ]);
    }

    public function update(Request $request, $id)
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();
        $booking = Booking::findOrFail($id);

        try {
            // Validate the incoming data
            $validated = $request->validate([
                'adults' => 'required|integer|min:1',
                'children' => 'required|integer|min:0',
                'rooms' => 'required|integer|min:1',
                'assign' => 'nullable|boolean',
                'payment_status' => 'nullable|boolean',
                'arrival_time' => 'nullable|string',
                'payment_type' => 'nullable|string',
                'payment_reference' => 'nullable|string',
                'status' => 'required|in:pending,confirmed,checked-in,checked-out,cancelled',
                'paid_amount' => 'nullable|numeric|min:0',
                'due_amount' => 'nullable|numeric|min:0',
                'check_in_date' => 'nullable|date',
                'check_out_date' => 'nullable|date|after_or_equal:check_in_date',
            ]);

            // Fields that require approval (sensitive fields)
            $sensitiveFields = ['paid_amount', 'due_amount', 'check_in_date', 'check_out_date'];
            
            // Identify what changed
            $changedSensitiveFields = [];
            $changedNonSensitiveFields = [];
            $originalData = [];
            $requestedChanges = [];

            foreach ($validated as $field => $value) {
                if ($booking->$field != $value) {
                    $requestedChanges[$field] = $value;
                    $originalData[$field] = $booking->$field;
                    
                    if (in_array($field, $sensitiveFields)) {
                        $changedSensitiveFields[] = $field;
                    } else {
                        $changedNonSensitiveFields[$field] = $value;
                    }
                }
            }

            // If no changes, return
            if (empty($requestedChanges)) {
                Alert::info('No Changes', 'No changes were made to the booking.');
                return redirect()->route('admin.booking.index');
            }

            // If Front Desk is editing sensitive fields, create approval request
            if ($admin->isFrontDesk() && !empty($changedSensitiveFields)) {
                DB::beginTransaction();
                try {
                    // Update non-sensitive fields immediately
                    if (!empty($changedNonSensitiveFields)) {
                        $booking->update($changedNonSensitiveFields);
                    }

                    // Create edit request for sensitive fields
                    $sensitiveChanges = array_intersect_key($requestedChanges, array_flip($sensitiveFields));
                    $sensitiveOriginal = array_intersect_key($originalData, array_flip($sensitiveFields));

                    BookingEditRequest::create([
                        'booking_id' => $booking->id,
                        'requested_by' => $admin->id,
                        'original_data' => $sensitiveOriginal,
                        'requested_changes' => $sensitiveChanges,
                        'status' => 'pending',
                        'notes' => $request->input('edit_notes'),
                    ]);

                    DB::commit();
                    
                    Alert::success('Request Submitted', 'Your edit request for sensitive fields has been submitted for supervisor approval. Other changes have been saved.');
                    return redirect()->route('admin.booking.index');
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error('Failed to submit edit request: ' . $e->getMessage());
                    Alert::error('Error', 'Failed to submit edit request.');
                    return back()->withInput();
                }
            }

            // Super Admin and Supervisor can edit directly
            if ($admin->canDirectlyEditSensitiveFields()) {
                $booking->update($validated);
                
                Alert::success('Success', 'Booking updated successfully.');
                return redirect()->route('admin.booking.index');
            }

            // Front Desk editing only non-sensitive fields can update directly
            if ($admin->isFrontDesk() && empty($changedSensitiveFields)) {
                $booking->update($requestedChanges);
                
                Alert::success('Success', 'Booking updated successfully.');
                return redirect()->route('admin.booking.index');
            }

            Alert::error('Error', 'You do not have permission to make these changes.');
            return back();

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Alert::error('Error', 'Something went wrong: ' . $exception->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Show pending edit requests for approval
     */
    public function pendingEditRequests()
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();
        
        if (!$admin->canApproveBookingEdits()) {
            Alert::error('Access Denied', 'You do not have permission to approve edit requests.');
            return redirect()->route('admin.home');
        }

        $editRequests = BookingEditRequest::with(['booking.user', 'booking.roomListing', 'requestedBy'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(15);

        return view('admin.booking.pending-edits', compact('editRequests'));
    }

    /**
     * Approve an edit request
     */
    public function approveEditRequest($id)
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();
        
        if (!$admin->canApproveBookingEdits()) {
            Alert::error('Access Denied', 'You do not have permission to approve edit requests.');
            return redirect()->route('admin.home');
        }

        $editRequest = BookingEditRequest::with('booking')->findOrFail($id);

        if (!$editRequest->isPending()) {
            Alert::warning('Already Processed', 'This edit request has already been processed.');
            return back();
        }

        DB::beginTransaction();
        try {
            // Update the booking with requested changes
            $editRequest->booking->update($editRequest->requested_changes);

            // Mark edit request as approved
            $editRequest->update([
                'status' => 'approved',
                'approved_by' => $admin->id,
                'approved_at' => now(),
            ]);

            DB::commit();
            
            Alert::success('Approved', 'Edit request has been approved and changes applied.');
            return redirect()->route('admin.booking.pending-edits');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to approve edit request: ' . $e->getMessage());
            Alert::error('Error', 'Failed to approve edit request.');
            return back();
        }
    }

    /**
     * Reject an edit request
     */
    public function rejectEditRequest(Request $request, $id)
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();
        
        if (!$admin->canApproveBookingEdits()) {
            Alert::error('Access Denied', 'You do not have permission to reject edit requests.');
            return redirect()->route('admin.home');
        }

        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $editRequest = BookingEditRequest::findOrFail($id);

        if (!$editRequest->isPending()) {
            Alert::warning('Already Processed', 'This edit request has already been processed.');
            return back();
        }

        try {
            $editRequest->update([
                'status' => 'rejected',
                'approved_by' => $admin->id,
                'rejection_reason' => $request->rejection_reason,
                'approved_at' => now(),
            ]);

            Alert::success('Rejected', 'Edit request has been rejected.');
            return redirect()->route('admin.booking.pending-edits');
        } catch (\Exception $e) {
            Log::error('Failed to reject edit request: ' . $e->getMessage());
            Alert::error('Error', 'Failed to reject edit request.');
            return back();
        }
    }

    /**
     * Show acknowledged edit requests for supervisors
     */
    public function acknowledgedRequests()
    {
        $acknowledgedRequests = BookingEditRequest::with(['requestedBy', 'approvedBy'])
            ->where('status', 'rejected')
            ->whereNotNull('acknowledged_at')
            ->latest()
            ->paginate(15);

        return view('admin.booking.acknowledged-requests', compact('acknowledgedRequests'));
    }

    /**
     * Show rejected edit requests for the current front desk user
     */
    public function myRejectedRequests()
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        $rejectedRequests = BookingEditRequest::with(['booking.roomListing', 'approvedBy'])
            ->where('requested_by', $admin->id)
            ->where('status', 'rejected')
            ->whereNull('acknowledged_at')
            ->latest()
            ->paginate(15);

        return view('admin.booking.my-rejected-requests', compact('rejectedRequests'));
    }

    /**
     * Acknowledge a rejected edit request
     */
    public function acknowledgeEditRequest($id)
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        $editRequest = BookingEditRequest::where('id', $id)
            ->where('requested_by', $admin->id)
            ->where('status', 'rejected')
            ->firstOrFail();

        $editRequest->update(['acknowledged_at' => now()]);

        Alert::success('Acknowledged', 'The rejected request has been marked as acknowledged.');
        return redirect()->route('admin.booking.my-rejected-requests');
    }

    public function destroy($id)
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();
        
        if (!$admin->canDeleteBookings()) {
            Alert::error('Access Denied', 'You do not have permission to delete bookings.');
            return redirect()->route('admin.home');
        }

        try {
            $booking = Booking::findOrFail($id);
            $booking->delete();
            
            Alert::success('Deleted', 'Booking has been deleted successfully.');
            return redirect()->route('admin.booking.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Alert::error('Error', 'Failed to delete booking.');
            return back();
        }
    }
}
