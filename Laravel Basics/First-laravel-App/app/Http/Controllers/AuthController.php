<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        // Validate
        $validateFields = $request->validate([
            'username' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:3', 'confirmed'],
        ]);

        // Register
        $user = User::create($validateFields);


        // Login
        Auth::login($user);

        // Trigger event for login
        event(new Registered($user));

        // Redirect
        return redirect()->route('dashboard');
    }

    // Verify Email
    public function verifyNotice()
    {
        return view('auth.verify-email');
    }


    // Email Verification Handler
    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('dashboard');
    }

    // Resending Verification Email
    public function verifyHandler(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }


    // login
    public function login(Request $request)
    {
        // Validate
        $validateFields = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required'],
        ]);

        // try to login user
        if (Auth::attempt($validateFields, $request->remember)) {
            return redirect()->intended('/dashboard');
        } else {
            return back()->withErrors([
                'failed' => 'The provided credentials do not match our records.',
            ]);
        }
    }


    // logout user

    public function logout(Request $request)
    {

        // logout the user
        Auth::logout();

        // invalidate user's session
        $request->session()->invalidate();

        // Regenrate CSRF token
        $request->session()->regenerateToken();

        // Redirect to home
        return redirect('/');
    }
}
