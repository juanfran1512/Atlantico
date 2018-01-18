<?php
include_once "../modelo/conexion_bd.php";
//--------------------------------------------------------------------
//       Clase para la gestion de Zona
//--------------------------------------------------------------------

class clsZona extends conexion_bd{
		public $cod_zona,$des_zona;

		public function listarzona(){
			return parent::consulta("SELECT * FROM tzona");
		}
		
		public function listarmunicipio($zona_fk){
			return parent::consulta("SELECT * FROM tmunicipio where zona_fk='$zona_fk'  " );
         
		}
		public function row(){
	return $this->resultado->fetch_array();
}

		//--------------------------------------------------------------------
		//       Fin de la clase
		//--------------------------------------------------------------------

	}
?>
