<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApiStatus
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si la requête est pour l'API
        if ($request->is('api/*')) {
            // Vérifier si la table personal_access_tokens existe
            try {
                \DB::table('personal_access_tokens')->first();
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'API non initialisée. Veuillez exécuter les migrations.',
                ], 500);
            }

            // Vérifier si les ressources sont disponibles
            if (!class_exists('App\Http\Resources\Api\MessageResource')) {
                return response()->json([
                    'error' => 'Ressources API manquantes.',
                ], 500);
            }
        }

        return $next($request);
    }
}
