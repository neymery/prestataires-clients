<!-- resources/views/layouts/navigation.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">MonApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            @auth
                <ul class="navbar-nav me-auto">
                    @if (auth()->user()->role === 'client')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('client.home') }}">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('client.profil.edit') }}">Mon Profil</a>
                        </li>
                    @elseif (auth()->user()->role === 'prestataire')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('prestataire.index') }}">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('prestataire.profil.edit') }}">Mon Profil</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('messages.index') }}">Messages</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="navbar-text text-light me-3">
                            {{ Auth::user()->name }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-outline-light btn-sm" type="submit">Déconnexion</button>
                        </form>
                    </li>
                </ul>
            @else
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Connexion</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Inscription</a></li>
                </ul>
            @endauth
        </div>
    </div>
</nav>