<?php

namespace App\Http\Controllers;

use App\Caja;
use App\Orden;
use App\RegistroCaja;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Throwable;
use App\Empleado;

class CajaController extends Controller
{
    const PAGINATION = '20';


    //despliega la vista de gastos de mi periodo, si ya lo inicie
    // o la vista de apertura si aun no
    public function index()
    {
        date_default_timezone_set('America/Lima');
        $registros=RegistroCaja::where('codEmpleadoCajero','=',Auth::user()->empleado->codEmpleado)->where('estado','=',1)->get();
        if(count($registros)>0){
            $ordenes=Orden::where('codRegistroCaja','=',$registros[0]->codRegistroCaja)->where('estadoPago','=',1)->get();
            $total=0;
            foreach ($ordenes as $itemorden) {
                $total+=$itemorden->costoTotal;
            }
            $total+=$registros[0]->saldoApertura;
            $registro=$registros[0];
            return view('modulos.caja.listarComprasCaja',compact('ordenes','registro','total'));
        }else{
            $cajas=Caja::all();
            $fechaHoraActual=new DateTime();
            return view('modulos.caja.apertura',compact('cajas','fechaHoraActual'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
     
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
        $registroCaja=new RegistroCaja();
        $registroCaja->fechaHoraApertura=new DateTime();
        $registroCaja->codCaja=$request->codCaja;
        $registroCaja->saldoApertura=$request->saldoApertura;
        $registroCaja->codEmpleadoCajero=Auth::user()->empleado->codEmpleado;
        $registroCaja->estado=1;
        $registroCaja->save();

        return redirect()->route('caja.index');
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
      
    }

    
    public function destroy($id){
        
    }

    public function confirmar($id){
       
    }

    /* DESPLIEGA LA VISTA PARA CERRAR LA CAJA */
    public function cerrarCaja(){


        try{

            date_default_timezone_set('America/Lima');

            $registro = Empleado::getRegistroCaja();
            
            //codigo de felix
            /* $registros=RegistroCaja::where('codEmpleadoCajero','=',Auth::user()->empleado->codEmpleado)->where('estado','=',1)->get();
            $registro=$registros[0];
             */

            if($registro=='0')
                return redirect()->route('caja.index');

            
            $fechaHoraActual=new DateTime();

           
            $total= $registro->saldoApertura;
            $ordenes=Orden::where('codRegistroCaja','=',$registro->codRegistroCaja)->get();
            foreach ($ordenes as $itemorden) {
                $total+=$itemorden->costoTotal;
            }

            return view('modulos.caja.cierre',compact('registro','fechaHoraActual','total'));

        }catch(Throwable $th){
            error_log('
            
                '.$th.'
            
            ');
                
        }


    }

    public function guardarCerrarCaja(Request $request)
    {
        try {
            date_default_timezone_set('America/Lima');

            $registroCaja=RegistroCaja::findOrFail($request->codRegistroCaja);
            $registroCaja->fechaHoraCierre=new DateTime();
            $registroCaja->diferencia=$request->saldoCierre-$request->saldoReal;
            
            
            $registroCaja->saldoCierre = $request->saldoCierre;
            
            $registroCaja->estado=0;
            $registroCaja->save();
    
            return redirect()->route('caja.index');     
            
        } catch (\Throwable $th) {
            error_log('
            
                '.$th.'
            
            ');    


        }
        
    }

    public function visualizarRegistro(){
        $registros=RegistroCaja::all();
        return view('modulos.caja.visualizarRegistrosCaja',compact('registros'));
    }

    public function visualizarOrdenesDeRegistro($id){
        $registro=RegistroCaja::find($id);
        $ordenes=Orden::where('codRegistroCaja','=',$id)->get();
        return view('modulos.caja.visualizarOrdenesDeRegistro',compact('ordenes','registro'));
    }

}
