<!DOCTYPE html>
<html lang="en">
<head>
    <title> {{($tipo==2)? 'FACTURA' : 'BOLETA'}} N {{$orden->nroCDP}}</title>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        html {
            /* Arriba | Derecha | Abajo | Izquierda */
            margin: 12pt 15pt 0 15pt;
            font-family: Courier;
        }

        #principal { 
            /*background-color: rgb(161, 51, 51);*/
            word-wrap: break-word;/* para que el texto no salga del div*/
        }
        p {
            margin-top: 3px;
            margin-bottom: 3px;
        }
        
    </style>
</head>
<body>
    <div id="principal" style="width: 365px; height: 169px;">
        <p style="text-align: center; font-size: 15pt; text-transform: uppercase;"><b>{{($tipo==2)? 'FACTURA' : 'BOLETA'}} Nº:{{$orden->nroCDP}}</b></p>
        <p style="text-align: center; font-size: 8pt;">{{$empresa->direccion}}<br> Ruc: {{$empresa->RUC}}</p>
        <p style="text-align: center; font-size: 8pt;">{{$empresa->nombre}}</p>
        <p style="text-align: center; font-size: 11pt;">-----------------------------------------</p>
        <p style="font-size: 8pt;"><b>Nº DE Orden:</b> {{$orden->codOrden}}</p>
        <p style="font-size: 8pt;"><b>FECHA DE VENTA:</b> {{$orden->fechaHoraPago}}</p>
        <p style="font-size: 8pt;"><b>FECHA DE IMPRESION:</b> {{$fechaHora->format("Y-m-d H:i:s")}}</p>
        <p style="text-align: center; font-size: 11pt;">---------------- <b>CLIENTE</b> ----------------</p>
        <p style="font-size: 8pt;"><b>CLIENTE:</b> {{$orden->cliente()->apellidos}}, {{$orden->cliente()->nombres}}</p>
        <p style="text-align: center; font-size: 11pt;">--------------- <b>PRODUCTOS</b> ---------------</p> 
    </div>
    <div id="principal" style="width: 365px; height: 30px;">
        <div style="width: 13%; height: 30px; float: left;">
            <p style="text-align: center; font-size: 10pt;"><b>CANT</b></p>
            <p style="text-align: center; font-size: 11pt;">-----</p>
        </div>
        <div style="width: 47%; height: 30px; float: left;">
            <p style="text-align: center; font-size: 10pt;"><b>DESCRIPCION</b></p>
            <p style="text-align: center; font-size: 11pt;">-------------------</p>
        </div>
        <div style="width: 20%; height: 30px; float: left;">
            <p style="text-align: center; font-size: 10pt;"><b>PRECIO</b></p>
            <p style="text-align: center; font-size: 11pt;">--------</p>
        </div>
        <div style="width: 20%; height: 30px; float: left;">
            <p style="text-align: center; font-size: 10pt;"><b>IMPORTE</b></p>
            <p style="text-align: center; font-size: 11pt;">--------</p>
        </div>
    </div>

    <!--  ES UNO POR CADA PROFUCTO -->
    @foreach($detalles as $itemdetalle)
        <?php $importe=(float)$itemdetalle->cantidad*(float)$itemdetalle->precio ?>
        <p style="margin: 1px"></p>
        <div id="principal" style="width: 365px; height: 20px;">
            <div style="width: 13%; height: 20px; background-color: white; float: left;">
                <p style="text-align: center; font-size: 8pt;">{{$itemdetalle->cantidad}}.00</p>
            </div>
            <div style="width: 47%; height: 20px; background-color: white; float: left;">
                <p style="text-align: center; font-size: 8pt;">{{$itemdetalle->producto->nombre}}</p>
            </div>
            <div style="width: 20%; height: 20px; background-color: white; float: left;">
                <p style="text-align: center; font-size: 8pt;">S/ {{number_format($itemdetalle->precio,2)}}</p>
            </div>
            <div style="width: 20%; height: 20px; background-color: white; float: left;">
                <p style="text-align: center; font-size: 8pt;">S/ {{number_format($importe,2)}}</p>
            </div>
        </div>
    @endforeach
    <!-- HASTA AQUI :v-->

    <div id="principal" style="width: 365px; height: 12px;">
        <p style="text-align: center; font-size: 11pt;">----------------- <b>PAGO</b> -----------------</p> 
    </div>
    <!--
    <p style="margin: 1px"></p>
    <div id="principal" style="width: 365px; height: 15px;">
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;"><b>SUBTOTAL IGV 0%:</b></p>
        </div>
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;">S/ 0.00</p>
        </div>
    </div>
    -->
    @if($tipo==2)
    <p style="margin: 1px"></p>
    <div id="principal" style="width: 365px; height: 15px;">
        <div style="width: 50%; height: 15px; float: left;">
            <?php $subtotal=(float)$orden->costoTotal/1.18 ?>
            <p style="font-size: 10pt; text-align: right;"><b>SUBTOTAL:</b></p>
        </div>
        <div style="width: 50%; height: 15px;float: left;">
            <p style="font-size: 10pt; text-align: right;">S/ {{number_format($subtotal,2)}}</p>
        </div>
    </div>
    <p style="margin: 1px"></p>
    <div id="principal" style="width: 365px; height: 15px;">
        <div style="width: 50%; height: 15px; float: left;">
            <?php $igv=(float)$orden->costoTotal-$subtotal ?>
            <p style="font-size: 10pt; text-align: right;"><b>IGV:</b></p>
        </div>
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;">S/ {{number_format($igv,2)}}</p>
        </div>
    </div>
    <p style="margin: 1px"></p>
    <div id="principal" style="width: 365px; height: 15px;">
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;"><b>DESCUENTO:</b></p>
        </div>
        <div style="width: 50%; height: 15px; float: left;">
            <?php if($orden->descuento==null) $descuento=(float)0.00;
                else $descuento=$orden->descuento; ?>
            <p style="font-size: 10pt; text-align: right;">S/ {{number_format($descuento,2)}}</p>
        </div>
    </div>
    @endif
    
    <p style="margin: 1px"></p>
    <div id="principal" style="width: 365px; height: 15px;">
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;"><b>TOTAL A PAGAR:</b></p>
        </div>
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;">S/ {{number_format($orden->costoTotal,2)}}</p>
        </div>
    </div>
    <div id="principal" style="width: 365px; height: 12px;">
        <p style="text-align: center; font-size: 11pt;">-------------- <b>MEDIO PAGO</b> --------------</p> 
    </div>
    <p style="margin: 1px"></p>
    <div id="principal" style="width: 365px; height: 15px;">
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;"><b>TIPO PAGO:</b></p>
        </div>
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;">{{$orden->tipoPago()->nombre}} {{$orden->medioPago()->nombre}}</p>
        </div>
    </div>
    <p style="margin: 1px"></p>
    <div id="principal" style="width: 365px; height: 15px;">
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right; text-transform: uppercase;"><b>{{$orden->medioPago()->nombre}}:</b></p>
        </div>
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;">S/ {{number_format($orden->montoPagado,2)}}</p>
        </div>
    </div>
    <p style="margin: 1px"></p>
    <div id="principal" style="width: 365px; height: 15px;">
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;"><b>CAMBIO:</b></p>
        </div>
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;">S/ {{number_format($orden->cambioDevuelto,2)}}</p>
        </div>
    </div>
    <div id="principal" style="width: 365px; height: 30px;">
        <p style="text-align: center; font-size: 11pt;">--------- <b>INFORMACION ADICIONAL</b> ---------</p>
        <p style="font-size: 8pt;"><b>CAJERO:</b> {{$orden->mesero()->apellidos}}, {{$orden->mesero()->nombres}}</p>
    </div>
    <div id="principal" style="width: 365px; height: 20px;">
        
    </div>
    <div id="principal" style="width: 365px; height: 16px;">
        <p style="text-align: center; font-size: 11pt;"><b>FIRMA:</b> ----------------------------</p>
    </div>
    <div id="principal" style="width: 365px; height: 19px;">
        <p style="text-align: center; font-size: 11pt;">#########################################</p>
    </div>
    <div id="principal" style="width: 365px; height: 19px;">
        <p style="text-align: center; font-size: 11pt;"><i><b>GRACIAS POR SU COMPRA <\3</b><i></p>
    </div>
</body>

</html>