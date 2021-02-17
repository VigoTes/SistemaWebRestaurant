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


<div class="container">

  <form method = "POST" action = "{{ route('sala.store') }}" onsubmit="return validar()" >
    @csrf   
  <div class="form-group">
    <label for="nombre">Nombre de la Sala</label>
    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" placeHolder="Ingrese nombre">
    
    @error('nombre')
        <span class = "invalid-feedback" role ="alert">
            <strong>{{ $message }} </strong>
        </span>
    @enderror  
 
  </div>
 
    <button type="submit" class="btn btn-primary">   <i class="fas fa-save"> </i> Grabar </button>
    <a href = "{{route('sala.index')}}" class = "btn btn-danger">
        <i class="fas fa-ban"> </i> Cancelar </a>




</form>

</div>

@endsection