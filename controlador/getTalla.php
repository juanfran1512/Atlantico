<?php
	
	require ('../modelo/conexion.php');

	$juvenil = $_GET['talla_id'];
	
	echo '<select class="form-control" id="nom_talla" name="nom_talla" onchange="f_talla()" title="Seleccione la Talla"  class="select_modelo" >
                                      <option  value="0">Seleccione</option>';
	
	$query = "SELECT * FROM ttalla WHERE juvenil='$juvenil' ORDER BY cod_talla";

	if($resultado=$mysqli->query($query))
	{
		while($row = $resultado->fetch_assoc())
		{
		?>
		<option value="<?php echo $row['cod_talla']; ?>"><?php echo $row['nom_talla']; ?></option>
		
		<?php
		}
	}
	echo '</select>';
?>