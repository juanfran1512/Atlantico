<?php
	
	require ('../modelo/conexion.php');
	
	$id_producto = $_GET['producto_id'];
	
	echo '<select class="form-control" id="nom_mod" name="nom_mod" title="Nombre del Modelo"  class="select_modelo" >
                                      <option  value="">Seleccione</option>';
	
	$query = "SELECT cod_mod, nom_mod FROM tmodelo ORDER BY nom_mod";

	if($resultado=$mysqli->query($query))
	{
		while($row = $resultado->fetch_assoc())
		{
		?>
		<option value="<?php echo $row['cod_mod']; ?>"><?php echo $row['nom_mod']; ?></option>
		
		<?php
		}
	}
	echo '</select>';
?>