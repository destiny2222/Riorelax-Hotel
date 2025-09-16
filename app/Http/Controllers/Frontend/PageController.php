<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RoomListing;
use Illuminate\Http\Request;

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
        $relatedRooms = RoomListing::where('room_type', $roomListing->category)->where('id', '!=', $roomListing->id)->get();
        return view('frontend.rooms_details', compact('roomListing'));
    }
}
