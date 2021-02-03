<?php

namespace App\Http\Controllers;

use App\Orden;
use Illuminate\Http\Request;
use App\Sala;
class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {

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
        return view('tablas.ordenes.index',compact('ordenes','listaSalas','codSala'));
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
        //
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

        return redirect()
                ->route('orden.index')
                ->with('datos','Orden Actualizada a '.$nombreNuevoEstado);
    }
}
