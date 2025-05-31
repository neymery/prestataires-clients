@extends('layouts.app')

@section('content')
<div class="container">
    <h2>📥 Messages reçus</h2>
    @foreach($messagesRecus as $msg)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <strong>{{ $msg->expediteur->name }}</strong> : {{ $msg->contenu }}
                        <div class="text-muted small">{{ $msg->created_at->diffForHumans() }}</div>
                    </div>
                    <div class="ms-3">
                        <form action="{{ route('messages.repondre') }}" method="POST">
                            @csrf
                            <input type="hidden" name="destinataire_id" value="{{ $msg->expediteur_id }}">
                            <div class="mb-2">
                                <textarea name="contenu" class="form-control" rows="2" placeholder="Votre réponse..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success">Répondre</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <hr>

    <h2>📤 Messages envoyés</h2>
    @foreach($messagesEnvoyes as $msg)
        <div class="border p-2 my-1">
            À <strong>{{ $msg->destinataire->name }}</strong> : {{ $msg->contenu }}
            <div class="text-muted small">{{ $msg->created_at->diffForHumans() }}</div>
        </div>
    @endforeach
</div>
@endsection