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
        $latestRoom = RoomListing::orderBy('id', 'desc')->first();
        return view('frontend.index', compact('roomListings', 'latestRoom'));
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
        $availabilityData = session('availability_data');
        return view('frontend.rooms_details', compact('roomListing', 'relatedRooms', 'availabilityData'));
    }


    public function checkAvailability(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after:start_date',
            'adults'     => 'sometimes|integer|min:1',
            'children'   => 'sometimes|integer|min:0',
            'rooms'      => 'sometimes|integer|min:1',
        ]);

        // Convert input dates from d-m-Y to Y-m-d for DB comparison
        $startDate = \Carbon\Carbon::createFromFormat('d-m-Y', $request->input('start_date'))->format('Y-m-d');
        $endDate   = \Carbon\Carbon::createFromFormat('d-m-Y', $request->input('end_date'))->format('Y-m-d');

        // Check if there is an existing booking with same check_in and check_out
        $exists = Booking::where('check_in', $startDate)
            ->where('check_out', $endDate)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Rooms are not available for the selected dates. Please choose different dates');
        }

        $availabilityData = $request->only(['start_date', 'end_date', 'adults', 'children', 'rooms']);
        session(['availability_data' => $availabilityData]);

        return redirect()->route('rooms')->with('success', 'Rooms are available for the selected dates.');
    }



    public function contactStore(Request $request){
        try {
            $data = ContactStore::create($request->all());
        // send mail to 
        Mail::to('info@house7.com.ng')->send(new ContactMail($data));
        return back()->with('success', 'Thank you for contacting us. We will get back to you soon.');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', 'An error occurred while . Please try again later.');
        }
    }


}
