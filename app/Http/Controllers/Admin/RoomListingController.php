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
use RealRashid\SweetAlert\Facades\Alert;

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
            Alert::success('Success', 'Room listing created successfully');
            return redirect(route('admin.roomListing.index'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Alert::error('Error', 'Something went wrong');
            return back();
        }
    }

    public function edit($id){
        $roomListing = RoomListing::findOrFail($id);
        return view('admin.roomListing.edit', compact('roomListing'));
    }

    public function update(UpdateRequest $request, $id)
    {
        /** @var \App\Models\Admin $admin */
        $admin = auth()->guard('admin')->user();
        $roomListing = RoomListing::findOrFail($id);
        $validatedData = $request->validated();

        try {
            // Supervisors can only change availability status
            if ($admin->hasAnyRole(['supervisor', 'super-admin'])) {
                // Check if trying to change any field other than availability_status
                $otherChanges = false;
                $fieldsToCheck = ['room_title', 'room_type', 'room_number', 'price', 'description'];
                
                foreach ($fieldsToCheck as $field) {
                    if (isset($validatedData[$field]) && $roomListing->$field != $validatedData[$field]) {
                        $otherChanges = true;
                        break;
                    }
                }
                
                // Also check if new images are being uploaded
                if (isset($validatedData['room_image']) || isset($validatedData['room_images'])) {
                    $otherChanges = true;
                }
                
                // If trying to change other fields, deny the request
                if ($otherChanges) {
                    Alert::error('Permission Denied', 'You are only allowed to update the availability status.');
                    return back()->withInput();
                }
                
                // Only allow updating availability_status
                if (isset($validatedData['availability_status']) && $roomListing->availability_status != $validatedData['availability_status']) {
                    $roomListing->availability_status = $validatedData['availability_status'];
                    $roomListing->save();
                    Alert::success('Success', 'Room availability updated successfully.');
                    return redirect()->route('admin.roomListing.index');
                }

                Alert::info('Permission Denied', 'You are only allowed to update the availability status.');
                return redirect()->route('admin.roomListing.index');
            }

            if (isset($validatedData['room_image'])) {
                $result = $this->uploadImageToCloudinary($validatedData['room_image'], 'hotel/upload/room_listing_image');
                $validatedData['room_image'] = $result['secure_url'];
            }

            if (isset($validatedData['room_images'])) {
                $imagesData = [];
                foreach ($validatedData['room_images'] as $image) {
                    $multipleResult = $this->uploadImageToCloudinary($image, 'hotel/upload/room_listing_images');
                    $imagesData[] = $multipleResult['secure_url'];
                }
                $validatedData['room_images'] = $imagesData;
            }

            if (isset($validatedData['room_title'])) {
                $validatedData['slug'] = Str::slug($validatedData['room_title']);
            }
            
            $roomListing->update($validatedData);

            Alert::success('Success', 'Room Listing updated successfully.');
            return redirect()->route('admin.roomListing.index');

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Alert::error('Error', 'Something went wrong: ' . $exception->getMessage());
            return back();
        }
    }

    public function destroy($id){
        try {
            $roomListing = RoomListing::findOrFail($id);
            $roomListing->delete();
            Alert::success('Success', 'Room listing deleted successfully');
            return redirect(route('admin.roomListing.index'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            Alert::error('Error', 'Something went wrong');
            return back();
        }
    }
}
