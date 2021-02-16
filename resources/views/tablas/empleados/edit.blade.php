@extends('layout.plantilla')
@section('contenido')


<div class="container">

  <form method = "POST" action = "{{ route('empleados.update',$empleado->codEmpleado) }}"  onsubmit="return validar()" >
    @csrf   

    <div class="container">
      <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="nombres">Nombres de Empleado</label>
              <input type="text" value="{{$empleado->nombres}}" class="form-control @error('nombres') is-invalid @enderror" id="nombres" name="nombres" placeHolder="Ingrese nombre">
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="apellidos">Apellidos del Empleado</label>
              <input type="text"  value="{{$empleado->apellidos}}" class="form-control @error('apellidos') is-invalid @enderror" id="apellidos" name="apellidos" placeHolder="Ingrese nombre">
            </div>
          </div>

          <div class="w-100"></div>
          <div class="col">  
            <div class="form-group">
              <label for="telefono">Telefono</label>
              <input type="text"  value="{{$empleado->telefono}}" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" placeHolder="Ingrese telefono">
          
            </div>
          </div>
          {{-- --------------------------------------------------------- --}}
          <div class="col">  
            <label for="telefono">Fecha Inicio Contrato</label>
            <div class="input-group date form_date " data-date-format="yyyy-mm-dd" data-provide="datepicker">
              <input type="text"  class="form-control" name="fechaI" id="fechaI"
                  value="{{$empleado->fechaContrato}}"  style="font-size: 10pt;"> 
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
                 value="{{$empleado->fechaFinContrato}}"  style="font-size: 10pt;"> 
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
              <input type="text"  value="{{$usuario->usuario}}"  class="form-control @error('usuario') is-invalid @enderror" id="usuario" name="usuario" placeHolder="Ingrese usuario">
              
            </div>
          </div>
          
          <div class="col">  
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text"   value="{{$usuario->email}}"  class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeHolder="Ingrese email">
              
            </div>
            
            
          </div>

          <div class="w-100"></div>
          <div class="col">  
            <div class="form-group">
              <label for="contraseña">Contraseña</label>
              <input type="password"  class="form-control @error('contraseña') is-invalid @enderror" id="contraseña" name="contraseña" placeHolder="Ingrese contraseña">
              
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
                  <option value="{{$itemPuesto->codTipoEmpleado}}"
                    @if( $itemPuesto->codTipoEmpleado == $empleado->codEmpleado )
                        selected                      
                    @endif
                    >
                    {{$itemPuesto->nombrePuesto}}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

        </div>
  
      </div>
    
  
    <button type="submit" class="btn btn-primary">   <i class="fas fa-save"> </i> Actualizar </button>
    <a href = "{{route('empleados.ver')}}" class = "btn btn-danger">
        <i class="fas fa-ban"> </i> Cancelar </a>




</form>

</div>

<script>
       
    function validar(){
      msj='';

      user=$("#nombres").val(); 
      if(user=='')
        msj='Debe ingresar los nombres del empleado';

      if($("#fechaI").val() =='')
        msj='Debe ingresar la fecha Inicio';
      
      if($("#fechaF").val() =='')
        msj='Debe ingresar la fecha Final';
      
      if($("#usuario").val() =='')
        msj='Debe ingresar el usuario';
      
      if($("#email").val() =='')
        msj='Debe ingresar el email';
 
      if($("#codTipoEmpleado").val() == '0')
        msj='Debe ingresar el puesto de trabajo';
        

      contraseña=$("#contraseña").val(); 
      if(contraseña=='')
        msj='Debe ingresar la contraseña.';
      

      contraseña2=$("#contraseña2").val(); 
      if(contraseña2=='')
        msj='Ingrese la contraseña repetida.';
      

     


      apellidos=$("#apellidos").val(); 
      if(apellidos=='')
        msj='Debe ingresar los apellidos';
      

        telefono=$("#telefono").val(); 
      if(telefono=='')
        msj='Debe ingresar el telefono';
      
      
      
      



      if(msj!=''){
        alert(msj);
        return false;
      }

      
      return true;
    }



</script>
@endsection