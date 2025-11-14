<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'username' => 'required|username',
            'password' => 'required|string|min:6',
        ]);

        // Attempt to authenticate the user
        if (auth()->attempt($request->only('username', 'password'))) {
            // Authentication passed...
            return redirect()->intended('/dashboard');
        }

        // Authentication failed...
        return back()->withErrors([
            'username' => 'Username Yang Anda masukkan tidak valid.',
        ])->withInput();
    }
}
