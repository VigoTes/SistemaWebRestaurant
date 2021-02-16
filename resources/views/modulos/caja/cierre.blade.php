@extends ('layout.plantilla')

@section('contenido')

<script type="text/javascript"> 
          
    function validarregistro() 
        {
            
                document.frmcaja.submit(); // enviamos el formulario	
            
        }
    
</script>

<br>
<form id="frmcaja" name="frmcaja" role="form" action="/caja/cierre/save" class="form-horizontal form-groups-bordered" method="post" enctype="multipart/form-data">
    @csrf
    <input id="codRegistroCaja" type="hidden" name="codRegistroCaja" value="{{ $registro->codRegistroCaja }}" >
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Gestion de Arqueo de Caja</h3>
            </div> <!-- /.card-body -->
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label class="col-form-label">Hora de Apertura:</label>
                        <input type="text" class="form-control" id="fechaHoraApertura" name="fechaHoraApertura" value="{{$registro->fechaHoraApertura}}" disabled>
                    </div>
                    <div class="col-sm-3">
                        <label class="col-form-label">Hora de Cierre:</label>
                        <input type="text" class="form-control" id="fechaHoraCierre" name="fechaHoraCierre" value="{{$fechaHoraActual->format("Y-m-d H:i:s")}}" disabled>
                    </div>
                    <div class="col-sm-3">
                        <label class="col-form-label">Saldo de Cierre:</label> (S/)
                        <input type="number" step="any" class="form-control" id="saldoCierre" name="saldoCierre" disabled value="{{$total}}" >
                    </div>
                    <div class="col-sm-3">
                        <label class="col-form-label">Saldo Real:</label> (S/)
                        <input type="number" step="any" class="form-control" id="saldoReal" name="saldoReal" placeholder="Monto...">
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