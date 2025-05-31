@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $prestataire->name }}</h2>

    <img src="{{ asset('storage/' . $prestataire->profilPrestataire->photo) }}" alt="Photo" width="150" class="mb-3">
    <p><strong>Catégorie :</strong> {{ $prestataire->profilPrestataire->categorie->nom }}</p>
    <p><strong>Note moyenne :</strong> ⭐ {{ number_format($prestataire->profilPrestataire->note_moyenne ?? 0, 1) }}/5</p>
    <p><strong>Bio :</strong> {{ $prestataire->profilPrestataire->bio }}</p>
    <p><strong>Téléphone :</strong> {{ $prestataire->profilPrestataire->telephone }}</p>
    <p><strong>Disponible :</strong> {{ $prestataire->profilPrestataire->disponible ? 'Oui' : 'Non' }}</p>

    <hr>

    <h4>Avis reçus :</h4>
    @forelse ($prestataire->avisRecus as $avis)
        <div class="border p-2 mb-2">
            <strong>{{ $avis->client->name }}</strong>
            <p>Note : {{ $avis->note }} ★</p>
            <p>{{ $avis->commentaire }}</p>
        </div>
    @empty
        <p>Aucun avis pour le moment.</p>
    @endforelse

    @auth
        <hr>
        <form action="{{ route('avis.store') }}" method="POST" class="mb-3">
            @csrf
            <input type="hidden" name="prestataire_id" value="{{ $prestataire->id }}">
            <div class="mb-3">
                <label for="note">Note :</label>
                <select name="note" class="form-select" required>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} ★</option>
                    @endfor
                </select>
            </div>
            <div class="mb-3">
                <label for="commentaire">Commentaire :</label>
                <textarea name="commentaire" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Laisser un avis</button>
        </form>
    @endauth

    <hr>

    <a href="{{ route('messages.envoyer', $prestataire->id) }}" class="btn btn-success">Contacter ce prestataire</a>
</div>
@endsection