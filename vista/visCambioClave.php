<?php
error_reporting( error_reporting() & ~E_NOTICE );
include_once("../controlador/conCambioClave.php");
session_start();
if(isset($_SESSION['nombre'])) { 
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="../default/imagenes/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Cambiar Contraseña</title>

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
	                	<strong >Cambiar Contraseña</strong>
	                </div>
	                <div class="panel-body">
	                	<form name="form" action="" method="POST" class="form-horizontal" role="form">

		                   
		                    <div class="form-group" >
			                    <label class="col-sm-3 col-sm-offset-2 control-label">Contraseña:</label>
			                    <div class="col-sm-3" >		                        	
			                        <input type="password" autocomplete="off"class="form-control"  name="contrasena" value="">		                      	                        	
			                    </div>
			                </div>
			                <div class="form-group" >
			                    <label class="col-sm-3 col-sm-offset-2 control-label">Nueva Contraseña:</label>
			                    <div class="col-sm-3" >		                        	
			                        <input type="password" autocomplete="off"class="form-control" onblur="clave()"  name="nueva1" value="">		                      	                        	
			                    </div>
			                </div>
			                <div class="form-group" >
			                    <label class="col-sm-3 col-sm-offset-2 control-label">Repita su Contraseña:</label>
			                    <div class="col-sm-3" >		                        	
			                        <input type="password" autocomplete="off"class="form-control" onblur="confirmeclave()" name="pass" value="">		                      	                        	
			                    </div>
			                </div>
			                

			                    
			                
		                                           
		                    <hr>
		                        <div class="col-sm-12">
		                            <input type="submit" class="btn btn-default col-sm-offset-4" name="aceptarclave"  value="Aceptar">
		                            <input type="submit" class="btn btn-default" name="btnCancelarClave"  value="Cancelar">
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
<script >
  function clave(){

    var clave=/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;
    var loF = document.form;
    if(loF.nueva1.value.match(clave)){
      loF.pass.focus();
    } 
    else{
      loF.nueva1.value="";
      alert("Lea las Instrucciones a la hora de Ingresar la Clave")

    }
  }
  function confirmeclave(){
    var loF = document.form;
    if(loF.nueva1.value!=loF.pass.value){
      alert("Las Claves no Coinciden");
      loF.nueva1.value="";
      loF.pass.value="";
    }
  }
</script >
<?php 
    }else {
 
    header("Location: index.php");
    }
?>