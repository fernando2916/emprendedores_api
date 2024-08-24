<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create(['name'=> 'Técnologia']);
        Categoria::create(['name'=> 'Diseño Gráfico']);
        Categoria::create(['name'=> 'Ilustración']);
        Categoria::create(['name'=> 'Serigrafía']);
        Categoria::create(['name'=> 'Corte de Vinil']);
        Categoria::create(['name'=> 'Programación']);
        Categoria::create(['name'=> 'Programación - React js']);
        
    }
}
