<?php
include_once "../modelo/conexion_bd.php";
//--------------------------------------------------------------------
//       Clase para la gestion de Tela
//--------------------------------------------------------------------

class clsTela extends conexion_bd{
private $c_codigo;
private $c_nombre;
private $c_cantidad;
private $c_tipo;
private $c_precio;
private $c_status;
private $c_precio_bor;
private $c_precio_cue;
private $c_precio_bor_fuera;
private $c_precios;
private $c_codigos;

//para actualizar la existencia
//private $c_existencia_act;

//--------------------------------------------------------------------
//       Metodo para obtener los datos del controlador
//--------------------------------------------------------------------

public function manejar_datos($codigo,$nombre,$cantidad,$tipo,$precio,$status,$precio_bor,$precio_cue,$precio_bor_fuera){

	$this->c_codigo=$codigo;
	$this->c_nombre=$nombre;
	$this->c_cantidad=$cantidad;
	$this->c_tipo=$tipo;
	$this->c_precio=$precio;
	$this->c_precio_bor=$precio_bor;
	$this->c_precio_cue=$precio_cue;
	$this->c_precio_bor_fuera=$precio_bor_fuera;
	$this->c_status=$status;
}
//--------------------------------------------------------------------
//       Metodo para obtener los datos del controlador
//--------------------------------------------------------------------

public function manejar_precios($codigos,$precios){

	$this->c_codigos=$codigos;
	$this->c_precios=$precios;

}
/*public function datos_exis($codigo,$exis_cestas){
	$this->c_codigo=$codigo;
	$this->c_exis_cestas=$exis_cestas;
}*/

//--------------------------------------------------------------------
//       Funciones SQL
//--------------------------------------------------------------------

public function registrar()
		{	//consulta sql de la base de datos
			$this->consulta("INSERT INTO ttela (cod_tela,nom_tela,can_tela,tipo_tela,pre_tela) VALUES (
 '$this->c_codigo',  '$this->c_nombre',  '$this->c_cantidad',  '$this->c_tipo','$this->c_precio');");
			//true para validar if
			return true;
		}

public function buscar()
		{
			$this->consulta("SELECT * FROM ttela WHERE nom_tela='$this->c_nombre' AND tipo_tela='$this->c_tipo' AND pre_tela='$this->c_precio'");
		}
public function buscar_act()
		{
			$this->consulta("SELECT * FROM `totros` ORDER BY `cod_bor` DESC LIMIT 1");
		}
public function buscar_like($dato)
		{
			$this->consulta("SELECT nom_tela,cod_tela,can_tela, tipo_tela, pre_tela, nom_tipo_tela FROM ttela,ttipo_tela WHERE nom_tela LIKE  '%".$dato."%' AND tipo_tela=cod_tipo_tela LIMIT 0 , 5");
		}
public function buscar_lista($dato)
		{
			$this->consulta("SELECT nom_tela,cod_tela,can_tela,pre_col,pre_tela FROM ttela,ttipo_tela,tprecio_color WHERE ttipo_tela.cod_tipo_tela='".$dato."' AND ttipo_tela.cod_tipo_tela=ttela.tipo_tela AND cod_pre_col=pre_tela ORDER BY nom_tela ");
		}
public function tela($dato)
		{
			$this->consulta("SELECT cod_pre_col, nom_pre_col, pre_col, nom_tipo_tela,tipo_tela FROM tprecio_color,ttipo_tela WHERE tprecio_color.tipo_tela='".$dato."' AND
			 ttipo_tela.cod_tipo_tela=tprecio_color.tipo_tela ORDER BY pre_col DESC ");
		}
public function precios($dato)
		{
			$this->consulta("SELECT nom_tela,can_tela,cod_tela,tipo_tela,pre_tela FROM tprecio_color WHERE cod_tela='$dato'");
		}	
public function act_precios()
		{
			$this->consulta("UPDATE tprecio_color SET pre_col='$this->c_precios' WHERE  cod_pre_col ='$this->c_codigos' ;");
		//true para validar if
			return true;
		}
public function bordado($fechahoy)
		{	//consulta sql de la base de datos
			$this->consulta("INSERT INTO totros (cod_bor,pre_bor,pre_bor_fuera,pre_cuello,fec_mod) VALUES 
 							('',  '$this->c_precio_bor', '$this->c_precio_bor_fuera' ,'$this->c_precio_cue' ,'$fechahoy');");
			//true para validar if
			return true;
		}


public function modificar()
		{
			$this->consulta("UPDATE ttela SET can_tela='$this->c_cantidad', pre_tela='$this-c_precio' WHERE  cod_tela ='$this->c_codigo' ;");
		//true para validar if
			return true;
		}
public function eliminar()
		{
			$this->consulta("UPDATE ttela SET estatus='1' WHERE cod_tela='$this->c_codigo'");
		//true para validar if
			return true;
		}
public function existencia()
		{
			$this->consulta("UPDATE  ttela SET  existencia =  '$this->c_existencia_act' WHERE CONVERT(  `ttela`.`cod_tela` USING utf8 ) =  '$this->c_codigo'");
		//true para validar if
			return true;
		}


public function id()
		{
			$this->consulta("SELECT MAX( cod_tela ) AS cod_tela FROM ttela");
		}
public function listar()
		{
			$this->consulta("SELECT * FROM ttela");
		}

public function row(){
	return $this->resultado->fetch_array();
}
public function rows(){
			return $this->resultado->num_rows;

		}


//--------------------------------------------------------------------
//       Fin de la clase
//--------------------------------------------------------------------
}
?>
