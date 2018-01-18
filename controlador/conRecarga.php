<?php 
include_once("../modelo/clsRecarga.php");
    $recarga = new clsRecarga();

    if (isset($_POST["validapresupuesto"]) ) {
        $json=$_POST["validapresupuesto"];
        $obj_php = json_encode($json);
        $obj=json_decode($obj_php);

      $recarga->presupuesto($obj->numero);
      $perso= $recarga->row(); 
      $nombre=$perso['nom_cli'];
      $rif=$perso['rif_cli'];
      $telefono=$perso['tlfn_cli'];
      $estatus=$perso['est_pre'];
      $fecha=$perso['fec_presu'];
      $vence=$perso['ven_presu'];
      $sub=$perso['sub_total_presu'];
      $iva=$perso['val_iva'];
      $monto=$perso['monto_iva_presu'];
      $total=$perso['tot_presu'];
      $abono=$perso['abo_pre'];
      $entrega=$perso['fec_ent'];
      $restante=$perso['res_pre'];
      $pago=$perso['tipo_pago'];

         if($recarga->rows()>0){
            echo  "|si"."|".$nombre."|".$rif."|".$telefono."|".$estatus."|".$fecha."|".$vence."|".$sub."|".$monto."|".$total."|".$abono."|".$restante."|".$pago."|".$entrega."|".$iva;
           
        }else{
             echo "|no";
    }
    }
    ?>