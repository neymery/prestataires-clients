<?php

namespace App\Services;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;

class MessageService
{
    public function createConversation(User $sender, User $receiver)
    {
        return Conversation::create([
            'expediteur_id' => $sender->id,
            'destinataire_id' => $receiver->id,
        ]);
    }

    public function findOrCreateConversation(User $sender, User $receiver)
    {
        return Conversation::where(function ($query) use ($sender, $receiver) {
            $query->where('expediteur_id', $sender->id)
                ->where('destinataire_id', $receiver->id);
        })->orWhere(function ($query) use ($sender, $receiver) {
            $query->where('expediteur_id', $receiver->id)
                ->where('destinataire_id', $sender->id);
        })->first() ?? $this->createConversation($sender, $receiver);
    }

    public function createConversationIfNotExists(User $sender, User $receiver)
    {
        // Vérifier si une conversation existe déjà
        return Conversation::where(function($query) use ($sender, $receiver) {
            $query->where('expediteur_id', $sender->id)
                  ->where('destinataire_id', $receiver->id);
        })->orWhere(function($query) use ($sender, $receiver) {
            $query->where('expediteur_id', $receiver->id)
                  ->where('destinataire_id', $sender->id);
        })->first() ?? Conversation::create([
            'expediteur_id' => $sender->id,
            'destinataire_id' => $receiver->id
        ]);
    }

    public function sendMessage(User $sender, User $receiver, string $content, Conversation $conversation = null)
    {
        // Créer ou récupérer la conversation existante
        $conversation = $conversation ?? $this->createConversationIfNotExists($sender, $receiver);

        // Créer le message
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'expediteur_id' => $sender->id,
            'destinataire_id' => $receiver->id,
            'contenu' => $content,
            'lu' => false
        ]);

        // Mettre à jour le latest_message_id de la conversation
        $conversation->latest_message_id = $message->id;
        $conversation->save();

        return $message;
    }

    public function markAsRead(Conversation $conversation, User $user)
    {
        // Marquer les messages comme lus
        $messagesUpdated = $conversation->messages()
            ->where('destinataire_id', $user->id)
            ->where('lu', false)
            ->update(['lu' => true]);

        // Si des messages ont été marqués comme lus
        if ($messagesUpdated > 0) {
            // Mettre à jour le compteur de messages non lus
            $conversation->load('messages');
            $conversation->unread_count = $conversation->messages
                ->where('destinataire_id', $user->id)
                ->where('lu', false)
                ->count();
            $conversation->save();
        }

        return $conversation->latest_message;
    }

    public function getConversations(User $user)
    {
        return Conversation::where(function($query) use ($user) {
            $query->where('expediteur_id', $user->id)
                  ->orWhere('destinataire_id', $user->id);
        })
        ->with(['expediteur', 'destinataire', 'latest_message'])
        ->get()
        ->map(function($conversation) use ($user) {
            // Calculer le nombre de messages non lus
            $conversation->unread_count = Message::where('conversation_id', $conversation->id)
                ->where('destinataire_id', $user->id)
                ->where('lu', false)
                ->count();
            
            // Assurer que latest_message est chargé
            if (!$conversation->latest_message) {
                $conversation->load('latest_message');
            }
            
            return $conversation;
        });
    }
}
