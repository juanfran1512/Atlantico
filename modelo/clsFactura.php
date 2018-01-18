<?php
include_once "../modelo/conexion_bd.php";
//--------------------------------------------------------------------
//       Clase para la gestion de Factura
//--------------------------------------------------------------------

class clsFactura extends conexion_bd{
private $c_numero_fac;
private $c_fecha_fac;
private $c_fecha_ven;
private $c_tipo_com;
private $c_status_fac;
private $c_cliente_fac;
private $c_usuario_fac;
private $c_chofer_fac;
private $c_placa_fac;
private $c_total_fac;
private $c_fecha_anu;
private $c_usuario_anu;

//--------------------------------------------------------------------
//       Metodo para obtener los datos del controlador
//--------------------------------------------------------------------

public function manejar_datos($numero_fac,$fecha_fac,$fecha_ven,$tipo_com,$status_fac,$cliente_fac,$usuario_fac,$chofer_fac,$placa_fac,$total_fac,$fecha_anu,$usuario_anu){

	$this->c_numero_fac=$numero_fac;
	$this->c_fecha_fac=$fecha_fac;
	$this->c_fecha_ven=$fecha_ven;
	$this->c_tipo_com=$tipo_com;
	$this->c_status_fac=$status_fac;
	$this->c_cliente_fac=$cliente_fac;
	$this->c_usuario_fac=$usuario_fac;
	$this->c_chofer_fac=$chofer_fac;
	$this->c_placa_fac=$placa_fac;
	$this->c_total_fac=$total_fac;
	$this->c_fecha_anu=$fecha_anu;
	$this->c_usuario_anu=$usuario_anu;
}

public function reportepdf($numero_fac){

	$this->c_numero_fac=$numero_fac;
}

//--------------------------------------------------------------------
//       Funciones SQL
//--------------------------------------------------------------------

public function registrar()
		{	//consulta sql de la base de datos		
			$this->consulta("INSERT INTO  tfactura (nro_fac ,fec_fac,fec_ven ,tip_com ,est_fac,cliente_fk ,usuario_fk,chofer_fk,placa_fac ,tot_fac,fec_anu ,usu_anu)
			VALUES (
			'$this->c_numero_fac',  '$this->c_fecha_fac','$this->c_fecha_ven',  '$this->c_tipo_com',  '$this->c_status_fac',  '$this->c_cliente_fac',  '$this->c_usuario_fac','$this->c_chofer_fac', '$this->c_placa_fac',  '$this->c_total_fac',   NULL , NULL);");
			//true para validar if
						return true;
		}
public function buscar()
		{
			$this->consulta("SELECT * FROM tfactura, tcliente,tchofer,tzona,tmunicipio WHERE nro_fac ='$this->c_numero_fac'
				AND tfactura.cliente_fk = tcliente.rif_cli
				AND tfactura.chofer_fk = tchofer.rif_chof 
				AND tzona.cod_zona = tcliente.zona_fk
				AND tmunicipio.cod_muni = tcliente.municipio_fk" );
			//true para validar if
			return true;
		}

public function buscar_facturaydetalle()
		{
			$this->consulta("SELECT * FROM tfactura, tdetallefactura, tcliente,tproducto, tzona, tusuario 
				WHERE tfactura.nro_fac='$this->c_numero_fac'
				AND tfactura.nro_fac = tdetallefactura.factura
				AND tfactura.cliente_fk = tcliente.rif_cli
				AND tdetallefactura.producto = tproducto.cod_pro
				AND tzona.cod_zona = tcliente.zona_fk
				AND tfactura.usuario_fk = tusuario.ced_usu");
		}

public function modificar()
		{
			$this->consulta("UPDATE tfactura SET nom_art='$this->c_nombre', est_art='$this->c_usuario_fac' WHERE  id_art ='$this->c_numero_fac' ;");
		//true para validar if
			return true;
		}
public function eliminar()
		{
			$this->consulta("UPDATE tfactura SET est_art='1' WHERE id_art='$this->c_numero_fac'");
		//true para validar if
			return true;
		}
public function id()
		{
			$this->consulta("SELECT MAX( id_art ) AS id_art FROM tfactura");
		}
public function listar()
		{
			$this->consulta("SELECT * FROM tfactura");
		}

public function row(){
	return $this->resultado->fetch_array();
}
public function rows(){
			return $this->resultado->num_rows();

		}

//--------------------------------------------------------------------
//       Fin de la clase
//--------------------------------------------------------------------
}
?>
