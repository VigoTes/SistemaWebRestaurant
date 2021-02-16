<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEmpleado extends Model
{
    protected $table = "tipo_empleado";
    protected $primaryKey ="codTipoEmpleado";

    public $timestamps = false;  //para que no trabaje con los campos fecha 


    // le indicamos los campos de la tabla 
    protected $fillable = ['nombrePuesto'];

}
