<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'expediteur_id',
        'destinataire_id',
        'contenu',
        'lu',
        'conversation_id'
    ];

    public function expediteur() {
        return $this->belongsTo(User::class, 'expediteur_id');
    }
    
    public function destinataire() {
        return $this->belongsTo(User::class, 'destinataire_id');
    }
    
    public function conversation() {
        return $this->belongsTo(Conversation::class);
    }

   

}
