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
