@extends('layout.plantilla')

@section('contenido')

<div class="card-body">
    

    <div class="well"><H3 style="text-align: center;">ENTRADAS DE CAJA</H3></div>
    <br>
    <div class="form-group row">
        <div class="col-sm-1">
            <label class="col-form-label float-right">Nr Caja:</label>
        </div>
        <div class="col-sm-1">
            <input type="number" class="form-control" value="{{$registro->caja->codCaja}}" disabled>
        </div>
        <div class="col-sm-2">
            <label class="col-form-label float-right">Monto Apertura:</label>
        </div>
        <div class="col-sm-2">
            <input type="number" step="any" class="form-control" value="{{$registro->saldoApertura}}" disabled>
        </div>
        <div class="col-sm-2">
            <label class="col-form-label  float-right">Monto Actual:</label>
        </div>
        <div class="col-sm-2">
            <input type="number" step="any" class="form-control" value="{{$total}}" disabled>
        </div>
    </div>

    <table class="table table-bordered table-hover datatable">
        <thead>
        <tr>
            <th>MESERO</th>
            <th>CLIENTE</th>
            <th>MONTO</th>
            <th>HORA PAGO</th>
            <th>TIPO CDP</th>
            <th>TIPO PAGO</th>
            <th>MEDIO PAGO</th>
        </tr>
        </thead>
        <tbody id="registro">
            @foreach($ordenes as $itemorden)
            <tr>
                <td>{{$itemorden->mesero()->nombres}}, {{$itemorden->mesero()->apellidos}}</td>
                <td>{{$itemorden->cliente()->nombres}}, {{$itemorden->cliente()->apellidos}} ({{$itemorden->cliente()->DNI}})</td>
                <td style="text-align: right"> S/. {{ number_format( $itemorden->costoTotal,2)}}</td>
                <td>{{$itemorden->fechaHoraPago}}</td>
                <td>{{$itemorden->tipoCDP()->nombre}}</td>
                <td>{{$itemorden->tipoPago()->nombre}}</td>
                <td>{{$itemorden->medioPago()->nombre}}</td>
            </tr>
            @endforeach
        </tbody>  
    </table>
    <br>
    <a href="{{route('caja.cierre')}}" class="btn btn-danger"  style="margin-left:600px;"><i class="entypo-pencil"></i>Cerrar Caja</a>
    
  </div>

@endsection