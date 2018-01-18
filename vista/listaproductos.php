<?php
error_reporting( error_reporting() & ~E_NOTICE );
include_once("../modelo/clsProducto.php");
//se crea el Objeto Producto de la clase Producto
$objProducto = new clsProducto();
//--------------------------------------------------------------------
//       Funcion para listar los Productos
//--------------------------------------------------------------------
		$objProducto->listar();
//se imprime la lista de Productos
    while($listaprod = $objProducto->row()){
    ?>
    <tr>
        <td><input type="button" class="btn btn-info cerrar" name="boton" value="+" onclick="enviarproducto(this)"></td>
        <td><?php echo $listaprod['cod_pro']; ?></td>
        <td><?php echo $listaprod['nom_pro']; ?></td>
		<td><?php echo $listaprod['pvp_pro']; ?></td>
		</tr>
    <?php
    }
		?>
