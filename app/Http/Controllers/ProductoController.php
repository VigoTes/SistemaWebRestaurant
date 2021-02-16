<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Categoria;
use App\Unidad;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
     const PAGINATION = '10';

    
    public function index(Request $request )
    {
        $buscarpor = $request->buscarpor;
        $producto = Producto::where('estado','=','1')
            ->where('nombre','like','%'.$buscarpor.'%')->paginate($this::PAGINATION);

        return view('tablas.productos.index',compact('producto','buscarpor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria = Categoria::where('estado','=','1')->get(); //enviamos las cat activas

        //$unidad = Unidad::where('estado','=','1')->get(); //enviamos las cat activas
        return view ('tablas.productos.create',compact('categoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'nombre'=>'required|max:100',
                'codCategoria'=>'required',
                'precio'=>'required',
            ],[
                'nombre.required'=>'Ingrese nombre de categoria',
                'nombre.max' => 'Maximo 100 caracteres la nombre',
                'codCategoria.required'=>'Debe seleccionar una categoria ',
                'precio.required'=>'Debe ingresar precio',
            ]

            );

            $producto = new Producto();
            $producto->descripcion = $request->descripcion;
            $producto->nombre=$request->nombre;
            $producto->codCategoria=$request->codCategoria;
            $producto->menuDeHoy='1';
            
            $producto->precioActual=$request->precio;
            $producto->estado=1;              

            $producto->save();
                return redirect()->route('producto.index')->with('datos','Registro nuevo guardado');



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
    public function edit($codproducto)
    {
          $producto=Producto::findOrFail($codproducto);                                  
          $categoria = Categoria::where('estado','=','1')->get();                          
          //$unidad = Unidad::where('estado','=','1')->get();                          
          return view('tablas.productos.edit',compact('producto','categoria'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $codproducto)
    {
        $data = request()->validate(
            [
                'nombre'=>'required|max:100',
                'codCategoria'=>'required',
                'precio'=>'required',
            ],[
                'nombre.required'=>'Ingrese nombre de categoria',
                'nombre.max' => 'Maximo 100 caracteres la nombre',
                'codCategoria.required'=>'Debe seleccionar una categoria ',
                'precio.required'=>'Debe ingresar precio',
            ]

            );    
               $producto=Producto::findOrFail($codproducto);
               $producto->nombre=$request->nombre;
               $producto->codCategoria=$request->codCategoria;
               $producto->descripcion = $request->descripcion;
               $producto->precioActual=$request->precio;
               $producto->menuDeHoy='1';
               $producto->save();
               return redirect()->route('producto.index')->with('datos','Registro Actualizado!');
     
    }
    /*
    public function confirmar($codproducto)
      {
          //        
          $producto=Producto::findOrFail($codproducto);
          return view('tablas.productos.confirmar',compact('producto'));
      }
      */


    public function destroy($codproducto)
    {

    }

    public function delete($codproducto)
    {
        $producto=Producto::findOrFail($codproducto);
          $producto->estado=0;
          $producto->save();
          return redirect()->route('producto.index')->with('datos','Registro Eliminado!');

    }


    //Lista todos los productos activos (estado 1), en una tabla para ponerlos o quitarlos del menu de hoy.
    public function verMenu(Request $request){
        $buscarpor=$request->buscarpor;
        
        $listaProductos = Producto::where('estado','=','1')
        ->where('nombre','like','%'.$buscarpor.'%')
            ->orderBy('menuDeHoy','DESC')       //PRIMERO DEBEN APARECER LOS QUE YA ESTÁN EN EL MENU  
            ->orderBy('codCategoria','ASC')
            ->get();
        
        
        return view('tablas.productos.verMenu',compact('listaProductos','buscarpor'));
        return $listaProductos;
    }   


    //quita todos los productos del menu (setea su menuDeHoy en 0)
    public function limpiarMenu(){

        try {
            DB::beginTransaction();
            DB::select('update producto set menuDeHoy ="0"');

            DB::commit();
            return redirect()->route('producto.verMenu')->with('datos','¡Menu limpiado!');
        } catch (\Throwable $th) {
            
            error_log('HA OCURRIDO UN ERROR EN EL LIMPIAR MENU 
            
            '.$th.'
            
            
            ');
            

            DB::rollBack();
        }
        
    

    }


    //AÑADE O QUITA AL PRODUCTO DEL MENU DE HOY
    public function añadirAlMenu($codProducto){
        $prod = Producto::findOrFail($codProducto); 
        error_log('                             '.$prod->menuDeHoy.'                            ');
        if($prod->menuDeHoy=='0'){ //si no está
            $prod->menuDeHoy='1'; //lo añadimos
            $prod->save();
            return true;
        }
        else
        {
            $prod->menuDeHoy='0'; //lo quitamos
            $prod->save();
            return false;
        }


    }

    //PARA ajax
    public function listarProductosCategoria(Request $request,$id){
        $productos=Producto::where('codCategoria','=',$id)
        ->where('estado','=','1') //que existan aun 
        ->where('menuDeHoy','=','1') //que estén en el menu de hoy 
        ->get();



        return response()->json(['productos'=>$productos]);
    }

    //PARA get
    public function buscarProducto($id){
        $producto=Producto::find($id);
        return $producto;
        //return response()->json(['producto'=>$producto]);
    }
}
