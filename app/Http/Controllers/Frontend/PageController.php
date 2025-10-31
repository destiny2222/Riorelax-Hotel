<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
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
use RealRashid\SweetAlert\Facades\Alert;

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
            'check_in_date' => 'required|date',
            'check_out_date'   => 'required|date|after:check_in_date',
            'adults'     => 'sometimes|integer|min:1',
            'children'   => 'sometimes|integer|min:0',
            'rooms'      => 'sometimes|integer|min:1',
        ]);

        // Convert input dates from d-m-Y to Y-m-d for DB comparison
        $startDate = \Carbon\Carbon::createFromFormat('d-m-Y', $request->input('check_in_date'))->format('Y-m-d');
        $endDate   = \Carbon\Carbon::createFromFormat('d-m-Y', $request->input('check_out_date'))->format('Y-m-d');

        // Check if there is an existing booking with same check_in and check_out
        $exists = Booking::where('check_in_date', $startDate)
            ->where('check_out_date', $endDate)
            ->exists();

        // if ($exists) {
        //     Alert::error('Error', 'Rooms are not available for the selected dates. Please choose different dates.');
        //     return back();
        // }

        $availabilityData = $request->only(['check_in_date', 'check_out_date', 'adults', 'children', 'rooms']);
        session(['availability_data' => $availabilityData]);
        // Alert::success('Success', 'Rooms are available for the selected dates.');
        return redirect()->route('rooms');
    }



    public function contactStore(ContactRequest $request){
        try {
            $data = ContactStore::create($request->validated());
            // send mail to 
            Mail::to('info@house7.com.ng')->send(new ContactMail($data));
            
            Alert::success('Success', 'Thank you for contacting us. We will get back to you soon.');
            return back();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Alert::error('Error', 'An error occurred while processing your request. Please try again later.');
            return back();
        }
    }


    public function faq(){
        return view('frontend.faq');
    }


}
