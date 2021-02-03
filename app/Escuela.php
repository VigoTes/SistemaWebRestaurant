<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    protected $table = "escuela";
    protected $primaryKey ="CodEscuela";

    public $timestamps = false;  //para que no trabaje con los campos fecha 


    // le indicamos los campos de la tabla 
    protected $fillable = ['Descripcion','CodFacultad'];

    public function Facultad(){
            return $this->hasOne('App\Facultad','CodFacultad','CodFacultad');

    }


}
