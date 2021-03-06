@extends('layout.plantilla')
@section('contenido')

<div class="container">

  <h1> CREAR PRODUCTO</h1>

<form method = "POST" action = "{{route('producto.store')}}"  onsubmit="return validar()"  >
    @csrf   
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" placeHolder="Ingrese nombre">
        
        @error('nombre')
            <span class = "invalid-feedback" role ="alert">
                <strong>{{ $message }} </strong>
            </span>
        @enderror  
    
      </div>
      <div class="form-group">
        <label for="categoria">Categoria</label>
        <select class="form-control @error('codcategoria') is-invalid @enderror" id="codCategoria" name="codCategoria" >
          @foreach($categoria as $itemCategoria)
            <option value="{{$itemCategoria['codCategoria']}}"> 
                {{$itemCategoria['nombre']}}
            </option>

          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="descripcion">Descripcion:</label>
        <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="3"></textarea>
        @error('descripcion')
            <span class = "invalid-feedback" role ="alert">
                <strong>{{ $message }} </strong>
            </span>
        @enderror  
    
      </div>

          <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" step = "any" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" >
                      @error('precio')
                        <span class = "invalid-feedback" role ="alert">
                            <strong>{{ $message }} </strong>
                        </span>
                      @enderror  
            
          </div>

      
  
    <button type="submit" class="btn btn-primary">   <i class="fas fa-save"> </i> Grabar </button>
    <a href = "{{route('producto.index')}}" class = "btn btn-danger">
        <i class="fas fa-ban"> </i> Cancelar </a>




</form>


</div>
<script type="text/javascript"> 
          
  function validar() {
    if (document.getElementById("nombre").value == ""){
      alert("Ingrese nombre del producto");
      $("#nombre").focus();
    }
    else if (document.getElementById("codCategoria").value == "0"){
      alert("Seleccione tipo de categoria");
    }
    else if(document.getElementById("descripcion").value == ""){
      alert("Ingrese descripcion del producto");
      $("#descripcion").focus();
    }
    else if(document.getElementById("precio").value == ""){
      alert("Ingrese precio del empleado");
      $("#precio").focus();
    }
    else{
      return true; // enviamos el formulario	
    }
    return false;
  }
  
</script>

@endsection