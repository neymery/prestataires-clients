@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Bienvenue {{ Auth::user()->name }}</h2>

    <div class="mt-4">
        <form action="{{ route('prestataires.search') }}" method="GET" class="d-flex gap-2">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" name="query" class="form-control" placeholder="Rechercher par nom ou ville...">
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
    </div>

    <h4 class="mt-4">Catégories</h4>
    <div class="row">
        @foreach($categories as $cat)
            <div class="col-md-3 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <a href="{{ route('prestataires.categorie', $cat->id) }}" class="text-decoration-none">
                            <h5 class="card-title">{{ $cat->nom }}</h5>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <h4 class="mt-4">Prestataires</h4>
    <div class="row">
        @foreach($prestataires as $prestataire)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($prestataire->profilPrestataire && $prestataire->profilPrestataire->photo)
                        <img src="{{ asset('storage/' . $prestataire->profilPrestataire->photo) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($prestataire->name) }}&background=random&size=200" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $prestataire->name }}</h5>
                        <p class="card-text">
                            Métier : {{ $prestataire->profilPrestataire && $prestataire->profilPrestataire->categorie ? $prestataire->profilPrestataire->categorie->nom : 'N/A' }}<br>
                            Tel : {{ $prestataire->profilPrestataire ? ($prestataire->profilPrestataire->telephone ?? 'N/A') : 'N/A' }}<br>
                            Disponibilité : 
                            <span class="badge {{ $prestataire->profilPrestataire && $prestataire->profilPrestataire->disponible ? 'bg-success' : 'bg-danger' }}">
                                {{ $prestataire->profilPrestataire && $prestataire->profilPrestataire->disponible ? 'Disponible' : 'Indisponible' }}
                            </span>
                            <br>
                            Note moyenne : ⭐ {{ $prestataire->profilPrestataire ? number_format($prestataire->profilPrestataire->note_moyenne ?? 0, 1) : 0 }}/5
                        </p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('messages.conversation', $prestataire->id) }}" class="btn btn-sm btn-outline-primary">
                                Voir la conversation
                            </a>
                            <a href= "{{ route('messages.create', $prestataire->id) }}"  class="btn btn-primary">Contacter</a>
                            <a href="{{ route('prestataire.show', $prestataire->id) }}" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


</div>
@endsection