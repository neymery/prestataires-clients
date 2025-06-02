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
    .messages-container {
        background: #f8f9fa;
        border-radius: 8px;
    }

    .message {
        margin-bottom: 1rem;
        padding: 1rem;
        border-radius: 10px;
        max-width: 80%;
    }

    .message-incoming {
        background: #fff;
        border: 1px solid #dee2e6;
    }

    .message-outgoing {
        background: #007bff;
        color: white;
        margin-left: auto;
    }

    .message-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .message-author {
        font-weight: 600;
    }

    .message-time {
        font-size: 0.8rem;
    }

    .message-body {
        padding: 0.5rem;
        border-radius: 5px;
    }

    .conversation-info {
        padding: 1rem;
    }

    .participant-info, .conversation-stats {
        margin-bottom: 1.5rem;
    }

    .stats-item {
        margin-bottom: 1rem;
    }

    .stats-item i {
        margin-right: 0.5rem;
    }

    textarea {
        min-height: 100px;
        resize: vertical;
    }

    .input-group {
        gap: 0.5rem;
    }
</style>
@endpush
@endsection