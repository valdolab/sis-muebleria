<?php
//====== AQUI VAN LOS AJAX PHP QUE SE HACEN CUANDO HAY UN FORM
//insert tipos
if ($_POST['action'] == 'insert_tipo') 
{  
  include "accion/conexion.php";
  if (!empty($_POST['nuevotipo'])) 
  {
      $newtipo = $_POST['nuevotipo'];
      $resultIDtipo = mysqli_query($conexion, "SELECT UUID() as idtipo");
      $uuid = mysqli_fetch_assoc($resultIDtipo)['idtipo'];
          $insert_tipo = mysqli_query($conexion, "INSERT INTO tipo(idtipo, nombre_tipo) values ('$uuid', '$newtipo')");
              if ($insert_tipo) 
              {
                  $idtipo = array("idtipo" => $uuid);
                  $tipo = array("nombre_tipo" => $newtipo);
                  $resultInsertTipos = $idtipo + $tipo;
              } 
              else
              {
                $resultInsertTipos = 0;
              }
  }
  else
  {
    $resultInsertTipos = 0;
  }
  echo json_encode($resultInsertTipos,JSON_UNESCAPED_UNICODE);
  exit;
}

//update tipos
if ($_POST['action'] == 'update_tipo') 
{  
  include "accion/conexion.php";
  if (!empty($_POST['newedit_tipo'])) 
  {
          $id_tipo = $_POST['idflag_tipo'];
          $newname_tipo = $_POST['newedit_tipo'];
          $update_tipo = mysqli_query($conexion, "UPDATE tipo SET nombre_tipo='$newname_tipo' where idtipo = '$id_tipo'");
              if ($update_tipo) 
              {
                  $idtipo = array("idtipo" => $id_tipo);
                  $tipo = array("nombre_tipo" => $newname_tipo);
                  $resultUpdateTipos = $idtipo + $tipo;
              } 
              else
              {
                $resultUpdateTipos = 0;
              }
  }
  else
  {
    $resultUpdateTipos = 0;
  }
  echo json_encode($resultUpdateTipos,JSON_UNESCAPED_UNICODE);
  exit;
}

//insert puesto
if ($_POST['action'] == 'insert_puesto') 
{  
  include "accion/conexion.php";
  if (!empty($_POST['newpuesto'])) 
  {
    $resultIDpuesto = mysqli_query($conexion, "SELECT UUID() as idpuesto");
    $uuid = mysqli_fetch_assoc($resultIDpuesto)['idpuesto'];
    $nompuesto = $_POST['newpuesto'];
          $descpuesto = $_POST['desc_puesto'];
          $insert_puesto = mysqli_query($conexion, "INSERT INTO puesto(idpuesto,puesto,descripcion) values ('$uuid','$nompuesto','$descpuesto')");
              if ($insert_puesto) 
              {
                  $idpuesto = array("idpuesto" => $uuid);
                  $puesto = array("nombre_puesto" => $nompuesto);
                  $resultInsertPuesto = $idpuesto + $puesto;
              } 
              else
              {
                  $resultInsertPuesto = 0;
              }
  }
  else
  {
    $resultInsertPuesto = 0;
  }
  echo json_encode($resultInsertPuesto,JSON_UNESCAPED_UNICODE);
  exit;
}

//update puesto
if ($_POST['action'] == 'update_puesto') 
{  
  include "accion/conexion.php";
  if (!empty($_POST['newpuesto_edit'])) 
  {
    $id_puesto = $_POST['idpuesto_flag'];
          $nompuesto_e = $_POST['newpuesto_edit'];
          $desc_puesto_e = $_POST['desc_puesto_edit'];
          $update_puesto = mysqli_query($conexion, "UPDATE puesto SET puesto='$nompuesto_e', descripcion='$desc_puesto_e' where idpuesto = '$id_puesto'");
              if ($update_puesto) 
              {
                  $idpuesto = array("idpuesto" => $id_puesto);
                  $puesto = array("nombre_puesto" => $nompuesto_e);
                  $resultUpdatePuesto = $idpuesto + $puesto;
              } 
              else
              {
                  $resultUpdatePuesto = 0;
              }
  }
  else
  {
    $resultUpdatePuesto = 0;
  }
  echo json_encode($resultUpdatePuesto,JSON_UNESCAPED_UNICODE);
  exit;
}

