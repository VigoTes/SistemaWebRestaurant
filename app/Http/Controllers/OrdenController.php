<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\DetalleOrden;
use App\Empleado;
use App\Mesa;
use App\Orden;
use App\Producto;
use Illuminate\Http\Request;
use App\Sala;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Cliente;
use DateTime;
use Illuminate\Support\Facades\Date;

class OrdenController extends Controller
{
    
    public function index( Request $request)
    {

    }

    //LISTA SOLAMENTE LAS ORDENES QUE ESTÁN YA PREPARADAS Y QUE DEBEN SER ENTREGADAS A LAS MESAS
    public function listarParaMesero(Request $request){
        
        $codSala = $request->sala; 
        $buscarpor = $request->buscarpor;
        if ($codSala != 0) { //si se seleccionó alguna sala
        
            $ordenes = Orden::where('codEstado','<','5')
            ->where('mesa.codSala','=',$codSala)
            ->where('observaciones','like','%'.$buscarpor.'%')
            ->where('codEstado','=','3')
            ->join('mesa', 'orden.codMesa', '=', 'mesa.codMesa')
            ->orderBy('codEstado','ASC')  
            ->get();
            
        }else{ //si se selecciono todas las salas
        
            $ordenes = Orden::where('codEstado','<','5')
            ->where('observaciones','like','%'.$buscarpor.'%')
            ->where('codEstado','=','3')
            ->orderBy('codEstado','ASC')  
            ->get();

        }
        
        
        $listaSalas = Sala::All();
        return view('modulos.mozo.listarOrdenes',compact('ordenes','listaSalas','codSala'));
        
    }

    //LISTA PARA EL COCINERO
    public function listarParaCocina( Request $request)
    {
        
        $CB1 = $request->CheckBox_1;
        $CB2 = $request->CheckBox_2;
        $CB3 = $request->CheckBox_3;
        $CB4 = $request->CheckBox_4;
        $CB5 = $request->CheckBox_5;
        $vectorCB = array($CB1,$CB2,$CB3,$CB4,$CB5);
    
        
        if($request->indicador==1){ //indicador está en 1 cuando se llega a esta funcion a traves del botón
        }else{
            $vectorCB=array("on","on","on","on","on");
        }
        
        

        
        $codSala = $request->sala; 
        $buscarpor = $request->buscarpor;
        if ($codSala != 0) { //si se seleccionó alguna sala
        
            $ordenes = Orden::where('codEstado','<','5')
            ->where('mesa.codSala','=',$codSala)
            ->where('observaciones','like','%'.$buscarpor.'%')
            ->join('mesa', 'orden.codMesa', '=', 'mesa.codMesa')
            ->orderBy('codEstado','ASC')  
            ->get();
            
        }else{ //si se selecciono todas las salas
        
            $ordenes = Orden::where('codEstado','<','5')
            ->where('observaciones','like','%'.$buscarpor.'%')
            ->orderBy('codEstado','ASC')  
            ->get();

        }
        
        
        if($vectorCB[0]!="on"){ //si no está marcada la 1, quitamos todos esos registros
            $ordenes= $ordenes->where('codEstado','!=','1');
        }
        if($vectorCB[1]!="on"){ //si no está marcada la 2, quitamos todos esos registros
            $ordenes=$ordenes->where('codEstado','!=','2');
        }
        if($vectorCB[2]!="on"){ //si no está marcada la 3, quitamos todos esos registros
            $ordenes=$ordenes->where('codEstado','!=','3');
        }
        if($vectorCB[3]!="on"){ //si no está marcada la 4, quitamos todos esos registros
            $ordenes=$ordenes->where('codEstado','!=','4');
        }
        if($vectorCB[4]!="on"){ //si no está marcada la 5, quitamos todos esos registros
            $ordenes=$ordenes->where('codEstado','!=','5');
        }
        $listaSalas = Sala::All();
        return view('modulos.cocina.listarOrdenes',compact('ordenes','listaSalas','codSala','vectorCB'));
    }


