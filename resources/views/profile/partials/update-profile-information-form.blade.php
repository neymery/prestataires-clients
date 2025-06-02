<section>
    <header>
        <h2 class="section-title">
            <i class="fas fa-user-edit"></i>
            {{ __('Informations du profil') }}
        </h2>

        <p class="section-description">
            {{ __("Mettez à jour les informations de votre profil et votre adresse email.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="profile-form">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name" class="form-label">{{ __('Nom') }}</label>
            <input id="name" name="name" type="text" class="form-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-input" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
                <p class="form-error">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="verification-notice">
                    <p class="verification-text">
                        {{ __('Votre adresse email n\'est pas vérifiée.') }}

                        <button form="send-verification" class="verification-button">
                            {{ __('Cliquez ici pour renvoyer l\'email de vérification.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="verification-sent">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse email.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="form-actions">
            <button type="submit" class="form-button">
                <i class="fas fa-save"></i>
                {{ __('Enregistrer') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p class="update-success">
                    {{ __('Enregistré.') }}
                </p>
            @endif
        </div>
    </form>

    <style>
        .verification-notice {
            margin-top: 1rem;
            padding: 1rem;
            background: rgba(251, 191, 36, 0.1);
            border: 1px solid rgba(251, 191, 36, 0.3);
            border-radius: 0.5rem;
        }

        .verification-text {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .verification-button {
            background: none;
            border: none;
            color: #fbbf24;
            text-decoration: underline;
            cursor: pointer;
            padding: 0;
            font-size: 0.9rem;
            margin-left: 0.5rem;
        }

        .verification-button:hover {
            color: #f59e0b;
        }

        .verification-sent {
            color: #86efac;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .form-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .update-success {
            color: #86efac;
            font-size: 0.9rem;
            animation: fadeOut 2s forwards;
            animation-delay: 3s;
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
    </style>
</section>