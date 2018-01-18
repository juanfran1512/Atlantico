<?php
include_once("../modelo/clsArticulo.php");
//--------------------------------------------------------------------
//       Controlador Cargo
//--------------------------------------------------------------------
$codigo=$_POST['codigo'];
$nombre=$_POST['nombre'];
$tipo=$_POST['tipo'];
$unidad=$_POST['unidad'];
$descripcion=$_POST['descripcion'];
$accesorio=$_POST['accesorio'];
$existencia=$_POST['existencia'];
$status=$_POST['status'];


	//se crea el Objeto Cargo de la clase Cargo
	$objArticulo = new clsArticulo();

	//y se envian los datos a la clase Cargo
	$objArticulo->manejar_datos($codigo,$nombre,$tipo,$unidad,$descripcion,$accesorio,$existencia,$status);

//--------------------------------------------------------------------
//       Funcion para Registrar
//--------------------------------------------------------------------
	if($_POST['btnGuardar'])
	{
		if($objArticulo->registrar()){
			$objArticulo->buscar();
			if($arreglo_buscar = $objArticulo->row()){
			
			$existe="si";}
			$msj = "Registro exitoso";
		}else{
			$msj = "No se pudo registrar el Cargo";
		}
		
		
	}
//--------------------------------------------------------------------
//       Funcion para Buscar
//--------------------------------------------------------------------

	if($_POST['btnBuscar'])
	{
		$objArticulo->buscar();
		if($arreglo_buscar = $objArticulo->row()){
			
			$existe="si";
			
		}else{
			$msj = "No se encontro el Articulo";
		}

		
		
		
	}
//--------------------------------------------------------------------
//       Funcion para Modificar
//--------------------------------------------------------------------
	if($_POST['btnModificar']){
		if($objArticulo->modificar()){
			$objArticulo->buscar();
			$arreglo_buscar = $objArticulo->row();
			$msj = "Modificado exitosamente";
			
		}else{
			$msj ="No  modifico nada";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Eliminar
//--------------------------------------------------------------------
	if($_POST['btnSuspender']){
		if($objArticulo->eliminar()){
			$msj = "Registro eliminado";
		}else{
			$msj = "No se pudo eliminar";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar
//--------------------------------------------------------------------
	if($_POST['btnCancelar']){
	header("Location:visArticulo.php"); 
	}
//--------------------------------------------------------------------
//       Fin del controlador
//--------------------------------------------------------------------
?>
