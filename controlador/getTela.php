<?php
	
	require ('../modelo/conexion.php');

	$tela = $_GET['producto_id'];
	
	echo '<select class="form-control" id="telaList" name="pre_tela" onchange="f_tela()" title="Seleccione el Color"  class="select_tela" >
                                      <option  value="0">Seleccione</option>';
	
	$query = "SELECT * FROM ttela WHERE tipo_tela='$tela' ORDER BY nom_tela";

	if($resultado=$mysqli->query($query))
	{
		while($row = $resultado->fetch_assoc())
		{
		?>
		<option value="<?php echo $row['cod_tela']; ?>"><?php echo $row['nom_tela']; ?></option>
		
		<?php
		}
	}
	echo '</select>';
?>