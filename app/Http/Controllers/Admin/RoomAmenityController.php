<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomAmenities;
use App\Models\RoomListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class RoomAmenityController extends Controller
{
     public function index()
    {
        $amenities = RoomAmenities::orderBy('id', 'desc')->get();
        return view('admin.amenties.index', compact('amenities'));
    }

    public function create()
    {
        $rooms = RoomListing::all();
        return view('admin.amenties.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_listing_id' => 'required|exists:rooms,id',
            'icon' => 'required|image|mimes:png,jpg,jpeg',
            'title' => 'required|string|max:255',
        ]);



        try {
            if ($request->hasFile('icon')) {
                $icon = $request->file('icon');
                $iconName = time() . '.' . $icon->getClientOriginalExtension();
                $icon->move(public_path('uploads/amenities'), $iconName);
            }

            RoomAmenities::create([
                'room_listing_id' => $request->room_listing_id,
                'icon' => $iconName,
                'title' => $request->title,
            ]);

            Alert::success('Success', 'Room amenity created successfully');
            return redirect()->route('admin.amenities.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Alert::error('Error', 'Failed to create room amenity');
            return back();
        }
    }



    public function edit($id)
    {
        $amenity = RoomAmenities::findOrFail($id);
        $rooms = RoomListing::all();
        return view('admin.amenties.edit', compact('amenity', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string',
            'room_id' => 'required|exists:rooms,id'
        ]);

        try {
            $roomAmenity = RoomAmenities::findOrFail($id);
            $roomAmenity->update($validated);
            Alert::success('Success', 'Room amenity updated successfully');
            return redirect()->route('admin.amenities.index');
        } catch (\Exception $exception) {
           Log::error('Error deleting room amenity: ' . $exception->getMessage());
           Alert::error('Error', 'Failed to delete room amenity');
           return back();
        }
    }

    public function destroy($id)
    {
        try{
            $roomAmenity = RoomAmenities::findOrFail($id);
            $roomAmenity->delete();
            Alert::success('Success', 'Room amenity deleted successfully');
            return redirect()->route('admin.amenities.index');
        }catch (\Exception $e) {
            Log::error('Error deleting room amenity: ' . $e->getMessage());
            Alert::error('Error', 'Failed to delete room amenity');
            return back();
        }
    }
}
