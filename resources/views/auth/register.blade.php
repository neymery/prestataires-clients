<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <h2>Créer un compte</h2>
    <form method="POST" action="{{ route('register.submit') }}">
        @csrf
        <input type="text" name="name" placeholder="Nom" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required><br>

        <select name="role" required>
            <option value="">Choisir un rôle</option>
            <option value="client">Client</option>
            <option value="prestataire">Prestataire</option>
        </select><br>

        <button type="submit">S'inscrire</button>
    </form>

    @if ($errors->any())
        <div>
            <strong>{{ $errors->first() }}</strong>
        </div>
    @endif
</body>
</html>
