<?php
    /*
     * Clase para manejar la conexión de los datos
    */
class conexion_bd{

protected $bd="bd_atlantico", $resultado, $con;
public $error=false;
//--------------------------------------------------------------------
//       Metodo para conectar a las base de datos
//--------------------------------------------------------------------
public function __construct(){
			$this->con = new mysqli("localhost","root","","bd_atlantico");
			if($this->con->connect_error){
				die("problemas con la concexion");
			}
		}
//--------------------------------------------------------------------
//       Metodo para consultar el sql
//--------------------------------------------------------------------
protected function consulta($sql){
	//echo $sql;
	$this->resultado=$this->con->query($sql);
	if(!$this->resultado){
	echo 'error en el query SQL:  '. $this->con->error;
		$this->error=true;

	} 
}

//--------------------------------------------------------------------
//       Fin de la clase
//--------------------------------------------------------------------
}
?>