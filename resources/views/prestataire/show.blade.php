@extends('layouts.app')

@section('content')
<div class="prestataire-profile">
    <!-- Header avec photo et informations principales -->
    <div class="profile-header">
        <div class="header-background"></div>
        <div class="header-content">
            <div class="profile-photo-section">
                <div class="photo-container">
                    <img src="{{ $data['photo'] }}" alt="{{ $data['name'] }}" class="profile-photo">
                    <div class="availability-indicator {{ $data['disponible'] ? 'available' : 'unavailable' }}">
                        <i class="fas {{ $data['disponible'] ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                    </div>
                </div>
            </div>
            
            <div class="profile-info">
                <h1 class="profile-name">{{ $data['name'] }}</h1>
                
                <div class="status-badge {{ $data['disponible'] ? 'available' : 'unavailable' }}">
                    <i class="fas {{ $data['disponible'] ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                    {{ $data['disponible'] ? 'Disponible' : 'Indisponible' }}
                </div>
                
                <div class="profile-details">
                    <div class="detail-item">
                        <i class="fas fa-briefcase"></i>
                        <span class="detail-label">Catégorie</span>
                        <span class="detail-value">{{ $data['categorie'] ?? 'Non spécifiée' }}</span>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span class="detail-label">Ville</span>
                        <span class="detail-value">{{ $data['ville'] ?? 'Non spécifiée' }}</span>
                    </div>
                    
                    <div class="detail-item">
                        <i class="fas fa-phone"></i>
                        <span class="detail-label">Téléphone</span>
                        <span class="detail-value">{{ $data['telephone'] ?? 'Non spécifié' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Bio -->
    @if($data['bio'])
        <div class="bio-section">
            <div class="section-card">
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
        </div>
    @endif

    <!-- Section Avis -->
    <div class="reviews-section">
        <div class="section-card">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-star"></i>
                    Avis clients
                    <span class="reviews-count">({{ count($data['avis']) }})</span>
                </h2>
            </div>
            
            <div class="reviews-container">
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
                                            <div class="review-date">
                                                <i class="fas fa-calendar-alt"></i>
                                                {{ $avis['created_at'] }}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="rating-display">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $avis['note'] ? 'filled' : 'empty' }}"></i>
                                        @endfor
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
        </div>
    </div>

    <!-- Actions pour les clients connectés -->
    @auth
        @if(auth()->user()->role === 'client')
            <div class="actions-section">
                <div class="actions-card">
                    <div class="actions-header">
                        <h3 class="actions-title">
                            <i class="fas fa-handshake"></i>
                            Interagir avec ce prestataire
                        </h3>
                        <p class="actions-subtitle">Contactez ou évaluez ce professionnel</p>
                    </div>
                    
                    <div class="actions-buttons">
                        <a href="{{ route('messages.create', ['destinataire_id' => $data['id']]) }}" 
                           class="action-btn primary">
                            <i class="fas fa-envelope"></i>
                            <span>Contacter</span>
                        </a>
                        
                        @if(!$data['has_reviewed'])
                            <a href="{{ route('avis.create', ['prestataire_id' => $data['id']]) }}" 
                               class="action-btn secondary">
                                <i class="fas fa-star"></i>
                                <span>Laisser un avis</span>
                            </a>
                        @else
                            <div class="already-reviewed">
                                <i class="fas fa-check-circle"></i>
                                <span>Vous avez déjà évalué ce prestataire</span>
                            </div>
                        @endif
                        
                        <button class="action-btn tertiary" onclick="toggleFavorite()">
                            <i class="fas fa-heart"></i>
                            <span>Ajouter aux favoris</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="login-prompt">
            <div class="prompt-card">
                <div class="prompt-content">
                    <i class="fas fa-sign-in-alt"></i>
                    <h3>Connectez-vous pour interagir</h3>
                    <p>Contactez ce prestataire ou laissez un avis en vous connectant</p>
                    <a href="{{ route('login') }}" class="login-btn">
                        <i class="fas fa-user"></i>
                        Se connecter
                    </a>
                </div>
            </div>
        </div>
    @endauth
</div>

