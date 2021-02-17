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


    public function caja(){
        return $this->hasOne('App\Caja','codCaja','codCaja');

    }
    public function empleado(){
        return $this->hasOne('App\Empleado','codEmpleado','codEmpleadoCajero');

    }
}
