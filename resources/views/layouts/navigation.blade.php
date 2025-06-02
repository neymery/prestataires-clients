<!-- resources/views/layouts/navigation.blade.php -->
<nav class="custom-navbar">
    <div class="navbar-container">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="navbar-logo">
            <i class="fas fa-handshake"></i>
            <span>PrestaConnect</span>
        </a>

        <!-- Menu burger pour mobile -->
        <div class="navbar-toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>

        <!-- Navigation principale -->
        <ul class="navbar-menu" id="nav-menu">
            @auth
                @if (auth()->user()->role === 'client')
                    <li class="nav-item">
                        <a href="{{ route('client.home') }}" class="nav-link">
                            <i class="fas fa-home"></i>
                            <span>Accueil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('client.profil.edit') }}" class="nav-link">
                            <i class="fas fa-user-edit"></i>
                            <span>Mon Profil</span>
                        </a>
                    </li>
                @elseif (auth()->user()->role === 'prestataire')
                    <li class="nav-item">
                        <a href="{{ route('prestataire.index') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Accueil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('prestataire.profil.edit') }}" class="nav-link">
                            <i class="fas fa-user-cog"></i>
                            <span>Mon Profil</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('messages.index') }}" class="nav-link">
                        <i class="fas fa-envelope"></i>
                        <span>Messages</span>
                        <span class="message-badge">3</span>
                    </a>
                </li>
            @endauth
        </ul>

        <!-- Section utilisateur -->
        <div class="navbar-right">
            @auth
                <div class="user-menu">
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="user-role">{{ ucfirst(Auth::user()->role) }}</span>
                    </div>
                    <div class="user-avatar" id="user-dropdown-btn">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="dropdown-menu" id="dropdown-content">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Déconnexion</span>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="auth-buttons">
                    <a href="{{ route('login') }}" class="auth-btn login-btn">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Connexion</span>
                    </a>
                    <a href="{{ route('register') }}" class="auth-btn register-btn">
                        <i class="fas fa-user-plus"></i>
                        <span>Inscription</span>
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<style>
    /* Import de la police Poppins */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    /* Variables pour les couleurs (identiques à la page register) */
    :root {
        --emerald-900: #064e3b;
        --emerald-800: #065f46;
        --teal-700: #0f766e;
        --amber-500: #f59e0b;
        --amber-400: #fbbf24;
        --amber-600: #d97706;
        --white: #ffffff;
        --white-90: rgba(255, 255, 255, 0.9);
        --white-80: rgba(255, 255, 255, 0.8);
        --white-70: rgba(255, 255, 255, 0.7);
        --white-50: rgba(255, 255, 255, 0.5);
        --white-20: rgba(255, 255, 255, 0.2);
        --white-15: rgba(255, 255, 255, 0.15);
        --white-10: rgba(255, 255, 255, 0.1);
        --black-20: rgba(0, 0, 0, 0.2);
        --black-30: rgba(0, 0, 0, 0.3);
        --red-500: #ef4444;
        --red-bg: rgba(239, 68, 68, 0.1);
    }

    /* Reset et body avec même gradient que register */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #064e3b 0%, #0f766e 50%, #d97706 100%);
        min-height: 100vh;
    }

    /* Styles de base de la navbar */
    .custom-navbar {
        background: var(--black-20);
        backdrop-filter: blur(15px);
        border-bottom: 1px solid var(--white-10);
        padding: 1rem 0;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
    }

    .navbar-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Logo avec même style que register */
    .navbar-logo {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
        color: var(--white);
        font-size: 1.75rem;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .navbar-logo i {
        color: var(--amber-400);
        font-size: 2.25rem;
    }

    .navbar-logo:hover {
        transform: translateY(-2px);
    }

    .navbar-logo:hover i {
        color: var(--amber-500);
    }

    /* Menu principal avec style glassmorphism */
    .navbar-menu {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 0.5rem;
    }

    .nav-item {
        position: relative;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        color: var(--white-90);
        text-decoration: none;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 0.95rem;
        background: var(--white-10);
        border: 1px solid var(--white-10);
        backdrop-filter: blur(10px);
    }

    .nav-link i {
        color: var(--amber-400);
        font-size: 1.1rem;
    }

    .nav-link:hover {
        background: var(--white-15);
        border-color: var(--white-20);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.1);
    }

    .nav-link.active {
        background: rgba(251, 191, 36, 0.1);
        border-color: var(--amber-400);
        color: var(--amber-400);
    }

    /* Badge pour les messages avec style amélioré */
    .message-badge {
        background: linear-gradient(45deg, var(--red-500), #dc2626);
        color: var(--white);
        font-size: 0.7rem;
        padding: 0.2rem 0.5rem;
        border-radius: 50px;
        margin-left: 0.5rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }

    /* Section utilisateur */
    .navbar-right {
        display: flex;
        align-items: center;
    }

    .user-menu {
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
    }

    .user-info {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .user-name {
        color: var(--white);
        font-weight: 600;
        font-size: 0.95rem;
    }

    .user-role {
        color: var(--white-70);
        font-size: 0.8rem;
        font-weight: 400;
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        background: linear-gradient(45deg, var(--amber-400), var(--amber-500));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
    }

    .user-avatar i {
        color: var(--emerald-900);
        font-size: 1.3rem;
        font-weight: 600;
    }

    .user-avatar:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 25px rgba(251, 191, 36, 0.4);
    }

    /* Menu déroulant avec style glassmorphism */
    .dropdown-menu {
        position: absolute;
        top: calc(100% + 0.75rem);
        right: 0;
        background: var(--black-20);
        backdrop-filter: blur(15px);
        border: 1px solid var(--white-10);
        border-radius: 0.75rem;
        padding: 0.75rem;
        min-width: 220px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    }

    .dropdown-menu.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 1.25rem;
        color: var(--white-90);
        background: none;
        border: none;
        border-radius: 0.5rem;
        width: 100%;
        text-align: left;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
        font-size: 0.95rem;
        font-weight: 500;
    }

    .dropdown-item i {
        color: var(--red-500);
        font-size: 1.1rem;
    }

    .dropdown-item:hover {
        background: var(--red-bg);
        color: var(--white);
    }

    /* Boutons d'authentification avec style register */
    .auth-buttons {
        display: flex;
        gap: 1rem;
    }

    .auth-btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .login-btn {
        color: var(--white-90);
        background: var(--white-10);
        border: 2px solid var(--white-10);
    }

    .login-btn:hover {
        background: var(--white-15);
        border-color: var(--white-20);
        transform: translateY(-2px);
    }

    .login-btn i {
        color: var(--amber-400);
    }

    .register-btn {
        background: linear-gradient(45deg, var(--amber-400), var(--amber-500));
        color: var(--emerald-900);
        font-weight: 600;
        border: 2px solid transparent;
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
    }

    .register-btn:hover {
        background: linear-gradient(45deg, var(--amber-500), var(--amber-600));
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(251, 191, 36, 0.4);
    }

    /* Menu burger avec style amélioré */
    .navbar-toggle {
        display: none;
        flex-direction: column;
        cursor: pointer;
        gap: 0.25rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
        background: var(--white-10);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .navbar-toggle:hover {
        background: var(--white-15);
    }

    .bar {
        width: 25px;
        height: 3px;
        background-color: var(--amber-400);
        border-radius: 2px;
        transition: 0.3s;
    }

    /* Animation d'entrée de la navbar */
    .custom-navbar {
        animation: slideDown 0.6s ease-out;
    }

    @keyframes slideDown {
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
    @media screen and (max-width: 768px) {
        .navbar-container {
            padding: 0 1rem;
        }

        .navbar-toggle {
            display: flex;
            order: 3;
        }

        .navbar-menu {
            position: fixed;
            left: -100%;
            top: 85px;
            flex-direction: column;
            background: var(--black-20);
            backdrop-filter: blur(15px);
            width: 100%;
            text-align: center;
            transition: 0.3s;
            box-shadow: 0 10px 27px rgba(0, 0, 0, 0.2);
            padding: 2rem 1rem;
            gap: 1rem;
            border-top: 1px solid var(--white-10);
        }

        .navbar-menu.active {
            left: 0;
        }

        .nav-item {
            margin: 0;
            width: 100%;
        }

        .nav-link {
            justify-content: center;
            width: 100%;
            padding: 1rem 1.5rem;
        }

        .navbar-right {
            order: 2;
        }

        .user-info {
            display: none;
        }

        .auth-buttons {
            flex-direction: column;
            gap: 0.75rem;
        }

        .auth-btn {
            padding: 0.75rem 1.25rem;
            font-size: 0.9rem;
        }

        .navbar-toggle.active .bar:nth-child(2) {
            opacity: 0;
        }

        .navbar-toggle.active .bar:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }

        .navbar-toggle.active .bar:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }

        .navbar-logo {
            font-size: 1.5rem;
        }

        .navbar-logo i {
            font-size: 1.75rem;
        }
    }

    @media screen and (max-width: 480px) {
        .navbar-container {
            padding: 0 0.75rem;
        }

        .navbar-logo span {
            display: none;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menu mobile
        const mobileMenu = document.getElementById('mobile-menu');
        const navMenu = document.getElementById('nav-menu');
        
        if (mobileMenu) {
            mobileMenu.addEventListener('click', function() {
                mobileMenu.classList.toggle('active');
                navMenu.classList.toggle('active');
            });
        }

        // Dropdown utilisateur
        const userBtn = document.getElementById('user-dropdown-btn');
        const dropdownContent = document.getElementById('dropdown-content');
        
        if (userBtn) {
            userBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownContent.classList.toggle('show');
            });

            // Fermer le dropdown en cliquant ailleurs
            document.addEventListener('click', function() {
                dropdownContent.classList.remove('show');
            });
        }

        // Marquer le lien actif
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-link');
        
        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });

        // Animation au scroll pour la navbar
        let lastScrollTop = 0;
        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const navbar = document.querySelector('.custom-navbar');
            
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                // Scroll vers le bas
                navbar.style.transform = 'translateY(-100%)';
            } else {
                // Scroll vers le haut
                navbar.style.transform = 'translateY(0)';
            }
            lastScrollTop = scrollTop;
        });
    });
</script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">