@extends('layouts.app')

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <h2 class="profile-title">
            <i class="fas fa-user-tie"></i> Mon Profil Prestataire
        </h2>
        <p class="profile-subtitle">Complétez votre profil pour être visible par les clients</p>
    </div>

    @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="profile-card">
        <form action="{{ route('prestataire.profil.update') }}" method="POST" enctype="multipart/form-data" class="profile-form">
            @csrf

            <div class="form-layout">
                <div class="form-column">
                    <div class="form-group">
                        <label for="bio" class="form-label">
                            <i class="fas fa-info-circle"></i> Bio
                        </label>
                        <textarea name="bio" id="bio" class="form-textarea" placeholder="Décrivez votre expérience, vos compétences et vos services...">{{ old('bio', $profil->bio ?? '') }}</textarea>
                        @error('bio')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="telephone" class="form-label">
                            <i class="fas fa-phone"></i> Téléphone
                        </label>
                        <input type="text" name="telephone" id="telephone" class="form-input" value="{{ old('telephone', $profil->telephone ?? '') }}" placeholder="Votre numéro de téléphone">
                        @error('telephone')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="categorie_id" class="form-label">
                            <i class="fas fa-tag"></i> Catégorie
                        </label>
                        <div class="select-wrapper">
                            <select name="categorie_id" id="categorie_id" class="form-select">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" @if(($profil->categorie_id ?? '') == $cat->id) selected @endif>
                                        {{ $cat->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('categorie_id')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-group">
                        <label for="ville_id" class="form-label">
                            <i class="fas fa-map-marker-alt"></i> Ville
                        </label>
                        <div class="select-wrapper">
                            <select name="ville_id" id="ville_id" class="form-select">
                                <option value="">Sélectionnez une ville</option>
                                @foreach($villes as $ville)
                                    <option value="{{ $ville->id }}" {{ $profil && $profil->ville_id == $ville->id ? 'selected' : '' }}>
                                        {{ $ville->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('ville_id')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="disponible" class="form-label">
                            <i class="fas fa-calendar-check"></i> Disponibilité
                        </label>
                        <div class="select-wrapper">
                            <select name="disponible" id="disponible" class="form-select">
                                <option value="1" @if(($profil->disponible ?? 1) == 1) selected @endif>Disponible</option>
                                <option value="0" @if(($profil->disponible ?? 1) == 0) selected @endif>Non disponible</option>
                            </select>
                        </div>
                        @error('disponible')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-image"></i> Photo de profil
                        </label>
                        <div class="photo-upload">
                            <div class="current-photo">
                                @if(!empty($profil->photo))
                                    <img src="{{ asset('storage/' . $profil->photo) }}" alt="Photo de profil" class="profile-image">
                                @else
                                    <div class="no-photo">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="upload-controls">
                                <label for="photo" class="upload-btn">
                                    <i class="fas fa-upload"></i>
                                    <span>Choisir une photo</span>
                                </label>
                                <input type="file" name="photo" id="photo" class="file-input" accept="image/*">
                                <p class="upload-help">JPG, PNG ou GIF, max 2MB</p>
                            </div>
                        </div>
                        @error('photo')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="form-button">
                    <i class="fas fa-save"></i>
                    <span>Sauvegarder</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .profile-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .profile-header {
        margin-bottom: 2rem;
        text-align: center;
    }

    .profile-title {
        font-size: 2rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }

    .profile-title i {
        color: #fbbf24;
    }

    .profile-subtitle {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.1rem;
    }

    .alert-success {
        background: rgba(34, 197, 94, 0.2);
        border: 1px solid rgba(34, 197, 94, 0.3);
        border-radius: 0.75rem;
        padding: 1rem;
        color: #bbf7d0;
        margin-bottom: 2rem;
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .alert-success i {
        color: #22c55e;
        font-size: 1.25rem;
    }

    .profile-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 2rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .profile-form {
        width: 100%;
    }

    .form-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        color: white;
        font-size: 0.95rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label i {
        color: #fbbf24;
    }

    .form-input,
    .form-textarea,
    .form-select {
        width: 100%;
        padding: 0.75rem 1rem;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 0.5rem;
        color: white;
        font-size: 1rem;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-textarea {
        min-height: 150px;
        resize: vertical;
    }

    .form-input:focus,
    .form-textarea:focus,
    .form-select:focus {
        outline: none;
        border-color: #fbbf24;
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
    }

    .form-input::placeholder,
    .form-textarea::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .select-wrapper {
        position: relative;
    }

    .select-wrapper::after {
        content: '\f078';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #fbbf24;
        pointer-events: none;
    }

    .form-select {
        appearance: none;
        padding-right: 2.5rem;
    }

    .form-select option {
        background-color: #064e3b;
        color: white;
    }

    .form-error {
        color: #fca5a5;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    .photo-upload {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .current-photo {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-photo {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.5);
        font-size: 2rem;
    }

    .upload-controls {
        flex: 1;
    }

    .upload-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        color: #064e3b;
        border-radius: 0.5rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .upload-btn:hover {
        background: linear-gradient(45deg, #f59e0b, #d97706);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
    }

    .file-input {
        display: none;
    }

    .upload-help {
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    .form-actions {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    .form-button {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 2rem;
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        color: #064e3b;
        border: none;
        border-radius: 0.5rem;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .form-button:hover {
        background: linear-gradient(45deg, #f59e0b, #d97706);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-container {
            padding: 1rem;
        }

        .profile-card {
            padding: 1.5rem;
        }

        .form-layout {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .photo-upload {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<script>
    // Prévisualisation de l'image
    document.addEventListener('DOMContentLoaded', function() {
        const photoInput = document.getElementById('photo');
        const currentPhoto = document.querySelector('.current-photo');
        
        if (photoInput) {
            photoInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        // Créer ou mettre à jour l'image
                        let img = currentPhoto.querySelector('img');
                        if (!img) {
                            currentPhoto.innerHTML = '';
                            img = document.createElement('img');
                            img.classList.add('profile-image');
                            currentPhoto.appendChild(img);
                        }
                        img.src = e.target.result;
                    }
                    
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }
    });
</script>
@endsection