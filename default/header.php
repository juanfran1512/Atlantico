
	<nav class="navbar navbar-inverse menu-nav" style="width: 100%;margin-left: 0px;margin-right: 0px;height: 20px;">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="index.php"><i class="glyphicon glyphicon-home" ></i></a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle linkmenu" data-toggle="dropdown" role="button" aria-expanded="false">Facturas<span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="visFactura.php">Factura</a></li>
	            <li><a href="visCompra.php">Compra</a></li>
			  </ul>
	        </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle linkmenu" data-toggle="dropdown" role="button" aria-expanded="false">Presupuestos<span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="visPresupuesto.php">Crear</a></li>
	            <li><a href="visListaPresupuesto.php">Listas</a></li>
			  </ul>
	        </li>
			<li class="dropdown">
	          <a href="#" class="dropdown-toggle linkmenu" data-toggle="dropdown" role="button" aria-expanded="false">Personas<span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="visCliente.php">Clientes</a></li>
	            <li><a href="visProveedor.php">Proveedores</a></li>
				</ul>
	        </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle linkmenu" data-toggle="dropdown" role="button" aria-expanded="false">Productos<span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="visProducto.php">Productos</a></li>
				<li><a href="visTipoProducto.php">Tipos de Productos</a></li>
				<li><a href="visModelo.php">Modelos</a></li>
				</ul>
	        </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle linkmenu" data-toggle="dropdown" role="button" aria-expanded="false">Tela<span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="visActTelas.php">Act. Precios</a></li>
	            <li><a href="visListaTelas.php">Listado</a></li>
				
				<li><a href="visTela.php">Telas</a></li>
				<?php 
					if($_SESSION["tipo"]=='1') {?>
					<li><a href="visTipoTela.php">Tipos de Tela</a></li>
					<li><a href="visPrecioColor.php">Precio del Color</a></li>
				<?php } ?>
				
				</ul>
	        </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle linkmenu" data-toggle="dropdown" role="button" aria-expanded="false">Usuarios<span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="visRegistroUsuario.php">Registro de Usuarios</a></li>
	            <li><a href="vista_construccion.php">Manual de Usuarios</a></li>
	            <li><a href="vista_construccion.php">Depuración</a></li>
	          </ul>
	        </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle linkmenu" data-toggle="dropdown" role="button" aria-expanded="false">Reportes<span class="caret"></span></a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="../reportes/reporte_clientes.php">Clientes</a></li>
	            <li><a href="../reporte_proveedor.php">Proveedores</a></li>
	            
	          </ul>
	        </li>
	      </ul>

	      <ul class="nav navbar-nav navbar-right">
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle linkmenu" data-toggle="dropdown" role="button" aria-expanded="false">
	          	<i class="glyphicon glyphicon-user"></i>
	          	<?php
	          	echo $_SESSION["nombre"];


	          	?>
	          	<span class="caret"></span>
	          </a>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="vista_construccion.php">Actualizar</a></li>
	            <li><a href="visCambioClave.php">Cambiar Contraseña</a></li>
	            <li><a href="visCambiarPreguntas.php">Cambiar Preguntas</a></li>
	            <li class="divider"></li>

	            <li><a href="../logout.php">salir</a></li>
	          </ul>
	        </li>
	      </ul>
	    </div><!-- /.navbar-colapse -->
	  </div><!-- /.container-fluid -->
	</nav>
