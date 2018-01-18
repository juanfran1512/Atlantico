<?php
include_once "../modelo/conexion_bd.php";
//--------------------------------------------------------------------
//       Clase para la gestion de Tela
//--------------------------------------------------------------------

class clsPrecioColor extends conexion_bd{
private $c_codigo;
private $c_nombre;
private $c_precio;
private $c_tela;

//para actualizar la existencia
//private $c_existencia_act;

//--------------------------------------------------------------------
//       Metodo para obtener los datos del controlador
//--------------------------------------------------------------------

public function manejar_datos($codigo,$nombre,$precio,$tela){

	$this->c_codigo=$codigo;
	$this->c_nombre=$nombre;
	$this->c_precio=$precio;
	$this->c_tela=$tela;

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
			$this->consulta("INSERT INTO tprecio_color (cod_pre_col,nom_pre_col,tipo_tela,pre_col) VALUES (
 '$this->c_codigo',  '$this->c_nombre',  '$this->c_tela',  '$this->c_precio');");
			//true para validar if
			return true;
		}

public function buscar()
		{
			$this->consulta("SELECT * FROM tprecio_color WHERE nom_pre_col='$this->c_nombre' AND tipo_tela='$this->c_tela'");
		}
public function buscar_like($dato)
		{
			$this->consulta("SELECT nom_pre_col,cod_pre_col,pre_col,tipo_tela,nom_tipo_tela FROM tprecio_color,ttipo_tela WHERE nom_pre_col LIKE  '".$dato."%' AND cod_tipo_tela=tipo_tela LIMIT 0 , 5");
		}

public function color($dato)
		{
			$this->consulta("SELECT * FROM tprecio_color WHERE cod_pre_col='$dato'");
		}
public function modificar()
		{
			$this->consulta("UPDATE tprecio_color SET nom_pre_col='$this->c_nombre',pre_col='$this->c_precio',tipo_tela='$this->c_tela' WHERE  cod_pre_col ='$this->c_codigo' ;");
		//true para validar if
			return true;
		}
public function eliminar()
		{
			$this->consulta("UPDATE tprecio_color SET estatus='1' WHERE cod_pre_col='$this->c_codigo'");
		//true para validar if
			return true;
		}



public function id()
		{
			$this->consulta("SELECT MAX( cod_pre_col ) AS cod_pre_col FROM tprecio_color");
		}
public function listar()
		{
			$this->consulta("SELECT * FROM tprecio_color");
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
