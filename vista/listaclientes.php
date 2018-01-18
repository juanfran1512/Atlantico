<?php
error_reporting( error_reporting() & ~E_NOTICE );
include_once("../modelo/clsCliente.php");
//se crea el Objeto Cliente de la clase Cliente
$objCliente = new clsCliente();

//--------------------------------------------------------------------
//       Funcion para listar los clientes
//--------------------------------------------------------------------
		$objCliente->listar();
//se imprime la lista de clientes
    while($listacli = $objCliente->row()){
    ?>
    <tr>
        <td><input type="button" class="btn btn-info cerrar" name="boton" value="+" onclick="enviarcliente(this)"></td>
        <td><?php echo $listacli['rif_cli']; ?></td>
        <td><?php echo $listacli['nom_cli']; ?></td>
        <td><?php echo $listacli['tlfn_cli']; ?></td>
        <td><?php echo $listacli['dir_cli']; ?></td>
  </tr>
    <?php
    }
		?>
