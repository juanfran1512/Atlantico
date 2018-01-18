<?php
error_reporting( error_reporting() & ~E_NOTICE );
include_once("../controlador/conProducto.php");
require ('../modelo/conexion.php');
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
?><style type="text/css">


#divnombre{ 
    width: 100%;
    margin: 33px 0px 3px;
 z-index: 1;
 position: absolute;
 background: white;
 -webkit-border-radius: 0px 0px 4px 4px;
 -moz-border-radius: 0px 0px 4px 4px;       
}         
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
    var n=document.getElementById('nombre').value;

    if(n==''){

     document.getElementById("divnombre").innerHTML="";
     document.getElementById("divnombre").style.border="0px";



     return;
    }

    loadDoc("q="+n,"BusPro.php",function(){

      if (xmlhttp.readyState==4 && xmlhttp.status==200){

        document.getElementById("divnombre").innerHTML=xmlhttp.responseText;
        document.getElementById("divnombre").style.border="1px solid #A5ACB2";

        }else{ document.getElementById("divnombre").innerHTML='<img src="../default/imagenes/load.gif" width="50" height="50" />'; }

      });
    }

// seleccion de la busqueda

function busqueda2(cod){

var todo={"producto":cod};
      console.log(todo);
      $.post('../controlador/conProducto.php', {validaproducto: todo}, function(data) {
        
        var datos=data.split("|");
        
        if(datos[1]=="si"){
          document.form.nombre.value=datos[2];
          document.form.codigo.value=datos[4];
          document.form.nom_tela.value=datos[5];
          document.form.nom_tip.value=datos[6];
          document.form.nom_mod.value=datos[3];
          document.form.colo_r.value=datos[7];
          document.form.manga.value=datos[8];
          document.form.talla.value=datos[9];
          document.form.genero.value=datos[10];
          document.form.btnGuardar.disabled=true;
          document.form.btnModificar.disabled=false;
          document.form.colo_r.disabled=false;
          if(datos[10]!="0"){
           document.form.talla.disabled=false; 
          }
          //document.form.nom_mod.disabled=true;
          //document.form.nom_tip.disabled=true;
          //document.form.duracion.focus();
          document.getElementById("divnombre").style.border="0px";
          $('.sugerencias').hide();

        }
        if(datos[1]=="no"){
          alert("No existe ese Producto");
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
    <title>Productos</title>
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
        <div class="col-xs-12 col-sm-12 ">
			<div class="panel panel-default">
	                <div class="panel-heading">
	                	<img id="formulario-img" src="../default/imagenes/formulario.png" />
	                	<strong >Productos</strong>
	                </div>
	                <div class="panel-body">
	                	<form name="form" action="" method="POST" class="form-horizontal" role="form">

			                
		                    
                        <div class="form-group">
		                        <label class="col-sm-1  control-label">* Nombre</label>
		                        <div class="col-sm-5" >
		                        	<div class="input-group" >
		                        	<input type="text" class="form-control"  autocomplete="off" id="nombre"  disabled onkeyup="busqueda()" onblur="this.value=this.value.toUpperCase()"name="nombre" value="<?php echo $arreglo_buscar["nom_pro"];?>">
		                        	<div id="divnombre"></div>
		                            	<input type="hidden" class="form-control" autocomplete="off" name="codigo" value="<?php echo $arreglo_buscar["cod_pro"];?>">
		                           		<!-- boton buscar-->
																	<span class="input-group-btn">
		                           			<span class="glyphicon glyphicon-user " ></span>
		                            	    <input type="button" class="btn btn-default"  name="btnBuscar" onclick="actModificacion()" value=" Buscar ">
		                            	</span>
		                            	
		                        	</div>
		                        </div>
                            <label class="col-sm-1  control-label">* Tipo</label>
                          <div class="col-sm-5" >
                              <select  class="form-control" id="nom_tip" name="nom_tip" onchange="cargarModelo()" title="Nombre del Tipo"  class="select_tipo" >
                                      <option  value=''>Seleccione</option>
                                      <?php 
                                       $query = "SELECT cod_tip_pro, nom_tip FROM ttipo_producto ORDER BY nom_tip";
                                       if($resultado=$mysqli->query($query))
                                        {
                                          while($row = $resultado->fetch_assoc())
                                          {
                                          ?>
                                          <option <?php if($arreglo_buscar["tip_pro"]==$row['cod_tip_pro']) print('selected'); ?>  value="<?php echo $row['cod_tip_pro']; ?>"><?php echo $row['nom_tip']; ?></option>
                                          
                                          <?php
                                          }
                                        }

                                      ?>
                                      </select><input type="hidden" name="texto_tipo" id="texto_tipo">
                          </div>

			                </div>
                      
											<div class="form-group">
                          <label class="col-sm-1  control-label">* Modelo</label>
                          <div class="col-sm-5" >
                              <select class="form-control" id="nom_mod" name="nom_mod" title="Nombre del Modelo" onchange="cargarModelo()" class="select_modelo" >
                                      <option  value=''>Seleccione</option>
                                      <?php
                                      $query = "SELECT cod_mod, nom_mod FROM tmodelo ORDER BY nom_mod";
                                        if($resultado=$mysqli->query($query))
                                        {
                                          while($row = $resultado->fetch_assoc())
                                          {
                                          ?>
                                          <option <?php if($arreglo_buscar["modelo"]==$row['cod_mod']) print('selected'); ?> value="<?php echo $row['cod_mod']; ?>"><?php echo $row['nom_mod']; ?></option>
                                          
                                          <?php
                                          }
                                        }
                                      ?>
                                      </select> <input type="hidden" name="texto_modelo" id="texto_modelo">
                                    </div>

                                    <label class="col-sm-1  control-label">* Tela</label>
                                    <div class="col-sm-5" >
                                      <select class="form-control" id="nom_tela" name="nom_tela" title="Nombre de la Tela"  onchange="getTela(this.value),cargarModelo(),f_tela()" class="select_tela" >
                                      <option  value=''>Seleccione</option>
                                      <?php 
                                      $query = "SELECT cod_tipo_tela, nom_tipo_tela FROM ttipo_tela ORDER BY nom_tipo_tela";
  
                                        if($resultado=$mysqli->query($query))
                                        {
                                          while($row = $resultado->fetch_assoc())
                                          {
                                          ?>
                                          <option <?php if($arreglo_buscar["tela"]==$row['cod_tipo_tela']) print('selected'); ?> value="<?php echo $row['cod_tipo_tela']; ?>"><?php echo $row['nom_tipo_tela']; ?></option>
                                          
                                          <?php
                                          }
                                        }
                                      ?>
                                      </select>  <input type="hidden" name="texto_tela" id="texto_tela">  
                                      </div>
                          </div>

                          <div class="form-group">
                             <label class="col-sm-1  control-label">* Color</label>
                          <div class="col-sm-5" >
                              <select class="form-control" id="telaList" name="pre_tela" title="Nombre del Color" disabled onchange="cargarModelo()"   class="select_tela" >
                                      <option  value=''>Seleccione</option>
                                      <?php 
                                      $query = "SELECT * FROM ttela ORDER BY nom_tela";
  
                                        if($resultado=$mysqli->query($query))
                                        {
                                          while($row = $resultado->fetch_assoc())
                                          {
                                          ?>
                                          <option <?php if($arreglo_buscar["pre_tela"]==$row['cod_tela']) print('selected'); ?> value="<?php echo $row['cod_tela']; ?>"><?php echo $row['nom_tela']; ?></option>
                                          
                                          <?php
                                          }
                                        }
                                      ?>
                                      </select>  <input type="hidden" name="texto_color" id="texto_color">  
                                      </div>
                      

                          <label class="col-sm-1  control-label">* Manga</label>
                          <div class="col-sm-5" >
                              <select class="form-control" id="manga" name="manga" title="Nombre del Modelo" onchange="cargarModelo()"  class="select_manga" >
                                      <option  value='0'>Seleccione</option>
                                      <option <?php if($arreglo_buscar["manga"]=='1') print('selected'); ?>value='1'>M/C </option>
                                      <option <?php if($arreglo_buscar["manga"]=='2') print('selected'); ?>value='2'>M/L </option>
                                       </select>  <!--<input type="hidden" name="texto_tela" id="texto_tela"> -->
                          
                         
                          </div>
                           </div>

                          <div class="form-group">
                            <label class="col-sm-1  control-label">* Genero</label>
                          <div class="col-sm-5" >
                              <select class="form-control" id="genero" name="genero" title="Nombre del Modelo" onchange="getTalla(this.value),f_talla()" class="select_genero" >
                                      <option  value="0">Seleccione</option>
                                    <option <?php if($arreglo_buscar["juvenil"]=='2') print('selected'); ?> value="2">CABALLERO</option>
                                    <option <?php if($arreglo_buscar["juvenil"]=='3') print('selected'); ?> value="3">DAMA</option>
                                    <option <?php if($arreglo_buscar["juvenil"]=='1') print('selected'); ?> value="1">JUVENIL</option>
                                       </select>  <!--<input type="hidden" name="texto_tela" id="texto_tela"> -->
                          
                         
                          </div>
                             <label class="col-sm-1  control-label">* Talla</label>
                          <div class="col-sm-5" >
                              <select class="form-control" id="tallaList" name="talla" disabled onchange="cargarModelo()"  title="Nombre la Talla"  class="select_talla" >
                                      <option  value='0'>Seleccione</option>
                                      <?php 
                                      $query = "SELECT cod_talla, nom_talla FROM ttalla ORDER BY nom_talla";
  
                                        if($resultado=$mysqli->query($query))
                                        {
                                          while($row = $resultado->fetch_assoc())
                                          {
                                          ?>
                                          <option <?php if($arreglo_buscar["talla"]==$row['cod_talla']) print('selected'); ?> value="<?php echo $row['cod_talla']; ?>"><?php echo $row['nom_talla']; ?></option>
                                          
                                          <?php
                                          }
                                        }
                                      ?>
                                     </select> <input type="hidden" name="texto_talla" id="texto_talla"> 
                                      </div>


                          
    			            </div>
			                <h6 class="col-sm-offset-4">Nota: Los Campos Marcados con (*) son Obligatorios.</h6>
		                    <hr>
		                        <div class="col-sm-12">
		                            <input type="submit" class="btn btn-default col-sm-offset-4"<?php if($existe=="si"){echo 'disabled';} ?>  name="btnGuardar"  value="Guardar">
		                            <input type="submit" class="btn btn-default" <?php if($existe=="si"){echo 'disabled';} ?> name="btnModificar" disabled value="Modificar">
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
    <script src="../js/js.js"></script>
</body>
</html>
<script type="text/javascript">
function costos(){ 
      var precio=document.form.pvp.value;
      var sin_iva;
      sin_iva=(precio/1.12);
       sin_iva=(sin_iva.toFixed(2));
      document.form.costo.value=sin_iva;
     };

 /*$("#paquete").change(function(event){

 	var paquete=document.form.paquete.value;
 	if(paquete==1){
 		document.form.cant_x_paquete.disabled=false;
 	}
  });*/
function actModificacion(){
  document.form.nombre.disabled=false;
  document.form.nombre.focus();
}
function f_tela(){
  document.form.pre_tela.disabled=false;
}
function f_talla(){
  document.form.talla.disabled=false;
}
function cargarModelo(){
  var textoModelo=document.getElementById("texto_modelo" );
var indice = document.form.nom_mod.selectedIndex;//aqui seleccionas el indice del option seleccionado
var texto=document.form.nom_mod.options[indice].text;//aqui guardas tu option
textoModelo.value=texto;
var textoTela=document.getElementById("texto_tela" );
var indice = document.form.nom_tela.selectedIndex;//aqui seleccionas el indice del option seleccionado
var texto=document.form.nom_tela.options[indice].text;//aqui guardas tu option
textoTela.value=texto;
var textoTipo=document.getElementById("texto_tipo" );
var indice = document.form.nom_tip.selectedIndex;//aqui seleccionas el indice del option seleccionado
var texto=document.form.nom_tip.options[indice].text;//aqui guardas tu option
textoTipo.value=texto;
var textoColor=document.getElementById("texto_color" );
var indice = document.form.pre_tela.selectedIndex;//aqui seleccionas el indice del option seleccionado
var texto=document.form.pre_tela.options[indice].text;//aqui guardas tu option
textoColor.value=texto;
var textoTalla=document.getElementById("texto_talla" );
var indice = document.form.talla.selectedIndex;//aqui seleccionas el indice del option seleccionado
var texto=document.form.talla.options[indice].text;//aqui guardas tu option
textoTalla.value=texto;
};

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
