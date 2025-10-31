<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index(){
        $booking = Booking::orderBy('id', 'desc')->paginate(3);
        $booking_of_today = Booking::where('created_at', today())->count();
        // sum all total amount that the payment_status is 1
        $total_booking_amount = Booking::where('payment_status', 1)->sum('paid_amount');
        return view('admin.index', [
            'booking' => $booking,
            'booking_of_today' => $booking_of_today,
            'total_booking' => Booking::count(),
            'total_user'=> User::count(),
            'total_booking_amount' => $total_booking_amount
        ]);
    }


    public function scanCode(){
    // Only return the initial search step
    return view('admin.booking.scan', ['booking' => null, 'step' => 'search']);
}

public function scanCodeResult(Request $request)
{
    $request->validate([
        'phone' => 'required|string'
    ]);

    $phone = $request->phone;

    // Search for the latest booking using user's phone
    $booking = Booking::whereHas('user', function ($query) use ($phone) {
            $query->where('phone', $phone);
        })
        ->with(['user', 'roomListing']) // Eager load relationships
        ->orderBy('created_at', 'desc')
        ->first();

    if ($booking) {
        // Show QR code for scanning verification
        return view('admin.booking.scan', ['booking' => $booking, 'step' => 'qr_display']);
    } else {
        Alert::error('Error', 'No booking found for phone number: ' . $phone);
        return redirect()->back();
    }
}

public function verifyQRCode(Request $request)
{
    $qrData = $request->qr_data;
    
    // Find booking by QR data (assuming QR contains booking number)
    $booking = Booking::where('booking_number', $qrData)
        ->with(['user', 'roomListing'])
        ->first();

        // update the booking status to verified
    $booking->assign = 1;
    $booking->save();

    if ($booking) {
        return response()->json([
            'success' => true,
            'redirect_url' => route('admin.booking.verified', ['id' => $booking->id])
        ]);
    }


    return response()->json([
        'success' => false,
        'message' => 'Invalid QR code or booking not found'
    ]);
}

// Show verified booking details
public function showVerifiedBooking($id)
{
    $booking = Booking::with(['user', 'roomListing'])->findOrFail($id);
    return view('admin.booking.scan', ['booking' => $booking, 'step' => 'verified']);
}

}


