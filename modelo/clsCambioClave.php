<?php
include_once "../modelo/conexion_bd.php";
//--------------------------------------------------------------------
//       Clase para la gestion de Cargo
//--------------------------------------------------------------------

class clsCambioClave extends conexion_bd{
private $c_id;
private $c_pass;
private $c_pregunta1;
private $c_pregunta2;
private $c_respuesta1;
private $c_respuesta2;
private $c_cedula;

//--------------------------------------------------------------------
//       Metodo para obtener los datos del controlador
//--------------------------------------------------------------------

public function manejar_datos($id,$pass,$pregunta1,$pregunta2,$respuesta1,$respuesta2,$cedula){

	$this->c_id=$id;
	$this->c_pass=$pass;
	$this->c_pregunta1=$pregunta1;
	$this->c_pregunta2=$pregunta2;
	$this->c_respuesta1=$respuesta1;
	$this->c_respuesta2=$respuesta2;
	$this->c_cedula=$cedula;
}

//--------------------------------------------------------------------
//       Funciones SQL
//--------------------------------------------------------------------

public function modificarprimero()
		{
			$this->consulta("UPDATE tusuario SET con_usu='$this->c_pass',pregunta1='$this->c_pregunta1',
			pregunta2='$this->c_pregunta2',respuesta1='$this->c_respuesta1',respuesta2='$this->c_respuesta2' WHERE  ced_usu ='$this->c_id' ");
			return true;
		}
public function modificarclave()
		{
			$this->consulta("UPDATE tusuario SET con_usu='$this->c_pass' WHERE  ced_usu ='$this->c_id' ");
		//true para validar if
			return true;
		}
public function modificarpreguntas()
		{
			$this->consulta("UPDATE tusuario SET pregunta1='$this->c_pregunta1',
			pregunta2='$this->c_pregunta2',respuesta1='$this->c_respuesta1',respuesta2='$this->c_respuesta2'
			WHERE  ced_usu ='$this->c_id' AND con_usu='$this->c_pass' ");
		//true para validar if
			return true;
		}
public function traerpregunta($ced)
		{
			$this->consulta("SELECT pregunta1,pregunta2 FROM tusuario WHERE ced_usu='$ced'");
			return true;
		}
public function olvidocontrasena()
		{
     	//consulta sql de la base de datos  " SELECT * FROM tusuario, tpersona WHERE tpersona.nom_per =  '$this->c_nombre' AND tusuario.con_usu =  '$this->c_pass' AND tpersona.ced_per = tusuario.ced_per "
			$this->consulta(" SELECT ced_usu FROM tusuario WHERE ced_usu =  '$this->c_$cedula' AND respuesta1='$this->c_respuesta1' AND respuesta2='$this->c_respuesta2'");
		//true para validar if
			return true;
	    }
public function correctas()
		{
			$this->consulta("UPDATE tusuario SET est_usu=2 WHERE ced_usu='$this->c_$cedula'");
		}
public function restaurarclave()
		{
			$this->consulta("UPDATE tusuario SET con_usu='$this->c_pass',cont_cla=0,est_usu=0 WHERE ced_usu ='$this->c_cedula' AND est_usu=2");
			return true;
		}
public function buscar()
		{
			$this->consulta("SELECT * FROM tusuario WHERE ced_usu='$this->c_id'");
		}

public function row(){
	return $this->resultado->fetch_array();
}

//--------------------------------------------------------------------
//       Fin de la clase
//--------------------------------------------------------------------
}
?>
