<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Message;

class Conversation extends Model
{
    protected $fillable = [
        'expediteur_id',
        'destinataire_id',
        'latest_message_id'
    ];

    public function expediteur()
    {
        return $this->belongsTo(User::class, 'expediteur_id');
    }

    public function destinataire()
    {
        return $this->belongsTo(User::class, 'destinataire_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function latest_message()
    {
        return $this->belongsTo(Message::class, 'latest_message_id');
    }
}
