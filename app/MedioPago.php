<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedioPago extends Model
{
    protected $table = "medio_pago";
    protected $primaryKey ="codMedioPago";

    public $timestamps = false;  //para que no trabaje con los campos fecha 


    // le indicamos los campos de la tabla 
    protected $fillable = ['descripcion'];
}
