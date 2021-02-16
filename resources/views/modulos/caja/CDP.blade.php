<!DOCTYPE html>
<html lang="en">
<head>
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
        <p style="text-align: center; font-size: 15pt;"><b>TICKET DE VENTA</b></p>
        <p style="text-align: center; font-size: 8pt;">AVENIDA ROMULO, CALLE 51 # 47-48 <br> Ruc: 1068811764-7</p>
        <p style="text-align: center; font-size: 8pt;">DONERA RESTAURANTE</p>
        <p style="text-align: center; font-size: 11pt;">-----------------------------------------</p>
        <p style="font-size: 8pt;"><b>Nº DE VENTA:</b> 000000000000006</p>
        <p style="font-size: 8pt;"><b>FECHA DE VENTA:</b> 10-01-2020 03:19:12</p>
        <p style="font-size: 8pt;"><b>FECHA DE IMPRESION:</b> 10-01-2020 03:49:16 PM</p>
        <p style="text-align: center; font-size: 11pt;">---------------- <b>CLIENTE</b> ----------------</p>
        <p style="font-size: 8pt;"><b>CLIENTE:</b> CONSUMIDOR FINAL</p>
        <p style="text-align: center; font-size: 11pt;">--------------- <b>PRODUCTOS</b> ---------------</p> 
    </div>
    <div id="principal" style="width: 365px; height: 30px;">
        <div style="width: 16%; height: 30px; float: left;">
            <p style="text-align: center; font-size: 10pt;"><b>CANT</b></p>
            <p style="text-align: center; font-size: 11pt;">------</p>
        </div>
        <div style="width: 40%; height: 30px; float: left;">
            <p style="text-align: center; font-size: 10pt;"><b>DESCRIPCION</b></p>
            <p style="text-align: center; font-size: 11pt;">----------------</p>
        </div>
        <div style="width: 22%; height: 30px; float: left;">
            <p style="text-align: center; font-size: 10pt;"><b>PRECIO</b></p>
            <p style="text-align: center; font-size: 11pt;">---------</p>
        </div>
        <div style="width: 22%; height: 30px; float: left;">
            <p style="text-align: center; font-size: 10pt;"><b>IMPORTE</b></p>
            <p style="text-align: center; font-size: 11pt;">---------</p>
        </div>
    </div>

    <!--  ES UNO POR CADA PROFUCTO -->
    <p style="margin: 1px"></p>
    <div id="principal" style="width: 365px; height: 20px;">
        <div style="width: 16%; height: 20px; background-color: #FF0000; float: left;">
            <p style="text-align: center; font-size: 8pt;">1.00</p>
        </div>
        <div style="width: 40%; height: 20px; background-color: rgb(114, 114, 182); float: left;">
            <p style="text-align: center; font-size: 8pt;">PECHUGA A LA PANCHA</p>
        </div>
        <div style="width: 22%; height: 20px; background-color: rgb(175, 65, 166); float: left;">
            <p style="text-align: center; font-size: 8pt;">S/ 50.00</p>
        </div>
        <div style="width: 22%; height: 20px; background-color: rgb(41, 182, 182); float: left;">
            <p style="text-align: center; font-size: 8pt;">S/ 50.00</p>
        </div>
    </div>
    <!-- HASTA AQUI :v-->

    <div id="principal" style="width: 365px; height: 12px;">
        <p style="text-align: center; font-size: 11pt;">----------------- <b>PAGO</b> -----------------</p> 
    </div>
    <p style="margin: 1px"></p>
    <div id="principal" style="width: 365px; height: 15px;">
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;"><b>SUBTOTAL IGV 0%:</b></p>
        </div>
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;">S/ 0.00</p>
        </div>
    </div>
    <p style="margin: 1px"></p>
    <div id="principal" style="width: 365px; height: 15px;">
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;"><b>SUBTOTAL IGV 0%:</b></p>
        </div>
        <div style="width: 50%; height: 15px;float: left;">
            <p style="font-size: 10pt; text-align: right;">S/ 50.00</p>
        </div>
    </div>
    <p style="margin: 1px"></p>
    <div id="principal" style="width: 365px; height: 15px;">
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;"><b>IGV 0%:</b></p>
        </div>
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;">S/ 0.00</p>
        </div>
    </div>
    <p style="margin: 1px"></p>
    <div id="principal" style="width: 365px; height: 15px;">
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;"><b>DESCUENTO 0%:</b></p>
        </div>
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;">S/ 0.00</p>
        </div>
    </div>
    <p style="margin: 1px"></p>
    <div id="principal" style="width: 365px; height: 15px;">
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;"><b>TOTAL A PAGAR 0%:</b></p>
        </div>
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;">S/ 50.00</p>
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
            <p style="font-size: 10pt; text-align: right;">CONTADO EFECTIVO</p>
        </div>
    </div>
    <p style="margin: 1px"></p>
    <div id="principal" style="width: 365px; height: 15px;">
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;"><b>EFECTIVO:</b></p>
        </div>
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;">S/ 50.00</p>
        </div>
    </div>
    <p style="margin: 1px"></p>
    <div id="principal" style="width: 365px; height: 15px;">
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;"><b>CAMBIO:</b></p>
        </div>
        <div style="width: 50%; height: 15px; float: left;">
            <p style="font-size: 10pt; text-align: right;">S/ 0.00</p>
        </div>
    </div>
    <div id="principal" style="width: 365px; height: 30px;">
        <p style="text-align: center; font-size: 11pt;">--------- <b>INFORMACION ADICIONAL</b> ---------</p>
        <p style="font-size: 8pt;"><b>CAJERO:</b> FELIX JOEL GUTIERREZ URIOL</p>
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