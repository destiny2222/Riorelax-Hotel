<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
        return view('admin.booking.list', [
            'bookings'=> $bookings
        ]);
    }


    public function show($id){
        $booking = Booking::find($id);
        return view('admin.booking.show', [
            'booking'=> $booking
        ]);
    }


    public function edit($id){
        $booking = Booking::find($id);
        return view('admin.booking.edit', [
            'booking'=> $booking
        ]);
    }

    public function update(Request $request, $id){
        try {
            $booking = Booking::findOrFail($id);
            $booking->update($request->all());
            return redirect()->route('admin.booking.index')->with('success', 'Booking updated successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }

    public function destroy($id){
        try {
            $booking = Booking::findOrFail($id);
            $booking->delete();
            return redirect()->route('admin.booking.index')->with('success', 'Booking deleted successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }
}
