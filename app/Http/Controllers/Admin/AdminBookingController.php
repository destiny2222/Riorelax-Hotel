<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\RoomListing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminBookingController extends Controller
{
    public function create()
    {
        $rooms = RoomListing::all();
        return view('admin.bookings.create', [
            'rooms' => $rooms,
        ]);
    }
  
    public function store(Request $request)
    {
        

        $validator = Validator::make($request->all(), [
            'room_id' => 'required|exists:room_listings,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'children' => 'nullable|integer',
            'adults' => 'nullable|integer',
            'rooms' => 'nullable|integer',
            'arrival_time' => 'nullable|string',
            'first_name' => 'nullable|string|max:255',
            'last_name'=> 'nullable|string|max:255',
            'phone'=> 'nullable|string|max:20',
            'country'=> 'nullable|string|max:100',
            'email' => 'nullable|email|max:255',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }

        try {
            $validatedData = $validator->validated();

            // Create a new user if email or phone is provided and doesn't exist and it exist already then update the user
            if (isset($validatedData['email']) || isset($validatedData['phone'])) {
                $user = User::updateOrCreate(
                    ['email' => $validatedData['email'], 'phone' => $validatedData['phone']],
                    [
                        'first_name' => $validatedData['first_name'],
                        'last_name' => $validatedData['last_name'],
                        'password' => bcrypt(Str::random(12)),
                    ]
                );
            } else {
                // Create a guest user
                $user = User::create(
                    [
                        'first_name' => $validatedData['first_name'] ?? 'Guest',
                        'last_name' => $validatedData['last_name'] ?? 'User',
                        'email' => $validatedData['email'] ?? 'guest_' . time() . '@riorelax.com',
                        'phone' => $validatedData['phone'] ?? null,
                        'country' => $validatedData['country'] ?? null,
                        'state' => $validatedData['state'] ?? null,
                        'city' => $validatedData['city'] ?? null,
                        'address' => $validatedData['address'] ?? null,
                        'zip_code' => $validatedData['zip_code'] ?? null,
                        'password' => bcrypt(Str::random(12)),
                    ]
                );
            }


            $bookingData = $validatedData;
            $bookingData['user_id'] = $user->id;
            $bookingData['room_listing_id'] = $request->room_id;

            // from roomlisting get the amount
            $roomListing = RoomListing::find($request->room_id);
            $bookingData['paid_amount'] = $roomListing->price;
            $bookingData['payment_type'] = 'admin_created';
            $bookingData['booking_number'] = 'BK' . date('YmdHis') . $request->id;


            // Convert date format from DD-MM-YYYY to YYYY-MM-DD
            if (isset($bookingData['check_in'])) {
                $bookingData['check_in'] = \Carbon\Carbon::createFromFormat('d-m-Y', $bookingData['check_in'])->format('Y-m-d');
            }
            if (isset($bookingData['check_out'])) {
                $bookingData['check_out'] = \Carbon\Carbon::createFromFormat('d-m-Y', $bookingData['check_out'])->format('Y-m-d');
            }
            // Create the booking
            $booking = new Booking();
            $booking->fill($bookingData);
            $booking->save();

            return redirect()->route('admin.booking.index')->with('success', 'Booking created successfully.');
        } catch (\Exception $exception) {
            Log::error('Error creating booking: ' . $exception->getMessage());
            return back()->with('error', 'An error occurred while creating the booking. Please try again.');
        }
    }
}
