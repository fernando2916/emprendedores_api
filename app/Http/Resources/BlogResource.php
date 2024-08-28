<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'imagen' => $this->imagen,
            'slug' => $this->slug,
            'descripción_corta' => $this->descripción_corta,
            'contenido' => $this->contenido,
            'categoria' => $this->categoria->name,
            'tipo' => $this->tipo,
            'tiempo_de_lectura' => $this->tiempo_de_lectura,
            'autor' => $this->autor,
            'created_at' => $this->created_at,
        ];
    }
}
