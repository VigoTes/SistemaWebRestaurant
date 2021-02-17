@extends('layout.plantilla')

@section('contenido')

<div class="card-body">
    

    <div class="well"><H3 style="text-align: center;">REGISTROS DE CAJA</H3></div>
    <br>

    <table class="table table-bordered table-hover datatable">
        <thead>
        <tr>
            <th colspan="2"></th>
            <th colspan="2" style="text-align: center; color:red">APERTURA</th>
            <th colspan="2" style="text-align: center; color:red">CIERRE</th>
            <th></th>
        </tr>
        <tr>
            <th>CAJA</th>
            <th>CAJERO</th>
            <th>HORA</th>
            <th>SALDO</th>
            <th>HORA</th>
            <th>SALDO</th>
            <th>OPCIONES</th>
        </tr>
        </thead>
        <tbody id="registro">
            @foreach($registros as $itemregistro)
            <tr>
                <td>{{$itemregistro->caja->nombre}}</td>
                <td>{{$itemregistro->empleado->apellidos}}, {{$itemregistro->empleado->nombres}}</td>
                <td>{{$itemregistro->fechaHoraApertura}}</td>
                <td>{{$itemregistro->saldoApertura}}</td>
                <td>{{$itemregistro->fechaHoraCierre}}</td>
                <td>{{$itemregistro->saldoCierre}}</td>
                <td>
                    <a href="/visualizarOrdenes/{{$itemregistro->codRegistroCaja}}" class="btn btn-info btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Detalle</a>
                </td>
            </tr>
            @endforeach
        </tbody>  
    </table>
    <br>
    
  </div>

@endsection