<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\User;
use App\Services\MessageService;
use App\Policies\ConversationPolicy;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function index()
    {
        $user = Auth::user();
        
        // Récupérer les conversations de l'utilisateur
        $conversations = $this->messageService->getConversations($user);

        // Pour chaque conversation, récupérer le dernier message via la relation
        $conversations->each(function ($conversation) {
            $conversation->load('latest_message');
        });

        return view('messages.index', compact('conversations'));
    }

    public function store(Request $request)
    {
        // Valider les données
        $request->validate([
            'destinataire_id' => 'required|exists:users,id',
            'contenu' => 'required|string|max:1000',
        ]);

        // Récupérer le destinataire
        $destinataire = User::findOrFail($request->destinataire_id);

        // Créer une nouvelle conversation si nécessaire
        $conversation = $this->messageService->createConversationIfNotExists(
            Auth::user(),
            $destinataire
        );

        // Envoyer le message
        $this->messageService->sendMessage(
            Auth::user(),
            $destinataire,
            $request->contenu,
            $conversation
        );

        // Rediriger vers la conversation
        return redirect()->route('messages.conversation', ['conversation' => $conversation->id])
            ->with('success', 'Message envoyé avec succès.');
    }

    public function create($destinataire_id)
    {
        $destinataire = User::findOrFail($destinataire_id);
        return view('messages.create', compact('destinataire'));
    }

    public function repondre(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'destinataire_id' => 'required|exists:users,id',
            'conversation_id' => 'required|exists:conversations,id',
            'contenu' => 'required|string|max:1000',
        ]);

        // Récupérer la conversation et le destinataire
        $conversation = Conversation::findOrFail($request->conversation_id);
        $receiver = User::findOrFail($request->destinataire_id);

        // Vérifier l'accès à la conversation
        $this->authorize('update', $conversation);

        // Envoyer le message
        $this->messageService->sendMessage(Auth::user(), $receiver, $request->contenu);
        
        // Rediriger vers la conversation
        return redirect()->route('messages.conversation', ['conversation' => $conversation->id])
            ->with('success', 'Message envoyé avec succès.');
    }

    public function conversation(Conversation $conversation)
    {
        // Vérifier l'accès à la conversation
        $this->authorize('view', $conversation);

        // Marquer les messages comme lus
        $this->messageService->markAsRead($conversation, Auth::user());

        // Récupérer les messages de la conversation
        $messages = $conversation->messages()
            ->with(['expediteur', 'destinataire'])
            ->orderBy('created_at', 'asc')
            ->get();

        // Déterminer l'autre utilisateur dans la conversation
        $currentUserId = Auth::id();
        $destinataire = $conversation->expediteur_id == $currentUserId 
            ? $conversation->destinataire 
            : $conversation->expediteur;

        return view('messages.conversation', [
            'messages' => $messages,
            'conversation' => $conversation,
            'destinataire' => $destinataire
        ]);
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        
        // Vérifier que l'utilisateur est l'expéditeur
        if ($message->expediteur_id != auth()->id()) {
            abort(403, 'Accès non autorisé');
        }

        $message->delete();
        return redirect()->back()->with('success', 'Message supprimé avec succès.');
    }

    public function update(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        
        // Vérifier que l'utilisateur est l'expéditeur
        if ($message->expediteur_id != auth()->id()) {
            abort(403, 'Accès non autorisé');
        }

        $message->update($request->all());
        return redirect()->back()->with('success', 'Message modifié avec succès.');
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);
        return view('messages.show', compact('message'));
    }

    public function edit($id)
    {
        $message = Message::findOrFail($id);
        return view('messages.edit', compact('message'));
    }


    
}