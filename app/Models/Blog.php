<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'imagen',
        'descipción_corta',
        'contenido',
        'categoria_id',
        'tipo',
        'tiempo_de_lectura',
        'autor',
    ];

    protected $with = ['categoria'];

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    
}
