<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoomListing\StoreRequest;
use App\Http\Requests\Admin\RoomListing\UpdateRequest;
use App\Models\RoomListing;
use Illuminate\Http\Request;
use App\Traits\CloudinaryUploadTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RoomListingController extends Controller
{
    use CloudinaryUploadTrait;

    public function index(){
        $roomListings = RoomListing::all();
        return view('admin.roomListing.index', compact('roomListings'));
    }

    public function create(){
        return view('admin.roomListing.create');
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        try {
            $result = $this->uploadImageToCloudinary($data['room_image'], 'hotel/upload/room_listing_image');
            // uploading multiple images
            $imagesData = [];
            if (isset($data['room_images'])) {
                $images = $data['room_images'];
                foreach ($images as $image) {
                    $multipleResult = $this->uploadImageToCloudinary($image, 'hotel/upload/room_listing_images');
                    $imagesData[] = $multipleResult['secure_url'];
                }
            }
            $data['room_image'] = $result['secure_url'];
            $data['room_images'] = $imagesData;
            $data['slug'] = Str::slug($data['room_title']);
            // dd($data);
            RoomListing::create($data);
            return redirect(route('admin.roomListing.index'))->with('success', 'Room listing created successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }

    public function edit($id){
        $roomListing = RoomListing::findOrFail($id);
        return view('admin.roomListing.edit', compact('roomListing'));
    }

    public function update(UpdateRequest $request, $id){
        $data = $request->validated();
        try {
            if (isset($data['room_image'])) {
                $result = $this->uploadImageToCloudinary($data['room_image'], 'hotel/upload/room_listing_image');
                $data['room_image'] = $result['secure_url'];
            }

            if (isset($data['room_images'])) {
                $imagesData = [];
                foreach ($data['room_images'] as $image) {
                    $multipleResult = $this->uploadImageToCloudinary($image, 'hotel/upload/room_listing_images');
                    $imagesData[] = $multipleResult['secure_url'];
                }
                $data['room_images'] = $imagesData;
            }

            $data['slug'] = Str::slug($data['room_title']);
            $roomListing = RoomListing::findOrFail($id);
            $roomListing->update($data);
            return redirect(route('admin.roomListing.index'))->with('success', 'Room listing updated successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }

    public function destroy($id){
        try {
            $roomListing = RoomListing::findOrFail($id);
            $roomListing->delete();
            return redirect(route('admin.roomListing.index'))->with('success', 'Room listing deleted successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }
}
