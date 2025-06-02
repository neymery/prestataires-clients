@extends('layouts.app')

@section('content')
<div class="client-profile-container">
    <div class="profile-header">
        <h2 class="profile-title">
            <i class="fas fa-user-circle"></i> Mon Profil Client
        </h2>
        <p class="profile-subtitle">Gérez vos informations personnelles</p>
    </div>

    @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="profile-card">
        <div class="card-header">
            <div class="header-icon">
                <i class="fas fa-edit"></i>
            </div>
            <div class="header-content">
                <h3>Informations personnelles</h3>
                <p>Mettez à jour vos informations de contact</p>
            </div>
        </div>

        <form action="{{ route('client.profil.update') }}" method="POST" enctype="multipart/form-data" class="profile-form">
            @csrf

            <div class="form-layout">
                <div class="form-section">
                    <div class="form-group">
                        <label for="nom" class="form-label">
                            <i class="fas fa-user"></i> Nom complet
                        </label>
                        <input type="text" name="nom" id="nom" class="form-input" value="{{ old('nom', $profil->nom ?? '') }}" placeholder="Votre nom complet" required>
                        @error('nom')
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
                </div>

                <div class="photo-section">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-camera"></i> Photo de profil
                        </label>
                        
                        <div class="photo-upload-area">
                            <div class="current-photo">
                                @if(!empty($profil->photo))
                                    <img src="{{ asset('storage/' . $profil->photo) }}" alt="Photo de profil" class="profile-photo" id="preview-image">
                                @else
                                    <div class="no-photo" id="no-photo-placeholder">
                                        <i class="fas fa-user"></i>
                                        <span>Aucune photo</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="upload-controls">
                                <label for="photo" class="upload-button">
                                    <i class="fas fa-upload"></i>
                                    <span>Choisir une photo</span>
                                </label>
                                <input type="file" name="photo" id="photo" class="file-input" accept="image/*">
                                
                                <div class="upload-info">
                                    <p class="upload-help">
                                        <i class="fas fa-info-circle"></i>
                                        Formats acceptés : JPG, PNG, GIF
                                    </p>
                                    <p class="upload-help">Taille maximale : 2MB</p>
                                </div>
                                
                                @if(!empty($profil->photo))
                                    <button type="button" class="remove-photo-btn" id="remove-photo">
                                        <i class="fas fa-trash"></i>
                                        Supprimer la photo
                                    </button>
                                @endif
                            </div>
                        </div>
                        
                        @error('photo')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="save-button">
                    <i class="fas fa-save"></i>
                    <span>Sauvegarder les modifications</span>
                </button>
                
                <a href="{{ route('client.home') }}" class="cancel-button">
                    <i class="fas fa-times"></i>
                    <span>Annuler</span>
                </a>
            </div>
        </form>
    </div>

    <!-- Informations supplémentaires -->
    <div class="info-cards">
        <div class="info-card">
            <div class="info-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <div class="info-content">
                <h4>Sécurité</h4>
                <p>Vos informations sont protégées et ne seront partagées qu'avec les prestataires que vous contactez.</p>
            </div>
        </div>
        
        <div class="info-card">
            <div class="info-icon">
                <i class="fas fa-eye"></i>
            </div>
            <div class="info-content">
                <h4>Visibilité</h4>
                <p>Votre profil complet permet aux prestataires de mieux comprendre vos besoins.</p>
            </div>
        </div>
    </div>
</div>

