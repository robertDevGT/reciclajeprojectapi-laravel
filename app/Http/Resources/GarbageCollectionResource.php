<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GarbageCollectionResource extends JsonResource
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
            'user' => $this->user->name,
            'address' => new AddressesResource($this->address),
            'status' => $this->status->name,
            'collector' => $this->assignment ? $this->assignment->collector->name : '',
            'fecha_recoleccion' => $this->fecha_recoleccion->format('d-m-Y')
        ];
    }
}
