<?php

include_once "../modelo/conexion_bd.php";
 $mysqli=new conexion_bd();
'<script> alert("Hola...");</script>';
	

if($_POST['nivel']=='modelo'){
 '<script> alert("Hola...");</script>';
		//llamamos a los municipios
		 $cod_pro = $_POST['cod_pro'];	
		 $sql = "SELECT cod_mod,nom_mod FROM tmodelo  
                  WHERE cod_pro = '$cod_pro'  ORDER BY nom_mod";
                  $query = $mysql->GetQuery($sql);
				 if ( $rows=$mysql->Total_Filas($query)==0){
				  	 echo  '<option value="0">Buscando el Modelo...</option>';
				 }else{
				 	  echo '<option value="">Selecione</option>';
                  while ($row = $mysql->GetArray($query)){
                    if($row['cod_mod']==$cod_mod){
                      echo "<option value=".$row['cod_mod'].">".$row['nom_mod']."</option>";
                    }else{
                      echo "<option value=".$row['cod_mod'].">".$row['nom_mod']."</option>";
                    }
                  }
		 }

	}
	