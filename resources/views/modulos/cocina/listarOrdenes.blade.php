@extends ('layout.plantilla')

@section('contenido')


  <h3> LISTADO DE PEDIDOS PENDIENTES </h3>

  @if(session('datos'))
    <div class ="alert alert-warning alert-dismissible fade show mt-3" role ="alert">
        {{session('datos')}}
      <button type = "button" class ="close" data-dismiss="alert" aria-label="close">
          <span aria-hidden="true"> &times;</span>
      </button>
    </div>
  @ENDIF

          <form class="form-inline my-2 my-lg-0" action="{{route('orden.listarParaCocina')}}">

            <input type="hidden" id="indicador" name="indicador" value="1">

            <div class="container">
              <div class="row">
                <div class="col-sm">
                  <label for="sala">Sala:</label>
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


                <div class="col">
                  <label for="">Filtros de ordenes:</label>
                </div>
                <div class="col-sm" >
                  <div class="form-check" style=" height=100%;">
                    <table  style="height=500px">
                      <tbody>
                          <tr>
                              <td>
                                <input name="CheckBox_1" id="CheckBox_1"  class="form-check-input" type="checkbox" 
                                @if($vectorCB[0]=="on")
                                  checked  
                                @endif
                                >
                              </td>
                              <td>
                                <input name="CheckBox_2" id="CheckBox_2"  class="form-check-input" type="checkbox" 
                                @if($vectorCB[1]=="on")
                                  checked  
                                @endif
                                >
                              </td>
                              <td>
                                <input name="CheckBox_3" id="CheckBox_3"  class="form-check-input" type="checkbox" 
                                @if($vectorCB[2]=="on")
                                  checked  
                                @endif
                                >
                              </td>
                              <td>
                                <input name="CheckBox_4" id="CheckBox_4"  class="form-check-input" type="checkbox" 
                                @if($vectorCB[3]=="on")
                                  checked  
                                @endif
                                >
                              </td>
                              <td>
                                <input name="CheckBox_5" id="CheckBox_5"  class="form-check-input" type="checkbox" 
                                @if($vectorCB[4]=="on")
                                  checked  
                                @endif
                                >
                              </td>
                          </tr>
      
                          <tr>
                              <td>
                                <i class="fas fa-clock fa-xs"> </i>
                              </td>
                              <td>
                                <i class="fas fa-fire fa-xs"> </i>
                              </td>
                              <td>
                                <i class="fas fa-check fa-xs"> </i>
                              </td>
                              <td>
                                <i class="fas fa-check-double fa-xs"> </i>
                              </td>
                              <td>
                                <i class="fas fa-fire fa-xs"> </i>
                              </td>
                          </tr>
                      </tbody>
                    </table>
                  </div>
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
                <i class="{{$itemOrden->iconoEstadoActual()}}"></i>
              </td>
              <td style="text-align:right">
                S/. {{number_format( $itemOrden->calcularCosto(),2) }}
              </td>
              
              <td style="text-align: center">

                  {{-- Si ya está entregada,  ya no deberia salirle al cocinero --}}
                    @if($itemOrden->codEstado<3)
                        <a href="{{route('orden.next',$itemOrden->codOrden)}}" class = "btn btn-success">  
                          <i class="{{$itemOrden->iconoEstadoSiguiente()}}"></i>
                        </a>    
                    @endif
                    
                    
                
               
              </td>
          </tr>
      @endforeach
    </tbody>
  </table>

{{-- {{$cliente->links()}}  --}}

<style>
input[type='checkbox'] {
    /* -webkit-appearance:none; */
    width:25px;
    height:25px;
    background:white;
    border-radius:15px;
    border:2px solid #555;
}
input[type='checkbox']:checked {
    background: #abd;
}


</style>


@endsection