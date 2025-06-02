@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Envoyer un message à {{ $destinataire->name }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('messages.store') }}" method="POST" class="message-form" id="messageForm">
                @csrf
                
                <input type="hidden" name="destinataire_id" value="{{ $destinataire->id }}">
                
                <div class="mb-3">
                    <label for="contenu" class="form-label">Message :</label>
                    <textarea name="contenu" id="contenu" class="form-control" rows="4" required>{{ old('contenu') }}</textarea>
                    <div class="character-count">
                        <span class="current-count">0</span>
                        <span class="max-count">/1000 caractères</span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary message-submit-btn" id="sendMessage">
                    <i class="fas fa-paper-plane"></i>
                    Envoyer
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .container {
        padding: 2rem 1rem;
        max-width: 800px;
        margin: 0 auto;
    }

    .card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card-header {
        background: rgba(0, 0, 0, 0.2);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding: 1.5rem;
    }

    .card-header h2 {
        color: white;
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
    }

    .card-body {
        padding: 2rem;
    }

    .mb-3 {
        margin-bottom: 2rem;
    }

    .form-label {
        color: white;
        font-size: 1.1rem;
        font-weight: 500;
        margin-bottom: 0.75rem;
        display: block;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 0.75rem;
        color: white;
        font-size: 1rem;
        padding: 1rem;
        min-height: 150px;
        transition: all 0.3s ease;
        resize: vertical;
        width: 100%;
    }

    .form-control:focus {
        outline: none;
        border-color: #fbbf24;
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1);
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .btn {
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        color: #064e3b;
        border: none;
        border-radius: 0.75rem;
        font-size: 1rem;
        font-weight: 600;
        padding: 0.75rem 2rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn:hover {
        background: linear-gradient(45deg, #f59e0b, #d97706);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
        color: #064e3b;
    }

    .btn:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.3);
    }

    .message-submit-btn {
        background: linear-gradient(45deg, #fbbf24, #f59e0b);
        color: #064e3b;
        border: none;
        border-radius: 0.75rem;
        font-size: 1rem;
        font-weight: 600;
        padding: 0.75rem 2rem;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
    }

    .message-submit-btn:hover {
        background: linear-gradient(45deg, #f59e0b, #d97706);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
    }

    .message-submit-btn:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.3);
    }

    .character-count {
        text-align: right;
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.6);
        margin-top: 0.5rem;
    }

    .current-count {
        color: #fbbf24;
        font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }
        
        .card-header {
            padding: 1rem;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .btn {
            width: 100%;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('contenu');
        const currentCount = document.querySelector('.current-count');
        const sendBtn = document.getElementById('sendMessage');
        const form = document.getElementById('messageForm');

        // Compteur de caractères
        if (textarea && currentCount) {
            function updateCharacterCount() {
                const length = textarea.value.length;
                currentCount.textContent = length;
                
                // Changer la couleur selon la limite
                if (length > 900) {
                    currentCount.style.color = '#ef4444';
                } else if (length > 800) {
                    currentCount.style.color = '#f59e0b';
                } else {
                    currentCount.style.color = '#fbbf24';
                }
                
                // Limiter à 1000 caractères
                if (length > 1000) {
                    textarea.value = textarea.value.substring(0, 1000);
                    currentCount.textContent = 1000;
                }
            }

            textarea.addEventListener('input', updateCharacterCount);
            
            // Initialiser le compteur
            updateCharacterCount();
        }

        // Validation et soumission du formulaire
        if (form) {
            form.addEventListener('submit', function(e) {
                const content = textarea.value.trim();
                
                if (content.length < 10) {
                    e.preventDefault();
                    alert('Votre message doit contenir au moins 10 caractères.');
                    textarea.focus();
                    return;
                }
                
                // Animation du bouton de soumission
                sendBtn.style.transform = 'scale(0.95)';
                sendBtn.disabled = true;
                
                setTimeout(() => {
                    if (!form.querySelector('.error-message')) {
                        sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Envoi en cours...</span>';
                    }
                }, 100);
            });
        }

        // Auto-resize du textarea
        if (textarea) {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.max(150, this.scrollHeight) + 'px';
            });
        }
    });
</script>
@endsection
