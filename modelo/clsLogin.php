<?php
include_once "modelo/conexion_bd.php";
//--------------------------------------------------------------------
//       Clase para la gestion de Logeo
//--------------------------------------------------------------------

class claseLogin extends conexion_bd{
private $c_usuario;
private $c_pass;

//--------------------------------------------------------------------
//       Metodo para obtener los datos del controlador
//--------------------------------------------------------------------

public function manejar_datos($usuario,$pass){

	$this->c_usuario=$usuario;
	$this->c_pass=$pass;
}
//--------------------------------------------------------------------
//       Metodo Buscar usuario para darle acceso
//--------------------------------------------------------------------
     public function buscaAcceso(){
     	//consulta sql de la base de datos  " SELECT * FROM tusuario, tpersona WHERE tpersona.nom_per =  '$this->c_nombre' AND tusuario.con_usu =  '$this->c_pass' AND tpersona.ced_per = tusuario.ced_per "
		parent::consulta(" SELECT * FROM tusuario WHERE nick_usu ='$this->c_usuario' AND con_usu =  '$this->c_pass' AND est_usu=0");
		//true para validar if	return true;
     }
public function fallido($contclave){
			$this->consulta(" UPDATE tusuario SET cont_cla = '$contclave' where nick_usu='$this->c_usuario'");
		}
public function excedido($contclave){
			$this->consulta(" UPDATE tusuario SET cont_cla = '$contclave', est_usu=1 where nick_usu='$this->c_usuario'");
		}
public function restart(){
			$this->consulta(" UPDATE tusuario SET cont_cla = 0 where nick_usu='$this->c_usuario'");
		}
public function id(){
			$this->consulta("SELECT cont_cla FROM tusuario WHERE nick_usu = '$this->c_usuario'");
}

public function row(){
	return $this->resultado->fetch_array();
}



//--------------------------------------------------------------------
//       Fin de la clase
//--------------------------------------------------------------------
}
?>
