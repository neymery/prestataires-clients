<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription - PrestaConnect</title>
    
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
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        
        .register-container {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(15px);
            border-radius: 1.5rem;
            padding: 3rem;
            width: 100%;
            max-width: 550px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }
        
        .logo-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        
        .logo {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.75rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
        }
        
        .logo i {
            color: #fbbf24;
            font-size: 2.25rem;
        }
        
        .logo-subtitle {
            color: rgba(236, 253, 245, 0.7);
            font-size: 0.95rem;
            font-weight: 400;
        }
        
        .form-title {
            text-align: center;
            color: #fbbf24;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .form-group label {
            display: block;
            color: rgba(236, 253, 245, 0.9);
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .input-wrapper i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(251, 191, 36, 0.7);
            font-size: 1.1rem;
        }
        
        .form-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            color: white;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .form-input:focus {
            outline: none;
            border-color: #fbbf24;
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
        }
        
        .form-select {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            color: white;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23fbbf24' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: calc(100% - 1rem) center;
            padding-right: 2.5rem;
            backdrop-filter: blur(10px);
        }
        
        .form-select:focus {
            outline: none;
            border-color: #fbbf24;
            background-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
        }
        
        .form-select option {
            background-color: #064e3b;
            color: white;
        }
        
        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(45deg, #fbbf24, #f59e0b);
            color: #064e3b;
            border: none;
            border-radius: 0.75rem;
            font-size: 1.1rem;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
            margin-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .submit-btn:hover {
            background: linear-gradient(45deg, #f59e0b, #d97706);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(251, 191, 36, 0.4);
        }
        
        .submit-btn:active {
            transform: translateY(0);
        }
        
        .error-message {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 0.75rem;
            padding: 1rem;
            margin-top: 1.5rem;
            color: #fca5a5;
            font-size: 0.9rem;
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .error-message i {
            color: #ef4444;
        }
        
        .form-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .form-footer a {
            color: #fbbf24;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .form-footer a:hover {
            color: #f59e0b;
        }
        
        .back-link {
            position: absolute;
            top: 2rem;
            left: 2rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            background: rgba(0, 0, 0, 0.2);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            backdrop-filter: blur(10px);
        }
        
        .back-link:hover {
            color: #fbbf24;
            background: rgba(0, 0, 0, 0.3);
        }
        
        .role-cards {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .role-card {
            flex: 1;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .role-card.active {
            border-color: #fbbf24;
            background: rgba(251, 191, 36, 0.1);
        }
        
        .role-card:hover:not(.active) {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.2);
        }
        
        .role-icon {
            font-size: 2rem;
            color: #fbbf24;
            margin-bottom: 1rem;
        }
        
        .role-title {
            color: white;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .role-description {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .register-container {
                padding: 2rem 1.5rem;
            }
            
            .back-link {
                position: static;
                margin-bottom: 2rem;
                align-self: flex-start;
            }
            
            body {
                align-items: flex-start;
                padding-top: 2rem;
            }
            
            .role-cards {
                flex-direction: column;
            }
        }
        
        /* Animation d'entrée */
        .register-container {
            animation: slideIn 0.6s ease-out;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des cartes de rôle
            const roleCards = document.querySelectorAll('.role-card');
            const roleSelect = document.getElementById('role');
            
            roleCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Retirer la classe active de toutes les cartes
                    roleCards.forEach(c => c.classList.remove('active'));
                    
                    // Ajouter la classe active à la carte cliquée
                    this.classList.add('active');
                    
                    // Mettre à jour la valeur du select
                    roleSelect.value = this.dataset.role;
                });
            });
        });
    </script>
</head>
<body>
    <!-- Lien de retour -->
    <a href="{{ url('/') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Retour à l'accueil
    </a>

    <div class="register-container">
        <!-- Logo et titre -->
        <div class="logo-section">
            <div class="logo">
                <i class="fas fa-handshake"></i>
                <span>PrestaConnect</span>
            </div>
            <p class="logo-subtitle">Créez votre compte en quelques étapes</p>
        </div>

        <h2 class="form-title">Inscription</h2>

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf
            
            <div class="form-group">
                <label for="name">Nom complet</label>
                <div class="input-wrapper">
                    <i class="fas fa-user"></i>
                    <input 
                        type="text" 
                        id="name"
                        name="name" 
                        class="form-input"
                        placeholder="Votre nom" 
                        value="{{ old('name') }}"
                        required
                        autocomplete="name"
                        autofocus
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="email">Adresse email</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input 
                        type="email" 
                        id="email"
                        name="email" 
                        class="form-input"
                        placeholder="votre@email.com" 
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input 
                        type="password" 
                        id="password"
                        name="password" 
                        class="form-input"
                        placeholder="••••••••" 
                        required
                        autocomplete="new-password"
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input 
                        type="password" 
                        id="password_confirmation"
                        name="password_confirmation" 
                        class="form-input"
                        placeholder="••••••••" 
                        required
                        autocomplete="new-password"
                    >
                </div>
            </div>

            <div class="form-group">
                <label>Choisissez votre rôle</label>
                <div class="role-cards">
                    <div class="role-card" data-role="client">
                        <div class="role-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h3 class="role-title">Client</h3>
                        <p class="role-description">Je cherche des prestataires pour mes projets</p>
                    </div>
                    
                    <div class="role-card" data-role="prestataire">
                        <div class="role-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h3 class="role-title">Prestataire</h3>
                        <p class="role-description">Je propose mes services professionnels</p>
                    </div>
                </div>
                
                <div class="input-wrapper">
                    <i class="fas fa-user-tag"></i>
                    <select 
                        id="role"
                        name="role" 
                        class="form-select"
                        required
                    >
                        <option value="">Choisir un rôle</option>
                        <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Client</option>
                        <option value="prestataire" {{ old('role') == 'prestataire' ? 'selected' : '' }}>Prestataire</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="submit-btn">
                <i class="fas fa-user-plus"></i>
                Créer mon compte
            </button>
        </form>

        @if ($errors->any())
            <div class="error-message">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>{{ $errors->first() }}</strong>
            </div>
        @endif

        <div class="form-footer">
            <p style="color: rgba(255, 255, 255, 0.7); margin-bottom: 1rem;">
                Vous avez déjà un compte ?
            </p>
            <a href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt"></i>
                Se connecter
            </a>
        </div>
    </div>
</body>
</html>