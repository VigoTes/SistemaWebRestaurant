<?php

namespace App\Http\Controllers;

use App\Mesa;
use App\Sala;
use Illuminate\Http\Request;

class MesaController extends Controller
{

    




    public function listarMesa()
    {
        $mesas=Mesa::all();
        $salas=Sala::all();
        return view('modulos.mozo.listarMesas',compact('mesas','salas'));
    }
}
