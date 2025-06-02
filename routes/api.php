<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\PrestataireController;

Route::get('/test', [TestController::class, 'index']);

Route::middleware('auth:api')->group(function () {
    // Messages
    Route::resource('messages', MessageController::class, ['except' => ['create', 'edit']]);
    Route::get('conversations/{conversation}', [MessageController::class, 'show']);

    // Prestataires
    Route::get('prestataires', [PrestataireController::class, 'index']);
    Route::get('prestataires/{prestataire}', [PrestataireController::class, 'show']);
    Route::get('prestataires/search', [PrestataireController::class, 'search']);
});

// Routes publiques
Route::get('prestataires', [PrestataireController::class, 'index']);
Route::get('prestataires/{prestataire}', [PrestataireController::class, 'show']);
Route::get('prestataires/search', [PrestataireController::class, 'search']);
