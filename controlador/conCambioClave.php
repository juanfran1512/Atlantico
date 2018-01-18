<?php
session_start();
include_once("../modelo/clsCambioClave.php");
//--------------------------------------------------------------------
//       Controlador Cargo
//--------------------------------------------------------------------
$id=$_SESSION['cedula'];
$ced=$_POST['cedula'];
$pass = sha1(md5(strip_tags($_POST['pass'])));
$pregunta1=$_POST['pregunta1'];
$pregunta2=$_POST['pregunta2'];
$respuesta1=$_POST['respuesta1'];
$respuesta2=$_POST['respuesta2'];


	//se crea el Objeto Cargo de la clase Cargo
	$objCambioClave = new clsCambioClave();

	//y se envian los datos a la clase Cargo
	$objCambioClave->manejar_datos($id,$pass,$pregunta1,$pregunta2,$respuesta1,$respuesta2,$ced);


//--------------------------------------------------------------------
//       Funcion para Cambiar por Primera vez
//--------------------------------------------------------------------
	if($_POST['aceptarprimer']){

		if($objCambioClave->modificarprimero()){
			$mensaje = "El cambio a sido exitoso";
					echo "<script>";
					echo "if(confirm('$mensaje'));";
					echo "window.location = 'index.php';";
					echo "</script>";

		}else{
			$msj ="No  se pudo modificar";

		}
	}
//--------------------------------------------------------------------
//       Funcion para Olvide Contraseña
//--------------------------------------------------------------------
	if($_POST['aceptaolvido']){

		if($objCambioClave->olvidocontrasena()){
		$objCambioClave->correctas();
		echo "<script> window.location='visRestauraClave.php?id=$ced';  </script>";

		}else{
			$msj ="Las respuestas de seguridad no son correctas";

		}
	}
//--------------------------------------------------------------------
//       Funcion para Olvide Contraseña
//--------------------------------------------------------------------
	if($_POST['aceptarrestaura']){

		if($objCambioClave->restaurarclave()){

			$mensaje = "El cambio a sido exitoso";
					echo "<script>";
					echo "if(confirm('$mensaje'));";
					echo "window.location = '../index.php';";
					echo "</script>";

		}else{
			$msj ="Lo Sentimos hubo un error";

		}
	}

//--------------------------------------------------------------------
//       Funcion para Cambiar Clave
//--------------------------------------------------------------------
	if($_POST['aceptarclave']){
		if($objCambioClave->modificarclave()){
			$objCambioClave->buscar();
			$arreglo_buscar = $objCambioClave->row();
			$msj = "Modificado exitosamente";

		}else{
			$msj ="No  se pudo modificar";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Cambiar por Primera vez
//--------------------------------------------------------------------
	if($_POST['aceptarpreguntas']){
		if($objCambioClave->modificarpreguntas()){
			$objCambioClave->buscar();
			$arreglo_buscar = $objCambioClave->row();
			$msj = "Modificado exitosamente";

		}else{
			$msj ="No  se pudo modificar";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar Clave
//--------------------------------------------------------------------
	if($_POST['btnCancelarClave']){
	header("Location:visCambioClave.php");
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar Preguntas
//--------------------------------------------------------------------
	if($_POST['btnCancelarPreguntas']){
	header("Location:visCambioPreguntas.php");
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar Primera
//--------------------------------------------------------------------
	if($_POST['btnCancelarPrimer']){
	header("Location:visPrimerCambio.php");
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar Olvido Contraseña
//--------------------------------------------------------------------
	if($_POST['btnCancelarOlvido']){
	header("Location:../index.php");
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar Restaurar
//--------------------------------------------------------------------
	if($_POST['btnCancelarRestaura']){
	header("Location:../index.php");
	}
//--------------------------------------------------------------------
//       Fin del controlador
//--------------------------------------------------------------------
?>
