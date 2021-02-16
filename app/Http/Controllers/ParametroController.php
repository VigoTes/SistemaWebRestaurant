<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parametro;

class ParametroController extends Controller
{
    

    public function obtener($id){
       return Parametro::getNumeracion($id);

    }
}
