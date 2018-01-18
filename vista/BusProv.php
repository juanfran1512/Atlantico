<?php
error_reporting( error_reporting() & ~E_NOTICE );
$q=$_POST['q'];
include_once("../modelo/clsProveedor.php");


$objProveedor = new clsProveedor();

$objProveedor->buscar_like($q);
$cont = $objProveedor->rows();
if($cont == 0){

 echo '<div id="close" onclick="cerrar()"><b>No hay sugerencias</b><div>';

}else{


 while($fila = $objProveedor->row()){

  echo '<div class="sugerencias" onclick="busqueda2('.$fila["cod_prov"].')"> <img src="../default/imagenes/caja.jpg"style="width: 10%;"> '.$fila['nom_prov'].' </div>';
 }
}
?>