<?php
error_reporting( error_reporting() & ~E_NOTICE );
include_once("../controlador/conPresupuesto.php");
require ('../modelo/conexion.php');
$query = "SELECT * FROM `totros` ORDER BY `cod_bor` DESC LIMIT 1  ";

  if($resultado=$mysqli->query($query)){ 
  $buscando = $resultado->fetch_assoc();
  $bordado=$buscando['pre_bor'];
  $bordado_fuera=$buscando['pre_bor_fuera'];
  $cuello=$buscando['pre_cuello'];
  }

  
  
session_start();
if(isset($_SESSION["nombre"])) {
//fecha actual  //usuario que anula la factura
  
  $fechahoy=date('Y-m-d');
include_once("../modelo/clsPresupuesto.php");
  $id= new clsPresupuesto();
  $id->id();
    $ids= $id->row();
    $num_pre=$ids['id']+1;

?>

<style type="text/css">


#divnombre{ 

    margin-top: 33px;
 z-index: 1;
 position: absolute;
 background: white;
 -webkit-border-radius: 0px 0px 4px 4px;
 -moz-border-radius: 0px 0px 4px 4px;       
}         

#divproducto{ 
    width: 100%;
    margin: 33px 0px 3px;
 z-index: 1;
 position: absolute;
 background: white;
 -webkit-border-radius: 0px 0px 4px 4px;
 -moz-border-radius: 0px 0px 4px 4px;       
} 
.sugerencias:hover{
 background-color:#D3D3D3;
 cursor:default;
}

#busqueda{
 background-image:url('public/img/search.png');
 background-size:25px 23px;/*tamano imagen*/
 background-repeat:no-repeat;
 background-position:right;
 border-radius: 5px;
 border-style:solid;
 border-color:#1E90FF;
 border-width:1px;
 height:30px;
 color:#808080;

}
#divproducto {
    width: 41%;
    margin: 0px 2px 3px;
    z-index: 1;
    position: absolute;
    background: white;
    -webkit-border-radius: 0px 0px 4px 4px;
    -moz-border-radius: 0px 0px 4px 4px;
    font-size: 12;
}</style>

<script>// busqueda ajax
    function busqueda(){
 
$('#divnombre').show();
    var n=document.getElementById('nombre').value;

    if(n==''){

     document.getElementById("divnombre").innerHTML="";
     document.getElementById("divnombre").style.border="0px";



     return;
    }

    loadDoc("q="+n,"BusCli.php",function(){

      if (xmlhttp.readyState==4 && xmlhttp.status==200){

        document.getElementById("divnombre").innerHTML=xmlhttp.responseText;
        document.getElementById("divnombre").style.border="1px solid #A5ACB2";

        }else{ document.getElementById("divnombre").innerHTML='<img src="../default/imagenes/load.gif" width="50" height="50" />'; }

      });
    }

// seleccion de la busqueda

function busqueda2(cod){

var todo={"cliente":cod};
      console.log(todo);
      $.post('../controlador/conCliente.php', {validacliente: todo}, function(data) {
        
        var datos=data.split("|");
        
        if(datos[1]=="si"){
          document.form.nombre.value=datos[2];
          document.form.cliente.value=datos[6];
          document.form.telefono.value=datos[3];
          //document.form.nom_tela.disabled=true;
          //document.form.nom_mod.disabled=true;
          //document.form.nom_tip.disabled=true;
          //document.form.duracion.focus();
          document.getElementById("divnombre").style.border="0px";
          $('.sugerencias').hide();

        }
        if(datos[1]=="no"){
          alert("No existe ese Cliente");
        }
        console.log(datos);
      });

}
    function busqueda_producto1(){
 
$('#divproducto').show();
    var n=document.getElementById('nom_pro').value;

    if(n==''){

     document.getElementById("divproducto").innerHTML="";
     document.getElementById("divproducto").style.border="0px";



     return;
    }

    loadDoc("q="+n,"BusPro2.php",function(){

      if (xmlhttp.readyState==4 && xmlhttp.status==200){

        document.getElementById("divproducto").innerHTML=xmlhttp.responseText;
        document.getElementById("divproducto").style.border="1px solid #A5ACB2";

        }else{ document.getElementById("divproducto").innerHTML='<img src="../default/imagenes/load.gif" width="50" height="50" />'; }

      });
    }

// seleccion de la busqueda

function busqueda_producto2(cod){

var todo={"productos":cod};
      console.log(todo);
      $.post('../controlador/conProducto.php', {buscaproducto: todo}, function(data) {
        
        var datos=data.split("|");
        
        if(datos[1]=="sip"){

          document.form.nom_pro.value=datos[2];
          document.form.cod_pro.value=datos[4];
          document.form.tela.value=datos[5];
          document.form.precio_tela.value=datos[8];
          document.form.precio_modelo.value=datos[7];
          document.form.nom_pro.disabled=false;
          document.form.bordados.disabled=false;
          
          can=document.form.can_pro.value;
          if(can>0){document.form.agrega.disabled=false;}else{document.form.can_pro.focus();}
          document.getElementById("divproducto").style.border="0px";
          $('.sugerencias').hide();
          calculo_precio(datos[8],datos[7],datos[9],datos[10],datos[11],datos[12],datos[13]);

        }
        if(datos[1]=="no"){
          alert("No existe ese Producto");
        }

        console.log(datos);
      });

}
function cerrar(){
  $('#close').hide();
  document.getElementById("divnombre").style.border="0px";
   document.getElementById("divproducto").style.border="0px";
}


