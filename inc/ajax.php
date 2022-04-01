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

    $query_doc = mysqli_query($conexion, "DELETE FROM documento WHERE iddocumento = $id_documento");

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

    //primero consultar si tiene algun usuario o documento asignado para luego moverlo a  matriz
    //numbers of users
    $select_findusers = mysqli_query($conexion, "SELECT sucursal_idusuario from sucursal_usuario where sucursal_idsucursales = $id_sucursal");
    $numusers_assigned = mysqli_num_rows($select_findusers);

    //numbers of docs finded
    $select_finddocs = mysqli_query($conexion, "SELECT count(folio) as num_docs from documento where idsucursal = $id_sucursal");
    $numdocs_assigned = mysqli_fetch_assoc($select_finddocs)['num_docs'];
    //then find the ID from matrix
    $select_findMatriz = mysqli_query($conexion, "SELECT idsucursales from sucursales where matriz = 1");
    $id_sucursalmatriz = mysqli_fetch_assoc($select_findMatriz)['idsucursales'];

    if($numdocs_assigned > 0)
    {
      $cambio_docs_ok = 1;
      $insert_docs_matrix = mysqli_query($conexion, "UPDATE documento SET idsucursal = $id_sucursalmatriz");
      if(!$insert_docs_matrix)
      {
        $cambio_docs_ok = 0;
      }
    }
    else
    {
      $cambio_docs_ok = 1;
    }

    //set users to matrix if num_users > 0
    if($numusers_assigned > 0)
    {
      $flag_changeUsers = 1;
      //actualizar cada alumno de esta sucursal a la sucursal matriz
      while($row = mysqli_fetch_assoc($select_findusers))
      {
        //verificar si el usuario de esta sucursal a borrar no tiene asgnada paralelamente la sucursal matriz, si es así no hacer nada
        $finduserINmatriz = mysqli_query($conexion, "SELECT sucursal_idusuario from sucursal_usuario where sucursal_idusuario = '$row[sucursal_idusuario]' and sucursal_idsucursales = $id_sucursalmatriz");
        if(mysqli_num_rows($finduserINmatriz) == 0)
        {
          $insert_users_matriz = mysqli_query($conexion, "UPDATE sucursal_usuario SET sucursal_idsucursales = $id_sucursalmatriz where sucursal_idusuario = '$row[sucursal_idusuario]'");
          if(!$insert_users_matriz)
          {
            $flag_changeUsers = 0;
          }
        }
      }
    }
    else
    {
      $flag_changeUsers = 1;
    }

    //ahora si borramos la sucursal
    $query_delete_sucursal = mysqli_query($conexion, "DELETE FROM sucursales WHERE idsucursales = $id_sucursal");
    mysqli_close($conexion);
    //calcular si todo fue bien o no
    if ($query_delete_sucursal)
    {
      $elimino_sucursal = 1;
    }
    else
    {
      $elimino_sucursal = 0;
    }
    if ($elimino_sucursal == 1 and $cambio_docs_ok == 1 and $flag_changeUsers == 1)
    {
      $elimino_sucursal = 1;
    }
    else
    {
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

# #eliminar puesto
  if ($_POST['action'] == 'eliminarPuesto') {
  include "accion/conexion.php";
  if (!empty($_POST['puesto'])) {
    $id_puesto = $_POST['puesto'];

    $query_puesto = mysqli_query($conexion, "DELETE FROM puesto WHERE idpuesto = $id_puesto");

    mysqli_close($conexion);
    if ($query_puesto) {
      $elimino_puesto = 1;
    }else {
      $elimino_puesto = 0;
    }
    echo json_encode($elimino_puesto,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

# #eliminar zona
  if ($_POST['action'] == 'eliminarZona') {
  include "accion/conexion.php";
  if (!empty($_POST['zona'])) {
    $id_zona = $_POST['zona'];

    $query_zona = mysqli_query($conexion, "DELETE FROM zonas WHERE idzona = $id_zona");

    mysqli_close($conexion);
    if ($query_zona) {
      $elimino_zona = 1;
    }else {
      $elimino_zona = 0;
    }
    echo json_encode($elimino_zona,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

# #eliminar zona
  if ($_POST['action'] == 'eliminarSubzona') {
  include "accion/conexion.php";
  if (!empty($_POST['subzona'])) {
    $id_subzona = $_POST['subzona'];

    $query_subzona = mysqli_query($conexion, "DELETE FROM subzonas WHERE idsubzona = $id_subzona");

    mysqli_close($conexion);
    if ($query_subzona) {
      $elimino_subzona = 1;
    }else {
      $elimino_subzona = 0;
    }
    echo json_encode($elimino_subzona,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

##buscar datos sobre el puesto para poder editar puesto
  if ($_POST['action'] == 'SelectPuesto') {
  include "accion/conexion.php";
  if (!empty($_POST['puesto'])) {
    $id_puesto = $_POST['puesto'];

    $select_puesto = mysqli_query($conexion, "SELECT puesto,descripcion from puesto where idpuesto = $id_puesto");
    mysqli_close($conexion);
    $result = mysqli_num_rows($select_puesto);
    $data_puesto = '';
    if ($result > 0) {
      $data_puesto = mysqli_fetch_assoc($select_puesto);
    }else {
      $data_puesto = 0;
    }
    echo json_encode($data_puesto,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

##buscar datos sobre de la zona para poder editar zona
  if ($_POST['action'] == 'SelectZona') {
  include "accion/conexion.php";
  if (!empty($_POST['zona'])) {
    $id_zona = $_POST['zona'];

    $select_zona = mysqli_query($conexion, "SELECT zona from zonas where idzona = $id_zona");
    mysqli_close($conexion);
    $result_zona = mysqli_num_rows($select_zona);
    $data_zona = '';
    if ($result_zona > 0) {
      $data_zona = mysqli_fetch_assoc($select_zona);
    }else {
      $data_zona = 0;
    }
    echo json_encode($data_zona,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

##buscar datos sobre de la zona para poder editar zona
  if ($_POST['action'] == 'SelectSubzona') {
  include "accion/conexion.php";
  if (!empty($_POST['subzona'])) {
    $id_subzona = $_POST['subzona'];

    $select_subzona = mysqli_query($conexion, "SELECT subzona,idzona from subzonas where idsubzona = $id_subzona");
    mysqli_close($conexion);
    $result_subzona = mysqli_num_rows($select_subzona);
    $data_subzona = '';
    if ($result_subzona > 0) {
      $data_subzona = mysqli_fetch_assoc($select_subzona);
    }else {
      $data_subzona = 0;
    }
    echo json_encode($data_subzona,JSON_UNESCAPED_UNICODE);
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

      $query = mysqli_query($conexion, "SELECT idsubzona,subzona from subzonas where idzona=$idzona");
      if (mysqli_num_rows($query) > 0) 
      { 
        $cadena = "<option selected hidden value=''>Seleccione una colonia (subzona)</option>";
        while($row = mysqli_fetch_assoc($query))
        {
          $cadena = $cadena."<option value='".$row['idsubzona']."'>".$row['subzona']."</option>";
        }
      }
      else
      {
        $cadena = 0;
      }
      //calculamos si esa zona se esta en uso para no poder borrarlo
      $queryFind = mysqli_query($conexion, "SELECT idcliente from cliente where zona=$idzona");
      $resultFind = mysqli_num_rows($queryFind);
      $array = array("allow_delete" => $resultFind);
      $array_cadena = array("options" => $cadena);
      $array = $array + $array_cadena;
    echo json_encode($array,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

//buscar si la subzona esta siendo usada por algun usuario
if ($_POST['action'] == 'searchSubzonaUsed') 
{
  include "accion/conexion.php";
  if (!empty($_POST['subzona'])) {
      $idsubzona = $_POST['subzona'];

      //calculamos si esa zona se esta en uso para no poder borrarlo
      $queryFindsub = mysqli_query($conexion, "SELECT idcliente from cliente where subzona=$idsubzona");
      $resultFindsub = mysqli_num_rows($queryFindsub);
      #$array_sub = array("allow_delete" => $resultFindsub);
    echo json_encode($resultFindsub,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

//buscar si la subzona esta siendo usada por algun usuario
if ($_POST['action'] == 'searchPuestoUsed') 
{
  include "accion/conexion.php";
  if (!empty($_POST['puesto'])) {
      $idpuesto = $_POST['puesto'];

      //calculamos si esa zona se esta en uso para no poder borrarlo
      $queryFindpuesto = mysqli_query($conexion, "SELECT idusuario from usuario where puesto=$idpuesto");
      $resultFindsub = mysqli_num_rows($queryFindpuesto);
    echo json_encode($resultFindsub,JSON_UNESCAPED_UNICODE);
  }
  exit;
}
