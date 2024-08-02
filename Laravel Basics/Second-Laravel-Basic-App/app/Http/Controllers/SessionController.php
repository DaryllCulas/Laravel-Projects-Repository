<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // validate
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        // attempt to login the user
        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials does not match our records.'
            ]);
        }

        // regenerate the session token
        $request->session()->regenerate();

        //redirect
        return redirect('/');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
