<?php
error_reporting( error_reporting() & ~E_NOTICE );
include_once("../controlador/conCliente.php");
include_once("../modelo/clsZona.php");
session_start();
if(isset($_SESSION["nombre"])) {
  //--------------------------------------------------------------------
  //se crea el Objeto Zona de la clase Zona
  //--------------------------------------------------------------------

  $objzona = new clsZona();
  $objmunicipio = new clsZona();
  $objzona->listarzona(); //llamamos la funcion listar que tiene la clase clsZona
  $objmunicipio->listarmunicipio(18);

?>
<style type="text/css">


#divnombre{ 
    width: 94%;
    margin: 0px 2px 0px;
 z-index: 1;
 position: absolute;
 background: white;
 -webkit-border-radius: 0px 0px 4px 4px;
 -moz-border-radius: 0px 0px 4px 4px;       
}         


.sugerencias:hover{
 background-color:#D3D3D3;
 cursor:default;
}

#busqueda{
 background-image:url('public/img/search.png');
 background-size:25px 23px;/*tamano imagen*/
 background-repeat:no-repeat;
 background-position:right;
 border-radius: 5px;
 border-style:solid;
 border-color:#1E90FF;
 border-width:1px;
 height:30px;
 color:#808080;

}</style>
<script>// busqueda ajax

    function busqueda(){
 
$('#divnombre').show();
    var n=document.getElementById('buscador').value;

    if(n==''){

     document.getElementById("divnombre").innerHTML="";
     document.getElementById("divnombre").style.border="0px";



     return;
    }

    loadDoc("q="+n,"BusCli.php",function(){

      if (xmlhttp.readyState==4 && xmlhttp.status==200){

        document.getElementById("divnombre").innerHTML=xmlhttp.responseText;
        document.getElementById("divnombre").style.border="1px solid #A5ACB2";

        }else{ document.getElementById("divnombre").innerHTML='<img src="../default/imagenes/load.gif" width="50" height="50" />'; }

      });
    }

// seleccion de la busqueda

