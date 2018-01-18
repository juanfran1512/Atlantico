<?php
include_once("../modelo/clsProducto.php");
//--------------------------------------------------------------------
//       Controlador Producto
//--------------------------------------------------------------------
$codigo=$_POST['codigo'];
$nombre=$_POST['nombre'];
$modelo=$_POST['nom_mod'];
$tela=$_POST['nom_tela'];
$tipo=$_POST['nom_tip'];
$precio=$_POST['pre_tela'];
$manga=$_POST['manga'];
$genero=$_POST['genero'];
$talla=$_POST['talla'];
$nom_tela=$_POST['texto_tela'];
$nom_mod=$_POST['texto_modelo'];
$nom_tip=$_POST['texto_tipo'];
$nom_col_pre=$_POST['texto_color'];
$nom_col=$_POST['color_ca'];
$nom_tal=$_POST['texto_talla'];
$status=$_POST['status'];
if($precio==""){
$nombre=$nom_tip.' '.$nom_mod.' EN '.$nom_tela.' '.$nom_col;
	if($genero=='1'){
			$nombre=$nom_tip.' '.$nom_mod.' EN '.$nom_tela.' '.$nom_col.' T'.$nom_tal;

		if($manga=='1'){

			$nombre=$nom_tip.' '.$nom_mod.' EN '.$nom_tela.' '.$nom_col.' T'.$nom_tal.' M/C';
		}

		if($manga=='2'){
			$nombre=$nom_tip.' '.$nom_mod.' EN '.$nom_tela.' '.$nom_col.' T'.$nom_tal.' M/L';
		}
	}
	if($genero=='2'){
			$nombre=$nom_tip.' '.$nom_mod.' DE CABALLERO EN '.$nom_tela.' '.$nom_col;

		if($manga=='1'){

			$nombre=$nom_tip.' '.$nom_mod.' DE CABALLERO EN '.$nom_tela.' '.$nom_col.' M/C';
		}

		if($manga=='2'){
			$nombre=$nom_tip.' '.$nom_mod.' DE CABALLERO EN '.$nom_tela.' '.$nom_col.' M/L';
		}
	}
	if($genero=='3'){
			$nombre=$nom_tip.' '.$nom_mod.' DE DAMA EN '.$nom_tela.' '.$nom_col;

		if($manga=='1'){

			$nombre=$nom_tip.' '.$nom_mod.' DE DAMA EN '.$nom_tela.' '.$nom_col.' M/C';
		}

		if($manga=='2'){
			$nombre=$nom_tip.' '.$nom_mod.' DE DAMA EN '.$nom_tela.' '.$nom_col.' M/L';
		}
	}
}else{
	$nombre=$nom_tip.' '.$nom_mod.' EN '.$nom_tela.' '.$nom_col_pre;
	if($genero=='1'){
			$nombre=$nom_tip.' '.$nom_mod.' EN '.$nom_tela.' '.$nom_col_pre.' T'.$nom_tal;

		if($manga=='1'){

			$nombre=$nom_tip.' '.$nom_mod.' EN '.$nom_tela.' '.$nom_col_pre.' T'.$nom_tal.' M/C';
		}

		if($manga=='2'){
			$nombre=$nom_tip.' '.$nom_mod.' EN '.$nom_tela.' '.$nom_col_pre.' T'.$nom_tal.' M/L';
		}
	}
	if($genero=='2'){
			$nombre=$nom_tip.' '.$nom_mod.' DE CABALLERO EN '.$nom_tela.' '.$nom_col_pre;

		if($manga=='1'){

			$nombre=$nom_tip.' '.$nom_mod.' DE CABALLERO EN '.$nom_tela.' '.$nom_col_pre.' M/C';
		}

		if($manga=='2'){
			$nombre=$nom_tip.' '.$nom_mod.' DE CABALLERO EN '.$nom_tela.' '.$nom_col_pre.' M/L';
		}
	}
	if($genero=='3'){
			$nombre=$nom_tip.' '.$nom_mod.' DE DAMA EN '.$nom_tela.' '.$nom_col;

		if($manga=='1'){

			$nombre=$nom_tip.' '.$nom_mod.' DE DAMA EN '.$nom_tela.' '.$nom_col.' M/C';
		}

		if($manga=='2'){
			$nombre=$nom_tip.' '.$nom_mod.' DE DAMA EN '.$nom_tela.' '.$nom_col.' M/L';
		}
	}
}
if($nom_tip=='BORDADO'){
	$nombre=$nom_tip.' '.$nom_mod;
}
if ($nom_tip=='JEAN TRES COSTURAS'){
 	$nombre=$nom_tip;


 }

	//se crea el Objeto Producto de la clase Producto
	$objProducto = new clsProducto();

	//y se envian los datos a la clase Producto
	$objProducto->manejar_datos($codigo,$nombre,$modelo,$tela,$tipo,$precio,$talla,$manga,$status);

