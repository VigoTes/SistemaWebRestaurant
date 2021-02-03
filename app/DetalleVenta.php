<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = "detalleventas";
    public $timestamps = false;  //para que no trabaje con los campos fecha 
// la clave es doble  entons no le ponemos

    // le indicamos los campos de la tabla 
    protected $fillable = ['venta_id','productoid','precio','cantidad',];

    public function venta(){
        return $this->hasOne(CabeceraVenta::class,'venta_id','venta_id');
        

    }



}
