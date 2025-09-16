<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.home');
        }
        return view('auth.login');
    }  

    public function registration()
    {
        return view('auth.registration');
    }

     /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard/overview')
                        ->withSuccess('You have Successfully login');
        }

        return redirect("login")->withError('Oppes! You have entered invalid credentials');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request): RedirectResponse
    {  
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => Password::min(6)->mixedCase()->numbers()->symbols(),
        ]);

        $data = $request->all();

        
        // check if the password and password_confirmation
        // fields match
        if ($data['password'] !== $data['password_confirmation']) {
            return back()->with('error', 'Passwords do not match');
            // return redirect()->back()->withErrors(['password_confirmation' => 'Passwords do not match']);
        }

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        // = $this->create($data);

        Auth::login($user); 
        return redirect()->route('dashboard.home')->with('success', 'Great! You have Successfully registered');
        // return redirect("dashboard")->with('success', 'Great! You have Successfully registered');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }

    public function  forgotPassword(){
        return view('auth.forgot-password');
    }

    public function  resetPassword(Request $request){
        return view('auth.reset-password');
    }

}
