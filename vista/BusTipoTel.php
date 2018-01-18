<?php
error_reporting( error_reporting() & ~E_NOTICE );
$q=$_POST['q'];
include_once("../modelo/clsTipoTela.php");


$objTela = new clsTipoTela();

$objTela->buscar_like($q);
$cont = $objTela->rows();
if($cont == 0){

 echo '<div id="close" onclick="cerrar()"><b>No hay sugerencias</b><div>';

}else{


 while($fila = $objTela->row()){

  echo '<div class="sugerencias" onclick="busqueda2('.$fila["cod_tipo_tela"].')"> <img src="../default/imagenes/tela_deportiva16.jpg"style="width: 10%;"> '.$fila['nom_tipo_tela'].' </div>';
 }
}
?>