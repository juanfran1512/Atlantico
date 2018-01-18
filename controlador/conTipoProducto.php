<?php
include_once("../modelo/clsTipoProducto.php");
//--------------------------------------------------------------------
//       Controlador Modelo
//--------------------------------------------------------------------
$codigo=$_POST['codigo'];
$nombre=$_POST['nombre'];
$status=$_POST['status'];


	//se crea el Objeto Modelo de la clase Modelo
	$objTipo = new clsTipoProducto();

	//y se envian los datos a la clase Modelo
	$objTipo->manejar_datos($codigo,$nombre,$status);

//--------------------------------------------------------------------
//       Funcion para Registrar
//--------------------------------------------------------------------
if($_POST['btnGuardar'])
	{
		$objTipo->buscar();
			if($arreglo_buscar = $objTipo->row()){
				$msj = "Este tipo de producto se encuentra registrado";
				$existe="si";
			}else {
			 	if($objTipo->registrar()){
					$msj = "Registro exitoso";
				}else{
					$msj = "No se pudo registrar el Tipo Producto";
					} 
				}


	}
//--------------------------------------------------------------------
//       Funcion para Buscar
//--------------------------------------------------------------------

	if($_POST['btnBuscar'])
	{
		$objTipo->buscar();
		if($arreglo_buscar = $objTipo->row()){

			$existe="si";

		}else{
			$msj = "No se encontro el Modelo";
		}




	}
//--------------------------------------------------------------------
//       Funcion para Modificar
//--------------------------------------------------------------------
	if($_POST['btnModificar']){
		if($objTipo->modificar()){
			$objTipo->buscar();
			$arreglo_buscar = $objTipo->row();
			$msj = "Modificado exitosamente";

		}else{
			$msj ="No  modifico nada";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Eliminar
//--------------------------------------------------------------------
	if($_POST['btnSuspender']){
		if($objTipo->eliminar()){
			$msj = "Registro eliminado";
		}else{
			$msj = "No se pudo eliminar";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar
//--------------------------------------------------------------------
	if($_POST['btnCancelar']){
	header("Location:visTipoProducto.php");
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar
//--------------------------------------------------------------------
if (isset($_POST["validatipo"]) ) {
        $json=$_POST["validatipo"];
        $obj_php = json_encode($json);
        $obj=json_decode($obj_php);

      $objTipo->tipo($obj->tipo);
      $Tipos= $objTipo->row(); 
      $nombre=$Tipos['nom_tip'];
      $codigo=$Tipos['cod_tip_pro'];
        if($objTipo->rows()>0){
            echo  "|si"."|".$nombre."|".$codigo;
           
        }else{
             echo "|no";
    }
    }
//--------------------------------------------------------------------
//       Fin del controlador
//--------------------------------------------------------------------
?>
