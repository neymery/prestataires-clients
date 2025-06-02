@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Mes conversations</h2>
            @if($conversations->isEmpty())
                <div class="alert alert-info">
                    <i class="fas fa-comments"></i>
                    Aucune conversation pour l'instant.
                </div>
            @else
                <div class="list-group">
                    @foreach($conversations as $conversation)
                        <a href="{{ route('messages.conversation', $conversation->id) }}" 
                           class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">
                                    @if(auth()->id() == $conversation->expediteur_id)
                                        {{ $conversation->destinataire->name }}
                                    @else
                                        {{ $conversation->expediteur->name }}
                                    @endif
                                </h5>
                                <small class="text-muted">
                                    {{ $conversation->latest_message->created_at->diffForHumans() }}
                                </small>
                            </div>
                            <p class="mb-1">
                                {{ $conversation->latest_message->contenu }}
                            </p>
                            <div class="d-flex justify-content-between">
                                <small class="text-muted">
                                    @if($conversation->unread_count > 0)
                                        <span class="badge bg-primary">
                                            {{ $conversation->unread_count }} non lus
                                        </span>
                                    @endif
                                </small>
                                <small class="text-muted">
                                    Dernier message
                                </small>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection