<?php
include_once "../modelo/conexion_bd.php";
//--------------------------------------------------------------------
//       Clase para la gestion de Detalle factura
//--------------------------------------------------------------------

class clsDetalleFactura extends conexion_bd{
private $c_numero_fac;
private $c_codigos_pro;
private $c_cantidades_pro;
private $c_precios_pro;
private $c_pesob_pro;
private $c_peson_pro;
private $c_totales_pro;

//--------------------------------------------------------------------
//       Metodo para obtener los datos del controlador
//--------------------------------------------------------------------

public function manejar_datos($numero_fac,$codigos_pro,$cantidades_pro,$precios_pro,$pesob_pro,$peson_pro,$totales_pro){

		$this->c_numero_fac=$numero_fac;
		$this->c_codigos_pro=$codigos_pro;
		$this->c_cantidades_pro=$cantidades_pro;
		$this->c_precios_pro=$precios_pro;
		$this->c_pesob_pro=$pesob_pro;
		$this->c_peson_pro=$peson_pro;
		$this->c_totales_pro=$totales_pro;

}
public function usar_nfactura($numero_fac){
	$this->c_numero_fac=$numero_fac;
}


//--------------------------------------------------------------------
//       Funciones SQL
//--------------------------------------------------------------------

public function registrar()
		{	
			//consulta sql de la base de datos		
			$this->consulta("INSERT INTO  tdetallefactura (factura ,producto ,can_ven_pro ,pre_ven_pro ,pesob_pro ,peson_pro ,tot_pro)
			VALUES (
			'$this->c_numero_fac',  '$this->c_codigos_pro',  '$this->c_cantidades_pro',  '$this->c_precios_pro',  '$this->c_pesob_pro',  '$this->c_peson_pro',  '$this->c_totales_pro');");
			//true para validar if
						return true;
		}

public function buscar()
		{
			$this->consulta("SELECT * FROM tdetallefactura,tproducto WHERE factura='$this->c_numero_fac' and producto=cod_pro");
		}

public function modificar()
		{
			$this->consulta("UPDATE tdetallefactura SET nom_art='$this->c_nombre', est_art='$this->c_usuario_fac' WHERE  id_art ='$this->c_numero_fac' ;");
		//true para validar if
			return true;
		}
public function eliminar()
		{
			$this->consulta("UPDATE tdetallefactura SET est_art='1' WHERE id_art='$this->c_numero_fac'");
		//true para validar if
			return true;
		}
public function id()
		{
			$this->consulta("SELECT MAX( id_art ) AS id_art FROM tdetallefactura");
		}
public function listar()
		{
			$this->consulta("SELECT * FROM tdetallefactura");
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