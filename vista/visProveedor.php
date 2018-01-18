<?php
error_reporting( error_reporting() & ~E_NOTICE );
include_once("../controlador/conProveedor.php");
session_start();
if(isset($_SESSION["nombre"])) {
/*



include_once("../modelo/clsProveedor.php");
	$id= new clsProveedor();
	$id->id();
   	$ids= $id->row();
include_once("../modelo/clsTipoProveedor.php");
  $tipo= new clsTipoProveedor();
  $tipo->listar();
include_once("../modelo/clsUnidadMetrica.php");
  $unidad= new clsUnidadMetrica();
  $unidad->listar();

*/

?>
<style type="text/css">


#divnombre{ 
    width: 94%;
    margin: 0px 2px 0px;
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

}</style>
<script>// busqueda ajax

    function busqueda(){
 
$('#divnombre').show();
    var n=document.getElementById('buscador').value;

    if(n==''){

     document.getElementById("divnombre").innerHTML="";
     document.getElementById("divnombre").style.border="0px";



     return;
    }

    loadDoc("q="+n,"BusProv.php",function(){

      if (xmlhttp.readyState==4 && xmlhttp.status==200){

        document.getElementById("divnombre").innerHTML=xmlhttp.responseText;
        document.getElementById("divnombre").style.border="1px solid #A5ACB2";

        }else{ document.getElementById("divnombre").innerHTML='<img src="../default/imagenes/load.gif" width="50" height="50" />'; }

      });
    }

// seleccion de la busqueda

function busqueda2(cod){

var todo={"proveedor":cod};
      console.log(todo);
      $.post('../controlador/conProveedor.php', {validaproveedor: todo}, function(data) {
        
        var datos=data.split("|");

        if(datos[1]=="si"){
          document.form.nombre.value=datos[2];
          document.form.rif.value=datos[6];
          document.form.persona.value=datos[7];
          document.form.telefono.value=datos[3];
          document.form.correo.value=datos[5];
          document.form.direccion.value=datos[4];
          document.form.codigo.value=datos[8];
          document.form.btnGuardar.disabled=true;
          document.form.btnModificar.disabled=false;
          //document.form.duracion.focus();
          document.getElementById("divnombre").style.border="0px";
          $('.sugerencias').hide();

        }
        if(datos[1]=="no"){
          alertify.alert("No existe ese Docente");
        }
        console.log(datos);
      });

}
function cerrar(){
  $('#close').hide();
  document.getElementById("divnombre").style.border="0px";
}
</script>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="../default/imagenes/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <script type="text/javascript" src="../default/js/ajax.js"></script>
    <title>Proveedores</title>

    <!-- Bootstrap -->
    <link href="../default/css/bootstrap.min.css" rel="stylesheet">
    <link href="../default/css/miestilo.css" rel="stylesheet">
    <link href="../css/estilo.css" rel="stylesheet">

</head>
<body>

    <!-- cabecera de la imagen patria y menu -->
<?php
include('../default/header.php');
?>
<br>

<!-- formulario -->
	<div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 ">
			<div class="panel panel-default">
	                <div class="panel-heading">
	                	<img id="formulario-img" src="../default/imagenes/formulario.png" />
	                	<strong >Proveedores</strong>
	                </div>
	                <div class="panel-body">
	                	<form name="form" action="" method="POST" class="form-horizontal" role="form">

			                
		                    <div class="form-group">
		                        <label class="col-sm-3  control-label">Buscador:</label>
		                        <div class="col-sm-6" >
		                        <!--<div class="input-group" >-->
		                            	<input type="text" class="form-control" autocomplete="off" id="buscador" onkeyup="busqueda()" onblur="this.value=this.value.toUpperCase()"name="buscador"value="">
                                  <div id="divnombre"></div>
                                  <input type="hidden" class="form-control" autocomplete="off" name="codigo" value="<?php echo $arreglo_buscar["cod_prov"];?>">
		                           		<!-- boton buscar
																	<span class="input-group-btn">
		                           			<span class="glyphicon glyphicon-user " ></span>
		                            	    <input type="submit" class="btn btn-default"  name="btnBuscar" value=" Buscar ">
		                            	</span>
		                        	</div>-->
		                        </div>
                          </div>  
                          <div class="form-group">
			                    <label class="col-sm-3  control-label"> C.I./RIF:</label>
                          <div class="col-sm-3" >
                              <input type="text" class="form-control" autocomplete="off" onblur="this.value=this.value.toUpperCase()"name="rif" id="rif" value="<?php echo $arreglo_buscar["rif_prov"]?>">
                          </div>
                           <label class="col-sm-1  control-label"> Telefono:</label>
                          <div class="col-sm-2" >
                              <input type="text" class="form-control" autocomplete="off" name="telefono" value="<?php echo $arreglo_buscar["tlfn_prov"]?>">
                          </div>
			                </div>

											<div class="form-group">
                      <label class="col-sm-3  control-label">* Razon Social:</label>
                          <div class="col-sm-6" >
                              <input type="text" class="form-control" autocomplete="off"  onblur="this.value=this.value.toUpperCase()" name="nombre" value="<?php echo $arreglo_buscar["nom_prov"];?>">
                          </div>
                      </div>
                        <div class="form-group">  

                          <label class="col-sm-3  control-label">* Persona autorizada:</label>
                          <div class="col-sm-6" >
                              <input type="text" class="form-control" autocomplete="off"  onblur="this.value=this.value.toUpperCase()" name="persona" value="<?php echo $arreglo_buscar["pers_prov"];?>">
                          </div>
    			            </div>
                      <div class="form-group">
                          <label class="col-sm-3  control-label">* Direccion:</label>
                          <div class="col-sm-6" >
                              <input type="text" class="form-control" autocomplete="off"  onblur="this.value=this.value.toUpperCase()" name="direccion" value="<?php echo $arreglo_buscar["dir_prov"]?>">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-3  control-label"> Correo:</label>
                          <div class="col-sm-6" >
                              <input type="text" class="form-control" autocomplete="off"  onblur="this.value=this.value.toUpperCase()" name="correo" value="<?php echo $arreglo_buscar["correo_prov"];?>">
                          </div>
    			            </div>
                      <h6 class="col-sm-offset-4">Nota: Los Campos Marcados con (*) son Obligatorios.</h6>
		                    <hr>
		                        <div class="col-sm-12">
		                            <input type="submit" class="btn btn-default col-sm-offset-4" name="btnGuardar"  value="Guardar">
		                            <input type="submit" class="btn btn-default" disabled name="btnModificar"  value="Modificar">
		                            <input type="submit" class="btn btn-default" name="btnCancelar"  value="Cancelar">
		                            <input type="submit" class="btn btn-default" name="btnSuspender"  value="Suspender">
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins)  -->
    <script src="../default/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../default/js/bootstrap.min.js"></script>
</body>
</html>
<script type="text/javascript">

   $(document).on("click", function(event){
        var $trigger = $(".divnombre");
        if($trigger !== event.target && !$trigger.has(event.target).length){
            $(".sugerencias").hide();
            $("#close").hide();
            document.getElementById("divnombre").style.border="0px";

        }            
    });
</script>

<?php

    }else {

    header("Location:../index.php");
    }

?>
