<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sala;
use Illuminate\Support\Facades\DB;
use App\Mesa;
class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaSalas = Sala::All();
        $buscarpor = '';
        return view('tablas.salas.index',compact('listaSalas','buscarpor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tablas.salas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sala = new Sala();
        $sala->nombre = $request->nombre;

        $sala->save();
        return redirect()->route('sala.index')->with('datos','¡Sala creada exitosamente!');
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
        $sala = Sala::findOrFail($id);
        $listaMesas = Mesa::where('codSala','=',$id)->get();
        return view('tablas.salas.edit',compact('sala','listaMesas'));
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
        $sala = Sala::findOrFail($id);
        $sala->nombre = $request->nombre;

        $sala->save();
        return redirect()->route('sala.index')->with('datos','¡Sala actualizada exitosamente!');
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

    public function storeMesa(Request $request){
        $mesa = new Mesa();
        $mesa->codSala = $request->codSala;
        $mesa->nroSillas = $request->nroSillas;
        $mesa->estado = '1';
        $mesa->nroEnSala = 
            count(Mesa::where('codSala','=',$request->codSala)->get())+1;
        $mesa->save();

        return redirect()
                ->route('sala.edit',$request->codSala)
                ->with('datos','Mesa creada exitosamente.');

    }

    public function eliminarMesa($id){
        //borramos la mesa
        $mesa = Mesa::findOrFail($id);
        $codSala = $mesa->codSala;
        $mesa->delete();

        
        //recalculamos los nro en sala de todas las mesas de su sala
        $listaMesas = DB::select('select * from mesa where codSala = "'.$codSala.'" ');

        for ($i=0; $i < count($listaMesas); $i++) { 

            $itemMesa = Mesa::findOrFail($listaMesas[$i]->codMesa);

            $itemMesa->nroEnSala=$i+1;
            $itemMesa->save();

        }

        return redirect()->route('sala.edit',$codSala)->with('datos','Mesa eliminada exitosamente');
    }


    public function eliminar($id){

        try {
            DB::beginTransaction();
            
            $sala = Sala::findOrFail($id);

            DB::select('
                delete from mesa where codSala = "'.$id.'"
            ');

            $sala->delete();

            DB::commit();

            return redirect()->route('sala.index')->with('datos','¡Sala eliminada exitosamente!'); 
        } catch (\Throwable $th) {
            //throw $th;

            error_log('HA OCURRIDO UN ERROR EN SALA CONTROLLER : ELIMINAR 
            
            '.$th.'
            
            ');

            DB::rollBack();
        }
        

    }
}
