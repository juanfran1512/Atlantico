<?php
error_reporting( error_reporting() & ~E_NOTICE );
include_once("../controlador/conFactura.php");
session_start();
if(isset($_SESSION["nombre"])) {
//fecha actual  //usuario que anula la factura
  
  $fechahoy=date('Y-m-d');

/*



include_once("../modelo/clsFactura.php");
	$id= new clsFactura();
	$id->id();
   	$ids= $id->row();
include_once("../modelo/clsTipoFactura.php");
  $tipo= new clsTipoFactura();
  $tipo->listar();
include_once("../modelo/clsUnidadMetrica.php");
  $unidad= new clsUnidadMetrica();
  $unidad->listar();

*/
?>
<!DOCTYPE html>
<html lang="es" class="no-js">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="../default/imagenes/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Facturas</title>

    <!-- Bootstrap -->
    <link href="../default/css/bootstrap.min.css" rel="stylesheet">
    <link href="../default/css/miestilo.css" rel="stylesheet">
    <link href="../css/estilo.css" rel="stylesheet">
    <!-- popup -->
    <link rel="stylesheet" type="text/css" href="../css/popup.css" />
    <!-- css transaccion -->
    <link rel="stylesheet" type="text/css" href="../css/css.transaccion.css" />

</head>
<body>

  <!-- para que se visualisen los clientes con el fondo oscuro y vuelva a desaparecer (popup)-->
  <div id="capa" class="cerrar"></div>

  <!-- esto es un popup para seleccionar al cliente de la factura -->
  <div id="popUP_cli" >
    <div class="cont-popup">
      <h3>Seleccionar cliente</h3>
      <div class="table-responsive ">
        <table class="table table-condensed table-bordered" id="tabla_transaccion" >
            <tbody>
                <tr>
                  <th></th>
                  <th>Rif/Ced</th>
                  <th>Nombre</th>
                  <th>Telefono</th>
                  <th>Direccion</th>
                </tr>
                <!-- tabla donde se cargan todos los clientes Activos -->
                <tbody id="todosclientes"></tbody>

            </tbody>
        </table>
        <div class="cerrar btn btn-danger">Cerrar!</div>
      </div>
    </div>
  </div><!-- fin del popup clientes -->

  <!-- esto es un popup para seleccionar al choferes de la factura -->
  <div id="popUP_chof" >
    <div class="cont-popup">
      <h3>Seleccionar Choferes</h3>
      <div class="table-responsive ">
        <table class="table table-condensed table-bordered" id="tabla_transaccion" >
            <tbody>
                <tr>
                  <th></th>
                  <th>Rif/Ced</th>
                  <th>Nombre</th>
                  <th>Telefono</th>
                  <th>Direccion</th>
                </tr>
                <!-- tabla donde se cargan todos los choferes Activos -->
                <tbody id="todoschoferes"></tbody>

            </tbody>
        </table>
        <div class="cerrar btn btn-danger">Cerrar!</div>
      </div>
    </div>
  </div><!-- fin del popup choferes -->

  <!-- esto es un popup para seleccionar los productos de la factura -->
  <div id="popUP_prod" >
    <div class="cont-popup">
      <h3>Seleccionar cliente</h3>
      <div class="table-responsive ">
        <table class="table table-condensed table-bordered" id="tabla_transaccion" >
            <tbody>
                <tr>
                  <th></th>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Precio</th>
                  <th>Cestas Existentes</th>

                </tr>
                <!-- tabla donde se cargan todos los productos Activos -->
                <tbody id="todosproductos"></tbody>

            </tbody>
        </table>
        <div class="cerrar btn btn-danger">Cerrar!</div>
      </div>
    </div>
  </div><!-- fin del popup clientes -->


    <!-- cabecera del menu -->
<?php
include('../default/header.php');
?>
<br>

<!-- formulario -->
	<div class="row" style="margin-bottom: 50px;">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1 ">
          <div class="panel panel-default">
                  <div class="panel-heading">
	                	<img id="formulario-img" src="../default/imagenes/formulario.png" />
	                	<strong >Facturas</strong>
	                </div>
	                <div class="panel-body">
	                	<form name="form" action="" method="POST" class="form-horizontal" role="form">

                      <input type="hidden" name="usuario_fac"  value="<?php echo $_SESSION["cedula"]; ?>" >

                      
      		            <div class="form-group">
      		                <label class="col-sm-2  control-label">* Nro. de Factura</label>
      		                <div class="col-sm-3" >
      		                	<div class="input-group" >
      		                    	<input type="text" class="form-control" autocomplete="off" name="numero_fac" value="<?php echo $arreglo_buscar["nro_fac"];?>">
      		                   		<!-- boton buscar-->
      							            <span class="input-group-btn">
      		                   			<span class="glyphicon glyphicon-user " ></span>
      		                    	    <input type="submit" class="btn btn-default"  name="btnBuscar" value=" Buscar ">
      		                    	</span>
      		                	</div>
      		                </div>
                      </div>
                      <div class="form-group">

                          <label class="col-sm-2  control-label">* Fecha:</label>
                          <div class="col-sm-3" >
                            <input type="date" class="form-control" readonly name="fecha_fac" value="<?php if($existe=="si"){ echo $arreglo_buscar['fec_fac'];}else{ echo $fechahoy;}?>">
                          </div>
                          <label class="col-sm-3  control-label">* Fecha de Vencimiento:</label>
                          <div class="col-sm-3" >
                            <input type="date" class="form-control"  name="fecha_ven" value="<?php if($existe=="si"){ echo $arreglo_buscar['fec_ven'];}else{ echo date('Y-m-d', strtotime("$fechahoy + 4 day"));}?>">
                          </div>
                      </div>
                    			
      			          
                      <div class="form-group">
                        <div class="col-sm-2 col-xs-offset-1 " >
                        <!-- boton para agregar el cliente con popup (se coloca la etiqueta <div> en vez de <button> porque el formulario lo reconoce y se recarga la pagina) -->
                            <div class="btn btn-info" id="btnClientes"  >Buscar cliente (+)</div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2  control-label">CI/RIF Cliente</label>
                          <div class="col-sm-2" >
                              <input type="text" class="form-control" readonly id="clienteci_fac" name="clienteci_fac" value="<?php echo $arreglo_buscar["cliente_fk"];?>">
                          </div>

                          <label class="col-sm-3  control-label">* Razon Social Cliente</label>
                          <div class="col-sm-5" >
                              <input type="text" class="form-control" readonly id="clientenom_fac" name="clientenom_fac" value="<?php echo $arreglo_buscar["nom_cli"];?>">
                          </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-2 col-xs-offset-1 " >
                        <!-- boton para agregar el chofer con popup (se coloca la etiqueta <div> en vez de <button> porque el formulario lo reconoce y se recarga la pagina) -->
                            <div class="btn btn-info" id="btnChoferes"  >Buscar Choferes (+)</div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2  control-label">CI/RIF Chofer</label>
                          <div class="col-sm-2" >
                              <input type="text" class="form-control" readonly id="choferci_fac" name="choferci_fac" value="<?php echo $arreglo_buscar["chofer_fk"];?>">
                          </div>

                          <label class="col-sm-3  control-label">* Nombre Chofer</label>
                          <div class="col-sm-5" >
                              <input type="text" class="form-control" readonly id="chofernom_fac" name="chofernom_fac" value="<?php echo $arreglo_buscar["nom_chof"];?>">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2  control-label">Placa</label>
                          <div class="col-sm-3" >
                            <input type="text" class="form-control" name="placa_fac" value="<?php echo $arreglo_buscar["placa_fac"];?>">
                          </div>
                      </div>  
                      <div class="form-group">
                          <label class="col-sm-2  control-label">Tipo de pago</label>
                          <div class="col-sm-3" >
                              <select class="form-control" name="tipo_com">
                                <option required=""  value="1"> Efectivo</option>
                                <option required=""  value="2"> Credito</option>
                                <option required=""  value="3"> Cheque</option>
                              </select>
                          </div>
      			          </div>

                      <div class="form-group">
                        <div class="col-sm-2 col-xs-offset-1 " >
                        <!-- boton para agregar el cliente con popup (se coloca la etiqueta <div> 
                        en vez de <button> porque el formulario lo reconoce y se recarga la pagina) -->
                            <div class="btn btn-info" id="btnProductos"  >Buscar Productos (+)</div>
                        </div>
                      </div>
                    

                      <div class="table-responsive ">
                        <table class="table table-condensed table-bordered" id="tabla_transaccion" >
                                            <caption>Productos</caption>
                          <tbody>
                              <tr>
                                                                
                                <th width="200px">Nombre</th>
                                <th>Precio</th>
                                <th>Cestas Existentes</th>
                                <th>Cestas a vender</th>
                                <th>Peso bruto</th>
                                <th>Peso Neto</th>
                                <th>Precio total</th>
                                <th></th>

                              </tr>
                              <tbody>
                                <tr>
                                  <td hidden><input type="hidden" class="form-control" id="codigo_pro"   value=""  readonly></td>
                                  <td><input type="text" class="form-control" id="nombre_pro"   value="" title="Nombre del Producto" readonly></td>
                                  <td><input type="text" class="form-control" id="precio_pro"   value="" title="Precio por Cesta (Unitario)" readonly></td>
                                  <td><input type="text" class="form-control" id="cesta_pro"    value="" title="Cesta Existentes" readonly></td>
                                  <td><input type="text" class="form-control" id="cantidad_pro" value="" title="Cesta a Vender" onkeypress="numeropunto()"></td>
                                  <td><input type="text" class="form-control" id="pesobruto_pro"value="" title="Peso Bruto"></td>
                                  <td><input type="text" class="form-control" id="pesoneto_pro" value="" title="Peso Neto" readonly></td>
                                  <td><input type="text" class="form-control" id="total_pro"    value="" title="Precio Total" readonly></td> 
                                  <td><input type="button" class="btn btn-info" value="+" onclick="agregar()"></td>                              
                              </tr>

                              </tbody>
                          </tbody>                          
                        </table>
                      </div>
                            
                            
                          
                      <div class="table-responsive " id="detalle">
                        <table class="table table-condensed table-bordered" id="tabla_transaccion" >
                                            <caption>Productos</caption>
                          <tbody>
                              <tr>
                                <th width="200px">Nombre</th>
                                <th>Precio</th>                                
                                <th>Cestas a vender</th>
                                <th>Peso bruto</th>
                                <th>Peso Neto</th>
                                <th>Precio total</th>
                              </tr>
                              <?php 

                                  if($existe=="si"){
                                    $cont=1;
                                    while($detalle_fac = $objDetalle->row()){
                                   ?>
                                  <tr id="tr_<?php echo $cont; ?>">
                                    <td hidden>
                                      <input type="hidden" class="form-control" name="codigos_pro[]" readonly="" value="<?php echo $detalle_fac["cod_pro"];?>">
                                    </td>
                                    <td>
                                      <input type="text" class="form-control" readonly="" value="<?php echo $detalle_fac["nom_pro"];?>" title="Nombre del Producto">
                                    </td>
                                      <td>
                                        <input type="text" class="form-control" name="precios_pro[]" readonly="" value="<?php echo $detalle_fac["pre_ven_pro"];?>" title="Precio por Cesta (Unitario)">
                                    </td>
                                      <td>
                                        <input type="text" class="form-control" name="cantidades_pro[]" readonly="" value="<?php echo $detalle_fac["can_ven_pro"];?>" title="Cestas a vender">
                                      </td>
                                      <td>
                                        <input type="text" class="form-control" name="pesob_pro[]" readonly="" value="<?php echo $detalle_fac["pesob_pro"];?>" title="Peso Bruto">
                                    </td>
                                      <td>
                                        <input type="text" class="form-control" name="peson_pro[]" readonly="" value="<?php echo $detalle_fac["peson_pro"];?>" title="Peso Neto">
                                    </td>
                                      <td>
                                        <input type="text" class="form-control" name="totales_pro[]" readonly="" value="<?php echo $detalle_fac["tot_pro"];?>" title="Precio Total">
                                    </td>
                                      <td>
                                        <input type="button" class="btn btn-danger" value="X" onclick="borrar(<?php echo $cont++; ?>)"> 
                                      </td>
                                  </tr>
                                   <?php
                                    }
                                  }
                                   ?>
                               <!-- aqui se cargara los <tr> con los productos (detalle de la factura) -->

                          </tbody>
                        </table>
                      </div>

                      <br>
                      <hr>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-3" >
                               <select class="form-control" name="status_fac">
                                 <option selected value="0">Activa</option>
                                 <option value="1">Suspendida</option>
                               </select>
                            </div>

                            <label class="col-sm-2  control-label">* Total a Pagar</label>
                            <div class="col-sm-3" >
                                <input type="text" class="form-control" autocomplete="off" id="total_fac" readonly name="total_fac" value="<?php echo $arreglo_buscar["tot_fac"];?>">
                            </div>
      			            </div>
                        <h6 class="col-sm-offset-4">Nota: Los Campos Marcados con (*) son Obligatorios.</h6>
		                    <hr>
		                        <div class="col-sm-8">
		                            <input type="submit" class="btn btn-default col-sm-offset-2" name="btnGuardar"  value="Guardar">
		                            <input type="submit" class="btn btn-default" name="btnModificar"  value="Modificar">
		                            <input type="submit" class="btn btn-default" name="btnCancelar"  value="Cancelar">
		                            <input type="submit" class="btn btn-default" name="btnSuspender"  value="Suspender">
		                        </div>
                          <?php 

                          if($existe=="si"){
                            ?>
                            <div class="col-sm-2">
                                <a href="../reportes/factura.php/?n_factura=<?php  echo $arreglo_buscar["nro_fac"]; ?>" target="_blank"  ><div  id="btnImprimir" Title="Imprimir Factura"></div></a>
                            </div>
                            <div class="col-sm-2">
                                <a href="../reportes/guia.php/?n_factura=<?php  echo $arreglo_buscar["nro_fac"]; ?>" target="_blank"  ><div id="btnGuia" Title="Imprimir Guia"></div></a>
                            </div>
                          <?php 
                          }
                          ?>
		                </form>
	           		  </div>
	        </div>
      </div>
	</div><!-- fin del formulario -->




<!-- pie de pagina -->
<?php
include('../default/footer.php');
?>
<!--para recibir el mensaje -->
<?php if($msj) { ?> <script > alert("<?php  print($msj); ?>"); </script> <?php  } ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins)  -->
    <script src="../default/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../default/js/bootstrap.min.js"></script>

    <!-- librerias necesarias para el popup -->
		<script src="../js/ajax.js"></script>


    <!-- codigo para el popup tiene que ir debajo del archivo jqueri .js -->
    <script>
      $(document).ready(function(){
//________clientes
          $('#btnClientes').click(function(){
               $("#popUP_cli").show("fast");
               $("#capa").show();

               loadDoc("listaclientes.php",function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                      document.getElementById("todosclientes").innerHTML=xmlhttp.responseText;
                
                }else{document.getElementById("todosclientes").innerHTML='<img src="../imagenes/load.gif" width="50" height="50" />'; }
              

                });
          });
          
