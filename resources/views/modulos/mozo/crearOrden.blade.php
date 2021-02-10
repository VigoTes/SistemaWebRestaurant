@extends('layout.plantilla')
@section('contenido')

@section('estilos')

<link rel="stylesheet" href="/select2/bootstrap-select.min.css">
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript"> 

        

    $(document).ready(function(){
        $('#codCategoria').change(function(){

            var codigo=$('#codCategoria').val();
            //alert(codigo);
            
            if(codigo!=0){
                //alert(codigo);
                $.ajax({
                    url: '/listarProductosCategoria/' + codigo,
                    type: 'post',
                    data: {
                        codigo     : codigo,
                        _token	 	: "{{ csrf_token() }}"
                    },
                    dataType: 'JSON',
                    success: function(respuesta) {
                        //$('#mision').html(respuesta.empresa.mision);


                        //var probando='Si sale';

                        var tableValor ='';

                                    for(var i in respuesta.productos){
                                        tableValor +='<div onClick="agregarDetalle('+respuesta.productos[i].codProducto+')" class="col-lg-2 col-3">';
                                        tableValor +='<div class="small-box bg-secondary">';
                                            tableValor +='<div class="container" style="font-size: medium">';
                                                tableValor +='<span>'+respuesta.productos[i].nombre+'</span>';
                                                tableValor +='<div style="width: 90%">';
                                                    tableValor +='<img src="/img/breakfast.png" style="width: 100%; height: auto;">';
                                                tableValor +='</div>';
                                                tableValor +='<span>S/. '+respuesta.productos[i].precioActual+'</span>';
                                            tableValor +='</div>';
                                        tableValor +='</div>';
                                        tableValor +='</div>';
                                    }

                        $('#productosCategoria').html(tableValor);

                    }
                });
            }else{
                        $('#productosCategoria').html('');

            }

        })
    });



</script>

<form method="POST" action="{{ route('orden.store')}}">
@csrf
<div class="card">
    <input id="nroArea" type="hidden" name="codMesa" value="{{ $mesa->codMesa }}" >
    <input id="nroArea" type="hidden" name="codMeseroActual" value="{{ Auth::user()->empleado->codEmpleado}}" >
    <div class="card-header ui-sortable-handle" style="cursor: move;">
      <h3 class="card-title">
        <i class="fas fa-chart-pie mr-1"></i>
        Control de Mesas/Productos
      </h3>
    </div><!-- /.card-header -->

    <div class="card-body">
        <div class="form-group row">
            <select class="form-control col-sm-2" id="codCategoria" name="codCategoria" size="15" style="border: 0px">
                @foreach($categorias1 as $itemcategoria)
                <option value="{{$itemcategoria->codCategoria}}">{{$itemcategoria->nombre}}</option>
                @endforeach
            </select>
            <div class="col sm-10">
                <div class="row" id="productosCategoria">
                    <!-- small box -->

                    <!--
                    <div class="col-lg-2 col-3">
                        <div class="small-box bg-secondary">
                            <div class="container" style="font-size: medium">
                                <span>Producto1</span>
                                <div style="width: 90%">
                                    <a href="#"><img src="/img/breakfast.png" style="width: 100%; height: auto;"></a>
                                </div>
                                <span>S/. 50.00</span>
                            </div>
                        </div>
                    </div>
                    -->

                </div>
            </div>
        </div>
    </div><!-- /.card-body -->

