@extends('layout.plantilla')
@section('contenido')

<script type="text/javascript"> 
          
  function validar() {
    if (document.getElementById("nombre").value == ""){
        alert("Ingrese nombre de la categoria");
        $("#nombre").focus();
    }
    else{
        return true; // enviamos el formulario	
    }
    return false;
  }
  
</script>


<div class="container">

  <form method = "POST" action = "{{ route('categoria.store') }}" onsubmit="return validar()" >
    @csrf   
  <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" placeHolder="Ingrese nombre">
    
    @error('nombre')
        <span class = "invalid-feedback" role ="alert">
            <strong>{{ $message }} </strong>
        </span>
    @enderror  
 
  </div>
  <!--
  <div class="form-group">
    <label for="categoria">Categoria</label>
    <select class="form-control @error('codMacroCategoria') is-invalid @enderror" id="codMacroCategoria" name="codMacroCategoria" >
    </select>
  </div>
  -->
  
    <button type="submit" class="btn btn-primary">   <i class="fas fa-save"> </i> Grabar </button>
    <a href = "{{route('categoria.index')}}" class = "btn btn-danger">
        <i class="fas fa-ban"> </i> Cancelar </a>




</form>

</div>

@endsection