<?php
error_reporting( error_reporting() & ~E_NOTICE );

include_once("../controlador/conTela.php");
require ('../modelo/conexion.php');
$query = "SELECT * FROM `totros` ORDER BY `cod_bor` DESC LIMIT 1  ";

  if($resultado=$mysqli->query($query)){ 
  $buscando = $resultado->fetch_assoc();
  $bordado=$buscando['pre_bor'];
  $bordado_fuera=$buscando['pre_bor_fuera'];
  $cuello=$buscando['pre_cuello'];
  }

session_start();
if(isset($_SESSION["nombre"])) {
/*



include_once("../modelo/clsProducto.php");
	$id= new clsProducto();
	$id->id();
   	$ids= $id->row();
include_once("../modelo/clsTipoProducto.php");
  $tipo= new clsTipoProducto();
  $tipo->listar();
include_once("../modelo/clsUnidadMetrica.php");
  $unidad= new clsUnidadMetrica();
  $unidad->listar();

*/
?>

<script>// busqueda ajax

function cerrar(){
  $('#close').hide();
  document.getElementById("divnombre").style.border="0px";
}


</script>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="../default/imagenes/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Listado de Telas</title>
    <script type="text/javascript" src="../default/js/ajax.js"></script>
    <!-- Bootstrap -->
    <link href="../default/css/bootstrap.min.css" rel="stylesheet">
    <link href="../default/css/miestilo.css" rel="stylesheet">
    <link href="../css/estilo.css" rel="stylesheet">

</head>
<body>

    <!-- cabecera de la imagen patria y menu -->
<?php
include('../default/header.php');
?>
<br>

<!-- formulario -->
	<div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1  ">
			<div class="panel panel-default">
	                <div class="panel-heading">
	                	<img id="formulario-img" src="../default/imagenes/formulario.png" />
	                	<strong >Actualizar Precios</strong>
	                </div>
	                <div class="panel-body">
	                	<form name="form" action="" method="POST" class="form-horizontal" role="form">

			                
		                    
                       <div class="form-group">
                      
                      <label class="col-sm-1 col-sm-offset-1 control-label">Cuello:</label>
                          <div class="col-sm-2" >
                              <input type="text" class="form-control" autocomplete="off" name="cuello" value="<?php if($existe=="si"){ echo $arreglo_buscar['pre_cuello'];}else{ echo $cuello;}?>">
                      </div>
                       <label class="col-sm-1  control-label">Bordado:</label>
                          <div class="col-sm-2" >
                              <input type="text" class="form-control" autocomplete="off" name="bordado" value="<?php if($existe=="si"){ echo $arreglo_buscar['pre_bor'];}else{ echo $bordado;}?>">
                      </div>
                       <label class="col-sm-1  control-label">Bordado Fuera:</label>
                          <div class="col-sm-2" >
                              <input type="text" class="form-control" autocomplete="off" name="bordado_fuera" value="<?php if($existe=="si"){ echo $arreglo_buscar['pre_bor_fuera'];}else{ echo $bordado_fuera;}?>">
                      </div>
			                 </div>
                       
                       
                       <div class="form-group">
                       <div class="col-sm-4 col-sm-offset-1 table-responsive"> 
                       <table class="table table-striped">
                        <thead>
                       
                          <tr>
                            <th>Pique</th>
                            
                            <th>Precio</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $cont=0;
                            $objTela->tela(6);
                            while($arreglo = $objTela->row()){
                                    $cont+=1;
                                   ?>
                              <tr id="tr_<?php echo $cont; ?>">
                                    <td hidden><input type="hidden" class="form-control" name="codigos_p[]" value="<?php echo $arreglo["cod_pre_col"];?>"></td>
                                    
                                    <td><input type="text" class="form-control" name="nombres_p[]"  value="<?php echo $arreglo["nom_pre_col"].' '.$arreglo["nom_tipo_tela"];?>" title="Nombre del Rango"></td>
                                    <td style="width: 35%;"><input type="text"  class="form-control" name="precios_p[]"     value="<?php echo $arreglo["pre_col"];?>"title="Precio"></td>
                                    
                                      
                                  </tr>
                                   <?php
                                    }?>
                          
                        </tbody>
                      </table>

                        
                       
                       </div><!--cierre tabla 1 -->
                       <div class="col-sm-4 col-sm-offset-1  table-responsive"> 
                       <table class="table table-striped">
                        <thead>
                        
                          <tr>
                            <th>Jersey</th>
                            
                            <th>Precio</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $cont=0;
                            $objTela->tela(7);
                            while($arreglo = $objTela->row()){
                                    $cont+=1;
                                   ?>
                              <tr id="tr_<?php echo $cont; ?>">
                                    <td hidden><input type="hidden" class="form-control" name="codigos_j[]" value="<?php echo $arreglo["cod_pre_col"];?>"></td>
                                    
                                    <td><input type="text" class="form-control" name="nombres_j[]"  value="<?php echo $arreglo["nom_pre_col"].' '.$arreglo["nom_tipo_tela"];?>" title="Nombre del Rango"></td>
                                    <td style="width: 35%;"><input type="text"  class="form-control" name="precios_j[]"     value="<?php echo $arreglo["pre_col"];?>"title="Precio"></td>
                                    
                                      
                                  </tr>
                                   <?php
                                    }?>
                          
                        </tbody>
                      </table>

                        
                       
                       </div><!--cierre tabla 1 -->
                       
                      
                       </div>
                        <div class="form-group">
                       <div class="col-sm-4 col-sm-offset-1 table-responsive"> 
                       <table class="table table-striped">
                        <thead>
                       
                          <tr>
                            <th>CAMISERIA</th>
                            
                            <th>Precio</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $cont=0;
                            $objTela->tela(1);
                            while($arreglo = $objTela->row()){
                                    $cont+=1;
                                   ?>
                              <tr id="tr_<?php echo $cont; ?>">
                                    <td hidden><input type="hidden" class="form-control" name="codigos_p[]" value="<?php echo $arreglo["cod_pre_col"];?>"></td>
                                    
                                    <td><input type="text" class="form-control" name="nombres_p[]"  value="<?php echo  $arreglo["nom_tipo_tela"];?>" title="Nombre del Rango"></td>
                                    <td style="width: 35%;"><input type="text"  class="form-control" name="precios_p[]"     value="<?php echo $arreglo["pre_col"];?>"title="Precio"></td>
                                    
                                      
                                  </tr>
                                   <?php
                                    }
                                    $objTela->tela(2);
                                    while($arreglo = $objTela->row()){
                                    $cont+=1;
                                   ?>
                                    <tr id="tr_<?php echo $cont; ?>">
                                    <td hidden><input type="hidden" class="form-control" name="codigos_p[]" value="<?php echo $arreglo["cod_pre_col"];?>"></td>
                                    
                                    <td><input type="text" class="form-control" name="nombres_p[]"  value="<?php echo  $arreglo["nom_tipo_tela"];?>" title="Nombre del Rango"></td>
                                    <td style="width: 35%;"><input type="text"  class="form-control" name="precios_p[]"     value="<?php echo $arreglo["pre_col"];?>"title="Precio"></td>
                                    
                                      
                                  </tr>
                                   <?php
                                    }
                                    $objTela->tela(3);
                            while($arreglo = $objTela->row()){
                                    $cont+=1;
                                   ?>
                              <tr id="tr_<?php echo $cont; ?>">
                                    <td hidden><input type="hidden" class="form-control" name="codigos_p[]" value="<?php echo $arreglo["cod_pre_col"];?>"></td>
                                    
                                    <td><input type="text" class="form-control" name="nombres_p[]"  value="<?php echo  $arreglo["nom_tipo_tela"];?>" title="Nombre del Rango"></td>
                                    <td style="width: 35%;"><input type="text"  class="form-control" name="precios_p[]"     value="<?php echo $arreglo["pre_col"];?>"title="Precio"></td>
                                    
                                      
                                  </tr>
                                   <?php
                                    }
                                    
                                    $objTela->tela(5);
                            while($arreglo = $objTela->row()){
                                    $cont+=1;
                                   ?>
                              <tr id="tr_<?php echo $cont; ?>">
                                    <td hidden><input type="hidden" class="form-control" name="codigos_p[]" value="<?php echo $arreglo["cod_pre_col"];?>"></td>
                                    
                                    <td><input type="text" class="form-control" name="nombres_p[]"  value="<?php echo  $arreglo["nom_tipo_tela"];?>" title="Nombre del Rango"></td>
                                    <td style="width: 35%;"><input type="text"  class="form-control" name="precios_p[]"     value="<?php echo $arreglo["pre_col"];?>"title="Precio"></td>
                                    
                                      
                                  </tr>
                                   <?php
                                    }
                                    $objTela->tela(9);
                            while($arreglo = $objTela->row()){
                                    $cont+=1;
                                   ?>
                              <tr id="tr_<?php echo $cont; ?>">
                                    <td hidden><input type="hidden" class="form-control" name="codigos_p[]" value="<?php echo $arreglo["cod_pre_col"];?>"></td>
                                    
                                    <td><input type="text" class="form-control" name="nombres_p[]"  value="<?php echo  $arreglo["nom_tipo_tela"];?>" title="Nombre del Rango"></td>
                                    <td style="width: 35%;"><input type="text"  class="form-control" name="precios_p[]"     value="<?php echo $arreglo["pre_col"];?>"title="Precio"></td>
                                    
                                      
                                  </tr>
                                   <?php
                                    } 

                                    $objTela->tela(4);
                            while($arreglo = $objTela->row()){
                                    $cont+=1;
                                   ?>
                              <tr id="tr_<?php echo $cont; ?>">
                                    <td hidden><input type="hidden" class="form-control" name="codigos_p[]" value="<?php echo $arreglo["cod_pre_col"];?>"></td>
                                    
                                    <td><input type="text" class="form-control" name="nombres_p[]"  value="<?php echo  $arreglo["nom_tipo_tela"];?>" title="Nombre del Rango"></td>
                                    <td style="width: 35%;"><input type="text"  class="form-control" name="precios_p[]"     value="<?php echo $arreglo["pre_col"];?>"title="Precio"></td>
                                    
                                      
                                  </tr>
                                   <?php
                                    }
                                    $objTela->tela(11);
                            while($arreglo = $objTela->row()){
                                    $cont+=1;
                                   ?>
                              <tr id="tr_<?php echo $cont; ?>">
                                    <td hidden><input type="hidden" class="form-control" name="codigos_p[]" value="<?php echo $arreglo["cod_pre_col"];?>"></td>
                                    
                                    <td><input type="text" class="form-control" name="nombres_p[]"  value="<?php echo  $arreglo["nom_tipo_tela"];?>" title="Nombre del Rango"></td>
                                    <td style="width: 35%;"><input type="text"  class="form-control" name="precios_p[]"     value="<?php echo $arreglo["pre_col"];?>"title="Precio"></td>
                                    
                                      
                                  </tr>
                                   <?php
                                    }
                                    ?>
                                    
                                    
                                    
                                    
                          
                        </tbody>
                      </table>

                        
                       
                       </div><!--cierre tabla 1 -->
                       <div class="col-sm-4 col-sm-offset-1  table-responsive"> 
                       <table class="table table-striped">
                        <thead>
                        
                          <tr>
                            <th>OTROS</th>
                            
                            <th>Precio</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $cont=0;
                            $objTela->tela(8);
                            while($arreglo = $objTela->row()){
                                    $cont+=1;
                                   ?>
                              <tr id="tr_<?php echo $cont; ?>">
                                    <td hidden><input type="hidden" class="form-control" name="codigos_j[]" value="<?php echo $arreglo["cod_pre_col"];?>"></td>
                                    
                                    <td><input type="text" class="form-control" name="nombres_j[]"  value="<?php echo $arreglo["nom_pre_col"].' '.$arreglo["nom_tipo_tela"];?>" title="Nombre del Rango"></td>
                                    <td style="width: 35%;"><input type="text"  class="form-control" name="precios_j[]"     value="<?php echo $arreglo["pre_col"];?>"title="Precio"></td>
                                    
                                      
                                  </tr>
                                   <?php
                                    }
                                    $objTela->tela(12);
                            while($arreglo = $objTela->row()){
                                    $cont+=1;
                                   ?>
                              <tr id="tr_<?php echo $cont; ?>">
                                    <td hidden><input type="hidden" class="form-control" name="codigos_p[]" value="<?php echo $arreglo["cod_pre_col"];?>"></td>
                                    
                                    <td><input type="text" class="form-control" name="nombres_p[]"  value="<?php echo  $arreglo["nom_pre_col"];?>" title="Nombre del Rango"></td>
                                    <td style="width: 35%;"><input type="text"  class="form-control" name="precios_p[]"     value="<?php echo $arreglo["pre_col"];?>"title="Precio"></td>
                                    
                                      
                                  </tr>
                                   <?php
                                    }
                                    ?>
                          
                        </tbody>
                      </table>

                        
                       
                       </div><!--cierre tabla 1 -->
                       
                      
                       </div>
                       <div class="col-sm-12">
                                <input type="submit" class="btn btn-default col-sm-offset-5" name="btnActualizar"  value="Actualizar">

                            </div>
                       
		                   

		                </form> <br>
	           		</div>
	        </div>
		</div>
	</div><!-- fin del formulario -->




<!-- pie de pagina -->
<?php
include('../default/footer.php');
?>
<!--para recibir el mensaje -->
<?php if($msj) { ?> <script > alert("<?php  print($msj); ?>"); </script> <?php  } ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins)  -->
    <script src="../default/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../default/js/bootstrap.min.js"></script>
    <script src="../js/js.js"></script>
</body>
</html>
<script type="text/javascript">
getTipoTela('1');
function cargarTipo(){
  var tipo=document.form.tipo_tela.value;
  
  loadDoc("q="+tipo,"BusAct.php",function(){

      if (xmlhttp.readyState==4 && xmlhttp.status==200){

        document.getElementById("tabla").innerHTML=xmlhttp.responseText;
        

        }else{ document.getElementById("tabla").innerHTML='<img src="../default/imagenes/load.gif" width="50" height="50" />'; }

      });
};


 /*$("#paquete").change(function(event){

 	var paquete=document.form.paquete.value;
 	if(paquete==1){
 		document.form.cant_x_paquete.disabled=false;
 	}
  });*/

	 $(document).on("click", function(event){
        var $trigger = $(".divnombre");
        if($trigger !== event.target && !$trigger.has(event.target).length){
            $(".sugerencias").hide();
            $("#close").hide();
            document.getElementById("divnombre").style.border="0px";

        }            
    });
</script>

<?php

    }else {

    header("Location:../index.php");
    }

?>
