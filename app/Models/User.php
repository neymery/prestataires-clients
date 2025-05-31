<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    public function profilPrestataire()
    {
        return $this->hasOne(ProfilPrestataire::class);
    }




    public function profilClient()
    {
        return $this->hasOne(ProfilClient::class);
    }



    // En tant que client
    public function avisDonnes() {
        return $this->hasMany(Avis::class, 'client_id');
    }

    // En tant que prestataire
    public function avisRecus() {
        return $this->hasMany(Avis::class, 'prestataire_id');
    }




    public function messagesEnvoyes() {
        return $this->hasMany(Message::class, 'expediteur_id');
    }
    
    public function messagesRecus() {
        return $this->hasMany(Message::class, 'destinataire_id');
    }

 

    public function avisLaisses()
    {
        return $this->hasMany(Avis::class, 'client_id');
    }

    



}
