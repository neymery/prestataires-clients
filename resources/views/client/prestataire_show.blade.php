@extends('layouts.app')

@section('content')
<div class="prestataire-details">
    <!-- Header du prestataire -->
    <div class="prestataire-header">
        <div class="header-background"></div>
        <div class="header-content">
            <div class="prestataire-photo">
                <img src="{{ $data['photo'] }}" alt="{{ $data['name'] }}" class="photo-image">
                <div class="availability-badge {{ $data['disponible'] ? 'available' : 'unavailable' }}">
                    <i class="fas {{ $data['disponible'] ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                    {{ $data['disponible'] ? 'Disponible' : 'Indisponible' }}
                </div>
            </div>
            
            <div class="prestataire-info">
                <h1 class="prestataire-name">{{ $data['name'] }}</h1>
                
                <div class="rating-section">
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $data['note_moyenne'] ? 'filled' : 'empty' }}"></i>
                        @endfor
                    </div>
                    <span class="rating-text">{{ number_format($data['note_moyenne'], 1) }}/5</span>
                    <span class="reviews-count">({{ count($data['avis']) }} avis)</span>
                </div>
                
                <div class="info-grid">
                    <div class="info-item">
                        <i class="fas fa-briefcase"></i>
                        <div>
                            <span class="info-label">Catégorie</span>
                            <span class="info-value">{{ $data['categorie'] ?? 'Non spécifié' }}</span>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <span class="info-label">Ville</span>
                            <span class="info-value">{{ $data['ville'] ?? 'Non spécifié' }}</span>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <span class="info-label">Téléphone</span>
                            <span class="info-value">{{ $data['telephone'] ?? 'Non spécifié' }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <a href="{{ route('messages.envoyer', $data['id']) }}" class="contact-btn">
                        <i class="fas fa-paper-plane"></i>
                        <span>Contacter ce prestataire</span>
                    </a>
                    
                    <button class="favorite-btn" onclick="toggleFavorite()">
                        <i class="fas fa-heart"></i>
                        <span>Ajouter aux favoris</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Bio -->
    @if($data['bio'])
        <div class="bio-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-user"></i>
                    À propos
                </h2>
            </div>
            <div class="bio-content">
                <p>{{ $data['bio'] }}</p>
            </div>
        </div>
    @endif

    <!-- Section Avis -->
    <div class="reviews-section">
        <div class="section-header">
            <h2 class="section-title">
                <i class="fas fa-star"></i>
                Avis clients
                <span class="reviews-badge">{{ count($data['avis']) }}</span>
            </h2>
        </div>

        @if(count($data['avis']) > 0)
            <div class="reviews-grid">
                @foreach($data['avis'] as $avis)
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <div class="reviewer-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="reviewer-details">
                                    <h4 class="reviewer-name">{{ $avis['client'] }}</h4>
                                    <div class="review-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $avis['note'] ? 'filled' : 'empty' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="review-date">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $avis['created_at'] }}
                            </div>
                        </div>
                        
                        <div class="review-content">
                            <p>{{ $avis['commentaire'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-reviews">
                <i class="fas fa-comment-slash"></i>
                <h3>Aucun avis pour le moment</h3>
                <p>Soyez le premier à laisser un avis sur ce prestataire !</p>
            </div>
        @endif
    </div>

    <!-- Formulaire d'avis -->
    @auth
        <div class="review-form-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-edit"></i>
                    Laisser un avis
                </h2>
            </div>
            
            <div class="review-form-card">
                <form action="{{ route('avis.store') }}" method="POST" class="review-form">
                    @csrf
                    <input type="hidden" name="prestataire_id" value="{{ $data['id'] }}">
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-star"></i>
                            Votre note
                        </label>
                        <div class="rating-input">
                            @for ($i = 1; $i <= 5; $i++)
                                <input type="radio" name="note" value="{{ $i }}" id="star{{ $i }}" required>
                                <label for="star{{ $i }}" class="star-label">
                                    <i class="fas fa-star"></i>
                                </label>
                            @endfor
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="commentaire" class="form-label">
                            <i class="fas fa-comment"></i>
                            Votre commentaire
                        </label>
                        <textarea name="commentaire" id="commentaire" class="form-textarea" rows="4" placeholder="Partagez votre expérience avec ce prestataire..."></textarea>
                    </div>
                    
                    <button type="submit" class="submit-review-btn">
                        <i class="fas fa-paper-plane"></i>
                        <span>Publier mon avis</span>
                    </button>
                </form>
            </div>
        </div>
    @else
        <div class="login-prompt">
            <div class="prompt-content">
                <i class="fas fa-sign-in-alt"></i>
                <h3>Connectez-vous pour laisser un avis</h3>
                <p>Partagez votre expérience avec ce prestataire</p>
                <a href="{{ route('login') }}" class="login-btn">
                    <i class="fas fa-user"></i>
                    Se connecter
                </a>
            </div>
        </div>
    @endauth
</div>

<style>
    .prestataire-details {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem 3rem;
    }

    /* Header du prestataire */
    .prestataire-header {
        position: relative;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1.5rem;
        overflow: hidden;
        margin-bottom: 3rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .header-background {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 150px;
        background: linear-gradient(135deg, rgba(251, 191, 36, 0.3), rgba(245, 158, 11, 0.3));
        z-index: 1;
    }

    .header-content {
        position: relative;
        z-index: 2;
        padding: 2rem;
        display: flex;
        gap: 2rem;
        align-items: flex-start;
    }

    .prestataire-photo {
        position: relative;
        flex-shrink: 0;
    }

    .photo-image {
        width: 200px;
        height: 200px;
        border-radius: 1rem;
        object-fit: cover;
        border: 4px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .availability-badge {
        position: absolute;
        top: -10px;
        right: -10px;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-size: 0.85rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .availability-badge.available {
        background: rgba(34, 197, 94, 0.2);
        color: #86efac;
    }

    .availability-badge.unavailable {
        background: rgba(239, 68, 68, 0.2);
        color: #fca5a5;
    }

    .prestataire-info {
        flex: 1;
        padding-top: 1rem;
    }

    .prestataire-name {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1rem;
    }

    .rating-section {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stars {
        display: flex;
        gap: 0.25rem;
    }

    .stars .fa-star.filled {
        color: #fbbf24;
    }

    .stars .fa-star.empty {
        color: rgba(255, 255, 255, 0.3);
    }

    .rating-text {
        font-size: 1.25rem;
        font-weight: 600;
        color: white;
    }

    .reviews-count {
        color: rgba(255, 255, 255, 0.7);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 0.75rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .info-item i {
        color: #fbbf24;
        font-size: 1.25rem;
        width: 20px;
        text-align: center;
    }

    .info-label {
        display: block;
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.85rem;
        margin-bottom: 0.25rem;
    }

    .info-value {
        display: block;
        color: white;
        font-weight: 500;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
    }

    .contact-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 2rem;
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        color: #064e3b;
        text-decoration: none;
        border-radius: 0.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
        flex: 1;
        justify-content: center;
    }

    .contact-btn:hover {
        background: linear-gradient(45deg, #f59e0b, #d97706);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
    }

    .favorite-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 2rem;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 0.75rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .favorite-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: #fbbf24;
        color: #fbbf24;
    }

    /* Sections communes */
    .section-header {
        margin-bottom: 2rem;
        text-align: center;
    }

    .section-title {
        font-size: 2rem;
        font-weight: 700;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        margin-bottom: 0.5rem;
    }

    .section-title i {
        color: #fbbf24;
    }

    .reviews-badge {
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        color: #064e3b;
        padding: 0.25rem 0.75rem;
        border-radius: 2rem;
        font-size: 0.9rem;
        font-weight: 600;
    }

    /* Section Bio */
    .bio-section {
        margin-bottom: 3rem;
    }

    .bio-content {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        padding: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .bio-content p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
        line-height: 1.6;
        margin: 0;
    }

    /* Section Avis */
    .reviews-section {
        margin-bottom: 3rem;
    }

    .reviews-grid {
        display: grid;
        gap: 1.5rem;
    }

    .review-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        padding: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .review-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .reviewer-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .reviewer-avatar {
        width: 50px;
        height: 50px;
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #064e3b;
        font-size: 1.25rem;
    }

    .reviewer-name {
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0 0 0.5rem 0;
    }

    .review-stars {
        display: flex;
        gap: 0.25rem;
    }

    .review-stars .fa-star.filled {
        color: #fbbf24;
    }

    .review-stars .fa-star.empty {
        color: rgba(255, 255, 255, 0.3);
    }

    .review-date {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .review-content p {
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.6;
        margin: 0;
    }

    .no-reviews {
        text-align: center;
        padding: 3rem 2rem;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 1rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .no-reviews i {
        font-size: 3rem;
        color: rgba(255, 255, 255, 0.3);
        margin-bottom: 1rem;
    }

    .no-reviews h3 {
        color: white;
        margin-bottom: 0.5rem;
    }

    .no-reviews p {
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    /* Formulaire d'avis */
    .review-form-section {
        margin-bottom: 3rem;
    }

    .review-form-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        padding: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .review-form {
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
        font-weight: 500;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label i {
        color: #fbbf24;
    }

    .rating-input {
        display: flex;
        gap: 0.5rem;
    }

    .rating-input input[type="radio"] {
        display: none;
    }

    .star-label {
        cursor: pointer;
        font-size: 1.5rem;
        color: rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
    }

    .star-label:hover,
    .rating-input input[type="radio"]:checked ~ .star-label,
    .rating-input input[type="radio"]:checked + .star-label {
        color: #fbbf24;
    }

    .form-textarea {
        padding: 1rem;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 0.75rem;
        color: white;
        font-size: 1rem;
        resize: vertical;
        min-height: 120px;
        transition: all 0.3s ease;
    }

    .form-textarea:focus {
        outline: none;
        border-color: #fbbf24;
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
    }

    .form-textarea::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .submit-review-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
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
        align-self: flex-start;
    }

    .submit-review-btn:hover {
        background: linear-gradient(45deg, #f59e0b, #d97706);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
    }

    /* Prompt de connexion */
    .login-prompt {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 1rem;
        padding: 3rem 2rem;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .prompt-content i {
        font-size: 3rem;
        color: #fbbf24;
        margin-bottom: 1rem;
    }

    .prompt-content h3 {
        color: white;
        margin-bottom: 0.5rem;
    }

    .prompt-content p {
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 2rem;
    }

    .login-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 2rem;
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        color: #064e3b;
        text-decoration: none;
        border-radius: 0.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .login-btn:hover {
        background: linear-gradient(45deg, #f59e0b, #d97706);
        transform: translateY(-2px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .prestataire-details {
            padding: 0 1rem 2rem;
        }

        .header-content {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .prestataire-name {
            font-size: 2rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }

        .rating-section {
            justify-content: center;
        }
    }
</style>

<script>
    // Gestion du système de notation interactif
    document.addEventListener('DOMContentLoaded', function() {
        const ratingInputs = document.querySelectorAll('.rating-input input[type="radio"]');
        const starLabels = document.querySelectorAll('.star-label');
        
        // Effet hover sur les étoiles
        starLabels.forEach((label, index) => {
            label.addEventListener('mouseenter', function() {
                highlightStars(index + 1);
            });
            
            label.addEventListener('mouseleave', function() {
                const checkedInput = document.querySelector('.rating-input input[type="radio"]:checked');
                if (checkedInput) {
                    const checkedIndex = Array.from(ratingInputs).indexOf(checkedInput);
                    highlightStars(checkedIndex + 1);
                } else {
                    highlightStars(0);
                }
            });
            
            label.addEventListener('click', function() {
                ratingInputs[index].checked = true;
                highlightStars(index + 1);
            });
        });
        
        function highlightStars(count) {
            starLabels.forEach((label, index) => {
                if (index < count) {
                    label.style.color = '#fbbf24';
                } else {
                    label.style.color = 'rgba(255, 255, 255, 0.3)';
                }
            });
        }
    });
    
    // Fonction pour gérer les favoris
    function toggleFavorite() {
        const btn = document.querySelector('.favorite-btn');
        const icon = btn.querySelector('i');
        const text = btn.querySelector('span');
        
        if (icon.classList.contains('fa-heart')) {
            icon.classList.remove('fa-heart');
            icon.classList.add('fa-heart-broken');
            text.textContent = 'Retirer des favoris';
            btn.style.background = 'rgba(239, 68, 68, 0.2)';
            btn.style.borderColor = 'rgba(239, 68, 68, 0.3)';
            btn.style.color = '#fca5a5';
        } else {
            icon.classList.remove('fa-heart-broken');
            icon.classList.add('fa-heart');
            text.textContent = 'Ajouter aux favoris';
            btn.style.background = 'rgba(255, 255, 255, 0.1)';
            btn.style.borderColor = 'rgba(255, 255, 255, 0.2)';
            btn.style.color = 'white';
        }
    }
</script>
@endsection