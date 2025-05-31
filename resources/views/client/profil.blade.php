@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mon Profil Client</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('client.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nom">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom', $profil->nom ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="telephone">Téléphone</label>
            <input type="text" name="telephone" class="form-control" value="{{ old('telephone', $profil->telephone ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="photo">Photo (optionnelle)</label>
            <input type="file" name="photo" class="form-control">
            @if(!empty($profil->photo))
                <img src="{{ asset('storage/' . $profil->photo) }}" class="img-thumbnail mt-2" width="150">
            @endif
        </div>

        <button class="btn btn-primary">Sauvegarder</button>
    </form>
</div>
@endsection
