<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Avis extends Model
{
    protected $fillable = [
        'client_id',
        'prestataire_id',
        'note',
        'commentaire',
    ];

    public function client() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function prestataire() {
        return $this->belongsTo(User::class, 'prestataire_id');
    }   


    
    
}
