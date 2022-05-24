<?php 
ob_start(); 
include_once "header.php"; 
include "accion/conexion.php";

$query_usuarios = mysqli_query($conexion, "SELECT COUNT(idusuario) as num_usuarios FROM usuario");
$result_usu = mysqli_fetch_array($query_usuarios)['num_usuarios'];
$query_clientes = mysqli_query($conexion, "SELECT COUNT(idcliente) as num_clientes FROM cliente");
$result_cli = mysqli_fetch_array($query_clientes)['num_clientes'];
$query_producto = mysqli_query($conexion, "SELECT COUNT(idproducto) as num_producto FROM producto");
$result_pro = mysqli_fetch_array($query_producto)['num_producto'];
#$query_productos = mysqli_query($conexion, "SELECT COUNT(idusuario) as num_productos FROM usuario");
#$query_ventas = mysqli_query($conexion, "SELECT COUNT(idusuario) as num_ventas FROM usuario");

#echo $_SESSION['idsucursal'];
?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Panel de Administración</h1>
	</div>
	
	<!-- Content Row -->
	<div class="row">

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="usuarios.php">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Usuarios</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result_usu; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-user fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="clientes.php">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Clientes</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result_cli; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-users fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>

		<!-- Earnings (Monthly) Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="pagetemp.php">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Productos proveedor</div>
							<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $result_pro; ?></div>
							<!--<div class="row no-gutters align-items-center">
								<div class="col-auto">
									
								</div>
								<div class="col">
									<div class="progress progress-sm mr-2">
										<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>-->
						</div>
						<div class="col-auto">
							<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>

		<!-- Pending Requests Card Example -->
		<a class="col-xl-3 col-md-6 mb-4" href="pagetemp.php">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Ventas</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo 0; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</a>
	</div>
	<!-- Page Heading --><!--
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Configuración</h1>
	</div>
-->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php  ob_end_flush(); include_once "footer.php"; ?>