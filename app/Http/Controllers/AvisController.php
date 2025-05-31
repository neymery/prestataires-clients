<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Avis;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AvisController extends Controller
{
    public function store(Request $request, $prestataireId)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        Avis::create([
            'client_id' => Auth::id(),
            'prestataire_id' => $prestataireId,
            'note' => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        return back()->with('success', 'Votre avis a été enregistré.');
    }
}
