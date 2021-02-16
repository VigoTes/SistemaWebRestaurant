@extends ('layout.plantilla')

@section('contenido')

<script type="text/javascript"> 
          
    function validarregistro() 
        {
            
                document.frmcaja.submit(); // enviamos el formulario	
            
        }
    
</script>

<br>
<form id="frmcaja" name="frmcaja" role="form" action="{{route('caja.store')}}" class="form-horizontal form-groups-bordered" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Gestion de Arqueo de Caja</h3>
            </div> <!-- /.card-body -->
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="col-form-label">Cajas de Ventas:</label>
                        <select class="form-control" name="codCaja" id="codCaja">
                            <option value="0">--Seleccionar--</option>
                            @foreach($cajas as $itemcaja)
                            <option value="{{$itemcaja->codCaja}}">{{$itemcaja->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="col-form-label">Hora de Apertura:</label>
                        <input type="text" class="form-control" id="fechaHoraApertura" name="fechaHoraApertura" value="{{$fechaHoraActual->format("Y-m-d H:i:s")}}" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-form-label">Monto Inicial:</label> (S/)
                        <input type="number" step="any" class="form-control" id="saldoApertura" name="saldoApertura" placeholder="Monto..." >
                    </div>
                </div>
            </div><!-- /.card-body -->
            <div class="card-footer clearfix">
                <a onclick="validarregistro()" class="btn btn-secondary float-right">Registrar</a>
            </div>
        </div>
    </div>
</form>

@endsection