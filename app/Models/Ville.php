<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $fillable = [
        'nom'
    ];

    public function prestataires()
    {
        return $this->hasMany(ProfilPrestataire::class);
    }
}
