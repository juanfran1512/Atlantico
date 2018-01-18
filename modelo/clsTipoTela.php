<?php
include_once "../modelo/conexion_bd.php";
//--------------------------------------------------------------------
//       Clase para la gestion de Tela
//--------------------------------------------------------------------

class clsTipoTela extends conexion_bd{
private $c_codigo;
private $c_nombre;
private $c_precio;
private $c_pieza;
private $c_operador;
private $c_status;
//para actualizar la existencia
//private $c_existencia_act;

//--------------------------------------------------------------------
//       Metodo para obtener los datos del controlador
//--------------------------------------------------------------------

public function manejar_datos($codigo,$nombre,$precio,$pieza,$operador,$status){

	$this->c_codigo=$codigo;
	$this->c_nombre=$nombre;
	$this->c_precio=$precio;
	$this->c_pieza=$pieza;
	$this->c_operador=$operador;
	$this->c_status=$status;
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
			$this->consulta("INSERT INTO ttipo_tela (cod_tipo_tela,nom_tipo_tela,pre_tipo_tela,can_uso_tela,ope_tela) VALUES (
 '$this->c_codigo',  '$this->c_nombre','$this->c_precio','$this->c_pieza','$this->c_operador');");
			//true para validar if
			return true;
		}

public function buscar()
		{
			$this->consulta("SELECT * FROM ttipo_tela WHERE nom_tipo_tela='$this->c_nombre'");
		}
public function buscar_like($dato)
		{
			$this->consulta("SELECT * FROM ttipo_tela WHERE nom_tipo_tela LIKE  '".$dato."%' LIMIT 0 , 5");
		}
public function tela($dato)
		{
			$this->consulta("SELECT * FROM ttipo_tela WHERE cod_tipo_tela='$dato'");
		}		
public function modificar()
		{
			$this->consulta("UPDATE ttipo_tela SET nom_tipo_tela='$this->c_nombre', pre_tipo_tela='$this->c_precio', can_uso_tela='$this->c_pieza',ope_tela='$this->c_operador' WHERE  nom_tipo_tela ='$this->c_nombre' ;");
		//true para validar if
			return true;
		}
public function eliminar()
		{
			$this->consulta("UPDATE ttipo_tela SET estatus='1' WHERE cod_tipo_tela='$this->c_codigo'");
		//true para validar if
			return true;
		}
public function existencia()
		{
			$this->consulta("UPDATE  ttipo_tela SET  existencia =  '$this->c_existencia_act' WHERE CONVERT(  `ttipo_tela`.`cod_tipo_tela` USING utf8 ) =  '$this->c_codigo'");
		//true para validar if
			return true;
		}


public function id()
		{
			$this->consulta("SELECT MAX( cod_tipo_tela ) AS cod_tipo_tela FROM ttipo_tela");
		}
public function listar()
		{
			$this->consulta("SELECT * FROM ttipo_tela");
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
