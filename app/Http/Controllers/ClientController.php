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
            ->with([
                'profilPrestataire' => function($query) {
                    $query->with(['categorie', 'ville']);
                },
                'avisRecus.client'
            ])
            ->get();
    

        return view('client.home', compact('categories', 'prestataires'));
    }



    public function showPrestataire($id)
    {
        $prestataire = User::where('role', 'prestataire')
            ->with(['profilPrestataire.categorie', 'profilPrestataire.ville', 'avisRecus.client'])
            ->findOrFail($id);

        // Préparer les données pour l'affichage
        $data = [
            'id' => $prestataire->id,
            'name' => $prestataire->name,
            'photo' => $prestataire->profilPrestataire ? (
                $prestataire->profilPrestataire->photo 
                ? asset('storage/' . $prestataire->profilPrestataire->photo)
                : 'https://ui-avatars.com/api/?name=' . urlencode($prestataire->name) . '&background=random&size=200'
            ) : null,
            'categorie' => $prestataire->profilPrestataire ? $prestataire->profilPrestataire->categorie->nom : null,
            'ville' => $prestataire->profilPrestataire ? $prestataire->profilPrestataire->ville->nom : null,
            'telephone' => $prestataire->profilPrestataire ? $prestataire->profilPrestataire->telephone : null,
            'bio' => $prestataire->profilPrestataire ? $prestataire->profilPrestataire->bio : null,
            'disponible' => $prestataire->profilPrestataire ? $prestataire->profilPrestataire->disponible : false,
            'note_moyenne' => $prestataire->profilPrestataire ? number_format($prestataire->profilPrestataire->note_moyenne ?? 0, 1) : 0,
            'avis' => $prestataire->avisRecus ? $prestataire->avisRecus->map(function($avis) {
                return [
                    'client' => $avis->client->name,
                    'note' => $avis->note,
                    'commentaire' => $avis->commentaire,
                    'created_at' => $avis->created_at->format('d/m/Y')
                ];
            }) : collect([])
        ];

        return view('client.prestataire_show', compact('data'));
    }

    

}
