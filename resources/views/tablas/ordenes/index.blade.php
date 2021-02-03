@extends ('layout.plantilla')

@section('contenido')
<h3> LISTADO DE PEDIDOS PENDIENTES </h3>


    <a href="{{route('cabeceraventa.create')}}" class = "btn btn-primary"> 
        <i class="fas fa-plus"> </i> 
          Nueva Orden
    </a>

    <nav class = "navbar float-right" style=""> {{-- PARA MANDARLO A LA DERECHA --}}
            <form class="form-inline my-2 my-lg-0" action="{{route('orden.index')}}">
              
              
              <h3>Sala:</h3>
             
              <select class="form-control"  id="sala" name="sala" value="{{$codSala}}">
                
                <option value="0">Todas las salas</option>  
                @foreach($listaSalas as $itemSala)
                    <option value="{{$itemSala->codSala}}" 
                        @if($itemSala->codSala == $codSala)
                          selected
                        @endif
                      >
                      {{$itemSala->nombre}}
                    </option>                                 
                @endforeach    

              </select>  

            <input class="form-control mr-sm-2" type="search" placeholder="Buscar por nombre" aria-label="Search" id="buscarpor" name = "buscarpor" value ="" >
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
                <th scope="col">Sala</th>
                <th scope="col">Mesa</th>
                <th scope="col"># Platos</th>
                <th scope="col">Observaciones</th>
                <th scope="col">Hora pedido</th>
                <th scope="col">Estado</th>
                <th scope="col">Costo</th>
                <th scope="col">Opciones</th>
              </tr>
            </thead>
      <tbody>
        {{--     varQuePasamos  nuevoNombre                        --}}
        @foreach($ordenes as $itemOrden)
              <tr>
                <td>{{$itemOrden->getNombreSala()  }}</td>
                <td>{{$itemOrden->getNroMesaEnSala()  }}</td>
                <td>{{$itemOrden->listarProductos()}}</td>
                <td>{{$itemOrden->observaciones  }}</td>
                <td>{{$itemOrden->getHoraCreacion()  }}</td>
                

                
                <td>{{$itemOrden->getEstado()}}</td>
                <td>{{$itemOrden->calcularCosto()}}</td>
       
                
                <td>


                    @if($itemOrden->codEstado<4)
                      <a href="{{route('orden.next',$itemOrden->codOrden)}}" class = "btn btn-warning">  
                        <i class="{{$itemOrden->botonAsignado()}}"></i>
                      </a>  
                    @endif
                    

                    <a href="" class = "btn btn-danger"> 
                        <i class="fas fa-trash-alt"> </i> 
                          
                    </a>
                 
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>

{{-- {{$cliente->links()}}  --}}



@endsection