<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Categorie;
use Illuminate\Support\Facades\DB;


class ClientController extends Controller
{
    public function home()
    {
        $categories = Categorie::all();

        $prestataires = User::where('role', 'prestataire')
        ->with(['profilPrestataire.categorie', 'avisRecus.client'])
        ->get();
    

        return view('client.home', compact('categories', 'prestataires'));
    }
}
