<?php
include_once "../modelo/conexion_bd.php";
//--------------------------------------------------------------------
//       Clase para la gestion de Cliente
//--------------------------------------------------------------------

class clsCliente extends conexion_bd{
private $c_codigo;
private $c_rif;
private $c_nombre;
private $c_telefono;
private $c_persona;
private $c_correo;
private $c_direccion;
private $c_zona;
private $c_muni;

//--------------------------------------------------------------------
//       Metodo para obtener los datos del controlador
//--------------------------------------------------------------------

public function manejar_datos($codigo,$rif,$nombre,$telefono,$persona,$correo,$direccion,$zona,$municipio){

	$this->c_codigo=$codigo;
	$this->c_rif=$rif;
	$this->c_nombre=$nombre;
	$this->c_telefono=$telefono;
	$this->c_persona=$persona;
	$this->c_correo=$correo;
	$this->c_direccion=$direccion;
	$this->c_zona=$zona;
	$this->c_muni=$municipio;
}

//--------------------------------------------------------------------
//       Funciones SQL
//--------------------------------------------------------------------

public function registrar()
		{	//consulta sql de la base de datos
			$this->consulta("INSERT INTO tcliente (cod_cli,rif_cli,nom_cli,tlfn_cli,pers_cli,correo_cli,dir_cli,zona_fk,municipio_fk) VALUES (
 '$this->c_codigo' ,'$this->c_rif',  '$this->c_nombre',  '$this->c_telefono','$this->c_persona', '$this->c_correo' , '$this->c_direccion','$this->c_zona','$this->c_muni');");
			//true para validar if
			return true;
		}

public function buscar()
		{
			$this->consulta("SELECT * FROM tcliente WHERE rif_cli='$this->c_rif'");
		}
public function buscar_like($dato)
		{
			$this->consulta("SELECT cod_cli,nom_cli,rif_cli FROM tcliente WHERE nom_cli LIKE '%".$dato."%' or rif_cli LIKE '".$dato."%' or cod_cli LIKE '".$dato."%' LIMIT 0 , 5");
		}
public function cliente($dato)
		{
			$this->consulta("SELECT * FROM tcliente WHERE cod_cli='$dato'");
		}	
public function modificar()
		{
			$this->consulta("UPDATE tcliente SET rif_cli='$this->c_rif', nom_cli='$this->c_nombre', tlfn_cli='$this->c_telefono',pers_cli='$this->c_persona' , correo_cli='$this->c_correo' ,dir_cli='$this->c_direccion', zona_fk='$this->c_zona', municipio_fk='$this->c_muni' WHERE  rif_cli ='$this->c_rif' ;");
		//true para validar if

			return true;
		}
public function eliminar()
		{
			$this->consulta("UPDATE tcliente SET est_art='1' WHERE id_art='$this->c_rif'");
		//true para validar if
			return true;
		}
public function id()
		{
			$this->consulta("SELECT MAX( id_art ) AS id_art FROM tcliente");
		}
public function listar()
		{
			$this->consulta("SELECT * FROM tcliente");
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
