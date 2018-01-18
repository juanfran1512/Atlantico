<?php
	error_reporting(0);
	require ('../modelo/conexion.php');
	
	$id_tipotela = $_GET['tipotela_id'];
	
	echo '<select class="form-control" id="tipo_tela" name="tipo_tela"   onchange="cargarTipo()" title="Nombre del Tipo"  class="select_tipo" >
                                      <option  value="">Seleccione</option>';
	
	$query = "SELECT cod_tipo_tela, nom_tipo_tela FROM ttipo_tela ORDER BY nom_tipo_tela";

	if($resultado=$mysqli->query($query))
	{
		while($row = $resultado->fetch_assoc())
		{
		?>
		<option <?php if($arreglo_buscar["tipo_tela"]==$row['cod_tipo_tela']) print('selected'); ?> value="<?php echo $row['cod_tipo_tela']; ?>"><?php echo $row['nom_tipo_tela']; ?></option>
		
		<?php
		}
	}
	echo '</select><input type="hidden" name="texto_tipo" id="texto_tipo">';
?>