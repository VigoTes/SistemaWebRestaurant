@extends('layout.plantilla')
@section('contenido')

<script type="text/javascript"> 
          
  function validar() {
    if (document.getElementById("nombres").value == ""){
      alert("Ingrese nombres del empleado");
      $("#nombres").focus();
    }
    else if(document.getElementById("apellidos").value == ""){
      alert("Ingrese apellidos del empleado");
      $("#apellidos").focus();
    }
    else if(document.getElementById("telefono").value == ""){
      alert("Ingrese telefono del empleado");
      $("#telefono").focus();
    }
    else if(document.getElementById("fechaI").value == ""){
      alert("Ingrese fecha Inicial del contrato");
      $("#fechaI").focus();
    }
    else if(document.getElementById("fechaF").value == ""){
      alert("Ingrese fecha Final del contrato");
      $("#fechaF").focus();
    }
    else if(document.getElementById("usuario").value == ""){
      alert("Ingrese usuario del empleado");
      $("#usuario").focus();
    }
    else if(document.getElementById("email").value == ""){
      alert("Ingrese email del empleado");
      $("#email").focus();
    }
    else if (document.getElementById("contraseña").value == ""){
      alert("Ingrese contraseña del empleado");
      $("#contraseña").focus();
    }
    else if (document.getElementById("contraseña").value != document.getElementById("contraseña2").value){
      alert("Las contraseñas no coinciden");
      $("#contraseña").focus();
    }
    else if (document.getElementById("codTipoEmpleado").value == "0"){
      alert("Seleccione tipo de empleado");
    }
    else{
      return true; // enviamos el formulario	
    }
    return false;
  }
  
</script>

<div class="container">

  <form method = "POST" action = "{{ route('empleados.store') }}"  onsubmit="return validar()" >
    @csrf   

    <div class="container">
      <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="nombres">Nombres de Empleado</label>
              <input type="text" class="form-control @error('nombres') is-invalid @enderror" id="nombres" name="nombres" placeHolder="Ingrese nombre">
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="apellidos">Apellidos del Empleado</label>
              <input type="text" class="form-control @error('apellidos') is-invalid @enderror" id="apellidos" name="apellidos" placeHolder="Ingrese nombre">
            </div>
          </div>

          <div class="w-100"></div>
          <div class="col">  
            <div class="form-group">
              <label for="telefono">Telefono</label>
              <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" placeHolder="Ingrese telefono">
          
            </div>
          </div>
          {{-- --------------------------------------------------------- --}}
          <div class="col">  
            <label for="telefono">Fecha Inicio Contrato</label>
            <div class="input-group date form_date " data-date-format="yyyy-mm-dd" data-provide="datepicker">
              <input type="text"  class="form-control" name="fechaI" id="fechaI"
                    value="" style="font-size: 10pt;"> 
              <div class="input-group-btn">                                        
                  <button class="btn btn-primary date-set" type="button">
                      <i class="fas fa-calendar"></i>
                  </button>
              </div>
            </div>
          </div>
        {{-- --------------------------------------------------------- --}}
          <div class="col">  
            <label for="telefono">Fecha Fin de Contrato</label>
            <div class="input-group date form_date " data-date-format="yyyy-mm-dd" data-provide="datepicker">
              <input type="text"  class="form-control" name="fechaF" id="fechaF"
                    value="" style="font-size: 10pt;"> 
              <div class="input-group-btn">                                        
                  <button class="btn btn-primary date-set" type="button">
                      <i class="fas fa-calendar"></i>
                  </button>
              </div>
            </div>
          </div>
            {{-- --------------------------------------------------------- --}}
          <div class="w-100"></div>

          <div class="col">  
            <div class="form-group">
              <label for="usuario">Usuario</label>
              <input type="text" class="form-control @error('usuario') is-invalid @enderror" id="usuario" name="usuario" placeHolder="Ingrese usuario">
              
            </div>
          </div>
          
          <div class="col">  
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeHolder="Ingrese email">
              
            </div>
            
            
          </div>

          <div class="w-100"></div>
          <div class="col">  
            <div class="form-group">
              <label for="contraseña">Contraseña</label>
              <input type="password" class="form-control @error('contraseña') is-invalid @enderror" id="contraseña" name="contraseña" placeHolder="Ingrese contraseña">
              
            </div>
          </div>
          <div class="col">  
            <div class="form-group">
              <label for="contraseña2">Repetir Contraseña</label>
              <input type="password" class="form-control @error('contraseña2') is-invalid @enderror" id="contraseña2" name="contraseña2" placeHolder="Repita la Contraseña">
              
            </div>
    
          </div>

          <div class="w-100"></div>
          <div class="col"> 
            <div class="form-group">
              <label for="codTipoEmpleado">Puesto</label>
              <select class="form-control @error('codTipoEmpleado') is-invalid @enderror" id="codTipoEmpleado" name="codTipoEmpleado" >
                <option value="0">-- Seleccionar --</option>
                @foreach($listaPuestos as $itemPuesto)
                  <option value="{{$itemPuesto->codTipoEmpleado}}">
                    {{$itemPuesto->nombrePuesto}}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

        </div>
  
      </div>
    
  
    <button type="submit" class="btn btn-primary">   <i class="fas fa-save"> </i> Grabar </button>
    <a href = "{{route('empleados.ver')}}" class = "btn btn-danger">
        <i class="fas fa-ban"> </i> Cancelar </a>




</form>

</div>
@endsection