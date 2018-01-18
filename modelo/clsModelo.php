<?php
include_once "../modelo/conexion_bd.php";
//--------------------------------------------------------------------
//       Clase para la gestion de producto
//--------------------------------------------------------------------

class clsModelo extends conexion_bd{
private $c_codigo;
private $c_nombre;
private $c_costo;
private $c_status;
//para actualizar la existencia
//private $c_existencia_act;

//--------------------------------------------------------------------
//       Metodo para obtener los datos del controlador
//--------------------------------------------------------------------

public function manejar_datos($codigo,$nombre,$costo,$status){

	$this->c_codigo=$codigo;
	$this->c_nombre=$nombre;
	$this->c_costo=$costo;
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
			$this->consulta("INSERT INTO tmodelo (cod_mod,nom_mod,cos_mod) VALUES (
 '$this->c_codigo',  '$this->c_nombre',  '$this->c_costo');");
			//true para validar if
			return true;
		}

public function buscar()
		{
			$this->consulta("SELECT * FROM tmodelo WHERE cod_mod='$this->c_codigo'");
		}
public function buscar_like($dato)
		{
			$this->consulta("SELECT nom_mod,cod_mod,cos_mod FROM tmodelo WHERE nom_mod LIKE  '".$dato."%' LIMIT 0 , 5");
		}
public function modelo($dato)
		{
			$this->consulta("SELECT nom_mod,cos_mod,cod_mod FROM tmodelo WHERE cod_mod='$dato'");
		}		
public function modificar()
		{
			$this->consulta("UPDATE tmodelo SET nom_mod='$this->c_nombre', cos_mod='$this->c_costo' WHERE  cod_mod ='$this->c_codigo' ;");
		//true para validar if
			return true;
		}
public function eliminar()
		{
			$this->consulta("UPDATE tmodelo SET estatus='1' WHERE cod_mod='$this->c_codigo'");
		//true para validar if
			return true;
		}
public function existencia()
		{
			$this->consulta("UPDATE  tmodelo SET  existencia =  '$this->c_existencia_act' WHERE CONVERT(  `tmodelo`.`cod_mod` USING utf8 ) =  '$this->c_codigo'");
		//true para validar if
			return true;
		}


public function id()
		{
			$this->consulta("SELECT MAX( cod_mod ) AS cod_mod FROM tmodelo");
		}
public function listar()
		{
			$this->consulta("SELECT * FROM tmodelo");
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
