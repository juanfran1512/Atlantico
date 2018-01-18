<?php
include_once "../modelo/conexion_bd.php";
//--------------------------------------------------------------------
//       Clase para la gestion de Proveedor
//--------------------------------------------------------------------

class clsProveedor extends conexion_bd{
private $c_rif;
private $c_nombre;
private $c_telefono;
private $c_persona;
private $c_direccion;
private $c_correo;
private $c_codigo;
private $c_status;

//--------------------------------------------------------------------
//       Metodo para obtener los datos del controlador
//--------------------------------------------------------------------

public function manejar_datos($rif,$nombre,$telefono,$persona,$direccion,$correo,$codigo,$status){

	$this->c_rif=$rif;
	$this->c_nombre=$nombre;
	$this->c_telefono=$telefono;
	$this->c_persona=$persona;
	$this->c_direccion=$direccion;
	$this->c_correo=$correo;
	$this->c_codigo=$codigo;
	$this->c_status=$status;
}

//--------------------------------------------------------------------
//       Funciones SQL
//--------------------------------------------------------------------

public function registrar()
		{	//consulta sql de la base de datos
			$this->consulta("INSERT INTO tproveedor (cod_prov,rif_prov,nom_prov,tlfn_prov,pers_prov,dir_prov,correo_prov,est_prov) VALUES (
 '$this->c_codigo' , '$this->c_rif',  '$this->c_nombre',  '$this->c_telefono',  '$this->c_persona',  '$this->c_direccion', '$this->c_correo', '$this->c_status');");
			//true para validar if
			return true;
		}

public function buscar()
		{
			$this->consulta("SELECT * FROM tproveedor WHERE rif_prov='$this->c_rif'");
		}
public function buscar_like($dato)
		{
			$this->consulta("SELECT cod_prov,nom_prov,rif_prov FROM tproveedor WHERE nom_prov LIKE '%".$dato."%' or rif_prov LIKE '".$dato."%' or cod_prov LIKE '".$dato."%' LIMIT 0 , 5");
		}
public function proveedor($dato)
		{
			$this->consulta("SELECT * FROM tproveedor WHERE cod_prov='$dato'");
		}	
public function modificar()
		{
			$this->consulta("UPDATE tproveedor SET rif_prov='$this->c_rif', nom_prov='$this->c_nombre',tlfn_prov='$this->c_telefono',pers_prov='$this->c_persona',dir_prov='$this->c_direccion',correo_prov='$this->c_correo' WHERE  rif_prov ='$this->c_rif' ;");
		//true para validar if
			return true;
		}
public function eliminar()
		{
			$this->consulta("UPDATE tproveedor SET rif_prov='1' WHERE rif_prov='$this->c_rif'");
		//true para validar if
			return true;
		}
public function id()
		{
			$this->consulta("SELECT MAX( rif_prov ) AS rif_prov FROM tproveedor");
		}
public function listar()
		{
			$this->consulta("SELECT * FROM tproveedor");
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
