@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mon Profil Prestataire</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('prestataire.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="bio">Bio</label>
            <textarea name="bio" class="form-control">{{ old('bio', $profil->bio ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="telephone">Téléphone</label>
            <input type="text" name="telephone" class="form-control" value="{{ old('telephone', $profil->telephone ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="categorie_id">Catégorie</label>
            <select name="categorie_id" class="form-control">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @if(($profil->categorie_id ?? '') == $cat->id) selected @endif>
                        {{ $cat->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="ville_id">Ville</label>
            <select name="ville_id" id="ville_id" class="form-control">
                <option value="">Sélectionnez une ville</option>
                @foreach($villes as $ville)
                    <option value="{{ $ville->id }}" {{ $profil && $profil->ville_id == $ville->id ? 'selected' : '' }}>
                        {{ $ville->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="disponible">Disponible</label>
            <select name="disponible" class="form-control">
                <option value="1" @if(($profil->disponible ?? 1) == 1) selected @endif>Oui</option>
                <option value="0" @if(($profil->disponible ?? 1) == 0) selected @endif>Non</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="photo">Photo (optionnel)</label>
            <input type="file" name="photo" class="form-control">
            @if(!empty($profil->photo))
                <img src="{{ asset('storage/' . $profil->photo) }}" class="img-thumbnail mt-2" width="150">
            @endif
        </div>

        <button class="btn btn-primary">Sauvegarder</button>
    </form>
</div>
@endsection
