<?php
include_once("../modelo/clsTipoTela.php");
//--------------------------------------------------------------------
//       Controlador Tela
//--------------------------------------------------------------------
$codigo=$_POST['codigo'];
$nombre=$_POST['nombre'];
$precio=$_POST['pre_tipo_tela'];
$pieza=$_POST['can_uso_tela'];
$operador=$_POST['ope_tela'];
$status=$_POST['status'];


	//se crea el Objeto Tela de la clase Tela
	$objTela = new clsTipoTela();

	//y se envian los datos a la clase Tela
	$objTela->manejar_datos($codigo,$nombre,$precio,$pieza,$operador,$status);

//--------------------------------------------------------------------
//       Funcion para Registrar
//--------------------------------------------------------------------
if($_POST['btnGuardar'])
	{
		$objTela->buscar();
			if($arreglo_buscar = $objTela->row()){
				$msj = "Este Tipo de Tela se encuentra registrado";
				$existe="si";
			}else {
			 	if($objTela->registrar()){
					$msj = "Registro exitoso";
				}else{
					$msj = "No se pudo registrar el Tipo de Tela";
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
			$msj = "No se encontro la Tela";
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
	header("Location:visTipoTela.php");
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar
//--------------------------------------------------------------------
if (isset($_POST["validatipotela"]) ) {
        $json=$_POST["validatipotela"];
        $obj_php = json_encode($json);
        $obj=json_decode($obj_php);

      $objTela->tela($obj->tela);
      $Telas= $objTela->row(); 
      $nombre=$Telas['nom_tipo_tela'];
      $precio=$Telas['pre_tipo_tela'];
      $codigo=$Telas['cod_tipo_tela'];
      $pieza=$Telas['can_uso_tela'];
      $operador=$Telas['ope_tela'];
        if($objTela->rows()>0){
            echo  "|si"."|".$nombre."|".$precio."|".$codigo."|".$pieza."|".$operador;
           
        }else{
             echo "|no";
    }
    }
//--------------------------------------------------------------------
//       Fin del controlador
//--------------------------------------------------------------------
?>
