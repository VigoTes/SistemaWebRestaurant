<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    
    protected $table = "orden";
    protected $primaryKey ="codOrden";

    public $timestamps = false;  //para que no trabaje con los campos fecha 


    // le indicamos los campos de la tabla 
    protected $fillable = ['codMesa','DNI','codEmpleadoMesero','codEstado','observaciones',
    'descuento','codMedioPago','codTipopago','fechaHoraCreacion','fechaHoraPago',
    'codTipoCDP','codRegistroCaja','costoTotal','montoPagado','cambioDevuelto','estadoPago'];

    public function getNombreSala(){
        $mesa = Mesa::findOrFail($this->codMesa);
        $sala = Sala::findOrFail($mesa->codSala);
        return $sala->nombre;
    }

    public function getNroMesaEnSala(){
        $mesa = Mesa::findOrFail($this->codMesa);
        return $mesa->nroEnSala;
    }

    public function listarProductos(){
        $detalles = DetalleOrden::where('codOrden','=',$this->codOrden)->get();
        $listaComada = "";
        foreach ($detalles as $x) {
            $producto = Producto::findOrFail($x->codProducto);
            $listaComada = $listaComada.($producto->nombre).",";
        }

        //  $listaDetallesString = implode(",",$detalles);
        $listaComada = trim($listaComada,",");
        $cantLimite = 110;

       
        if( strlen($listaComada) >= $cantLimite){
            $listaComada = substr($listaComada,0,$cantLimite);
            $listaComada = $listaComada.'...';
        }
        return $listaComada;
    }

    public function getEstado(){
        $estado = EstadoOrden::findOrFail($this->codEstado);
        return $estado->nombre;
    }

    public function getEstadoPago(){
        if($this->estadoPago=='0')
            return "No Pagado";
        else
            return "Pagado";

    }
    public function getHoraCreacion(){
        $vector = explode(" ", $this->fechaHoraCreacion); //separamos el datetime en DATE y TIME XD

       return $vector[1];
    }

    public function calcularCosto(){ //retorna elcosto de los detalles sumados 
        $detalles = DetalleOrden::where('codOrden','=',$this->codOrden)->get();
        $sumaTotal = 0;
        foreach ($detalles as $x) {
            $sumaTotal = $sumaTotal + ($x->precio*$x->cantidad);
        }

        return $sumaTotal;

    }

    public function iconoEstadoSiguiente(){ // retorna el boton para pasar al siguiente estado en el orden natural
            //pendiente -> preparando ->preparado ->entregada->finalizada
        switch ($this->codEstado) {
            case 1: //estado pendiente, para pasar a preparando
                return 'fas fa-fire';
                break;           
            case 2: //estado preparando,para pasar a preparado
                return 'fas fa-check';
                break;           
            case 3: //estado preparado, para pasar a entregado
                return 'fas fa-check-double'; 
                break;           
            case 4: //estado entregado, para pasar a finalizado
                # code...
                break;           
                

            default:
                # code...
                break;
        }


    }

    public function iconoEstadoActual(){ // retorna el boton para pasar al siguiente estado en el orden natural
        //pendiente -> preparando ->preparado ->entregada->finalizada
        switch ($this->codEstado) {

            case 1: //estado pendiente
                return 'fas fa-clock';
                break;
            case 2: //estado pendiente
                return 'fas fa-fire';
                break;           
            case 3: //estado preparando
                return 'fas fa-check';
                break;           
            case 4: //estado preparado
                return 'fas fa-check-double'; 
                break;           
            case 5: //estado entregado
                # code...
                break;           
                

            default:
                # code...
                break;
        }


    }

    public function mesero(){
        
        return Empleado::findOrFail($this->codEmpleadoMesero);
        return $this->hasOne('App\Empleado','codEmpleado','codEmpleadoMesero');
    }
    public function cliente(){
        return Cliente::findOrFail($this->DNI);
        return $this->hasOne('App\Cliente','DNI','DNI');
    }
    public function tipoCDP(){

        return TipoCDP::findOrFail($this->codTipoCDP);
        return $this->hasOne('App\TipoCDP','codTipoCDP','codTipoCDP');
    }
    public function tipoPago(){
        return TipoPago::findOrFail($this->codTipoPago);
        return $this->hasOne('App\TipoPago','codTipoPago','codTipoPago');
    }
    public function medioPago(){
        return MedioPago::findOrFail($this->codMedioPago);
        return $this->hasOne('App\MedioPago','codMedioPago','codMedioPago');
    }


}
