<x-app-layout>
    <div class="profile-header">
        <div class="container">
            <h2 class="profile-title">
                <i class="fas fa-user-circle"></i> {{ __('Profile') }}
            </h2>
        </div>
    </div>

    <div class="profile-content">
        <div class="container">
            <div class="profile-card">
                <div class="card-content">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="profile-card">
                <div class="card-content">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="profile-card danger-zone">
                <div class="card-content">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <style>
        .profile-header {
            padding: 2rem 0 1rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .profile-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .profile-title i {
            color: #fbbf24;
        }

        .profile-content {
            padding-bottom: 3rem;
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .card-content {
            padding: 2rem;
        }

        .danger-zone {
            background: rgba(239, 68, 68, 0.05);
            border-color: rgba(239, 68, 68, 0.2);
        }

        /* Styles pour les formulaires */
        .section-title {
            color: #fbbf24;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-description {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: white;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #fbbf24;
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-error {
            color: #fca5a5;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .form-button {
            padding: 0.75rem 1.5rem;
            background: linear-gradient(45deg, #fbbf24, #f59e0b);
            color: #064e3b;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-button:hover {
            background: linear-gradient(45deg, #f59e0b, #d97706);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
        }

        .form-button.cancel {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .form-button.cancel:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .form-button.danger {
            background: linear-gradient(45deg, #ef4444, #dc2626);
            color: white;
        }

        .form-button.danger:hover {
            background: linear-gradient(45deg, #dc2626, #b91c1c);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 0 1rem;
            }
            
            .card-content {
                padding: 1.5rem;
            }
        }
    </style>
</x-app-layout>