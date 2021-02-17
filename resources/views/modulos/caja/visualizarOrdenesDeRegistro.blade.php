@extends('layout.plantilla')

@section('contenido')

<div class="card-body">
    

    <div class="well"><H3 style="text-align: center;">ORDENES DE {{$registro->caja->nombre}} ({{$registro->fechaHoraApertura}})</H3></div>
    <br>

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
    
  </div>

@endsection