//________Choferes
          $('#btnChoferes').click(function(){
               
               $("#popUP_chof").show("fast");
               $("#capa").show();

               //codigo ajax
               var xmlhttp;
               if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                 xmlhttp=new XMLHttpRequest();
                 }
               else
                 {// code for IE6, IE5
                 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                 }
                 xmlhttp.onreadystatechange=function()
                 {
                     if (xmlhttp.readyState==4 && xmlhttp.status==200){
                       document.getElementById("todoschoferes").innerHTML=xmlhttp.responseText;
                     }
                 }
                 xmlhttp.open("GET","listachoferes.php",true);
                 xmlhttp.send();
          });

//________productos
          $('#btnProductos').click(function(){
               $("#popUP_prod").show("fast");
               $("#capa").show();

               //codigo ajax
               var xmlhttp;
               if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                 xmlhttp=new XMLHttpRequest();
                 }
               else
                 {// code for IE6, IE5
                 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                 }
                 xmlhttp.onreadystatechange=function()
                 {
                     if (xmlhttp.readyState==4 && xmlhttp.status==200){
                       document.getElementById("todosproductos").innerHTML=xmlhttp.responseText;
                     }
                 }
                 xmlhttp.open("GET","listaproductos.php",true);
                 xmlhttp.send();
          });

