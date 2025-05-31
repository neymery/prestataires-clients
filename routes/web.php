<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilPrestataireController;
use App\Http\Controllers\ProfilClientController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\MessageController;








Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/prestataire/profil', [ProfilPrestataireController::class, 'edit'])->name('prestataire.profil.edit');
    Route::post('/prestataire/profil', [ProfilPrestataireController::class, 'update'])->name('prestataire.profil.update');


    Route::get('/client/profil', [ProfilClientController::class, 'edit'])->name('client.profil.edit');
    Route::post('/client/profil', [ProfilClientController::class, 'update'])->name('client.profil.update');


    Route::get('/client/home', [ClientController::class, 'home'])->name('client.home');
});



Route::middleware(['auth'])->post('/avis/{prestataire}', [AvisController::class, 'store'])->name('avis.store');

Route::middleware('auth')->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/{destinataire}', [MessageController::class, 'envoyer'])->name('messages.envoyer');
    Route::get('/messages/create/{receiver_id}', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages/repondre', [MessageController::class, 'repondre'])->name('messages.repondre');

});


Route::post('/avis', [AvisController::class, 'store'])->name('avis.store')->middleware('auth');



Route::get('/prestataire/{id}', [ClientController::class, 'showPrestataire'])
    ->name('client.prestataire.show')
    ->middleware('auth');

 


Route::get('/client/dashboard', function () {
    return view('client.dashboard');
})->middleware(['auth'])->name('client.dashboard');

Route::get('/prestataire/dashboard', function () {
    return view('prestataire.dashboard');
})->middleware(['auth'])->name('prestataire.dashboard');




Route::get('/conversation/{user}', [MessageController::class, 'conversation'])->name('messages.conversation');
