<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
    //CLASE ESTATICA PARA OBTENER LOS ATRIBUTOS DE LA EMPRESA CONFIGURADAAA
    protected $table = "empresa";
    protected $primaryKey ="RUC";

    public $timestamps = false;  //para que no trabaje con los campos fecha 


    // le indicamos los campos de la tabla 
    protected $fillable = ['nombre','direccion','telefono','correo',
            'nombreResponsable','telefonoResponsable','correoResponsable','tipoMoneda'];


    public static function getEmpresa(){
        //OBTIENE EL PRIMER Y UNICO REGISTRO DE EMPRESA
        $emp = Empresa::All()->first();
        return $emp;
        
    } 

}
