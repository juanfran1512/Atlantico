<?php
include_once("../modelo/clsCliente.php");
//--------------------------------------------------------------------
//       Controlador Cliente
//--------------------------------------------------------------------
$codigo=$_POST['codigo'];
$rif=$_POST['rif'];
$nombre=$_POST['nombre'];
$telefono=$_POST['telefono'];
$persona=$_POST['persona'];
$direccion=$_POST['direccion'];
$correo=$_POST['correo'];
$zona=$_POST['zona'];
$municipo=$_POST['municipio'];


	//se crea el Objeto Cliente de la clase Cliente
	$objCliente = new clsCliente();

	//y se envian los datos a la clase Cliente
	$objCliente->manejar_datos($codigo,$rif,$nombre,$telefono,$persona,$correo,$direccion,$zona,$municipo);

//--------------------------------------------------------------------
//       Funcion para Registrar
//--------------------------------------------------------------------
	if($_POST['btnGuardar'])
	{
		$objCliente->buscar();
			if($arreglo_buscar = $objCliente->row()){
				$msj = "Este cliente ya se encuentra registrado";
				$existe="si";
			}else {
			 	if($objCliente->registrar()){
					$msj = "Registro exitoso";
				}else{
					$msj = "No se pudo registrar el cliente";
					} 
				}


	}
//--------------------------------------------------------------------
//       Funcion para Buscar
//--------------------------------------------------------------------

	if($_POST['btnBuscar'])
	{
		$objCliente->buscar();
		if($arreglo_buscar = $objCliente->row()){

			$existe="si";

		}else{
			$msj = "No se encontro el Cliente";
		}




	}
//--------------------------------------------------------------------
//       Funcion para Modificar
//--------------------------------------------------------------------
	if($_POST['btnModificar']){
		if($objCliente->modificar()){
			$objCliente->buscar();
			$arreglo_buscar = $objCliente->row();
			$msj = "Modificado exitosamente";

		}else{
			$msj ="No  modifico nada";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Eliminar
//--------------------------------------------------------------------
	if($_POST['btnSuspender']){
		if($objCliente->eliminar()){
			$msj = "Registro eliminado";
		}else{
			$msj = "No se pudo eliminar";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar
//--------------------------------------------------------------------
	if($_POST['btnCancelar']){
	header("Location:visCliente.php");
	}
	//--------------------------------------------------------------------
//       Funcion para Buscar por like
//--------------------------------------------------------------------
if (isset($_POST["validacliente"]) ) {
        $json=$_POST["validacliente"];
        $obj_php = json_encode($json);
        $obj=json_decode($obj_php);

      $objCliente->cliente($obj->cliente); $clientes= $objCliente->row();
      $nombre=$clientes['nom_cli'];
      $telefono=$clientes['tlfn_cli'];
      $direccion=$clientes['dir_cli'];
      $correo=$clientes['correo_cli'];
      $rif=$clientes['rif_cli'];
      $persona=$clientes['pers_cli'];
      $codigo=$clientes['cod_cli'];
      $zona=$clientes['zona_fk'];
      $municipo=$clientes['municipio_fk'];
         if($objCliente->rows()>0){
            echo  "|si"."|".$nombre."|".$telefono."|".$direccion."|".$correo."|".$rif."|".$persona."|".$codigo."|".$zona."|".$municipo;
           
        }else{
             echo "|no";
    }
    }
//--------------------------------------------------------------------
//       Fin del controlador
//--------------------------------------------------------------------
?>