//insert zona
if ($_POST['action'] == 'insert_zona') 
{  
  include "accion/conexion.php";
  if (!empty($_POST['nuevazona'])) 
  {
    $resultIDzona = mysqli_query($conexion, "SELECT UUID() as idzona");
    $uuid = mysqli_fetch_assoc($resultIDzona)['idzona'];
    $nueva_zona = $_POST['nuevazona'];
            $insert_zona = mysqli_query($conexion, "INSERT INTO zonas(idzona, zona) values ('$uuid','$nueva_zona')");
              if ($insert_zona) 
              {
                  $idzona = array("idzona" => $uuid);
                  $zona = array("zona" => $nueva_zona);
                  $resultInsertZona = $idzona + $zona;
              } 
              else
              {
                  $resultInsertZona = 0;
              }
  }
  else
  {
    $resultInsertZona = 0;
  }
  echo json_encode($resultInsertZona,JSON_UNESCAPED_UNICODE);
  exit;
}

//update zona
if ($_POST['action'] == 'edit_zona') 
{  
  include "accion/conexion.php";
  if (!empty($_POST['newzona_edit'])) 
  {
          $id_zona = $_POST['idnewzona_edit'];
          $nomzona_edit = $_POST['newzona_edit'];
          $update_zona = mysqli_query($conexion, "UPDATE zonas SET zona='$nomzona_edit' where idzona = '$id_zona'");
              if ($update_zona) 
              {
                  $idzona = array("idzona" => $id_zona);
                  $zona = array("zona" => $nomzona_edit);
                  $resultUpdateZona = $idzona + $zona;
              } 
              else
              {
                  $resultUpdateZona = 0;
              }
  }
  else
  {
    $resultUpdateZona = 0;
  }
  echo json_encode($resultUpdateZona,JSON_UNESCAPED_UNICODE);
  exit;
}

//insert subzona
if ($_POST['action'] == 'insert_subzona') 
{  
  include "accion/conexion.php";
  if (!empty($_POST['nuevasubzona'])) 
  {
            $resultIDsubzona = mysqli_query($conexion, "SELECT UUID() as idsubzona");
            $uuid = mysqli_fetch_assoc($resultIDsubzona)['idsubzona'];
            $nueva_subzona = $_POST['nuevasubzona'];
            $idzona_subzona = $_POST['zona_subzona'];
            $insert_subzona = mysqli_query($conexion, "INSERT INTO subzonas(idsubzona,subzona,idzona) values ('$uuid','$nueva_subzona', '$idzona_subzona')");
              if ($insert_subzona) 
              {
                  $idsubzona = array("idsubzona" => $uuid);
                  $subzona = array("subzona" => $nueva_subzona);
                  $resultInsertSubzona = $idsubzona + $subzona;
              } 
              else
              {
                  $resultInsertSubzona = 0;
              }
  }
  else
  {
    $resultInsertSubzona = 0;
  }
  echo json_encode($resultInsertSubzona,JSON_UNESCAPED_UNICODE);
  exit;
}

//update subzona
if ($_POST['action'] == 'edit_subzona') 
{  
  include "accion/conexion.php";
  if (!empty($_POST['newsubzona_edit'])) 
  {
          $id_subzona = $_POST['idnewsubzona_edit'];
          $nomsubzona_edit = $_POST['newsubzona_edit'];

          $newid_zona_edit = $_POST['zona_subzona_edit'];
          $update_subzona = mysqli_query($conexion, "UPDATE subzonas SET subzona='$nomsubzona_edit', idzona = '$newid_zona_edit' where idsubzona = '$id_subzona'");
              if ($update_subzona) 
              {
                  $idsubzona = array("idsubzona" => $id_subzona);
                  $subzona = array("subzona" => $nomsubzona_edit);
                  $newzona = array("idzona_subzona" => $newid_zona_edit);
                  $varcambiozona = '0';
                  //checar si se cambio de zona la subzona editada
                  $select_zona_subzona = mysqli_query($conexion, "SELECT idzona from subzonas where idsubzona = '$id_subzona'");
                  $zona_deSubzona = mysqli_fetch_assoc($select_zona_subzona)['idzona'];
                  if(strcmp($zona_deSubzona, $newid_zona_edit) !== 1)
                  {
                    //son diferentes, por lo tanto se cambio
                    $varcambiozona = '1';
                  }
                  $cambiozona = array("cambiozona" => $varcambiozona);
                  $resultUpdateSubzona = $idsubzona + $subzona + $cambiozona + $newzona;
              } 
              else
              {
                  $resultUpdateSubzona = 0;
              }
  }
  else
  {
    $resultUpdateSubzona = 0;
  }
  echo json_encode($resultUpdateSubzona,JSON_UNESCAPED_UNICODE);
  exit;
}

