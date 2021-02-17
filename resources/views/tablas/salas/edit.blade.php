@extends('layout.plantilla')
@section('contenido')

<script type="text/javascript"> 
          
  function validar() {
    if (document.getElementById("nombre").value == ""){
        alert("Ingrese nombre de la sala");
        $("#nombre").focus();
    }
    else{
        return true; // enviamos el formulario	
    }
    return false;
  }
  
</script>
   


@if (session('datos'))
<div class ="alert alert-warning alert-dismissible fade show mt-3" role ="alert">
    {{session('datos')}}
  <button type = "button" class ="close" data-dismiss="alert" aria-label="close">
      <span aria-hidden="true"> &times;</span>
  </button>
  
</div>
@ENDIF





<div class="container">
  <form method="POST" action="{{route('sala.update',$sala->codSala)}}"  onsubmit="return validar()" >
    @method('put')
    @csrf
    <div class="form-group">
            <label for="categoria_id">Codigo:</label>
        <input type="text" class="form-control" id="categoria_id" name="categoria_id" value='{{$sala->codSala}}' readonly>
    </div>

    <div class="form-group">
      <label for="nombre">Nombre:</label>
      <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre"  value='{{$sala->nombre}}' name="nombre">
      @error('nombre')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
        </span>
      @enderror
    </div>

    
    <button type="submit" class="btn btn-primary">Grabar</button>
    <a href="{{route('sala.index')}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>
  </form>
</div>






<form method = "POST" action = "{{route('mesa.store')}}" onsubmit="return validarAñadirMesa()" >
  @csrf   

<div class="form-group">

 <div class="container">  {{-- Container  --}}
      <div class="row">
      
          <div class="col"> 
               {{-- CONTENIDO COLUMNA --}}
              <br>
              
              <label for="descripcion">Mesas de la sala </label>
              <br>
                  <div class="container">
                      <div class="row">
                          
                           {{-- INPUT INVISIBLE PARA GUARDAR EL VALOR DE LA ID PROCESO --}}   
                          <input type="hidden" class="form-control" 
                                      id="codSala" name="codSala" value = {{$sala->codSala}}>
                          
                          <div class="col">
                          {{-- ESTE ES EL INPUT DEL QUE QUIERO AGARRAR SU VALOR --}}
                              <input type="text" class="form-control @error('nroSillas') is-invalid @enderror" 
                                      id="nroSillas" name="nroSillas" placeholder="Cantidad de sillas...">
                        


                          </div>

                          <div class="col">
                              <button type="submit" class="btn btn-primary">  
                                         <i class="fas fa-plus"> </i>  Añadir Mesa 
                              </button>
                          </div>
                          
                      </div>
                  </div>
                <br>
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                          <th scope="col" style = "width: 2%">Codigo Unico</th>
                          <th scope="col" style = "width: 65%">Nro Mesa en la Sala </th>
                          <th scope="col" style = "width: 65%">Nro de Sillas </th>
                          
                          <th scope="col" style = "width: 20%">Opciones</th>
                          </tr>
                      </thead>
                      <tbody>

                      {{-- LISTADO DE LOS OBJETIVOS DE LA EMPRESA --}}
                      @foreach($listaMesas as $itemMesa)

                          <tr>
                            <td>{{$itemMesa->codMesa}}</td>
                            
                              <td>{{$itemMesa->nroEnSala}}</td>
                              <td>{{$itemMesa->nroSillas}}</td>
                              
                              <td> 
                                <a href="#" class="btn btn-danger" title="Eliminar registro" onclick="swal({//sweetalert
                                  title:'¿Está seguro de eliminar la mesa: {{$itemMesa->nroEnSala}}?',
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
                                window.location.href='{{route('mesa.eliminar',$itemMesa->codMesa)}}';
                              });"><i class="fas fa-trash-alt"> </i></a>
                              </td>
                          </tr>
                       @endforeach
                      </tbody>
                  </table>
              

               {{-- FIN CONTENIDO COLUMNA--}}
          </div>
      </div>
  </div>
 </div>

</form> {{-- FORM GRUP --}}

<script>

  function validarAñadirMesa(){
    if (document.getElementById("nroSillas").value == ""){
        alert("Ingrese nombre de la sala");
        $("#nroSillas").focus();

        return false;
    }
    if ( tiene_letras (document.getElementById("nroSillas").value) ){
        alert("Ingrese una cantidad de sillas valida.");
        $("#nroSillas").focus();

        return false;
    }
    
    return true;


  }


  var letras="abcdefghyjklmnñopqrstuvwxyz";

  function tiene_letras(texto){
    texto = texto.toLowerCase();
    for(i=0; i<texto.length; i++){
        if (letras.indexOf(texto.charAt(i),0)!=-1){
          return 1;
        }
    }
    return 0;
  }

</script>
                                 

@endsection