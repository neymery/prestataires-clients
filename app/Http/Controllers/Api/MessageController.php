<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\MessageResource;
use App\Http\Resources\Api\ConversationResource;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\User;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
        $this->middleware('auth:api');
    }

    public function index()
    {
        $user = Auth::user();
        $conversations = $this->messageService->getConversations($user);
        return ConversationResource::collection($conversations);
    }

    public function store(Request $request)
    {
        $request->validate([
            'destinataire_id' => 'required|exists:users,id',
            'contenu' => 'required|string|max:1000',
        ]);

        $destinataire = User::findOrFail($request->destinataire_id);
        $conversation = $this->messageService->createConversationIfNotExists(
            Auth::user(),
            $destinataire
        );

        $message = $this->messageService->sendMessage(
            Auth::user(),
            $destinataire,
            $request->contenu,
            $conversation
        );

        return new MessageResource($message);
    }

    public function show(Conversation $conversation)
    {
        $this->authorize('view', $conversation);
        $this->messageService->markAsRead($conversation, Auth::user());
        $messages = $conversation->messages()->with(['expediteur', 'destinataire'])->get();
        return MessageResource::collection($messages);
    }

    public function update(Request $request, Message $message)
    {
        $this->authorize('update', $message);
        $request->validate([
            'contenu' => 'required|string|max:1000',
        ]);

        $message->update([
            'contenu' => $request->contenu,
        ]);

        return new MessageResource($message);
    }

    public function destroy(Message $message)
    {
        $this->authorize('delete', $message);
        $message->delete();
        return response()->noContent();
    }
}