function busqueda2(cod){

var todo={"cliente":cod};
      console.log(todo);
      $.post('../controlador/conCliente.php', {validacliente: todo}, function(data) {
        
        var datos=data.split("|");

        if(datos[1]=="si"){
          document.form.nombre.value=datos[2];
          document.form.rif.value=datos[6];
          document.form.persona.value=datos[7];
          document.form.telefono.value=datos[3];
          document.form.correo.value=datos[5];
          document.form.direccion.value=datos[4];
          document.form.codigo.value=datos[8];
          document.form.zona.value=datos[9];
          document.form.municipio.value=datos[10];
          document.form.btnGuardar.disabled=true;
          document.form.btnModificar.disabled=false;
          //document.form.duracion.focus();
          document.getElementById("divnombre").style.border="0px";
          $('.sugerencias').hide();

        }
        if(datos[1]=="no"){
          alert("No existe ese Cliente");
          $('.sugerencias').hide();
        }
        console.log(datos);
      });

}
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
    <script type="text/javascript" src="../default/js/ajax.js"></script>
    <title>Clientes</title>

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
        <div class="col-xs-13 col-sm-8 col-sm-offset-2 ">
			<div class="panel panel-default">
	                <div class="panel-heading">
	                	<img id="formulario-img" src="../default/imagenes/formulario.png" />
	                	<strong >Clientes</strong>
	                </div>
	                <div class="panel-body">
	                	<form name="form" action="" method="POST" class="form-horizontal" role="form">
                      <div class="form-group">
			                <label class="col-sm-2  control-label">Buscador:</label>
                            <div class="col-sm-8" >
                              
                                  <input type="text" class="form-control" autocomplete="off" name="buscador" id="buscador" onkeyup="busqueda()" onblur="this.value=this.value.toUpperCase()" value="">
                                  <div id="divnombre"></div>
                                  <input type="hidden" class="form-control" autocomplete="off" name="codigo" value="<?php echo $arreglo_buscar["cod_cli"];?>">
                                  <!-- boton buscar-->
                                 
                              
                            </div>
                          </div>
		                    <div class="form-group">
		                        <label class="col-sm-2  control-label"> C.I./RIF:</label>
                          <div class="col-sm-3" >
                              <input type="text" class="form-control" autocomplete="off" name="rif" onblur="this.value=this.value.toUpperCase()" value="<?php echo $arreglo_buscar["tlfn_cli"]?>">
                          </div>
                          <label class="col-sm-2  control-label"> Telefono:</label>
                          <div class="col-sm-3" >
                              <input type="text" class="form-control" autocomplete="off" name="telefono" value="<?php echo $arreglo_buscar["tlfn_cli"]?>">
                          </div>
                          </div>
			                    <div class="form-group">
                          <label class="col-sm-2  control-label">* Nombre:</label>
			                    <div class="col-sm-8" >
			                        <input type="text" class="form-control" autocomplete="off" name="nombre"  onblur="this.value=this.value.toUpperCase()" value="<?php echo $arreglo_buscar["nom_cli"];?>">
			                    </div>
			                </div>

											<div class="form-group">
                          

                          <label class="col-sm-2  control-label">* Persona Responsable:</label>
                          <div class="col-sm-8" >
                              <input type="text" class="form-control" autocomplete="off" name="persona"  onblur="this.value=this.value.toUpperCase()" value="<?php echo $arreglo_buscar["pers_cli"]?>">
                          </div>
    			            </div>
                      <div class="form-group">
                          

                          <label class="col-sm-2  control-label">* Correo:</label>
                          <div class="col-sm-8" >
                              <input type="text" class="form-control" autocomplete="off" name="correo"  onblur="this.value=this.value.toUpperCase()" value="<?php echo $arreglo_buscar["correo_cli"]?>">
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2  control-label">* Direccion:</label>
                          <div class="col-sm-8" >
                              <textarea class="form-control" autocomplete="off" name="direccion"  onblur="this.value=this.value.toUpperCase()"><?php echo $arreglo_buscar["dir_cli"]?></textarea>
                          </div>
                      </div>
                      <div class="form-group" >
			                    <label class="col-sm-2 control-label">Zona:</label>
			                    <div class="col-sm-3" >
			                       <select class="form-control" name="zona">
                               <option >Seleccione la Zona</option>
                             <?php
         										      while($zona = $objzona->row()){
         										 ?>
                                <option <?php if($zona['cod_zona'] == $arreglo_buscar["zona_fk"]) print("selected");  ?>     value="<?php  echo $zona['cod_zona'];       ?>"> <?php print($zona['des_zona']); ?></option>
                             <?php
                                }
                             ?>
                             </select>
			                    </div>
                          <div class="form-group" >
                          <label class="col-sm-2 control-label">Municipio:</label>
                          <div class="col-sm-3" >
                             <select class="form-control" name="municipio" style="width: 94%;">
                               <option >Seleccione el Municipio</option>
                             <?php
                                  while($muni = $objmunicipio->row()){
                             ?>
                                <option <?php if($muni['cod_muni'] == $arreglo_buscar["municipio_fk"]) print("selected");  ?>     value="<?php  echo $muni['cod_muni'];       ?>"> <?php print($muni['des_muni']); ?></option>
                             <?php
                                }
                             ?>
                             </select>
                          </div>
			                </div>
                      <h6 class="col-sm-offset-4">Nota: Los Campos Marcados con (*) son Obligatorios.</h6>
		                    <hr>
		                        <div class="col-sm-12">
		                            <input type="submit" class="btn btn-default col-sm-offset-4" name="btnGuardar"  value="Guardar">
		                            <input type="submit" class="btn btn-default" disabled name="btnModificar"  value="Modificar">
		                            <input type="submit" class="btn btn-default" name="btnCancelar"  value="Cancelar">
		                            <input type="submit" class="btn btn-default" name="btnSuspender"  value="Suspender">
		                        </div>
		                </form>
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
</body>
</html>
<?php

    }else {

    header("Location:../index.php");
    }

?>
