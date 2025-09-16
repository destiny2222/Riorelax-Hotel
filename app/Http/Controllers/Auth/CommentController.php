<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\RoomListingComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'comment' => 'required|string',
            'room_id' => 'required|exists:room_listings,id',
            'star' => 'required|integer|min:1|max:5',
        ]);

        if ($validated->fails()) {
            return back()->with('error', $validated->errors()->first());
        }

        try {
            RoomListingComment::create([
                'user_id' => Auth::user()->id,
                'room_listing_id' => $request->room_id,
                'comment' => $request->comment,
                'rating' => $request->star,
            ]);

            return back()->with('success', 'Review submitted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while submitting your review.');
        }
    }
}
