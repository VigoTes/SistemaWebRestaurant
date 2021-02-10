<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "cliente";
    protected $primaryKey ="DNI";

    public $timestamps = false;  //para que no trabaje con los campos fecha 


    // le indicamos los campos de la tabla 
    protected $fillable = ['nombres','apellidos','direccion','telefono','correo'];

        /* public function ventas(){

            return $this->hasMany('App\CabeceraVenta','codcliente','codcliente');
        } */

}
