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
	                	<strong >Cambiar Contraseña y Preguntas de Seguridad</strong>
	                </div>
	                <div class="panel-body">
	                	<form name="form" action="" method="POST" class="form-horizontal" role="form">

		                   
		                    <div class="form-group" >
			                    <label class="col-sm-3 col-sm-offset-2 control-label">Contraseña:</label>
			                    <div class="col-sm-3" >		                        	
			                        <input type="password" onblur="clave()" autocomplete="off"class="form-control"  name="pass" value="">		                      	                        	
			                    </div>
			                </div>
			                <div class="form-group" >
			                    <label class="col-sm-3 col-sm-offset-2 control-label">Pregunta 1:</label>
			                    <div class="col-sm-3" >		                        	
			                       <select class="form-control" name="pregunta1">
			                       		<option value="-">Seleccione</option>
                    					<option value="1 ">¿En Que Ciudad del Extranjero Estudiaste?</option>
                    					<option value="2 ">¿Donde Pasaste tus Primeras Vacaciones?</option>
                    					<option value="3 ">¿Con Quien Fuiste al Baile de Fin de Curso</option>
                    					<option value="4 ">¿Donde Pasaste tu Luna de Miel?</option>
                    					<option value="5 ">¿Donde Conociste a tu Pareja?</option>
                    					<option value="6 ">¿Como se Llama tu Primo Mayor?</option>
                    					<option value="7 ">¿Cual es el Apodo de Tu Infancia?</option>
                   						<option value="8 ">¿Como se llama tu heroe favorito?</option>
                    					<option value="9 ">¿En que Ciudad Nacio tu Madre?</option>
                    					<option value="10">¿En que Ciudad Nacio tu Padre?</option>
                    					<option value="11">¿Como se Llama tu Tia Favorita?</option>
                    					<option value="12">¿Como se Llama tu Tio Favorito?</option>
                    
                    
			                       </select>		                      	                        	
			                    </div>
			                </div>
			                <div class="form-group" >
			                    <label class="col-sm-3 col-sm-offset-2 control-label">Respuesta 1:</label>
			                    <div class="col-sm-3" >		                        	
			                        <input type="password" autocomplete="off"class="form-control"  name="respuesta1" value="">		                      	                        	
			                    </div>
			                </div>
			                <div class="form-group" >
			                    <label class="col-sm-3 col-sm-offset-2 control-label">Pregunta 2:</label>
			                    <div class="col-sm-3" >		                        	
			                       <select class="form-control" name="pregunta2">
                    						<option value="-">Seleccione</option>
                    						<option value="1 ">¿Como se llama tu primer mejor amigo?</option>
                    						<option value="2 ">¿Cuál es tu grupo de musica favorito?</option>
                   							<option value="3 ">¿Cuál es tu canción favorita</option>
                    						<option value="4 ">¿Quien te dio el primer beso?</option>
                    						<option value="5 ">¿Quien fue tu primer amor de la infancia?</option>
                    						<option value="6 ">¿Como se llama tu libro favorito?</option>
                    						<option value="7 ">¿Cual es tu equipo de deporte favorito?</option>
                    						<option value="8 ">¿Cual es el apellido de tu profesor favorito?</option>
                    						<option value="9 ">¿Cual es tu comida favorita?</option>
                    						<option value="10">¿Cual es el apellido de tu primer jefe?</option>
                    						<option value="11">¿Como se llama el hospital donde naciste?</option>
                    						<option value="12">¿Cual es el nombre de la calle donde creciste?</option>
                   
      
			                       </select>		                      	                        	
			                    </div>
			                </div>
			                <div class="form-group" >
			                    <label class="col-sm-3 col-sm-offset-2 control-label">Respuesta 2:</label>
			                    <div class="col-sm-3" >		                        	
			                        <input type="password" autocomplete="off"class="form-control"  name="respuesta2" value="">		                      	                        	
			                    </div>
			                </div>

			                    
			                
		                                           
		                    <hr>
		                        <div class="col-sm-12">
		                            <input type="submit" class="btn btn-default col-sm-offset-4" name="aceptarprimer"  value="Aceptar">
		                            <input type="submit" class="btn btn-default" name="btnCancelarPrimer"  value="Cancelar">

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
    if(loF.contrasena.value.match(clave)){
    } 
    else{
      loF.contrasena.value="";
      alert("Lea las Instrucciones a la hora de Ingresar la Clave")
    }
  }
</script >
<?php 
    }else {
 
    header("Location: index.php");
    }
?>