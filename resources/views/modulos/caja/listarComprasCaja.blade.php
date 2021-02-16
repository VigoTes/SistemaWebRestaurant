@extends('layout.plantilla')

@section('contenido')

<div class="card-body">
    

    <div class="well"><H3 style="text-align: center;">ENTRADAS DE CAJA</H3></div>

    <br/>
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
                <td>{{$itemorden->mesero->nombres}}, {{$itemorden->mesero->apellidos}}</td>
                <td>{{$itemorden->cliente->nombres}}, {{$itemorden->cliente->apellidos}} ({{$itemorden->cliente->DNI}})</td>
                <td>{{$itemorden->costoTotal}}</td>
                <td>{{$itemorden->fechaHoraPago}}</td>
                <td>{{$itemorden->tipoCDP->descripcion}}</td>
                <td>{{$itemorden->tipoPago->descripcion}}</td>
                <td>{{$itemorden->medioPago->descripcion}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{route('caja.cierre')}}" class="btn btn-danger"  style="margin-left:600px;"><i class="entypo-pencil"></i>Cerrar Caja</a>
    
  </div>


@endsection