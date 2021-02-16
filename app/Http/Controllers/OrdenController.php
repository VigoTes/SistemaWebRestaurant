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
use App\Parametro;
use App\Cliente;
use DateTime;
use Illuminate\Support\Facades\Date;
use PhpParser\Node\Stmt\TryCatch;
use Throwable;

use Barryvdh\DomPDF\Facade as PDF;

class OrdenController extends Controller
{
    
    public function index( Request $request)
    {

    }

    //LISTA SOLAMENTE LAS ORDENES QUE ESTÁN YA PREPARADAS Y QUE DEBEN SER ENTREGADAS A LAS MESAS
    //TAMBIEN LISTA LAS ORDENES QUE ESTÁN PAGADAS Y ENTREGADAS (Para poder finalizarlas y desocupar la mesa)
    public function listarParaMesero(Request $request){
        
        $codSala = $request->sala; 
        $buscarpor = $request->buscarpor;
        if ($codSala != 0) { //si se seleccionó alguna sala
        
            $ordenes = Orden::where('codEstado','<','5')
            ->where('mesa.codSala','=',$codSala)// PARA SALA ESPECIFICA
            ->where('codEstado','=','3')
            ->where('observaciones','like','%'.$buscarpor.'%')
            ->join('mesa', 'orden.codMesa', '=', 'mesa.codMesa')
            //->get()
            ;
            
        }else{ //si se selecciono todas las salas
        
            $ordenes = Orden::where('codEstado','<','5')
            ->where('codEstado','>=','3')
            ->where('observaciones','like','%'.$buscarpor.'%')
            //->get()
            ;

        }



        /*(quiero las que estén (preparadas y no pagadas), 
                                      y (entregadas y pagadas)
        */
        $ordenes->where(function ($query) {
            $query->where('codEstado', '=','3') //PREPARADAS
                ->where('estadoPago', '=', '0'); // Y NO PAGADAS
        })->orWhere(function($query) { //AND
            $query->where('codEstado','=', '4')   //ENTREGADAS
                ->where('estadoPago', '=', '1');	//Y PAGADAS
        });


        $ordenes = $ordenes->orderBy('codEstado','ASC')->get();
     
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


    //lista todas las ordenes 
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
            ->orderBy('estadoPago','ASC')  
            ->orderBy('codEstado','ASC')  
            ->get();
            
        }else{ //si se selecciono todas las salas
        
            $ordenes = Orden::where('codEstado','<','5')
            ->where('observaciones','like','%'.$buscarpor.'%')
            ->orderBy('estadoPago','ASC')  //primero salgan las no pagadas
            ->orderBy('codEstado','ASC')   //primer salgan las que estan mas recientes
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
        
        try {
            DB::beginTransaction();        
            $orden = Orden::findOrFail($id);

            

            if(($request->clientes) == '-1'  ){ //si no se seleccionó a un cliente frecuence
                // registramos al cliente nuevo
                $cliente=new Cliente();
                $cliente->nombres=$request->nombres;
                $cliente->apellidos=$request->apellidos;
                $cliente->DNI=$request->DNI;
                $cliente->save();

                $orden->DNI=$request->DNI;
            }else{
                $orden->DNI=$request->clientes; //si se seleccionó a un cliente frecuente
                
            }
            error_log('
                DNI ::::: 
                $orden->DNI '. $orden->DNI.'
            
            
            ');

            $orden->codTipoCDP=$request->tipoCDP;
            $orden->codTipoPago=$request->tipoPago;
            $orden->codMedioPago=$request->medioPago;
            $orden->estadoPago=1;

            $orden->nroCDP = $request->nroSerie;
            $orden->costoTotal = $request->montoOrden;
            $orden->montoPagado = $request->sencilloCliente;
            $orden->cambioDevuelto = $request->sencilloDevuelto;
            //$orden->codEstado = 5; //seteamos el estado en pagado
            $orden->fechaHoraPago = Carbon::now()->subHours(5);
            //FALTA IMPLEMENTAR LO DE REGISTRO CAJA
            $orden->codRegistroCaja = Empleado::getRegistroCaja()->codRegistroCaja;

            $orden->save();
            
            Parametro::pasarASiguiente($request->tipoCDP);
            DB::commit();        
            return redirect()->route('orden.listarParaCaja')
            ->with('datos','Orden N°'.$orden->codOrden.' Pagada');


        } catch (\Throwable $th) {
            error_log('Ha ocurrido un error en el OrdenController PAGAR
            
            
            '.$th.'
            
            
            
            
            ');
            DB::rollback();
        }

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
            
            $orden->codEmpleadoMesero= Empleado::getEmpleadoLogeado()->codEmpleado;
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
            $orden->estadoPago='0';
            

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
        catch (Throwable $th) {
            error_log('Ha ocurrido un error en el OrdenController STORE
            
            
            '.$th.'
            
            
            
            
            ');
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







    /*Se ejecuta cuando :
        - El mesero ve que el cliente ya desocupo la mesa y la libera

    HACE: 
        - pasa la orden al estado 5 finalizada
        - Libera la mesa en la que está la orden
    */
    public function finalizar($id){

        try{
            DB::beginTransaction();    
            $orden = Orden::findOrFail($id);
            $orden->codEstado='5';

            $mesa = Mesa::findOrFail($orden->codMesa);
            $mesa->estado = '1';

            $orden->save();     
            $mesa->save();

            DB::commit(); 

            return redirect()->route('orden.listarParaMesero');
        }
        catch(Throwable $th){
            error_log('Ha ocurrido un error en el OrdenController finalizar
            
            
            '.$th.'
            
            
            
            
            ');
            DB::rollback();
        }
        



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


    public function generarCDP(){

        //COMANDO PARA EL COMPLEMENTO PARA PDF
        //composer require barryvdh/laravel-dompdf
        //COMPOSER: es un gestor para dependencias de laravel en la nube (se guarda en vendor)

        //$pdf = \PDF::loadView('modulos.caja.CDP')->setPaper(array(0, 0, 301, 623.622), 'portrait');
        $pdf = \PDF::loadView('modulos.caja.CDP');
        $pdf->setPaper(array(0, 0, 301, 623.622), 'portrait');
        //$pdf->set_option('defaultFont', 'Courier');
        
        
        //var_dump($data[0]->elementos->descripcionElemento);

        return $pdf->download('XDXD.pdf');
    }
}
