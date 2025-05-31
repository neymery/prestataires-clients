@extends('layouts.app')


@section('content')
<div class="container">
    <h2>Bienvenue {{ Auth::user()->name }}</h2>

    <h4 class="mt-4">Catégories</h4>
    <div class="row mb-4">
        @foreach($categories as $categorie)
            <div class="col-md-2">
                <div class="card text-center">
                    <div class="card-body">
                        <strong>{{ $categorie->nom }}</strong>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <h4 class="mt-4">Prestataires</h4>
    <div class="row">
        @foreach($prestataires as $prestataire)
            <div class="col-md-4">
                <div class="card mb-4">
                    @if($prestataire->profilPrestataire && $prestataire->profilPrestataire->photo)
                        <img src="{{ asset('storage/' . $prestataire->profilPrestataire->photo) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $prestataire->name }}</h5>
                        <p class="card-text">
                            Métier : {{ $prestataire->profilPrestataire->categorie->nom ?? 'N/A' }}<br>
                            Tel : {{ $prestataire->profilPrestataire->telephone ?? 'N/A' }}<br>
                            Disponibilité : 
                            @if($prestataire->profilPrestataire->disponible)
                                <span class="badge bg-success">Disponible</span>
                            @else
                                <span class="badge bg-danger">Indisponible</span>
                            @endif
                            <br>
                            Note moyenne : ⭐ {{ number_format($prestataire->profilPrestataire->note_moyenne ?? 0, 1) }}/5
                        </p>
                        <a href="#" class="btn btn-primary">Contacter</a>
                    </div>
                </div>
            </div>

            <form action="{{ route('avis.store', $prestataire->id) }}" method="POST" class="mt-2">
                @csrf
                <label for="note">Votre note :</label>
                <select name="note" required>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} ⭐</option>
                    @endfor
                </select>

                <textarea name="commentaire" class="form-control mt-1" rows="2" placeholder="Votre commentaire..."></textarea>
                
                <button class="btn btn-sm btn-success mt-2">Envoyer l'avis</button>
            </form>


            @if($prestataire->avisRecus->count())
                <div class="mt-3">
                    <strong>Avis clients :</strong>
                    @foreach($prestataire->avisRecus as $avis)
                        <div class="border rounded p-2 mb-1">
                            ⭐ {{ $avis->note }} – <em>{{ $avis->client->name }}</em><br>
                            {{ $avis->commentaire }}
                        </div>
                    @endforeach
                </div>
            @endif


            <form action="{{ route('messages.envoyer', $prestataire->id) }}" method="POST" class="mt-2">
                @csrf
                <textarea name="contenu" class="form-control" rows="2" placeholder="Écrire un message au prestataire..." required></textarea>
                <button class="btn btn-primary btn-sm mt-1">Envoyer</button>
            </form>



        @endforeach
    </div>
</div>
@endsection
