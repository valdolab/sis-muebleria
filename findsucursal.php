<?php
// buscar sucirsal permitada por el usuario
require_once "inc/accion/conexion.php";
if ($_POST['action'] == 'searchSucursal') {
  if (!empty($_POST['usuario'])) {
    $idusuario = $_POST['usuario'];

    $query = mysqli_query($conexion, "SELECT idsucursales,sucursales from sucursales where idsucursales in (select sucursal_idsucursales from sucursal_usuario where sucursal_idusuario='$idusuario')");
    mysqli_close($conexion);
    $result = mysqli_num_rows($query);
    $data = '';
    if ($result > 0) {
      $data = mysqli_fetch_assoc($query);
      $array = array("multi" => $result);
      $data = $data + $array;
    }else {
      $data = 0;
    }
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
  }
  exit;
}
?>