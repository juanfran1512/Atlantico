<?php
include_once("../modelo/clsRegistroUsuario.php");
//--------------------------------------------------------------------
//       Controlador Cargo
//--------------------------------------------------------------------
$cedula=$_POST['cedula'];
$contrasena=sha1(md5($_POST['contrasena']));
$tipo=$_POST['tipo'];
$status=$_POST['status'];


	//se crea el Objeto Cargo de la clase Cargo
	$objRegistroUsuario = new clsRegistroUsuario();

	//y se envian los datos a la clase Cargo
	$objRegistroUsuario->manejar_datos($cedula,$contrasena,$tipo,$status);

//--------------------------------------------------------------------
//       Funcion para Registrar
//--------------------------------------------------------------------
	if($_POST['btnGuardar'])
	{
		if($objRegistroUsuario->registrar()){
			$msj = "Registro exitoso";
			$objRegistroUsuario->buscar();
			if($arreglo_buscar = $objRegistroUsuario->row()){

			$existe="si";

			}
		}else{
			$msj = "No se pudo registrar el usuario";
		}


	}
//--------------------------------------------------------------------
//       Funcion para Buscar
//--------------------------------------------------------------------

	if($_POST['btnBuscar'])
	{
		$objRegistroUsuario->buscar();
		if($arreglo_buscar = $objRegistroUsuario->row()){

			$existe="si";

		}else{
			$msj = "No se encontro el Usuario";
		}




	}
//--------------------------------------------------------------------
//       Funcion para Modificar
//--------------------------------------------------------------------
	if($_POST['btnModificar']){
		if($objRegistroUsuario->modificar()){
			$objRegistroUsuario->buscar();
			$arreglo_buscar = $objRegistroUsuario->row();
			$msj = "Modificado exitosamente";

		}else{
			$msj ="No  se pudo modificar";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Eliminar
//--------------------------------------------------------------------
	if($_POST['btnSuspender']){
		if($objRegistroUsuario->eliminar()){
			$msj = "Registro suspendido";
		}else{
			$msj = "No se pudo suspender";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar
//--------------------------------------------------------------------
	if($_POST['btnCancelar']){
	header("Location:visRegistroUsuario.php");
	}
//--------------------------------------------------------------------
//       Fin del controlador
//--------------------------------------------------------------------
?>
