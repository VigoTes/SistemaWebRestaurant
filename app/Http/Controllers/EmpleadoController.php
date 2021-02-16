<?php

namespace App\Http\Controllers;

use App\TipoEmpleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Empleado;
use App\User;
use Illuminate\Support\Facades\Hash;
class EmpleadoController extends Controller
{


    //lista todos los empleados con sus cuentas
    public function listar(){
        $lista = DB::select("
                SELECT e.codEmpleado, te.nombrePuesto, e.nombres,e.apellidos,e.telefono,e.fechaContrato,e.fechaFinContrato,e.idUsuario,u.usuario,u.email FROM empleado e
                inner join usuario u on e.idUsuario = u.id
                inner join tipo_empleado te on te.codTipoEmpleado = e.codTipoEmpleado
                where e.activo='1'
        ");
        $buscarpor = '';
        return view('tablas.empleados.index',compact('lista','buscarpor'));
    }

    //despliega la vista de crear usuario 
    public function verCrear(){

        $listaPuestos = TipoEmpleado::All();
        return view('tablas.empleados.create',compact('listaPuestos'));

    }


    public function delete($idEmpleado){
        $e = Empleado::findOrFail($idEmpleado);
        //desactivamos el empleado
        $user = User::findOrFail($e->idUsuario);
        $e->estado = '0';
        $e->idUsuario='-1';
        //y borramos su usuario
        $user->delete();
        $e->save();

        return redirect()->route('empleados.ver')->with('datos','¡Registro borrado!');

    }

    public function store(Request $request){

        try {
            DB::beginTransaction();
        

            $user  = new User();
            $user->usuario = $request->usuario;
            $user->email = $request->email;
            $user->password = Hash::Make($request->password);
            
            $user->save();
            

            $empleado = new Empleado();
            $empleado->nombres = $request->nombres;
            $empleado->apellidos = $request->apellidos;
            $empleado->telefono = $request->telefono;
            $empleado->fechaContrato = $request->fechaI;
            $empleado->fechaFinContrato = $request->fechaF;
            $empleado->activo = '1';
            $empleado->codTipoEmpleado = $request->codTipoEmpleado;
            $empleado->idUsuario=(User::latest('id')->first())->id;
			$empleado->save();

            return redirect()->route('empleados.ver');

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            error_log('HA OCURRIDO UN ERRO EN EMPLEADO CONTROLLER STORE
            
            '.$th.'

            
            ');
            DB::rollBack();
        }


        

    }

}
