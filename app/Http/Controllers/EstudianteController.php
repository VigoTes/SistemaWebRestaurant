<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudiante;
use App\Facultad;
use App\Escuela;

class EstudianteController extends Controller
{
    

    const PAGINATION = '4';


    public function index(Request $request)
    {
        $buscarpor = $request->buscarpor;
        $estudiante = Estudiante::where('estado','=','1')
            ->where('Apellidos','like','%'.$buscarpor.'%')->paginate($this::PAGINATION);

        return view('tablas.estudiantes.index',compact('estudiante','buscarpor'));  


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $escuela = Escuela::All(); //enviamos las cat activas
        $facultad = Facultad::All(); //enviamos las cat activas
        
        return view ('tablas.estudiantes.create',compact('escuela','facultad'));
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
                'Nombres'=>'required|max:40',
                'Apellidos'=>'required|max:40',
                'Direccion'=>'required|max:40',
                'Edad'=>'required'
            ],[
                'Nombres.required'=>'Ingrese nombres',
                'Nombres.max' => 'Maximo 40 caracteres el nombre',

                'Apellidos.required'=>'Ingrese apellidos',
                'Apellidos.max' => 'Maximo 40 caracteres los apellidos',
                
                'Direccion.required'=>'Ingrese la direccion',
                'Direccion.max' => 'Maximo 40 caracteres la direccion',
                
                'Edad.required'=>'Ingrese edad'                
            ]

            );

            // VALIDAMOS QUE LA ESCUELA SELECCIONADA PERTENEZCA A LA FACULTAD
            $escuela = Escuela::FindOrFail($request->CodEscuela); //escuela del estudiante
            $facultad = Facultad::FindOrFail($request->CodFacultad); //escuela del estudiante
            
            if($escuela->CodFacultad != $facultad->CodFacultad){
                return redirect()->route('Estudiante.index')->with('datos','Error: La escuela no pertenece a la facultad seleccionada.');
            }


            $estudiante = new Estudiante();
            
            $estudiante->Apellidos=$request->Apellidos;
            $estudiante->Nombres=$request->Nombres;
            $estudiante->Direccion=$request->Direccion;
            $estudiante->CodFacultad=$request->CodFacultad;
            $estudiante->CodEscuela=$request->CodEscuela;
            $estudiante->Edad=$request->Edad;
            


            $estudiante->estado='1';              

            $estudiante->save();
                return redirect()->route('Estudiante.index')->with('datos','Registro nuevo guardado');






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
        $estudiante=Estudiante::findOrFail($id);                                  
        $escuela = Escuela::All();                          
        $facultad = Facultad::All();                          
        return view('tablas.estudiantes.edit',compact('estudiante','escuela','facultad'));

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
        
        $data=request()->validate([ 
            'Apellidos'=>'required|max:40'          
            ,'Nombres'=>'required|max:40'      
            ,'Direccion'=>'required|max:40'                            
            ,'Edad'=>'required'
            ,'CodEscuela'=>'required'
            ,'CodFacultad'=>'required'


            ],
            [ 
            'Apellidos.required'=>'Ingrese Apellidos',
            'Apellidos.max'=>'Maximo 40 de caracteres para los apellidos'    ,
            
            'Nombres.required'=>'Ingrese Apellidos',
            'Nombres.max'=>'Maximo 40 de caracteres para los apellidos'    ,
            
            'Direccion.required'=>'Ingrese Apellidos',
            'Direccion.max'=>'Maximo 40 de caracteres para los apellidos' ,   

            'Edad.required'=>'Ingrese Edad',
            'CodEscuela.required'=>'Ingrese CODIGO DE ESCUELA',
            'CodFacultad.required'=>'Ingrese CODIGO DE FACU',
        
            ]);        

           
       // VALIDAMOS QUE LA ESCUELA SELECCIONADA PERTENEZCA A LA FACULTAD
       $escuela = Escuela::FindOrFail($request->CodEscuela); //escuela del estudiante
       $facultad = Facultad::FindOrFail($request->CodFacultad); //escuela del estudiante
       
       if($escuela->CodFacultad != $facultad->CodFacultad){
           return redirect()->route('Estudiante.index')->with('datos','Error: La escuela no pertenece a la facultad seleccionada.');
       }        

       $estudiante=Estudiante::findOrFail($id);

       $estudiante->Apellidos=$request->Apellidos;
       $estudiante->Nombres=$request->Nombres;

       $estudiante->Direccion=$request->Direccion;

       $estudiante->CodEscuela=$request->CodEscuela;
       $estudiante->CodFacultad=$request->CodFacultad;
       $estudiante->Edad=$request->Edad;
       $estudiante->Estado='1';
       
       $estudiante->save();


       return redirect()->route('Estudiante.index')->with('datos','Registro Actualizado!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmar($id)
      {
              
          $estudiante=Estudiante::findOrFail($id);
          return view('tablas.estudiantes.confirmar',compact('estudiante'));

      }


    public function destroy($id)
    {
        $estudiante=Estudiante::findOrFail($id);
          $estudiante->estado='0';
          $estudiante->save();
          return redirect()->route('Estudiante.index')->with('datos','Registro Eliminado!');

    }
}
