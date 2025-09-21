<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Booking;
use App\Models\ContactStore;
use App\Models\RoomListing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(){
        $roomListings = RoomListing::orderBy('id', 'desc')->get();
        return view('frontend.index', compact('roomListings'));
    }


    public function about(){
        return view('frontend.about');
    }

    public function contact(){
        return view('frontend.contact');
    }

    public function rooms(){
        $roomListings = RoomListing::orderBy('id', 'desc')->get();
        return view('frontend.rooms', compact('roomListings'));
    }

    public function roomDetails(RoomListing $roomListing){
        $relatedRooms = RoomListing::latest()->take(4)->get();
        return view('frontend.rooms_details', compact('roomListing', 'relatedRooms'));
    }


    public function checkAvailability(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after:start_date',
        ]);

        // Convert input dates from d-m-Y to Y-m-d for DB comparison
        $startDate = \Carbon\Carbon::createFromFormat('d-m-Y', $request->input('start_date'))->format('Y-m-d');
        $endDate   = \Carbon\Carbon::createFromFormat('d-m-Y', $request->input('end_date'))->format('Y-m-d');

        // Check if there is an existing booking with same check_in and check_out
        $exists = Booking::where('check_in', $startDate)
            ->where('check_out', $endDate)
            ->exists();

        if ($exists) {
            return back()->with('success', 'Rooms are available for the selected dates.');
        }

        return redirect()->route('rooms');
    }


    public function bookingStore(Request $request)
    {
        $isGuest = !Auth::check();

        $validator = Validator::make($request->all(), [
            'room_listing_id' => 'required|exists:room_listings,id',
            'check_in'        => 'required|date',
            'check_out'       => 'required|date|after:check_in',
            'adults'          => 'required|integer|min:1',
            'rooms'           => 'required|integer|min:1',
            'children'        => 'nullable|integer|min:0',
            'name'            => $isGuest ? 'required|string|max:255' : 'nullable|string|max:255',
            'email'           => 'nullable|email|max:255',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }

        try {
            $validatedData = $validator->validated();

            // Convert dates into Y-m-d format
            $checkIn  = \Carbon\Carbon::createFromFormat('d-m-Y', $validatedData['check_in'])->format('Y-m-d');
            $checkOut = \Carbon\Carbon::createFromFormat('d-m-Y', $validatedData['check_out'])->format('Y-m-d');

            // 🔍 Check if a booking already exists for this room and exact dates
            $exists = Booking::where('room_listing_id', $validatedData['room_listing_id'])
                ->where('check_in', $checkIn)
                ->where('check_out', $checkOut)
                ->exists();

            if ($exists) {
                return back()->with('error', 'Rooms are available for the selected dates.');
            }

            // Get or create user
            $user = Auth::user();
            if (!$user) {
                $email = $validatedData['email'] ?? 'guest_' . time() . '@riorelax.com';
                $user = User::firstOrCreate(
                    ['email' => $email],
                    [
                        'first_name' => $validatedData['name'],
                        'last_name'  => $validatedData['name'],
                        'password'   => bcrypt(Str::random(16)),
                    ]
                );
            }

            // Store booking data
            $bookingData = $validatedData;
            $bookingData['user_id']   = $user->id;
            $bookingData['check_in']  = $checkIn;
            $bookingData['check_out'] = $checkOut;

            $booking = new Booking();
            $booking->fill($bookingData);
            $booking->save();

            // Save booking ID in session for payment
            $request->session()->put('booking_id', $booking->id);

            return redirect()->route('dashboard.booking.payment.form');

        } catch (\Exception $exception) {
            Log::error('Error storing booking data: ' . $exception->getMessage());
            return back()->with('error', 'An error occurred while storing your booking data. Please try again later.');
        }
    }


    public function contactStore(Request $request){
        try {
            $data = ContactStore::create($request->all());
        // send mail to 
        Mail::to('info@yourdomain.com')->send(new ContactMail($data));
        return back()->with('success', 'Thank you for contacting us. We will get back to you soon.');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', 'An error occurred while . Please try again later.');
        }
    }


}
