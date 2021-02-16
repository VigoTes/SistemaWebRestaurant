<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Empleado;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function logearse(Request $request)
    {
        $data=$request->validate([
            'usuario'=>'required',
            'password'=>'required',
        ],
        [
            'usuario.required'=>'Ingrese Usuario',
            'password.required'=>'Ingrese Contraseña',
        ]);
            $name=$request->get('usuario');
            $query=User::where('usuario','=',$name)->get();
            if($query->count()!=0){
                $hashp=$query[0]->password;
                $password=$request->get('password');
                error_log('-----------------------------------query:'.$hashp.'                
                
                
                '.Hash::make($password));
                if(password_verify($password,$hashp))
                {
                    
                    if(Auth::attempt($request->only('usuario','password')))
                        if($name=='admin'){//INGRESO DEL ADMIN
                            return redirect()->route('indexPrincipal');
                        }
                        //USER NORMAL
                        else{
                            //este attempt es para que el Auth se inicie
                        
                            return redirect()->route( $this->miRutaPrincipal());
                        }


                    
                  
                }
                else{
                    
                    return redirect()->route('user.verLogin')->with('datos','¡Contraseña no valida!');
                }                
            }
            else
            {
                return redirect()->route('user.verLogin')->with('datos','Usuario no valido!');
            }
        }


        //devuelve las vistas de cocina, mesero o caja segun sea el actor que esté logeado
        public function miRutaPrincipal(){
            $rutaPaIr = '';
            error_log('auth:'.Auth::id());
            $tipo = Empleado::getEmpleadoLogeado()->codTipoEmpleado;
            switch ($tipo) {
                case '1': //COCINERO
                    $rutaPaIr = 'orden.listarParaCocina';
                    break;
                case '2': //CAJERO
                    $rutaPaIr = 'orden.listarParaCaja';
                    break;
                case '3': //MESERO
                    $rutaPaIr = 'orden.listarSalas';
                    break;
                            
                default:
                $rutaPaIr = 'indexPrincipal';
                    break;
            }

            return $rutaPaIr;

        }

        public function verLogin(){
            return view('login');
            
        }
    
        public function cerrarSesion(){
            Auth::logout();
            session(['token' => '-2']);
            return redirect()->route('user.verLogin');  
        }





}
