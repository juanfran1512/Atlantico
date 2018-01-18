<?php
error_reporting( error_reporting() & ~E_NOTICE );
$q=$_POST['q'];
include_once("../modelo/clsModelo.php");


$objModelo = new clsModelo();

$objModelo->buscar_like($q);
$cont = $objModelo->rows();
if($cont == 0){

 echo '<div id="close" onclick="cerrar()"><b>No hay sugerencias</b><div>';

}else{


 while($fila = $objModelo->row()){

  echo '<div class="sugerencias" onclick="busqueda2('.$fila["cod_mod"].')"> <img src="../default/imagenes/tijera.jpg"style="width: 10%;"> '.$fila['nom_mod'].' </div>';
 }
}
?>