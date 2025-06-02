<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'client') {
                return redirect()->route('client.dashboard');
            } elseif ($user->role === 'prestataire') {
                return redirect()->route('prestataire.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

