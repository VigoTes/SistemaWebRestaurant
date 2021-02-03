<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Categoria;
use App\Unidad;


class ProductoController extends Controller
{
     const PAGINATION = '4';

    
    public function index(Request $request )
    {
        $buscarpor = $request->buscarpor;
        $producto = Producto::where('estado','=','1')
            ->where('descripcion','like','%'.$buscarpor.'%')->paginate($this::PAGINATION);

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

        $unidad = Unidad::where('estado','=','1')->get(); //enviamos las cat activas
        return view ('tablas.productos.create',compact('categoria','unidad'));
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
                'descripcion'=>'required|max:30',
                'codcategoria'=>'required',
                'codunidad'=>'required',
                'precio'=>'required',
                'stock'=>'required'
            ],[
                'descripcion.required'=>'Ingrese descripcion de categoria',
                'descripcion.max' => 'Maximo 30 caracteres la descripcion',
                'codcategoria.required'=>'Debe seleccionar una categoria ',
                'codunidad.required'=>'Debe seleccionar un tipo de unidad ',
                'descripcion.required'=>'Debe ingresar descripcion ',
                'precio.required'=>'Debe ingresar precio',
                'stock.required'=>'Debe Ingresar stock'
            ]

            );

            $producto = new Producto();
            
            $producto->descripcion=$request->descripcion;
            $producto->codcategoria=$request->codcategoria;
            $producto->codunidad=$request->codunidad;
            $producto->stock=$request->stock;
            $producto->precio=$request->precio;
            $producto->estado='1';              

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
          $unidad = Unidad::where('estado','=','1')->get();                          
          return view('tablas.productos.edit',compact('producto','categoria','unidad'));

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
            $data=request()->validate([ 
                    'descripcion'=>'required|max:30'                   
            ],
            [ 
            'descripcion.required'=>'Ingrese descripción de producto',
            'descripcion.max'=>'Maximo 30 de caracteres para la descripcion'                          
            ]);       
               $producto=Producto::findOrFail($codproducto);
               $producto->descripcion=$request->descripcion;
               $producto->codcategoria=$request->codcategoria;
               $producto->codunidad=$request->codunidad;
               $producto->precio=$request->precio;
               $producto->stock=$request->stock;
               $producto->save();
               return redirect()->route('producto.index')->with('datos','Registro Actualizado!');
     
    }

    public function confirmar($codproducto)
      {
          //        
          $producto=Producto::findOrFail($codproducto);
          return view('tablas.productos.confirmar',compact('producto'));
      }



    public function destroy($codproducto)
    {
        $producto=Producto::findOrFail($codproducto);
          $producto->estado='0';
          $producto->save();
          return redirect()->route('producto.index')->with('datos','Registro Eliminado!');

    }
}
