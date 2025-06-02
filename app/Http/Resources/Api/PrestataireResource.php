<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PrestataireResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'nom_entreprise' => $this->nom_entreprise,
            'description' => $this->description,
            'adresse' => $this->adresse,
            'ville' => $this->ville,
            'code_postal' => $this->code_postal,
            'telephone' => $this->telephone,
            'site_web' => $this->site_web,
            'categories' => $this->categories->pluck('name'),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
