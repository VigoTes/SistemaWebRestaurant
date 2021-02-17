<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Support\Facades\DB;
class Parametro extends Model
{
    protected $table = "parametros";
    protected $primaryKey ="codParametro";

    public $timestamps = false;  //para que no trabaje con los campos fecha 


    // le indicamos los campos de la tabla 
    protected $fillable = ['nombre','serie','valor'];

    /* EN LA POSICION 1 SIEMPRE STARÁ LA SERIE DE BOLETA
    EN LA POSICION 2 SIEMPRE ESTARA LAS ERIE DE FACTURA
    */

    public static function pasarASiguiente($tipo_id){
        try{
            $par = Parametro::findOrFail($tipo_id);

            //CASO EXTREMO SE ACABÓ LA NUMERACION
            if($par->valor == '999999'){
                $par->valor = '000000'; //cuando lo pase será 1
                $par->serie=$par->serie + 1;
            }

            $par->valor = $par->valor + 1;
            $par->save();

            return true;
        }catch(Exception $ex){
            error_log('HA OCURRIDO UN ERROR EN Parametro::pasarASiguiente. Msj error:'.$ex);
            return false;
        }
    }

    //OBTIENE LA NUMERACION ACTUAL QUE ESTÁ EN PARAMETROS 
    public static function getNumeracion($id){
        if($id=='1'){ //boleta
            $par = Parametro::findOrFail('1');
            return $par;
        }else{
            $par = Parametro::findOrFail('2');
            return $par;
        }


    }

}
