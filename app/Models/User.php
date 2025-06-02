<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Attributs autorisés à être remplis via formulaire.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Ajout du rôle ici
    ];

    /**
     * Attributs cachés quand on convertit en tableau ou JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attributs castés automatiquement.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // -------------------------------
    // Relations
    // -------------------------------

    public function profilPrestataire()
    {
        return $this->hasOne(ProfilPrestataire::class);
    }

    public function profilClient()
    {
        return $this->hasOne(ProfilClient::class);
    }

    // En tant que client
    public function avisDonnes()
    {
        return $this->hasMany(Avis::class, 'client_id');
    }

    // En tant que prestataire
    public function avisRecus()
    {
        return $this->hasMany(Avis::class, 'prestataire_id');
    }

    public function messagesEnvoyes()
    {
        return $this->hasMany(Message::class, 'expediteur_id');
    }

    public function messagesRecus()
    {
        return $this->hasMany(Message::class, 'destinataire_id');
    }

    public function avisLaisses()
    {
        return $this->hasMany(Avis::class, 'client_id');
    }

    // -------------------------------
    // Helpers pour rôle
    // -------------------------------

    public function hasRole($role)
    {
        return $this->roles->contains('name', $role);
    }

    /**
     * Get the user's API token.
     */
    public function createToken($name, $abilities = ['*'])
    {
        return $this->tokens()->create([
            'name' => $name,
            'abilities' => $abilities,
        ]);
    }

    /**
     * Delete the user's API token.
     */
    public function deleteToken($token)
    {
        $this->tokens()->where('token', $token)->delete();
    }

    /**
     * Revoke all of the user's tokens.
     */
    public function deleteAllTokens()
    {
        $this->tokens()->delete();
    }

    public function estClient()
    {
        return $this->hasRole('client');
    }

    public function estPrestataire()
    {
        return $this->hasRole('prestataire');
    }
}