//insert y update categoria
if ($_POST['action'] == 'insert_categoria') 
{  
  include "accion/conexion.php";
  if (!empty($_POST['flagidcategoria'])) 
  {
    $idcategoria = $_POST['flagidcategoria'];
    if($idcategoria == "nuevacat")
    {
      //code for insert new categoria
      $nombre_cat = $_POST['nombre_cat'];
      if (isset($_POST['tiene_subcat']))
      {
        //si tiene subcat, insertamos con todo null y solo guardamos el nombre y la variable tiene subcat
        $tiene_subcat = 1;
        $resultIDcat = mysqli_query($conexion, "SELECT UUID() as idcategoria");
        $uuid = mysqli_fetch_assoc($resultIDcat)['idcategoria'];

        //comprobar si no existe ya esa categoria, si ya existe avisar y no dejar insertarlo
        

        $insert_cat = mysqli_query($conexion, "INSERT INTO categoria(idcategoria,nombre,tiene_subcat) values ('$uuid','$nombre_cat', $tiene_subcat)");
                if ($insert_cat) 
                {
                    $idcat = array("idcategoria" => $uuid);
                    $categoria = array("categoria" => $nombre_cat);
                    $flag_insert = array("flag_insert" => 1);
                    $resultInsertCategoria = $idcat + $categoria + $flag_insert;
                } 
                else
                {
                    $resultInsertCategoria = 0;
                }
      }
      else
      {
        //no tiene subcat, insertamos todo
        $tiene_subcat = 0;
        $atr1 = 'MARCA';
        $atr2 = $_POST['atr2'];
        $atr3 = $_POST['atr3'];
        $atr4 = $_POST['atr4'];
        $atr5 = $_POST['atr5'];
        $contado = $_POST['contado'];
        if(isset($_POST['especial']))
        {
          $especial = $_POST['especial'];
        }
        else
        {   
          $especial = null;
        }

        $credito1 = $_POST['credito1'];
        $credito2 = $_POST['credito2'];
        $mesespago = $_POST['mesespago'];
        $garantia = $_POST['garantia'];
        $resultIDcat = mysqli_query($conexion, "SELECT UUID() as idcategoria");
        $uuid = mysqli_fetch_assoc($resultIDcat)['idcategoria'];

        $insert_cat = mysqli_query($conexion, "INSERT INTO categoria(idcategoria, nombre, tiene_subcat, atr1, atr2, atr3, atr4, atr5, contado, especial, credito1, credito2, meses_pago, meses_garantia) VALUES ('$uuid','$nombre_cat', $tiene_subcat, '$atr1', ".(!empty($atr2) ? "'$atr2'" : "NULL").", ".(!empty($atr3) ? "'$atr3'" : "NULL").", ".(!empty($atr4) ? "'$atr4'" : "NULL").", ".(!empty($atr5) ? "'$atr5'" : "NULL").", $contado, ".($especial == null ? "NULL" : "$especial").", $credito1, '$credito2', '$mesespago', '$garantia')");
        if ($insert_cat) 
        {
          $idcat = array("idcategoria" => $uuid);
          $categoria = array("categoria" => $nombre_cat);
          $flag_insert = array("flag_insert" => 1);
          $flag_tiene_subcat = array("flag_tiene_subcat" => $tiene_subcat);
          $resultInsertCategoria = $idcat + $categoria + $flag_insert + $flag_tiene_subcat;
        } 
        else
        {
          $resultInsertCategoria = 0;
          //$resultInsertCategoria = mysqli_error($conexion);
        }
      }
    }
    else
    {
      //code for update a selected categoria
        $nombre_cat = $_POST['nombre_cat'];
        if (isset($_POST['tiene_subcat']))
        {
          $tiene_subcat = 1;
          $atr1 = null;
          $atr2 = null;
          $atr3 = null;
          $atr4 = null;
          $atr5 = null;
          $contado = null;
          $especial = null;
          $credito1 = null;
          $credito2 = null;
          $mesespago = null;
          $garantia = null;
        }
        else
        {
          $tiene_subcat = 0;
          $atr1 = 'MARCA';
          $atr2 = $_POST['atr2'];
          $atr3 = $_POST['atr3'];
          $atr4 = $_POST['atr4'];
          $atr5 = $_POST['atr5'];
          $contado = $_POST['contado'];
          if(isset($_POST['especial']))
          {
            $especial = $_POST['especial'];
          }
          else
          {   
            $especial = null;
          }
          $credito1 = $_POST['credito1'];
          $credito2 = $_POST['credito2'];
          $mesespago = $_POST['mesespago'];
          $garantia = $_POST['garantia'];
        }
        //idcat -> $idcategoria
        $update_cat = mysqli_query($conexion, "UPDATE categoria set nombre = '$nombre_cat', tiene_subcat = $tiene_subcat, atr1 = ".(!empty($atr1) ? "'$atr1'" : "NULL").", atr2 = ".(!empty($atr2) ? "'$atr2'" : "NULL").", atr3 = ".(!empty($atr3) ? "'$atr3'" : "NULL").", atr4 = ".(!empty($atr4) ? "'$atr4'" : "NULL").", atr5 = ".(!empty($atr5) ? "'$atr5'" : "NULL").", contado = ".(!empty($contado) ? "$contado" : "NULL").", especial = ".($especial == null ? "NULL" : "$especial").", credito1 = ".(!empty($credito1) ? "$credito1" : "NULL").", credito2 = ".(!empty($credito2) ? "$credito2" : "NULL").", meses_pago = ".(!empty($mesespago) ? "$mesespago" : "NULL").", meses_garantia = ".(!empty($garantia) ? "$garantia" : "NULL")." WHERE idcategoria = '$idcategoria'");
        if ($update_cat) 
        {
          $idcat = array("idcategoria" => $idcategoria);
          $categoria = array("categoria" => $nombre_cat);
          $flag_insert = array("flag_insert" => 0);
          $flag_tiene_subcat = array("flag_tiene_subcat" => $tiene_subcat);
          $resultInsertCategoria = $idcat + $categoria + $flag_insert + $flag_tiene_subcat;
        } 
        else
        {
          $resultInsertCategoria = 0;
        }
    }
  }
  else
  {
    $resultInsertCategoria = 0;
  }
  //hacer tiempo
  //sleep(2);
  echo json_encode($resultInsertCategoria,JSON_UNESCAPED_UNICODE);
  exit;
}

