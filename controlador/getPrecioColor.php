<?php
	
	require ('../modelo/conexion.php');

	$tela = $_GET['color_id'];
	
	echo '<select class="form-control" id="precio" name="precio" onchange="f_precio()" title="Seleccione el Rango de Precio"  class="select_precio" >
                                      <option  value="0">Seleccione</option>';
	
	$query = "SELECT * FROM tprecio_color WHERE tipo_tela='$tela' ORDER BY nom_pre_col";
	echo $query;
	if($resultado=$mysqli->query($query))
	{
		while($row = $resultado->fetch_assoc())
		{
		?>
		<option value="<?php echo $row['cod_pre_col']; ?>"><?php echo $row['nom_pre_col']; ?></option>
		
		<?php
		}
	}
	echo '</select>';
?>