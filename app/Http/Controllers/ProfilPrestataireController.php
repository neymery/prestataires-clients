<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Categorie;
use App\Models\ProfilPrestataire;


class ProfilPrestataireController extends Controller
{
    public function edit()
    {
        $categories = Categorie::all();
        $profil = ProfilPrestataire::where('user_id', Auth::id())->first();

        return view('prestataire.profil', compact('categories', 'profil'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'bio' => 'nullable|string',
            'telephone' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
            'disponible' => 'required|boolean',
            'photo' => 'nullable|image|max:2048',
        ]);

        $profil = ProfilPrestataire::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'bio' => $request->bio,
                'telephone' => $request->telephone,
                'categorie_id' => $request->categorie_id,
                'disponible' => $request->disponible,
            ]
        );

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('prestataires', 'public');
            $profil->photo = $photoPath;
            $profil->save();
        }

        return redirect()->route('prestataire.profil.edit')->with('success', 'Profil mis à jour avec succès');
    }
}
