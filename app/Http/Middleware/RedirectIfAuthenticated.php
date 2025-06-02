<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class RedirectIfAuthenticatedWithRole
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'client') {
                return redirect()->route('client.dashboard');
            } elseif (Auth::user()->role === 'prestataire') {
                return redirect()->route('prestataire.dashboard');
            }
        }

        return $next($request);
    }
}