</script>
<!DOCTYPE html>
<html lang="es" class="no-js">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="../default/imagenes/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script type="text/javascript" src="../default/js/ajax.js"></script>
    <script type="text/javascript" src="../default/js/validaciones.js"></script>
       <!-- jQuery (necessary for Bootstrap's JavaScript plugins)  -->
    <script src="../default/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../default/js/bootstrap.min.js"></script>

    <!-- librerias necesarias para el popup -->
    <script src="../js/ajax.js"></script>
    <script src="../js/jquery-3.2.1.js"></script>
    <!--para los combos dinamicos -->
    <script src="../js/js.js"></script>
    <script src="../default/ajax.js"></script>
    <script src="../ajax.js"></script>
    <title>Presupuestos</title>
<?php $numero = $_GET['numero'];
if($numero!=""){
  $recargar="si";
  ?>
<script>
function f_pago(valu){
          var estatus=document.form.est_pre.value;
            if(estatus=='3' || estatus=='4'){
              $("#Aprobado").show();
            }
            if(estatus=='1' || estatus=='2' || estatus=='5'){
              $("#Aprobado").hide();
            }
          if(valu>0){
            document.form.abono.disabled=false;

          }
        }
modifica();
function modifica(){
  
var numero="<?php echo $numero; ?>";
   var todo={"numero":numero};
      console.log(todo);
      $.post('../controlador/conRecarga.php', {validapresupuesto: todo}, function(data) {
        
        var datos=data.split("|");
        if(datos[1]=="si"){
          document.form.btnModificar.disabled=false;
          document.form.fecha_presu.disabled=false;
          document.form.btnGuardar.disabled=true;
          document.form.nombre.value=datos[2];
          document.form.cliente.value=datos[3];
          document.form.telefono.value=datos[4];
          document.form.est_pre.value=datos[5];
          document.form.fecha_presu.value=datos[6];
          document.form.fecha_ven.value=datos[7];
          document.form.sub_total.value=datos[8];
          document.form.monto_iva.value=datos[9];
          document.form.total_presu.value=datos[10];
          document.form.abono.value=datos[11];
          document.form.restante.value=datos[12];
          document.form.tipo_pago.value=datos[13]
          document.form.fecha_ent.value=datos[14];
          document.form.iva.value=datos[15];
          document.form.numero_presu.value=numero;
          f_pago(datos[13]);
         }
        console.log(datos);
      });
      
}
</script>
  <?php
}
?>
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
      
                <div id="todosclientes"></div>

            
        
      </div>
    </div>
 <!-- fin del popup clientes -->

  <!-- esto es un popup para seleccionar los productos de la factura -->
  <div id="popUP_prod" >
    <div class="cont-popup">
      <h3>Seleccionar Producto</h3>
      <div class="table-responsive ">
        <table class="table table-condensed table-bordered" id="tabla_transaccion" >
            <tbody>
                <tr>
                  <th></th>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Precio</th>


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

<!-- formulario -->
	<div class="row" style="margin-bottom: 50px; margin-top: 10px;">
      <div class="col-xs-12 col-sm-12 ">
          <div class="panel panel-default">
                  <div class="panel-heading">
	                	<img id="formulario-img" src="../default/imagenes/formulario.png" />
	                	<strong >Presupuestos</strong>
	                </div>
	                <div class="panel-body">
	                	<form name="form" action="" method="POST" class="form-horizontal" role="form">

                      <input type="hidden" name="ela_presu"  value="<?php echo $_SESSION["cedula"]; ?>" >


                      
      		            <!--<div class="form-group">
      		                <label class="col-sm-2  control-label">* Nro. de Factura</label>
      		                <div class="col-sm-3" >
      		                	<div class="input-group" >
      		                    	
      		                   		 boton buscar
      							            <span class="input-group-btn">
      		                   			<span class="glyphicon glyphicon-user " ></span>
      		                    	    <input type="submit" class="btn btn-default"  name="btnBuscar" value=" Buscar ">
      		                    	</span>
      		                	</div>
      		                </div>
                      </div>-->
                      <div class="form-group">
                      
                          <label class="col-sm-1  control-label">Fecha:</label>
                          <div class="col-sm-2" >
                            <input type="date" class="form-control"  name="fecha_presu" value="<?php if($existe=="si"){ echo $arreglo_buscar['fec_presu'];}else{ echo $fechahoy;}?>">
                          </div>
                          <label class="col-sm-1  control-label" style="padding: 7px 10px 3px 0px;">Vencimiento:</label>
                          <div class="col-sm-2" >
                            <input type="date" class="form-control"  name="fecha_ven" value="<?php if($existe=="si"){ echo $arreglo_buscar['ven_presu'];}else{ echo date('Y-m-d', strtotime("$fechahoy + 1 day"));}?>">
                          </div>

                        <label class="col-sm-1 control-label">Estatus</label>
                        <div class="col-sm-2" >
                        <select class="form-control" id="est_pre" name="est_pre">
                                <option required=""  value="1"> Por Enviar</option>
                                <option required=""  value="2"> Enviado</option>
                                <option required=""  value="3"> Aprobado</option>
                                <option required=""  value="4"> Cancelado</option>
                                <option required=""  value="5"> Pendiente</option>
                              </select>
                        </div>
                        <label class="col-sm-1  control-label">Número:</label>
                          <div class="col-sm-2">
                          <input type="text" style="text-align: right;"  class="form-control" autocomplete="off" name="numero_presu" value="<?php if($existe=="si"){echo $arreglo_buscar["cod_presu"]; }else{echo $num_pre;} ?>">
                              
                          </div>
                      </div>
                    			
      			          
                      <div class="form-group">
                        
                        <label class="col-sm-1  control-label">Cliente:</label>
                          <div class="col-sm-5" >
                          <div class="input-group" >
                              <input type="text" class="form-control"  id="nombre" autocomplete="off" name="nombre" onkeyup="busqueda()" onblur="this.value=this.value.toUpperCase()" 
                              value="<?php echo $arreglo_buscar["nom_cli"];?>">
                              <div id="divnombre"></div>
                              <span class="input-group-btn">
                                    <span class="glyphicon glyphicon-user " ></span>
                                      <input type="button" class="btn btn-info"  name="btnClientes" id="btnClientes"  value=" + ">
                                  </span>
                          </div>
                          </div>
 
                        <label class="col-sm-1 control-label"style="padding: 7px 10px 3px 0px; ">CI/RIF:</label>
                          <div class="col-sm-2" >
                              <input type="text" class="form-control"  id="cliente" readonly name="cliente" value="<?php echo $arreglo_buscar["cli_presu"];?>">
                          </div>
                          <label class="col-sm-1 control-label">Telefono:</label>
                          <div class="col-sm-2" >
                              <input type="text" class="form-control" disabled id="telefono" name="telefono" value="<?php echo $arreglo_buscar["tlfn_cli"];?>">
                          </div>

                      </div>


                      <!--<div class="form-group">
                        <div class="col-sm-2 col-xs-offset-1 " >-->
                        <!-- boton para agregar el chofer con popup (se coloca la etiqueta <div> en vez de <button> porque el formulario lo reconoce y se recarga la pagina) -->
                       <!--     <div class="btn btn-info" id="btnChoferes"  >Buscar Choferes (+)</div>
                        </div>
                      </div>

                      </div>-->  
                      <!--si el presupuesto esta aprobado habilitar el tipo de pago -->
                      <div class="form-group" id="Aprobado"style="display:none" >
                          <label class="col-sm-1  control-label">Tipo de pago:</label>
                          <div class="col-sm-2" >
                              <select class="form-control" onchange="f_pago(this.value)"name="tipo_pago">
                                <option   value="0"> Seleccione</option>
                                <option   value="1"> Cheque</option>
                                <option   value="2"> Efectivo</option>
                                <option   value="3"> Transferencia</option>
                              </select>
                          </div>
                          <label class="col-sm-1  control-label">Abono:</label>
                          <div class="col-sm-2" >
                            <input type="text" class="form-control" id="abono" name="abono" disabled onblur="f_abono()"value="<?php echo $arreglo_buscar["abo_pre"];?>">
                          </div>
                          <label class="col-sm-1  control-label">Restante:</label>
                          <div class="col-sm-2" >
                            <input type="text" class="form-control" id="restante" name="restante" readonly value="<?php echo $arreglo_buscar["res_pre"];?>">
                          </div>
                          <label class="col-sm-1  control-label" style="padding: 7px 10px 3px 0px;">Entrega:</label>
                          <div class="col-sm-2" >
                            <input type="date" class="form-control"  name="fecha_ent" value="<?php if($existe=="si"){ echo $arreglo_buscar['fec_ent'];}else{ echo date('Y-m-d', strtotime("$fechahoy + 1 month"));}?>">
                          </div>
      			          </div>

                      <div class="table-responsive ">
                        <table class="table table-condensed " id="tabla_transaccion" >
                          <h4 align="center">Productos</h4>
                          <tbody>
                              <tr>
                                <th width="4%"><h5>Cant.</h5></th>                                
                                <th width="35%"><h5>Nombre</h5></th>
                                <th width="7%"><h5>Bordados</h5></th>
                                <th width="7%"><h5>Precio</h5></th>
                                <!--<th width="9%"><h5>Con IVA</h5></th>-->
                                <th width="9%"><h5>Sub Total</h5></th>
                                <th width="12%"><h5>Total</h5></th>
                                <th width="1%"></th>

                              </tr>
                              <tbody>
                                <tr>
                                  <td hidden><input type="hidden" class="form-control" id="cod_pro" name="cod_pro"class="cod_pro"  value=""  ></td>
                                  <td><input type="text" class="form-control" id="can_pro" onKeyPress="return numeros(event);" onblur="f_cantidad()" name="can_pro"  value="" title="Cantidad Producto" ></td>
                                  <td><div id="hola"><input type="text"  class="form-control" id="nom_pro"  name="nom_pro" autocomplete="off"onkeyup="busqueda_producto1()" onblur="this.value=this.value.toUpperCase()"  value="" title="Nombre del Producto" >
                                  <div id="divproducto"></div></div></td>
                                  

                                  <td><select class="form-control" name="bordados" id="bordados" onchange="f_act_pre_bor()"disabled title="Cantidad de Bordados">
                                    <option  value="">Seleccione</option>
                                    <option  value="1">1</option>
                                    <option  value="2">2</option>
                                    <option  value="3">3</option>
                                    <option  value="4">4</option>
                                    <option  value="5">5</option>
                                    <option  value="6">6</option>
                                    <option  value="7">7</option>
                                    <option  value="8">8</option>
                                    <option  value="9">9</option>
                                  </select></td>
                                  <td>
                                  <input type="hidden" name="tela"></input>
                                  <input type="hidden" name="precio_modelo"></input>
                                  <input type="hidden" name="precio_tela"></input>
                                  <input type="hidden" name="precio_bordado" value="<?php echo $bordado?>"></input>
                                  <input type="hidden" name="precio_cuello" value="<?php echo $cuello?>"></input>
                                  <input type="text" class="form-control" id="pre_bor" name="pre_bor" onblur="f_precio_bor()" value="" disabled title="Precio de los Bordados"><input type="hidden" name="aux_bor" value="0"></input></td>
                                  <!--<td><input type="text" class="form-control" id="cos_iva" name="cos_iva" value="" title="Precio con IVA" readonly></td>-->
                                  <td><input type="text" class="form-control" id="cos_sin_iva" name="cos_sin_iva" value="" onblur="f_pre_gregorio()" title="Precio" ></td>
                                  <td><input type="text" class="form-control" id="cos_total" name="cos_total" value="" title="Precio Total" readonly></td> 
                                  <td><input type="button" class="btn btn-info" value="+" name="agrega" disabled onclick="agregar()"></td>                              
                              </tr>

                              </tbody>
                          </tbody>                          
                        </table>
                      </div>
                            
                            
                          
                      <div class="table-responsive " id="detalle" style="margin-top: -1.5%;" >
                        <table class="table table-condensed " id="tabla_transaccion" >
                            <tbody>
                              <tr style="display: none;">
                                <th width="4%">Cant.</th>                                
                                <th width="35%">Nombre</th>
                                <th width="7%">Bordados</th>
                                <th width="10%">Prec. Bordado</th>
                                <th width="12%">Precio</th>
                                <th width="12%">Sub Total</th>
                                <th width="12%">Total</th>
                                <th width="3,5%"></th>
                              </tr>
                              <?php 
                                  $cont=0; 
                                  if($existe=="si"||$recargar=="si"){ 
                                    if($primero=="si"){
                                      $objPresupuesto->buscar_detalle($num_pre);
                                    }else{ 
                                      $objPresupuesto->recargar_detalle($numero);
                                    }
                                   
                                     $cont=1;
                                    while($detalle_pre = $objPresupuesto->row2()){
                                   ?><tr style="display: none;"><th width="4%">Cant.</th>                                
                                <th width="35%">Nombre</th>
                                <th width="7%">Bordados</th>
                                <th width="10%">Prec. Bordado</th>
                                <th width="12%">Precio</th>
                                <th width="12%">Sub Total</th>
                                <th width="12%">Total</th>
                                <th width="3,5%"></th><tr>
                                  <tr id="tr_<?php echo $cont; ?>">
                                    <td hidden><input type="hidden" class="form-control" name="codigos_pro[]"  id="id_<?php echo $cont; ?>"   value="<?php echo $detalle_pre["cod_pro"];?>"></td>
                                    <td style="width: 5.1%;"><input  type="text"onblur="f_cantidad_2(this.value,<?php echo $cont; ?>)" id="can_<?php echo $cont; ?>" class="form-control" name="cantidades_pro[]" onclick="f_cambio(this.value,<?php echo $cont; ?>)" value="<?php echo $detalle_pre["can_pro"];?>" title="Cantidad de piezas"></td>
                                    <td hidden><input type="hidden" class="form-control" name="auxiliar_cant" id="cant_<?php echo $cont; ?>"    value=""></td>
                                    <td style="width: 45.5%;"><input type="text" class="form-control" name="nombres_pro[]"  value="<?php echo $detalle_pre["nom_pro"];?>" title="Nombre del Producto"></td>
                                    <td style="width: 9.4%;"><input type="text"  class="form-control" name="bordado_pros[]"     value="<?php echo $detalle_pre["bordados"];?>"title="Cantidad de bordados adicionales"></td>
                                    <td style="width: 9.4%;"><input type="text"  class="form-control" name="precios_bordado_pro[]"     value="<?php echo $detalle_pre["pre_bor"];?>" title="Precio de los bordos"></td>
                                    <!--<td style="width: 8.4%;"><input type="text"  class="form-control" name="con_iva_pros[]"     readonly value="<?php echo $detalle_pre["cos_iva"];?>" title="Precio Completo"></td>-->
                                    <td style="width: 11.4%;"><input type="text"  class="form-control" name="sin_iva_pros[]" id="sin_<?php echo $cont; ?>" readonly id="sin_iva_pro"    value="<?php echo $detalle_pre["cos_sin_iva"];?>" title="Precio sin IVA"></td>
                                    <td style="width: 15.5%;"><input type="text" class="form-control" name="total_pros[]"id="tot_<?php echo $cont; ?>" readonly id="total_pro"    value="<?php echo $detalle_pre["cos_total"];?>" title="Total"></td>
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
                      <hr>

                        <div class="form-group">
                        
                        <label class="col-sm-1 col-sm-offset-9 control-label">* Sub Total</label>
                            <div class="col-sm-2" >
                                <input type="text" class="form-control" autocomplete="off" id="sub_total" readonly name="sub_total" value="<?php echo $arreglo_buscar["sub_total_presu"];?>">
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-1 col-sm-offset-7 control-label">* IVA %</label>
                        <div class="col-sm-1" >
                                <input type="text" class="form-control" autocomplete="off" id="iva" onclick="f_captura_iva(this.value)"onblur="f_iva(this.value)"  name="iva" value="<?php echo $arreglo_buscar["val_iva"];?>">
                                <input type="hidden" class="form-control" name="aux_iva" id="aux_iva"    value="">
                            </div>
                            <label class="col-sm-1  control-label">* Monto Iva</label>
                            <div class="col-sm-2" >
                                <input type="text" class="form-control" autocomplete="off" id="monto_iva" readonly name="monto_iva" value="<?php echo $arreglo_buscar["monto_iva_presu"];?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 col-sm-offset-9 control-label">* Total a Pagar</label>
                            <div class="col-sm-2" >
                                <input type="text" class="form-control" autocomplete="off" id="total_presu" readonly name="total_presu" value="<?php echo $arreglo_buscar["tot_presu"];?>">
                            </div>
      			            </div>
                        <h6 align="center">Nota: Los Campos Marcados con (*) son Obligatorios.</h6>
		                    <hr>
                        <div class="form-group">
		                        <div class="col-sm-10 col-sm-offset-1">
		                            <input type="submit" class="btn btn-default col-sm-offset-4" name="btnGuardar"  value="Guardar">
		                            <input type="submit" class="btn btn-default" disabled name="btnModificar"  value="Modificar">
		                            <input type="submit" class="btn btn-default" name="btnCancelar"  value="Cancelar">
		                            <input type="submit" class="btn btn-default" name="btnSuspender"  value="Suspender">
                                <?php if($recargar=="si"){?>
                                  <input type="button" class="btn btn-default" name="btnActualizar"id="btnActualizar" onclick="f_actualizar()" value="Actualizar">
                                  <?php } ?>
		                        </div>
                            <div class="col-sm-1">
                                <a href="../reportes/presupuesto.php/?n_presupuesto=<?php if($existe=="si"){echo $arreglo_buscar["cod_presu"]; }if($recargar=="si"){echo $numero;}?>" target="_blank"  ><div  id="btnImprimir" Title="Imprimir Presupuesto"></div></a>
                            </div>
                            </div>
                         
                            

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
<script src="../js/ajax.js"></script>
 

    <!-- codigo para el popup tiene que ir debajo del archivo jqueri .js -->
    <script>

     $(document).ready(function(){
//________clientes
          $('#btnClientes').click(function(){
               $("#popUP_cli").show("fast");
               $("#capa").show();

               loadDoc("prueba","addclientes.php",function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                      document.getElementById("todosclientes").innerHTML=xmlhttp.responseText;
                
                }else{document.getElementById("todosclientes").innerHTML='<img src="../imagenes/load.gif" width="50" height="50" />'; }
              

                });
            });

          $('#cerrar').click(function(){
               $("#popUP_cli").hide("fast");

               $("#capa").hide();
          });
          });
     function f_cerrar(){ 
           $("#popUP_cli").hide("fast");

               $("#capa").hide();
             }
    function f_pre_gregorio(){

    var cant=document.form.can_pro.value;
    var sin=document.form.cos_sin_iva.value;
    var nom=document.form.nom_pro.value;
    if(cant>0){

      document.form.cos_total.value=(cant*sin).toFixed(2);
      if(nom!=""){document.form.agrega.disabled=false;}
    }
    }
    function f_cantidad(){

    var cant=document.form.can_pro.value;
    var sin=document.form.cos_sin_iva.value;
    var nom=document.form.nom_pro.value;
    if(cant>0){

      document.form.cos_total.value=(cant*sin).toFixed(2);
      if(nom!=""){document.form.agrega.disabled=false;}
    }
    }
   function f_cantidad_2(dato,id){
 
    var arreglo="can_"+id;
    var arreglo2="sin_"+id;
    var arreglo3="tot_"+id;
    var arreglo4="cant_"+id;
    var mon=0.00;
    var tot_presu=0.00;
    var cant=parseFloat(document.getElementById(arreglo).value);
    var iva_val=parseFloat(document.form.iva.value);
    var sin=parseFloat(document.getElementById(arreglo2).value);
      var can=document.getElementById(arreglo4).value
      var total=(parseFloat(document.getElementById(arreglo3).value).toFixed(2));
      if(can==dato){
        
       
      }else{
        var sub=parseFloat(document.form.sub_total.value);
        sub=sub-total;
        document.form.sub_total.value=sub;
        var total=0;
        total=cant*sin;
        total=parseFloat(total);
        document.getElementById(arreglo3).value=total.toFixed(2);
        var sub=parseFloat(document.form.sub_total.value);
        
        sub=sub+total;
        mon=sub*(iva_val/100);
        tot_presu=sub+mon;

        document.form.sub_total.value=sub.toFixed(2);
        document.form.monto_iva.value=mon.toFixed(2);
        document.form.total_presu.value=tot_presu.toFixed(2);
    }
    }
    function f_captura_iva(dato){
      $("#aux_iva").val(dato);
    }
    function f_iva(dato){
      var iva =$("#aux_iva").val();
      var mon=0.00;
      var tot_presu=0.00;
      if(dato!=iva){

        var sub = parseFloat($("#sub_total").val());

        mon=sub*(dato/100);
        tot_presu=sub+mon;
        document.form.monto_iva.value=mon.toFixed(2);
        document.form.total_presu.value=tot_presu.toFixed(2);
      }
      

    }
$(document).ready(function(){

    //para activar la seccion de tipo de pago abono y restante

     $("#est_pre").change(function(){
            
            var estatus=document.form.est_pre.value;
            if(estatus=='3' || estatus=='4'){
              $("#Aprobado").show();
              $("#btnActualizar").hide();
              
            }
            if(estatus=='1' || estatus=='2' || estatus=='5'){
              $("#Aprobado").hide();
            }
        });
    });
    function calculo_precio(ptela,pmodelo,pieza,operador,precio,ctela,talla){
      var pbordado=parseInt(document.form.precio_bordado.value);
      var pcuello=parseInt(document.form.precio_cuello.value);
      pmodelo=parseInt(pmodelo);
      var canti=document.form.can_pro.value;
      var tela=document.form.tela.value;

      if(operador=="/"){

        if(tela=="6"){

        var precio_sin=Math.ceil((((((precio/pieza)+pcuello)*1.125)*1.3)+pbordado)+pmodelo);
 
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(0);
        tot=canti*precio_sin;
        document.form.cos_total.value=tot.toFixed(0);
         }
         if(tela=="7"){
        var precio_sin=Math.ceil(((((precio/pieza)*1.125)*1.3)+pbordado)+pmodelo);

        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(0);
        tot=canti*precio_sin;
        document.form.cos_total.value=tot.toFixed(0);
         }

        if(talla=="1"||talla=="2"||talla=="4"||talla=="6"){
           if(tela=="6"){
        //tela 6==PIQUE
        //TELA 7==JERSEY
        var precio_sin=Math.ceil((((((precio/6)+pcuello)*1.125)*1.3)+pbordado)+pmodelo);
        var precio_con=precio_sin*1.12;
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(0);
        tot=canti*precio_sin;
        document.form.cos_total.value=tot.toFixed(0);
         }
         if(tela=="7"){
        var precio_con=Math.ceil((((((precio/6)*1.125)*1.3)+pbordado)+pmodelo)*1.12);
        var precio_sin=precio_con/1.12;
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(0);
        tot=canti*precio_sin;
        document.form.cos_total.value=tot.toFixed(0);
         }
        }
        if(talla=="8"||talla=="10"){
           if(tela=="6"){
        //tela 6==PIQUE
        //TELA 7==JERSEY
        var precio_sin=Math.ceil((((((precio/5)+pcuello)*1.125)*1.3)+pbordado)+pmodelo);
        var precio_con=precio_sin*1.12;
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(0);
        tot=canti*precio_sin;
        document.form.cos_total.value=tot.toFixed(0);
         }
         if(tela=="7"){
        var precio_con=Math.ceil((((((precio/5)*1.125)*1.3)+pbordado)+pmodelo)*1.12);
        var precio_sin=precio_con/1.12;
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(0);
        tot=canti*precio_sin;
        document.form.cos_total.value=tot.toFixed(0);
         }
        }
      }if(talla=="12"||talla=="14"||talla=="16"){
           if(tela=="6"){
        //tela 6==PIQUE
        //TELA 7==JERSEY
        var precio_sin=Math.ceil((((((precio/4)+pcuello)*1.125)*1.3)+pbordado)+pmodelo);
        var precio_con=precio_sin*1.12;
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(0);
        tot=canti*precio_sin;
        document.form.cos_total.value=tot.toFixed(0);
         }
         if(tela=="7"){
        var precio_con=Math.ceil((((((precio/4)*1.125)*1.3)+pbordado)+pmodelo)*1.12);
        var precio_sin=precio_con/1.12;
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(0);
        tot=canti*precio_sin;
        document.form.cos_total.value=tot.toFixed(0);
         }
        }
      if(operador=="X"){
        if(pmodelo>0){
          var precio_sin=Math.ceil((((((precio*pieza)*1.125)*1.3)+pbordado)*1.12)+pmodelo)/1.12;
        

        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(0);
        tot=canti*precio_sin;
        document.form.cos_total.value=tot.toFixed(0);
        }else{
          var precio_sin=Math.ceil(((((precio*pieza)*1.125)*1.3)+pbordado)+pmodelo);
        

        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(0);
        tot=canti*precio_sin;
        document.form.cos_total.value=tot.toFixed(0);
        } 
       
      }
      if(tela=="12"){

        var precio_sin=Math.ceil((precio*1.12)*1.15);
        

        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(0);
        tot=canti*precio_sin;
        document.form.cos_total.value=tot.toFixed(0);
      }
      
    }

    function f_cambio(dato,contador){
      var arreglo="cant_"+contador;
      document.getElementById(arreglo).value=dato;
    }
    function f_precio_bor(){
      var sin=parseFloat(document.form.cos_sin_iva.value);
      var pre=parseInt(document.form.pre_bor.value);
      var pre_aux=parseInt(document.form.aux_bor.value);
      if(pre_aux>=0){
        //ACOMODAR
      pre_aux=pre-pre_aux;
      document.form.aux_bor.value=pre_aux;
      if(pre_aux>0){
        var canti=document.form.can_pro.value;
      
      sin=sin+pre;
      //document.form.cos_iva.value=con.toFixed(2);
      document.form.cos_sin_iva.value=sin.toFixed(2);
      document.form.cos_total.value=(canti*sin).toFixed(2);
       }
       }if(pre_aux<0){
        
        pre_aux=pre-pre_aux;
        document.form.aux_bor.value=pre_aux;
        var canti=document.form.can_pro.value;
        sin=(sin+pre);
        
        //document.form.cos_iva.value=con.toFixed(2);
        document.form.cos_sin_iva.value=sin.toFixed(2);
        document.form.cos_total.value=(canti*sin).toFixed(2);

       }
    }
    function f_talla(){
      var pcuello=parseInt(document.form.precio_cuello.value);
      var pbordado=parseInt(document.form.precio_bordado.value);
      var canti=document.form.can_pro.value;
      var ptela=document.form.precio_tela.value;
      var pmodelo=document.form.precio_modelo.value;
      pmodelo=parseInt(pmodelo);
      var tela=document.form.tela.value;

      if (talla=="S"||talla=="M"||talla=="L"||talla=="XL"){
        if(tela=="6"){
        var precio_sin=Math.ceil((((((ptela/3)+pcuello)*1.125)*1.3)+pbordado)+pmodelo);
        
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(2);
        document.form.cos_total.value=(canti*precio_sin).toFixed(2);
      }
      if(tela=="1" || tela=="2" || tela=="3" || tela=="4" || tela=="5" || tela=="9"){
        var precio_sin=Math.ceil(((((ptela*1.5)*1.125)*1.3)+ pbordado)+pmodelo);
        
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(2);
        document.form.cos_total.value=(canti*precio_sin).toFixed(2);
      }
      if(tela=="7"){
        var precio_sin=Math.ceil(((((ptela/4)*1.125)*1.3)+pbordado)+pmodelo);
        
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(2);
        document.form.cos_total.value=(canti*precio_sin).toFixed(2);
      }
        }

      
      if(talla=="XL" || talla=="2XL" || talla=="3XL" || talla=="4XL"){
        if(tela=="7"){
        var precio_sin=Math.ceil(((((((ptela/3)+pcuello)*1.125)*1.3)+pbordado)+pmodelo)*1.5);
        
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(2);
        document.form.cos_total.value=(canti*precio_sin).toFixed(2);
      }
      if(tela=="1" || tela=="2" || tela=="3" || tela=="4" || tela=="5" || tela=="9"){
        var precio_sin=Math.ceil(((((ptela*2)*1.125)*1.3)+ pbordado)+pmodelo);
        
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(2);
        document.form.cos_total.value=(canti*precio_sin).toFixed(2);
      }
      if(tela=="6"){
        var precio_sin=Math.ceil(((((ptela/2)*1.125)*1.3)+pbordado)+pmodelo);
        
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(2);
        document.form.cos_total.value=(canti*precio_sin).toFixed(2);
      }
      }
      if(talla=="2" || talla=="4" || talla=="6"){
      if(tela=="1" || tela=="2" || tela=="3" || tela=="4" || tela=="5" || tela=="9"){
        var precio_sin=Math.ceil(((((ptela*0.8)*1.125)*1.3)+ pbordado)+pmodelo);
        
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(2);
        document.form.cos_total.value=(canti*precio_sin).toFixed(2);
      }
      if(tela=="6" ){
        var precio_sin=Math.ceil((((((ptela/6)+pcuello)*1.125)*1.3)+pbordado)+pmodelo);
        
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(2);
        document.form.cos_total.value=(canti*precio_sin).toFixed(2);
      }
      if(tela=="7"){
        var precio_sin=Math.ceil(((((ptela/6)*1.125)*1.3)+pbordado)+pmodelo);
        
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(2);
        document.form.cos_total.value=(canti*precio_sin).toFixed(2);
      }
      }
      if(talla=="8" || talla=="10"){
      if(tela=="1" || tela=="2" || tela=="3" || tela=="4" || tela=="5" || tela=="9"){
        var precio_sin=Math.ceil(((((ptela*1)*1.125)*1.3)+pbordado)+pmodelo);
      
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(2);
        document.form.cos_total.value=(canti*precio_sin).toFixed(2);
      }
      if(tela=="6"){
        var precio_sin=Math.ceil((((((ptela/5)+pcuello)*1.125)*1.3)+pbordado)+pmodelo);
        
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(2);
        document.form.cos_total.value=(canti*precio_sin).toFixed(2);
      }
      if(tela=="7"){
        var precio_sin=Math.ceil(((((ptela/5)*1.125)*1.3)+pbordado)+pmodelo);
        
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(2);
        document.form.cos_total.value=(canti*precio_sin).toFixed(2);
      }
       }
      if(talla=="12" || talla=="15" || talla=="16"){
      if(tela=="1" || tela=="2" || tela=="3" || tela=="4" || tela=="5" || tela=="9"){
        var precio_sin=Math.ceil(((((ptela*1.2)*1.125)*1.3)+ pbordado)+pmodelo);
        
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(2);
        document.form.cos_total.value=(canti*precio_sin).toFixed(2);
      }
      if(tela=="7"){
        var precio_sin=Math.ceil(((((ptela/4)*1.125)*1.3)+pbordado)+pmodelo);
       
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(2);
        document.form.cos_total.value=(canti*precio_sin).toFixed(2);
      }
      if(tela=="6"){
        var precio_sin=Math.ceil((((((ptela/4)+pcuello)*1.125)*1.3)+pbordado)+pmodelo);
        
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.form.cos_sin_iva.value=precio_sin.toFixed(2);
        document.form.cos_total.value=(canti*precio_sin).toFixed(2);
      }
      }
    }

//________agregar productos al detalle (tr)
          // variables para ser usadas en el detalle y el total de la factura 
          var i = "<?php echo $cont; ?>" ;

          var total_factura=0;
          var cont=0;
          var sub_tot=0;
          var monto=0;
          function agregar(){
            //se obtiene los valores del producto despues de buscarlos
            var cantidad_pro = $("#can_pro").val();
            var codigo_pro = $("#cod_pro").val();
            var nombre_pro = $("#nom_pro").val();

            var bordado_pro = $("#bordados").val();
            var precio_bordado_pro = $("#pre_bor").val();
            
            var sin_iva_pro = $("#cos_sin_iva").val();
            var total_pro = $("#cos_total").val();
            //var sub_tot = $("#sub_total").val();
          
            


            //se inserta la tabla con los nuevos valores

            var td1='<td hidden><input type="hidden" class="form-control" name="codigos_pro[]"    readonly value="'+codigo_pro+'"></td>';
            var td2='<td style="width: 4.5%;"><input  type="text" class="form-control" name="cantidades_pro[]" onclick="f_cambio(this.value)" readonly value="'+cantidad_pro+'" title="Cantidad de piezas"></td>';
            var td3='<td style="width: 41.4%;"><input type="text" class="form-control" name="nombres_pro[]" readonly value="'+nombre_pro+'" title="Nombre del Producto"></td>'
            var td4='<td style="width: 8.4%;"><input type="text"  class="form-control" name="bordado_pros[]"    readonly value="'+bordado_pro+'" title="Precio de los bordos"></td>';
            var td5='<td style="width: 8.4%;"><input type="text"  class="form-control" name="precios_bordado_pro[]"    readonly value="'+precio_bordado_pro+'" title="Precio de los bordos"></td>';
            
            var td6='<td style="width: 10.5%;"><input type="text"  class="form-control" name="sin_iva_pros[]" readonly id="sin_iva_pro"    value="'+sin_iva_pro+'" title="Precio sin IVA"></td>';
            var td7='<td style="width: 14.1%;"><input type="text" class="form-control" name="total_pros[]" readonly id="total_pro"    value="'+total_pro+'" title="Total"></td>';
            var td8='<td style="width: 3.5%;"><input type="button"  class="btn btn-danger" value="X" onclick="borrar('+i+')"> </td>';

            $("#detalle tr:last").after('<tr id=tr_'+i+'>'+td1+td2+td3+td4+td5+td6+td7+td8+'</tr>');
          
          i++;
          //se usa toFixed(); para mostrar decimales
          total_pro =  parseFloat(total_pro);

          sub_tot =  parseFloat(sub_tot);

          //se le asigna el total a la factura
          sub_tot=sub_tot+total_pro;
          monto=sub_tot*0.12;
          total_factura=((sub_tot+monto).toFixed(2));
          $("#iva").val(12);

         
          if(sub_tot>=2000000){
            $("#iva").val(7);
            monto=sub_tot*0.07;
          total_factura=((sub_tot+monto).toFixed(2));

          } //se usa toFixed(); para mostrar decimales
          $("#total_presu").val(total_factura);
          $("#sub_total").val(sub_tot.toFixed(2));
          

          $("#monto_iva").val(monto.toFixed(2));
          //borramos los values del producto buscado
          $("#cod_pro,#nom_pro,#pre_bor,#bordados,#can_pro,#cos_sin_iva,#cos_total").val("");
          document.form.nom_pro.disabled=false;
          document.form.bordados.disabled=true;
          document.form.pre_bor.disabled=true;
        }
        function borrar(num){
        //se obtiene los valores del producto

        var tot_producto = $("#tr_"+num+" td #total_pro ").val();
        var tot_factura  = $("#total_presu").val();
        var tot_iva = $("#monto_iva").val();
        var tot_sub = $("#sub_total").val(); 
        var iva=$("#iva").val();
        tot_factura=parseFloat(tot_factura);
        //se le resta el producto a borrar al total de la factura
          if(iva==12){
          total=(tot_producto*1.12).toFixed(2);
          mon=total-tot_producto;
          mon=tot_iva-mon;
          tot_sub=tot_sub-tot_producto;
          tot_factura=tot_factura-total;

          sub_tot=tot_sub;
          monto=tot_iva;
          } 
          if(iva==7){
          total=(tot_producto*1.07).toFixed(2);
          
          mon=total-tot_producto;
          mon=Math.abs(tot_iva-mon);
          tot_sub=tot_sub-tot_producto;
          tot_factura=tot_factura-total;

          sub_tot=tot_sub;
          monto=tot_iva;
          }
          if(iva==9){
          total=(tot_producto*1.09).toFixed(2);

          mon=total-tot_producto;
          mon=tot_iva-mon;
          tot_sub=tot_sub-tot_producto;
          tot_factura=tot_factura-total;

          sub_tot=tot_sub;
          monto=tot_iva;
          }
          //se usa toFixed(); para mostrar decimales
          $("#total_presu").val(tot_factura.toFixed(2));
          $("#monto_iva").val(mon.toFixed(2));
          $("#sub_total").val(tot_sub.toFixed(2));

        //se borra el tr segun el id seleccionado
        $("#tr_"+num).remove();
        }
        function f_abono(){
          var abo = $("#abono").val();
          var tot = $("#total_presu").val();
          var resta= tot-abo;
          $("#restante").val(resta.toFixed(2));

        }
function f_act_pre_bor(){
  document.form.pre_bor.disabled=false;
}
function f_actualizar(){
var fecha="<?php echo $fechahoy;?>";
var fecha1="<?php echo date('Y-m-d', strtotime("$fechahoy + 1 day"));?>";
document.form.fecha_presu.value=fecha;
document.form.fecha_ven.value=fecha1;
id=0;
while(id<i){ 
    id++;
    f_calc(id);
}
 }
function f_calc(id){ 

    var arreglo="can_"+id;
    var arreglo2="sin_"+id;
    var arreglo3="tot_"+id;

    var arreglo5="id_"+id;
    var mon=0.00;
    var tot_presu=0.00;
    var cod=document.getElementById(arreglo5).value;
      //-------------------------------
      var todo={"productos":cod};
      console.log(todo);
      $.post('../controlador/conProducto.php', {buscaproducto: todo}, function(data) {
        
        var datos=data.split("|");
        
        if(datos[1]=="sip"){

            var total=(parseFloat(document.getElementById(arreglo3).value).toFixed(2));
            var can=parseFloat(document.getElementById(arreglo).value);
            var iva_val=parseFloat(document.form.iva.value);
            var sin=parseFloat(document.getElementById(arreglo2).value);


            
            

            
      //inicio calculo precio________________________________________
          var pbordado=parseInt(document.form.precio_bordado.value);
      var pcuello=parseInt(document.form.precio_cuello.value);
      pmodelo=parseInt(pmodelo);
      var tela=parseFloat(datos[5]);
      var precio=parseFloat(datos[11]);
      var pieza=parseFloat(datos[9]);
      var pmodelo=parseFloat(datos[7]);
      var operador=datos[10];
      var talla=parseFloat(datos[13]);
      //alert("tela"+tela+"precio"+precio+"pieza"+pieza+"modelo"+pmodelo+"operador"+operador+"talla"+talla);
      if(operador=="/"){

        if(tela=="6"){
        var precio_sin=Math.ceil((((((precio/pieza)+pcuello)*1.125)*1.3)+pbordado)+pmodelo);
        
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.getElementById(arreglo2).value=parseFloat(precio_sin.toFixed(0));
        tot=can*precio_sin;
        document.getElementById(arreglo3).value=parseFloat(tot.toFixed(0));
        var sub=parseFloat(document.form.sub_total.value);
        sub=sub-total;
 
        sub=sub+tot;
        mon=sub*(iva_val/100);
        tot_presu=sub+mon;

        document.form.sub_total.value=sub.toFixed(2);
        document.form.monto_iva.value=mon.toFixed(2);
        document.form.total_presu.value=tot_presu.toFixed(2);
         } 
      if(tela=="7"){
        var precio_sin=Math.ceil(((((precio/pieza)*1.125)*1.3)+pbordado)+pmodelo);

        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.getElementById(arreglo2).value=parseFloat(precio_sin.toFixed(0));
        tot=can*precio_sin;
        document.getElementById(arreglo).value=parseFloat(tot.toFixed(0));
         }

        if(talla=="1"||talla=="2"||talla=="4"||talla=="6"){
           if(tela=="6"){
        //tela 6==PIQUE
        //TELA 7==JERSEY
        var precio_sin=Math.ceil((((((precio/6)+pcuello)*1.125)*1.3)+pbordado)+pmodelo);

        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.getElementById(arreglo2).value=parseFloat(precio_sin.toFixed(0));
        tot=can*precio_sin;
        document.getElementById(arreglo).value=parseFloat(tot.toFixed(0));
         }
         if(tela=="7"){
        var precio_sin=Math.ceil(((((precio/6)*1.125)*1.3)+pbordado)+pmodelo);

        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.getElementById(arreglo2).value=parseFloat(precio_sin.toFixed(0));
        tot=can*precio_sin;
        document.getElementById(arreglo).value=parseFloat(tot.toFixed(0));
         }
        }
        if(talla=="8"||talla=="10"){
           if(tela=="6"){
        //tela 6==PIQUE
        //TELA 7==JERSEY
        var precio_sin=Math.ceil((((((precio/5)+pcuello)*1.125)*1.3)+pbordado)+pmodelo);

        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.getElementById(arreglo2).value=parseFloat(precio_sin.toFixed(0));
        tot=can*precio_sin;
        document.getElementById(arreglo).value=parseFloat(tot.toFixed(0));
         }
         if(tela=="7"){
        var precio_sin=Math.ceil(((((precio/5)*1.125)*1.3)+pbordado)+pmodelo);

        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.getElementById(arreglo2).value=parseFloat(precio_sin.toFixed(0));
        tot=can*precio_sin;
        document.getElementById(arreglo).value=parseFloat(tot.toFixed(0));
         }
        
      }if(talla=="12"||talla=="14"||talla=="16"){
           if(tela=="6"){
        //tela 6==PIQUE
        //TELA 7==JERSEY
        var precio_sin=Math.ceil((((((precio/4)+pcuello)*1.125)*1.3)+pbordado)+pmodelo);

        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.getElementById(arreglo2).value=parseFloat(precio_sin.toFixed(0));
        tot=can*precio_sin;
        document.getElementById(arreglo).value=parseFloat(tot.toFixed(0));
         }
         if(tela=="7"){
        var precio_sin=Math.ceil(((((precio/4)*1.125)*1.3)+pbordado)+pmodelo);
        //document.form.cos_iva.value=precio_con.toFixed(2);
        document.getElementById(arreglo2).value=parseFloat(precio_sin.toFixed(0));
        tot=can*precio_sin;
        document.getElementById(arreglo).value=parseFloat(tot.toFixed(0));
         }
        } 
      }
      if(operador=="X"){
        var precio_sin=Math.ceil(((((ptela*pieza)*1.125)*1.3)+pbordado)+pmodelo);
                //document.form.cos_iva.value=precio_con.toFixed(2);
        document.getElementById(arreglo2).value=parseFloat(precio_sin.toFixed(0));
        tot=can*precio_sin;
        document.getElementById(arreglo).value=parseFloat(tot.toFixed(0));
      }//fin de calculo precio______________

        }//fin si


        console.log(datos);
      });

      //--------------------------------
      
     
    }
/*________Calcular el Peso Neto
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
        */

    </script>
</body>
</html>
<?php

    }else {

    header("Location:../index.php");
    }

?>