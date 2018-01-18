<?php
error_reporting( error_reporting() & ~E_NOTICE );
include_once("../controlador/conRegistroUsuario.php");
session_start();
if(isset($_SESSION['nombre'])&&isset($_SESSION['tipo'])==1) {
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="../default/imagenes/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Registro Usuarios</title>

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
	                	<strong >Registro Usuarios</strong>
	                </div>
	                <div class="panel-body">
	                	<form name="form" action="" method="POST" class="form-horizontal" role="form">

			                <h6 class="col-sm-offset-4">Nota: Los Campos Marcados con (*) son Obligatorios.</h6>
		                    <div class="form-group">
		                        <label class="col-sm-3 col-sm-offset-2 control-label">Cedula del Usuario:</label>
		                        <div class="col-sm-3" >
		                        	<div class="input-group" >
		                            	<input type="text" class="form-control"  name="cedula" value="<?php echo $arreglo_buscar["ced_usu"];?>">
		                           		<span class="input-group-btn">
		                           			<span class="glyphicon glyphicon-user " ></span>
		                            	    <input type="submit" class="btn btn-default"  name="btnBuscar" value=" Buscar ">


		                            	</span>
		                        	</div>
		                        </div>
		                    </div>
                        <div class="form-group" >
			                       <label class="col-sm-3 control-label">Nombre:</label>
			                        <div class="col-sm-3" >
			                             <input type="text" class="form-control"  name="nombre" value="">
			                        </div>
                              <label class="col-sm-2 control-label">Apellido:</label>
 			                        <div class="col-sm-3" >
 			                             <input type="text" class="form-control"  name="apellido" value="">
 			                        </div>
			                  </div>
		                    <div class="form-group" >
			                       <label class="col-sm-3 col-sm-offset-2 control-label">Contraseña:</label>
			                        <div class="col-sm-3" >
			                             <input type="text" class="form-control"  name="contrasena" value="">
			                        </div>
			                  </div>
			                <div class="form-group" >
			                    <label class="col-sm-3 col-sm-offset-2 control-label">Tipo de Usuario:</label>
			                    <div class="col-sm-3" >
			                       <select class="form-control" name="tipo">
			                       		<option value="-">Seleccione</option>
			                        	<option <?php if($arreglo_buscar["tip_usu"]=='1'){echo 'selected';} ?> value="1">Jefe</option>
			                            <option <?php if($arreglo_buscar["tip_usu"]=='2'){echo 'selected';} ?> value="2">Web Master</option>
			                            <option <?php if($arreglo_buscar["tip_usu"]=='3'){echo 'selected';} ?> value="3">Usuario Autorizado</option>
			                       </select>
			                    </div>
			                </div>

			                    <?php

             					    if($arreglo_buscar['est_usu']>0){

                				?>
                				<div class="form-group">
			                    	<label class="col-sm-3 col-sm-offset-2 control-label">Estado</label>
			                   			<div class="col-sm-3">
			                        		<select class="form-control" name="status">
			                            		<option <?php if($arreglo_buscar["est_usu"]=='0'){echo 'selected';} ?> value="0">Activo</option>
			                            		<option <?php if($arreglo_buscar["est_usu"]=='1'){echo 'selected';} ?> value="1">Inactivo</option>
			                        		</select>
			                    		</div>
			                    </div>
			                    <?php

               						 } //cierre del if
                				?>


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
<?php
    }else {

    header("Location: index.php");
    }
?>
