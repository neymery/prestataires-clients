<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilClient extends Model
{
    protected $fillable = [
        'user_id',
        'nom',
        'telephone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
