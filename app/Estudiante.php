<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = "estudiante";
    protected $primaryKey ="CodEstudiante";

    public $timestamps = false;  //para que no trabaje con los campos fecha 


    // le indicamos los campos de la tabla 
    protected $fillable = ['Apellipos','Nombres','Direccion','CodFacultad','CodEscuela','Edad'];

    public function Escuela(){
            return $this->hasOne('App\Escuela','CodEscuela','CodEscuela');

    }
    public function Facultad(){
        return $this->hasOne('App\Facultad','CodFacultad','CodFacultad');

}

    
}
