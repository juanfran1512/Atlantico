<?php
include_once "../modelo/conexion_bd.php";
//--------------------------------------------------------------------
//       Clase para la gestion de producto
//--------------------------------------------------------------------

class clsTipoProducto extends conexion_bd{
private $c_codigo;
private $c_nombre;
private $c_status;
//para actualizar la existencia
//private $c_existencia_act;

//--------------------------------------------------------------------
//       Metodo para obtener los datos del controlador
//--------------------------------------------------------------------

public function manejar_datos($codigo,$nombre,$status){

	$this->c_codigo=$codigo;
	$this->c_nombre=$nombre;
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
			$this->consulta("INSERT INTO ttipo_producto (cod_tip_pro,nom_tip) VALUES (
 '$this->c_codigo',  '$this->c_nombre');");
			//true para validar if
			return true;
		}

public function buscar()
		{
			$this->consulta("SELECT * FROM ttipo_producto WHERE nom_tip='$this->c_nombre'");
		}
public function buscar_like($dato)
		{
			$this->consulta("SELECT nom_tip,cod_tip_pro FROM ttipo_producto WHERE nom_tip LIKE  '".$dato."%' LIMIT 0 , 5");
		}
public function tipo($dato)
		{
			$this->consulta("SELECT nom_tip,cod_tip_pro FROM ttipo_producto WHERE cod_tip_pro='$dato'");
		}		
public function modificar()
		{
			$this->consulta("UPDATE ttipo_producto SET nom_pro='$this->c_nombre', estatus='$this->c_status' WHERE  cod_tip_pro ='$this->c_codigo' ;");
		//true para validar if
			return true;
		}
public function eliminar()
		{
			$this->consulta("UPDATE ttipo_producto SET estatus='1' WHERE cod_tip_pro='$this->c_codigo'");
		//true para validar if
			return true;
		}
public function existencia()
		{
			$this->consulta("UPDATE  ttipo_producto SET  existencia =  '$this->c_existencia_act' WHERE CONVERT(  `ttipo_producto`.`cod_tip_pro` USING utf8 ) =  '$this->c_codigo'");
		//true para validar if
			return true;
		}


public function id()
		{
			$this->consulta("SELECT MAX( cod_tip_pro ) AS cod_tip_pro FROM ttipo_producto");
		}
public function listar()
		{
			$this->consulta("SELECT * FROM ttipo_producto");
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
