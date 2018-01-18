<?php
include_once "../modelo/conexion_bd.php";
//--------------------------------------------------------------------
//       Clase para la gestion de producto
//--------------------------------------------------------------------

class clsProducto extends conexion_bd{
private $c_codigo;
private $c_nombre;
private $c_tela;
private $c_modelo;
private $c_tipo;
private $c_precio;
private $c_talla;
private $c_manga;
private $c_status;
//para actualizar la existencia
//private $c_existencia_act;

//--------------------------------------------------------------------
//       Metodo para obtener los datos del controlador
//--------------------------------------------------------------------

public function manejar_datos($codigo,$nombre,$modelo,$tela,$tipo,$precio,$talla,$manga,$status){

	$this->c_codigo=$codigo;
	$this->c_nombre=$nombre;
	$this->c_modelo=$modelo;
	$this->c_tela=$tela;
	$this->c_tipo=$tipo;
	$this->c_precio=$precio;
	$this->c_talla=$talla;
	$this->c_manga=$manga;
	$this->c_status=$status;
}

/*public function datos_exis($codigo,$exis_cestas){
	$this->c_codigo=$codigo;
	$this->c_exis_cestas=$exis_cestas;
}*/

//--------------------------------------------------------------------
//       Funciones SQL
//--------------------------------------------------------------------

public function registrar()
		{	//consulta sql de la base de datos
			$this->consulta("INSERT INTO tproducto (cod_pro,nom_pro,tela,modelo,tip_pro,precio,talla,manga) VALUES (
 '$this->c_codigo',  '$this->c_nombre',  $this->c_tela,  $this->c_modelo,  '$this->c_tipo',  '$this->c_precio',  '$this->c_talla',  '$this->c_manga');");
			//true para validar if
			return true;
		}

public function buscar()
		{
			$this->consulta("SELECT * FROM tproducto,ttalla WHERE tela='$this->c_tela' AND modelo='$this->c_modelo' AND tip_pro='$this->c_tipo' AND precio='$this->c_precio' AND talla='$this->c_talla' AND manga='$this->c_manga' AND ttalla.cod_talla=tproducto.talla ");
		}
public function buscar_like($dato)
		{
			$this->consulta("SELECT nom_pro,nom_mod,nom_tipo_tela,tproducto.cod_pro, tela, modelo, tip_pro,precio,manga,nom_talla FROM tproducto, ttipo_tela, tmodelo,ttalla WHERE nom_pro LIKE '%".$dato."%' AND tproducto.tela=ttipo_tela.cod_tipo_tela AND tproducto.modelo=tmodelo.cod_mod AND ttalla.cod_talla=talla ORDER BY nom_pro LIMIT 0 , 5");
		}
public function producto($dato)
		{
			$this->consulta("SELECT nom_pro,modelo,tela,cod_pro,tip_pro,precio,manga,talla,juvenil FROM tproducto,ttalla WHERE tproducto.cod_pro='$dato' AND ttalla.cod_talla=tproducto.talla");
		}	
public function busca_productos($dato)
		{
			$this->consulta("SELECT nom_pro,modelo,tela,tproducto.cod_pro,tip_pro,pre_tipo_tela,cos_mod,can_uso_tela,ope_tela,precio,manga,nom_talla, pre_col FROM tproducto,ttipo_tela,tmodelo,tprecio_color,ttela,ttalla WHERE tproducto.cod_pro='$dato' AND tela=ttipo_tela.cod_tipo_tela AND modelo=tmodelo.cod_mod AND precio=ttela.cod_tela AND ttela.pre_tela=tprecio_color.cod_pre_col AND ttalla.cod_talla=talla");
		}	
public function modificar()
		{
			$this->consulta("UPDATE tproducto SET nom_pro='$this->c_nombre', tip_pro='$this->c_tipo', tela=$this->c_tela, modelo=$this->c_modelo, precio=$this->c_precio, manga=$this->c_manga, talla=$this->c_talla WHERE  cod_pro ='$this->c_codigo' ;");
		//true para validar if
			return true;
		}
public function eliminar()
		{
			$this->consulta("UPDATE tproducto SET estatus='1' WHERE cod_pro='$this->c_codigo'");
		//true para validar if
			return true;
		}
public function existencia()
		{
			$this->consulta("UPDATE  tproducto SET  existencia =  '$this->c_existencia_act' WHERE CONVERT(  `tproducto`.`cod_pro` USING utf8 ) =  '$this->c_codigo'");
		//true para validar if
			return true;
		}


public function id()
		{
			$this->consulta("SELECT MAX( cod_pro ) AS cod_pro FROM tproducto");
		}
public function listar()
		{
			$this->consulta("SELECT * FROM tproducto");
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
