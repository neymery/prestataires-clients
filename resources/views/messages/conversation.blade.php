@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Conversation avec {{ $destinataire->name }}</h4>

    <div class="border p-3 mb-3" style="max-height: 400px; overflow-y: auto;">
        @forelse($messages as $msg)
            <div class="mb-2 {{ $msg->expediteur_id == auth()->id() ? 'text-end' : '' }}">
                <div class="p-2 rounded {{ $msg->expediteur_id == auth()->id() ? 'bg-primary text-white' : 'bg-light' }}">
                    <small><strong>{{ $msg->expediteur->name }}</strong></small><br>
                    {{ $msg->contenu }}
                    <br><small class="text-muted">{{ $msg->created_at->format('d/m/Y H:i') }}</small>
                </div>
            </div>
        @empty
            <p>Aucun message pour l'instant.</p>
        @endforelse
    </div>

    <!-- Formulaire de réponse -->
    <form action="{{ route('messages.repondre') }}" method="POST">
        @csrf
        <input type="hidden" name="destinataire_id" value="{{ $destinataire->id }}">
        <div class="mb-3">
            <textarea name="contenu" class="form-control" placeholder="Votre message..." required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Envoyer</button>
    </form>
</div>
@endsection