@extends('layout.plantilla')
@section('contenido')

   
<div class="container">
  <form method="POST" action="{{route('categoria.update',$categoria->codCategoria)}}">
    @method('put')
    @csrf
    <div class="form-group">
            <label for="categoria_id">Codigo:</label>
        <input type="text" class="form-control" id="categoria_id" name="categoria_id" value='{{$categoria->codCategoria}}' disabled>
    </div>

    <div class="form-group">
      <label for="nombre">Nombre:</label>
      <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre"  value='{{$categoria->nombre}}' name="nombre">
      @error('nombre')
        <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
        </span>
      @enderror
    </div>
    
    <button type="submit" class="btn btn-primary">Grabar</button>
    <a href="{{route('categoria.index')}}" class="btn btn-danger"><i class="fas fa-ban"></i>Cancelar</a>
  </form>
</div>


@endsection