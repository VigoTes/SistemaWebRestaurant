@extends('layout.plantilla')
@section('contenido')


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
                    value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" style="font-size: 10pt;"> 
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
              <input type="text"  class="form-control" name="fechF" id="fechF"
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
              <input type="text" class="form-control @error('contraseña') is-invalid @enderror" id="contraseña" name="contraseña" placeHolder="Ingrese contraseña">
              
            </div>
          </div>
          <div class="col">  
            <div class="form-group">
              <label for="contraseña2">Repetir Contraseña</label>
              <input type="text" class="form-control @error('contraseña2') is-invalid @enderror" id="contraseña2" name="contraseña2" placeHolder="Repita la Contraseña">
              
            </div>
    
          </div>

          <div class="w-100"></div>
          <div class="col"> 
            <div class="form-group">
              <label for="codTipoEmpleado">Puesto</label>
              <select class="form-control @error('codTipoEmpleado') is-invalid @enderror" id="codTipoEmpleado" name="codTipoEmpleado" >
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

<script>
  function validar(){

    return true;
  }



</script>
@endsection