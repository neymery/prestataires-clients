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

    public function create($receiver_id)
    {
        $receiver = User::findOrFail($receiver_id);
        return view('messages.create', compact('receiver'));
    }




    public function repondre(Request $request)
    {
        $request->validate([
            'destinataire_id' => 'required|exists:users,id',
            'contenu' => 'required|string|max:1000',
        ]);

        Message::create([
            'expediteur_id' => auth()->id(),
            'destinataire_id' => $request->destinataire_id,
            'contenu' => $request->contenu,
        ]);

        return redirect()->back()->with('success', 'Message envoyé avec succès.');
    }



    public function conversation(User $user)
    {
        $messages = Message::where(function ($query) use ($user) {
            $query->where('expediteur_id', auth()->id())
                ->where('destinataire_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('expediteur_id', $user->id)
                ->where('destinataire_id', auth()->id());
        })->orderBy('created_at', 'asc')->get();

        return view('messages.conversation', [
            'messages' => $messages,
            'destinataire' => $user
        ]);
    }
}