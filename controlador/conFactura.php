<?php
//--------------------------------------------------------------------
//       Controlador Factura
//--------------------------------------------------------------------
include_once("../modelo/clsFactura.php");
//datos factura
//se crea el Objeto Factura de la clase Factura
	$objFactura = new clsFactura();

	
$numero_fac=$_POST['numero_fac'];
$fecha_fac=$_POST['fecha_fac'];
$fecha_ven=$_POST['fecha_ven'];
$tipo_com=$_POST['tipo_com'];
$status_fac=$_POST['status_fac'];
$cliente_fac=$_POST['clienteci_fac'];
$usuario_fac=$_POST['usuario_fac'];//este solo ce tomara en cuenta para guardar y no para modificar
$choferci_fac=$_POST['choferci_fac'];
$placa_fac=$_POST['placa_fac'];

$total_fac=$_POST['total_fac'];
//datos anulacion de factura
$fecha_anu=date('Y/m/d');
$usuario_anu=$_POST['usuario_fac'];

//y se envian los datos a la clase Factura
	$objFactura->manejar_datos($numero_fac,$fecha_fac,$fecha_ven,$tipo_com,$status_fac,$cliente_fac,$usuario_fac,$choferci_fac,$placa_fac,$total_fac,$fecha_anu,$usuario_anu);

//datos detalle  

include_once("../modelo/clsDetalleFactura.php");
	$objDetalle = new clsDetalleFactura();
//codigo factura lol
$codigos_pro=$_POST['codigos_pro'];
$cantidades_pro=$_POST['cantidades_pro'];
$precios_pro=$_POST['precios_pro'];
$pesob_pro=$_POST['pesob_pro'];
$peson_pro=$_POST['peson_pro'];
$totales_pro=$_POST['totales_pro'];

//datos existencia del producto  

include_once("../modelo/clsProducto.php");
	$objProducto = new clsProducto();
$cestas_pro=$_POST['cestas_pro'];


//--------------------------------------------------------------------
//       Funcion para Registrar
//--------------------------------------------------------------------
	if($_POST['btnGuardar'])
	{
		
		if($objFactura->registrar()){
			//ahora guardamos los productos con ese numero de factura

				//se usa el count() para saber el numero de elementos del array -ejemplo: codigo_pro
			for($i=0; $i<count($codigos_pro);$i++){
				//y se envian los datos a la clase DetalleFactura
				$objDetalle->manejar_datos($numero_fac,$codigos_pro[$i],$cantidades_pro[$i],$precios_pro[$i],$pesob_pro[$i],$peson_pro[$i],$totales_pro[$i]);
				//incluimos el detalle
				$objDetalle->registrar();
			//__existencia productos
				//calcula para actualizar las cestas
				$exis_cestas=$cestas_pro[$i]-$cantidades_pro[$i];
				//y se envian los datos a la clase producto
				$objProducto->datos_exis($codigos_pro[$i],$exis_cestas);
				//actualizamos la existencia del producto
				$objProducto->existenciaCestas();
			}
			/* 
			//para buscar la factura guardada
		$objFactura->buscar();
			if($arreglo_buscar = $objFactura->row()){

			$existe="si";}}*/
			
			$msj = "Registro exitoso";
			
		}else{
			$msj = "No se pudo registrar  la factura";
		}


	}
//--------------------------------------------------------------------
//       Funcion para Buscar
//--------------------------------------------------------------------
	if($_POST['btnBuscar']){
		if($objFactura->buscar()){
			$existe = "si";
			$arreglo_buscar = $objFactura->row();
			//y se envian los datos a la clase DetalleFactura
				$objDetalle->usar_nfactura($numero_fac);
			//llamamos al buscar de factura
			$objDetalle->buscar();

		}else{
			$msj = "no se encuentra la factura";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Modificar
//--------------------------------------------------------------------
	if($_POST['btnModificar']){
		if($objFactura->modificar()){
			$objFactura->buscar();
			$arreglo_buscar = $objFactura->row();
			$msj = "Modificado exitosamente";

		}else{
			$msj ="No  modifico nada";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Eliminar
//--------------------------------------------------------------------
	if($_POST['btnSuspender']){
		if($objFactura->eliminar()){
			$msj = "Registro eliminado";
		}else{
			$msj = "No se pudo eliminar";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar
//--------------------------------------------------------------------
	if($_POST['btnCancelar']){
	header("Location:visFactura.php");
	}
//--------------------------------------------------------------------
//       Fin del controlador
//--------------------------------------------------------------------
?>