</div>
<div class="row">
    <section class="col-lg-8 connectedSortable ui-sortable">
      <!-- Custom tabs (Charts with tabs)-->
      <div class="card">
          <div class="card-body">
            <label for="">Busqueda de Productos: </label>        
                <select class="form-control select2 select2-hidden-accessible selectpicker" onchange="agregarDetalle2()" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" id="codProducto" name="codProducto" data-live-search="true" onchange="">
                    <option value="0" selected>- Seleccione Producto -</option>          
                        @foreach($productos as $itemproducto)
                            <option value="{{ $itemproducto->codProducto }}" >{{ $itemproducto->nombre }}</option>                                 
                        @endforeach            
                </select>                                                                  
            
            <div class="table-responsive">                           
              <table id="detalles" class="table table-striped table-bordered table-condensed table-hover" style='background-color:#FFFFFF;'> 
                  <thead class="thead-default" style="background-color:#3c8dbc;color: #fff;">
                      <th width="10" class="text-center">OPCIONES</th>                                        
                      <th class="text-center">CANTIDAD</th>                                 
                      <th class="text-center">DESCRIPCION DE PRODUCTO</th>
                      <th class="text-center">PRECIO</th>
                      <th class="text-center">IMPORTE</th>
                  </thead>
                  <tfoot>
                                                                                                        
                                                                                      
                  </tfoot>
                  <tbody>
                      
                  </tbody>
              </table>
            </div> 
            <div class="row">                       
                  <div class="col-md-8">
                  </div>   
                  <div class="col-md-2">                        
                      <label for="">Total : </label>    
                  </div>   
                  <div class="col-md-2">
                      <input type="text" class="form-control text-right" name="total" id="total" readonly="readonly">                              
                  </div>   
            </div>
            
            <hr>
            
            <div class="form-group">
              <label>Observaciones:</label>
              <textarea class="form-control" id="txtobservaciones" name="txtobservaciones" rows="3" placeholder="Enter ..." style="margin-top: 0px; margin-bottom: 0px; height: 79px;"></textarea>
            </div>
            <div class="text-right">  
              <div  id="guardar">
                  <div class="form-group">
                      <button class="btn btn-primary" id="btnRegistrar" data-loading-text="<i class='fa a-spinner fa-spin'></i> Registrando">
                          <i class='fas fa-save'></i> Registrar</button>    
              
                      <a href="" class='btn btn-danger'><i class='fas fa-ban'></i> Cancelar</a>              
                  </div>    
              </div>
            </div>
           
          </div><!-- /.card-body -->

      </div>
    </section>
    
    
    <section class="col-lg-4 connectedSortable ui-sortable">
  
        
        <!-- Custom tabs (Charts with tabs)-->
      <div class="card">
        <div class="card-body">
            <span>SALA {{$mesa->sala->nombre}}</span><br>
            <span>MESA {{$mesa->nroEnSala}}</span> <br> <br>

            <label for="">Mesero: </label>        
                  
            <select class="form-control select2 select2-hidden-accessible selectpicker" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" id="cliente_id" name="cliente_id" data-live-search="true" onchange="">
                <option value="0" selected>- Seleccione Mesero -</option>          
                    @foreach($meseros as $itemmesero)
                        <option value="{{ $itemmesero->codEmpleado }}" >{{ $itemmesero->apellidos }}, {{$itemmesero->nombres}}</option>                                 
                    @endforeach            
            </select>

        </div>
      </div>


    </section>

</div>