    //Solo debe listar las que ya están para pagar 
    public function listarParaCaja(Request $request)
    {
        
    
        
        if($request->indicador==1){ //indicador está en 1 cuando se llega a esta funcion a traves del botón
        }else{
            $vectorCB=array("on","on","on","on","on");
        }
        
        $codSala = $request->sala; 
        $buscarpor = $request->buscarpor;
        if ($codSala != 0) { //si se seleccionó alguna sala
        
            $ordenes = Orden::where('codEstado','<','5')
            ->where('mesa.codSala','=',$codSala)
            ->where('observaciones','like','%'.$buscarpor.'%')
            ->join('mesa', 'orden.codMesa', '=', 'mesa.codMesa')
            ->orderBy('codEstado','ASC')  
            ->get();
            
        }else{ //si se selecciono todas las salas
        
            $ordenes = Orden::where('codEstado','<','5')
            ->where('observaciones','like','%'.$buscarpor.'%')
            ->orderBy('codEstado','ASC')  
            ->get();

        }
        
        
        $listaSalas = Sala::All();
        return view('modulos.caja.listarOrdenes',compact('ordenes','listaSalas','codSala','vectorCB'));
    }

    public function ventanaPago($id)
    {
        $orden = Orden::findOrFail($id);
        $listaOrdenes = DetalleOrden::where('codOrden','=',$id)->get();
        $listaClientes = Cliente::All();

        return view('modulos.caja.pagar',compact('orden','listaClientes'));

    }


    public function pagar(Request $request, $id){ //id de la orden a pagar
        $orden = Orden::findOrFail($id);
        $orden->costoTotal = $request->montoOrden;
        $orden->montoPagado = $request->sencilloCliente;
        $orden->cambioDevuelto = $request->sencilloDevuelto;
        $orden->codEstado = 5; //seteamos el estado en pagado
        $orden->fechaHoraPago = Carbon::now()->subHours(5);
        $orden->codTipoCDP = $request->tipoCDP;
        //FALTA IMPLEMENTAR LO DE REGISTRO CAJA
        $orden->codRegistroCaja = '1';

        $orden->save();
        

        return redirect()->route('orden.listarParaCaja')
        ->with('datos','Orden N°'.$orden->codOrden.' Pagada');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    
    public function store(Request $request)
    {
        date_default_timezone_set('America/Lima');
        try {
            DB::beginTransaction();        
            /* Grabar Cabecera */
            $orden=new Orden();
            $orden->codMesa=$request->codMesa;
            $orden->DNI=null;
            $orden->codEmpleadoMesero=$request->codMeseroActual;
            $orden->codEstado=1;
            $orden->observaciones=$request->txtobservaciones;
            $orden->descuento=null;
            $orden->codMedioPago=null;
            $orden->codTipoPago=null;
            $orden->fechaHoraCreacion=new DateTime();
            $orden->fechaHoraPago=null;
            $orden->codTipoCDP=null;
            $orden->codRegistroCaja=null;
            $orden->costoTotal=$request->total;
            $orden->montoPagado=null;
            $orden->cambioDevuelto=null;

            $orden->save();

            /* Grabar Detalle */    
            $producto_id = $request->get('cod_producto');
            $cantidad = $request->get('cantidad');
            $pventa = $request->get('pventa');            

            $cont = 0;

            while ($cont<count($producto_id)) {
                $detalle=new DetalleOrden();
                $detalle->codOrden=$orden->codOrden;
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio=$pventa[$cont];
                $detalle->codProducto=$producto_id[$cont];
                $detalle->save();
                $cont=$cont+1;
            }

            $mesa=Mesa::find($request->codMesa);
            $mesa->estado=0;
            $mesa->save();
            
            DB::commit();                
            return redirect('/Salas/Mesero');
        } 
        catch (Exception $e) {
            DB::rollback();
        }
                
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function siguiente($id){
        $orden = Orden::findOrFail($id);
        $orden->codEstado = $orden->codEstado + 1;
        $orden->save();

        $nombreNuevoEstado = $orden->getEstado(); 

        return Redirect::back()->with('datos','Orden actualizada a'.$nombreNuevoEstado);
        return redirect()
                ->route('orden.listarParaCocina')
                ->with('datos','Orden Actualizada a '.$nombreNuevoEstado);
    }
    

    public function ordenMesa($id){
        $mesa=Mesa::find($id);
        $categorias1=Categoria::where('estado','=',1)->get();
        $productos=Producto::where('estado','=',1)->get();
        $meseros=Empleado::where('codTipoEmpleado','=',3)->get();

        return view('modulos.mozo.crearOrden',compact('mesa','categorias1','productos','meseros'));
    }
}
