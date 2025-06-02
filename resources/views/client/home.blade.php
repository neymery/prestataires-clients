@extends('layouts.app')

@section('content')
<div class="client-home">
    <!-- Section d'en-tête -->
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Bienvenue, {{ Auth::user()->name }}</h1>
            <p class="hero-subtitle">Trouvez le prestataire idéal pour vos projets</p>
            
            <form action="{{ route('prestataires.search') }}" method="GET" class="search-form">
                <div class="search-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" name="query" class="search-input" placeholder="Rechercher par nom, service ou ville...">
                    <button type="submit" class="search-button">
                        Rechercher
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Section des catégories -->
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">
                <i class="fas fa-tags"></i>
                Catégories
            </h2>
            <p class="section-subtitle">Explorez nos catégories de services</p>
        </div>

        <div class="categories-grid">
            @foreach($categories as $cat)
                <a href="{{ route('prestataires.categorie', $cat->id) }}" class="category-card">
                    <div class="category-icon">
                        @php
                            $icon = 'fa-briefcase'; // Icône par défaut
                            
                            // Tableau d'associations catégorie => icône
                            $categoryIcons = [
                                'plomberie' => 'fa-faucet',
                                'électricité' => 'fa-bolt',
                                'menuiserie' => 'fa-hammer',
                                'peinture' => 'fa-paint-roller',
                                'jardinage' => 'fa-leaf',
                                'informatique' => 'fa-laptop',
                                'ménage' => 'fa-broom',
                                'maçonnerie' => 'fa-hard-hat',
                                'coiffure' => 'fa-cut',
                                'cuisine' => 'fa-utensils',
                                'couture' => 'fa-tshirt',
                                'transport' => 'fa-truck',
                                'enseignement' => 'fa-chalkboard-teacher',
                                'santé' => 'fa-heartbeat',
                                'beauté' => 'fa-spa',
                                'automobile' => 'fa-car',
                                'photographie' => 'fa-camera',
                                'musique' => 'fa-music',
                                'sport' => 'fa-dumbbell',
                                'décoration' => 'fa-paint-brush'
                            ];
                            
                            // Recherche insensible à la casse
                            $categoryName = strtolower($cat->nom);
                            foreach ($categoryIcons as $key => $value) {
                                if (strpos($categoryName, $key) !== false) {
                                    $icon = $value;
                                    break;
                                }
                            }
                        @endphp
                        <i class="fas {{ $icon }}"></i>
                    </div>
                    <h3 class="category-name">{{ $cat->nom }}</h3>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Section des prestataires -->
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">
                <i class="fas fa-user-tie"></i>
                Prestataires recommandés
            </h2>
            <p class="section-subtitle">Découvrez nos meilleurs professionnels</p>
        </div>

        <div class="providers-grid">
            @foreach($prestataires as $prestataire)
                <div class="provider-card">
                    <div class="provider-header">
                        <div class="provider-availability {{ $prestataire->profilPrestataire && $prestataire->profilPrestataire->disponible ? 'available' : 'unavailable' }}">
                            {{ $prestataire->profilPrestataire && $prestataire->profilPrestataire->disponible ? 'Disponible' : 'Indisponible' }}
                        </div>
                        <div class="provider-rating">
                            <i class="fas fa-star"></i>
                            <span>{{ $prestataire->profilPrestataire ? number_format($prestataire->profilPrestataire->note_moyenne ?? 0, 1) : 0 }}</span>
                        </div>
                    </div>
                    
                    <div class="provider-image">
                        @if($prestataire->profilPrestataire && $prestataire->profilPrestataire->photo)
                            <img src="{{ asset('storage/' . $prestataire->profilPrestataire->photo) }}" alt="{{ $prestataire->name }}">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($prestataire->name) }}&background=064e3b&color=fff&size=200" alt="{{ $prestataire->name }}">
                        @endif
                    </div>
                    
                    <div class="provider-content">
                        <h3 class="provider-name">{{ $prestataire->name }}</h3>
                        
                        <div class="provider-info">
                            <div class="info-item">
                                <i class="fas fa-briefcase"></i>
                                <span>{{ $prestataire->profilPrestataire && $prestataire->profilPrestataire->categorie ? $prestataire->profilPrestataire->categorie->nom : 'Non spécifié' }}</span>
                            </div>
                            
                            <div class="info-item">
                                <i class="fas fa-phone"></i>
                                <span>{{ $prestataire->profilPrestataire ? ($prestataire->profilPrestataire->telephone ?? 'Non spécifié') : 'Non spécifié' }}</span>
                            </div>
                        </div>
                        
                        <div class="provider-actions">
                            <a href="{{ route('messages.create', $prestataire->id) }}" class="provider-btn primary">
                                <i class="fas fa-paper-plane"></i>
                                <span>Contacter</span>
                            </a>
                            
                            <a href="{{ route('prestataire.show', $prestataire->id) }}" class="provider-btn secondary">
                                <i class="fas fa-eye"></i>
                                <span>Voir profil</span>
                            </a>
                            
                            <a href="{{ route('messages.conversation', $prestataire->id) }}" class="provider-btn tertiary">
                                <i class="fas fa-comments"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .client-home {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem 3rem;
    }

    /* Hero Section */
    .hero-section {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        padding: 3rem 2rem;
        margin-bottom: 3rem;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1rem;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 2rem;
    }

    /* Search Form */
    .search-form {
        max-width: 700px;
        margin: 0 auto;
    }

    .search-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .search-icon {
        position: absolute;
        left: 1.25rem;
        color: rgba(255, 255, 255, 0.6);
        font-size: 1.25rem;
    }

    .search-input {
        flex: 1;
        padding: 1.25rem 1.25rem 1.25rem 3.5rem;
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 0.75rem 0 0 0.75rem;
        color: white;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .search-input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .search-input:focus {
        outline: none;
        border-color: #fbbf24;
        background: rgba(255, 255, 255, 0.15);
    }

    .search-button {
        padding: 1.25rem 2rem;
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        color: #064e3b;
        border: none;
        border-radius: 0 0.75rem 0.75rem 0;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .search-button:hover {
        background: linear-gradient(45deg, #f59e0b, #d97706);
    }

    /* Section Styling */
    .section {
        margin-bottom: 3rem;
    }

    .section-header {
        margin-bottom: 2rem;
        text-align: center;
    }

    .section-title {
        font-size: 2rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }

    .section-title i {
        color: #fbbf24;
    }

    .section-subtitle {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.1rem;
        margin: 0;
    }

    /* Categories Grid */
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1.5rem;
    }

    .category-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        padding: 2rem 1rem;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }

    .category-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.15);
        border-color: #fbbf24;
    }

    .category-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #064e3b;
        font-size: 1.75rem;
        margin-bottom: 0.5rem;
    }

    .category-name {
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
    }

    /* Providers Grid */
    .providers-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
    }

    .provider-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .provider-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .provider-header {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 1rem;
        background: rgba(0, 0, 0, 0.2);
    }

    .provider-availability {
        padding: 0.25rem 0.75rem;
        border-radius: 2rem;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .provider-availability.available {
        background: rgba(34, 197, 94, 0.2);
        color: #86efac;
    }

    .provider-availability.unavailable {
        background: rgba(239, 68, 68, 0.2);
        color: #fca5a5;
    }

    .provider-rating {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        color: #fbbf24;
        font-weight: 600;
    }

    .provider-image {
        height: 200px;
        overflow: hidden;
    }

    .provider-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .provider-card:hover .provider-image img {
        transform: scale(1.05);
    }

    .provider-content {
        padding: 1.5rem;
    }

    .provider-name {
        font-size: 1.25rem;
        font-weight: 600;
        color: white;
        margin-bottom: 1rem;
    }

    .provider-info {
        margin-bottom: 1.5rem;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.5rem;
        color: rgba(255, 255, 255, 0.8);
    }

    .info-item i {
        color: #fbbf24;
        width: 20px;
    }

    .provider-actions {
        display: flex;
        gap: 0.75rem;
    }

    .provider-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .provider-btn.primary {
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        color: #064e3b;
        flex: 1;
    }

    .provider-btn.primary:hover {
        background: linear-gradient(45deg, #f59e0b, #d97706);
    }

    .provider-btn.secondary {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        flex: 1;
    }

    .provider-btn.secondary:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .provider-btn.tertiary {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        padding: 0.75rem;
    }

    .provider-btn.tertiary:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .client-home {
            padding: 0 1rem 2rem;
        }

        .hero-section {
            padding: 2rem 1rem;
        }

        .hero-title {
            font-size: 2rem;
        }

        .search-wrapper {
            flex-direction: column;
        }

        .search-input {
            border-radius: 0.75rem;
            margin-bottom: 1rem;
        }

        .search-button {
            width: 100%;
            border-radius: 0.75rem;
        }

        .providers-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection