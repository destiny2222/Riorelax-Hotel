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
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Password as PasswordFacade;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

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
    public function postLogin(Request $request): RedirectResponse
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

        Alert::error('Login Failed', 'Invalid credentials provided');
        return redirect("login");
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
            'phone' => 'nullable|string|unique:users,phone',
            'password' => Password::min(6)->mixedCase()->numbers()->symbols(),
        ]);

        $data = $request->all();

        
        // check if the password and password_confirmation
        // fields match
        if ($data['password'] !== $data['password_confirmation']) {
            Alert::error('Passwords do not match');
            return back();
            // return redirect()->back()->withErrors(['password_confirmation' => 'Passwords do not match']);
        }

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        // = $this->create($data);

        // Check if user is in family and friends list and generate discount code
        $user->generateDiscountCodeIfEligible();

        Auth::login($user); 
        Alert::success('Registration Successful', 'Welcome aboard, ' . $user->first_name . '!');
        return redirect()->route('dashboard.home');
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

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = PasswordFacade::sendResetLink(
            $request->only('email')
        );

        if ($status === PasswordFacade::RESET_LINK_SENT) {
            Alert::success('Reset Link Sent', 'We have emailed your password reset link!');
            return back()->with(['status' => __($status)]);
        } else {
            Alert::error('Error', 'Unable to send reset link. Please try again.');
            return back()->withErrors(['email' => __($status)]);
        }
    }

    public function showResetPasswordForm(Request $request, $token = null)
    {
        return view('auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Password::min(6)->mixedCase()->numbers()->symbols()],
        ]);

        $status = PasswordFacade::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === PasswordFacade::PASSWORD_RESET) {
            Alert::success('Password Reset', 'Your password has been reset successfully!');
            return redirect()->route('login')->with('status', __($status));
        } else {
            Alert::error('Error', 'Unable to reset password. Please try again.');
            return back()->withErrors(['email' => [__($status)]]);
        }
    }

}
