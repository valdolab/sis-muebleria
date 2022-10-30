<?php
ob_start();
session_start();
if (empty($_SESSION['active'])) {
	header('location: ../');
}
include "functions.php";
include "accion/conexion.php";
// datos Empresa

$idsucursal = $_SESSION['idsucursal'];
$iduser = $_SESSION['iduser'];
$query2 = mysqli_query($conexion, "SELECT sucursales from sucursales where idsucursales = $idsucursal");
$dato = mysqli_fetch_array($query2)['sucursales'];
$name_sucursal = $dato;

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta lang="es">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Muebleria</title>

	<!-- Custom styles for this template-->
	<link rel="icon" href="../img/compra_facil.png">
	<link href="../css/sb-admin-3.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/datatables.min">
	<link href="../css/select2.min.css" rel="stylesheet">
	<link href="../css/bootstrap4-toggle.min.css" rel="stylesheet">
	<link href="../css/datatables.min.css" rel="stylesheet">
	<link href="../js/jquery-ui/jquery-ui.css" rel="stylesheet">
	<style type="text/css">
		.div-interno{
			  zoom: 75%;
			}
	</style>
</head>

<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper" >
		<?php include_once "menu.php"; ?>
		<!-- Content Wrapper -->
		<div style="background-color: white;" id="content-wrapper" class="d-flex flex-column">
			<!-- Main Content -->
			<div id="content" style="background-color: #f4f4f4;">
				<!-- Topbar -->
				<style type="text/css">
				.light{
			        background: #f4f4f4 !important;
			      }
			      </style>
				<nav style="background-color: white;" class="navbar navbar-expand navbar bg text topbar mb-4 static-top shadow">
					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>
					<div class="input-group">
						<!-- <p class="ml-auto"><strong>Tuxtla Gutiérrez, </strong><?php #echo fecha(); ?></p>-->
					</div>

					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">

						<div class="topbar-divider d-none d-sm-block"></div>

						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" id="selectSucursal" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span title="Da click para cambiar sucursal" style="font-size: 15px;" class="mr-2 d-none d-lg-inline small text-dark"> <strong>Sucursal: </strong> <?php echo $name_sucursal; ?></span>
							</a>

							<!-- Cambio de sucursales --> <!-- 
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="selectSucursal">

								<?php 
									#Este es para cuando SI hay noficaciones
									$idsucursal = $_SESSION['idsucursal'];
									$query = mysqli_query($conexion,"SELECT sucursales from sucursales where idsucursales!=$idsucursal");
			          				#mostrar vista previa de las norificaciones
			          				while($row = mysqli_fetch_assoc($query))
			          				{
			          					echo "<a class='dropdown-item' href='cambiar_sucursal.php'>
											<i class='fas fa-hospital fa-sm fa-fw mr-2 text-gray-400'></i>
											".$row['sucursales']."
										</a>
										<div class='dropdown-divider'></div>";
			          				}
								 ?>
							</div>-->
						</li>
					</ul>

					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">

						<div class="topbar-divider d-none d-sm-block"></div>

						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span style="font-size: 15px;" class="mr-2 d-none d-lg-inline small text-dark"><?php echo $_SESSION['nombre']; ?></span>
							</a>
							<!-- Dropdown - User Information -->
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<?php 
									$dicc_perfil = "perfil.php";
								 ?>
								<a class="dropdown-item" href="<?php echo $dicc_perfil; ?>">
									<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
									Perfil
								</a>
								<div class="dropdown-divider"></div>

								<a class="dropdown-item" href="accion/salir.php">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Salir
								</a>

							</div>
						</li>
					</ul>

					<?php 
						#si no no es superadministrador que no tenga las nofiticaciones
						if ($_SESSION['rol'] == "SuperAdmin") 
						{
					 ?>

					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">

						<div class="topbar-divider d-none d-sm-block"></div>

						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle text-dark" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline small text-dark"> 						
					<?php 
						#Este es para cuando SI hay noficaciones
						$query = mysqli_query($conexion,"SELECT idnotificaciones, mensaje, fecha, hora from newnotificacion");
          				$notif = mysqli_num_rows($query);
						if ($notif == 1) 
						{
							echo "<i  class='fas fa-bell fa-2x'></i>";
						}
						else
						{
							# Este es para cuando NO hay noficaciones 
							echo "<i  class='far fa-bell fa-2x'></i>";
						}
						echo "</span>";
						echo $notif;
						echo "</a>";
					 ?>
					 <!-- Dropdown - User Information -->
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
									<?php 
										if ($notif == 0)
										{
											echo "<a class='dropdown-item' href='#''>";
											echo "No hay Nofificaciones nuevas";
											echo "</a>";
										}
										else
										{
											#mostrar vista previa de las norificaciones
											while($row = mysqli_fetch_assoc($query))
											{
												echo "<a class='dropdown-item' href='#''>";
												echo "<i  class='far fa-envelope fa-2x'></i> &nbsp;&nbsp;";
												echo $row['mensaje'];
												echo "</a>";
												echo "<div class='dropdown-divider'></div>";
											}
											#$querynoti = mysqli_query($conexion,"SELECT idnotificaciones, mensaje, fecha, hora from newnotificacion");
											#$datosnoti = mysqli_fetch_array($querynoti);
											#$query2 = mysqli_query($conexion,'INSERT INTO notificaciones (idnotificaciones, mensaje, fecha, hora) VALUES ("$datosnoti["idnotificaciones"]", "$datosnoti["mensaje"]", "$datosnoti["fecha"]", "$datosnoti["hora"]")'); 
										}
									 ?>
							</div>
						</li>
					</ul>

					<?php } #este es el corchete para lo del if de rol
					ob_end_flush();
					 ?>

				</nav>

<div id="divzoom" class="div-interno">
