<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPrestataire extends Model
{
    protected $fillable = [
        'user_id',
        'categorie_id',
        'photo',
        'bio',
        'telephone',
        'disponible',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

}
