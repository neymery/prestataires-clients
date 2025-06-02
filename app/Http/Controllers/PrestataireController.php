<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Avis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class PrestataireController extends Controller
{
    public function index()
    {
        $prestataires = User::where('role', 'prestataire')
            ->with(['profilPrestataire.categorie', 'avisRecus.client'])
            ->get();
            
        return view('prestataire.index', compact('prestataires'));
    }

    public function parCategorie($id)
    {
        $categorie = Categorie::findOrFail($id);
        $prestataires = User::where('role', 'prestataire')
            ->whereHas('profilPrestataire', function($query) use ($id) {
                $query->where('categorie_id', $id);
            })
            ->with(['profilPrestataire.categorie', 'avisRecus.client'])
            ->get();

        return view('prestataire.par_categorie', compact('categorie', 'prestataires'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $prestataires = User::where('role', 'prestataire')
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhereHas('profilPrestataire', function($q) use ($query) {
                        $q->where('ville', 'like', "%{$query}%");
                    });
            })
            ->with(['profilPrestataire.categorie', 'avisRecus.client'])
            ->get();

        $categories = Categorie::all();

        return view('client.home', compact('categories', 'prestataires'));
    }

    public function hasReviewed($prestataireId, $clientId)
    {
        $review = Avis::where('prestataire_id', $prestataireId)
            ->where('client_id', $clientId)
            ->first();
        
        return $review !== null;
    }

    public function show(User $prestataire)
    {
        $prestataire->load(['profilPrestataire.categorie', 'profilPrestataire.ville', 'avisRecus']);
        
        // Préparer les données pour l'affichage
        $data = [
            'id' => $prestataire->id,
            'name' => $prestataire->name,
            'photo' => $prestataire->profilPrestataire ? (
                $prestataire->profilPrestataire->photo 
                ? asset('storage/' . $prestataire->profilPrestataire->photo)
                : 'https://ui-avatars.com/api/?name=' . urlencode($prestataire->name) . '&background=random&size=200'
            ) : null,
            'categorie' => $prestataire->profilPrestataire && $prestataire->profilPrestataire->categorie ? $prestataire->profilPrestataire->categorie->nom : null,
            'ville' => $prestataire->profilPrestataire && $prestataire->profilPrestataire->ville ? $prestataire->profilPrestataire->ville->nom : null,
            'telephone' => $prestataire->profilPrestataire ? $prestataire->profilPrestataire->telephone : null,
            'bio' => $prestataire->profilPrestataire ? $prestataire->profilPrestataire->bio : null,
            'disponible' => $prestataire->profilPrestataire ? $prestataire->profilPrestataire->disponible : false,
            'note_moyenne' => $prestataire->profilPrestataire ? number_format($prestataire->profilPrestataire->note_moyenne ?? 0, 1) : 0,
            'avis' => $prestataire->avisRecus ? $prestataire->avisRecus->map(function($avis) {
                return [
                    'client' => $avis->client->name,
                    'client_id' => $avis->client_id,
                    'note' => $avis->note,
                    'commentaire' => $avis->commentaire,
                    'created_at' => $avis->created_at->format('d/m/Y')
                ];
            }) : collect([]),
            'has_reviewed' => Auth::check() && Auth::user()->role === 'client' ? $this->hasReviewed($prestataire->id, Auth::id()) : false
        ];

        return view('prestataire.show', compact('data'));
    }
}