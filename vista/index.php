<?php
session_start();
error_reporting( error_reporting() & ~E_NOTICE );
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
    <title>Bienvenidos</title>

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






<div class="row" data-anim-type="fade-in-up"style="width: 100%;margin-left: 0px;margin-right: 0px;">
	<div class="col-xs-12 col-sm-12"style="padding:0px">
		<img  src="../imagenes/AVISO 2.jpg" style="width: 100%;margin-bottom: 40px;" />
		
	</div>
</div>








<!-- pie de pagina -->
<?php
include('../default/footer.php'); 
?>

			
<!--para recibir el mensaje -->
<?php if($msj) { ?> <script > alert("<?php  print(@$msj); ?>"); </script> <?php  } ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins)  -->
    <script src="../default/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../default/js/bootstrap.min.js"></script>
</body>
</html>
<?php 
    }else {
 
    header("Location:../index.php");
    }
?>