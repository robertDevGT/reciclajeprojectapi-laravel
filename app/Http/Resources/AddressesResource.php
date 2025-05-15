<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => strval($this->id),
            'calle' => $this->calle,
            'codigo_postal' => $this->codigo_postal,
            'colonia' => $this->colonia,
            'ciudad' => $this->ciudad,
            'numero' => $this->numero
        ];
    }
}
