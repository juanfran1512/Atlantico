<?php
error_reporting( error_reporting() & ~E_NOTICE );
$q=$_POST['q'];
include_once("../modelo/clsPrecioColor.php");


$objColor = new clsPrecioColor();

$objColor->buscar_like($q);
$cont = $objColor->rows();
if($cont == 0){

 echo '<div id="close" onclick="cerrar()"><b>No hay sugerencias</b><div>';

}else{


 while($fila = $objColor->row()){

  echo '<div class="sugerencias" onclick="busqueda2('.$fila["cod_pre_col"].')"> <img src="../default/imagenes/tela_deportiva16.jpg"style="width: 10%;"> '.$fila['nom_pre_col'].' '.$fila['nom_tipo_tela'].' </div>';
 }
}
?>