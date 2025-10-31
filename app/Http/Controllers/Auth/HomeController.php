<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get user's recent bookings (limited to 5 for dashboard)
        $bookings = $user->bookings()
            ->with('roomListing')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Get discount code if exists
        $discountCode = $user->discountCode;
        
        // Get wallet points
        $walletPoints = $user->wallet_points ?? 0;
        
        return view('dash.index', compact('user', 'bookings', 'discountCode', 'walletPoints'));
    }

    /**
     * Display user's booking history page
     */
    public function bookingHistory()
    {
        $user = Auth::user();
        
        // Get all user's bookings with pagination
        $bookings = $user->bookings()
            ->with('roomListing')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        // Get discount code if exists
        $discountCode = $user->discountCode;
        
        // Get wallet points
        $walletPoints = $user->wallet_points ?? 0;
        
        // Calculate statistics
        $totalBookings = $user->bookings()->count();
        $completedBookings = $user->bookings()->where('status', 'checked-out')->count();
        $cancelledBookings = $user->bookings()->where('status', 'cancelled')->count();
        $totalSpent = $user->bookings()->where('payment_status', 'paid')->sum('total_amount');
        
        return view('dash.booking-history', compact(
            'user', 
            'bookings', 
            'discountCode', 
            'walletPoints',
            'totalBookings',
            'completedBookings',
            'cancelledBookings',
            'totalSpent'
        ));
    }


    public function profile(){
        $user = Auth::user();
        return view('dash.profile', ['user'=>$user]);
    }


    public function editProfile(Request $request, $id){
        $validated = Validator::make($request->all(), [
           'first_name' =>  ['required'],
            'last_name'=>  ['required'],
            'dob'=>  ['nullable'],
            'email'=>  ['nullable', 'email'],
            "state"=>  ['nullable'],
            "city"=>  ['nullable'],
            "address"=>  ['nullable'],
            "zip"=>  ['nullable'],
            "phone"=>  ['required', 'numeric'],
        ]);

        if ($validated->fails()) {
            return back()->with('error', $validated->errors()->first());
        }

        try{
          $user = User::findOrFail($id);
          $user->update($request->all());
          return back()->with('success', 'Profile updated successfully');
        }catch(Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong');
        }

        
    }


   public function changeProfilePicture(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'profile_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        if ($validated->fails()) {
            return back()->with('error', $validated->errors()->first());
        }

        try {
            $user = User::findOrFail($id);

            if ($request->hasFile('profile_image')) {
                $profile_image = $request->file('profile_image');
                $profile_image_name = time().'.'.$profile_image->getClientOriginalExtension();
                $profile_image->move(public_path('images/profile/'), $profile_image_name);

                $user->profile_image = $profile_image_name;
                $user->save();
            }

            // if you're using AJAX
            return response()->json([
                'success' => true,
                'profile_image' => asset('images/profile/'.$user->profile_image)
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }


    public function changePasswordView(){
        return view('dash.change-password');
    }

    public function changePassword(Request $request)
    {
        // Validate the request
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
            'new_password_confirmation' => 'required|string',
        ], [
            'current_password.required' => 'Current password is required.',
            'new_password.required' => 'New password is required.',
            'new_password.min' => 'New password must be at least 8 characters long.',
            'new_password.confirmed' => 'Password confirmation does not match.',
            'new_password_confirmation.required' => 'Password confirmation is required.',
        ]);

        try {
            // Get the authenticated user
            $user = Auth::user();
            
            // Check if the current password is correct
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Current password is incorrect.');
            }
            
            // Check if the new password is different from the current password
            if (Hash::check($request->new_password, $user->password)) {
                return back()->with('error', 'New password must be different from the current password.');
            }

            // Update the user's password
            $user->password = Hash::make($request->new_password);
            $user->save();
            

            // Redirect with success message
            return redirect()->back()->with('success', 'Password changed successfully!');
            
        } catch (Exception $e) {
            Log::error('Password change failed for user: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while changing your password. Please try again.');
        }
    }

    /**
     * Export user's booking history to CSV
     */
    public function exportBookings()
    {
        $user = Auth::user();
        
        // Get all user bookings
        $bookings = $user->bookings()->with('roomListing')->get();
        
        // Create CSV file name
        $fileName = 'booking_history_' . $user->id . '_' . date('Y-m-d_His') . '.csv';
        
        // Set headers for CSV download
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];
        
        // Create callback for streaming CSV
        $callback = function() use ($bookings) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, [
                'Booking ID',
                'Room Title',
                'Room Type',
                'Check In',
                'Check Out',
                'Number of Guests',
                'Number of Rooms',
                'Total Amount',
                'Discount Code Used',
                'Discount Amount',
                'Wallet Points Used',
                'Wallet Points Earned',
                'Payment Status',
                'Booking Status',
                'Created Date'
            ]);
            
            // Add booking data
            foreach ($bookings as $booking) {
                fputcsv($file, [
                    $booking->id,
                    $booking->roomListing->room_title ?? 'N/A',
                    $booking->roomListing->room_type ?? 'N/A',
                    $booking->check_in_date,
                    $booking->check_out_date,
                    $booking->number_of_guests,
                    $booking->number_of_rooms,
                    '₦' . number_format($booking->total_amount, 2),
                    $booking->discount_code_used ?? 'N/A',
                    $booking->discount_code_amount ? '₦' . number_format($booking->discount_code_amount, 2) : 'N/A',
                    $booking->wallet_points_used ? '₦' . number_format($booking->wallet_points_used, 2) : 'N/A',
                    $booking->wallet_points_earned ? '₦' . number_format($booking->wallet_points_earned, 2) : 'N/A',
                    ucfirst($booking->payment_status),
                    ucfirst($booking->status),
                    $booking->created_at->format('M d, Y H:i')
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

}