<style>
    .client-profile-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem;
    }

    .profile-header {
        text-align: center;
        margin-bottom: 2rem;
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
        margin: 0;
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
        animation: slideIn 0.5s ease-out;
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
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .card-header {
        background: rgba(0, 0, 0, 0.2);
        padding: 2rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .header-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #064e3b;
        font-size: 1.5rem;
    }

    .header-content h3 {
        color: white;
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0 0 0.5rem 0;
    }

    .header-content p {
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .profile-form {
        padding: 2rem;
    }

    .form-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        margin-bottom: 2rem;
    }

    .form-section {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        color: white;
        font-size: 0.95rem;
        font-weight: 500;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label i {
        color: #fbbf24;
    }

    .form-input {
        padding: 1rem;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 0.75rem;
        color: white;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #fbbf24;
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
    }

    .form-input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .form-error {
        color: #fca5a5;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    /* Photo Section */
    .photo-section {
        display: flex;
        justify-content: center;
    }

    .photo-upload-area {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1.5rem;
        width: 100%;
    }

    .current-photo {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.1);
        border: 3px solid rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        transition: all 0.3s ease;
    }

    .current-photo:hover {
        border-color: #fbbf24;
        transform: scale(1.05);
    }

    .profile-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-photo {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255, 255, 255, 0.5);
        text-align: center;
    }

    .no-photo i {
        font-size: 3rem;
    }

    .no-photo span {
        font-size: 0.9rem;
    }

    .upload-controls {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }

    .upload-button {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        color: #064e3b;
        border-radius: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
    }

    .upload-button:hover {
        background: linear-gradient(45deg, #f59e0b, #d97706);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
    }

    .file-input {
        display: none;
    }

    .upload-info {
        text-align: center;
    }

    .upload-help {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.85rem;
        margin: 0.25rem 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .remove-photo-btn {
        background: rgba(239, 68, 68, 0.2);
        color: #fca5a5;
        border: 1px solid rgba(239, 68, 68, 0.3);
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .remove-photo-btn:hover {
        background: rgba(239, 68, 68, 0.3);
        color: #ef4444;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: center;
        gap: 1rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .save-button {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 2rem;
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        color: #064e3b;
        border: none;
        border-radius: 0.75rem;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .save-button:hover {
        background: linear-gradient(45deg, #f59e0b, #d97706);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
    }

    .cancel-button {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 2rem;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 0.75rem;
        font-size: 1.1rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .cancel-button:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.4);
    }

    /* Info Cards */
    .info-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .info-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border-radius: 0.75rem;
        padding: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .info-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #064e3b;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .info-content h4 {
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0 0 0.5rem 0;
    }

    .info-content p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        line-height: 1.5;
        margin: 0;
    }

    /* Animations */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .client-profile-container {
            padding: 1rem;
        }

        .form-layout {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .card-header {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .save-button,
        .cancel-button {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const photoInput = document.getElementById('photo');
        const previewImage = document.getElementById('preview-image');
        const noPhotoPlaceholder = document.getElementById('no-photo-placeholder');
        const removePhotoBtn = document.getElementById('remove-photo');
        const currentPhoto = document.querySelector('.current-photo');
        
        // Prévisualisation de l'image
        if (photoInput) {
            photoInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        // Supprimer le placeholder s'il existe
                        if (noPhotoPlaceholder) {
                            noPhotoPlaceholder.remove();
                        }
                        
                        // Créer ou mettre à jour l'image
                        let img = previewImage;
                        if (!img) {
                            img = document.createElement('img');
                            img.id = 'preview-image';
                            img.classList.add('profile-photo');
                            currentPhoto.appendChild(img);
                        }
                        img.src = e.target.result;
                        
                        // Ajouter le bouton de suppression s'il n'existe pas
                        if (!removePhotoBtn) {
                            const uploadControls = document.querySelector('.upload-controls');
                            const newRemoveBtn = document.createElement('button');
                            newRemoveBtn.type = 'button';
                            newRemoveBtn.id = 'remove-photo';
                            newRemoveBtn.className = 'remove-photo-btn';
                            newRemoveBtn.innerHTML = '<i class="fas fa-trash"></i> Supprimer la photo';
                            uploadControls.appendChild(newRemoveBtn);
                            
                            // Ajouter l'événement de suppression
                            newRemoveBtn.addEventListener('click', removePhoto);
                        }
                    }
                    
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }
        
        // Fonction de suppression de photo
        function removePhoto() {
            if (previewImage) {
                previewImage.remove();
            }
            
            // Remettre le placeholder
            if (!noPhotoPlaceholder) {
                const placeholder = document.createElement('div');
                placeholder.id = 'no-photo-placeholder';
                placeholder.className = 'no-photo';
                placeholder.innerHTML = '<i class="fas fa-user"></i><span>Aucune photo</span>';
                currentPhoto.appendChild(placeholder);
            }
            
            // Supprimer le bouton de suppression
            if (removePhotoBtn) {
                removePhotoBtn.remove();
            }
            
            // Réinitialiser l'input file
            photoInput.value = '';
        }
        
        // Événement pour le bouton de suppression existant
        if (removePhotoBtn) {
            removePhotoBtn.addEventListener('click', removePhoto);
        }
    });
</script>
@endsection