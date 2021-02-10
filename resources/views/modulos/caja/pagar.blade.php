@extends('layout.plantilla')
@section('contenido')


<div class="container">

  <form method = "POST" action = "{{ route('orden.pagar',$orden->codOrden) }}"  >
    @csrf   
    <div class="form-group">
      <label for="nroDeOrden">N° de Orden</label>
      <input class="form-control" type="number" style="width: 150px;"
       id="nroDeOrden" name="nroDeOrden" readonly="readonly" value="{{$orden->codOrden}}">
    </div>
    <div class="container">
      <div class="row">
        <div class="col">{{-- DIV DEL CLIENTE --}}

          <div class="form-group">
            <label for="clientes">Cliente frecuente</label>
            <select class="form-control" id="clientes" name="clientes" >
              <option value="-1"> -- Seleccione --</option>
                @foreach($listaClientes as $itemCliente)
                  <option value="{{$itemCliente->DNI}}"> 
                    {{$itemCliente->nombres}} {{$itemCliente->apellidos}}
                  </option>
                @endforeach
              
            </select>
          </div>

          <div class="form-group">
            <label for="nombre">Nombre del Cliente</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" placeHolder="Ingrese nombre">
            
            @error('nombre')
                <span class = "invalid-feedback" role ="alert">
                    <strong>{{ $message }} </strong>
                </span>
            @enderror  
          </div>
        
          <div class="form-group">
            <label for="DNI">DNI</label>
            <input type="text" class="form-control @error('DNI') is-invalid @enderror" id="DNI" name="DNI" placeHolder="Ingrese nombre">
            
            @error('DNI')
                <span class = "invalid-feedback" role ="alert">
                    <strong>{{ $message }} </strong>
                </span>
            @enderror  
         
          </div>

        </div>
        <div class="col"> {{-- DIV DE BOLETA --}}
          <div class="form-group">
            <label for="tipoCDP">Tipo de Comprobante</label>
            <select class="form-control @error('tipoCDP') is-invalid @enderror" id="tipoCDP" name="tipoCDP" >
              <option value="-1"> -- Seleccione --</option>
              <option value="1"> Boleta</option>
              <option value="2"> Factura </option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="tipoPago">Tipo de Pago</label>
            <select class="form-control @error('tipoPago') is-invalid @enderror" id="tipoPago" name="tipoPago" >
              <option value="-1"> -- Seleccione --</option>
              <option value="1"> Contado</option>
              <option value="2"> Cuotas </option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="medioPago">Medio de Pago</label>
            <select class="form-control @error('medioPago') is-invalid @enderror" id="medioPago" name="medioPago" >
              <option value="-1"> -- Seleccione --</option>
              <option value="1"> Efectivo  </option>
              <option value="2"> Tarjeta </option>
            </select>
          </div>
          

        </div>
        <div class="w-100"></div>
        <div class="col">
          {{-- AQUI VA LA TABLA --}}


        </div>
        <div class="col">



        </div>
      </div>
    </div>

    


    


    
  
      

    
    
    

    <div class="form-group">
      <label for="montoOrden">Monto de la Orden</label>
      <input class="form-control" type="number" style="width: 150px;"
       id="montoOrden" name="montoOrden" readonly="readonly" value="{{$orden->costoTotal}}">
    </div>
    
    <div class="form-group">
      <label for="tipoCDP">Sencillo del Cliente</label>
      <input class="form-control" type="number" style="width: 150px;"
       id="sencilloCliente" name="sencilloCliente" step="0.01">
    </div>
    
    <div class="form-group">
      <label for="tipoCDP">Sencillo devuelto</label>
      <input class="form-control" type="number" style="width: 150px;"
       id="sencilloDevuelto" name="sencilloDevuelto" readonly="readonly">
    </div>
    
    
    
    
  
    <button type="submit" class="btn btn-primary">   <i class="fas fa-save"> </i> Grabar </button>
    <a href = "{{route('orden.listarParaCaja')}}" class = "btn btn-danger">
        <i class="fas fa-ban"> </i> Cancelar </a>




</form>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>


    document.getElementById("sencilloCliente").addEventListener("change", function(){
      //This input has changed
      montoOrden = $('#montoOrden').val();
      sencilloCliente = $('#sencilloCliente').val();
      $('#sencilloDevuelto').val(sencilloCliente-montoOrden);
    });



    /* $(document).ready(function(){
        $('#sencilloCliente').input(function(){
          alert('cambi');
        });
      
      
      
      }); */




</script>

@endsection