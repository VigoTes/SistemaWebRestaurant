@extends ('layout.plantilla')

@section('contenido')

  <h3> LISTADO DE EMPLEADOS</h3>


    <a href="{{route('empleados.verCrear')}}" class = "btn btn-primary"> 
        <i class="fas fa-plus"> </i> 
          Nuevo Registro
    </a>

    <nav class = "navbar float-right"> {{-- PARA MANDARLO A LA DERECHA --}}
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar por descripcion" aria-label="Search" id="buscarpor" name = "buscarpor" value ="{{($buscarpor)}}" >
            <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    </nav>


{{-- AQUI FALTA EL CODIGO SESSION DATOS ENDIF xdd --}}
      @if (session('datos'))
        <div class ="alert alert-warning alert-dismissible fade show mt-3" role ="alert">
            {{session('datos')}}
          <button type = "button" class ="close" data-dismiss="alert" aria-label="close">
              <span aria-hidden="true"> &times;</span>
          </button>
          
        </div>
      @ENDIF

    <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Cod Empleado</th>
                <th scope="col">Tipo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Telefono</th>
               {{--  <th scope="col">Fecha Contrato</th>
                <th scope="col">Fecha Fin</th> --}}
                <th scope="col">idUsuario</th>
                <th scope="col">usuario</th>
                <th scope="col">email</th>
                
                <th scope="col">Opciones</th>
                
              </tr>
            </thead>
      <tbody>
        


        {{--     varQuePasamos  nuevoNombre                        --}}
        @foreach($lista as $itemlista)

          
            <tr>
                <td>{{$itemlista->codEmpleado  }}</td>
                <td>{{$itemlista->nombrePuesto}}</td>
                <td>{{$itemlista->nombres.' '.$itemlista->apellidos  }}</td>
                <td>{{$itemlista->telefono  }}</td>
               {{--  <td>{{$itemlista->fechaContrato  }}</td>
                <td>{{$itemlista->fechaFinContrato  }}</td> --}}
                <td>{{$itemlista->idUsuario  }}</td>
                <td>{{$itemlista->usuario  }}</td>
                <td>{{$itemlista->email  }}</td>
              
             
                <td>


                        {{-- MODIFICAR RUTAS DE Delete y Edit --}}
                    <a href="{{route('empleados.edit',$itemlista->codEmpleado)}}" class = "btn btn-warning"><i class="fas fa-edit"></i>Editar</a>
                    <!--
                    <a href="" class = "btn btn-danger"> 
                        <i class="fas fa-trash-alt"> </i> 
                          Eliminar
                    </a>
                    -->
                    <a href="#" class="btn btn-danger" title="Eliminar registro" onclick="swal({//sweetalert
                          title:'¿Está seguro de eliminar al empleado: {{$itemlista->nombres}} ?',
                          //type: 'warning',  
                          type: 'warning',
                          showCancelButton: true,//para que se muestre el boton de cancelar
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText:  'SI',
                          cancelButtonText:  'NO',
                          closeOnConfirm:     true,//para mostrar el boton de confirmar
                          html : true
                      },
                      function(){//se ejecuta cuando damos a aceptar
                        window.location.href='{{route('empleados.delete',$itemlista->codEmpleado)}}';
                      });"><i class="fas fa-trash-alt"> </i>Eliminar
                    </a>

                </td>

            </tr>
        @endforeach
      </tbody>
    </table>





@endsection