@extends ('layout.plantilla')

@section('contenido')

<script type="text/javascript"> 
          
    function validarRegistro() 
        {
            return true;
              
        }
    
</script>

<br>
<form id="frmcaja" name="frmcaja" action="/caja/cierre/save" onsubmit="return validarRegistro()"
        class="form-horizontal form-groups-bordered" method="post" >
    @csrf
    <input id="codRegistroCaja" type="hidden" name="codRegistroCaja" value="{{ $registro->codRegistroCaja }}" >
  

    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Gestion de Arqueo de Caja : CERRAR CAJA </h3>
            </div> <!-- /.card-body -->
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label class="col-form-label">Hora de Apertura:</label>
                        <input type="text" class="form-control" id="fechaHoraApertura" name="fechaHoraApertura" value="{{$registro->fechaHoraApertura}}"readonly >
                    </div>
                    <div class="col-sm-3">
                        <label class="col-form-label">Hora de Cierre:</label>
                        <input type="text" class="form-control" id="fechaHoraCierre" name="fechaHoraCierre" value="{{$fechaHoraActual->format("Y-m-d H:i:s")}}" readonly>
                    </div>
                    <div class="col-sm-3">
                        <label class="col-form-label">Saldo de Cierre:</label> (S/)
                        <input type="number" step="any" class="form-control" id="saldoCierre" name="saldoCierre"  value="{{$total}}" readonly>
                    </div>
                    <div class="col-sm-3">
                        <label class="col-form-label">Saldo Real:</label> (S/)
                        <input type="number" step="any" class="form-control" id="saldoReal" name="saldoReal" placeholder="Monto...">
                    </div>
                </div>
            </div><!-- /.card-body -->
            <div class="card-footer clearfix">
                <button type="submit" class="btn btn-secondary float-right">Registrar</button>
            </div>
        </div>
    </div>
</form>

@endsection