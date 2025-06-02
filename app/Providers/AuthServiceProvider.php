<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\ConversationPolicy;
use App\Models\Conversation;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Conversation::class => ConversationPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // Définir d'autres portes si nécessaire
    }
}
