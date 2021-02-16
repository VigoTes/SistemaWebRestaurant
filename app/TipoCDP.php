<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCDP extends Model
{
    protected $table = "tipo_cdp";
    protected $primaryKey ="codTipoCDP";

    public $timestamps = false;  //para que no trabaje con los campos fecha 


    // le indicamos los campos de la tabla 
    protected $fillable = ['descripcion'];
}
