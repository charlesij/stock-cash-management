<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        $greeting = 'Welcome Back';
        return view('auth.login', [
            'greeting' => $greeting,
        ]);
    }

    public function authLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            if (auth()->user()->access_id == 3) {
                return redirect()->route('cashier.index');
            } else {
                return redirect()->route('dashboard.index');
            }
        }

        return redirect()->back()->withErrors(['username' => 'Invalid credentials']);
    }

    public function authLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
