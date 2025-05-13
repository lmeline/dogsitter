<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PrestationtypeResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'prenom' => $this->prenom,
            'date_naissance' => $this->date_naissance,
            'ville_id' => $this->ville_id,
            'code_postal' => $this->code_postal,
            'email' => $this->email,
            'role' => $this->role,
            'photo' => $this->photo,
            'description' => $this->description,
            'prestationtypes' => PrestationtypeResource::collection($this->whenLoaded('prestationtypes')),
        ];
    }
}
