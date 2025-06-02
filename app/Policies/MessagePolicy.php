<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Message $message)
    {
        return $user->id === $message->expediteur_id || $user->id === $message->destinataire_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Message $message)
    {
        return $user->id === $message->expediteur_id;
    }

    public function delete(User $user, Message $message)
    {
        return $user->id === $message->expediteur_id || $user->id === $message->destinataire_id;
    }

    public function conversation(User $user, Conversation $conversation)
    {
        return $user->id === $conversation->expediteur_id || $user->id === $conversation->destinataire_id;
    }
}
