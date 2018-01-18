<?php
error_reporting( error_reporting() & ~E_NOTICE );
include_once("../controlador/conTela.php");
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
?>

<script>// busqueda ajax

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
    <title>Listado de Telas</title>
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
	                	<strong >Listado de las Telas</strong>
	                </div>
	                <div class="panel-body">
	                	<form name="form" action="" method="POST" class="form-horizontal" role="form">

			                
		                    
                       <div class="form-group">
                      
                      <label class="col-sm-2  control-label">Tipo</label>
                          <div class="col-sm-3" >
                              <div id="telaList"><select  class="form-control" id="tipo_tela" name="tipo_tela" onchange="cargarTipo()" title="Nombre del Tipo"  class="select_tipo" >
                                      <option  value="">Seleccione</option>
                      
                      </select>
                      </div>
                      </div>
			                 </div>
                       <div id="tabla">
                       <div class="form-group">
                       <div class="col-sm-10 col-sm-offset-1 table-responsive"> 
                       <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                          </tr>
                        </thead>
                        <tbody>
                        
                          
                          
                        </tbody>
                      </table>

                        
                       
                       </div></div>
		                    <hr>

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
    <script src="../js/js.js"></script>
</body>
</html>
<script type="text/javascript">
getTipoTela('1');
function cargarTipo(){
  var tipo=document.form.tipo_tela.value;
  
  loadDoc("q="+tipo,"BusTipo2.php",function(){

      if (xmlhttp.readyState==4 && xmlhttp.status==200){

        document.getElementById("tabla").innerHTML=xmlhttp.responseText;
        

        }else{ document.getElementById("tabla").innerHTML='<img src="../default/imagenes/load.gif" width="50" height="50" />'; }

      });
};


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
