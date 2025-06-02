<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Avis;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AvisController extends Controller
{
    public function create($prestataire_id)
    {
        $prestataire = User::findOrFail($prestataire_id);
        return view('avis.create', compact('prestataire'));
    }

    public function store(Request $request, $prestataire)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        Avis::create([
            'client_id' => Auth::id(),
            'prestataire_id' => $prestataire,
            'note' => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        return back()->with('success', 'Votre avis a été enregistré.');
    }
}
