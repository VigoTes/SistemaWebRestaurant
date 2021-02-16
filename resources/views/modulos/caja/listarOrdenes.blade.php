@extends ('layout.plantilla')

@section('contenido')

<div class="container">

  <h3> LISTADO DE PEDIDOS PENDIENTES </h3>

  @if(session('datos'))
    <div class ="alert alert-warning alert-dismissible fade show mt-3" role ="alert">
        {{session('datos')}}
      <button type = "button" class ="close" data-dismiss="alert" aria-label="close">
          <span aria-hidden="true"> &times;</span>
      </button>
    </div>
  @ENDIF


  



  
  



          <form style="margin-bottom: 20px" action="{{route('orden.index')}}">

            <input type="hidden" id="indicador" name="indicador" value="1">

            <div class="container">
              <div class="row">
                <div class="col"> </div>
                <div class="col-sm">
                  <label for="sala" style="float:right">Sala:</label>
                </div>
                <div class="col-sm"  >
                  
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
              
                <div class="col-sm">
                  <input class="form-control mr-sm-1" type="search" placeholder="Buscar por nombre" 
                    aria-label="Search" id="buscarpor" name = "buscarpor" value =""  >
                  
                </div>

                <div class="col">
                  <button class="btn btn-success my-2 my-sm-0" type="submit"  >Buscar</button>
                </div>
              </div>


            </div>

            

        </form>

  


  <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Sala</th>
              <th scope="col">Mesa</th>
              <th scope="col"># Platos</th>
              
              <th scope="col">Hora pedido</th>
              <th scope="col">Estado</th>
              <th scope="col">Pagado</th>
              <th scope="col">Costo</th>
              <th scope="col">Opciones</th>
            </tr>
          </thead>
    <tbody>
      {{--     varQuePasamos  nuevoNombre                        --}}
      @foreach($ordenes as $itemOrden)
            <tr>
              <td>{{$itemOrden->getNombreSala()  }}</td>
              <td style="text-align: center">{{$itemOrden->getNroMesaEnSala()  }}</td>
              <td>  {{$itemOrden->listarProductos()}}      </td>
              <td style="text-align: center">{{$itemOrden->getHoraCreacion()  }}</td>
              <td style="text-align: center">{{$itemOrden->getEstado()}}
                <br>
                <i class="{{$itemOrden->iconoEstadoSiguiente()}}"></i>
              </td>
              <td>
                {{$itemOrden->getEstadoPago()}}

              </td>
              <td style="text-align:right">
                S/. {{number_format( $itemOrden->calcularCosto(),2) }}
              </td>
     
              
              <td style="text-align: center">


                @if($itemOrden->estadoPago=='0')
                <a href="{{route('orden.ventanaPago',$itemOrden->codOrden)}}" class = "btn btn-success">  
                  <i class="fas fa-money-bill-wave"></i>
                </a>
                @endif
                <a href="/generarCDP" class = "btn btn-info">  
                  <i class="fas fa-file-download"></i>
                </a>
                    
                
               
              </td>
          </tr>
      @endforeach
    </tbody>
  </table>

{{-- {{$cliente->links()}}  --}}


</div>


@endsection