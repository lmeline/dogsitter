<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrestationtypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prix' => $this->pivot->prix ?? null,
            'duree' => $this->pivot->duree ?? null,
            'prestation_type_id' => $this->pivot->prestation_type_id ?? $this->id,
            'dogsitter_id' => $this->pivot->dogsitter_id ?? null,
        ];
    }
}
