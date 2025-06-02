<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Categorie;
use App\Models\ProfilPrestataire;
use App\Models\User;
use App\Models\Ville;

class ProfilPrestataireController extends Controller
{
    public function index(Request $request)
    {
        $disponible = $request->query('disponible');

        $query = User::where('role', 'prestataire')
            ->with(['profilPrestataire', 'avisRecus']);

        if ($disponible) {
            $query->whereHas('profilPrestataire', function ($q) {
                $q->where('disponible', true);
            });
        }

        $prestataires = $query->get();

        return view('prestataires.index', compact('prestataires', 'disponible'));
    }




    public function edit()
    {
        $categories = Categorie::all();
        $villes = Ville::all();
        $profil = ProfilPrestataire::where('user_id', Auth::id())->first();

        return view('prestataire.profil', compact('categories', 'villes', 'profil'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'bio' => 'nullable|string',
            'telephone' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
            'ville_id' => 'nullable|exists:villes,id',
            'disponible' => 'required|boolean',
            'photo' => 'nullable|image|max:2048',
        ]);

        $profil = ProfilPrestataire::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'bio' => $request->bio,
                'telephone' => $request->telephone,
                'categorie_id' => $request->categorie_id,
                'ville_id' => $request->ville_id,
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

    public function parCategorie($id)
    {
        $categorie = Categorie::findOrFail($id);
        
        $prestataires = User::where('role', 'prestataire')
            ->with(['profilPrestataire' => function($query) use ($id) {
                $query->where('categorie_id', $id);
            }, 'avisRecus'])
            ->get();

        // Calculer la note moyenne pour chaque prestataire
        $prestataires->each(function($prestataire) {
            if ($prestataire->avisRecus->count() > 0) {
                $prestataire->note_moyenne = $prestataire->avisRecus->avg('note');
            } else {
                $prestataire->note_moyenne = 0;
            }
        });

        return view('prestataires.index', compact('prestataires', 'categorie'));
    }
}
