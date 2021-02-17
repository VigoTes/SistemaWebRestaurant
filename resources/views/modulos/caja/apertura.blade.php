@extends ('layout.plantilla')

@section('contenido')

<script type="text/javascript">   
    function validarregistro() 
        {
            if (document.getElementById("codCaja").value == "0"){
                alert("Seleccione una caja");
            }
            else if(document.getElementById("saldoApertura").value == ""){
                alert("Ingrese monto inicial de apertura");
                $("#saldoApertura").focus();
            }
            else{
                document.frmcaja.submit(); // enviamos el formulario	
            }
                
            
        }
    
</script>

<br>

@if(session('datos'))
<div class ="alert alert-warning alert-dismissible fade show mt-3" role ="alert">
    {{session('datos')}}
  <button type = "button" class ="close" data-dismiss="alert" aria-label="close">
      <span aria-hidden="true"> &times;</span>
  </button>
</div>
@ENDIF

<h1 >Gestion de Arqueo de Caja : 
    <h2>Apertura de Caja</h2>    
    
</h1>

<form id="frmcaja" name="frmcaja" role="form" action="{{route('caja.store')}}" class="form-horizontal form-groups-bordered" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                
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
                        <input type="text" class="form-control" id="fechaHoraApertura" name="fechaHoraApertura" value="{{$fechaHoraActual->format("Y-m-d H:i:s")}}" readonly>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-form-label">Monto Inicial:</label> (S/)
                        <input type="number" step="any" class="form-control" id="saldoApertura" name="saldoApertura" placeholder="Monto..." value="">
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