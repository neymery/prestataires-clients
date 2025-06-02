@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <!-- Header de bienvenue -->
    <div class="welcome-header">
        <div class="welcome-content">
            <h1 class="welcome-title">
                <i class="fas fa-tachometer-alt"></i>
                Bienvenue, {{ Auth::user()->name }}
            </h1>
            <p class="welcome-subtitle">Gérez votre activité et développez votre clientèle</p>
        </div>
        <div class="welcome-actions">
            <a href="{{ route('prestataire.profil.edit') }}" class="action-btn primary">
                <i class="fas fa-user-edit"></i>
                <span>Modifier mon profil</span>
            </a>
        </div>
    </div>

    <!-- Statistiques rapides -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">127</h3>
                <p class="stat-label">Vues du profil</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">8</h3>
                <p class="stat-label">Messages non lus</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-handshake"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">23</h3>
                <p class="stat-label">Projets réalisés</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">4.8</h3>
                <p class="stat-label">Note moyenne</p>
            </div>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="dashboard-grid">
        <!-- Messages récents -->
        <div class="dashboard-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-comments"></i>
                    Messages récents
                </h3>
                <a href="{{ route('messages.index') }}" class="card-link">Voir tout</a>
            </div>
            <div class="card-content">
                <div class="message-list">
                    <div class="message-item">
                        <div class="message-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="message-content">
                            <h4 class="message-sender">Marie Dubois</h4>
                            <p class="message-text">Bonjour, je suis intéressée par vos services...</p>
                            <span class="message-time">Il y a 2h</span>
                        </div>
                        <div class="message-status unread"></div>
                    </div>

                    <div class="message-item">
                        <div class="message-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="message-content">
                            <h4 class="message-sender">Pierre Martin</h4>
                            <p class="message-text">Merci pour votre excellent travail !</p>
                            <span class="message-time">Hier</span>
                        </div>
                    </div>

                    <div class="message-item">
                        <div class="message-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="message-content">
                            <h4 class="message-sender">Sophie Laurent</h4>
                            <p class="message-text">Pouvez-vous me faire un devis pour...</p>
                            <span class="message-time">Il y a 2 jours</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="dashboard-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bolt"></i>
                    Actions rapides
                </h3>
            </div>
            <div class="card-content">
                <div class="quick-actions">
                    <a href="{{ route('prestataire.profil.edit') }}" class="quick-action">
                        <div class="action-icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <span>Modifier mon profil</span>
                    </a>

                    <a href="{{ route('messages.index') }}" class="quick-action">
                        <div class="action-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <span>Voir mes messages</span>
                    </a>

                    <a href="#" class="quick-action">
                        <div class="action-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <span>Gérer mes services</span>
                    </a>

                    <a href="#" class="quick-action">
                        <div class="action-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <span>Voir les statistiques</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Statut du profil -->
        <div class="dashboard-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-check-circle"></i>
                    Statut du profil
                </h3>
            </div>
            <div class="card-content">
                <div class="profile-status">
                    <div class="status-item completed">
                        <i class="fas fa-check"></i>
                        <span>Informations de base</span>
                    </div>
                    <div class="status-item completed">
                        <i class="fas fa-check"></i>
                        <span>Photo de profil</span>
                    </div>
                    <div class="status-item completed">
                        <i class="fas fa-check"></i>
                        <span>Description des services</span>
                    </div>
                    <div class="status-item pending">
                        <i class="fas fa-clock"></i>
                        <span>Vérification du compte</span>
                    </div>
                </div>
                <div class="profile-completion">
                    <div class="completion-bar">
                        <div class="completion-progress" style="width: 75%"></div>
                    </div>
                    <p class="completion-text">Profil complété à 75%</p>
                </div>
            </div>
        </div>

        <!-- Conseils -->
        <div class="dashboard-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-lightbulb"></i>
                    Conseils pour réussir
                </h3>
            </div>
            <div class="card-content">
                <div class="tips-list">
                    <div class="tip-item">
                        <i class="fas fa-star"></i>
                        <p>Complétez votre profil pour attirer plus de clients</p>
                    </div>
                    <div class="tip-item">
                        <i class="fas fa-clock"></i>
                        <p>Répondez rapidement aux messages pour améliorer votre réputation</p>
                    </div>
                    <div class="tip-item">
                        <i class="fas fa-camera"></i>
                        <p>Ajoutez des photos de vos réalisations</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Header de bienvenue */
    .welcome-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        padding: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .welcome-title {
        font-size: 2rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .welcome-title i {
        color: #fbbf24;
    }

    .welcome-subtitle {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.1rem;
        margin: 0;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .action-btn.primary {
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        color: #064e3b;
    }

    .action-btn.primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
    }

    /* Grille de statistiques */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        padding: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
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

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: white;
        margin: 0;
    }

    .stat-label {
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
        font-size: 0.9rem;
    }

    /* Grille du dashboard */
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 2rem;
    }

    .dashboard-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
    }

    .card-header {
        padding: 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: white;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-title i {
        color: #fbbf24;
    }

    .card-link {
        color: #fbbf24;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .card-link:hover {
        color: #f59e0b;
    }

    .card-content {
        padding: 1.5rem;
    }

    /* Messages */
    .message-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .message-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 0.5rem;
        position: relative;
    }

    .message-avatar {
        width: 40px;
        height: 40px;
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #064e3b;
    }

    .message-content {
        flex: 1;
    }

    .message-sender {
        color: white;
        font-size: 0.95rem;
        font-weight: 600;
        margin: 0 0 0.25rem 0;
    }

    .message-text {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        margin: 0 0 0.25rem 0;
    }

    .message-time {
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.8rem;
    }

    .message-status.unread {
        width: 8px;
        height: 8px;
        background: #ef4444;
        border-radius: 50%;
        position: absolute;
        top: 1rem;
        right: 1rem;
    }

    /* Actions rapides */
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .quick-action {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        padding: 1.5rem;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 0.75rem;
        text-decoration: none;
        color: white;
        transition: all 0.3s ease;
        text-align: center;
    }

    .quick-action:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }

    .action-icon {
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

    /* Statut du profil */
    .profile-status {
        margin-bottom: 1.5rem;
    }

    .status-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 0;
        color: white;
    }

    .status-item.completed i {
        color: #22c55e;
    }

    .status-item.pending i {
        color: #f59e0b;
    }

    .completion-bar {
        width: 100%;
        height: 8px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 0.5rem;
    }

    .completion-progress {
        height: 100%;
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        transition: width 0.3s ease;
    }

    .completion-text {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        margin: 0;
    }

    /* Conseils */
    .tips-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .tip-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 0.5rem;
    }

    .tip-item i {
        color: #fbbf24;
        margin-top: 0.25rem;
    }

    .tip-item p {
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 1rem;
        }

        .welcome-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .quick-actions {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection