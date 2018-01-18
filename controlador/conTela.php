<?php
include_once("../modelo/clsTela.php");
//--------------------------------------------------------------------
//       Controlador Tela
//--------------------------------------------------------------------
$codigo=$_POST['codigo'];
$nombre=$_POST['nombre'];
$cantidad=$_POST['can_tela'];
$precio=$_POST['pre_tela'];
$tipo=$_POST['tipo_tela'];
$status=$_POST['status'];
$nom_tip=$_POST['texto_tipo'];
$nombre=$nom_tip.' '.$nombre;
$bordado=$_POST['bordado'];
$cuello=$_POST['cuello'];
$bordado_fuera=$_POST['bordado_fuera'];
	//se crea el Objeto Tela de la clase Tela
	$objTela = new clsTela();

	//y se envian los datos a la clase Tela
	$objTela->manejar_datos($codigo,$nombre,$cantidad,$tipo,$precio,$status,$bordado,$cuello,$bordado_fuera);

//--------------------------------------------------------------------
//       Funcion para Registrar
//--------------------------------------------------------------------
if($_POST['btnGuardar'])
	{
		$objTela->buscar();
			if($arreglo_buscar = $objTela->row()){
				$msj = "Esta Tela se encuentra registrada";
				$existe="si";
			}else {
			 	if($objTela->registrar()){
					$msj = "Registro exitoso";
				}else{
					$msj = "No se pudo registrar la Tela";
					} 
				}


	}
//--------------------------------------------------------------------
//       Funcion para Buscar
//--------------------------------------------------------------------

	if($_POST['btnBuscar'])
	{
		$objTela->buscar();
		if($arreglo_buscar = $objTela->row()){

			$existe="si";

		}else{
			$msj = "No se encontro el Tela";
		}




	}
//--------------------------------------------------------------------
//       Funcion para Modificar
//--------------------------------------------------------------------
	if($_POST['btnModificar']){
		if($objTela->modificar()){
			$objTela->buscar();
			$arreglo_buscar = $objTela->row();
			$msj = "Modificado exitosamente";

		}else{
			$msj ="No  modifico nada";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Eliminar
//--------------------------------------------------------------------
	if($_POST['btnSuspender']){
		if($objTela->eliminar()){
			$msj = "Registro eliminado";
		}else{
			$msj = "No se pudo eliminar";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar
//--------------------------------------------------------------------
	if($_POST['btnCancelar']){
	header("Location:visTela.php");
	}
//--------------------------------------------------------------------
//       Funcion para Listar
//--------------------------------------------------------------------
	if($_POST['btnListar']){
	header("Location:visListaTelas.php");
	}
//--------------------------------------------------------------------
//       Funcion para Buscar por like
//--------------------------------------------------------------------
if (isset($_POST["validatela"]) ) {
        $json=$_POST["validatela"];
        $obj_php = json_encode($json);
        $obj=json_decode($obj_php);

      $objTela->tela($obj->tela);
      $Telas= $objTela->row(); 
      $nombre=$Telas['nom_tela'];
      $cantidad=$Telas['can_tela'];
      $codigo=$Telas['cod_tela'];
      $tipo=$Telas['tipo_tela'];
      $precio=$Telas['pre_tela'];
        if($objTela->rows()>0){
            echo  "|si"."|".$nombre."|".$cantidad."|".$codigo."|".$tipo."|".$precio;
           
        }else{
             echo "|no";
    }
    }

//--------------------------------------------------------------------
//       Funcion para Actualizar Precios
//--------------------------------------------------------------------
	$codigos_p=$_POST['codigos_p'];
	$precios_p=$_POST['precios_p'];
	$codigos_j=$_POST['codigos_j'];
	$precios_j=$_POST['precios_j'];
	$fechahoy=date('Y-m-d');
	if($_POST['btnActualizar']){

	$objTela->bordado($fechahoy);

    for($i=0; $i<count($codigos_p);$i++){
				//y se envian los datos a la clase Detallepresupuesto
				$objTela->manejar_precios($codigos_p[$i],$precios_p[$i]);
				//incluimos el detalle
				$objTela->act_precios();

			}
			for($i=0; $i<count($codigos_j);$i++){
				//y se envian los datos a la clase Detallepresupuesto
				$objTela->manejar_precios($codigos_j[$i],$precios_j[$i]);
				//incluimos el detalle
				$objTela->act_precios();

			}
			$objTela->buscar_act();
			$arreglo_buscar = $objTela->row();
			$existe="si";
			$msj = "Precios Actualizados";
	 }
//--------------------------------------------------------------------
//       Fin del controlador
//--------------------------------------------------------------------
?>
