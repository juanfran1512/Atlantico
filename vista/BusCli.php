<?php
error_reporting( error_reporting() & ~E_NOTICE );
$q=$_POST['q'];
include_once("../modelo/clsCliente.php");


$objCliente = new clsCliente();

$objCliente->buscar_like($q);
$cont = $objCliente->rows();
if($cont == 0){

 echo '<div id="close" onclick="cerrar()"><b>No hay sugerencias</b><div>';

}else{


 while($fila = $objCliente->row()){

  echo '<div class="sugerencias" onclick="busqueda2('.$fila["cod_cli"].')"> <img src="../default/imagenes/caja.jpg"style="width: 10%;"> '.$fila['nom_cli'].' </div>';
 }
}
?>