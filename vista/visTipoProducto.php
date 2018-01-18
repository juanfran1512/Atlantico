<?php
error_reporting( error_reporting() & ~E_NOTICE );
include_once("../controlador/conTipoProducto.php");
session_start();
if(isset($_SESSION["nombre"])) {
/*



include_once("../modelo/clsProducto.php");
	$id= new clsProducto();
	$id->id();
   	$ids= $id->row();
include_once("../modelo/clsTipoProducto.php");
  $tipo= new clsTipoProducto();
  $tipo->listar();
include_once("../modelo/clsUnidadMetrica.php");
  $unidad= new clsUnidadMetrica();
  $unidad->listar();

*/
?><style type="text/css">


#divnombre{ 
    width: 100%;
    margin: 33px 0px 3px;
 z-index: 1;
 position: absolute;
 background: white;
 -webkit-border-radius: 0px 0px 4px 4px;
 -moz-border-radius: 0px 0px 4px 4px;       
}         
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
    var n=document.getElementById('nombre').value;

    if(n==''){

     document.getElementById("divnombre").innerHTML="";
     document.getElementById("divnombre").style.border="0px";



     return;
    }

    loadDoc("q="+n,"BusTipo.php",function(){

      if (xmlhttp.readyState==4 && xmlhttp.status==200){

        document.getElementById("divnombre").innerHTML=xmlhttp.responseText;
        document.getElementById("divnombre").style.border="1px solid #A5ACB2";

        }else{ document.getElementById("divnombre").innerHTML='<img src="../default/imagenes/load.gif" width="50" height="50" />'; }

      });
    }

// seleccion de la busqueda

function busqueda2(cod){
var todo={"tipo":cod};
      console.log(todo);
      $.post('../controlador/conTipoProducto.php', {validatipo: todo}, function(data) {
        
        var datos=data.split("|");

        if(datos[1]=="si"){
          document.form.nombre.value=datos[2];
          document.form.codigo.value=datos[3];
          document.form.btnGuardar.disabled=true;
          //document.form.duracion.focus();
          document.getElementById("divnombre").style.border="0px";
          $('.sugerencias').hide();

        }
        if(datos[1]=="no"){
          alert("No existe ese Tipo de Producto");
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
    <title>Tipos de Productos</title>
    <script type="text/javascript" src="../default/js/ajax.js"></script>
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
	                	<strong >Tipos de Productos</strong>
	                </div>
	                <div class="panel-body">
	                	<form name="form" action="" method="POST" class="form-horizontal" role="form">

			                
		                    <div class="form-group">
		                        <label class="col-sm-2  control-label">* Nombre:</label>
		                        <div class="col-sm-3" >
		                        	<div class="input-group" >
		                        	<input type="text" class="form-control"  autocomplete="off" id="nombre" onkeyup="busqueda()" onblur="this.value=this.value.toUpperCase()"name="nombre" value="<?php echo $arreglo_buscar["nom_mod"];?>">
		                        	<div id="divnombre"></div>
		                            	<input type="hidden" class="form-control" autocomplete="off" name="codigo" value="<?php echo $arreglo_buscar["cod_mod"];?>">
		                           		<!-- boton buscar-->
																	<span class="input-group-btn">
		                           			<span class="glyphicon glyphicon-user " ></span>
		                            	    <input type="submit" class="btn btn-default"  name="btnBuscar" value=" Buscar ">
		                            	</span>
		                            	
		                        	</div>
		                        </div>
                          </div>

			                <h6 class="col-sm-offset-4">Nota: Los Campos Marcados con (*) son Obligatorios.</h6>
		                    <hr>
		                        <div class="col-sm-12">
		                            <input type="submit" class="btn btn-default col-sm-offset-4" name="btnGuardar"  value="Guardar">
		                            <input type="submit" class="btn btn-default" name="btnModificar"  value="Modificar">
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

    


 /*$("#paquete").change(function(event){

 	var paquete=document.form.paquete.value;
 	if(paquete==1){
 		document.form.cant_x_paquete.disabled=false;
 	}
  });*/

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
