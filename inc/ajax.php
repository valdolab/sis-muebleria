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

    $query_puesto = mysqli_query($conexion, "DELETE FROM puesto WHERE idpuesto = '$id_puesto'");

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

    $query_zona = mysqli_query($conexion, "DELETE FROM zonas WHERE idzona = '$id_zona'");

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

    $query_subzona = mysqli_query($conexion, "DELETE FROM subzonas WHERE idsubzona = '$id_subzona'");

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

# #eliminar tipo
  if ($_POST['action'] == 'eliminarTipo') {
  include "accion/conexion.php";
  if (!empty($_POST['tipo'])) {
    $id_tipo = $_POST['tipo'];

    $query_tipo = mysqli_query($conexion, "DELETE FROM tipo WHERE idtipo = '$id_tipo'");

    mysqli_close($conexion);
    if ($query_tipo) {
      $elimino_tipo= 1;
    }else {
      $elimino_tipo = 0;
    }
    echo json_encode($elimino_tipo,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

function deleteAll($dir) {
    foreach(glob($dir . '/*') as $file) {
        if(is_dir($file))
            deleteAll($file);
        else
            unlink($file);
    }
    rmdir($dir);
}

#eliminar cat
  if ($_POST['action'] == 'eliminarCategoria') {
  include "accion/conexion.php";
  if (!empty($_POST['categoria'])) 
  {
    $id_cat = $_POST['categoria'];

    $select_cat = mysqli_query($conexion, "SELECT nombre from categoria where idcategoria = '$id_cat'");
    $nom_cat = mysqli_fetch_assoc($select_cat)['nombre'];
    $estructura = "../img/catalogo_productos/".$nom_cat;
    deleteAll($estructura);

    $query_cat = mysqli_query($conexion, "DELETE FROM categoria WHERE idcategoria = '$id_cat'");
    //$elimino_cat = 1;

    mysqli_close($conexion);
    if ($query_cat) {
      $elimino_cat= 1;
    }else {
      $elimino_cat = 0;
    }
    echo json_encode($elimino_cat,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

#eliminar subcat
  if ($_POST['action'] == 'eliminarSubCat') {
  include "accion/conexion.php";
  if (!empty($_POST['subcategoria'])) 
  {
    $id_subcat = $_POST['subcategoria'];

    $select_subcat = mysqli_query($conexion, "SELECT subcategoria.nombre as subcat, categoria.nombre as cat from subcategoria inner join categoria on categoria.idcategoria = subcategoria.categoria where idsubcategoria = '$id_subcat'");
    $data_subcat = mysqli_fetch_assoc($select_subcat);
    $cat = $data_subcat['cat'];
    $subcat = $data_subcat['subcat'];
    //creamos la ubicacion
    $estructura = "../img/catalogo_productos/".$cat."/".$subcat;
    deleteAll($estructura);

    $query_subcat = mysqli_query($conexion, "DELETE FROM subcategoria WHERE idsubcategoria = '$id_subcat'");
    //$elimino_subcat = 1;

    mysqli_close($conexion);
    if ($query_subcat) {
      $elimino_subcat= 1;
    }else {
      $elimino_subcat = 0;
    }
    echo json_encode($elimino_subcat,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

#eliminar PRODUCTO
  if ($_POST['action'] == 'eliminarProducto') {
  include "accion/conexion.php";
  if (!empty($_POST['producto'])) 
  {
    $id_producto = $_POST['producto'];

    $select_producto = mysqli_query($conexion, "SELECT subcategoria from producto WHERE idproducto = '$id_producto'");
        //aqui vamos a ver si tienen foto o no, para mostrar los iconos acorde
        $datap = mysqli_fetch_assoc($select_producto);
        if($datap['subcategoria'] == null)
        {
            //no tiene sub
            $select_producto_nosub = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, atr1_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria WHERE idproducto = '$id_producto'");
            $data_producto = mysqli_fetch_assoc($select_producto_nosub);
            $catproducto = $data_producto['catproducto'];
            $atr1_producto = $data_producto['atr1_producto'];
            //creamos la ubicacion
            $estructura = "../img/catalogo_productos/".$catproducto."/".$atr1_producto;
        }
        else
        {
            //si tiene sub
            $select_producto_full = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, subcategoria.nombre as subcat_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria INNER JOIN subcategoria on subcategoria.idsubcategoria = producto.subcategoria WHERE idproducto = '$id_producto'");
            $data_producto = mysqli_fetch_assoc($select_producto_full);
            $catproducto = $data_producto['catproducto'];
            $subcat_producto = $data_producto['subcat_producto'];
            $atr1_producto = $data_producto['atr1_producto'];
             //creamos la ubicacion
            $estructura = "../img/catalogo_productos/".$catproducto."/".$subcat_producto."/".$atr1_producto;
        }
        $archivador = $estructura."/".$id_producto.".png";//.$extencion;

    if (!is_dir($archivador)) 
    {
      unlink($archivador);
    }
    
    $query_producto = mysqli_query($conexion, "DELETE FROM producto WHERE idproducto = '$id_producto'");


    mysqli_close($conexion);
    if ($query_producto) {
      $elimino_producto= 1;
    }else {
      $elimino_producto = 0;
    }
    echo json_encode($elimino_producto,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

##buscar datos sobre el tipo para poder editar tipo
  if ($_POST['action'] == 'SelectTipo') {
  include "accion/conexion.php";
  if (!empty($_POST['tipo'])) {
    $id_tipo = $_POST['tipo'];

    $select_tipo = mysqli_query($conexion, "SELECT idtipo,nombre_tipo from tipo where idtipo = '$id_tipo'");
    mysqli_close($conexion);
    $result = mysqli_num_rows($select_tipo);
    $data_tipo = '';
    if ($result > 0) 
    {
      $data_tipo = mysqli_fetch_assoc($select_tipo);
    }else {
      $data_tipo = 0;
    }
    echo json_encode($data_tipo,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

##buscar datos sobre el puesto para poder editar puesto
  if ($_POST['action'] == 'SelectPuesto') {
  include "accion/conexion.php";
  if (!empty($_POST['puesto'])) {
    $id_puesto = $_POST['puesto'];

    $select_puesto = mysqli_query($conexion, "SELECT puesto,descripcion from puesto where idpuesto = '$id_puesto'");
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
  if ($_POST['action'] == 'SelectSubzona') {
  include "accion/conexion.php";
  if (!empty($_POST['subzona'])) {
    $id_subzona = $_POST['subzona'];

    $select_subzona = mysqli_query($conexion, "SELECT subzona,idzona from subzonas where idsubzona = '$id_subzona'");
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

##buscar datos sobre de la categoria para poder editar categoria
  if ($_POST['action'] == 'SelectCategoria') 
  {
  include "accion/conexion.php";
  if (!empty($_POST['categoria'])) 
  {
    $id_cat = $_POST['categoria'];

    $select_cat = mysqli_query($conexion, "SELECT * from categoria where idcategoria = '$id_cat'");
    mysqli_close($conexion);
    $result_cat = mysqli_num_rows($select_cat);
    $data_cat = '';
    if ($result_cat > 0) 
    {
      $data_cat = mysqli_fetch_assoc($select_cat);
    }
    else 
    {
      $data_cat = 0;
    }
    echo json_encode($data_cat,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

##buscar datos sobre de la subcategoria para poder editarlos
  if ($_POST['action'] == 'SelectSubCat') 
  {
  include "accion/conexion.php";
  if (!empty($_POST['subcategoria'])) 
  {
    $id_subcat = $_POST['subcategoria'];

    $select_subcat = mysqli_query($conexion, "SELECT * from subcategoria where idsubcategoria = '$id_subcat'");
    mysqli_close($conexion);
    $result_subcat = mysqli_num_rows($select_subcat);
    $data_subcat = '';
    if ($result_subcat > 0) 
    {
      $data_subcat = mysqli_fetch_assoc($select_subcat);
    }
    else 
    {
      $data_subcat = 0;
    }
    echo json_encode($data_subcat,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

##buscar datos sobre de la producto para poder editarlo
  if ($_POST['action'] == 'SelectProducto') 
  {
  include "accion/conexion.php";
  if (!empty($_POST['producto'])) 
  {
    $id_producto = $_POST['producto'];

    $select_producto = mysqli_query($conexion, "SELECT * from producto where idproducto = '$id_producto'");
    mysqli_close($conexion);
    $result_producto = mysqli_num_rows($select_producto);
    if ($result_producto > 0) 
    {
      $data_producto = mysqli_fetch_assoc($select_producto);
    }
    else 
    {
      $data_producto = 0;
    }
    echo json_encode($data_producto,JSON_UNESCAPED_UNICODE);
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

      $query = mysqli_query($conexion, "SELECT idsubzona,subzona from subzonas where idzona = '$idzona'");
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
      $queryFind = mysqli_query($conexion, "SELECT count(idcliente) as num from cliente where zona = '$idzona'");
      $resultFind = (int) mysqli_fetch_assoc($queryFind)['num'];

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
      $queryFindsub = mysqli_query($conexion, "SELECT count(idcliente) as num from cliente where subzona = '$idsubzona'");
      $resultFindsub = (int) mysqli_fetch_assoc($queryFindsub)['num'];
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
      $queryFindpuesto = mysqli_query($conexion, "SELECT count(idusuario) as num from usuario where puesto = '$idpuesto'");
      $resultFindpuesto = (int) mysqli_fetch_assoc($queryFindpuesto)['num'];
    echo json_encode($resultFindpuesto,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

//buscar si la subzona esta siendo usada por algun usuario
if ($_POST['action'] == 'searchTipoUsed') 
{
  include "accion/conexion.php";
  if (!empty($_POST['tipo'])) {
      $idtipo = $_POST['tipo'];

      //calculamos si esa zona se esta en uso para no poder borrarlo
      $queryFindtipo = mysqli_query($conexion, "SELECT count(idsucursales) as num from sucursales where tipo = '$idtipo'");
      $resultFindtipo = (int) mysqli_fetch_assoc($queryFindtipo)['num'];
    echo json_encode($resultFindtipo,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

//buscar si la categoria esta siendo usada por algun producto y las subcategorias que tengan esa categoria
if ($_POST['action'] == 'searchCatUsed') 
{
  ob_start();
  session_start();

  include "accion/conexion.php";
  if (!empty($_POST['categoria'])) 
  {
      $idcategoria = $_POST['categoria'];

      //calculamos si esa zona se esta en uso para no poder borrarlo
      $queryFindcat = mysqli_query($conexion, "SELECT count(idproducto) as num from producto where categoria = '$idcategoria'");
      $Findcat = (int) mysqli_fetch_assoc($queryFindcat)['num'];

      //buscamos que subtegorias tiene esa categoria
        $FindSubcats = mysqli_query($conexion, "SELECT idsubcategoria,nombre FROM subcategoria WHERE categoria = '$idcategoria' order by nombre asc");
        if (mysqli_num_rows($FindSubcats) > 0) 
        { 
          $cadena = "<option selected hidden value=''>Selecciona subcategoría</option>";
          while($row = mysqli_fetch_assoc($FindSubcats))
          {
            $cadena = $cadena."<option value='".$row['idsubcategoria']."'>".$row['nombre']."</option>";
          }
          //no mostrar los atributos
          $atrs_productos = 0;
          $atr_labels = 0;
          
        }
        else
        {
          $cadena = 0;
          //buscamos los atributos de categoria
          $select_atributos = mysqli_query($conexion, "SELECT atr1, atr2, atr3, atr4, atr5 from categoria where idcategoria = '$idcategoria'");
          $atr_labels = mysqli_fetch_assoc($select_atributos);
          $select_atrs_productos = mysqli_query($conexion, "SELECT atr1_producto, atr2_producto, atr3_producto, atr4_producto, atr5_producto from producto where categoria = '$idcategoria'");

          $atrs_productos = Array();
          while($row = mysqli_fetch_assoc($select_atrs_productos)) 
          {
              $atrs_productos[] = $row;
          }
        }

        //calculamos la tabla a mostrar que sean solo de esa categoria
          $cadenaTabla = '
<table class="table" id="tbl_productos">
        <thead class="thead-light">
            <tr>
                <th>Descripción</th>
                <th>Nuevo costo</th>
                <th>Costo actual</th>
                <th>Costo+IVA</th>
                <th>Nuevo Ext.-P</th>
                <th>Ext.-P</th>
                <th>Ext-M</th>
                <th>Contado</th>
                <th>Especial</th>
                <th>CR1</th>
                <th>P1</th>
                <th>CR2</th>
                <th>P2</th>
                <th>E-Q</th>
                <th>GAR</th>
                <th style="text-align: center;">Herramientas</th>
            </tr>
        </thead>
        <tbody>';
     
            $query = mysqli_query($conexion, "SELECT * from producto where categoria = '$idcategoria' order by creado_en desc");
            $result = mysqli_num_rows($query);
            if ($result > 0) 
            {
                while ($data = mysqli_fetch_assoc($query)) 
                {
                    $id_producto = $data['idproducto'];
                    $identificador = $data['identificador'];
                    //aqui vamos a ver si tienen foto o no, para mostrar los iconos acorde
                    if($data['subcategoria'] == null)
                    {
                        $idcategoria = $data['categoria'];
                        $query_meses = mysqli_query($conexion, "SELECT meses_garantia from categoria where idcategoria = '$idcategoria'");
                        $garantia = mysqli_fetch_assoc($query_meses)['meses_garantia'];

                        //no tiene sub
                        $select_producto_nosub = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, atr1_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria WHERE idproducto = '$id_producto'");
                        $data_producto = mysqli_fetch_assoc($select_producto_nosub);
                        $catproducto = $data_producto['catproducto'];
                        $atr1_producto = $data_producto['atr1_producto'];
                        //creamos la ubicacion
                        $estructura = "../img/catalogo_productos/".$catproducto."/".$atr1_producto;
                    }
                    else
                    {
                        $idsubcategoria = $data['subcategoria'];
                        $query_meses = mysqli_query($conexion, "SELECT meses_garantia from subcategoria where idsubcategoria = '$idsubcategoria'");
                        $garantia = mysqli_fetch_assoc($query_meses)['meses_garantia'];

                        $select_producto_full = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, subcategoria.nombre as subcat_producto, atr1_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria INNER JOIN subcategoria on subcategoria.idsubcategoria = producto.subcategoria WHERE idproducto = '$id_producto'");
                        $data_producto = mysqli_fetch_assoc($select_producto_full);
                        $catproducto = $data_producto['catproducto'];
                        $subcat_producto = $data_producto['subcat_producto'];
                        $atr1_producto = $data_producto['atr1_producto'];
                        //creamos la ubicacion
                        $estructura = "../img/catalogo_productos/".$catproducto."/".$subcat_producto."/".$atr1_producto;
                    }
                    //aqui vamos a ver si tienen foto o no, para mostrar los iconos acorde
                    $archivador = $estructura."/".$identificador.".png";
                    if(is_file($archivador))
                    {
                        $boton_img = "btn btn-primary btn-sm";
                        $siimagen = 1;
                    }
                    else
                    {
                        $boton_img = "btn btn-secondary btn-sm";
                        $siimagen = 0;
                    }

                $cadenaTabla = $cadenaTabla.'<tr>
                    <td>'.$data['descripcion'].'</td>
                        <td width="110"><input type="number" name="nuevo_costo[]" id="nuevo_costo[]" class="form-control"><input type="text" name="flag_new_costo_idproducto[]" id="flag_new_costo_idproducto[]" value="<?php echo $id_producto; ?>" readonly hidden></td>
                        <td>'."$".number_format($data['costo'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_iva'],2, '.', ',').'</td>
                        <td width="110"><input type="number" name="nuevo_ext_p[]" id="nuevo_ext_p[]" class="form-control"><input type="text" name="flag_new_extp_idproducto[]" id="flag_new_extp_idproducto[]" value="<?php echo $id_producto; ?>" readonly hidden></td>
                        <td>'.$data['ext_p'].'</td>
                        <td>---</td>
                        <td>'."$".number_format($data['costo_contado'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_especial'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_cr1'],2, '.', ',').'</td>
                        <td>'.$data['costo_p1'].'</td>
                        <td>'."$".number_format($data['costo_cr2'],2, '.', ',').'</td>
                        <td>'.$data['costo_p2'].'</td>
                        <td>'."$".number_format($data['costo_eq'],2, '.', ',').'</td>
                        <td>'.$garantia." Meses".'</td>';

                $cadenaTabla = $cadenaTabla.'<td align="center">';

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
                      $editar_productos = 1;
                      $eliminar_productos = 1;
                      $imagenes = 1;
                    }
                    else
                    {
                      #permisos asignados
                      $editar_productos = in_array(6, $array_permisos);
                      $eliminar_productos = in_array(7, $array_permisos);
                      $imagenes =  in_array(8, $array_permisos);
                    }
                    $cadenaTabla = $cadenaTabla.'<button data-toggle="modal" data-target="#img_producto" onclick="mostrar_img(\''.$id_producto.'\',\''.$archivador.'\',\''.$siimagen.'\');" class="'.$boton_img.'"><i class="fas fa-camera"></i></button>';
                    $cadenaTabla = $cadenaTabla."&nbsp;";
                    if($editar_productos)
                    {
                      $cadenaTabla = $cadenaTabla.'<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#nuevo_producto" onclick="editar_producto(\''.$id_producto.'\');"><i class="fas fa-edit"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>';
                    }
                    $cadenaTabla = $cadenaTabla."&nbsp;";
                    if($eliminar_productos)
                    {
                      $cadenaTabla = $cadenaTabla.'<button onClick="eliminar_producto(\''.$id_producto.'\');" class="btn btn-danger btn-sm" type="submit"><i style="color: white;" class="fas fa-trash-alt"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="btn btn-danger btn-sm" type="submit"><i style="color: white;" class="fas fa-trash-alt"></i></button>';
                    }
                $cadenaTabla = $cadenaTabla.'</td></tr>';
              }
            }
        $cadenaTabla = $cadenaTabla.'</tbody></table>';

        $atrs_productos = array("atrs_productos" => $atrs_productos);
        $atr_labels = array("atr_labels" => $atr_labels);

        $cadenaTabla = array("cadenaTabla" => $cadenaTabla);
        $options = array("options" => $cadena);
        $catUsed = array("catUsed" => $Findcat);
        $resultFindcat = $catUsed + $options + $cadenaTabla + $atrs_productos + $atr_labels;

    echo json_encode($resultFindcat,JSON_UNESCAPED_UNICODE);
  }
  ob_end_flush();
  exit;
}

//buscar si la subcategoria esta siendo usada por algun producto
if ($_POST['action'] == 'searchSubCatUsed') 
{
  ob_start();
  session_start();

  include "accion/conexion.php";
  if (!empty($_POST['subcategoria'])) {
      $idsubcategoria = $_POST['subcategoria'];

      //calculamos si esa zona se esta en uso para no poder borrarlo
      $queryFindsubcat = mysqli_query($conexion, "SELECT count(idproducto) as num from producto where subcategoria = '$idsubcategoria'");
      $subcatused = (int) mysqli_fetch_assoc($queryFindsubcat)['num'];

      //buscamos los atributos de categoria
          $select_atributos = mysqli_query($conexion, "SELECT atr1, atr2, atr3, atr4, atr5 from subcategoria where idsubcategoria = '$idsubcategoria'");
          $atr_labels = mysqli_fetch_assoc($select_atributos);
          $select_atrs_productos = mysqli_query($conexion, "SELECT atr1_producto, atr2_producto, atr3_producto, atr4_producto, atr5_producto from producto where subcategoria = '$idsubcategoria'");

          $atrs_productos = Array();
          while($row = mysqli_fetch_assoc($select_atrs_productos)) 
          {
              $atrs_productos[] = $row;
          }

      //calculamos la tabla a mostrar que sean solo de esa categoria
          $cadenaTabla = '
<table class="table" id="tbl_productos">
        <thead class="thead-light">
            <tr>
                <th>Descripción</th>
                <th>Nuevo costo</th>
                <th>Costo actual</th>
                <th>Costo+IVA</th>
                <th>Ext.-P</th>
                <th>Ext-M</th>
                <th>Contado</th>
                <th>Especial</th>
                <th>CR1</th>
                <th>P1</th>
                <th>CR2</th>
                <th>P2</th>
                <th>E-Q</th>
                <th>GAR</th>
                <th style="text-align: center;">Herramientas</th>
            </tr>
        </thead>
        <tbody>';
     
            $query = mysqli_query($conexion, "SELECT * from producto where subcategoria = '$idsubcategoria' order by creado_en desc");
            $result = mysqli_num_rows($query);
            if ($result > 0) 
            {
                while ($data = mysqli_fetch_assoc($query)) 
                {
                    $id_producto = $data['idproducto'];
                    $identificador = $data['identificador'];
                        $idsubcategoria = $data['subcategoria'];
                        $query_meses = mysqli_query($conexion, "SELECT meses_garantia from subcategoria where idsubcategoria = '$idsubcategoria'");
                        $garantia = mysqli_fetch_assoc($query_meses)['meses_garantia'];

                        $select_producto_full = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, subcategoria.nombre as subcat_producto, atr1_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria INNER JOIN subcategoria on subcategoria.idsubcategoria = producto.subcategoria WHERE idproducto = '$id_producto'");
                        $data_producto = mysqli_fetch_assoc($select_producto_full);
                        $catproducto = $data_producto['catproducto'];
                        $subcat_producto = $data_producto['subcat_producto'];
                        $atr1_producto = $data_producto['atr1_producto'];
                        //creamos la ubicacion
                        $estructura = "../img/catalogo_productos/".$catproducto."/".$subcat_producto."/".$atr1_producto;

                    //aqui vamos a ver si tienen foto o no, para mostrar los iconos acorde
                    $archivador = $estructura."/".$identificador.".png";
                    if(is_file($archivador))
                    {
                        $boton_img = "btn btn-primary btn-sm";
                        $siimagen = 1;
                    }
                    else
                    {
                        $boton_img = "btn btn-secondary btn-sm";
                        $siimagen = 0;
                    }

                $cadenaTabla = $cadenaTabla.'<tr>
                    <td>'.$data['descripcion'].'</td>
                        <td><input type="number" name="nuevo_costo" id="nuevo_costo" class="form-control"></td>
                        <td>'."$".number_format($data['costo'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_iva'],2, '.', ',').'</td>
                        <td>'.$data['ext_p'].'</td>
                        <td>---</td>
                        <td>'."$".number_format($data['costo_contado'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_especial'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_cr1'],2, '.', ',').'</td>
                        <td>'.$data['costo_p1'].'</td>
                        <td>'."$".number_format($data['costo_cr2'],2, '.', ',').'</td>
                        <td>'.$data['costo_p2'].'</td>
                        <td>'."$".number_format($data['costo_eq'],2, '.', ',').'</td>
                        <td>'.$garantia." Meses".'</td>';

                $cadenaTabla = $cadenaTabla.'<td align="center">';

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
                      $editar_productos = 1;
                      $eliminar_productos = 1;
                      $imagenes = 1;
                    }
                    else
                    {
                      #permisos asignados
                      $editar_productos = in_array(6, $array_permisos);
                      $eliminar_productos = in_array(7, $array_permisos);
                      $imagenes =  in_array(8, $array_permisos);
                    }
                    if($imagenes)
                    {
                      $cadenaTabla = $cadenaTabla.'<button data-toggle="modal" data-target="#img_producto" onclick="mostrar_img(\''.$id_producto.'\',\''.$archivador.'\',\''.$siimagen.'\');" class="'.$boton_img.'"><i class="fas fa-camera"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="'.$boton_img.'"><i class="fas fa-camera"></i></button>';
                    }
                    $cadenaTabla = $cadenaTabla."&nbsp;";
                    if($editar_productos)
                    {
                      $cadenaTabla = $cadenaTabla.'<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#nuevo_producto" onclick="editar_producto(\''.$id_producto.'\');"><i class="fas fa-edit"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>';
                    }
                    $cadenaTabla = $cadenaTabla."&nbsp;";
                    if($eliminar_productos)
                    {
                      $cadenaTabla = $cadenaTabla.'<button onClick="eliminar_producto(\''.$id_producto.'\');" class="btn btn-danger btn-sm" type="submit"><i style="color: white;" class="fas fa-trash-alt"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="btn btn-danger btn-sm" type="submit"><i style="color: white;" class="fas fa-trash-alt"></i></button>';
                    }
                $cadenaTabla = $cadenaTabla.'</td></tr>';

              }
            }
        $cadenaTabla = $cadenaTabla.'</tbody></table>';

        $atrs_productos = array("atrs_productos" => $atrs_productos);
        $atr_labels = array("atr_labels" => $atr_labels);

      $cadenaTabla = array("cadenaTabla" => $cadenaTabla);
      $subcatused = array("subcatused" => $subcatused);
      $resultFindsubcat = $subcatused + $cadenaTabla + $atrs_productos + $atr_labels;

    echo json_encode($resultFindsubcat,JSON_UNESCAPED_UNICODE);
  }
  ob_end_flush();
  exit;
}

//buscar si tiene subcategoria la categoria
if ($_POST['action'] == 'FindAtrsCat') 
{
  include "accion/conexion.php";
  if (!empty($_POST['categoria'])) 
  {
      $idcategoria = $_POST['categoria'];

      //calculamos si esa zona se esta en uso para no poder borrarlo
      $queryFindDatacat = mysqli_query($conexion, "SELECT * FROM categoria where idcategoria = '$idcategoria'");
      $resultQueryFindDataCat = mysqli_fetch_assoc($queryFindDatacat);
      $tiene_subcat = $resultQueryFindDataCat['tiene_subcat'];
      if($tiene_subcat == 1)
      {
        //buscamos que subtegorias tiene esa categoria
        $FindSubcats = mysqli_query($conexion, "SELECT idsubcategoria,nombre FROM subcategoria WHERE categoria = '$idcategoria' order by nombre asc");
        $cadena = "<option selected hidden value=''>Agregar una subcategoria</option>";
        if (mysqli_num_rows($FindSubcats) > 0) 
        { 
          $cadena = "<option selected hidden value=''>Seleccione subcategoría</option>";
          while($row = mysqli_fetch_assoc($FindSubcats))
          {
            $cadena = $cadena."<option value='".$row['idsubcategoria']."'>".$row['nombre']."</option>";
          }
        }
        $options = array("options" => $cadena);
        $tiene_subcat = array("tiene_subcat" => $tiene_subcat);
        $resultFindAtrscat = $tiene_subcat + $options;
      }
      else
      {
        //cargamos todo el array
        $resultFindAtrscat = $resultQueryFindDataCat;
      }

    echo json_encode($resultFindAtrscat,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

//buscar si tiene subcategoria la categoria
if ($_POST['action'] == 'FindAtrsSubCat') 
{
  include "accion/conexion.php";
  if (!empty($_POST['subcategoria'])) 
  {
      $idsubcategoria = $_POST['subcategoria'];

      //calculamos si esa zona se esta en uso para no poder borrarlo
      $queryFindDataSubcat = mysqli_query($conexion, "SELECT * FROM subcategoria where idsubcategoria = '$idsubcategoria'");
      $resultQueryFindDataSubCat = mysqli_fetch_assoc($queryFindDataSubcat);
      //cargamos todo el array
      $resultFindAtrsSubcat = $resultQueryFindDataSubCat;
      
    echo json_encode($resultFindAtrsSubcat,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

//====== CONSULTAS PARA LOS FILTROS POR ATRIBUTOS
//ATR1
if ($_POST['action'] == 'searchForAtr1') 
{
  ob_start();
  session_start();
  include "accion/conexion.php";
  if (!empty($_POST['atr1'])) 
  {
      $atr1 = $_POST['atr1'];
      $atr2 = $_POST['atr2'];
      $atr3 = $_POST['atr3'];
      $atr4 = $_POST['atr4'];
      $atr5 = $_POST['atr5'];
      $idcategoria = $_POST['idcat'];
      $idsubcategoria = $_POST['idsubcat'];
      
      $cadenaTabla = '
<table class="table" id="tbl_productos">
        <thead class="thead-light">
            <tr>
                <th>Descripción</th>
                <th>Nuevo costo</th>
                <th>Costo actual</th>
                <th>Costo+IVA</th>
                <th>Ext.-P</th>
                <th>Ext-M</th>
                <th>Contado</th>
                <th>Especial</th>
                <th>CR1</th>
                <th>P1</th>
                <th>CR2</th>
                <th>P2</th>
                <th>E-Q</th>
                <th>GAR</th>
                <th style="text-align: center;">Herramientas</th>
            </tr>
        </thead>
        <tbody>';
          
            if($atr1 != "LABEL")
            {
              $query_sql = "SELECT * from producto where atr1_producto like '$atr1'";
            }
            else
            {
              $query_sql = "SELECT * from producto WHERE 1";
            }
            //los demas filtros anidados
            if($atr2 != "LABEL")
            {
              $query_sql = $query_sql." and atr2_producto like '$atr2'";
            }
            if($atr3 != "LABEL")
            {
              $query_sql = $query_sql." and atr3_producto like '$atr3'";
            }
            if($atr4 != "LABEL")
            {
              $query_sql = $query_sql." and atr4_producto like '$atr4'";
            }
            if($atr5 != "LABEL")
            {
              $query_sql = $query_sql." and atr5_producto like '$atr5'";
            }

          if($idsubcategoria == "NoSubcat")
          {
            $query_sql = $query_sql." and categoria = '$idcategoria' order by creado_en desc";
          }
          else
          {
            $query_sql = $query_sql." and categoria = '$idcategoria' and subcategoria = '$idsubcategoria' order by creado_en desc";
          }

            $query = mysqli_query($conexion, $query_sql);
            $result = mysqli_num_rows($query);
            if ($result > 0) 
            {
                while ($data = mysqli_fetch_assoc($query)) 
                {
                  $id_producto = $data['idproducto'];
                  $identificador = $data['identificador'];
                  if($data['subcategoria'] == null)
                    {
                        $idcategoria = $data['categoria'];
                        $query_meses = mysqli_query($conexion, "SELECT meses_garantia from categoria where idcategoria = '$idcategoria'");
                        $garantia = mysqli_fetch_assoc($query_meses)['meses_garantia'];

                        //no tiene sub
                        $select_producto_nosub = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, atr1_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria WHERE idproducto = '$id_producto'");
                        $data_producto = mysqli_fetch_assoc($select_producto_nosub);
                        $catproducto = $data_producto['catproducto'];
                        $atr1_producto = $data_producto['atr1_producto'];
                        //creamos la ubicacion
                        $estructura = "../img/catalogo_productos/".$catproducto."/".$atr1_producto;
                    }
                    else
                    {
                        $idsubcategoria = $data['subcategoria'];
                        $query_meses = mysqli_query($conexion, "SELECT meses_garantia from subcategoria where idsubcategoria = '$idsubcategoria'");
                        $garantia = mysqli_fetch_assoc($query_meses)['meses_garantia'];

                        $select_producto_full = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, subcategoria.nombre as subcat_producto, atr1_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria INNER JOIN subcategoria on subcategoria.idsubcategoria = producto.subcategoria WHERE idproducto = '$id_producto'");
                        $data_producto = mysqli_fetch_assoc($select_producto_full);
                        $catproducto = $data_producto['catproducto'];
                        $subcat_producto = $data_producto['subcat_producto'];
                        $atr1_producto = $data_producto['atr1_producto'];
                        //creamos la ubicacion
                        $estructura = "../img/catalogo_productos/".$catproducto."/".$subcat_producto."/".$atr1_producto;
                    }                    
                    //aqui vamos a ver si tienen foto o no, para mostrar los iconos acorde
                    $archivador = $estructura."/".$identificador.".png";
                    if(is_file($archivador))
                    {
                        $boton_img = "btn btn-primary btn-sm";
                        $siimagen = 1;
                    }
                    else
                    {
                        $boton_img = "btn btn-secondary btn-sm";
                        $siimagen = 0;
                    }

                $cadenaTabla = $cadenaTabla.'<tr>
                    <td>'.$data['descripcion'].'</td>
                        <td><input type="number" name="nuevo_costo" id="nuevo_costo" class="form-control"></td>
                        <td>'."$".number_format($data['costo'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_iva'],2, '.', ',').'</td>
                        <td>'.$data['ext_p'].'</td>
                        <td>---</td>
                        <td>'."$".number_format($data['costo_contado'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_especial'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_cr1'],2, '.', ',').'</td>
                        <td>'.$data['costo_p1'].'</td>
                        <td>'."$".number_format($data['costo_cr2'],2, '.', ',').'</td>
                        <td>'.$data['costo_p2'].'</td>
                        <td>'."$".number_format($data['costo_eq'],2, '.', ',').'</td>
                        <td>'.$garantia." Meses".'</td>';

                $cadenaTabla = $cadenaTabla.'<td align="center">';

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
                      $editar_productos = 1;
                      $eliminar_productos = 1;
                      $imagenes = 1;
                    }
                    else
                    {
                      #permisos asignados
                      $editar_productos = in_array(6, $array_permisos);
                      $eliminar_productos = in_array(7, $array_permisos);
                      $imagenes =  in_array(8, $array_permisos);
                    }
                    if($imagenes)
                    {
                      $cadenaTabla = $cadenaTabla.'<button data-toggle="modal" data-target="#img_producto" onclick="mostrar_img(\''.$id_producto.'\',\''.$archivador.'\',\''.$siimagen.'\');" class="'.$boton_img.'"><i class="fas fa-camera"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="'.$boton_img.'"><i class="fas fa-camera"></i></button>';
                    }
                    $cadenaTabla = $cadenaTabla."&nbsp;";
                    if($editar_productos)
                    {
                      $cadenaTabla = $cadenaTabla.'<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#nuevo_producto" onclick="editar_producto(\''.$id_producto.'\');"><i class="fas fa-edit"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>';
                    }
                    $cadenaTabla = $cadenaTabla."&nbsp;";
                    if($eliminar_productos)
                    {
                      $cadenaTabla = $cadenaTabla.'<button onClick="eliminar_producto(\''.$id_producto.'\');" class="btn btn-danger btn-sm" type="submit"><i style="color: white;" class="fas fa-trash-alt"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="btn btn-danger btn-sm" type="submit"><i style="color: white;" class="fas fa-trash-alt"></i></button>';
                    }
                $cadenaTabla = $cadenaTabla.'</td></tr>';
              }
            }
        $cadenaTabla = $cadenaTabla.'</tbody></table>';

        $cadenaTabla = array("cadenaTabla" => $cadenaTabla);
        $resultFindforAtr = $cadenaTabla;
      
    echo json_encode($resultFindforAtr,JSON_UNESCAPED_UNICODE);
  }
  ob_end_flush();
  exit;
}
//ATR2
if ($_POST['action'] == 'searchForAtr2') 
{
  ob_start();
  session_start();
  include "accion/conexion.php";
  if (!empty($_POST['atr2'])) 
  {
      $atr1 = $_POST['atr1'];
      $atr2 = $_POST['atr2'];
      $atr3 = $_POST['atr3'];
      $atr4 = $_POST['atr4'];
      $atr5 = $_POST['atr5'];
      $idcategoria = $_POST['idcat'];
      $idsubcategoria = $_POST['idsubcat'];
      
      $cadenaTabla = '
<table class="table" id="tbl_productos">
        <thead class="thead-light">
            <tr>
                <th>Descripción</th>
                <th>Nuevo costo</th>
                <th>Costo actual</th>
                <th>Costo+IVA</th>
                <th>Ext.-P</th>
                <th>Ext-M</th>
                <th>Contado</th>
                <th>Especial</th>
                <th>CR1</th>
                <th>P1</th>
                <th>CR2</th>
                <th>P2</th>
                <th>E-Q</th>
                <th>GAR</th>
                <th style="text-align: center;">Herramientas</th>
            </tr>
        </thead>
        <tbody>';
          
          if($atr2 != "LABEL")
            {
              $query_sql = "SELECT * from producto where atr2_producto like '$atr2'";
            }
            else
            {
              $query_sql = "SELECT * from producto WHERE 1";
            }
            //los demas filtros anidados
            if($atr1 != "LABEL")
            {
              $query_sql = $query_sql." and atr1_producto like '$atr1'";
            }
            if($atr3 != "LABEL")
            {
              $query_sql = $query_sql." and atr3_producto like '$atr3'";
            }
            if($atr4 != "LABEL")
            {
              $query_sql = $query_sql." and atr4_producto like '$atr4'";
            }
            if($atr5 != "LABEL")
            {
              $query_sql = $query_sql." and atr5_producto like '$atr5'";
            }

          if($idsubcategoria == "NoSubcat")
          {
            $query_sql = $query_sql." and categoria = '$idcategoria' order by creado_en desc";
          }
          else
          {
            $query_sql = $query_sql." and categoria = '$idcategoria' and subcategoria = '$idsubcategoria' order by creado_en desc";
          }

            $query = mysqli_query($conexion, $query_sql);
            $result = mysqli_num_rows($query);
            if ($result > 0) 
            {
                while ($data = mysqli_fetch_assoc($query)) 
                {
                  $id_producto = $data['idproducto'];
                  $identificador = $data['identificador'];
                  if($data['subcategoria'] == null)
                    {
                        $idcategoria = $data['categoria'];
                        $query_meses = mysqli_query($conexion, "SELECT meses_garantia from categoria where idcategoria = '$idcategoria'");
                        $garantia = mysqli_fetch_assoc($query_meses)['meses_garantia'];

                        //no tiene sub
                        $select_producto_nosub = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, atr1_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria WHERE idproducto = '$id_producto'");
                        $data_producto = mysqli_fetch_assoc($select_producto_nosub);
                        $catproducto = $data_producto['catproducto'];
                        $atr1_producto = $data_producto['atr1_producto'];
                        //creamos la ubicacion
                        $estructura = "../img/catalogo_productos/".$catproducto."/".$atr1_producto;
                    }
                    else
                    {
                        $idsubcategoria = $data['subcategoria'];
                        $query_meses = mysqli_query($conexion, "SELECT meses_garantia from subcategoria where idsubcategoria = '$idsubcategoria'");
                        $garantia = mysqli_fetch_assoc($query_meses)['meses_garantia'];

                        $select_producto_full = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, subcategoria.nombre as subcat_producto, atr1_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria INNER JOIN subcategoria on subcategoria.idsubcategoria = producto.subcategoria WHERE idproducto = '$id_producto'");
                        $data_producto = mysqli_fetch_assoc($select_producto_full);
                        $catproducto = $data_producto['catproducto'];
                        $subcat_producto = $data_producto['subcat_producto'];
                        $atr1_producto = $data_producto['atr1_producto'];
                        //creamos la ubicacion
                        $estructura = "../img/catalogo_productos/".$catproducto."/".$subcat_producto."/".$atr1_producto;
                    }                    
                    //aqui vamos a ver si tienen foto o no, para mostrar los iconos acorde
                    $archivador = $estructura."/".$identificador.".png";
                    if(is_file($archivador))
                    {
                        $boton_img = "btn btn-primary btn-sm";
                        $siimagen = 1;
                    }
                    else
                    {
                        $boton_img = "btn btn-secondary btn-sm";
                        $siimagen = 0;
                    }

                $cadenaTabla = $cadenaTabla.'<tr>
                    <td>'.$data['descripcion'].'</td>
                        <td><input type="number" name="nuevo_costo" id="nuevo_costo" class="form-control"></td>
                        <td>'."$".number_format($data['costo'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_iva'],2, '.', ',').'</td>
                        <td>'.$data['ext_p'].'</td>
                        <td>---</td>
                        <td>'."$".number_format($data['costo_contado'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_especial'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_cr1'],2, '.', ',').'</td>
                        <td>'.$data['costo_p1'].'</td>
                        <td>'."$".number_format($data['costo_cr2'],2, '.', ',').'</td>
                        <td>'.$data['costo_p2'].'</td>
                        <td>'."$".number_format($data['costo_eq'],2, '.', ',').'</td>
                        <td>'.$garantia." Meses".'</td>';

                $cadenaTabla = $cadenaTabla.'<td align="center">';

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
                      $editar_productos = 1;
                      $eliminar_productos = 1;
                      $imagenes = 1;
                    }
                    else
                    {
                      #permisos asignados
                      $editar_productos = in_array(6, $array_permisos);
                      $eliminar_productos = in_array(7, $array_permisos);
                      $imagenes =  in_array(8, $array_permisos);
                    }
                    if($imagenes)
                    {
                      $cadenaTabla = $cadenaTabla.'<button data-toggle="modal" data-target="#img_producto" onclick="mostrar_img(\''.$id_producto.'\',\''.$archivador.'\',\''.$siimagen.'\');" class="'.$boton_img.'"><i class="fas fa-camera"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="'.$boton_img.'"><i class="fas fa-camera"></i></button>';
                    }
                    $cadenaTabla = $cadenaTabla."&nbsp;";
                    if($editar_productos)
                    {
                      $cadenaTabla = $cadenaTabla.'<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#nuevo_producto" onclick="editar_producto(\''.$id_producto.'\');"><i class="fas fa-edit"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>';
                    }
                    $cadenaTabla = $cadenaTabla."&nbsp;";
                    if($eliminar_productos)
                    {
                      $cadenaTabla = $cadenaTabla.'<button onClick="eliminar_producto(\''.$id_producto.'\');" class="btn btn-danger btn-sm" type="submit"><i style="color: white;" class="fas fa-trash-alt"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="btn btn-danger btn-sm" type="submit"><i style="color: white;" class="fas fa-trash-alt"></i></button>';
                    }
                $cadenaTabla = $cadenaTabla.'</td></tr>';
              }
            }
        $cadenaTabla = $cadenaTabla.'</tbody></table>';

        $cadenaTabla = array("cadenaTabla" => $cadenaTabla);
        $resultFindforAtr = $cadenaTabla;
      
    echo json_encode($resultFindforAtr,JSON_UNESCAPED_UNICODE);
  }
  ob_end_flush();
  exit;
}
//ATR3
if ($_POST['action'] == 'searchForAtr3') 
{
  ob_start();
  session_start();
  include "accion/conexion.php";
  if (!empty($_POST['atr3'])) 
  {
      $atr1 = $_POST['atr1'];
      $atr2 = $_POST['atr2'];
      $atr3 = $_POST['atr3'];
      $atr4 = $_POST['atr4'];
      $atr5 = $_POST['atr5'];
      $idcategoria = $_POST['idcat'];
      $idsubcategoria = $_POST['idsubcat'];
      
      $cadenaTabla = '
<table class="table" id="tbl_productos">
        <thead class="thead-light">
            <tr>
                <th>Descripción</th>
                <th>Nuevo costo</th>
                <th>Costo actual</th>
                <th>Costo+IVA</th>
                <th>Ext.-P</th>
                <th>Ext-M</th>
                <th>Contado</th>
                <th>Especial</th>
                <th>CR1</th>
                <th>P1</th>
                <th>CR2</th>
                <th>P2</th>
                <th>E-Q</th>
                <th>GAR</th>
                <th style="text-align: center;">Herramientas</th>
            </tr>
        </thead>
        <tbody>';
          
          if($atr3 != "LABEL")
            {
              $query_sql = "SELECT * from producto where atr3_producto like '$atr3'";
            }
            else
            {
              $query_sql = "SELECT * from producto WHERE 1";
            }
            //los demas filtros anidados
            if($atr2 != "LABEL")
            {
              $query_sql = $query_sql." and atr2_producto like '$atr2'";
            }
            if($atr1 != "LABEL")
            {
              $query_sql = $query_sql." and atr1_producto like '$atr1'";
            }
            if($atr4 != "LABEL")
            {
              $query_sql = $query_sql." and atr4_producto like '$atr4'";
            }
            if($atr5 != "LABEL")
            {
              $query_sql = $query_sql." and atr5_producto like '$atr5'";
            }

          if($idsubcategoria == "NoSubcat")
          {
            $query_sql = $query_sql." and categoria = '$idcategoria' order by creado_en desc";
          }
          else
          {
            $query_sql = $query_sql." and categoria = '$idcategoria' and subcategoria = '$idsubcategoria' order by creado_en desc";
          }

            $query = mysqli_query($conexion, $query_sql);
            $result = mysqli_num_rows($query);
            if ($result > 0) 
            {
                while ($data = mysqli_fetch_assoc($query)) 
                {
                  $id_producto = $data['idproducto'];
                  $identificador = $data['identificador'];
                  if($data['subcategoria'] == null)
                    {
                        $idcategoria = $data['categoria'];
                        $query_meses = mysqli_query($conexion, "SELECT meses_garantia from categoria where idcategoria = '$idcategoria'");
                        $garantia = mysqli_fetch_assoc($query_meses)['meses_garantia'];

                        //no tiene sub
                        $select_producto_nosub = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, atr1_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria WHERE idproducto = '$id_producto'");
                        $data_producto = mysqli_fetch_assoc($select_producto_nosub);
                        $catproducto = $data_producto['catproducto'];
                        $atr1_producto = $data_producto['atr1_producto'];
                        //creamos la ubicacion
                        $estructura = "../img/catalogo_productos/".$catproducto."/".$atr1_producto;
                    }
                    else
                    {
                        $idsubcategoria = $data['subcategoria'];
                        $query_meses = mysqli_query($conexion, "SELECT meses_garantia from subcategoria where idsubcategoria = '$idsubcategoria'");
                        $garantia = mysqli_fetch_assoc($query_meses)['meses_garantia'];

                        $select_producto_full = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, subcategoria.nombre as subcat_producto, atr1_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria INNER JOIN subcategoria on subcategoria.idsubcategoria = producto.subcategoria WHERE idproducto = '$id_producto'");
                        $data_producto = mysqli_fetch_assoc($select_producto_full);
                        $catproducto = $data_producto['catproducto'];
                        $subcat_producto = $data_producto['subcat_producto'];
                        $atr1_producto = $data_producto['atr1_producto'];
                        //creamos la ubicacion
                        $estructura = "../img/catalogo_productos/".$catproducto."/".$subcat_producto."/".$atr1_producto;
                    }                    
                    //aqui vamos a ver si tienen foto o no, para mostrar los iconos acorde
                    $archivador = $estructura."/".$identificador.".png";
                    if(is_file($archivador))
                    {
                        $boton_img = "btn btn-primary btn-sm";
                        $siimagen = 1;
                    }
                    else
                    {
                        $boton_img = "btn btn-secondary btn-sm";
                        $siimagen = 0;
                    }

                $cadenaTabla = $cadenaTabla.'<tr>
                    <td>'.$data['descripcion'].'</td>
                        <td><input type="number" name="nuevo_costo" id="nuevo_costo" class="form-control"></td>
                        <td>'."$".number_format($data['costo'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_iva'],2, '.', ',').'</td>
                        <td>'.$data['ext_p'].'</td>
                        <td>---</td>
                        <td>'."$".number_format($data['costo_contado'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_especial'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_cr1'],2, '.', ',').'</td>
                        <td>'.$data['costo_p1'].'</td>
                        <td>'."$".number_format($data['costo_cr2'],2, '.', ',').'</td>
                        <td>'.$data['costo_p2'].'</td>
                        <td>'."$".number_format($data['costo_eq'],2, '.', ',').'</td>
                        <td>'.$garantia." Meses".'</td>';

                $cadenaTabla = $cadenaTabla.'<td align="center">';

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
                      $editar_productos = 1;
                      $eliminar_productos = 1;
                      $imagenes = 1;
                    }
                    else
                    {
                      #permisos asignados
                      $editar_productos = in_array(6, $array_permisos);
                      $eliminar_productos = in_array(7, $array_permisos);
                      $imagenes =  in_array(8, $array_permisos);
                    }
                    if($imagenes)
                    {
                      $cadenaTabla = $cadenaTabla.'<button data-toggle="modal" data-target="#img_producto" onclick="mostrar_img(\''.$id_producto.'\',\''.$archivador.'\',\''.$siimagen.'\');" class="'.$boton_img.'"><i class="fas fa-camera"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="'.$boton_img.'"><i class="fas fa-camera"></i></button>';
                    }
                    $cadenaTabla = $cadenaTabla."&nbsp;";
                    if($editar_productos)
                    {
                      $cadenaTabla = $cadenaTabla.'<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#nuevo_producto" onclick="editar_producto(\''.$id_producto.'\');"><i class="fas fa-edit"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>';
                    }
                    $cadenaTabla = $cadenaTabla."&nbsp;";
                    if($eliminar_productos)
                    {
                      $cadenaTabla = $cadenaTabla.'<button onClick="eliminar_producto(\''.$id_producto.'\');" class="btn btn-danger btn-sm" type="submit"><i style="color: white;" class="fas fa-trash-alt"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="btn btn-danger btn-sm" type="submit"><i style="color: white;" class="fas fa-trash-alt"></i></button>';
                    }
                $cadenaTabla = $cadenaTabla.'</td></tr>';
              }
            }
        $cadenaTabla = $cadenaTabla.'</tbody></table>';

        $cadenaTabla = array("cadenaTabla" => $cadenaTabla);
        $resultFindforAtr = $cadenaTabla;
      
    echo json_encode($resultFindforAtr,JSON_UNESCAPED_UNICODE);
  }
  ob_end_flush();
  exit;
}
//ATR4
if ($_POST['action'] == 'searchForAtr4') 
{
  ob_start();
  session_start();
  include "accion/conexion.php";
  if (!empty($_POST['atr4'])) 
  {
      $atr1 = $_POST['atr1'];
      $atr2 = $_POST['atr2'];
      $atr3 = $_POST['atr3'];
      $atr4 = $_POST['atr4'];
      $atr5 = $_POST['atr5'];
      $idcategoria = $_POST['idcat'];
      $idsubcategoria = $_POST['idsubcat'];
      
      $cadenaTabla = '
<table class="table" id="tbl_productos">
        <thead class="thead-light">
            <tr>
                <th>Descripción</th>
                <th>Nuevo costo</th>
                <th>Costo actual</th>
                <th>Costo+IVA</th>
                <th>Ext.-P</th>
                <th>Ext-M</th>
                <th>Contado</th>
                <th>Especial</th>
                <th>CR1</th>
                <th>P1</th>
                <th>CR2</th>
                <th>P2</th>
                <th>E-Q</th>
                <th>GAR</th>
                <th style="text-align: center;">Herramientas</th>
            </tr>
        </thead>
        <tbody>';
          
          if($atr4 != "LABEL")
            {
              $query_sql = "SELECT * from producto where atr4_producto like '$atr4'";
            }
            else
            {
              $query_sql = "SELECT * from producto WHERE 1";
            }
            //los demas filtros anidados
            if($atr2 != "LABEL")
            {
              $query_sql = $query_sql." and atr2_producto like '$atr2'";
            }
            if($atr3 != "LABEL")
            {
              $query_sql = $query_sql." and atr3_producto like '$atr3'";
            }
            if($atr1 != "LABEL")
            {
              $query_sql = $query_sql." and atr1_producto like '$atr1'";
            }
            if($atr5 != "LABEL")
            {
              $query_sql = $query_sql." and atr5_producto like '$atr5'";
            }

          if($idsubcategoria == "NoSubcat")
          {
            $query_sql = $query_sql." and categoria = '$idcategoria' order by creado_en desc";
          }
          else
          {
            $query_sql = $query_sql." and categoria = '$idcategoria' and subcategoria = '$idsubcategoria' order by creado_en desc";
          }

            $query = mysqli_query($conexion, $query_sql);
            $result = mysqli_num_rows($query);
            if ($result > 0) 
            {
                while ($data = mysqli_fetch_assoc($query)) 
                {
                  $id_producto = $data['idproducto'];
                  $identificador = $data['identificador'];
                  if($data['subcategoria'] == null)
                    {
                        $idcategoria = $data['categoria'];
                        $query_meses = mysqli_query($conexion, "SELECT meses_garantia from categoria where idcategoria = '$idcategoria'");
                        $garantia = mysqli_fetch_assoc($query_meses)['meses_garantia'];

                        //no tiene sub
                        $select_producto_nosub = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, atr1_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria WHERE idproducto = '$id_producto'");
                        $data_producto = mysqli_fetch_assoc($select_producto_nosub);
                        $catproducto = $data_producto['catproducto'];
                        $atr1_producto = $data_producto['atr1_producto'];
                        //creamos la ubicacion
                        $estructura = "../img/catalogo_productos/".$catproducto."/".$atr1_producto;
                    }
                    else
                    {
                        $idsubcategoria = $data['subcategoria'];
                        $query_meses = mysqli_query($conexion, "SELECT meses_garantia from subcategoria where idsubcategoria = '$idsubcategoria'");
                        $garantia = mysqli_fetch_assoc($query_meses)['meses_garantia'];

                        $select_producto_full = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, subcategoria.nombre as subcat_producto, atr1_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria INNER JOIN subcategoria on subcategoria.idsubcategoria = producto.subcategoria WHERE idproducto = '$id_producto'");
                        $data_producto = mysqli_fetch_assoc($select_producto_full);
                        $catproducto = $data_producto['catproducto'];
                        $subcat_producto = $data_producto['subcat_producto'];
                        $atr1_producto = $data_producto['atr1_producto'];
                        //creamos la ubicacion
                        $estructura = "../img/catalogo_productos/".$catproducto."/".$subcat_producto."/".$atr1_producto;
                    }                    
                    //aqui vamos a ver si tienen foto o no, para mostrar los iconos acorde
                    $archivador = $estructura."/".$identificador.".png";
                    if(is_file($archivador))
                    {
                        $boton_img = "btn btn-primary btn-sm";
                        $siimagen = 1;
                    }
                    else
                    {
                        $boton_img = "btn btn-secondary btn-sm";
                        $siimagen = 0;
                    }

                $cadenaTabla = $cadenaTabla.'<tr>
                    <td>'.$data['descripcion'].'</td>
                        <td><input type="number" name="nuevo_costo" id="nuevo_costo" class="form-control"></td>
                        <td>'."$".number_format($data['costo'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_iva'],2, '.', ',').'</td>
                        <td>'.$data['ext_p'].'</td>
                        <td>---</td>
                        <td>'."$".number_format($data['costo_contado'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_especial'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_cr1'],2, '.', ',').'</td>
                        <td>'.$data['costo_p1'].'</td>
                        <td>'."$".number_format($data['costo_cr2'],2, '.', ',').'</td>
                        <td>'.$data['costo_p2'].'</td>
                        <td>'."$".number_format($data['costo_eq'],2, '.', ',').'</td>
                        <td>'.$garantia." Meses".'</td>';

                $cadenaTabla = $cadenaTabla.'<td align="center">';

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
                      $editar_productos = 1;
                      $eliminar_productos = 1;
                      $imagenes = 1;
                    }
                    else
                    {
                      #permisos asignados
                      $editar_productos = in_array(6, $array_permisos);
                      $eliminar_productos = in_array(7, $array_permisos);
                      $imagenes =  in_array(8, $array_permisos);
                    }
                    if($imagenes)
                    {
                      $cadenaTabla = $cadenaTabla.'<button data-toggle="modal" data-target="#img_producto" onclick="mostrar_img(\''.$id_producto.'\',\''.$archivador.'\',\''.$siimagen.'\');" class="'.$boton_img.'"><i class="fas fa-camera"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="'.$boton_img.'"><i class="fas fa-camera"></i></button>';
                    }
                    $cadenaTabla = $cadenaTabla."&nbsp;";
                    if($editar_productos)
                    {
                      $cadenaTabla = $cadenaTabla.'<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#nuevo_producto" onclick="editar_producto(\''.$id_producto.'\');"><i class="fas fa-edit"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>';
                    }
                    $cadenaTabla = $cadenaTabla."&nbsp;";
                    if($eliminar_productos)
                    {
                      $cadenaTabla = $cadenaTabla.'<button onClick="eliminar_producto(\''.$id_producto.'\');" class="btn btn-danger btn-sm" type="submit"><i style="color: white;" class="fas fa-trash-alt"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="btn btn-danger btn-sm" type="submit"><i style="color: white;" class="fas fa-trash-alt"></i></button>';
                    }
                $cadenaTabla = $cadenaTabla.'</td></tr>';
              }
            }
        $cadenaTabla = $cadenaTabla.'</tbody></table>';

        $cadenaTabla = array("cadenaTabla" => $cadenaTabla);
        $resultFindforAtr = $cadenaTabla;
      
    echo json_encode($resultFindforAtr,JSON_UNESCAPED_UNICODE);
  }
  ob_end_flush();
  exit;
}
//ATR1
if ($_POST['action'] == 'searchForAtr5') 
{
  ob_start();
  session_start();
  include "accion/conexion.php";
  if (!empty($_POST['atr5'])) 
  {
      $atr1 = $_POST['atr1'];
      $atr2 = $_POST['atr2'];
      $atr3 = $_POST['atr3'];
      $atr4 = $_POST['atr4'];
      $atr5 = $_POST['atr5'];
      $idcategoria = $_POST['idcat'];
      $idsubcategoria = $_POST['idsubcat'];
      
      $cadenaTabla = '
<table class="table" id="tbl_productos">
        <thead class="thead-light">
            <tr>
                <th>Descripción</th>
                <th>Nuevo costo</th>
                <th>Costo actual</th>
                <th>Costo+IVA</th>
                <th>Ext.-P</th>
                <th>Ext-M</th>
                <th>Contado</th>
                <th>Especial</th>
                <th>CR1</th>
                <th>P1</th>
                <th>CR2</th>
                <th>P2</th>
                <th>E-Q</th>
                <th>GAR</th>
                <th style="text-align: center;">Herramientas</th>
            </tr>
        </thead>
        <tbody>';
          
          if($atr5 != "LABEL")
            {
              $query_sql = "SELECT * from producto where atr5_producto like '$atr5'";
            }
            else
            {
              $query_sql = "SELECT * from producto WHERE 1";
            }
            //los demas filtros anidados
            if($atr2 != "LABEL")
            {
              $query_sql = $query_sql." and atr2_producto like '$atr2'";
            }
            if($atr3 != "LABEL")
            {
              $query_sql = $query_sql." and atr3_producto like '$atr3'";
            }
            if($atr4 != "LABEL")
            {
              $query_sql = $query_sql." and atr4_producto like '$atr4'";
            }
            if($atr1 != "LABEL")
            {
              $query_sql = $query_sql." and atr1_producto like '$atr1'";
            }

          if($idsubcategoria == "NoSubcat")
          {
            $query_sql = $query_sql." and categoria = '$idcategoria' order by creado_en desc";
          }
          else
          {
            $query_sql = $query_sql." and categoria = '$idcategoria' and subcategoria = '$idsubcategoria' order by creado_en desc";
          }

            $query = mysqli_query($conexion, $query_sql);
            $result = mysqli_num_rows($query);
            if ($result > 0) 
            {
                while ($data = mysqli_fetch_assoc($query)) 
                {
                  $id_producto = $data['idproducto'];
                  $identificador = $data['identificador'];
                  if($data['subcategoria'] == null)
                    {
                        $idcategoria = $data['categoria'];
                        $query_meses = mysqli_query($conexion, "SELECT meses_garantia from categoria where idcategoria = '$idcategoria'");
                        $garantia = mysqli_fetch_assoc($query_meses)['meses_garantia'];

                        //no tiene sub
                        $select_producto_nosub = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, atr1_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria WHERE idproducto = '$id_producto'");
                        $data_producto = mysqli_fetch_assoc($select_producto_nosub);
                        $catproducto = $data_producto['catproducto'];
                        $atr1_producto = $data_producto['atr1_producto'];
                        //creamos la ubicacion
                        $estructura = "../img/catalogo_productos/".$catproducto."/".$atr1_producto;
                    }
                    else
                    {
                        $idsubcategoria = $data['subcategoria'];
                        $query_meses = mysqli_query($conexion, "SELECT meses_garantia from subcategoria where idsubcategoria = '$idsubcategoria'");
                        $garantia = mysqli_fetch_assoc($query_meses)['meses_garantia'];

                        $select_producto_full = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, subcategoria.nombre as subcat_producto, atr1_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria INNER JOIN subcategoria on subcategoria.idsubcategoria = producto.subcategoria WHERE idproducto = '$id_producto'");
                        $data_producto = mysqli_fetch_assoc($select_producto_full);
                        $catproducto = $data_producto['catproducto'];
                        $subcat_producto = $data_producto['subcat_producto'];
                        $atr1_producto = $data_producto['atr1_producto'];
                        //creamos la ubicacion
                        $estructura = "../img/catalogo_productos/".$catproducto."/".$subcat_producto."/".$atr1_producto;
                    }                    
                    //aqui vamos a ver si tienen foto o no, para mostrar los iconos acorde
                    $archivador = $estructura."/".$identificador.".png";
                    if(is_file($archivador))
                    {
                        $boton_img = "btn btn-primary btn-sm";
                        $siimagen = 1;
                    }
                    else
                    {
                        $boton_img = "btn btn-secondary btn-sm";
                        $siimagen = 0;
                    }

                $cadenaTabla = $cadenaTabla.'<tr>
                    <td>'.$data['descripcion'].'</td>
                        <td><input type="number" name="nuevo_costo" id="nuevo_costo" class="form-control"></td>
                        <td>'."$".number_format($data['costo'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_iva'],2, '.', ',').'</td>
                        <td>'.$data['ext_p'].'</td>
                        <td>---</td>
                        <td>'."$".number_format($data['costo_contado'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_especial'],2, '.', ',').'</td>
                        <td>'."$".number_format($data['costo_cr1'],2, '.', ',').'</td>
                        <td>'.$data['costo_p1'].'</td>
                        <td>'."$".number_format($data['costo_cr2'],2, '.', ',').'</td>
                        <td>'.$data['costo_p2'].'</td>
                        <td>'."$".number_format($data['costo_eq'],2, '.', ',').'</td>
                        <td>'.$garantia." Meses".'</td>';

                $cadenaTabla = $cadenaTabla.'<td align="center">';

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
                      $editar_productos = 1;
                      $eliminar_productos = 1;
                      $imagenes = 1;
                    }
                    else
                    {
                      #permisos asignados
                      $editar_productos = in_array(6, $array_permisos);
                      $eliminar_productos = in_array(7, $array_permisos);
                      $imagenes =  in_array(8, $array_permisos);
                    }
                    if($imagenes)
                    {
                      $cadenaTabla = $cadenaTabla.'<button data-toggle="modal" data-target="#img_producto" onclick="mostrar_img(\''.$id_producto.'\',\''.$archivador.'\',\''.$siimagen.'\');" class="'.$boton_img.'"><i class="fas fa-camera"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="'.$boton_img.'"><i class="fas fa-camera"></i></button>';
                    }
                    $cadenaTabla = $cadenaTabla."&nbsp;";
                    if($editar_productos)
                    {
                      $cadenaTabla = $cadenaTabla.'<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#nuevo_producto" onclick="editar_producto(\''.$id_producto.'\');"><i class="fas fa-edit"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>';
                    }
                    $cadenaTabla = $cadenaTabla."&nbsp;";
                    if($eliminar_productos)
                    {
                      $cadenaTabla = $cadenaTabla.'<button onClick="eliminar_producto(\''.$id_producto.'\');" class="btn btn-danger btn-sm" type="submit"><i style="color: white;" class="fas fa-trash-alt"></i></button>';
                    }
                    else
                    {
                      $cadenaTabla = $cadenaTabla.'<button disabled="disabled" class="btn btn-danger btn-sm" type="submit"><i style="color: white;" class="fas fa-trash-alt"></i></button>';
                    }
                $cadenaTabla = $cadenaTabla.'</td></tr>';
              }
            }
        $cadenaTabla = $cadenaTabla.'</tbody></table>';

        $cadenaTabla = array("cadenaTabla" => $cadenaTabla);
        $resultFindforAtr = $cadenaTabla;
      
    echo json_encode($resultFindforAtr,JSON_UNESCAPED_UNICODE);
  }
  ob_end_flush();
  exit;
}
//==== FIN DE LOS FILTROS

//para borrar imgagen del producto
if ($_POST['action'] == 'BorrarImg') 
{
  include "accion/conexion.php";
  if (!empty($_POST['img_producto'])) {
      $url_imgproducto = $_POST['img_producto'];

      unlink($url_imgproducto);
      if(is_file($url_imgproducto))
                {
                    //no se borro, ERROR
                    $borro_img = 0;
                }
                else
                {
                    //se borro la imagen
                    $borro_img = 1;
                }
      
    echo json_encode($borro_img,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

//para activar/desactivar especial
if ($_POST['action'] == 'activarEspecial')
{
  include "accion/conexion.php";
  if (!empty($_POST['status_especial'])) 
  {
      $status_especial = $_POST['status_especial'];
      
      if($status_especial == "si")
      {
        $newstatus_especial = 1;
      }
      else
      {
        $newstatus_especial = 0;
      }
      //actualizamos en la bd
      $update_especial = mysqli_query($conexion, "UPDATE configuracion set valor_int = $newstatus_especial where configuracion = 'activador_especial'");
      if($update_especial)
      {
        $actualizo_especial = 1;
      }
      else
      {
        $actualizo_especial = 0;
      }
    
    echo json_encode($actualizo_especial,JSON_UNESCAPED_UNICODE);
  }
  exit;
}

//para poner o quitar los campos de especial
if ($_POST['action'] == 'act_des_especial')
{
  include "accion/conexion.php";
  $especial = mysqli_query($conexion, "SELECT valor_int from configuracion where configuracion = 'activador_especial'");
  $status_especial = (int) mysqli_fetch_assoc($especial)['valor_int'];

  echo json_encode($status_especial,JSON_UNESCAPED_UNICODE);
  exit;
}

//para poner o quitar los campos de especial
if ($_POST['action'] == 'identificar_producto')
{
  include "accion/conexion.php";
  $identificador = $_POST['identificador'];
  $find_id = mysqli_query($conexion, "SELECT count(idproducto) as num from producto where identificador = '$identificador'");
  $resul_findproduct = (int) mysqli_fetch_assoc($find_id)['num'];

  echo json_encode($resul_findproduct,JSON_UNESCAPED_UNICODE);
  exit;
}

//para buardar la lista con los nuevos costos
if ($_POST['action'] == 'GuardarEditarLista')
{
  include "accion/conexion.php";
  $array_new_costo = $_POST['array_new_costo'];
  $array_idproducto_newcosto = $_POST['array_idproducto_newcosto'];
  //el de exp_p
  $array_new_ext_p = $_POST['array_new_ext_p'];
  $array_idproducto_newext_p = $_POST['array_idproducto_newext_p'];
  /*
  1. si el nuevo costo es menor al costo actual, actualizar solo si tengo 0
  en existencia mueblearia, de lo contrario no actualizar costo
  2. Si el nuevo costo es mayor que el costo actual, SI ACTUALIZARLO SIRMPRE
  3. Si el mismo, no hacer nada
*/

  //anteriormente calculamos si hay en existencia muebleria
  $ext_m = 0; //-> de mientras lo dejamos en 0 porque aun no tenemos de donde calcularlo
  //recorremos los nuevos costos puestos y
  //consultamos el costo actual
  $size_costos = sizeof($array_idproducto_newcosto);
  $resul_save_cost = 1;
  for ($i=0; $i < $size_costos; $i++) 
  { 
    if(!empty($array_new_costo[$i]))
    {
      $select_oldcost = mysqli_query($conexion, "SELECT costo, categoria, subcategoria from producto where idproducto = '$array_idproducto_newcosto[$i]'");
      $data_producto = mysqli_fetch_assoc($select_oldcost);
      $actual_cost = (int) $data_producto['costo'];
      $new_costo = $array_new_costo[$i];
      if(($new_costo < $actual_cost and $ext_m == 0) or ($new_costo > $actual_cost))
      {
        //actualizamos el costo y calculamos nuevos costos de lo demas
        //primero vemos si tiene solo cat o sub y de ahi sacar la info
        if($data_producto['subcategoria'] == null)
        {
          //no tiene sub
          $idcategoria = $data_producto['categoria'];
          $info_cat = mysqli_query($conexion, "SELECT contado, especial, credito1, credito2, meses_pago from categoria where idcategoria = '$idcategoria'");
          $data_costos = mysqli_fetch_assoc($info_cat);
        }
        else
        {
          //si tiene sub, de ahi sacamos la info
          $idsubcategoria = $data_producto['subcategoria'];
          $info_subcat = mysqli_query($conexion, "SELECT contado, especial, credito1, credito2, meses_pago from subcategoria where idsubcategoria = '$idsubcategoria'");
          $data_costos = mysqli_fetch_assoc($info_subcat);
        }
        //ya que tenemos la info, calculamos los nuevos costos
        $contado = $data_costos['contado'];
        $especial = $data_costos['especial'];
        $credito1 = $data_costos['credito1'];
        $credito2 = $data_costos['credito2'];
        $meses_pago = $data_costos['meses_pago'];
        $newcosto_iva = $new_costo + ($new_costo*0.16);
        
        $newcosto_contado = $newcosto_iva + ($newcosto_iva*($contado/100));
        if($especial == null)
        {
          $newcosto_especial = null;
        }
        else
        {
          $newcosto_especial = $newcosto_contado + ($newcosto_contado*($especial/100));
        }
        $newcosto_cr1 = $newcosto_iva  + ($newcosto_iva *($credito1/100));
        $newcosto_cr2 = $newcosto_iva  + ($newcosto_iva *($credito2/100));
        $new_e_q = ($newcosto_iva/$meses_pago)/2;
        if($new_e_q < 400)
        {
          $new_e_q = 400;
        }
        $new_p1 = ($newcosto_cr1/$new_e_q)/2;
        $new_p2 = ($newcosto_cr2/$new_e_q)/2;
        $id_producto = $array_idproducto_newcosto[$i];
        //fin calculo de nuevos costos, ahora actualizamos en el producto
        $update_costos = mysqli_query($conexion, "UPDATE producto set costo = $new_costo, costo_iva = $newcosto_iva, costo_contado = $newcosto_contado, costo_especial = ".($newcosto_especial == null ? "NULL" : "$newcosto_especial").", costo_cr1 = $newcosto_cr1, costo_cr2 = $newcosto_cr2, costo_p1 = $new_p1, costo_p2 = $new_p2, costo_eq = $new_e_q where idproducto = '$id_producto'");
        if(!$update_costos)
        {
          $resul_save_cost = 0;
        }
      }
    }
  }
  //==== ahora hacemos lo mismo con el ext_p 
  //recorremos los nuevos ext_p puestos y
  //consultamos los exp_p actuales
  $size_ext_p = sizeof($array_idproducto_newext_p);
  $resul_save_exp = 1;
  for ($i=0; $i < $size_ext_p; $i++) 
  { 
    if(!empty($array_new_ext_p[$i]))
    {
      $select_oldext = mysqli_query($conexion, "SELECT ext_p  from producto where idproducto = '$array_idproducto_newext_p[$i]'");
      $data_producto = mysqli_fetch_assoc($select_oldext);
      $actual_ext_p = (int) $data_producto['ext_p'];
      $new_ext_p = $array_new_ext_p[$i];
      if(($new_ext_p < $actual_ext_p and $ext_m == 0) or ($new_ext_p > $actual_ext_p))
      {
        $id_producto = $array_idproducto_newext_p[$i];
        //ahora actualizamos en el producto
        $update_ext_p = mysqli_query($conexion, "UPDATE producto set ext_p = $new_ext_p where idproducto = '$id_producto'");
        if(!$update_ext_p)
        {
          $resul_save_exp = 0;
        }
      }
    }
  }
  //hacemos el calculo para ver si todo salio bien
  if($resul_save_cost and $resul_save_exp)
  {
    //todo chido
    $resul_save_list = 1;
  }
  else
  {
    //todo mal
    $resul_save_list = 0;
  }

  echo json_encode($resul_save_list,JSON_UNESCAPED_UNICODE);
  exit;
}
