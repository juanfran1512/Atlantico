<?php
error_reporting( error_reporting() & ~E_NOTICE );
$q=$_POST['q'];
include_once("../modelo/clsTela.php");


$objTipoTela = new clsTela();
echo'<div id="tabla">
                       <div class="form-group">
                       <div class="col-sm-10 col-sm-offset-1 table-responsive"> 
                       <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Nombre</th>
                            <th>Cantidades</th>
                            <th>Precio</th>
                          </tr>
                        </thead>
                        <tbody>';
                        
                          
                          
                        


$objTipoTela->buscar_lista($q);
$cont = $objTipoTela->rows();

if($cont == 0){

 echo '<div id="close" onclick="cerrar()"><tr><td>No hay sugerencias</td></tr><div>';

}else{


 while($fila = $objTipoTela->row()){

  echo '<tr><td>'.$fila["nom_tela"].'</td><td>'.$fila['can_tela'].' </td><td>'.$fila['pre_col'].'</tr>';
 }
}echo'</tbody>
                      </table>

                        
                       
                       </div></div>';
?>