//--------------------------------------------------------------------
//       Funcion para Registrar
//--------------------------------------------------------------------
	if($_POST['btnGuardar'])
	{
		$objProducto->buscar();
			if($arreglo_buscar = $objProducto->row()){
				$msj = "Este producto se encuentra registrado";
				$existe="si";
			}else {
			 	if($objProducto->registrar()){
					$msj = "Registro exitoso";
				}else{
					$msj = "No se pudo registrar el Producto";
					} 
				}


	}
//--------------------------------------------------------------------
//       Funcion para Buscar
//--------------------------------------------------------------------

	if($_POST['btnBuscar'])
	{
		$objProducto->buscar();
		if($arreglo_buscar = $objProducto->row()){

			$existe="si";

		}else{
			$msj = "No se encontro el Producto";
		}




	}
//--------------------------------------------------------------------
//       Funcion para Modificar
//--------------------------------------------------------------------
	if($_POST['btnModificar']){
		if($objProducto->modificar()){
			$objProducto->buscar();
			$arreglo_buscar = $objProducto->row();
			$msj = "Modificado exitosamente";

		}else{
			$msj ="No  modifico nada";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Eliminar
//--------------------------------------------------------------------
	if($_POST['btnSuspender']){
		if($objProducto->eliminar()){
			$msj = "Registro eliminado";
		}else{
			$msj = "No se pudo eliminar";
		}
	}
//--------------------------------------------------------------------
//       Funcion para Cancelar
//--------------------------------------------------------------------
	if($_POST['btnCancelar']){
	header("Location:visProducto.php");
	}
//--------------------------------------------------------------------
//       Funcion para buscar productos
//--------------------------------------------------------------------
if (isset($_POST["validaproducto"]) ) {
        $json=$_POST["validaproducto"];
        $obj_php = json_encode($json);
        $obj=json_decode($obj_php);

      $objProducto->producto($obj->producto);
      $Productos= $objProducto->row(); 
      $nombre=$Productos['nom_pro'];
      $modelo=$Productos['modelo'];
      $codigo=$Productos['cod_pro'];
      $tela=$Productos['tela'];
      $precio=$Productos['pre_tela'];
      $manga=$Productos['manga'];
      $talla=$Productos['talla'];
      $tipo=$Productos['tip_pro'];
      $juvenil=$Productos['juvenil'];
        if($objProducto->rows()>0){
            echo  "|si"."|".$nombre."|".$modelo."|".$codigo."|".$tela."|".$tipo."|".$precio."|".$manga."|".$talla."|".$juvenil;
           
        }else{
             echo "|no";
    }
    }
//--------------------------------------------------------------------
//       Funcion para Cancelar
//--------------------------------------------------------------------
if (isset($_POST["buscaproducto"]) ) {
        $json=$_POST["buscaproducto"];
        $obj_php = json_encode($json);
        $obj=json_decode($obj_php);

      $objProducto->busca_productos($obj->productos);
      $Productos= $objProducto->row(); 
      $nombre=$Productos['nom_pro'];
      $modelo=$Productos['modelo'];
      $codigo=$Productos['cod_pro'];
      $tipo_tela=$Productos['tela'];
      $precio=$Productos['pre_col'];
      $tela=$Productos['pre_tela'];
      $manga=$Productos['manga'];
      $talla=$Productos['nom_talla'];
      $tipo=$Productos['tip_pro'];
      $cmodelo=$Productos['cos_mod'];
      $ptela=$Productos['pre_tipo_tela'];
      $pieza=$Productos['can_uso_tela'];
      $operador=$Productos['ope_tela'];

        if($objProducto->rows()>0){
            echo  "|sip"."|".$nombre."|".$modelo."|".$codigo."|".$tipo_tela."|".$tipo."|".$cmodelo."|".$ptela."|".$pieza."|".$operador."|".$precio."|".$tela."|".$talla;
           
        }else{
             echo "|no";
    }
    }    
//--------------------------------------------------------------------
//       Fin del controlador
//--------------------------------------------------------------------
?>
