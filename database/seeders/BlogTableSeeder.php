<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::create([
            'titulo'=> 'Mover, copiar y renombrar directorios en Linux',
            'imagen'=> 'Técnologia',
            'descipción_corta'=> 'Aprende a copiar, mover y renombrar archivos usando la terminal de comandos de Linux.',
            'contenido'=> 'Aprende a copiar, mover y renombrar archivos usando la terminal de comandos de Linux.',
            'categoria_id'=> '1',
            'tipo'=> 'artículo',
            'tiempo_de_lectura'=> '8 min',
            'autor'=> 'Álvaro Felipe',
        ]);
        Blog::create([
            'titulo'=> 'La historia completa de la Inteligencia Artificial (por EDteam)',
            'imagen'=> 'Técnologia',
            'descipción_corta'=> 'La historia de la IA se remonta a los años 50 y ha evolucionado hasta lo que conocemos hoy en día. Te la cuento en este blog, porque en español, #NadieExplicaMejor que EDteam.',
            'contenido'=> 'La historia de la IA se remonta a los años 50 y ha evolucionado hasta lo que conocemos hoy en día. Te la cuento en este blog, porque en español, #NadieExplicaMejor que EDteam.',
            'categoria_id'=> '1',
            'tipo'=> 'artículo',
            'tiempo_de_lectura'=> '8 min',
            'autor'=> 'EdTeam',
        ]);
        Blog::create([
            'titulo'=> 'Canva compra Affinity: ¿Adobe debe estar asustado?',
            'imagen'=> 'canva',
            'descipción_corta'=> 'Adobe tiene años dominando el mercado del software de diseño, ¿esto cambiará con la compra de Affinity por Canva? De esto hablaremos en este blog, porque en español, #EDteamExplicaMejor.',
            'contenido'=> 'Adobe tiene años dominando el mercado del software de diseño, ¿esto cambiará con la compra de Affinity por Canva? De esto hablaremos en este blog, porque en español, #EDteamExplicaMejor.',
            'categoria_id'=> '2',
            'tipo'=> 'artículo',
            'tiempo_de_lectura'=> '7 min',
            'autor'=> 'EdTeam',
        ]);
        
    }
}