<style>
    .prestataire-profile {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Header du profil */
    .profile-header {
        position: relative;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1.5rem;
        overflow: hidden;
        margin-bottom: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .header-background {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 120px;
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

    .profile-photo-section {
        flex-shrink: 0;
    }

    .photo-container {
        position: relative;
        width: 180px;
        height: 180px;
    }

    .profile-photo {
        width: 100%;
        height: 100%;
        border-radius: 1rem;
        object-fit: cover;
        border: 4px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }

    .profile-photo:hover {
        transform: scale(1.05);
    }

    .availability-indicator {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .availability-indicator.available {
        background: rgba(34, 197, 94, 0.3);
        color: #86efac;
    }

    .availability-indicator.unavailable {
        background: rgba(239, 68, 68, 0.3);
        color: #fca5a5;
    }

    .profile-info {
        flex: 1;
        padding-top: 1rem;
    }

    .profile-name {
        font-size: 2.25rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1rem;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .status-badge.available {
        background: rgba(34, 197, 94, 0.2);
        color: #86efac;
    }

    .status-badge.unavailable {
        background: rgba(239, 68, 68, 0.2);
        color: #fca5a5;
    }

    .profile-details {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 0.75rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .detail-item:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateX(5px);
    }

    .detail-item i {
        color: #fbbf24;
        font-size: 1.25rem;
        width: 20px;
        text-align: center;
    }

    .detail-label {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.85rem;
        min-width: 80px;
    }

    .detail-value {
        color: white;
        font-weight: 500;
        flex: 1;
    }

    /* Sections communes */
    .section-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .section-header {
        background: rgba(0, 0, 0, 0.2);
        padding: 1.5rem 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: white;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin: 0;
    }

    .section-title i {
        color: #fbbf24;
    }

    .reviews-count {
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        color: #064e3b;
        padding: 0.25rem 0.75rem;
        border-radius: 2rem;
        font-size: 0.85rem;
        font-weight: 600;
        margin-left: auto;
    }

    /* Section Bio */
    .bio-content {
        padding: 2rem;
    }

    .bio-content p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
        line-height: 1.6;
        margin: 0;
    }

    /* Section Avis */
    .reviews-container {
        padding: 2rem;
    }

    .reviews-grid {
        display: grid;
        gap: 1.5rem;
    }

    .review-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 0.75rem;
        padding: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .review-card:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
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
        width: 45px;
        height: 45px;
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #064e3b;
        font-size: 1.1rem;
    }

    .reviewer-name {
        color: white;
        font-size: 1rem;
        font-weight: 600;
        margin: 0 0 0.25rem 0;
    }

    .review-date {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .rating-display {
        display: flex;
        gap: 0.25rem;
    }

    .rating-display .fa-star.filled {
        color: #fbbf24;
    }

    .rating-display .fa-star.empty {
        color: rgba(255, 255, 255, 0.3);
    }

    .review-content p {
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.5;
        margin: 0;
    }

    .no-reviews {
        text-align: center;
        padding: 3rem 2rem;
        color: rgba(255, 255, 255, 0.6);
    }

    .no-reviews i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: rgba(255, 255, 255, 0.3);
    }

    .no-reviews h3 {
        color: white;
        margin-bottom: 0.5rem;
    }

    /* Section Actions */
    .actions-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        overflow: hidden;
    }

    .actions-header {
        background: rgba(0, 0, 0, 0.2);
        padding: 1.5rem 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
    }

    .actions-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        margin: 0 0 0.5rem 0;
    }

    .actions-title i {
        color: #fbbf24;
    }

    .actions-subtitle {
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
    }

    .actions-buttons {
        padding: 2rem;
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 1.5rem;
        border-radius: 0.75rem;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 1rem;
    }

    .action-btn.primary {
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        color: #064e3b;
    }

    .action-btn.primary:hover {
        background: linear-gradient(45deg, #f59e0b, #d97706);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
    }

    .action-btn.secondary {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .action-btn.secondary:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: #fbbf24;
        color: #fbbf24;
    }

    .action-btn.tertiary {
        background: rgba(239, 68, 68, 0.2);
        color: #fca5a5;
        border: 2px solid rgba(239, 68, 68, 0.3);
    }

    .action-btn.tertiary:hover {
        background: rgba(239, 68, 68, 0.3);
        color: #ef4444;
    }

    .already-reviewed {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 1.5rem;
        background: rgba(34, 197, 94, 0.2);
        color: #86efac;
        border-radius: 0.75rem;
        border: 2px solid rgba(34, 197, 94, 0.3);
    }

    /* Prompt de connexion */
    .login-prompt {
        margin-top: 2rem;
    }

    .prompt-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 1rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        overflow: hidden;
    }

    .prompt-content {
        padding: 3rem 2rem;
        text-align: center;
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
        .prestataire-profile {
            padding: 1rem;
        }

        .header-content {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .profile-name {
            font-size: 1.75rem;
        }

        .actions-buttons {
            flex-direction: column;
        }

        .action-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<script>
    // Fonction pour gérer les favoris
    function toggleFavorite() {
        const btn = document.querySelector('.action-btn.tertiary');
        const icon = btn.querySelector('i');
        const text = btn.querySelector('span');
        
        if (icon.classList.contains('fa-heart')) {
            // Ajouter aux favoris
            icon.classList.remove('fa-heart');
            icon.classList.add('fa-heart-broken');
            text.textContent = 'Retirer des favoris';
            btn.style.background = 'rgba(34, 197, 94, 0.2)';
            btn.style.borderColor = 'rgba(34, 197, 94, 0.3)';
            btn.style.color = '#86efac';
            
            // Animation de succès
            btn.style.transform = 'scale(1.1)';
            setTimeout(() => {
                btn.style.transform = 'scale(1)';
            }, 200);
        } else {
            // Retirer des favoris
            icon.classList.remove('fa-heart-broken');
            icon.classList.add('fa-heart');
            text.textContent = 'Ajouter aux favoris';
            btn.style.background = 'rgba(239, 68, 68, 0.2)';
            btn.style.borderColor = 'rgba(239, 68, 68, 0.3)';
            btn.style.color = '#fca5a5';
        }
    }

    // Animation d'entrée pour les cartes d'avis
    document.addEventListener('DOMContentLoaded', function() {
        const reviewCards = document.querySelectorAll('.review-card');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, index * 100);
                }
            });
        });

        reviewCards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });
    });
</script>
@endsection
