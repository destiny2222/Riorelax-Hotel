<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function dashboard()
    {
        return view('dash.index');
    }


    public function profile(){
        $user = Auth::user();
        return view('dash.profile', ['user'=>$user]);
    }


    public function editProfile(Request $request, $id){
        $validated = Validator::make($request->all(), [
           'first_name' =>  ['required'],
            'last_name'=>  ['required'],
            'dob'=>  ['nullable'],
            'email'=>  ['nullable', 'email'],
            "state"=>  ['nullable'],
            "city"=>  ['nullable'],
            "address"=>  ['nullable'],
            "zip"=>  ['nullable'],
            "phone"=>  ['required', 'numeric'],
        ]);

        if ($validated->fails()) {
            return back()->with('error', $validated->errors()->first());
        }

        try{
          $user = User::findOrFail($id);
          $user->update($request->all());
          return back()->with('success', 'Profile updated successfully');
        }catch(Exception $e){
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong');
        }

        
    }


   public function changeProfilePicture(Request $request, $id)
    {
        $validated = Validator::make($request->all(), [
            'profile_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        if ($validated->fails()) {
            return back()->with('error', $validated->errors()->first());
        }

        try {
            $user = User::findOrFail($id);

            if ($request->hasFile('profile_image')) {
                $profile_image = $request->file('profile_image');
                $profile_image_name = time().'.'.$profile_image->getClientOriginalExtension();
                $profile_image->move(public_path('images/profile/'), $profile_image_name);

                $user->profile_image = $profile_image_name;
                $user->save();
            }

            // if you're using AJAX
            return response()->json([
                'success' => true,
                'profile_image' => asset('images/profile/'.$user->profile_image)
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }


    public function changePasswordView(){
        return view('dash.change-password');
    }

    public function changePassword(Request $request)
    {
        // Validate the request
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
            'new_password_confirmation' => 'required|string',
        ], [
            'current_password.required' => 'Current password is required.',
            'new_password.required' => 'New password is required.',
            'new_password.min' => 'New password must be at least 8 characters long.',
            'new_password.confirmed' => 'Password confirmation does not match.',
            'new_password_confirmation.required' => 'Password confirmation is required.',
        ]);

        try {
            // Get the authenticated user
            $user = Auth::user();
            
            // Check if the current password is correct
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Current password is incorrect.');
            }
            
            // Check if the new password is different from the current password
            if (Hash::check($request->new_password, $user->password)) {
                return back()->with('error', 'New password must be different from the current password.');
            }

            // Update the user's password
            $user->password = Hash::make($request->new_password);
            $user->save();
            

            // Redirect with success message
            return redirect()->back()->with('success', 'Password changed successfully!');
            
        } catch (Exception $e) {
            Log::error('Password change failed for user: ' , $e->getMessage());
            return back()->with('error', 'An error occurred while changing your password. Please try again.');
        }
    }

}
