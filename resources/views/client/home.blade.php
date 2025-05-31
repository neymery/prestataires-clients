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
        @endforeach
    </div>
</div>
@endsection
