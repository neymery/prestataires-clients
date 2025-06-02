@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Prestataires dans la catégorie : {{ $categorie->nom }}</h2>

    @if($prestataires->isEmpty())
        <div class="alert alert-info mt-4">
            Aucun prestataire n'est actuellement disponible dans cette catégorie.
        </div>
    @else
        <div class="row mt-4">
            @foreach($prestataires as $prestataire)
                <div class="col-md-4">
                    <div class="card mb-4">
                        @if($prestataire->profilPrestataire && $prestataire->profilPrestataire->photo)
                            <img src="{{ asset('storage/' . $prestataire->profilPrestataire->photo) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $prestataire->name }}</h5>
                            <p class="card-text">
                                Tel : {{ $prestataire->profilPrestataire->telephone ?? 'N/A' }}<br>
                                Disponibilité : 
                                <span class="badge {{ $prestataire->profilPrestataire->disponible ? 'bg-success' : 'bg-danger' }}">
                                    {{ $prestataire->profilPrestataire->disponible ? 'Disponible' : 'Indisponible' }}
                                </span>
                                <br>
                                Note moyenne : ⭐ {{ number_format($prestataire->profilPrestataire->note_moyenne ?? 0, 1) }}/5
                            </p>
                            <div class="d-flex gap-2">
                                <a href="{{ route('messages.conversation', $prestataire->id) }}" class="btn btn-sm btn-outline-primary">
                                    Voir la conversation
                                </a>
                                <a href="#" class="btn btn-primary">Contacter</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection