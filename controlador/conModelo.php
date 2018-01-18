<?php
include_once("../modelo/clsModelo.php");
//--------------------------------------------------------------------
//       Controlador Modelo
//--------------------------------------------------------------------
$codigo=$_POST['codigo'];
$nombre=$_POST['nombre'];
$costo=$_POST['cos_mod'];
$status=$_POST['status'];


	//se crea el Objeto Modelo de la clase Modelo
	$objModelo = new clsModelo();

	//y se envian los datos a la clase Modelo
	$objModelo->manejar_datos($codigo,$nombre,$costo,$status);

//--------------------------------------------------------------------
//       Funcion para Registrar
//--------------------------------------------------------------------
	if($_POST['btnGuardar'])
	{
		if($objModelo->registrar()){
			$objModelo->buscar();
			if($arreglo_buscar = $objModelo->row()){

			$existe="si";}
			$msj = "Registro exitoso";
		}else{
			$msj = "No se pudo registrar el Modelo";
		}


	}
//--------------------------------------------------------------------
//       Funcion para Buscar
//--------------------------------------------------------------------

	if($_POST['btnBuscar'])
	{
		$objModelo->buscar();
		if($arreglo_buscar = $objModelo->row()){

			$existe="si";

		}else{
			$msj = "No se encontro el Modelo";
		}




	}
//--------------------------------------------------------------------
//       Funcion para Modificar
//--------------------------------------------------------------------
	if($_POST['btnModificar']){
		if($objModelo->modificar()){
			$objModelo->buscar();
			$arreglo_buscar = $objModelo->row();
			$msj = "Modificado exitosamente";

		}else{
			$msj ="No  modifico nada";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Eliminar
//--------------------------------------------------------------------
	if($_POST['btnSuspender']){
		if($objModelo->eliminar()){
			$msj = "Registro eliminado";
		}else{
			$msj = "No se pudo eliminar";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar
//--------------------------------------------------------------------
	if($_POST['btnCancelar']){
	header("Location:visModelo.php");
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar
//--------------------------------------------------------------------
if (isset($_POST["validamodelo"]) ) {
        $json=$_POST["validamodelo"];
        $obj_php = json_encode($json);
        $obj=json_decode($obj_php);

      $objModelo->modelo($obj->modelo);
      $Modelos= $objModelo->row(); 
      $nombre=$Modelos['nom_mod'];
      $precio=$Modelos['cos_mod'];
      $codigo=$Modelos['cod_mod'];
        if($objModelo->rows()>0){
            echo  "|si"."|".$nombre."|".$precio."|".$codigo;
           
        }else{
             echo "|no";
    }
    }
//--------------------------------------------------------------------
//       Fin del controlador
//--------------------------------------------------------------------
?>
