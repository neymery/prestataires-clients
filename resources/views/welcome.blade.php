<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prestataires & Clients</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #064e3b 0%, #0f766e 50%, #d97706 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Header avec navigation */
        .header {
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
        }
        
        .logo i {
            color: #fbbf24;
            font-size: 2rem;
        }
        
        .nav-buttons {
            display: flex;
            gap: 1rem;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-outline {
            background: transparent;
            color: #fef3c7;
            border: 2px solid rgba(251, 191, 36, 0.4);
        }
        
        .btn-outline:hover {
            background: rgba(251, 191, 36, 0.1);
            border-color: rgba(251, 191, 36, 0.6);
            transform: translateY(-2px);
        }
        
        .btn-primary {
            background: #fbbf24;
            color: #064e3b;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .btn-primary:hover {
            background: #f59e0b;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }
        
        .dashboard-link {
            background: linear-gradient(45deg, #f59e0b, #ea580c);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .dashboard-link:hover {
            background: linear-gradient(45deg, #d97706, #dc2626);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }
        
        /* Section principale */
        .hero-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            text-align: center;
        }
        
        .hero-content {
            max-width: 1200px;
            color: white;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            background: linear-gradient(45deg, #fbbf24, #ffffff, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.1;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 3rem;
            color: rgba(236, 253, 245, 0.9);
            line-height: 1.6;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 4rem;
        }
        
        .feature-card {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            padding: 2rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            background: rgba(0, 0, 0, 0.3);
            border-color: rgba(251, 191, 36, 0.3);
        }
        
        .feature-icon {
            width: 64px;
            height: 64px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .feature-card:hover .feature-icon {
            transform: scale(1.1);
        }
        
        .feature-icon.search {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
        }
        
        .feature-icon.communication {
            background: linear-gradient(135deg, #10b981, #14b8a6);
        }
        
        .feature-icon.security {
            background: linear-gradient(135deg, #14b8a6, #059669);
        }
        
        .feature-icon i {
            font-size: 1.5rem;
            color: #064e3b;
        }
        
        .feature-icon.security i {
            color: white;
        }
        
        .feature-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: #fbbf24;
        }
        
        .feature-description {
            color: rgba(236, 253, 245, 0.8);
            line-height: 1.6;
        }
        
        /* CTA Section */
        .cta-section {
            margin-top: 4rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }
        
        .btn-cta-primary {
            background: linear-gradient(45deg, #fbbf24, #f59e0b);
            color: #064e3b;
            padding: 1rem 2rem;
            border-radius: 0.75rem;
            font-size: 1.1rem;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        
        .btn-cta-primary:hover {
            background: linear-gradient(45deg, #f59e0b, #d97706);
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }
        
        .btn-cta-secondary {
            background: transparent;
            color: #10b981;
            border: 2px solid rgba(16, 185, 129, 0.4);
            padding: 1rem 2rem;
            border-radius: 0.75rem;
            font-size: 1.1rem;
            font-weight: 500;
            backdrop-filter: blur(10px);
        }
        
        .btn-cta-secondary:hover {
            background: rgba(16, 185, 129, 0.1);
            border-color: rgba(16, 185, 129, 0.6);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .header {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
            }
            
            .nav-buttons {
                flex-direction: row;
                gap: 0.5rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                margin-top: 2rem;
            }
            
            .cta-section {
                flex-direction: column;
                gap: 1rem;
            }
        }
        
        @media (min-width: 640px) {
            .cta-section {
                flex-direction: row;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header avec navigation -->
    <header class="header">
        <div class="logo">
            <i class="fas fa-handshake"></i>
            <span>PrestaConnect</span>
        </div>
        
        @if (Route::has('login'))
            <nav class="nav-buttons">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn dashboard-link">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">
                        <i class="fas fa-sign-in-alt"></i> Connexion
                    </a>
                    
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            <i class="fas fa-user-plus"></i> S'inscrire
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>
    
    <!-- Section principale -->
    <main class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">
                Connectez Prestataires & Clients
            </h1>
            
            <p class="hero-subtitle">
                La plateforme qui simplifie la mise en relation entre professionnels et clients. 
                Trouvez le bon prestataire ou développez votre clientèle en quelques clics.
            </p>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon search">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="feature-title">Recherche Facile</h3>
                    <p class="feature-description">
                        Trouvez rapidement le prestataire qui correspond à vos besoins grâce à notre système de recherche avancé.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon communication">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 class="feature-title">Communication Directe</h3>
                    <p class="feature-description">
                        Échangez directement avec les prestataires via notre système de messagerie intégré.
                    </p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon security">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">Sécurisé & Fiable</h3>
                    <p class="feature-description">
                        Plateforme sécurisée avec système de notation et d'avis pour garantir la qualité des services.
                    </p>
                </div>
            </div>
            
            <!-- Section CTA -->
            <div class="cta-section">
                <a href="{{ route('register') }}" class="btn btn-cta-primary">
                    <i class="fas fa-users"></i> Rejoindre la communauté
                </a>
                <a href="/about" class="btn btn-cta-secondary">
                    En savoir plus
                </a>
            </div>
        </div>
    </main>
</body>
</html>