//INSERTAR Y UPDATED subcategoria
if ($_POST['action'] == 'insert_subcategoria') 
{  
  include "accion/conexion.php";
  if (!empty($_POST['flagidsubcategoria'])) 
  {
    $idsubcategoria = $_POST['flagidsubcategoria'];
    if($idsubcategoria == "nuevasubcat")
    {
        //code for insert new categoria
        $nombre_subcat = $_POST['nombre_subcat'];
        //no tiene subcat, insertamos todo
        $categoria_subcategoria = $_POST['categoria_subcategoria'];
        $atr1 = 'MARCA';
        $atr2 = $_POST['atr2_sub'];
        $atr3 = $_POST['atr3_sub'];
        $atr4 = $_POST['atr4_sub'];
        $atr5 = $_POST['atr5_sub'];
        $contado = $_POST['contado_sub'];
        if(isset($_POST['especial_sub']))
        {
          $especial = $_POST['especial_sub'];
        }
        else
        {   
          $especial = null;
        }
        $credito1 = $_POST['credito1_sub'];
        $credito2 = $_POST['credito2_sub'];
        $mesespago = $_POST['mesespago_sub'];
        $garantia = $_POST['garantia_sub'];
        $resultIDsubcat = mysqli_query($conexion, "SELECT UUID() as idsubcategoria");
        $uuid = mysqli_fetch_assoc($resultIDsubcat)['idsubcategoria'];

        $insert_subcat = mysqli_query($conexion, "INSERT INTO subcategoria(idsubcategoria, nombre, categoria, atr1, atr2, atr3, atr4, atr5, contado, especial, credito1, credito2, meses_pago, meses_garantia) VALUES ('$uuid','$nombre_subcat', '$categoria_subcategoria', '$atr1', ".(!empty($atr2) ? "'$atr2'" : "NULL").", ".(!empty($atr3) ? "'$atr3'" : "NULL").", ".(!empty($atr4) ? "'$atr4'" : "NULL").", ".(!empty($atr5) ? "'$atr5'" : "NULL").", $contado, ".($especial == null ? "NULL" : "$especial").", $credito1, '$credito2', '$mesespago', '$garantia')");
        if ($insert_subcat) 
        {
          $idsubcat = array("idsubcategoria" => $uuid);
          $subcategoria = array("subcategoria" => $nombre_subcat);
          $flag_insert = array("flag_insert" => 1);
          $resultInsertSubcat = $idsubcat + $subcategoria + $flag_insert;
        } 
        else
        {
          $resultInsertSubcat = 0;
        }
    }
    else
    {
        //code for update a selected categoria
        $nombre_subcat = $_POST['nombre_subcat'];
        $categoria_subcategoria = $_POST['categoria_subcategoria'];
        $atr1 = 'MARCA';
        $atr2 = $_POST['atr2_sub'];
        $atr3 = $_POST['atr3_sub'];
        $atr4 = $_POST['atr4_sub'];
        $atr5 = $_POST['atr5_sub'];
        $contado = $_POST['contado_sub'];
        if(isset($_POST['especial_sub']))
        {
          $especial = $_POST['especial_sub'];
        }
        else
        {   
          $especial = null;
        }
        $credito1 = $_POST['credito1_sub'];
        $credito2 = $_POST['credito2_sub'];
        $mesespago = $_POST['mesespago_sub'];
        $garantia = $_POST['garantia_sub'];
        //idcat -> $idcategoria
        $update_subcat = mysqli_query($conexion, "UPDATE subcategoria set nombre = '$nombre_subcat', categoria = '$categoria_subcategoria', atr1 = '$atr1', atr2 = ".(!empty($atr2) ? "'$atr2'" : "NULL").", atr3 = ".(!empty($atr3) ? "'$atr3'" : "NULL").", atr4 = ".(!empty($atr4) ? "'$atr4'" : "NULL").", atr5 = ".(!empty($atr5) ? "'$atr5'" : "NULL").", contado = ".(!empty($contado) ? "$contado" : "NULL").", especial = ".($especial == null ? "NULL" : "$especial").", credito1 = ".(!empty($credito1) ? "$credito1" : "NULL").", credito2 = ".(!empty($credito2) ? "$credito2" : "NULL").", meses_pago = ".(!empty($mesespago) ? "$mesespago" : "NULL").", meses_garantia = ".(!empty($garantia) ? "$garantia" : "NULL")." WHERE idsubcategoria  = '$idsubcategoria'");
        if ($update_subcat) 
        {
          $idsubcat = array("idsubcategoria" => $idsubcategoria);
          $subcategoria = array("subcategoria" => $nombre_subcat);
          $flag_insert = array("flag_insert" => 0);
          $resultInsertSubcat = $idsubcat + $subcategoria + $flag_insert;
        } 
        else
        {
          $resultInsertSubcat = 0;
        }
    }
  }
  else
  {
    $resultInsertSubcat = 0;
  }
  echo json_encode($resultInsertSubcat,JSON_UNESCAPED_UNICODE);
  exit;
}


