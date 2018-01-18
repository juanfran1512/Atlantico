<?php
error_reporting( error_reporting() & ~E_NOTICE );
$q=$_POST['q'];
include_once("../modelo/clsTipoProducto.php");


$objTipoProducto = new clsTipoProducto();

$objTipoProducto->buscar_like($q);
$cont = $objTipoProducto->rows();
if($cont == 0){

 echo '<div id="close" onclick="cerrar()"><b>No hay sugerencias</b><div>';

}else{


 while($fila = $objTipoProducto->row()){

  echo '<div class="sugerencias" onclick="busqueda2('.$fila["cod_tip_pro"].')"> <img src="../default/imagenes/tela_deportiva16.jpg"style="width: 10%;"> '.$fila['nom_tip'].' </div>';
 }
}
?>