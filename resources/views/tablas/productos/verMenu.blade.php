@extends ('layout.plantilla')

@section('contenido')


  <h3> LISTADO DE PRODUCTOS DEL MENU DE HOY </h3>

    {{-- AQUI FALTA EL CODIGO SESSION DATOS ENDIF xdd --}}
    @if (session('datos'))
      <div class ="alert alert-warning alert-dismissible fade show mt-3" role ="alert">
          {{session('datos')}}
        <button type = "button" class ="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true"> &times;</span>
        </button>
        
      </div>
    @endif

  <nav class = "navbar float-right" > {{-- PARA MANDARLO A LA DERECHA --}}
    <a href="#" class="btn btn-danger" title="Limpiar el Menú" onclick="swal({//sweetalert
        title:'¿Está seguro de quitar todos los productos del menú de hoy??',
        //type: 'warning',  
        type: 'warning',
        showCancelButton: true,//para que se muestre el boton de cancelar
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:  'Sí',
        cancelButtonText:  'No',
        closeOnConfirm:     true,//para mostrar el boton de confirmar
        html : true
      },
      function(){//se ejecuta cuando damos a aceptar
        window.location.href='{{route('producto.limpiarMenu')}}';
      });"><i class="fas fa-trash-alt"> </i> Limpiar el Menú
    </a>


      <form class="form-inline my-2 my-lg-0" action="{{route('producto.verMenu')}}" style="margin-left: 20px">
          <input class="form-control mr-sm-2" type="search" placeholder="Buscar por nombre" aria-label="Search" id="buscarpor" name = "buscarpor" value ="{{($buscarpor)}}" >
          <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
      </form>
  </nav>




  <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Codigo</th>
              <th scope="col">Nombre</th>
              <th scope="col">Categoria</th>
              <th scope="col">Precio</th>
              <th scope="col">En el menú</th>
              
            </tr>
          </thead>
    <tbody>
      {{--     varQuePasamos  nuevoNombre                        --}}
      @foreach($listaProductos as $itemProducto)
            <tr>
              <td>{{$itemProducto->codProducto  }}</td>
              <td>{{$itemProducto->nombre  }}</td>         
              <td>{{$itemProducto->categoria->nombre}}</td>
              <td>S/ {{$itemProducto->precioActual}}</td>
              <td>
             
                 
                    <input type="checkbox" aria-label="Checkbox for following text input" size="200%" onclick="cambio({{$itemProducto->codProducto}})"
                      @if($itemProducto->menuDeHoy=='1')
                          checked
                      @endif
                    
                    >
                 
          
              </td>

              
          </tr>
      @endforeach
    </tbody>
  </table>

{{-- {{$listaProductos->links()}} 
 --}}


<script>


function cambio(codProducto){
  
      $.get('/producto/añadirAlMenu/'+codProducto, function(data)
            {    
              console.log(data);
              if(data==1){
                
              console.log('Se AÑADIO al menú el producto' + codProducto);
              }else{
                
              console.log('Se QUITO del menú el producto' + codProducto);
              }
              
            } 
        );
  

}


</script>

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