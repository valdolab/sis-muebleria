<?php
# #eliminar usuario
if ($_POST['action'] == 'eliminarUsuario') {
include "accion/conexion.php";
  if (!empty($_POST['usuario'])) {
    $idusuario = $_POST['usuario'];

    $query_delete2 = mysqli_query($conexion, "DELETE FROM sucursal_usuario WHERE sucursal_idusuario = '$idusuario'");

    $query_select1 = mysqli_query($conexion,"SELECT *  from permiso_usuario WHERE sucursal_idusuario = '$idusuario'");
    if (mysqli_num_rows($query_select1) > 0)
    {
      $query_delete3 = mysqli_query($conexion, "DELETE FROM permiso_usuario WHERE permiso_idusuario = '$idusuario'");
    }
    else
    {
      $query_delete3 = 1;
    }
    $query_delete = mysqli_query($conexion, "DELETE FROM usuario WHERE idusuario = '$idusuario'");

    mysqli_close($conexion);
    if ($query_delete and $query_delete2 and $query_delete3) {
      $elimino_usuario = 1;
    }else {
      $elimino_usuario = 0;
    }
    echo json_encode($elimino_usuario,JSON_UNESCAPED_UNICODE);
  }
  exit;
}
  # #eliminar documento
  if ($_POST['action'] == 'eliminarDocumento') {
  include "accion/conexion.php";
  if (!empty($_POST['documento'])) {
    $id_documento = $_POST['documento'];

    $query_doc = mysqli_query($conexion, "DELETE FROM documento WHERE iddocumento = '$id_documento'");

    mysqli_close($conexion);
    if ($query_doc) {
      $elimino_doc = 1;
    }else {
      $elimino_doc = 0;
    }
    echo json_encode($elimino_doc,JSON_UNESCAPED_UNICODE);
  }
  exit;
}
  #eliminar sucursal
  if ($_POST['action'] == 'eliminarSucursal') {
  include "accion/conexion.php";
  if (!empty($_POST['sucursal'])) {
    $id_sucursal = $_POST['sucursal'];

    $query_delete_sucursal = mysqli_query($conexion, "DELETE FROM sucursales WHERE idsucursales = $id_sucursal");

    mysqli_close($conexion);
    if ($query_delete_sucursal) {
      $elimino_sucursal = 1;
    }else {
      $elimino_sucursal = 0;
    }
    echo json_encode($elimino_sucursal,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

#eliminar cliente
if ($_POST['action'] == 'eliminarCliente') 
{
  include "accion/conexion.php";
  if (!empty($_POST['cliente'])) {
    $id_cliente = $_POST['cliente'];
    $query_delete_cliente = mysqli_query($conexion, "DELETE FROM cliente WHERE idcliente = '$id_cliente'");
    $query_delete_cliente_refs = mysqli_query($conexion, "DELETE FROM referencias_cliente WHERE idcliente = '$id_cliente'");

    mysqli_close($conexion);
    if ($query_delete_cliente and $query_delete_cliente_refs) 
    {
      $elimino_cliente = 1;
    }else {
      $elimino_cliente = 0;
    }
    echo json_encode($elimino_cliente,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

  #suspender sucursal
  if ($_POST['action'] == 'suspenderSucursal') {
  include "accion/conexion.php";
  if (!empty($_POST['sucursal'])) {
    $id_sucursal = $_POST['sucursal'];

    $sql1 = mysqli_query($conexion, "SELECT estado from sucursales where idsucursales = $id_sucursal");
    $estado = mysqli_fetch_array($sql1)['estado'];
    if ($estado == 0)
    {
      $newestado = 1;
    }
    else
    {
      $newestado = 0;
    }

    $query_update_sucursal = mysqli_query($conexion, "UPDATE sucursales SET estado = $newestado where idsucursales = $id_sucursal");

    mysqli_close($conexion);
    if ($query_update_sucursal) {
      $suspendio_sucursal = 1;
    }else {
      $suspendio_sucursal = 0;
    }

    if ($suspendio_sucursal == 1 and $newestado == 0)
    {
      $suspendio_sucursal = 1;
    }
    else if($suspendio_sucursal == 1 and $newestado == 1)
    {
      $suspendio_sucursal = 2;
    }
    echo json_encode($suspendio_sucursal,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

#suspender cliente
  if ($_POST['action'] == 'suspenderCliente') {
  include "accion/conexion.php";
  if (!empty($_POST['cliente'])) {
    $id_cliente = $_POST['cliente'];

    $sql1 = mysqli_query($conexion, "SELECT estado_cliente from cliente where idcliente = '$id_cliente'");
    $estadoCliente = mysqli_fetch_array($sql1)['estado_cliente'];
    if ($estadoCliente == 0)
    {
      $newestadoCliente = 1;
    }
    else
    {
      $newestadoCliente = 0;
    }

    $query_update_cliente = mysqli_query($conexion, "UPDATE cliente SET estado_cliente = $newestadoCliente where idcliente = '$id_cliente'");

    mysqli_close($conexion);
    if ($query_update_cliente) 
    {
      $suspendio_cliente = 1;
    }else {
      $suspendio_cliente = 0;
    }

    if ($suspendio_cliente == 1 and $newestadoCliente == 0)
    {
      $suspendio_cliente = 1;
    }
    else if($suspendio_cliente == 1 and $newestadoCliente == 1)
    {
      $suspendio_cliente = 2;
    }
    echo json_encode($suspendio_cliente,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

#asignar como matriz a sucursal
  #eliminar sucursal
  if ($_POST['action'] == 'asignarSucursalMatriz') {
  include "accion/conexion.php";
  if (!empty($_POST['sucursal'])) {
    $id_sucursal = $_POST['sucursal'];

    $sql_select2 = mysqli_query($conexion, "SELECT idsucursales,sucursales from sucursales where matriz = 1");
    $sucursal_old_matriz = mysqli_fetch_assoc($sql_select2);

    $new_name_nomatriz = explode("-", $sucursal_old_matriz['sucursales']);
    $id_sucursal_old_matrix = $sucursal_old_matriz['idsucursales'];
    $sql_select3 = mysqli_query($conexion, "UPDATE sucursales SET sucursales = '$new_name_nomatriz[0]' where idsucursales = $id_sucursal_old_matrix");

    $sql2 = mysqli_query($conexion, "UPDATE sucursales set matriz = 0");
    $query_update2 = mysqli_query($conexion, "UPDATE sucursales SET matriz = 1 where idsucursales = $id_sucursal");

    $sql_select = mysqli_query($conexion, "SELECT sucursales from sucursales where idsucursales = $id_sucursal");
    $name_old_sucursal = mysqli_fetch_array($sql_select)[0];

    $new_name_sucursal = $name_old_sucursal."-Matriz";
    $query_update3 = mysqli_query($conexion, "UPDATE sucursales SET sucursales = '$new_name_sucursal' where idsucursales = $id_sucursal");

    mysqli_close($conexion);
    if ($query_update2) {
      $asigno_matriz = 1;
    }else {
      $asigno_matriz = 0;
    }
    echo json_encode($asigno_matriz,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

// buscar subzonas apartir de las zonas
if ($_POST['action'] == 'searchSubzonas') 
{
  include "accion/conexion.php";
  if (!empty($_POST['zona'])) {
    $idzona = $_POST['zona'];

    if($idzona=="newzona")
    {
      $cadena = "<select id='subzona' name='subzona' class='form-control' required><option selected hidden value=''>Seleccione una colonia (subzona)</option></select>";
    }
    else
    {
      $query = mysqli_query($conexion, "SELECT idsubzona,subzona from subzonas where idzona=$idzona");
      if (mysqli_num_rows($query) > 0) 
      { 
        $cadena = "<select id='subzona' name='subzona' class='form-control' required><option selected hidden value=''>Seleccione una colonia (subzona)</option>";
        while($row = mysqli_fetch_assoc($query))
        {
          $cadena = $cadena."<option value='".$row['idsubzona']."'>".$row['subzona']."</option>";
        }
        $cadena = $cadena."</select>";
      }
      else
      {
        $cadena = 0;
      }
    }

    echo json_encode($cadena,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

