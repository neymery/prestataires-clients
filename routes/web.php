<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilClientController;
use App\Http\Controllers\ProfilPrestataireController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PrestataireController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\MessageController;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// AUTHENTIFICATION
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// UTILISATEURS CONNECTÉS
Route::middleware(['auth'])->group(function () {
    // Dashboards
    Route::get('/client/home', [ClientController::class, 'home'])->name('client.dashboard');

    // Profils
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/client/profil', [ProfilClientController::class, 'edit'])->name('client.profil.edit');
    Route::post('/client/profil', [ProfilClientController::class, 'update'])->name('client.profil.update');

    Route::get('/prestataire/profil', [ProfilPrestataireController::class, 'edit'])->name('prestataire.profil.edit');
    Route::post('/prestataire/profil', [ProfilPrestataireController::class, 'update'])->name('prestataire.profil.update');

    // Pages clients / prestataires
    Route::get('/prestataire/index', [PrestataireController::class, 'index'])->name('prestataire.index');
    Route::get('/client/home', [ClientController::class, 'home'])->name('client.home');
    Route::get('/prestataires', [PrestataireController::class, 'index'])->name('prestataires.index');
    Route::get('/prestataires/categorie/{id}', [PrestataireController::class, 'parCategorie'])->name('prestataires.categorie');
    Route::get('/prestataires/search', [PrestataireController::class, 'search'])->name('prestataires.search');
    Route::get('/prestataire/{prestataire}', [PrestataireController::class, 'show'])->name('prestataire.show');
    Route::get('/prestataire/{id}', [ClientController::class, 'showPrestataire'])->name('client.prestataire.show');

    // Messages
    Route::resource('messages', MessageController::class);
    Route::get('/messages/create/{destinataire_id}', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages/repondre', [MessageController::class, 'repondre'])->name('messages.repondre');
    Route::get('/conversation/{conversation}', [MessageController::class, 'conversation'])->name('messages.conversation');

    // Avis
    Route::resource('avis', AvisController::class);
});
