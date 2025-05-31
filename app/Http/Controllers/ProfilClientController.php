<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilClient;
use Illuminate\Support\Facades\Auth;

class ProfilClientController extends Controller
{
    public function edit()
    {
        $profil = ProfilClient::where('user_id', Auth::id())->first();
        return view('client.profil', compact('profil'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:2048',
        ]);


        $profil = ProfilClient::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'nom' => $request->nom,
                'telephone' => $request->telephone,
                'disponible' => $request->input('disponible', 1),
                
            ]
        );

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('clients', 'public');
            $profil->photo = $photoPath;
            $profil->save();
        }

        return redirect()->route('client.profil.edit')->with('success', 'Profil client mis à jour');
    }
}


















// <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Profil;
// use App\Models\Categorie;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Storage;

// class ProfilController extends Controller
// {
//     public function showForm()
//     {
//         $user = Auth::user();
//         $profil = $user->profil; // Relation user -> profil
//         $categories = Categorie::all();

//         return view('prestataire.profil', compact('profil', 'categories'));
//     }

//     public function update(Request $request)
//     {
//         $user = Auth::user();

//         $validated = $request->validate([
//             'bio' => 'nullable|string',
//             'telephone' => 'nullable|string|max:20',
//             'categorie_id' => 'required|exists:categories,id',
//             'photo' => 'nullable|image|max:2048',
//             'disponible' => 'required|in:1,0'
//         ]);

//         // Récupérer ou créer le profil lié
//         $profil = $user->profil ?? new Profil(['user_id' => $user->id]);

//         $profil->bio = $validated['bio'] ?? '';
//         $profil->telephone = $validated['telephone'] ?? '';
//         $profil->categorie_id = $validated['categorie_id'];
//         $profil->disponible = $validated['disponible'];

//         // Gestion de la photo
//         if ($request->hasFile('photo')) {
//             if ($profil->photo) {
//                 Storage::delete('public/' . $profil->photo); // Supprime l'ancienne photo
//             }
//             $path = $request->file('photo')->store('photos', 'public');
//             $profil->photo = $path;
//         }

//         $profil->save();

//         return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
//     }
// }
