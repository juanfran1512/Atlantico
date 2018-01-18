<?php
//--------------------------------------------------------------------
//       Controlador presupuesto
//--------------------------------------------------------------------
include_once("../modelo/clsPresupuesto.php");
//datos presupuesto
//se crea el Objeto presupuesto de la clase presupuesto
	$objPresupuesto = new clsPresupuesto();

	
$numero_presu=$_POST['numero_presu'];
$fecha_presu=$_POST['fecha_presu'];
$fecha_ven=$_POST['fecha_ven'];
$fecha_ent=$_POST['fecha_ent'];
$tipo_pago=$_POST['tipo_pago'];
$estatus_pre=$_POST['est_pre'];
$cli_presu=$_POST['cliente'];
$ela_presu=$_POST['ela_presu'];//este solo ce tomara en cuenta para guardar y no para modificar
$abono=$_POST['abono'];
$restante=$_POST['restante'];
$monto_iva=$_POST['monto_iva'];
$val_iva=$_POST['iva'];
$sub_total=$_POST['sub_total'];
$total_pre=$_POST['total_presu'];
//datos anulacion de presupuesto
$fecha_anu=date('Y/m/d');
$usuario_anu=$_POST['ela_presu'];

//y se envian los datos a la clase presupuesto
	$objPresupuesto->manejar_datos($numero_presu,$fecha_presu,$fecha_ven,$fecha_ent,$tipo_pago,$estatus_pre,$cli_presu,$ela_presu,$abono,$restante,$total_pre,$fecha_anu,$usuario_anu,$monto_iva,$sub_total,$val_iva);

//datos detalle  

//codigo presupuesto lol
$codigos_pro=$_POST['codigos_pro'];
$cantidades_pro=$_POST['cantidades_pro'];

$bordado_pros=$_POST['bordado_pros'];
$precios_bordado_pro=$_POST['precios_bordado_pro'];
$con_iva_pros=$_POST['con_iva_pros'];
$sin_iva_pros=$_POST['sin_iva_pros'];
$total_pros=$_POST['total_pros'];


//--------------------------------------------------------------------
//       Funcion para Registrar
//--------------------------------------------------------------------
	if($_POST['btnGuardar'])
	{
		
		if($objPresupuesto->registrar()){
			//ahora guardamos los productos con ese numero de presupuesto

				//se usa el count() para saber el numero de elementos del array -ejemplo: codigo_pro
			for($i=0; $i<count($codigos_pro);$i++){
				//y se envian los datos a la clase Detallepresupuesto
				$objPresupuesto->manejar_detalle($numero_presu,$codigos_pro[$i],$cantidades_pro[$i],$bordado_pros[$i],$precios_bordado_pro[$i],$con_iva_pros[$i],$sin_iva_pros[$i],$total_pros[$i]);
				//incluimos el detalle
				$objPresupuesto->registrar_detalle();

			}
			
			//para buscar el presupuesto guardada
		$objPresupuesto->buscar();
			if($arreglo_buscar = $objPresupuesto->row()){

			$existe="si";}
			$objPresupuesto->usar_npresupuesto($numero_presu);
			//llamamos al buscar de presupuesto
			$objPresupuesto->buscar_detalle();
			$msj = "Registro exitoso";
			
		}else{
			$msj = "No se pudo registrar el presupuesto";
		}


	}
//--------------------------------------------------------------------
//       Funcion para Buscar
//--------------------------------------------------------------------
	if($_POST['btnBuscar']){
		if($objPresupuesto->buscar()){
			$existe = "si";
			$arreglo_buscar = $objPresupuesto->row();
			//y se envian los datos a la clase Detallepresupuesto
				$objPresupuesto->usar_npresupuesto($numero_presu);
			//llamamos al buscar de presupuesto
			$objPresupuesto->buscar_detalle();

		}else{
			$msj = "No se encuentra el presupuesto";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Modificar
//--------------------------------------------------------------------
	if($_POST['btnModificar']){
		$objPresupuesto->borrar_detalle();
		if($objPresupuesto->modificar()){
				for($i=0; $i<count($codigos_pro);$i++){
				//y se envian los datos a la clase Detallepresupuesto
				$objPresupuesto->manejar_detalle($numero_presu,$codigos_pro[$i],$cantidades_pro[$i],$bordado_pros[$i],$precios_bordado_pro[$i],$con_iva_pros[$i],$sin_iva_pros[$i],$total_pros[$i]);
				//incluimos el detalle
				$objPresupuesto->registrar_detalle();

			}
			//para buscar el presupuesto guardada
		$objPresupuesto->buscar();
			if($arreglo_buscar = $objPresupuesto->row()){

			$existe="si";
			
			$primero="si";}
			$objPresupuesto->usar_npresupuesto($numero_presu);
			//llamamos al buscar de presupuesto
			$objPresupuesto->buscar_detalle();
			
			$msj = "Modificado exitosamente";

		}else{
			$msj ="No  modifico nada";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Eliminar
//--------------------------------------------------------------------
	if($_POST['btnSuspender']){
		if($objPresupuesto->eliminar()){
			$msj = "Registro eliminado";
		}else{
			$msj = "No se pudo eliminar";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar
//--------------------------------------------------------------------
	if($_POST['btnCancelar']){
	header("Location:visPresupuesto.php");
	}


//--------------------------------------------------------------------
//       Funcion para Guardar Clientes
//--------------------------------------------------------------------
include_once("../modelo/clsCliente.php");
//datos presupuesto
//se crea el Objeto presupuesto de la clase presupuesto


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
	if($_POST['btnGuardarCli'])
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