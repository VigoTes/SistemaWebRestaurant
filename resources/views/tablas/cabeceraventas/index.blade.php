@extends ('layout.plantilla')

@section('contenido')
<h3> LISTADO DE FACTURAS BOLETAS </h3>


    <a href="{{route('cabeceraventa.create')}}" class = "btn btn-primary"> 
        <i class="fas fa-plus"> </i> 
          Nuevo Registro
    </a>

    <nav class = "navbar float-right" > {{-- PARA MANDARLO A LA DERECHA --}}
        <form class="form-inline my-2 my-lg-0" action="">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar por nombre" aria-label="Search" id="buscarpor" name = "buscarpor" value ="{{($buscarpor)}}" >
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
                <th scope="col">Codigo</th>
                <th scope="col">Tipo F o B</th>
                <th scope="col">NroDoc</th>
                <th scope="col">Fecha</th>
                <th scope="col">RUC/dni</th>
                <th scope="col">Cliente</th>
                <th scope="col">Total</th>
                

                <th scope="col">Opciones</th>
              </tr>
            </thead>
      <tbody>
        {{--     varQuePasamos  nuevoNombre                        --}}
        @foreach($ventas as $itemVentas)
              <tr>
                <td>{{$itemVentas->venta_id  }}</td>
                <td>{{$itemVentas->tipo->descripcion  }}</td>
                <td>{{$itemVentas->nrodocumento}}</td>
                <td>{{$itemVentas->fecha_venta}}</td>
                <td>{{$itemVentas->cliente->ruc_dni}}</td>
                <td>{{$itemVentas->cliente->nombres}}</td>
                <td>{{$itemVentas->total}}</td>
                  
                
                <td>


                    
                   {{--  <a href="{{route('cliente.edit',$itemCliente->codcliente)}}" class = "btn btn-warning">  
                        <i class="fas fa-edit"> </i> 
                          Editar
                    </a>

                    <a href="{{route('cliente.confirmar',$itemCliente->codcliente)}}" class = "btn btn-danger"> 
                        <i class="fas fa-trash-alt"> </i> 
                          Eliminar
                    </a>
                     --}}
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>

{{-- {{$cliente->links()}}  --}}



@endsection