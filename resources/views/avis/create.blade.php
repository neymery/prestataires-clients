@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Laisser un avis pour {{ $prestataire->name }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('avis.store', $prestataire->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <select name="note" id="note" class="form-select" required>
                                <option value="">Sélectionnez une note</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} étoile{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="commentaire" class="form-label">Commentaire</label>
                            <textarea name="commentaire" id="commentaire" class="form-control" rows="4"></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('prestataire.show', $prestataire->id) }}" class="btn btn-secondary me-2">Annuler</a>
                            <button type="submit" class="btn btn-primary">Envoyer l'avis</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
