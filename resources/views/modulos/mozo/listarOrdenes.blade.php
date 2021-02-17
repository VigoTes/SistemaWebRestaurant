@extends ('layout.plantilla')

@section('contenido')



  <h3> LISTADO DE PEDIDOS PENDIENTES PARA EL MESERO</h3>

  @if(session('datos'))
    <div class ="alert alert-warning alert-dismissible fade show mt-3" role ="alert">
        {{session('datos')}}
      <button type = "button" class ="close" data-dismiss="alert" aria-label="close">
          <span aria-hidden="true"> &times;</span>
      </button>
    </div>
  @ENDIF


  



  
  


        <form  action="{{route('orden.listarParaMesero')}}" style="margin-bottom: 20px;" >

            <input type="hidden" id="indicador" name="indicador" value="1">

            <div class="container">
              <div class="row">
                <div class="col-sm"></div>
                {{-- <div class="col-sm"></div>
                 --}}
                <div class="col-sm" >
                  <label for="sala" style="float: right">Sala:</label>
                </div>
                <div class="col" >
                  <select class="form-control mr-sm-4"  id="sala" name="sala" value="{{$codSala}}">
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

                </div>
              {{-- 
                <div class="col">
                  <input class="form-control mr-sm-1" type="search" placeholder="Buscar por nombre" 
                    aria-label="Search" id="buscarpor" name = "buscarpor" value =""  >
                    
                </div> --}}
                <div class="col-sm">
                  <button class="btn btn-success my-2 my-sm-0" type="submit"  > <i class="fas fa-search"></i> Buscar</button>
                </div>

              </div>
            </div>
        </form>

  
  <table class="table">
          <thead class="thead-dark">
            <tr>
              
              <th scope="col">Codigo</th>
              <th scope="col">Sala</th>
              <th scope="col">Mesa</th>
              <th scope="col" style="width: 500px;"># Platos</th>
              
              <th scope="col">Hora pedido</th>
              <th scope="col">Estado</th>
              <th scope="col">Costo</th>
              <th scope="col"  style="text-align: center">¿Pago?</th>
              
              <th scope="col"  style="text-align: center">Opciones</th>
            </tr>
          </thead>
    <tbody>

      {{--     varQuePasamos  nuevoNombre                        --}}
      @foreach($ordenes as $itemOrden)
            <tr>
              <td>{{$itemOrden->codOrden  }}</td>
              <td>{{$itemOrden->getNombreSala()  }}</td>
              <td style="text-align: center">{{$itemOrden->getNroMesaEnSala()  }}</td>
              <td>  {{$itemOrden->listarProductos()}}      </td>
              <td style="text-align: center">{{$itemOrden->getHoraCreacion()  }}</td>
              <td style="text-align: center">{{$itemOrden->getEstado()}} 
                <br>
                <i class="{{$itemOrden->iconoEstadoSiguiente()}}"></i>
              </td>
              <td style="text-align:right">
                S/. {{number_format( $itemOrden->calcularCosto(),2) }}
              </td>
              <td style="text-align: center">
                {{$itemOrden->getEstadoPago()}}

              </td>
              <td style="text-align: center">


                @if($itemOrden->estadoPago=='0')
                  <a href="{{route('orden.next',$itemOrden->codOrden)}}" class = "btn btn-success">  
                    <i class="{{$itemOrden->iconoEstadoSiguiente()}}"> Entregar</i>
                  </a>  
                @else
                  <a href="{{route('orden.finalizar',$itemOrden->codOrden)}}" class = "btn btn-success">  
                    <i class="fas fa-archive"> Finalizar y Liberar Mesa</i>
                  </a>  
                @endif
                
                    
                    
               
              </td>
          </tr>
      @endforeach
    </tbody>
  </table>

{{-- {{$cliente->links()}}  --}}





@endsection