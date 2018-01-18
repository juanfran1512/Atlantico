<?php
error_reporting( error_reporting() & ~E_NOTICE );
$q=$_POST['q'];
include_once("../modelo/clsPresupuesto.php");


$objListaPresu = new clsPresupuesto();
echo'<div id="tabla">
                       <div class="form-group">
                       <div class="col-sm-12 table-responsive"> 
                       <table class="table table-striped">
                        <thead>
                          <tr>
                             <th>Nombre</th>
                            <th>Fec. Elaboracion</th>';
                            if($q=='1' || $q=='2' || $q=='5'){echo '<th>Fec. Vencimiento</th>'; }
                            if($q=='3' || $q=='4'){
                            echo'<th>Fec. Entrega</th> 
                            <th>Tipo de Pago</th>
                            <th>Abono</th>
                            <th>Restante</th>'; }
                            echo '<th>Total</th>
                          </tr>
                        </thead>
                        <tbody>';
                        
                          
                          
                        


$objListaPresu->buscar_lista($q);
$cont = $objListaPresu->rows();

if($cont == 0){

 echo '<div id="close" onclick="cerrar()"><tr><td>No hay sugerencias</td></tr><div>';

}else{


 while($fila = $objListaPresu->row()){

  echo '<tr onclick="recarga('.$fila["cod_presu"].')"><td>'.$fila["nom_cli"].'</td><td>'.$fila['fec_presu'].'</td>';
  if($q=='1' || $q=='2' || $q=='5'){echo '<td>'.$fila['ven_presu'].' </td>';}
   if($q=='3' || $q=='4'){
    echo '<td>'.$fila['fec_ent'].'</td>';
    if($fila['tipo_pago']=='1'){echo '<td> Cheque </td>';}
    if($fila['tipo_pago']=='2'){ echo '<td> Efectivo </td>';}
    if($fila['tipo_pago']=='3'){echo '<td> Transferencia </td>' ;}
    
    echo '<td>'.$fila['abo_pre'].' </td><td>'.$fila['res_pre'].' </td>';
     }
   echo '<td>'.$fila['tot_presu'].'</tr>';
 }
}echo'</tbody>
                      </table>

                        
                       
                       </div></div>';
?>