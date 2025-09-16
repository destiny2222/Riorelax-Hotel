<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

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
}
