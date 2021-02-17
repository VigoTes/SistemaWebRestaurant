<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $table = "mesa";
    protected $primaryKey ="codMesa";

    public $timestamps = false;  //para que no trabaje con los campos fecha 


    // le indicamos los campos de la tabla 
    protected $fillable = ['codSala','nroSillas','nroEnSala','estado'];

    public function sala(){
        return $this->hasOne('App\Sala','codSala','codSala');
    }
    
    public function seEdita(){
        $ordenes=Orden::where('codMesa','=',$this->codMesa)->where('codEstado','<',4)->get();
        if(count($ordenes)==0){
            return 0;
        }
        return 1;
    }
    
}
