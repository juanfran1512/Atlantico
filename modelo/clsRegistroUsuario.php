<?php
include_once "../modelo/conexion_bd.php";
//--------------------------------------------------------------------
//       Clase para la gestion de Cargo
//--------------------------------------------------------------------

class clsRegistroUsuario extends conexion_bd{

private $c_contrasena;
private $c_tipo;
private $c_cedula;
private $c_status;

//--------------------------------------------------------------------
//       Metodo para obtener los datos del controlador
//--------------------------------------------------------------------

public function manejar_datos($cedula,$contrasena,$tipo,$status){

	$this->c_cedula=$cedula;
	$this->c_contrasena=$contrasena;
	$this->c_tipo=$tipo;
	$this->c_status=$status;
}

//--------------------------------------------------------------------
//       Funciones SQL
//--------------------------------------------------------------------

public function registrar()
		{	//consulta sql de la base de datos
			$this->consulta("INSERT INTO  tusuario (ced_usu,con_usu,tip_usu,est_usu )
				VALUES ('$this->c_cedula','$this->c_contrasena','$this->c_tipo','0');");
			//true para validar if
			return true;
		}

public function buscar()
		{
			$this->consulta("SELECT * FROM tusuario WHERE ced_usu='$this->c_cedula'");
		}

public function modificar()
		{
			$this->consulta("UPDATE tusuario SET tip_usu='$this->c_tipo', est_usu='$this->c_status' WHERE  ced_usu ='$this->c_cedula' ;");
		//true para validar if
			return true;
		}
public function eliminar()
		{
			$this->consulta("UPDATE tusuario SET est_usu='1' WHERE ced_usu='$this->c_cedula'");
		//true para validar if
			return true;
		}

public function row(){
	return $this->resultado->fetch_array();
}


//--------------------------------------------------------------------
//       Fin de la clase
//--------------------------------------------------------------------
}
?>
