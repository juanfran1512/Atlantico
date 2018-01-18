<?php
include_once("../modelo/clsProveedor.php");
//--------------------------------------------------------------------
//       Controlador Proveedor
//--------------------------------------------------------------------
$rif=$_POST['rif'];
$nombre=$_POST['nombre'];
$telefono=$_POST['telefono'];
$persona=$_POST['persona'];
$direccion=$_POST['direccion'];
$correo=$_POST['correo'];
$codigo=$_POST['codigo'];
$status=$_POST['status'];


	//se crea el Objeto Proveedor de la clase Proveedor
	$objProveedor = new clsProveedor();

	//y se envian los datos a la clase Proveedor
	$objProveedor->manejar_datos($rif,$nombre,$telefono,$persona,$direccion,$correo,$codigo,$status);

//--------------------------------------------------------------------
//       Funcion para Registrar
//--------------------------------------------------------------------
	if($_POST['btnGuardar'])
	{
		$objProveedor->buscar();
			if($arreglo_buscar = $objProveedor->row()){
				$msj = "Este proveedor se encuentra registrado";
				$existe="si";
			}else {
			 	if($objProveedor->registrar()){
					$msj = "Registro exitoso";
				}else{
					$msj = "No se pudo registrar el Proveedor";
					} 
				}


	}
//--------------------------------------------------------------------
//       Funcion para Buscar
//--------------------------------------------------------------------

	if($_POST['btnBuscar'])
	{
		$objProveedor->buscar();
		if($arreglo_buscar = $objProveedor->row()){

			$existe="si";

		}else{
			$msj = "No se encontro el Proveedor";
		}




	}
//--------------------------------------------------------------------
//       Funcion para Modificar
//--------------------------------------------------------------------
	if($_POST['btnModificar']){
		if($objProveedor->modificar()){
			$objProveedor->buscar();
			$arreglo_buscar = $objProveedor->row();
			$msj = "Modificado exitosamente";

		}else{
			$msj ="No  modifico nada";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Eliminar
//--------------------------------------------------------------------
	if($_POST['btnSuspender']){
		if($objProveedor->eliminar()){
			$msj = "Registro eliminado";
		}else{
			$msj = "No se pudo eliminar";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar
//--------------------------------------------------------------------
	if($_POST['btnCancelar']){
	header("Location:visProveedor.php");
	}

//--------------------------------------------------------------------
//       Funcion para Buscar por like
//--------------------------------------------------------------------
if (isset($_POST["validaproveedor"]) ) {
        $json=$_POST["validaproveedor"];
        $obj_php = json_encode($json);
        $obj=json_decode($obj_php);

      $objProveedor->proveedor($obj->proveedor);
      $proveedores= $objProveedor->row(); 
      $nombre=$proveedores['nom_prov'];
      $telefono=$proveedores['tlfn_prov'];
      $direccion=$proveedores['dir_prov'];
      $correo=$proveedores['correo_prov'];
      $rif=$proveedores['rif_prov'];
      $persona=$proveedores['pers_prov'];
      $codigo=$proveedores['cod_prov'];
         if($objProveedor->rows()>0){
            echo  "|si"."|".$nombre."|".$telefono."|".$direccion."|".$correo."|".$rif."|".$persona."|".$codigo;
           
        }else{
             echo "|no";
    }
    }
//--------------------------------------------------------------------
//       Fin del controlador
//--------------------------------------------------------------------
?>
