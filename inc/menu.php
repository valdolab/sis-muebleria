<!-- Sidebar -->
 <style>
      .sidebar-light{
        background: #f1f1f1 !important;

      }
 </style>

<ul class="navbar-nav bg-gradient sidebar accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
		<div class="sidebar-brand-icon">
			<img src="../img/menu3.png" class="img-thumbnail">
		</div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div style="color: grey;" class="sidebar-heading">
		Menú
	</div>

	<!-- Nav Item - Pages Collapse Menu -->
	<li class="nav-item secundary">
		<a class="nav-link collapsed text-dark" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
			<i class="fab fa-shopify"></i>
			<span style="font-size: 18px;">Ventas</span>
		</a>
		<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="nueva_venta.php">Nueva venta</a>
				<a class="collapse-item" href="ventas.php">Ventas</a>
			</div>
		</div>
	</li>

	<!-- Nav Item - Productos Collapse Menu -->
	<li class="nav-item secundary">
		<a class="nav-link collapsed text-dark" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-fw fa-clipboard-list"></i>
			<span style="font-size: 18px;">Productos</span>
		</a>
		<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="registro_producto.php">Nuevo Producto</a>
				<a class="collapse-item" href="lista_productos.php">Productos</a>
			</div>
		</div>
	</li>

	<!-- Nav Item - Clientes Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link collapsed text-dark" href="#" data-toggle="collapse" data-target="#collapseClientes" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-users"></i>
			<span style="font-size: 18px;">Clientes</span>
		</a>
		<div id="collapseClientes" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="agregar_cliente.php">Nuevo Clientes</a>
				<a class="collapse-item" href="clientes.php">Clientes</a>
			</div>
		</div>
	</li>
	<!-- Nav Item - Utilities Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link collapsed text-dark" href="#" data-toggle="collapse" data-target="#collapseProveedor" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-hospital"></i>
			<span style="font-size: 18px;">Proveedor</span>
		</a>
		<div id="collapseProveedor" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="registro_proveedor.php">Nuevo Proveedor</a>
				<a class="collapse-item" href="lista_proveedor.php">Proveedores</a>
			</div>
		</div>
	</li>

	<?php if ($_SESSION['idrol'] == 1) { ?>

		<li class="nav-item">
			<a class="nav-link collapsed text-dark" href="#" data-toggle="collapse" data-target="#collapseconfi" aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fas fa-fw fa-cog"></i>
				<span style="font-size: 18px;">Configuración</span>
			</a>
			<div id="collapseconfi" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="usuarios.php">Usuarios</a>
					<a class="collapse-item" href="documentos.php">Documentos</a>
					<a class="collapse-item" href="sucursales.php">Sucursales</a>
				</div>
			</div>
		</li>
	<?php } ?>

</ul>