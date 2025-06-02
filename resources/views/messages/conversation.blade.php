@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-comments"></i>
                        Conversation avec {{ $destinataire->name }}
                    </h4>
                    <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Retour aux conversations
                    </a>
                </div>
                <div class="card-body">
                    <div class="messages-container" style="max-height: 500px; overflow-y: auto; padding: 1rem;">
                        @forelse($messages as $msg)
                            <div class="message {{ $msg->expediteur_id == auth()->id() ? 'message-outgoing' : 'message-incoming' }}">
                                <div class="message-content">
                                    <div class="message-header">
                                        <span class="message-author">
                                            @if($msg->expediteur_id == auth()->id())
                                                <i class="fas fa-user"></i> Moi
                                            @else
                                                <i class="fas fa-user"></i> {{ $msg->expediteur->name }}
                                            @endif
                                        </span>
                                        <span class="message-time text-muted">
                                            {{ $msg->created_at->format('d/m/Y H:i') }}
                                        </span>
                                    </div>
                                    <div class="message-body">
                                        {{ $msg->contenu }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <i class="fas fa-envelope-open-text fa-3x text-muted"></i>
                                <p class="text-muted mt-2">Aucun message pour l'instant.</p>
                            </div>
                        @endforelse
                    </div>

                    <form action="{{ route('messages.repondre') }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                        <input type="hidden" name="destinataire_id" value="{{ $destinataire->id }}">
                        <div class="input-group">
                            <textarea name="contenu" class="form-control" placeholder="Votre message..." required></textarea>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Détails</h5>
                </div>
                <div class="card-body">
                    <div class="conversation-info">
                        <div class="participant-info">
                            <h6>Participant</h6>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user"></i>
                                <span class="ms-2">{{ $destinataire->name }}</span>
                            </div>
                        </div>
                        <div class="conversation-stats">
                            <h6>Statistiques</h6>
                            <div class="stats-item">
                                <i class="fas fa-clock"></i>
                                <span>Dernier message : 
                                    {{ $conversation->latest_message ? $conversation->latest_message->created_at->diffForHumans() : 'Aucun message envoyé' }}
                                </span>
                            </div>
                            @if($conversation->unread_count > 0)
                                <div class="stats-item">
                                    <i class="fas fa-envelope"></i>
                                    <span>{{ $conversation->unread_count }} message(s) non lu(s)</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Styles généraux */
    .container {
        padding: 2rem 1rem;
    }

    .card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .card-header {
        background: rgba(0, 0, 0, 0.2);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding: 1.25rem;
    }

    .card-header h4, .card-header h5 {
        color: white;
        font-weight: 600;
        margin: 0;
    }

    .card-header i {
        color: #fbbf24;
        margin-right: 0.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    /* Bouton de retour */
    .btn-outline-secondary {
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.1);
        border-radius: 0.75rem;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
        color: white;
    }

    /* Container des messages */
    .messages-container {
        background: rgba(0, 0, 0, 0.1);
        border-radius: 0.75rem;
        border: 1px solid rgba(255, 255, 255, 0.05);
        max-height: 500px;
        overflow-y: auto;
        padding: 1.5rem !important;
        margin-bottom: 1.5rem;
        scrollbar-width: thin;
        scrollbar-color: rgba(255, 255, 255, 0.2) rgba(0, 0, 0, 0.1);
    }

    .messages-container::-webkit-scrollbar {
        width: 6px;
    }

    .messages-container::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.1);
        border-radius: 3px;
    }

    .messages-container::-webkit-scrollbar-thumb {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 3px;
    }

    /* Messages */
    .message {
        margin-bottom: 1.5rem;
        padding: 0;
        border-radius: 1rem;
        max-width: 80%;
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .message-content {
        padding: 1rem;
    }

    .message-incoming {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
    }

    .message-outgoing {
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        color: #064e3b;
        margin-left: auto;
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.2);
    }

    .message-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .message-outgoing .message-header {
        border-bottom-color: rgba(0, 0, 0, 0.1);
    }

    .message-author {
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .message-author i {
        font-size: 0.9rem;
    }

    .message-time {
        font-size: 0.8rem;
        opacity: 0.8;
    }

    .message-outgoing .message-time {
        color: #064e3b;
    }

    .message-incoming .message-time {
        color: rgba(255, 255, 255, 0.7);
    }

    .message-body {
        padding: 0.5rem 0;
        line-height: 1.5;
    }

    /* Message vide */
    .text-center.py-4 {
        color: rgba(255, 255, 255, 0.6);
    }

    .text-center.py-4 i {
        color: rgba(255, 255, 255, 0.3);
        margin-bottom: 1rem;
    }

    .text-muted {
        color: rgba(255, 255, 255, 0.6) !important;
    }

    /* Formulaire de réponse */
    .input-group {
        display: flex;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    textarea.form-control {
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 0.75rem;
        color: white;
        padding: 1rem;
        min-height: 100px;
        resize: vertical;
        transition: all 0.3s ease;
    }

    textarea.form-control:focus {
        outline: none;
        border-color: #fbbf24;
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
    }

    textarea.form-control::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .btn-success {
        background: linear-gradient(45deg, #10b981, #059669);
        border: none;
        border-radius: 0.75rem;
        color: white;
        padding: 0.75rem 1.25rem;
        transition: all 0.3s ease;
        align-self: flex-end;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-success:hover {
        background: linear-gradient(45deg, #059669, #047857);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    /* Détails de la conversation */
    .conversation-info {
        padding: 0;
    }

    .participant-info, .conversation-stats {
        margin-bottom: 1.5rem;
    }

    .participant-info h6, .conversation-stats h6 {
        color: #fbbf24;
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .d-flex.align-items-center {
        display: flex;
        align-items: center;
        color: white;
    }

    .d-flex.align-items-center i {
        color: #fbbf24;
        margin-right: 0.75rem;
    }

    .stats-item {
        margin-bottom: 1rem;
        display: flex;
        align-items: flex-start;
        color: rgba(255, 255, 255, 0.8);
    }

    .stats-item i {
        color: #fbbf24;
        margin-right: 0.75rem;
        margin-top: 0.25rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }
        
        .message {
            max-width: 90%;
        }
        
        .input-group {
            flex-direction: column;
        }
        
        .btn-success {
            width: 100%;
            margin-top: 0.5rem;
        }
    }
</style>
@endpush
@endsection
