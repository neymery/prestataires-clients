@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $data['photo'] }}" 
                 alt="{{ $data['name'] }}" 
                 class="img-fluid rounded mb-3" 
                 style="height: 200px; object-fit: cover;">
        </div>
        <div class="col-md-8">
            <h2>{{ $data['name'] }}</h2>
            <p>
                Catégorie : {{ $data['categorie'] ?? 'N/A' }}<br>
                Ville : {{ $data['ville'] ?? 'N/A' }}<br>
                Téléphone : {{ $data['telephone'] ?? 'N/A' }}<br>
                Disponibilité : 
                <span class="badge {{ $data['disponible'] ? 'bg-success' : 'bg-danger' }}">
                    {{ $data['disponible'] ? 'Disponible' : 'Indisponible' }}
                </span>
                <br>
                Note moyenne : ⭐ {{ $data['note_moyenne'] }}/5
            </p>
            @if($data['bio'])
                <p>{{ $data['bio'] }}</p>
            @endif
        </div>
    </div>

    @if(count($data['avis']) > 0)
        <div class="mt-4">
            <h3>Avis ({{ count($data['avis']) }})</h3>
            @foreach($data['avis'] as $avis)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $avis['client'] }}</h5>
                        <div class="mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $avis['note'] ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                        </div>
                        <p class="card-text">{{ $avis['commentaire'] }}</p>
                        <small class="text-muted">{{ $avis['created_at'] }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @auth
        <hr>
        <form action="{{ route('avis.store') }}" method="POST" class="mb-3">
            @csrf
            <input type="hidden" name="prestataire_id" value="{{ $data['id'] }}">
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

    <a href="{{ route('messages.envoyer', $data['id']) }}" class="btn btn-success">Contacter ce prestataire</a>
</div>
@endsection