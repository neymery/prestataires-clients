<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $messagesRecus = $user->messagesRecus()->with('expediteur')->latest()->get();
        $messagesEnvoyes = $user->messagesEnvoyes()->with('destinataire')->latest()->get();

        return view('messages.index', compact('messagesRecus', 'messagesEnvoyes'));
    }

    public function envoyer(Request $request, $destinataireId)
    {
        $request->validate([
            'contenu' => 'required|string|max:1000',
        ]);

        Message::create([
            'expediteur_id' => Auth::id(),
            'destinataire_id' => $destinataireId,
            'contenu' => $request->contenu,
        ]);

        return back()->with('success', 'Message envoyé.');
    }
}