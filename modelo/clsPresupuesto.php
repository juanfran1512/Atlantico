<?php
include_once "../modelo/conexion_bd.php";
//--------------------------------------------------------------------
//       Clase para la gestion de presupuesto
//--------------------------------------------------------------------

class clsPresupuesto extends conexion_bd{
private $c_numero_presu;
private $c_fecha_presu;
private $c_fecha_ven;
private $c_fecha_ent;
private $c_tipo_pago;
private $c_estatus_pre;
private $c_cli_presu;
private $c_ela_presu;
private $c_abono;
private $c_restante;
private $c_total_pre;
private $c_fecha_anu;
private $c_usuario_anu;
private $c_codigos_pro;
private $c_cantidades_pro;
private $c_bordado_pros;
private $c_precios_bordado_pro;
private $c_con_iva_pros;
private $c_sin_iva_pros;
private $c_total_pros;
private $c_val_iva;
private $c_monto_iva;

//--------------------------------------------------------------------
//       Metodo para obtener los datos del controlador
//--------------------------------------------------------------------

public function manejar_datos($numero_presu,$fecha_presu,$fecha_ven,$fecha_ent,$tipo_pago,$estatus_pre,$cli_presu,$ela_presu,$abono,$restante,$total_pre,$fecha_anu,$usuario_anu,$monto_iva,$sub_total,$val_iva){

	$this->c_numero_presu=$numero_presu;
	$this->c_fecha_presu=$fecha_presu;
	$this->c_fecha_ven=$fecha_ven;
	$this->c_fecha_ent=$fecha_ent;
	$this->c_tipo_pago=$tipo_pago;
	$this->c_estatus_pre=$estatus_pre;
	$this->c_cli_presu=$cli_presu;
	$this->c_ela_presu=$ela_presu;
	$this->c_abono=$abono;
	$this->c_restante=$restante;
	$this->c_total_pre=$total_pre;
	$this->c_monto_iva=$monto_iva;
	$this->c_sub_total=$sub_total;
	$this->c_val_iva=$val_iva;
	$this->c_fecha_anu=$fecha_anu;
	$this->c_usuario_anu=$usuario_anu;
}
public function manejar_detalle($numero_presu,$codigos_pro,$cantidades_pro,$bordado_pros,$precios_bordado_pro,$con_iva_pros,$sin_iva_pros,$total_pros){
	
	$this->c_numero_presu=$numero_presu;
	$this->c_codigos_pro=$codigos_pro;
	$this->c_cantidades_pro=$cantidades_pro;
	$this->c_bordado_pros=$bordado_pros;
	$this->c_precios_bordado_pro=$precios_bordado_pro;
	$this->c_con_iva_pros=$con_iva_pros;
	$this->c_sin_iva_pros=$sin_iva_pros;
	$this->c_total_pros=$total_pros;
}
public function usar_npresupuesto($numero_presu){
	$this->c_numero_presu=$numero_presu;
}

public function reportepdf($numero_presu){

	$this->c_numero_presu=$numero_presu;

}

//--------------------------------------------------------------------
//       Funciones SQL
//--------------------------------------------------------------------

public function registrar()
		{	//consulta sql de la base de datos		
			$this->consulta("INSERT INTO  tpresupuesto (cod_presu ,cli_presu,fec_presu,ven_presu,fec_ent,ela_presu ,tipo_pago ,abo_pre,res_pre ,sub_total_presu,val_iva,monto_iva_presu,tot_presu ,est_pre,fec_anu ,usu_anu)
			VALUES (
			'$this->c_numero_presu',   '$this->c_cli_presu' , '$this->c_fecha_presu','$this->c_fecha_ven','$this->c_fecha_ent', '$this->c_ela_presu' ,'$this->c_tipo_pago',  '$this->c_abono'  ,'$this->c_restante', '$this->c_sub_total', '$this->c_val_iva',  '$this->c_monto_iva', '$this->c_total_pre' ,'$this->c_estatus_pre',  NULL , NULL);");
			//true para validar if
						return true;
		}
public function registrar_detalle()
		{	
			//consulta sql de la base de datos		
			$this->consulta("INSERT INTO  tdetallepresupuesto (presupuesto ,cod_det_pre ,cod_pro ,can_pro ,bordados,pre_bor,cos_iva,cos_sin_iva,cos_total) 
				VALUES ('$this->c_numero_presu','' , '$this->c_codigos_pro',  '$this->c_cantidades_pro',  '$this->c_bordado_pros',  '$this->c_precios_bordado_pro',  '$this->c_con_iva_pros','$this->c_sin_iva_pros',  '$this->c_total_pros');");
			//true para validar if
						return true;
		}
public function buscar()
		{
			$this->consulta("SELECT * FROM tpresupuesto, tcliente WHERE cod_presu ='$this->c_numero_presu'
				AND tpresupuesto.cli_presu = tcliente.rif_cli" );
			//true para validar if
			return true;
		}
public function buscar_detalle()
		{
			$this->consulta("SELECT * FROM tdetallepresupuesto, tproducto WHERE presupuesto ='$this->c_numero_presu'
				AND tdetallepresupuesto.cod_pro = tproducto.cod_pro" );
			//true para validar if
			return true;
		}

public function recargar_detalle($dato)
		{
			$this->consulta("SELECT * FROM tdetallepresupuesto, tproducto, ttalla WHERE presupuesto ='".$dato."'
				AND tdetallepresupuesto.cod_pro = tproducto.cod_pro
				AND ttalla.cod_talla=tproducto.talla" );
			//true para validar if
			return true;
		}
public function buscar_presupuestoydetalle()
		{
			$this->consulta("SELECT * FROM tpresupuesto, tdetallepresupuesto, tcliente,tproducto, tzona, tusuario 
				WHERE tpresupuesto.cod_presu='$this->c_numero_presu'
				AND tpresupuesto.cod_presu = tdetallepresupuesto.presupuesto
				AND tpresupuesto.cli_presu = tcliente.rif_cli
				AND tdetallepresupuesto.cod_pro = tproducto.cod_pro
				AND tzona.cod_zona = tcliente.zona_fk
				AND tpresupuesto.ela_presu = tusuario.ced_usu");
		}
public function buscar_lista($dato)
		{
			$this->consulta("SELECT nom_cli,cod_presu,fec_presu,ven_presu,fec_ent,fec_mod,tipo_pago,abo_pre,res_pre,tot_presu
			 FROM tpresupuesto,tcliente WHERE tpresupuesto.est_pre='".$dato."' AND tpresupuesto.cli_presu=tcliente.rif_cli LIMIT 0 , 5 ");
		}
public function modificar()
		{
			$this->consulta("UPDATE tpresupuesto SET fec_presu='$this->c_fecha_presu', ven_presu='$this->c_fecha_ven', fec_ent='$this->c_fecha_ent', tipo_pago='$this->c_tipo_pago', abo_pre='$this->c_abono', res_pre='$this->c_restante' , est_pre='$this->c_estatus_pre' , sub_total_presu='$this->c_sub_total', monto_iva_presu='$this->c_monto_iva',val_iva='$this->c_val_iva', tot_presu='$this->c_total_pre' WHERE  cod_presu ='$this->c_numero_presu' ;");
		//true para validar if
			return true;
		}
public function borrar_detalle()
		{
			$this->consulta("DELETE FROM tdetallepresupuesto WHERE presupuesto='$this->c_numero_presu';");
		//true para validar if
			return true;
		}
public function eliminar()
		{
			$this->consulta("UPDATE tpresupuesto SET est_art='1' WHERE id_art='$this->c_numero_presu'");
		//true para validar if
			return true;
		}
public function id()
		{
			$this->consulta("SELECT MAX( cod_presu ) AS id FROM tpresupuesto");
		}
public function listar()
		{
			$this->consulta("SELECT nom_cli,cod_presu,fec_presu,ven_presu,fec_ent,fec_mod,tipo_pago,abo_pre,res_pre,tot_presu,est_pre
			 FROM tpresupuesto,tcliente WHERE tpresupuesto.cli_presu=tcliente.rif_cli ORDER BY fec_mod ASC LIMIT 0 , 10 ");
		}

public function row(){
	return $this->resultado->fetch_array();
}
public function row2(){
	return $this->resultado->fetch_array();
}
public function rows(){
			return $this->resultado->num_rows;

		}
public function combo($codigo){
	$this->consulta("SELECT cod_mod,nom_mod FROM tmodelo WHERE cod_pro = '$codigo' ORDER BY nom_mod");
}
//--------------------------------------------------------------------
//       Fin de la clase
//--------------------------------------------------------------------
}
?>
