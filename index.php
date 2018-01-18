<?php
error_reporting( error_reporting() & ~E_NOTICE );
include_once("controlador/conLogin.php");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
     
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="default/imagenes/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Bienvenidos</title>

    <!-- Bootstrap -->
    <link href="default/css/bootstrap.min.css" rel="stylesheet">
    <link href="default/css/miestilo.css" rel="stylesheet">

</head>
<body>

		<!-- contenido login -->
<div class="row" style="width: 100%;margin-left: 0px;margin-right: 0px;">
	<div class="col-xs-12" style=" background: rgb(18, 28, 102) none repeat scroll 0% 0%; border-bottom: 7px solid rgb(0, 112, 185);">
		<h4 align="center" style="color:#fff;">Manufacturas R.J. Atlantico, C.A.</h4>
	</div>
</div>

		<div class="row" style="margin-top: 5%;margin-left: 0px;margin-right: 0px;">

			<div class="col-xs-12 col-sm-4 col-sm-offset-4" >

		        <div class="panel panel-default">
	                <div class="panel-heading">
	                	<img id="formulario-img" src="imagenes/LOGO.jpg" style="width: 100%;"/>
	                	
	                </div>
	                <div class="panel-body">
	                    <form name="form" action="" method="POST" class="form-horizontal" role="form">
	                        <div class="form-group">
	                            <label class="col-sm-4 control-label">Usuario</label>
	                            <div class="col-sm-8">
	                            	<div class="input-group">
		                            	<span class="input-group-addon "><i class="glyphicon glyphicon-user"></i></span>
		                                <input type="text" autocomplete="off"  name="usuario" title="ingrese el nombre de usuario" class="form-control" placeholder="Usuario" required="">
		                            </div>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <label class="col-sm-4 control-label">Contraseña</label>
	                            <div class="col-sm-8">
	                            	<div class="input-group">
		                            	<span class="input-group-addon "><i class="glyphicon glyphicon-lock"></i></span>
	                                	<input type="password" name="pass" title="ingrese su contraseña" class="form-control" placeholder="Contraseña" required="">
	                            	</div>
	                            </div>
	                        </div>

	                        <div class="form-group last">
	                            <div class="col-sm-offset-4 col-sm-8">
	                                <input type="submit" name="btnLogeo" value="Entrar" class="btn btn-success btn-sm">
	                                <button type="reset" class="btn btn-default btn-sm">limpiar</button>
	                            </div>
	                        </div>
	                    </form>
	                </div>
	                <div class="panel-footer"><a href="vista/visOlvidoContrasena.php" class="">¿Olvido su Contraseña?</a>
	                </div>
	            </div>

			</div>
		</div>


<!-- pie de pagina -->
<?php
include('default/footer.php');
?>

<!--para recibir el mensaje -->
<?php 
if(isset($msj)){
if($msj) { ?> <script > alert("<?php  print($msj); ?>"); </script> <?php  } 
}
?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins)  -->
    <script src="default/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="default/js/bootstrap.min.js"></script>
</body>
</html>