<script type="text/javascript"> 
    var cont=0;
    var total=0;
    var detalleventa=[];
    var subtotal=[];
    var controlproducto=[];              


    function agregarDetalle(codProducto){
        cod_producto=codProducto;
        /* Buscar que codigo de producto no se repita  */
        var i=0;
        var band=false;   
        while (i<cont)
        {
            if (controlproducto[i]==cod_producto)
            {
                band=true;
            }
            i=i+1;
        }

        
        if  (band==true)
        {
            alert("No puede volver a vender el mismo producto");    
            return false;
        }
        
            
            //alert('el codproducto es '+ cod_producto);

            $.get('/buscarProducto/'+cod_producto, function(data)
            {      
                    producto = data;
                    //alert('el nombre es' + producto.nombre);
                    var fila='<tr class="selected" id="fila'+cont+'">'+
                        '<td style="text-align:center;"><button type="button" class="btn btn-danger btn-xs" onclick="eliminardetalle('+cod_producto+','+cont+');"><i class="fa fa-times" ></i></button></td>'+
                        '<td style="text-align:right;"><input type="number" min="1" onchange="cambioCantidad('+cod_producto+','+cont+')" id="cantidad'+cont+'" name="cantidad[]" value="'+ 1 +'" style="width:80px; text-align:right;"></td>'+
                        '<td><input type="hidden" name="cod_producto[]" value="'+ cod_producto +'" readonly style="width:50px; text-align:right;">'+ producto.nombre +'</td>'+
                        '<td style="text-align:right;"><input type="number" name="pventa[]" value="'+ number_format(producto.precioActual,2) +'" style="width:80px; text-align:right;" readonly></td>'+
                        '<td style="text-align:right;"><input type="number" id="importe'+cont+'" name="importe[]" value="'+ number_format(producto.precioActual,2) +'" style="width:80px; text-align:right;" readonly></td>'+
                    '</tr>';
                    $('#detalles').append(fila);  
 
                subtotal[cont]=1*producto.precioActual;  
                
                controlproducto[cont]=producto.codProducto;
                total=total + subtotal[cont]; 
                
                detalleventa.push({
                    codigo:producto.codProducto,
                    cantidad:1,            
                    pventa:producto.precioActual,
                    subtotal:subtotal
                });

                //alert(total);
                $('#total').val(number_format(total,2));
                cont++;
            });

    }

    function agregarDetalle2(){
        cod_producto=$("#codProducto").val();
        agregarDetalle(cod_producto);
        $("#codProducto").val(0);
    }

    function cambioCantidad(codigo,index){
        //alert(cont);
        total=total-subtotal[index]; 
        tam=detalleventa.length;
        cantidadActual=$('#cantidad'+index).val();
        if(cantidadActual<1){
            cantidadActual=1;
            $('#cantidad'+index).val(1);
        }
        var i=0;
        var pos;      
        while (i<tam)
        {
            if (detalleventa[i].codigo==codigo)
            {
                pos=i;      
                break;                   
            }
            i=i+1;
        }
        detalleventa[pos].cantidad=cantidadActual;
        detalleventa[pos].subtotal=cantidadActual*detalleventa[pos].pventa;
        subtotal[index]=detalleventa[pos].subtotal;
        total=total+subtotal[index];     
        //$('#fila'+index).remove();
        //controlproducto[index]="";
        //importeAnterior=$('#importe'+index).val();
        
        $('#importe'+index).val(number_format(detalleventa[pos].subtotal,2));
        $('#total').val(number_format(total,2));
    }

    function number_format(amount, decimals) {
        amount += ''; // por si pasan un numero en vez de un string
        amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto
        decimals = decimals || 0; // por si la variable no fue fue pasada
        // si no es un numero o es igual a cero retorno el mismo cero
        if (isNaN(amount) || amount === 0) 
            return parseFloat(0).toFixed(decimals);
        // si es mayor o menor que cero retorno el valor formateado como numero
        amount = '' + amount.toFixed(decimals);
        var amount_parts = amount.split('.'),
            regexp = /(\d+)(\d{3})/;
        while (regexp.test(amount_parts[0]))
            amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');
        return amount_parts.join('.');
    }

    function eliminardetalle(codigo,index){
        total=total-subtotal[index]; 
        tam=detalleventa.length;
        var i=0;
        var pos;      
        while (i<tam)
        {
            if (detalleventa[i].codigo==codigo)
            {
                pos=i;      
                break;                   
            }
            i=i+1;
        }
        detalleventa.splice(pos,1);    
        $('#fila'+index).remove();
        controlproducto[index]="";
        $('#total').val(number_format(total,2));
    }

</script>








@section('script')  

     <script src="/select2/bootstrap-select.min.js"></script> 
@endsection


@endsection