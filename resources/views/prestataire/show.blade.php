@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>{{ $data['name'] }}</h4>
                    <div class="d-flex align-items-center">
                        @if($data['disponible'])
                            <span class="badge bg-success">Disponible</span>
                        @else
                            <span class="badge bg-danger">Indisponible</span>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ $data['photo'] }}" 
                                 alt="{{ $data['name'] }}" 
                                 class="img-fluid rounded mb-3" 
                                 style="height: 200px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <h5>Catégorie</h5>
                            Catégorie : {{ $data['categorie'] ?? 'Non spécifiée' }}<br>
                            Ville : {{ $data['ville'] ?? 'Non spécifiée' }}<br>
                            Téléphone : {{ $data['telephone'] ?? 'Non spécifié' }}<br>
                            <p><strong>Bio :</strong> {{ $data['bio'] }}</p>

                            <div class="mt-4">
                                <h5>Avis ({{ count($data['avis']) }})</h5>
                                @if(count($data['avis']) > 0)
                                    @foreach($data['avis'] as $avis)
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <h6 class="mb-1">{{ $avis['client'] }}</h6>
                                                        <small class="text-muted">
                                                            {{ $avis['created_at'] }}
                                                        </small>
                                                    </div>
                                                    <div class="text-end">
                                                        <div class="rating">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <span class="star {{ $i <= $avis['note'] ? 'active' : '' }}">★</span>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mb-0">{{ $avis['commentaire'] }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-muted">Aucun avis pour le moment</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    @auth
                        @if(auth()->user()->role === 'client')
                            <div class="mt-4">
                                <a href="{{ route('messages.create', ['destinataire_id' => $data['id']]) }}" 
                                   class="btn btn-primary me-2">
                                    <i class="fas fa-envelope"></i> Contacter
                                </a>
                                @if(!$data['has_reviewed'])
                                    <a href="{{ route('avis.create', ['prestataire_id' => $data['id']]) }}" 
                                       class="btn btn-success">
                                        <i class="fas fa-star"></i> Laisser un avis
                                    </a>
                                @endif
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
