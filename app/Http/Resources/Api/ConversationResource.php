<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    public function toArray($request)
    {
        $user = $request->user();
        
        return [
            'id' => $this->id,
            'expediteur' => $this->expediteur_id == $user->id 
                ? null 
                : [
                    'id' => $this->expediteur->id,
                    'name' => $this->expediteur->name,
                    'role' => $this->expediteur->hasRole('client') ? 'client' : 'prestataire'
                ],
            'destinataire' => $this->destinataire_id == $user->id 
                ? null 
                : [
                    'id' => $this->destinataire->id,
                    'name' => $this->destinataire->name,
                    'role' => $this->destinataire->hasRole('client') ? 'client' : 'prestataire'
                ],
            'latest_message' => new MessageResource($this->latest_message),
            'unread_count' => $this->unread_count,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
