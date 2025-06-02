<?php

namespace App\Policies;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConversationPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Conversation $conversation)
    {
        return $user->id === $conversation->expediteur_id || $user->id === $conversation->destinataire_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Conversation $conversation)
    {
        return $user->id === $conversation->expediteur_id || $user->id === $conversation->destinataire_id;
    }

    public function delete(User $user, Conversation $conversation)
    {
        return $user->id === $conversation->expediteur_id || $user->id === $conversation->destinataire_id;
    }

    public function before(User $user, $ability)
    {
        // Les administrateurs peuvent tout faire
        if ($user->hasRole('admin')) {
            return true;
        }
    }
}