//________para ocultar el popup que este abierto
          $('.cerrar').click(function(){
               $("#popUP_cli").hide("fast");
               $("#popUP_chof").hide("fast");
               $("#popUP_prod").hide("fast");
               $("#capa").hide();
          });
      });

//________funcion para mandar los datos del cliente a los value de los input
      function enviarcliente(boton){
        //pasamos los datos al formulario de factura, accediendo a las celdas
        rif = boton.parentNode.parentNode.cells[1].innerText;
        nombre = boton.parentNode.parentNode.cells[2].innerText;

        document.getElementById("clienteci_fac").value=rif;
        document.getElementById("clientenom_fac").value=nombre;

        $("#popUP_cli").hide("fast");
        $("#capa").hide();
      }

//________funcion para mandar los datos del chofer a los value de los input
      function enviarchofer(boton){
        //pasamos los datos al formulario de factura, accediendo a las celdas
        rif = boton.parentNode.parentNode.cells[1].innerText;
        nombre = boton.parentNode.parentNode.cells[2].innerText;

        $("#choferci_fac").val(rif);
        $("#chofernom_fac").val(nombre);

        $("#popUP_chof").hide("fast");
        $("#capa").hide();
      }

//________funcion para mandar los datos del producto a los value de los input
      function enviarproducto(boton){
        //pasamos los datos al formulario de factura, accediendo a las celdas
        codigo = boton.parentNode.parentNode.cells[1].innerText;
        nombre = boton.parentNode.parentNode.cells[2].innerText;
        pvp = boton.parentNode.parentNode.cells[3].innerText;
        cesta = boton.parentNode.parentNode.cells[4].innerText;

        document.getElementById("codigo_pro").value=codigo;
        document.getElementById("nombre_pro").value=nombre;
        document.getElementById("precio_pro").value=pvp;
        document.getElementById("cesta_pro").value=cesta;

        $("#popUP_prod").hide("fast");
        $("#capa").hide();
        }
