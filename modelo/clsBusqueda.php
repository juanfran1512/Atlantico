<?php
include_once "../modelo/conexion_bd.php";
//--------------------------------------------------------------------
//       Clase para la gestion de producto
//--------------------------------------------------------------------

class clsBusqueda extends conexion_bd{
private $c_codigo;
private $c_nombre;
private $c_pvp;
private $c_paquete;
private $c_existencia;
private $c_cant_x_paquete;
private $c_status;
//para actualizar la existencia
private $c_existencia_act;

//--------------------------------------------------------------------
//       Metodo para obtener los datos del controlador
//--------------------------------------------------------------------

public function manejar_datos($codigo,$nombre,$pvp,$paquete,$cant_x_paquete,$existencia,$status){

	$this->c_codigo=$codigo;
	$this->c_nombre=$nombre;
	$this->c_pvp=$pvp;
	$this->c_paquete=$paquete;
	$this->c_cant_x_paquete=$cant_x_paquete;
	$this->c_existencia=$existencia;
	$this->c_status=$status;
}

/*public function datos_exis($codigo,$exis_cestas){
	$this->c_codigo=$codigo;
	$this->c_exis_cestas=$exis_cestas;
}*/

//--------------------------------------------------------------------
//       Funciones SQL
//--------------------------------------------------------------------


public function buscar_proveedor($dato)
		{
			$this->consulta("SELECT nom_pro,existencia,cant_x_paquete,paquete,pvp_pro,cod_pro FROM tproducto WHERE nom_pro LIKE  '".$dato."%' LIMIT 0 , 5");
		}
public function buscar_producto($dato)
		{
			$this->consulta("SELECT nom_pro,existencia,cant_x_paquete,paquete,pvp_pro,cod_pro FROM tproducto WHERE nom_pro LIKE  '".$dato."%' LIMIT 0 , 5");
		}
public function producto($dato)
		{
			$this->consulta("SELECT nom_pro,existencia,cant_x_paquete,paquete,pvp_pro,cod_pro FROM tproducto WHERE cod_pro='$dato'");
		}		

public function existencia()
		{
			$this->consulta("UPDATE  tproducto SET  existencia =  '$this->c_existencia_act' WHERE CONVERT(  `tproducto`.`cod_pro` USING utf8 ) =  '$this->c_codigo'");
		//true para validar if
			return true;
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
