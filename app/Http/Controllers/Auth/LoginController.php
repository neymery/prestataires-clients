<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
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
                return redirect()->route('client.home');
            } elseif ($user->role === 'prestataire') {
                return redirect()->route('prestataire.index');
            }

            return redirect('/home');
        }

        return redirect()->back()->withErrors(['email' => 'Email ou mot de passe invalide.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
