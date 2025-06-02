<section>
    <header>
        <h2 class="section-title">
            <i class="fas fa-lock"></i>
            {{ __('Mettre à jour le mot de passe') }}
        </h2>

        <p class="section-description">
            {{ __('Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="profile-form">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="current_password" class="form-label">{{ __('Mot de passe actuel') }}</label>
            <input id="current_password" name="current_password" type="password" class="form-input" autocomplete="current-password" />
            @error('current_password')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">{{ __('Nouveau mot de passe') }}</label>
            <input id="password" name="password" type="password" class="form-input" autocomplete="new-password" />
            @error('password')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">{{ __('Confirmer le mot de passe') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-input" autocomplete="new-password" />
            @error('password_confirmation')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="form-button">
                <i class="fas fa-save"></i>
                {{ __('Enregistrer') }}
            </button>

            @if (session('status') === 'password-updated')
                <p class="update-success">
                    {{ __('Enregistré.') }}
                </p>
            @endif
        </div>
    </form>
</section>