<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    public function index(){
        // Registered users have a proper password and email not starting with 'guest_'
        $registeredUsers = User::where('email', 'not like', 'guest_%@%')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.customer.registered', compact('registeredUsers'));
    }

    public function guests(){
        // Guest users have email starting with 'guest_'
        $guestUsers = User::where('email', 'like', 'guest_%@%')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.customer.guests', compact('guestUsers'));
    }

    public function edit($id){
        $user = User::find($id);
        return view('admin.customer.edit',[
            'user' => $user
        ]);
    }

    public function update(Request $request,$id){
        try {
            $user = User::findOrFail($id);
            $user->update($request->all());
            Alert::success('Success', 'Customer updated successfully');
            return redirect()->route('admin.customer.index');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error','Something went wrong');
        }
    }

    public function delete($id){
        $user = User::findOrFail($id);
        $user->delete();
        Alert::success('Success','Customer Deleted Successfully');
        return redirect()->route('admin.customer.index');
    }
    
}
