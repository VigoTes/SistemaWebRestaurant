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

class CajaController extends Controller
{
    const PAGINATION = '20';

    public function index()
    {
        date_default_timezone_set('America/Lima');
        $registros=RegistroCaja::where('codEmpleadoCajero','=',Auth::user()->empleado->codEmpleado)->where('estado','=',1)->get();
        if(count($registros)>0){
            $ordenes=Orden::where('codRegistroCaja','=',$registros[0]->codRegistroCaja)->where('estadoPago','=',1)->get();
            return view('modulos.caja.listarComprasCaja',compact('ordenes'));
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

    
    public function cerrarCaja(){


        try{

            date_default_timezone_set('America/Lima');


            $registros=RegistroCaja::where('codEmpleadoCajero','=',Auth::user()->empleado->codEmpleado)->where('estado','=',1)->get();
            $registro=$registros[0];
            $fechaHoraActual=new DateTime();

            error_log('AAAAAAAAAAAAAAA');

            $total=0;
            $ordenes=Orden::where('codRegistroCaja','=',$registro->codRegistroCaja)->get();
            foreach ($ordenes as $itemorden) {
                $total+=$itemorden->costoTotal;
            }
            error_log('bbbbbbbbbbbbbbbbbbbbbbbb');

            return view('modulos.caja.cierre',compact('registro','fechaHoraActual','total'));

        }catch(Throwable $th){
            error_log('
            
                '.$th.'
            
            ');
                
        }


    }

    public function guardarCerrarCaja(Request $request)
    {
        date_default_timezone_set('America/Lima');
        $registroCaja=RegistroCaja::find($request->codRegistroCaja);
        $registroCaja->fechaHoraCierre=new DateTime();
        $registroCaja->diferencia=$request->saldoCierre-$request->saldoReal;
        $registroCaja->saldoCierre=(float)$request->saldoCierre+0;
        $registroCaja->estado=0;
        $registroCaja->save();

        return redirect()->route('caja.index');
    }

}
