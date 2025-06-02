<section>
    <header>
        <h2 class="section-title" style="color: #ef4444;">
            <i class="fas fa-exclamation-triangle"></i>
            {{ __('Supprimer le compte') }}
        </h2>

        <p class="section-description">
            {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.') }}
        </p>
    </header>

    <button type="button" class="form-button danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        <i class="fas fa-trash-alt"></i>
        {{ __('Supprimer le compte') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="modal-form">
            @csrf
            @method('delete')

            <h2 class="modal-title">
                {{ __('Êtes-vous sûr de vouloir supprimer votre compte?') }}
            </h2>

            <p class="modal-description">
                {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Veuillez entrer votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.') }}
            </p>

            <div class="form-group">
                <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                <input id="password" name="password" type="password" class="form-input" placeholder="{{ __('Mot de passe') }}" />
                @error('password', 'userDeletion')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="modal-actions">
                <button type="button" class="form-button cancel" x-on:click="$dispatch('close')">
                    {{ __('Annuler') }}
                </button>

                <button type="submit" class="form-button danger">
                    <i class="fas fa-trash-alt"></i>
                    {{ __('Supprimer le compte') }}
                </button>
            </div>
        </form>
    </x-modal>

    <style>
        .modal-form {
            padding: 2rem;
        }

        .modal-title {
            color: #ef4444;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .modal-description {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
        }
    </style>
</section>