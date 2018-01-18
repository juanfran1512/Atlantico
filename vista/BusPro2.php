<?php
error_reporting( error_reporting() & ~E_NOTICE );
$q=$_POST['q'];
include_once("../modelo/clsProducto.php");


$objProducto = new clsProducto();

$objProducto->buscar_like($q);
$cont = $objProducto->rows();
if($cont == 0){

 echo '<div id="close" onclick="cerrar()"><b>No hay sugerencias</b><div>';

}else{


 while($fila = $objProducto->row()){

  echo '<div class="sugerencias" onclick="busqueda_producto2('.$fila["cod_pro"].')"> <img src="../default/imagenes/chemise.jpg"style="width: 5%;"> '.$fila['nom_pro'].'</div>';
 }
}
?>