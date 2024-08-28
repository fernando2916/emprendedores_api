<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'imagen',
        'descripción_corta',
        'contenido',
        'categoria_id',
        'slug',
        'tipo',
        'tiempo_de_lectura',
        'autor',
    ];

    protected $with = ['categoria'];

    // Generar slug del título
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function boot() {
        parent::boot();

        static::creating(function($blog) {
            $blog->slug = Str::slug($blog->titulo);
        });

        static::updating(function ($blog) {
            $blog->slug = Str::slug($blog->titulo);
        });
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    
}
