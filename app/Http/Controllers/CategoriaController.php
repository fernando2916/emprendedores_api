<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaCollection;
use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(){
        return new CategoriaCollection(Categoria::all());
    }

    // public function show($id){
    //     $categoria = Categoria::findOrFail($id);

    //     return new CategoriaResource($categoria);
    // }

}
