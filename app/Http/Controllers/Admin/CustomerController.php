<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index(){
        $user = User::all();
        return view('admin.customer.index',[
            'users' => $user
        ]);
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
            return redirect()->route('admin.customer.index')->with('success','Customer updated successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->with('error','Something went wrong');
        }
    }

    public function delete($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.customer.index')->with('success','Customer Deleted Successfully');
    }
    
}
