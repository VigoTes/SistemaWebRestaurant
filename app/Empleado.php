<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\RegistroCaja;
use Illuminate\Support\Carbon;



class Empleado extends Model
{
    protected $table = "empleado";
    protected $primaryKey ="codEmpleado";

    public $timestamps = false;  //para que no trabaje con los campos fecha 


    // le indicamos los campos de la tabla 
    protected $fillable = ['codTipoEmpleado','nombres','apellidos','telefono','fechaContrato','fechaFinContrato','activo','idUsuario'];


    /*
        Llamada unicamente desde la instancia del cajeero
        Obtiene el modelo REGISTRO_CAJA de hoy dia, y de la caja
        DEL EMPLEADO (CAJERO) QUE ESTÁ LOGEADO 
    */
    public static function getRegistroCaja(){
        //primero obtenemos el empleado
        $emp = Empleado::where('idUsuario','=',Auth::id())->first();
        //obtenemos el registro caja de hoy, de ese empleado
        
        $reg = RegistroCaja::where('codEmpleadoCajero','=',$emp->codEmpleado)
            ->orderBy('fechaHoraApertura','DESC') //OBTENEMOS EL ULTIMO EN FECHA O SEA DE HOY
            ->first();

        
            
      
        if(($reg) == '') //si la query no tuvo nada
            return '0';

        //vemos si el ultimo registro de hoy ya está cerrado
        if($reg->fechaHoraCierre!='') //si ya está cerrada (tiene fechaHoraCierre), forzamos al cajero a crear nuevo reg
            return '0'; 
        
        
        date_default_timezone_set('America/Lima');
        $date = Carbon::now()->format('Y-m-d');
       
        if(substr( $reg->fechaHoraApertura,0,10) != $date ) //si la fecha no es de hoy, 0
            return '0';

        
            return $reg;

        

    }


    public static function getEmpleadoLogeado(){
        if(Auth::id()!='')
            $emp    = Empleado::where('idUsuario','=' ,Auth::id())->first();
        else
            $emp = "No logeado";

        
        return $emp;
    }


    public function getTipoTrabajador(){
        return TipoEmpleado::findOrFail($this->codTipoEmpleado)->nombrePuesto;

    }
    public function getNombreCompleto(){
        return $this->nombres.' '.$this->apellidos;

    }


    public static function getNombreFoto(){
        $emp    = Empleado::where('idUsuario','=' ,Auth::id())->first();
        switch($emp->codTipoEmpleado){
            case '1': //cocinero
                $nombre='chef.png';
                break;

            case '2': //cajero
                $nombre='caja.jpg';
                break;

            case '3': //mesero
                $nombre='mozo.png';
                break;
        
                    

        }
        return $nombre;

    }
}
