<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LimitLoginAttempts
{
    protected $maxAttempts = 5;
    protected $decayMinutes = 1;

    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('post') && $request->routeIs('login.submit')) {
            $email = $request->input('email');
            
            if ($this->hasTooManyLoginAttempts($email)) {
                return response()->json([
                    'error' => 'Trop de tentatives de connexion. Veuillez réessayer plus tard.'
                ], 429);
            }
        }

        return $next($request);
    }

    protected function hasTooManyLoginAttempts($email)
    {
        $key = 'login_attempts_' . md5($email);
        
        if (Cache::has($key)) {
            $attempts = Cache::get($key);
            
            if ($attempts >= $this->maxAttempts) {
                return true;
            }
        }
        
        return false;
    }

    protected function incrementLoginAttempts($email)
    {
        $key = 'login_attempts_' . md5($email);
        
        if (Cache::has($key)) {
            Cache::increment($key);
        } else {
            Cache::put($key, 1, now()->addMinutes($this->decayMinutes));
        }
    }

    protected function clearLoginAttempts($email)
    {
        $key = 'login_attempts_' . md5($email);
        Cache::forget($key);
    }
}
