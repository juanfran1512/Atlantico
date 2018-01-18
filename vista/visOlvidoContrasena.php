<?php
error_reporting( error_reporting() & ~E_NOTICE );
include_once("../controlador/conCambioClave.php");
include_once("../modelo/clsCambioClave.php");
$usuario= new clsCambioClave();

if($_POST['btnBuscar']){
 $cedula=$_POST['cedula'];
  if($usuario->traerpregunta($cedula)){
  $usua= $usuario->row();
  }else{
    $msj ="La Cedula no es correcta";

  }
}


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

<div class="row">
    <div class="col-xs-12" style="color: #fff;background: #010080;border-bottom: 7px solid rgb(0, 112, 185);">
        <h4 align="center">Sistema de usuarios</h4>
    </div>
		<h4 align="center">Sistema de usuarios</h4>
	</div>
</div>

<!-- formulario -->
	<div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 ">
			<div class="panel panel-default">
	                <div class="panel-heading">
	                	<img id="formulario-img" src="../default/imagenes/formulario.png" />
	                	<strong >Cambiar Preguntas de Seguridad</strong>
	                </div>
	                <div class="panel-body">
	                	<form name="form" action="" method="POST" class="form-horizontal" role="form">


		                    <div class="form-group" >
                          <label class="col-md-3 col-md-offset-1 col-sm-4  control-label">Escriba su Cedula:</label>
                          <div class="col-md-3 col-sm-5" >
                            <div class="input-group" >
                                <input type="text" class="form-control" autocomplete="off" name="cedula" value="<?php echo ($cedula) ?>">
                                <span class="input-group-btn">
                                  <span class="glyphicon glyphicon-user " ></span>
                                    <input type="submit" class="btn btn-default"  name="btnBuscar" value=" Buscar ">


                                </span>
                            </div>
                          </div>
			                </div>
			                <div class="form-group" >
			                    <label class="col-md-2 col-md-offset-2 col-sm-4 control-label">Pregunta 1:</label>
			                    <div class="col-sm-5" >
			                       <select class="form-control" name="pregunta1">
			                       		<option value="-">Seleccione</option>
                    					<option value="1"<?php if($usua['pregunta1']=='1'){echo 'selected';} ?>>¿En Que Ciudad del Extranjero Estudiaste?</option>
                    					<option value="2"<?php if($usua['pregunta1']=='2'){echo 'selected';} ?>>¿Donde Pasaste tus Primeras Vacaciones?</option>
                    					<option value="3"<?php if($usua['pregunta1']=='3'){echo 'selected';} ?>>¿Con Quien Fuiste al Baile de Fin de Curso</option>
                    					<option value="4"<?php if($usua['pregunta1']=='4'){echo 'selected';} ?>>¿Donde Pasaste tu Luna de Miel?</option>
                    					<option value="5"<?php if($usua['pregunta1']=='5'){echo 'selected';} ?>>¿Donde Conociste a tu Pareja?</option>
                    					<option value="6"<?php if($usua['pregunta1']=='6'){echo 'selected';} ?>>¿Como se Llama tu Primo Mayor?</option>
                    					<option value="7"<?php if($usua['pregunta1']=='7'){echo 'selected';} ?>>¿Cual es el Apodo de Tu Infancia?</option>
                   						<option value="8"<?php if($usua['pregunta1']=='8'){echo 'selected';} ?>>¿Como se llama tu heroe favorito?</option>
                    					<option value="9"<?php if($usua['pregunta1']=='9'){echo 'selected';} ?>>¿En que Ciudad Nacio tu Madre?</option>
                    					<option value="10"<?php if($usua['pregunta1']=='10'){echo 'selected';} ?>>¿En que Ciudad Nacio tu Padre?</option>
                    					<option value="11"<?php if($usua['pregunta1']=='11'){echo 'selected';} ?>>¿Como se Llama tu Tia Favorita?</option>
                    					<option value="12"<?php if($usua['pregunta1']=='12'){echo 'selected';} ?>>¿Como se Llama tu Tio Favorito?</option>


			                       </select>
			                    </div>
			                </div>
			                <div class="form-group" >
			                    <label class="col-md-2 col-md-offset-2 col-sm-4 control-label">Respuesta 1:</label>
			                    <div class="col-sm-5" >
			                        <input type="password" autocomplete="off"class="form-control"  name="respuesta1" value="">
			                    </div>
			                </div>
			                <div class="form-group" >
			                    <label class="col-md-2 col-md-offset-2 col-sm-4 control-label">Pregunta 2:</label>
			                    <div class="col-sm-5" >
			                       <select class="form-control" name="pregunta1">
                    						<option value="-">Seleccione</option>
                    						<option value="1"<?php if($usua['pregunta2']=='1'){echo 'selected';} ?>>¿Como se llama tu primer mejor amigo?</option>
                    						<option value="2"<?php if($usua['pregunta2']=='2'){echo 'selected';} ?>>¿Cuál es tu grupo de musica favorito?</option>
                   							<option value="3"<?php if($usua['pregunta2']=='3'){echo 'selected';} ?>>¿Cuál es tu canción favorita</option>
                    						<option value="4"<?php if($usua['pregunta2']=='4'){echo 'selected';} ?>>¿Quien te dio el primer beso?</option>
                    						<option value="5"<?php if($usua['pregunta2']=='5'){echo 'selected';} ?>>¿Quien fue tu primer amor de la infancia?</option>
                    						<option value="6"<?php if($usua['pregunta2']=='6'){echo 'selected';} ?>>¿Como se llama tu libro favorito?</option>
                    						<option value="7"<?php if($usua['pregunta2']=='7'){echo 'selected';} ?>>¿Cual es tu equipo de deporte favorito?</option>
                    						<option value="8"<?php if($usua['pregunta2']=='8'){echo 'selected';} ?>>¿Cual es el apellido de tu profesor favorito?</option>
                    						<option value="9"<?php if($usua['pregunta2']=='9'){echo 'selected';} ?>>¿Cual es tu comida favorita?</option>
                    						<option value="10"<?php if($usua['pregunta2']=='10'){echo 'selected';} ?>>¿Cual es el apellido de tu primer jefe?</option>
                    						<option value="11"<?php if($usua['pregunta2']=='11'){echo 'selected';} ?>>¿Como se llama el hospital donde naciste?</option>
                    						<option value="12"<?php if($usua['pregunta2']=='12'){echo 'selected';} ?>>¿Cual es el nombre de la calle donde creciste?</option>


			                       </select>
			                    </div>
			                </div>
			                <div class="form-group" >
			                    <label class="col-md-2 col-md-offset-2 col-sm-4 control-label">Respuesta 2:</label>
			                    <div class="col-sm-5" >
			                        <input type="password" autocomplete="off"class="form-control"  name="respuesta2" value="">
			                    </div>
			                </div>




		                    <hr>
		                        <div class="col-sm-12">
		                            <input type="submit" class="btn btn-default col-sm-offset-4" name="aceptaolvido"  value="Aceptar">
		                            <input type="submit" class="btn btn-default col-sm-offset-2" name="btnCancelarOlvido"  value="Cancelar">

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
