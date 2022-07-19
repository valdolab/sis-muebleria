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
	<?php 
		$id_usuario = $_SESSION['iduser'];
		$sqlpermisos_usuario = mysqli_query($conexion, "SELECT permiso_idpermiso FROM permiso_usuario where permiso_idusuario = '$id_usuario'");
		$array_permisos = [];
        while($row = mysqli_fetch_assoc($sqlpermisos_usuario)) 
        {
            $array_permisos[] = $row['permiso_idpermiso'];
        }
        #print_r($array_permisos);
        $num_permisos = sizeof($array_permisos);
        #PERMISOS
        if($_SESSION['rol'] == "SuperAdmin")
        {
        	#es super admin y titene permiso a TODO
        	$ventas = 1;
	        $nueva_venta = 1;
	        $editar_ventas = 1;
	        $productos = 1;
	        //hay que agregar el BD los nuevos
	        $inventario = 1;
	        //fin de nuevos
	        $nuevo_producto = 1;
	        $editar_productos = 1;
	        $eliminar_productos = 1;
	        $imagenes = 1;
	        $ver_costos = 1;
	        $editar_lista = 1;
	        $compras = 1;
	        $clientes = 1;
	        $nuevo_cliente = 1;
	        $editar_cliente_full = 1;
	        $editar_cliente_lim = 1;
	        $cobranza = 1;
	        $proveedor = 1;
	        $nuevo_proveedor = 1;
	        $editar_proveedor = 1;
	        $configuracion = 1;
	        $usuarios = 1;
	        $sucursales = 1;
	        $documentos = 1;
	        $general = 1;
        }
        else
        {
        	#permisos asignados
        	$ventas = in_array(1, $array_permisos);
	        $nueva_venta = in_array(2, $array_permisos);
	        $editar_ventas = in_array(3, $array_permisos);
	        $productos = in_array(4, $array_permisos);
	        //hay que agregar el BD los nuevos
	        $inventario = 1;
	        //fin de nuevos
	        $nuevo_producto = in_array(5, $array_permisos);
	        $editar_productos = in_array(6, $array_permisos);
	        $eliminar_productos = in_array(7, $array_permisos);
	        $imagenes =  in_array(8, $array_permisos);
	        $ver_costos =  in_array(9, $array_permisos);
	        $editar_lista =  in_array(10, $array_permisos);
	        $compras = in_array(11, $array_permisos);
	        $clientes = in_array(12, $array_permisos);
	        $nuevo_cliente = in_array(13, $array_permisos);
	        $editar_cliente_full = in_array(14, $array_permisos);
	        $editar_cliente_lim = in_array(15, $array_permisos);
	        $cobranza = in_array(16, $array_permisos);
	        $proveedor = in_array(17, $array_permisos);
	        $nuevo_proveedor = in_array(18, $array_permisos);
	        $editar_proveedor = in_array(19, $array_permisos);
	        $configuracion = in_array(20, $array_permisos);
	        $usuarios = in_array(21, $array_permisos);
	        $sucursales = in_array(22, $array_permisos);
	        $documentos = in_array(23, $array_permisos);
	        $general = in_array(24, $array_permisos);
        }
	 ?>
	
	<div id="opciones_menu" style="width: 50px;">
<?php if ($ventas) 
{ 
?>
	<li class="nav-item secundary">
		<a class="nav-link collapsed text-dark" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
			<i class="fab fa-shopify"></i>
			<span style="font-size: 18px;">Ventas</span>
		</a>
		<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="pagetemp.php">Ventas</a>
				<?php 
					if($nueva_venta)
					{
						echo '<a class="collapse-item" href="pagetemp.php">Nueva venta</a>';
					}
				 ?>
			</div>
		</div>
	</li>
<?php } ?>

<?php if ($productos) { ?>
	<li class="nav-item secundary">
		<a data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities" class="nav-link collapsed text-dark">
			<i class="fas fa-box"></i>
			<span style="font-size: 18px;">Productos</span>
		</a>
		<!--  -->
		<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="productos.php">Productos</a>
				<?php 
					if($compras)
					{
						echo '<a class="collapse-item" href="pagetemp.php">Compras</a>';
					}
				 ?>
			</div>
		</div>
		
	</li>
<?php } ?>

<?php if ($inventario) { ?>
	<li class="nav-item secundary">
		<a data-toggle="collapse" data-target="#collapseInventario" aria-expanded="true" aria-controls="collapseUtilities" class="nav-link collapsed text-dark">
			<i class="fas fa-fw fa-clipboard-list"></i>
			<span style="font-size: 18px;">Inventarios</span>
		</a>
		<!--  -->
		<div id="collapseInventario" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="inv_entradas.php">Entradas</a>
				<a class="collapse-item" href="inv_salidas.php">Salidas</a>
				<a class="collapse-item" href="inv_almacenes.php">Almacenes</a>
			</div>
		</div>
		
	</li>
<?php } ?>

<?php if ($clientes) { ?>
	<li class="nav-item">
		<a class="nav-link collapsed text-dark" href="#" data-toggle="collapse" data-target="#collapseClientes" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-users"></i>
			<span style="font-size: 18px;">Clientes</span>
		</a>
		<div id="collapseClientes" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="clientes.php">Clientes</a>
				<?php 
					if($nuevo_cliente)
					{
						echo '<a class="collapse-item" href="agregar_cliente.php">Nuevo Cliente</a>';
					}

					if($cobranza)
					{
						echo '<a class="collapse-item" href="pagetemp.php">Cobranza</a>';
					}
				 ?>
			</div>
		</div>
	</li>
<?php } ?>

<?php if ($proveedor) { ?>
	<li class="nav-item">
		<a class="nav-link collapsed text-dark" href="#" data-toggle="collapse" data-target="#collapseProveedor" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-hospital"></i>
			<span style="font-size: 18px;">Proveedor</span>
		</a>
		<div id="collapseProveedor" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="pagetemp.php">Proveedores</a>
				<?php 
					if($nuevo_proveedor)
					{
						echo '<a class="collapse-item" href="pagetemp.php">Nuevo Proveedor</a>';
					}
				 ?>
			</div>
		</div>
	</li>
<?php } ?>

	<?php if ($configuracion) { ?>

		<li class="nav-item">
			<a class="nav-link collapsed text-dark" href="#" data-toggle="collapse" data-target="#collapseconfi" aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fas fa-fw fa-cog"></i>
				<span style="font-size: 18px;">Configuración</span>
			</a>
			<div id="collapseconfi" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<?php 
						if($sucursales)
						{
							echo '<a class="collapse-item" href="sucursales.php">Sucursales</a>';
						}
						if($usuarios)
						{
							echo '<a class="collapse-item" href="usuarios.php">Usuarios</a>';
						}
						if($documentos)
						{
							echo '<a class="collapse-item" href="documentos.php">Documentos</a>';
						}
						if($general)
						{
							echo '<a class="collapse-item" href="pagetemp.php">General</a>';
						}
					 ?>
				</div>
			</div>
		</li>
	<?php } ?>

	</div>
</ul>