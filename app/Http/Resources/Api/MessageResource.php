<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'conversation_id' => $this->conversation_id,
            'expediteur' => [
                'id' => $this->expediteur->id,
                'name' => $this->expediteur->name,
                'role' => $this->expediteur->hasRole('client') ? 'client' : 'prestataire'
            ],
            'destinataire' => [
                'id' => $this->destinataire->id,
                'name' => $this->destinataire->name,
                'role' => $this->destinataire->hasRole('client') ? 'client' : 'prestataire'
            ],
            'contenu' => $this->contenu,
            'lu' => $this->lu,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
