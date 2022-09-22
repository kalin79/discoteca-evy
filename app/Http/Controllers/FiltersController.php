<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Zona;
use Illuminate\Http\Request;

class FiltersController extends Controller
{
    public function listaEventos(){
        $promotores = Evento::all();
        return response()->json($promotores);
    }
    public function listaZonas(){
        $zonas = Zona::all();
        return response()->json($zonas);
    }
}