//________agregar productos al detalle (tr)
          // variables para ser usadas en el detalle y el total de la factura 
          var i= 1;
          var total_factura=0;
          var cont=0;
          function agregar(){

            //se obtiene los valores del producto despues de buscarlos
            var codigo_pro = $("#codigo_pro").val();
            var nombre_pro = $("#nombre_pro").val();
            var precio_pro = $("#precio_pro").val();
            var cesta_pro = $("#cesta_pro").val();
            var cantidad_pro = $("#cantidad_pro").val();
            var pesobruto_pro = $("#pesobruto_pro").val();
            var pesoneto_pro = $("#pesoneto_pro").val();
            var total_pro = $("#total_pro").val();


            //se inserta la tabla con los nuevos valores
            
            var td1='<td hidden><input type="hidden" class="form-control" name="codigos_pro[]"    readonly value="'+codigo_pro+'"></td>';
            var td2='<td><input type="text" class="form-control"                     readonly value="'+nombre_pro+'" title="Nombre del Producto"></td>'
            var td3='<td><input type="text" class="form-control" name="precios_pro[]"    readonly value="'+precio_pro+'" title="Precio por Cesta (Unitario)"></td>';
            var td4='<td hidden><input type="hidden" class="form-control" name="cestas_pro[]"    readonly value="'+cesta_pro+'"></td>';
            var td5='<td><input type="text" class="form-control" name="cantidades_pro[]" readonly value="'+cantidad_pro+'" title="Cestas a vender"></td>';
            var td6='<td><input type="text" class="form-control" name="pesob_pro[]"     readonly value="'+pesobruto_pro+'" title="Peso Bruto"></td>';
            var td7='<td><input type="text" class="form-control" name="peson_pro[]"     readonly value="'+pesoneto_pro+'" title="Peso Neto"></td>';
            var td8='<td><input type="text" class="form-control" name="totales_pro[]" readonly id="totales_pro"    value="'+total_pro+'" title="Precio Total"></td>';
            var td9='<td><input type="button" class="btn btn-danger" value="X" onclick="borrar('+i+')"> </td>';

            $("#detalle tr:last").after('<tr id=tr_'+i+'>'+td1+td2+td3+td4+td5+td6+td7+td8+td9+'</tr>');
          
          i++;
          //se usa toFixed(); para mostrar decimales
          total_pro =  parseFloat(total_pro);
          //se le asigna el total a la factura
          total_factura=total_factura+total_pro;
          //se usa toFixed(); para mostrar decimales
          $("#total_fac").val(total_factura.toFixed(2));
          //borramos los values del producto buscado
          $("#codigo_pro,#nombre_pro,#precio_pro,#cesta_pro,#cantidad_pro,#pesobruto_pro,#pesoneto_pro,#total_pro").val("");
        }
        function borrar(num){
        //se obtiene los valores del producto
        var tot_producto = $("#tr_"+num+" td #totales_pro ").val();
        var tot_factura  = $("#total_fac").val();
        //se le resta el producto a borrar al total de la factura
          tot_factura=tot_factura-tot_producto;
          //se usa toFixed(); para mostrar decimales
          $("#total_fac").val(tot_factura.toFixed(2));

        //se borra el tr segun el id seleccionado
        $("#tr_"+num).remove();
        }

//________Calcular el Peso Neto
          $("#pesobruto_pro").keyup(function(){
            //se obtiene los valores del producto para calcular el Peso Neto y el total
            
            var precio_producto = $("#precio_pro").val();
            var cantidad = $("#cantidad_pro").val();
            var pesobruto = $("#pesobruto_pro").val();

            //validacion
            if (cantidad=="" || pesobruto<=2.300 ) {
              //se le asigna el valor 0 a los values
              $("#pesoneto_pro").val("0.000");
              $("#total_pro").val("0.00");
            }else{
              //calculo

            re=cantidad*2.300;          
            resultado_pesoneto=pesobruto-re;
            total_producto=precio_producto*resultado_pesoneto;
            
            //se usa toFixed(); para mostrar decimales
            resultado_pesoneto=resultado_pesoneto.toFixed(3);
            total_producto=total_producto.toFixed(2);

            //se muestra el resultado en los values
          $("#pesoneto_pro").val(resultado_pesoneto);
          $("#total_pro").val(total_producto);
            }
            
                      
          });
        

    </script>
</body>
</html>
<?php

    }else {

    header("Location:../index.php");
    }

?>