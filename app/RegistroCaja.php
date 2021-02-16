<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroCaja extends Model
{
    protected $table = "registro_caja";
    protected $primaryKey ="codRegistroCaja";

    public $timestamps = false;  //para que no trabaje con los campos fecha 


    // le indicamos los campos de la tabla 
    protected $fillable = ['fechaHoraApertura','fechaHoraCierre','saldoApertura'
        ,'saldoCierre','diferencia','codCaja','codEmpleadoCajero'];

}
