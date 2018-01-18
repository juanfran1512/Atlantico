<?php

include_once "../modelo/conexion_bd.php";
 $mysql=new clsConexion();

	if($_POST['nivel']=='estado'){

		//llamamos a los municipios
		 $idestado = $_POST['idestado'];	
		 $sql = "SELECT idmunicipio, UCASE(nombre) as nombre FROM tmunicipio  
                  WHERE idestado = '$idestado'  ORDER BY nombre";
                  $query = $mysql->GetQuery($sql);
				 if ( $rows=$mysql->Total_Filas($query)==0){
				  	 echo  '<option value="0">Buscando municipio...</option>';
				 }else{
				 	  echo '<option value="">Selecione el municipio...</option>';
                  while ($row = $mysql->GetArray($query)){
                    if($row['idmunicipio']==$idmunicipio){
                      echo "<option value=".$row['idmunicipio'].">".$row['nombre']."</option>";
                    }else{
                      echo "<option value=".$row['idmunicipio'].">".$row['nombre']."</option>";
                    }
                  }
		 }

	}if($_POST['nivel']=='municipio'){

		//llamamos a las parroquias
		 $idmunicipio = $_POST['idmunicipio'];	
		 $sql = "SELECT idparroquia, UCASE(nombre) as nombre FROM tparroquia  
                  WHERE idmunicipio = '$idmunicipio'  ORDER BY nombre";
                  $query = $mysql->GetQuery($sql);
				 if ( $rows=$mysql->Total_Filas($query)==0){
				  	 echo  '<option value="0">Buscando parroquia...</option>';
				 }else{
				 	  echo '<option value="">Selecione la parroquia...</option>';
                  while ($row = $mysql->GetArray($query)){
                    if($row['idparroquia']==$idparroquia){
                      echo "<option value=".$row['idparroquia'].">".$row['nombre']."</option>";
                    }else{
                      echo "<option value=".$row['idparroquia'].">".$row['nombre']."</option>";
                    }
                  }
		 }

	}if($_POST['nivel']=='parroquia'){

		//llamamos a las ciudades
		 $idparroquia = $_POST['idparroquia'];	
		 $sql = "SELECT idciudad, UCASE(nombre) as nombre FROM tciudad  
                  WHERE idparroquia = '$idparroquia'  ORDER BY nombre";
                  $query = $mysql->GetQuery($sql);
				 if ( $rows=$mysql->Total_Filas($query)==0){
				  	 echo  '<option value="0">Buscando ciudad...</option>';
				 }else{
				 	  echo '<option value="">Selecione la ciudad...</option>';
                  while ($row = $mysql->GetArray($query)){
                    if($row['idciudad']==$idciudad){
                      echo "<option value=".$row['idciudad'].">".$row['nombre']."</option>";
                    }else{
                      echo "<option value=".$row['idciudad'].">".$row['nombre']."</option>";
                    }
                  }
		 }

	}

if($_POST['nivel']=='modelo'){
//echo  '<script> alert("Hola...");</script>';
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
	