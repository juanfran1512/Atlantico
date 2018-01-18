<?php
include_once("../modelo/clsPrecioColor.php");
//--------------------------------------------------------------------
//       Controlador Tela
//--------------------------------------------------------------------
$codigo=$_POST['codigo'];
$nombre=$_POST['nombre'];
$precio=$_POST['precio'];
$tela=$_POST['nom_tela'];


	//se crea el Objeto Tela de la clase Tela
	$objColor = new clsPrecioColor();

	//y se envian los datos a la clase Tela
	$objColor->manejar_datos($codigo,$nombre,$precio,$tela);

//--------------------------------------------------------------------
//       Funcion para Registrar
//--------------------------------------------------------------------
if($_POST['btnGuardar'])
	{
		$objColor->buscar();
			if($arreglo_buscar = $objColor->row()){
				$msj = "Este precio se encuentra registrado";
				$existe="si";
			}else {
			 	if($objColor->registrar()){
					$msj = "Registro exitoso";
				}else{
					$msj = "No se pudo registrar el precio ";
					} 
				}


	}
//--------------------------------------------------------------------
//       Funcion para Buscar
//--------------------------------------------------------------------

	if($_POST['btnBuscar'])
	{
		$objColor->buscar();
		if($arreglo_buscar = $objColor->row()){

			$existe="si";

		}else{
			$msj = "No se encontro el color";
		}




	}
//--------------------------------------------------------------------
//       Funcion para Modificar
//--------------------------------------------------------------------
	if($_POST['btnModificar']){
		if($objColor->modificar()){
			$objColor->buscar();
			$arreglo_buscar = $objColor->row();
			$msj = "Modificado exitosamente";

		}else{
			$msj ="No  modifico nada";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Eliminar
//--------------------------------------------------------------------
	if($_POST['btnSuspender']){
		if($objColor->eliminar()){
			$msj = "Registro eliminado";
		}else{
			$msj = "No se pudo eliminar";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar
//--------------------------------------------------------------------
	if($_POST['btnCancelar']){
	header("Location:visPrecioColor.php");
	}
//--------------------------------------------------------------------
//       Funcion para Listar
//--------------------------------------------------------------------
	if($_POST['btnListar']){
	header("Location:visListaColores.php");
	}
//--------------------------------------------------------------------
//       Funcion para Buscar por like
//--------------------------------------------------------------------
if (isset($_POST["validacolor"]) ) {
        $json=$_POST["validacolor"];
        $obj_php = json_encode($json);
        $obj=json_decode($obj_php);

      $objColor->color($obj->color);
      $colores= $objColor->row(); 
      $nombre=$colores['nom_pre_col'];
      $codigo=$colores['cod_pre_col'];
      $precio=$colores['pre_col'];
      $tela=$colores['tipo_tela'];
        if($objColor->rows()>0){
            echo  "|si"."|".$nombre."|".$codigo."|".$precio."|".$tela;
           
        }else{
             echo "|no";
    }
    }
//--------------------------------------------------------------------
//       Fin del controlador
//--------------------------------------------------------------------
?>
