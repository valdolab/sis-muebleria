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
      $nombre_cat = $_POST['nombre_cat'];
      //comprobar si no existe ya esa categoria, si ya existe avisar y no dejar insertarlo
      $existe_cat = mysqli_query($conexion, "SELECT count(idcategoria) as num from categoria where nombre = '$nombre_cat'");
      if ((int) mysqli_fetch_assoc($existe_cat)['num'] > 0)
      {
        //ya existe, mandar mensaje
        $resultInsertCategoria = 1;
      }
      else
      {
        //no existe, guardarlo
        //code for insert new categoria
        if (isset($_POST['tiene_subcat']))
        {
          //si tiene subcat, insertamos con todo null y solo guardamos el nombre y la variable tiene subcat
          $tiene_subcat = 1;
          $resultIDcat = mysqli_query($conexion, "SELECT UUID() as idcategoria");
          $uuid = mysqli_fetch_assoc($resultIDcat)['idcategoria'];

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

          $base_inicial_c1 = $_POST['base_inicial_c1'];
          $ganancia_inicial_c1 = $_POST['ganancia_inicial_c1'];
          $rango_c1 = $_POST['rango_c1'];
          $ganancia_subsecuente_c1 = $_POST['ganancia_subsecuente_c1'];
          $limite_costo_c1 = $_POST['limite_costo_c1'];
          //credito 2
          $base_inicial_c2 = $_POST['base_inicial_c2'];
          $ganancia_inicial_c2 = $_POST['ganancia_inicial_c2'];
          $rango_c2 = $_POST['rango_c2'];
          $ganancia_subsecuente_c2 = $_POST['ganancia_subsecuente_c2'];
          $limite_costo_c2 = $_POST['limite_costo_c2'];

          $enganche = $_POST['enganche'];
          $mesespago = $_POST['mesespago'];
          $garantia = $_POST['garantia'];
          $resultIDcat = mysqli_query($conexion, "SELECT UUID() as idcategoria");
          $uuid = mysqli_fetch_assoc($resultIDcat)['idcategoria'];

          $insert_cat = mysqli_query($conexion, "INSERT INTO categoria(idcategoria, nombre, tiene_subcat, atr1, atr2, atr3, atr4, atr5, contado, especial, base_inicial_c1, ganancia_inicial_c1, rango_c1, ganancia_subsecuente_c1, limite_costo_c1, base_inicial_c2, ganancia_inicial_c2, rango_c2, ganancia_subsecuente_c2, limite_costo_c2, meses_pago, meses_garantia, enganche) VALUES ('$uuid','$nombre_cat', $tiene_subcat, '$atr1', ".(!empty($atr2) ? "'$atr2'" : "NULL").", ".(!empty($atr3) ? "'$atr3'" : "NULL").", ".(!empty($atr4) ? "'$atr4'" : "NULL").", ".(!empty($atr5) ? "'$atr5'" : "NULL").", $contado, ".($especial == null ? "NULL" : "$especial").", $base_inicial_c1, $ganancia_inicial_c1, $rango_c1, $ganancia_subsecuente_c1, $limite_costo_c1, $base_inicial_c2, $ganancia_inicial_c2, $rango_c2, $ganancia_subsecuente_c2, $limite_costo_c2, '$mesespago', '$garantia', $enganche)");
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
    }
    else
    {
        //comprobar si ya existe ese nombre, y que no sea el que ya tiene
        $nombre_cat = $_POST['nombre_cat'];
        $existe_editcat = mysqli_query($conexion, "SELECT count(idcategoria) as num from categoria where nombre = '$nombre_cat'");
        $si_existe_un_nombre_igual = 0;
        if ((int) mysqli_fetch_assoc($existe_editcat)['num'] > 0)
        {
          //ya existe, mandar mensaje
          $si_existe_un_nombre_igual = 1;
        }
        $existe_editcat = mysqli_query($conexion, "SELECT nombre from categoria where idcategoria = '$idcategoria'");
        $es_igual_al_nombre_actual = 0;
        if (mysqli_fetch_assoc($existe_editcat)['nombre'] == $nombre_cat)
        {
          $es_igual_al_nombre_actual = 1;
        }
        if($si_existe_un_nombre_igual == 1 and $es_igual_al_nombre_actual == 0)
        {
          //mandar mensaje de que ya existe
          $resultInsertCategoria = 1;
        }
        else
        {
          //code for update a selected categoria
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
            //credito 1
            $base_inicial_c1 = $_POST['base_inicial_c1'];
            $ganancia_inicial_c1 = $_POST['ganancia_inicial_c1'];
            $rango_c1 = $_POST['rango_c1'];
            $ganancia_subsecuente_c1 = $_POST['ganancia_subsecuente_c1'];
            $limite_costo_c1 = $_POST['limite_costo_c1'];
            //credito 2
            $base_inicial_c2 = $_POST['base_inicial_c2'];
            $ganancia_inicial_c2 = $_POST['ganancia_inicial_c2'];
            $rango_c2 = $_POST['rango_c2'];
            $ganancia_subsecuente_c2 = $_POST['ganancia_subsecuente_c2'];
            $limite_costo_c2 = $_POST['limite_costo_c2'];

            $mesespago = $_POST['mesespago'];
            $garantia = $_POST['garantia'];
            $enganche = $_POST['enganche'];
          }
          //idcat -> $idcategoria
          $update_cat = mysqli_query($conexion, "UPDATE categoria set nombre = '$nombre_cat', tiene_subcat = $tiene_subcat, atr1 = ".(!empty($atr1) ? "'$atr1'" : "NULL").", atr2 = ".(!empty($atr2) ? "'$atr2'" : "NULL").", atr3 = ".(!empty($atr3) ? "'$atr3'" : "NULL").", atr4 = ".(!empty($atr4) ? "'$atr4'" : "NULL").", atr5 = ".(!empty($atr5) ? "'$atr5'" : "NULL").", contado = ".(!empty($contado) ? "$contado" : "NULL").", especial = ".($especial == null ? "NULL" : "$especial").", base_inicial_c1 = ".(!empty($base_inicial_c1) ? "$base_inicial_c1" : "NULL").", ganancia_inicial_c1 = ".(!empty($ganancia_inicial_c1) ? "$ganancia_inicial_c1" : "NULL").", rango_c1 = ".(!empty($rango_c1) ? "$rango_c1" : "NULL").", ganancia_subsecuente_c1 = ".(!empty($ganancia_subsecuente_c1) ? "$ganancia_subsecuente_c1" : "NULL").", limite_costo_c1 = ".(!empty($limite_costo_c1) ? "$limite_costo_c1" : "NULL").", base_inicial_c2 = ".(!empty($base_inicial_c2) ? "$base_inicial_c2" : "NULL").", ganancia_inicial_c2 = ".(!empty($ganancia_inicial_c2) ? "$ganancia_inicial_c2" : "NULL").", rango_c2 = ".(!empty($rango_c2) ? "$rango_c2" : "NULL").", ganancia_subsecuente_c2 = ".(!empty($ganancia_subsecuente_c2) ? "$ganancia_subsecuente_c2" : "NULL").", limite_costo_c2 = ".(!empty($limite_costo_c2) ? "$limite_costo_c2" : "NULL").", meses_pago = ".(!empty($mesespago) ? "$mesespago" : "NULL").", meses_garantia = ".(!empty($garantia) ? "$garantia" : "NULL").", enganche = ".(!empty($enganche) ? "$enganche" : "NULL")." WHERE idcategoria = '$idcategoria'");

          //actualizar productos con base en los nuevos parametros de categoria
          //ACTUALIZAR TODOS LOS PRODUCTOS QUE PERTENCEZCAN A ESTA CATEGORIA Y NO TENGA SUBCATEGORIA
          if($tiene_subcat == 0) //no tiene subcategoria
          {
            $selcet_idproductos = mysqli_query($conexion, "SELECT idproducto,costo,costo_iva FROM producto where categoria = '$idcategoria'");
            $resul_save_cost = 1;
            while ($data = mysqli_fetch_assoc($selcet_idproductos)) 
            {
              $id_productos = $data['idproducto'];
              //actualizar cada producto
              //actualizamos el costo y calculamos nuevos costos de lo demas
              //sacar la info de los parametros de subcat
              $newcosto_iva = $data['costo_iva'];
              $newcosto_contado = ceil($newcosto_iva + ($newcosto_iva*($contado/100)));
              if($especial == null)
              {
                $newcosto_especial = null;
              }
              else
              {
                $newcosto_especial = ceil($newcosto_contado + ($newcosto_contado*($especial/100)));
              }
              //credito1 
              $cr1 = 0;
              if($newcosto_iva < $base_inicial_c1)
              {
                $cr1 = $ganancia_inicial_c1;
              }
              else if ($newcosto_iva < ($base_inicial_c1 + $rango_c1))
              {
                $cr1 = $ganancia_subsecuente_c1;
              }
              else
              {
                $costo_temp = $base_inicial_c1 + $rango_c1;//2100
                $ganancia_temp = $ganancia_subsecuente_c1;// 80
                while(true)
                {
                  $costo_temp = $costo_temp + $rango_c1;//2200,2300
                  $ganancia_temp = $ganancia_temp - 1;//79,78
                  //2250<2200, 2250<2300,   //2100<=10000,2200<=10000
                  if(($newcosto_iva < $costo_temp) || ($costo_temp >= $limite_costo_c1))
                  {
                    $cr1 = $ganancia_temp;
                    break;
                  }
                }
              }
              $newcosto_cr1 = ceil($newcosto_iva + ($newcosto_iva*($cr1/100)));

              //credito2
              $cr2 = 0;
              if($newcosto_iva < $base_inicial_c2)
              {
                $cr2 = $ganancia_inicial_c2;
              }
              else if ($newcosto_iva < ($base_inicial_c2 + $rango_c2))
              {
                $cr2 = $ganancia_subsecuente_c2;
              }
              else
              {
                $costo_temp2 = $base_inicial_c2 + $rango_c2;//2100
                $ganancia_temp2 = $ganancia_subsecuente_c2;// 80
                while(true)
                {
                  $costo_temp2 = $costo_temp2 + $rango_c2;//2200,2300
                  $ganancia_temp2 = $ganancia_temp2 - 1;//79,78
                  //2250<2200, 2250<2300,   //2100<=10000,2200<=10000
                  if(($newcosto_iva < $costo_temp2) || ($costo_temp2 >= $limite_costo_c2))
                  {
                    $cr2 = $ganancia_temp2;
                    break;
                  }
                }
              }
              $newcosto_cr2 = ceil($newcosto_iva + ($newcosto_iva*($cr2/100)));
              
              $new_e_q = ($newcosto_iva/$mesespago);
              if($new_e_q < 400)
              {
                $new_e_q = 400;
              }
              $new_e_q = ceil($new_e_q);
              
              $new_p1 = ($newcosto_cr1/$new_e_q)/2;
              $new_p2 = ($newcosto_cr2/$new_e_q)/2;
              $newcosto_enganche = ceil($newcosto_cr2*($enganche/100) + 100);
              //guardamos en la base 
              //fin calculo de nuevos costos, ahora actualizamos en el producto
              $update_costos = mysqli_query($conexion, "UPDATE producto set costo_contado = $newcosto_contado, costo_especial = ".($newcosto_especial == null ? "NULL" : "$newcosto_especial").", costo_cr1 = $newcosto_cr1, costo_cr2 = $newcosto_cr2, costo_p1 = $new_p1, costo_p2 = $new_p2, costo_eq = $new_e_q, costo_enganche = $newcosto_enganche where idproducto = '$id_productos'");
              if(!$update_costos)
              {
                $resul_save_cost = 0;
              }
            }
          }
          if ($update_cat and $resul_save_cost) 
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
  }
  else
  {
    $resultInsertCategoria = 0;
  }
  //hacer tiempo
  //sleep(3);
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
        $nombre_subcat = $_POST['nombre_subcat'];
        //comprobar si no existe ya esa categoria, si ya existe avisar y no dejar insertarlo
        $existe_subcat = mysqli_query($conexion, "SELECT count(idsubcategoria) as num from subcategoria where nombre = '$nombre_subcat'");
        if ((int) mysqli_fetch_assoc($existe_subcat)['num'] > 0)
        {
          //ya existe, mandar mensaje
          $resultInsertSubcat = 1;
        }
        else
        {
          //code for insert new categoria
          //$nombre_subcat = $_POST['nombre_subcat'];
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
          //lo nuevo de credito
          $base_inicial_c1 = $_POST['base_inicial_c1_sub'];
          $ganancia_inicial_c1 = $_POST['ganancia_inicial_c1_sub'];
          $rango_c1 = $_POST['rango_c1_sub'];
          $ganancia_subsecuente_c1 = $_POST['ganancia_subsecuente_c1_sub'];
          $limite_costo_c1 = $_POST['limite_costo_c1_sub'];
          //credito 2
          $base_inicial_c2 = $_POST['base_inicial_c2_sub'];
          $ganancia_inicial_c2 = $_POST['ganancia_inicial_c2_sub'];
          $rango_c2 = $_POST['rango_c2_sub'];
          $ganancia_subsecuente_c2 = $_POST['ganancia_subsecuente_c2_sub'];
          $limite_costo_c2 = $_POST['limite_costo_c2_sub'];

          $mesespago = $_POST['mesespago_sub'];
          $garantia = $_POST['garantia_sub'];
          $enganche = $_POST['enganche_sub'];

          $resultIDsubcat = mysqli_query($conexion, "SELECT UUID() as idsubcategoria");
          $uuid = mysqli_fetch_assoc($resultIDsubcat)['idsubcategoria'];

          $insert_subcat = mysqli_query($conexion, "INSERT INTO subcategoria(idsubcategoria, nombre, categoria, atr1, atr2, atr3, atr4, atr5, contado, especial, base_inicial_c1, ganancia_inicial_c1, rango_c1, ganancia_subsecuente_c1, limite_costo_c1, base_inicial_c2, ganancia_inicial_c2, rango_c2, ganancia_subsecuente_c2, limite_costo_c2, meses_pago, meses_garantia, enganche) VALUES ('$uuid','$nombre_subcat', '$categoria_subcategoria', '$atr1', ".(!empty($atr2) ? "'$atr2'" : "NULL").", ".(!empty($atr3) ? "'$atr3'" : "NULL").", ".(!empty($atr4) ? "'$atr4'" : "NULL").", ".(!empty($atr5) ? "'$atr5'" : "NULL").", $contado, ".($especial == null ? "NULL" : "$especial").", $base_inicial_c1, $ganancia_inicial_c1, $rango_c1, $ganancia_subsecuente_c1, $limite_costo_c1, $base_inicial_c2, $ganancia_inicial_c2, $rango_c2, $ganancia_subsecuente_c2, $limite_costo_c2, '$mesespago', '$garantia', '$enganche')");

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
    }
    else
    {
        //no es nueva subcategoria, se edita una existente, por lo tanto:
        //al terminar de actualizarlo, se actualuzan los datos de todos los productos que pertenezcan a esta subcat
        //code for update a selected categoria
        $nombre_subcat = $_POST['nombre_subcat'];
        $existe_editsubcat = mysqli_query($conexion, "SELECT count(idsubcategoria) as num from subcategoria where nombre = '$nombre_subcat'");
        $si_existe_un_nombre_igual = 0;
        if ((int) mysqli_fetch_assoc($existe_editsubcat)['num'] > 0)
        {
          //ya existe, mandar mensaje
          $si_existe_un_nombre_igual = 1;
        }
        $existe_editsubcat = mysqli_query($conexion, "SELECT nombre from subcategoria where idsubcategoria = '$idsubcategoria'");
        $es_igual_al_nombre_actual = 0;
        if (mysqli_fetch_assoc($existe_editsubcat)['nombre'] == $nombre_subcat)
        {
          $es_igual_al_nombre_actual = 1;
        }

        if($si_existe_un_nombre_igual == 1 and $es_igual_al_nombre_actual == 0)
        {
          //mandar mensaje de que ya existe
          $resultInsertSubcat = 1;
        }
        else
        {
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

          //lo nuevo de credito
          $base_inicial_c1 = $_POST['base_inicial_c1_sub'];
          $ganancia_inicial_c1 = $_POST['ganancia_inicial_c1_sub'];
          $rango_c1 = $_POST['rango_c1_sub'];
          $ganancia_subsecuente_c1 = $_POST['ganancia_subsecuente_c1_sub'];
          $limite_costo_c1 = $_POST['limite_costo_c1_sub'];
          //credito 2
          $base_inicial_c2 = $_POST['base_inicial_c2_sub'];
          $ganancia_inicial_c2 = $_POST['ganancia_inicial_c2_sub'];
          $rango_c2 = $_POST['rango_c2_sub'];
          $ganancia_subsecuente_c2 = $_POST['ganancia_subsecuente_c2_sub'];
          $limite_costo_c2 = $_POST['limite_costo_c2_sub'];

          $mesespago = $_POST['mesespago_sub'];
          $garantia = $_POST['garantia_sub'];
          $enganche = $_POST['enganche_sub'];

          //idcat -> $idcategoria
          $update_subcat = mysqli_query($conexion, "UPDATE subcategoria set nombre = '$nombre_subcat', categoria = '$categoria_subcategoria', atr1 = '$atr1', atr2 = ".(!empty($atr2) ? "'$atr2'" : "NULL").", atr3 = ".(!empty($atr3) ? "'$atr3'" : "NULL").", atr4 = ".(!empty($atr4) ? "'$atr4'" : "NULL").", atr5 = ".(!empty($atr5) ? "'$atr5'" : "NULL").", contado = ".(!empty($contado) ? "$contado" : "NULL").", especial = ".($especial == null ? "NULL" : "$especial").", base_inicial_c1 = ".(!empty($base_inicial_c1) ? "$base_inicial_c1" : "NULL").", ganancia_inicial_c1 = ".(!empty($ganancia_inicial_c1) ? "$ganancia_inicial_c1" : "NULL").", rango_c1 = ".(!empty($rango_c1) ? "$rango_c1" : "NULL").", ganancia_subsecuente_c1 = ".(!empty($ganancia_subsecuente_c1) ? "$ganancia_subsecuente_c1" : "NULL").", limite_costo_c1 = ".(!empty($limite_costo_c1) ? "$limite_costo_c1" : "NULL").", base_inicial_c2 = ".(!empty($base_inicial_c2) ? "$base_inicial_c2" : "NULL").", ganancia_inicial_c2 = ".(!empty($ganancia_inicial_c2) ? "$ganancia_inicial_c2" : "NULL").", rango_c2 = ".(!empty($rango_c2) ? "$rango_c2" : "NULL").", ganancia_subsecuente_c2 = ".(!empty($ganancia_subsecuente_c2) ? "$ganancia_subsecuente_c2" : "NULL").", limite_costo_c2 = ".(!empty($limite_costo_c2) ? "$limite_costo_c2" : "NULL").", meses_pago = ".(!empty($mesespago) ? "$mesespago" : "NULL").", meses_garantia = ".(!empty($garantia) ? "$garantia" : "NULL").", enganche = ".(!empty($enganche) ? "$enganche" : "NULL")." WHERE idsubcategoria  = '$idsubcategoria'");
          
          //actualizar productos con base en los nuevos parametros de subcategoria
          //ACTUALIZAR TODOS LOS PRODUCTOS QUE PERTENCEZCAN A ESTA SUBCATEGORIA
          $selcet_idproductos = mysqli_query($conexion, "SELECT idproducto,costo,costo_iva FROM producto where subcategoria = '$idsubcategoria'");
          $resul_save_cost = 1;
          while ($data = mysqli_fetch_assoc($selcet_idproductos)) 
          {
            $id_productos = $data['idproducto'];
            //actualizar cada producto
            //actualizamos el costo y calculamos nuevos costos de lo demas
            //sacar la info de los parametros de subcat
            $newcosto_iva = $data['costo_iva'];
            $newcosto_contado = ceil($newcosto_iva + ($newcosto_iva*($contado/100)));
            if($especial == null)
            {
              $newcosto_especial = null;
            }
            else
            {
              $newcosto_especial = ceil($newcosto_contado + ($newcosto_contado*($especial/100)));
            }
            //credito1 
            $cr1 = 0;
            if($newcosto_iva < $base_inicial_c1)
            {
              $cr1 = $ganancia_inicial_c1;
            }
            else if ($newcosto_iva < ($base_inicial_c1 + $rango_c1))
            {
              $cr1 = $ganancia_subsecuente_c1;
            }
            else
            {
              $costo_temp = $base_inicial_c1 + $rango_c1;//2100
              $ganancia_temp = $ganancia_subsecuente_c1;// 80
              while(true)
              {
                $costo_temp = $costo_temp + $rango_c1;//2200,2300
                $ganancia_temp = $ganancia_temp - 1;//79,78
                //2250<2200, 2250<2300,   //2100<=10000,2200<=10000
                if(($newcosto_iva < $costo_temp) || ($costo_temp >= $limite_costo_c1))
                {
                  $cr1 = $ganancia_temp;
                  break;
                }
              }
            }
            $newcosto_cr1 = ceil($newcosto_iva + ($newcosto_iva*($cr1/100)));

            //credito2
            $cr2 = 0;
            if($newcosto_iva < $base_inicial_c2)
            {
              $cr2 = $ganancia_inicial_c2;
            }
            else if ($newcosto_iva < ($base_inicial_c2 + $rango_c2))
            {
              $cr2 = $ganancia_subsecuente_c2;
            }
            else
            {
              $costo_temp2 = $base_inicial_c2 + $rango_c2;//2100
              $ganancia_temp2 = $ganancia_subsecuente_c2;// 80
              while(true)
              {
                $costo_temp2 = $costo_temp2 + $rango_c2;//2200,2300
                $ganancia_temp2 = $ganancia_temp2 - 1;//79,78
                //2250<2200, 2250<2300,   //2100<=10000,2200<=10000
                if(($newcosto_iva < $costo_temp2) || ($costo_temp2 >= $limite_costo_c2))
                {
                  $cr2 = $ganancia_temp2;
                  break;
                }
              }
            }
            $newcosto_cr2 = ceil($newcosto_iva + ($newcosto_iva*($cr2/100)));
            
            $new_e_q = ($newcosto_iva/$mesespago);
            if($new_e_q < 400)
            {
              $new_e_q = 400;
            }
            $new_e_q = ceil($new_e_q);
            
            $new_p1 = ($newcosto_cr1/$new_e_q)/2;
            $new_p2 = ($newcosto_cr2/$new_e_q)/2;
            $newcosto_enganche = ceil($newcosto_cr2*($enganche/100) + 100);
            //guardamos en la base 
            //fin calculo de nuevos costos, ahora actualizamos en el producto
            $update_costos = mysqli_query($conexion, "UPDATE producto set categoria = '$categoria_subcategoria', costo_contado = $newcosto_contado, costo_especial = ".($newcosto_especial == null ? "NULL" : "$newcosto_especial").", costo_cr1 = $newcosto_cr1, costo_cr2 = $newcosto_cr2, costo_p1 = $new_p1, costo_p2 = $new_p2, costo_eq = $new_e_q, costo_enganche = $newcosto_enganche where idproducto = '$id_productos'");
            if(!$update_costos)
            {
              $resul_save_cost = 0;
            }
          }
          //revisar y mandar mensajes correspondientes
          if ($update_subcat and $resul_save_cost) 
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
  }
  else
  {
    $resultInsertSubcat = 0;
  }
  //$resultInsertSubcat = mysqli_error($conexion);
  echo json_encode($resultInsertSubcat,JSON_UNESCAPED_UNICODE);
  exit;
}

//aqui va a ir el form de subir imagen
if ($_POST['action'] == 'load_img') 
{  
  include "accion/conexion.php";
  if (!empty($_POST['flagid_producto_img'])) 
  {
        //subimos la imagen del prodcuto
        //buscamos la info del producto
        
        $id_producto = $_POST['flagid_producto_img'];
        $select_producto = mysqli_query($conexion, "SELECT subcategoria, identificador from producto WHERE idproducto = '$id_producto'");
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
            $select_producto_full = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, subcategoria.nombre as subcat_producto, atr1_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria INNER JOIN subcategoria on subcategoria.idsubcategoria = producto.subcategoria WHERE idproducto = '$id_producto'");
            $data_producto = mysqli_fetch_assoc($select_producto_full);
            $catproducto = $data_producto['catproducto'];
            $subcat_producto = $data_producto['subcat_producto'];
            $atr1_producto = $data_producto['atr1_producto'];
             //creamos la ubicacion
            $estructura = "../img/catalogo_productos/".$catproducto."/".$subcat_producto."/".$atr1_producto;
        }

        $flag_control_dirimg = 1;
        if (!is_dir($estructura)) 
        {
            if(!mkdir($estructura, 0777, true))
            {
                //error al crear la direccion
                $flag_control_dirimg = 0;
            }
        }
        //echo $flag_control_dirimg;

        $nombre_archivo = $datap['identificador'];
        $nombre_archivo_real = $_FILES['imgProducto']['name'];
        $extencion = explode(".",$nombre_archivo_real)[1];
        $allow_files = array("png","jpg","jpge");
        //echo $nombre_archivo_real;
        if(in_array($extencion, $allow_files))
        {
            $tamano_archivo = $_FILES['imgProducto']['size'];
            if($tamano_archivo > 10000000) //10MB
            {
                //imagen muy grande
                $load_img = 2;
                //$modal = "$('#mensaje_imggrande').modal('show');";
            }
            else
            {
                //procedemos con guardarlo 
                $tmp_archivo = $_FILES['imgProducto']['tmp_name'];
                $archivador = $estructura."/".$nombre_archivo.".png";//.$extencion;
                @move_uploaded_file($tmp_archivo, $archivador);
                if(is_file($archivador))
                {
                    //guardado correctamente
                    $load_img = 1;
                    //$modal = "$('#mensaje_imgsuccess').modal('show');";
                }
                else
                {
                    //error y no se guardo bien
                    $load_img = 0;
                    //$modal = "$('#mensaje_imgerror').modal('show');";
                }
            }
        }
        else
        {
            //decir que no es un archivo permitido
            $load_img = 3;
            //$modal = "$('#mensaje_imgnoallow').modal('show');";
        }
        //$load_img = 1;
  }
  else
  {
    //algun error
    $load_img = 0;
  }

  //$load_img = mysqli_error($conexion);
  //sleep(5);
  //return
  echo json_encode($load_img,JSON_UNESCAPED_UNICODE);
  exit;
}

//form para insertar nuevo producto o editar el producto selecionado
if ($_POST['action'] == 'insert_edit_producto') 
{  
  include "accion/conexion.php";
  if (!empty($_POST['flagid_producto'])) 
  {
    //TODO ESTO DE INGRESAR, EDITAR PRODUCTO Y AGREGAR IMAGEN SE PASARA A AJAX, para mostrar el cargando
    $ban = $_POST['flagid_producto'];
    if($ban == "nuevoproducto")
    {
        //insertamos el nuevo producto
        $identificador = $_POST['identificador'];
        //verificar si ya existe ese identificador de producto, los cuales se usan para guardar las imagenes
        $find_id = mysqli_query($conexion, "SELECT idproducto from producto where identificador = '$identificador'");
        if(mysqli_num_rows($find_id) > 0)
        {
            //entonces ya hay uno, avisarle
            $producto_result = 2;
            //$modal = "$('#mensaje_repetido').modal('show');";
        }
        else
        {
            $codigo_barras = $_POST['codigo_barras'];
            $categoria_producto = $_POST['categoria_producto'];
            //echo $_POST['subcategoria_producto'];
            if(isset($_POST['subcategoria_producto']))
            {
                $subcategoria_producto = $_POST['subcategoria_producto'];
            }
            else
            {
                $subcategoria_producto = "no";
            }
            //echo "/";
            //echo $subcategoria_producto;
            //$subcategoria_producto = $_POST['subcategoria_producto'];
            $descripcion = $_POST['descripcion'];
            if (isset($_POST['serializado']))
                {
                    $serializado = 1;
                }
                else
                {
                    $serializado = 0;
                }
            $atr1_producto = $_POST['atr1_producto'];
            $atr2_producto = $_POST['atr2_producto'];
            $atr3_producto = $_POST['atr3_producto'];
            $atr4_producto = $_POST['atr4_producto'];
            $atr5_producto = $_POST['atr5_producto'];
            $stock_min = $_POST['stock_min'];
            $stock_max = $_POST['stock_max'];
            $ext_p = $_POST['ext_p'];
            $costo = $_POST['costo'];
            $costo_iva = $_POST['costo_iva'];
            $costo_contado = $_POST['costo_contado'];
            if(isset($_POST['costo_especial']))
            {
                $costo_especial = $_POST['costo_especial'];
            }
            else
            {   
                $costo_especial = null;
            }
            $costo_cr1 = $_POST['costo_cr1'];
            $costo_cr2 = $_POST['costo_cr2'];
            $costo_p1 = $_POST['costo_p1'];
            $costo_p2 = $_POST['costo_p2'];
            $costo_eq = $_POST['costo_eq'];
            $costo_enganche = $_POST['costo_enganche'];

            /*echo $costo;
            echo "/";
            echo $costo_contado;
            echo "/";
            echo $subcategoria_producto;*/
            
            $insert_producto = mysqli_query($conexion, "INSERT INTO producto(idproducto, identificador, codigo_barras, categoria, subcategoria, descripcion, serializado, atr1_producto, atr2_producto, atr3_producto, atr4_producto, atr5_producto, stock_min, stock_max, ext_p, costo, costo_iva, costo_contado, costo_especial, costo_cr1, costo_cr2, costo_p1, costo_p2, costo_eq, costo_enganche) VALUES (UUID(), '$identificador', ".(!empty($codigo_barras) ? "'$codigo_barras'" : "NULL").", '$categoria_producto', ".($subcategoria_producto=="no" ? "NULL" : "'$subcategoria_producto'").", ".(!empty($descripcion) ? "'$descripcion'" : "NULL").", $serializado, '$atr1_producto', ".(!empty($atr2_producto) ? "'$atr2_producto'" : "NULL").", ".(!empty($atr3_producto) ? "'$atr3_producto'" : "NULL").", ".(!empty($atr4_producto) ? "'$atr4_producto'" : "NULL").", ".(!empty($atr5_producto) ? "'$atr5_producto'" : "NULL").", ".(!empty($stock_min) ? "'$stock_min'" : "NULL").", ".(!empty($stock_max) ? "'$stock_max'" : "NULL").", ".(!empty($ext_p) ? "'$ext_p'" : "NULL").", $costo, $costo_iva, $costo_contado, ".($costo_especial == null ? "NULL" : "$costo_especial").", $costo_cr1, $costo_cr2, $costo_p1, $costo_p2, $costo_eq, $costo_enganche)");
            if ($insert_producto) 
            {
                //todo chido
                $producto_result = 1;
                //$modal = "$('#mensaje_success').modal('show');";
            }
            else
            {
                //error
                $producto_result = 0;
                //$modal = "$('#mensaje_error').modal('show');";
                //echo mysqli_error($conexion);
            }
        }
    }
    else
    { 
        //RECUERDA: IDENTIFICADOR NO ES EL ID DE PRODUCTO, el ID de producto es otro generado aleatoriamente
        $identificador = $_POST['identificador']; //no es el ID, el id será id_producto de flagid_producto
        $id_producto = $_POST['flagid_producto']; //ESTE ES EL ID de la tabla
        //ver si no ya existe ese identificador que se quiere modificar
        $find_id = mysqli_query($conexion, "SELECT count(idproducto) as num from producto where identificador = '$identificador'");
        $si_existe_un_nombre_igual = (int) mysqli_fetch_assoc($find_id)['num'];
        
        $existe_identificador = mysqli_query($conexion, "SELECT identificador from producto where idproducto = '$id_producto'");
        $es_igual_al_nombre_actual = 0;
        if (mysqli_fetch_assoc($existe_identificador)['identificador'] == $identificador)
        {
          $es_igual_al_nombre_actual = 1;
        }

        if($si_existe_un_nombre_igual > 0 and $es_igual_al_nombre_actual == 0)
        {
            //entonces ya hay uno, avisarle
            $producto_result = 2;
            //$modal = "$('#mensaje_repetido').modal('show');";
        }
        else
        {
          //editar producto
          //entonces editamos el producto
          $codigo_barras = $_POST['codigo_barras'];
          $categoria_producto = $_POST['categoria_producto'];
          if(isset($_POST['subcategoria_producto']))
          {
              $subcategoria_producto = $_POST['subcategoria_producto'];
          }
          else
          {
              $subcategoria_producto = 0;
          }
          //$subcategoria_producto = $_POST['subcategoria_producto'];
          $descripcion = $_POST['descripcion'];
          if (isset($_POST['serializado']))
              {
                  $serializado = 1;
              }
              else
              {
                  $serializado = 0;
              }
          $atr1_producto = $_POST['atr1_producto'];
          $atr2_producto = $_POST['atr2_producto'];
          $atr3_producto = $_POST['atr3_producto'];
          $atr4_producto = $_POST['atr4_producto'];
          $atr5_producto = $_POST['atr5_producto'];
          $stock_min = $_POST['stock_min'];
          $stock_max = $_POST['stock_max'];
          $ext_p = $_POST['ext_p'];
          $costo = $_POST['costo'];
          $costo_iva = $_POST['costo_iva'];
          $costo_contado = $_POST['costo_contado'];
          if(isset($_POST['costo_especial']))
          {
              $costo_especial = $_POST['costo_especial'];
          }
          else
          {   
              $costo_especial = null;
          }
          $costo_cr1 = $_POST['costo_cr1'];
          $costo_cr2 = $_POST['costo_cr2'];
          $costo_p1 = $_POST['costo_p1'];
          $costo_p2 = $_POST['costo_p2'];
          $costo_eq = $_POST['costo_eq'];
          $costo_enganche = $_POST['costo_enganche'];

          $update_producto = mysqli_query($conexion, "UPDATE producto set identificador =  '$identificador', codigo_barras = ".(!empty($codigo_barras) ? "'$codigo_barras'" : "NULL").", categoria = '$categoria_producto', subcategoria = ".($subcategoria_producto!=0 ? "'$subcategoria_producto'" : "NULL").", descripcion = ".(!empty($descripcion) ? "'$descripcion'" : "NULL").", serializado = $serializado, atr1_producto = '$atr1_producto', atr2_producto = ".(!empty($atr2_producto) ? "'$atr2_producto'" : "NULL").", atr3_producto = ".(!empty($atr3_producto) ? "'$atr3_producto'" : "NULL").", atr4_producto = ".(!empty($atr4_producto) ? "'$atr4_producto'" : "NULL").", atr5_producto = ".(!empty($atr5_producto) ? "'$atr5_producto'" : "NULL").", stock_min = ".(!empty($stock_min) ? "'$stock_min'" : "NULL").", stock_max = ".(!empty($stock_max) ? "'$stock_max'" : "NULL").", ext_p = ".(!empty($ext_p) ? "'$ext_p'" : "NULL").", costo = $costo, costo_iva = $costo_iva, costo_contado = $costo_contado, costo_especial = ".(!empty($costo_especial) ? "$costo_especial" : "NULL").", costo_cr1 = $costo_cr1, costo_cr2 = $costo_cr2, costo_p1 = $costo_p1, costo_p2 = $costo_p2, costo_eq = $costo_eq, costo_enganche = $costo_enganche WHERE idproducto = '$id_producto'");
          if ($update_producto) 
          {
              //edito bien
              $producto_result = 3;
              //$modal = "$('#mensaje_success').modal('show');";
          }
          else
          {
              //edito mal
              $producto_result = 0;
              //$modal = "$('#mensaje_error').modal('show');";
              //echo mysqli_error($conexion);
          }
        }
    }
  }
  else
  {
    //algun error cabron
    $producto_result = 0;
  }

  //$producto_result = mysqli_error($conexion);
  //sleep(5);
  //return
  echo json_encode($producto_result,JSON_UNESCAPED_UNICODE);
  exit;
}

#para insertar un nuevo almacén
if ($_POST['action'] == 'insert_almacen') 
{  
  include "accion/conexion.php";
  if (!empty($_POST['nombre_almacen'])) 
  {
    $nuevo_almacen = $_POST['nombre_almacen'];
    $idsucursal_almacen = $_POST['sucursal_almacen'];

    //verificar si ya existe ese nombre de almacen
    $find_id = mysqli_query($conexion, "SELECT idalmacen from almacen where nombre = '$nuevo_almacen'");
    if(mysqli_num_rows($find_id) > 0)
    {
      //entonces ya hay uno, avisarle
      $resultInsertAlmacen = 2;
      //$modal = "$('#mensaje_repetido').modal('show');";
    }
    else
    {
      $resultIDalmacen= mysqli_query($conexion, "SELECT UUID() as idalmacen");
      $uuid = mysqli_fetch_assoc($resultIDalmacen)['idalmacen'];
      $insert_almacen = mysqli_query($conexion, "INSERT INTO almacen(idalmacen,nombre,sucursal) values ('$uuid','$nuevo_almacen', '$idsucursal_almacen')");
      if ($insert_almacen) 
      {
        #$idalmacen = array("idalmacen" => $uuid);
        #$almacen = array("almacen" => $nuevo_almacen);
        #$resultInsertAlmacen = $idalmacen + $almacen;
        $resultInsertAlmacen = 1;
      } 
      else
      {
        $resultInsertAlmacen = 0;
      }
    }
  }
  else
  {
    $resultInsertAlmacen = 0;
  }
  echo json_encode($resultInsertAlmacen,JSON_UNESCAPED_UNICODE);
  exit;
}

#para insertar y editar un tipo de venta
if ($_POST['action'] == 'insert_tipo_venta') 
{  
  include "accion/conexion.php";
  if (!empty($_POST['nuevatipo_venta'])) 
  {
    $nuevo_tipo_venta = $_POST['nuevatipo_venta'];

    //verificar si ya existe ese tipo de venta
    $find_id = mysqli_query($conexion, "SELECT idtipo_venta from venta_tipo where nombre_venta = '$nuevo_tipo_venta'");
    if(mysqli_num_rows($find_id) > 0)
    {
      //entonces ya hay uno, avisarle
      $resultVentaTipo = 2;
      //$modal = "$('#mensaje_repetido').modal('show');";
    }
    else
    {
      //no es repetido
      $ban = $_POST['flagid_tipoVenta'];
      if($ban == "nuevo_tipo_de_venta")
      {
          //insertar nuevo tipo de venta
          $resultIDtipoVenta= mysqli_query($conexion, "SELECT UUID() as idtipo_venta");
          $uuid = mysqli_fetch_assoc($resultIDtipoVenta)['idtipo_venta'];
          $insert_tipo_venta = mysqli_query($conexion, "INSERT INTO venta_tipo(idtipo_venta,nombre_venta) values ('$uuid','$nuevo_tipo_venta')");
          if ($insert_tipo_venta) 
          {
            //$resultVentaTipo = 1; 1-> insertar, 3->editar
            $flag_action = array("flag_action" => 1);
            $idtipo_venta = array("idtipo_venta" => $uuid);
            $nombre_venta = array("nombre_venta" => $nuevo_tipo_venta);
            $resultVentaTipo = $idtipo_venta + $nombre_venta + $flag_action;
          } 
          else
          {
            $resultVentaTipo = 0;
          }
      }
      else
      {
        //editar nuevo tipo de venta
        $id_tipo_venta = $ban;
        $update_tipo_venta = mysqli_query($conexion, "UPDATE venta_tipo SET nombre_venta='$nuevo_tipo_venta' where idtipo_venta = '$id_tipo_venta'");
        if ($update_tipo_venta) 
        {
          $flag_action = array("flag_action" => 3);
          $idtipo_venta = array("idtipo_venta" => $id_tipo_venta);
          $nombre_venta = array("nombre_venta" => $nuevo_tipo_venta);
          $resultVentaTipo = $idtipo_venta + $nombre_venta + $flag_action;
        } 
        else
        {
          $resultVentaTipo = 0;
        }
      }
    }
  }
  else
  {
    $resultVentaTipo = 0;
  }
  echo json_encode($resultVentaTipo,JSON_UNESCAPED_UNICODE);
  exit;
}

#para insertar y editar modalidad de pago
if ($_POST['action'] == 'insert_modalidad_pago') 
{  
  include "accion/conexion.php";
  if (!empty($_POST['nuevamodalidad_pago'])) 
  {
    $nueva_modalidad = $_POST['nuevamodalidad_pago'];

    //verificar si ya existe ese tipo de venta
    $find_id = mysqli_query($conexion, "SELECT idmodalidad_pago from modalidad_pago where idmodalidad_pago = '$nueva_modalidad'");
    if(mysqli_num_rows($find_id) > 0)
    {
      //entonces ya hay uno, avisarle
      $resultModalidadPago = 2;
      //$modal = "$('#mensaje_repetido').modal('show');";
    }
    else
    {
      //no es repetido
      $ban = $_POST['flagid_modalidadPago'];
      if($ban == "nueva_modalidad_de_pago")
      {
          //insertar nuevo tipo de venta
          $resultIDModalidadPagoa= mysqli_query($conexion, "SELECT UUID() as idmodalidad_pago");
          $uuid = mysqli_fetch_assoc($resultIDModalidadPagoa)['idmodalidad_pago'];
          $insert_modalidad = mysqli_query($conexion, "INSERT INTO modalidad_pago(idmodalidad_pago, nombre_modalidad) values ('$uuid','$nueva_modalidad')");
          if ($insert_modalidad) 
          {
            //$resultModalidadPago = 1; 1-> insertar, 3->editar 2->ya existe, 0->error
            $flag_action = array("flag_action" => 1);
            $idmodalidad_pago = array("idmodalidad_pago" => $uuid);
            $nombre_modalidad = array("nombre_modalidad" => $nueva_modalidad);
            $resultModalidadPago = $idmodalidad_pago + $nombre_modalidad + $flag_action;
          } 
          else
          {
            $resultModalidadPago = 0;
          }
      }
      else
      {
        //editar nuevo tipo de venta
        $id_modalidad_pago = $ban;
        $update_modalidad = mysqli_query($conexion, "UPDATE modalidad_pago SET nombre_modalidad='$nueva_modalidad' where idmodalidad_pago = '$id_modalidad_pago'");
        if ($update_modalidad) 
        {
          $flag_action = array("flag_action" => 3);
          $idmodalidad_pago = array("idmodalidad_pago" => $id_modalidad_pago);
          $nombre_modalidad = array("nombre_modalidad" => $nueva_modalidad);
          $resultModalidadPago = $idmodalidad_pago + $nombre_modalidad + $flag_action;
        } 
        else
        {
          $resultModalidadPago = 0;
        }
      }
    }
  }
  else
  {
    $resultModalidadPago = 0;
  }
  echo json_encode($resultModalidadPago,JSON_UNESCAPED_UNICODE);
  exit;
}

#para insertar y editar un tipo de compra
if ($_POST['action'] == 'insert_tipo_compra') 
{  
  include "accion/conexion.php";
  if (!empty($_POST['nuevatipo_compra'])) 
  {
    $nuevo_tipo_compra = $_POST['nuevatipo_compra'];

    //verificar si ya existe ese tipo de venta
    $find_id = mysqli_query($conexion, "SELECT idtipo_compra from compra_tipo where nombre_compra = '$nuevo_tipo_compra'");
    if(mysqli_num_rows($find_id) > 0)
    {
      //entonces ya hay uno, avisarle
      $resultCompraTipo = 2;
      //$modal = "$('#mensaje_repetido').modal('show');";
    }
    else
    {
      //no es repetido
      $ban = $_POST['flagid_tipoCompra'];
      if($ban == "nuevo_tipo_de_compra")
      {
          //insertar nuevo tipo de venta
          $resultIDtipoCompra= mysqli_query($conexion, "SELECT UUID() as idtipo_compra");
          $uuid = mysqli_fetch_assoc($resultIDtipoCompra)['idtipo_compra'];
          $insert_tipo_compra = mysqli_query($conexion, "INSERT INTO compra_tipo(idtipo_compra,nombre_compra) values ('$uuid','$nuevo_tipo_compra')");
          if ($insert_tipo_compra) 
          {
            //$resultVentaTipo = 1; 1-> insertar, 3->editar
            $flag_action = array("flag_action" => 1);
            $idtipo_compra = array("idtipo_compra" => $uuid);
            $nombre_compra = array("nombre_compra" => $nuevo_tipo_compra);
            $resultCompraTipo = $idtipo_compra + $nombre_compra + $flag_action;
          } 
          else
          {
            $resultCompraTipo = 0;
          }
      }
      else
      {
        //editar nuevo tipo de venta
        $id_tipo_compra = $ban;
        $update_tipo_compra = mysqli_query($conexion, "UPDATE compra_tipo SET nombre_compra='$nuevo_tipo_compra' where idtipo_compra = '$id_tipo_compra'");
        if ($update_tipo_compra) 
        {
          $flag_action = array("flag_action" => 3);
          $idtipo_compra = array("idtipo_compra" => $id_tipo_compra);
          $nombre_compra = array("nombre_compra" => $nuevo_tipo_compra);
          $resultCompraTipo = $idtipo_compra + $nombre_compra + $flag_action;
        } 
        else
        {
          $resultCompraTipo = 0;
        }
      }
    }
  }
  else
  {
    $resultCompraTipo = 0;
  }
  echo json_encode($resultCompraTipo,JSON_UNESCAPED_UNICODE);
  exit;
}

#para insertar y editar un proveedor
if ($_POST['action'] == 'insert_proveedor') 
{  
  include "accion/conexion.php";
  if (!empty($_POST['nuevoProveedor'])) 
  {
    $nuevo_proveedor = $_POST['nuevoProveedor'];
    $telproveedor = $_POST['telProveedor'];

      $ban = $_POST['flagid_Proveedor'];
      if($ban == "nuevo_proveedor")
      {
          //verificar si ya existe ese proveedor
          $find_id = mysqli_query($conexion, "SELECT idproveedor from proveedor where nombre_proveedor = '$nuevo_proveedor'");
          if(mysqli_num_rows($find_id) > 0)
          {
            //entonces ya hay uno, avisarle
            $resultProveedor = 2;
            //$modal = "$('#mensaje_repetido').modal('show');";
          }
          else
          {
            //no es repetido
            //insertar nuevo tipo de venta
            $resultIDProveedor= mysqli_query($conexion, "SELECT UUID() as idproveedor");
            $uuid = mysqli_fetch_assoc($resultIDProveedor)['idproveedor'];
            $insert_proveedor = mysqli_query($conexion, "INSERT INTO proveedor(idproveedor,nombre_proveedor,tel_proveedor) values ('$uuid','$nuevo_proveedor','$telproveedor')");
            if ($insert_proveedor) 
            {
              //$resultVentaTipo = 1; 1-> insertar, 3->editar
              $flag_action = array("flag_action" => 1);
              $idproveedor = array("idproveedor" => $uuid);
              $nombre_proveedor = array("nombre_proveedor" => $nuevo_proveedor);
              $tel_proveedor = array("tel_proveedor" => $telproveedor);
              $resultProveedor = $idproveedor + $nombre_proveedor + $tel_proveedor + $flag_action;
            } 
            else
            {
              $resultProveedor = 0;
            }
          } 
      }
      else
      {
        //editar nuevo tipo de venta
        $id_proveedor = $ban;
        $update_proveedor = mysqli_query($conexion, "UPDATE proveedor SET nombre_proveedor='$nuevo_proveedor',tel_proveedor='$telproveedor' where idproveedor = '$id_proveedor'");
        if ($update_proveedor) 
        {
          $flag_action = array("flag_action" => 3);
          $idproveedor = array("idproveedor" => $id_proveedor);
          $nombre_proveedor = array("nombre_proveedor" => $nuevo_proveedor);
          $tel_proveedor = array("tel_proveedor" => $telproveedor);
          $resultProveedor = $idproveedor + $nombre_proveedor + $tel_proveedor + $flag_action;
        } 
        else
        {
          $resultProveedor = 0;
        }
      }
  }
  else
  {
    $resultProveedor = 0;
  }
  echo json_encode($resultProveedor,JSON_UNESCAPED_UNICODE);
  exit;
}

//para guardar la salida en la base de datos
if ($_POST['action'] == 'insert_salida_venta') 
{  
  include "accion/conexion.php";
  $vendedor = $_POST['vendedor'];
  $id_cliente = $_POST['id_cliente'];
  $fecha = $_POST['fecha'];

  $id_documento = $_POST['tipo_documento'];
  $folio_venta = $_POST['folio_venta'];
  $folio_venta_serie = intval($_POST['folio_venta_serie']);

  //para actualizar la tabla de documentos
  $long_formato = 7;
  $next_serie = $folio_venta_serie + 1;
  $sizeno_serie = strlen(strval($next_serie));
  $ceros = "";
  for ($i=0; $i < $long_formato-$sizeno_serie; $i++) 
  { 
    $ceros = $ceros."0";
  }
  $next_str_folio_venta_serie = $ceros.strval($next_serie);


  $tipo_venta = $_POST['tipo_venta'];
  $modalidad_pago = $_POST['modalidad_pago'];
  $n_pagos = $_POST['n_pagos'];
  $pago_parcial = $_POST['pago_parcial'];
  $primer_dia_pago = $_POST['primer_dia_pago'];
  $dias_pago_semanal = (isset($_POST['dias_pago_semanal']) ? $_POST['dias_pago_semanal'] : NULL);
  $dias_pago_quincenal = (isset($_POST['dias_pago_quincenal']) ? $_POST['dias_pago_quincenal'] : NULL);
  $dias_pago_quincenal_2 = (isset($_POST['dias_pago_quincenal_2']) ? $_POST['dias_pago_quincenal_2'] : NULL);
  $dias_pago_mensual = (isset($_POST['dias_pago_mensual']) ? $_POST['dias_pago_mensual'] : NULL);

  $enganche_dado = $_POST['enganche_dado'];
  $subtotal1 = $_POST['subtotal1_flag'];
  $ivas = $_POST['ivas_flag'];
  $subtotal2 = $_POST['subtotal2_flag'];
  $descuento = (empty($_POST['descuento_venta']) ? 0 : $_POST['descuento_venta']);
  $total_venta = $_POST['total_flag'];

  //generamos id salida (la venta total)
  $resultIDSalida= mysqli_query($conexion, "SELECT UUID() as idsalida");
  $uuid_salida = mysqli_fetch_assoc($resultIDSalida)['idsalida'];
  //insertamos salida general 
  $insert_salida = mysqli_query($conexion, "INSERT INTO salida(idsalida, vendedor, cliente, fecha_salida, documento, folio_venta, folio_venta_serie, tipo_venta, modalidad_pago, no_pagos, pago_parcial, per_dia_pago, dias_pago_semanal, dias_pago_quincenal, dias_pago_quincenal_2, dias_pago_mensual, enganche, subtotal1, iva, subtotal2, descuento, total_general) VALUES ('$uuid_salida','$vendedor','$id_cliente','$fecha','$id_documento','$folio_venta','$folio_venta_serie','$tipo_venta','$modalidad_pago',".(!empty($n_pagos) ? "'$n_pagos'" : "NULL").",".(!empty($pago_parcial) ? "'$pago_parcial'" : "NULL").",".(!empty($primer_dia_pago) ? "'$primer_dia_pago'" : "NULL").",".(!empty($dias_pago_semanal) ? "'$dias_pago_semanal'" : "NULL").",".(!empty($dias_pago_quincenal) ? "'$dias_pago_quincenal'" : "NULL").", ".(!empty($dias_pago_quincenal_2) ? "'$dias_pago_quincenal_2'" : "NULL").",".(!empty($dias_pago_mensual) ? "'$dias_pago_mensual'" : "NULL").",'$enganche_dado','$subtotal1','$ivas','$subtotal2','$descuento','$total_venta')");

  //incrementar el contador de la serie del folio
  $update_serie_folio = mysqli_query($conexion, "UPDATE documento set serie = '$next_str_folio_venta_serie' where iddocumento = '$id_documento'");

  //valor de cada producto a ingresar
  $id_producto = [];
  $cantidad = [];
  $tipo_precio = [];
  $precio = [];
  $flag_control = 1;
  $flag_update_stock = 0;
  for ($i=0; $i < 5; $i++) 
  { 
    if(!empty($_POST['identificador_pro_'.($i+1)]))
    {
      $id_producto[$i] = $_POST['identificador_pro_'.($i+1)];
      $cantidad[$i] = intval($_POST['cantidad_'.($i+1)]);
      $origen = $_POST['origen_'.($i+1)];
      $tipo_precio[$i] = $_POST['tipo_precio_'.($i+1)];
      $precio[$i] = doubleval($_POST['precio_'.($i+1)]);

      //calculamos el precio por unidad
      $precio_unidad = $precio[$i]/$cantidad[$i];

      //insertamos los productos en la tabla y lo asociamos a la salida
      //generamos el id de salida_producto(cada producto vendido
      $resultIDSalida_productos= mysqli_query($conexion, "SELECT UUID() as idsalida_productos");
      $uuid_salida_productos = mysqli_fetch_assoc($resultIDSalida_productos)['idsalida_productos'];
      $insert_salida_producto = mysqli_query($conexion, "INSERT INTO salida_productos(idsalida_producto, salida, producto, cantidad, tipo_precio, precio_x_unidad, precio_total) VALUES ('$uuid_salida_productos','$uuid_salida','$id_producto[$i]','$cantidad[$i]','$tipo_precio[$i]','$precio_unidad','$precio[$i]')");
      if(!$insert_salida_producto)
      {
        $flag_control = 0;
      }
      //ahora insertamos cada serie de los productos sacados
      if($cantidad[$i] == 1)
      {
        $resultIDSalida_origen= mysqli_query($conexion, "SELECT UUID() as idsalida_productos_origen");
        $uuid_salida_origen = mysqli_fetch_assoc($resultIDSalida_origen)['idsalida_productos_origen'];
        $insert_series = mysqli_query($conexion, "INSERT INTO salida_productos_origen(idsalida_producto_origen, salida_productos, salida, producto, serie_origen) VALUES ('$uuid_salida_origen','$uuid_salida_productos','$uuid_salida','$id_producto[$i]','$origen')");
        if($insert_series) 
        {
          //poner esa serie como vendida
          $update_serie = mysqli_query($conexion, "UPDATE entrada_productos_serie set vendido = 1 where identrada_producto_serie = '$origen'");
        }
        else
        {
          $flag_control = 0;
        }
      }
      else if($cantidad[$i] > 1)
      {
        //es mas de uno
        $origen_array = $_POST['origen_multi_'.($i+1)];
        $size_series = $cantidad[$i];
        for ($j=0; $j < $size_series; $j++) 
        { 
          //insertar cada serie
          $resultIDSalida_origen= mysqli_query($conexion, "SELECT UUID() as idsalida_productos_origen");
          $uuid_salida_origen = mysqli_fetch_assoc($resultIDSalida_origen)['idsalida_productos_origen'];
          $insert_series = mysqli_query($conexion, "INSERT INTO salida_productos_origen(idsalida_producto_origen, salida_productos, salida, producto, serie_origen) VALUES ('$uuid_salida_origen','$uuid_salida_productos','$uuid_salida','$id_producto[$i]','$origen_array[$j]')");
          if($insert_series)
          {
            //poner esa serie como vendida
            $update_serie = mysqli_query($conexion, "UPDATE entrada_productos_serie set vendido = 1 where identrada_producto_serie = '$origen_array[$j]'");
          } 
          else
          {
            $flag_control = 0;
          }
        }
      }
      if($flag_control or $insert_salida)
      {
        //QUITAR DEL STOCK, reducir la cantidad que haya disponible, si da negativo, ni modos, que no deberia
        //ponerlos en la tabla de series, para saber cuanto salieron, y de ahi mostrarlo
        $select_stock = mysqli_query($conexion, "SELECT en_stock from producto where idproducto = '$id_producto[$i]'");
        $stock_corriente = intval(mysqli_fetch_assoc($select_stock)['en_stock']);
        $stock_de_esta_venta = $cantidad[$i];
        $stock_total = $stock_corriente - $stock_de_esta_venta;
        $update_stock = mysqli_query($conexion, "UPDATE producto set en_stock = '$stock_total' where idproducto = '$id_producto[$i]'");
        $flag_update_stock = 1;
      }
    }
  }

  //insertamos el primer movimiento si es que dio enganche
  if($enganche_dado > 0)
  {
    $resultIDmovimiento= mysqli_query($conexion, "SELECT UUID() as idmovimiento");
    $uuid_movimiento = mysqli_fetch_assoc($resultIDmovimiento)['idmovimiento'];
    $saldo_actual = $total_venta - $enganche_dado;
    $query_mov = mysqli_query($conexion,"INSERT INTO movimiento(idmovimiento, salida, fecha, abono, saldo_al_momento) VALUES ('$uuid_movimiento','$uuid_salida','$fecha','$enganche_dado','$saldo_actual')");
  }

  if($flag_control == 1 or !$insert_salida or $flag_update_stock == 1)
  {
    //todo bien
    //$resultSalida = 1;
    $id_new_salida = array("idsalida" => $uuid_salida);
    $resultSalida = $id_new_salida;
  }
  else
  {
    //hubo un error, no se donde, intentalo de nuevo we
    $resultSalida = 0;
  }

  //$resultSalida = mysqli_error($conexion);
  echo json_encode($resultSalida,JSON_UNESCAPED_UNICODE);
  exit;
}

//para guardar la entrada en la base de datos
if ($_POST['action'] == 'insert_entrada_compra') 
{
  //guardar la entrada en la base de datos (la entrada general)
  //entrada, entrada_productos (los productos individuales, su info) y 
  //entrada_productos_serie (en caso de varias cantidades del mismo producto)
  include "accion/conexion.php";
  $comprador = $_POST['comprador'];
  $idproveedor = $_POST['proveedor_entrada'];
  $tel_proveedor = $_POST['tel_proveedor_entrada'];
  $fecha = $_POST['fecha_entrada'];
  $folio_compra = $_POST['folio_compra'];
  $tipo_compra = $_POST['tipo_compra'];
  $sucursal = $_POST['sucursal'];
  $almacen = $_POST['almacen'];
  $n_pagos = $_POST['n_pagos_entrada'];
  $pago_parcial = $_POST['pago_parcial_entrada'];
  //los precios o costos generados
  $subtotal1 = $_POST['subtotal1_flag'];
  $ivas = $_POST['ivas_flag'];
  $subtotal2 = $_POST['subtotal2_flag'];
  $descuento = (empty($_POST['descuento_compra']) ? 0 : $_POST['descuento_compra']);
  $total_compra = $_POST['total_flag'];
  //guardamos la entrada
  $resultIDEntrada= mysqli_query($conexion, "SELECT UUID() as identrada");
  $uuid_entrada = mysqli_fetch_assoc($resultIDEntrada)['identrada'];
  //insertamos entrada general 
  $insert_entrada = mysqli_query($conexion, "INSERT INTO entrada(identrada, comprador, proveedor, tel_proveedor, fecha, folio_compra, tipo_compra, sucursal, almacen, no_pagos, pago_parcial, subtotal1, iva, subtotal2, descuento, total) VALUES ('$uuid_entrada','$comprador','$idproveedor','$tel_proveedor','$fecha', '$folio_compra','$tipo_compra','$sucursal','$almacen',".(!empty($n_pagos) ? "'$n_pagos'" : "NULL").",".(!empty($pago_parcial) ? "'$pago_parcial'" : "NULL").",'$subtotal1','$ivas','$subtotal2','$descuento','$total_compra')");
  //ahora guardamos los productos que entraron
  //valor de cada producto a ingresar
  $id_producto = [];
  $cantidad = [];
  $serie = [];
  $precio = [];
  $flag_control = 1;
  for ($i=0; $i < 5; $i++) 
  { 
    if(!empty($_POST['identificador_pro_'.($i+1)]))
    {
      $id_producto[$i] = $_POST['identificador_pro_'.($i+1)];
      $cantidad[$i] = intval($_POST['cantidad_'.($i+1)]);
      $serie[$i] = (isset($_POST['serie_'.($i+1)]) ? $_POST['serie_'.($i+1)] : NULL);
      $precio[$i] = $_POST['precio_'.($i+1)];
      $producto_serializado = intval($_POST['flag_producto_serie_'.($i+1)]);
      if (isset($_POST['tiene_iva_'.($i+1)]))
      {
        $tiene_iva[$i] = 1;
        //si tienen iva los precios
        $precio_total_iva = $precio[$i]*$cantidad[$i];
        $precio_total = $precio_total_iva[$i]/1.16;
        $precio_unidad = $precio[$i]/1.16;
        $precio_unidad_iva = $precio;
      }
      else
      {
        $tiene_iva[$i] = 0;
        //no tienen iva los precios, la variable precio es el precio sin IVA, no se hace nada más, precio = precio
        //solo calcular el precio ya con su iva
        $precio_total_iva = ($precio[$i]*$cantidad[$i])*1.16;
        $precio_total = $precio[$i]*$cantidad[$i];
        //calculamos el precio por unidad
        $precio_unidad = $precio[$i];
        $precio_unidad_iva = $precio[$i]*1.16;
      }
      //ahora vemos si hay mas de 1 cantidad y es serializado, si sí habra que guardar todas las series
      //generamos el id de entrada_producto(cada producto vendido
      $resultIDEntrada_productos= mysqli_query($conexion, "SELECT UUID() as identrada_productos");
      $uuid_entrada_productos = mysqli_fetch_assoc($resultIDEntrada_productos)['identrada_productos'];
      $insert_entrada_producto = mysqli_query($conexion, "INSERT INTO entrada_productos(identrada_producto, entrada,producto,cantidad,precio_x_unidad,precio_total,precio_x_unidad_iva,precio_total_iva,con_iva) VALUES ('$uuid_entrada_productos','$uuid_entrada','$id_producto[$i]','$cantidad[$i]','$precio_unidad','$precio_total','$precio_unidad_iva','$precio_total_iva','$tiene_iva[$i]')");
      
      //insertamos todas las series de esa entrada_productos
      $resultIDEntrada_productos_serie= mysqli_query($conexion, "SELECT UUID() as identrada_productos_serie");
      $uuid_entrada_productos_serie = mysqli_fetch_assoc($resultIDEntrada_productos_serie)['identrada_productos_serie'];
      if($cantidad[$i] == 1)
      {
        $serie_valor = NULL;
        if($producto_serializado == 1)
        {
          $serie_valor = $serie[$i];
        }
        $insert_series = mysqli_query($conexion, "INSERT INTO entrada_productos_serie(identrada_producto_serie,entrada_productos,entrada,producto,almacen_actual,serie) VALUES ('$uuid_entrada_productos_serie','$uuid_entrada_productos','$uuid_entrada','$id_producto[$i]','$almacen',".(!empty($serie_valor) ? "'$serie_valor'" : "NULL").")");
        if (!$insert_series) 
        {
          $flag_control = 0;
        }
      }
      else if($cantidad[$i] > 1)
      {
        //es mas de uno
        $series_array = $_POST['series_modal_'.($i+1)];
        $size_series = $cantidad[$i];
        $serie_valor = NULL;
        if($producto_serializado == 1)
        {
          $serie_valor = $series_array;
        }
        for ($j=0; $j < $size_series; $j++) 
        { 
          //insertar cada serie
          $resultIDEntrada_productos_serie= mysqli_query($conexion, "SELECT UUID() as identrada_productos_serie");
          $uuid_entrada_productos_serie = mysqli_fetch_assoc($resultIDEntrada_productos_serie)['identrada_productos_serie'];
          $insert_series = mysqli_query($conexion, "INSERT INTO entrada_productos_serie(identrada_producto_serie,entrada_productos,entrada,producto,almacen_actual,serie) VALUES ('$uuid_entrada_productos_serie','$uuid_entrada_productos','$uuid_entrada','$id_producto[$i]','$almacen',".(!empty($serie_valor) ? "'$serie_valor[$j]'" : "NULL").")");
          if (!$insert_series) 
          {
            $flag_control = 0;
          }
        }
      }

      $flag_update_stock = 0;
      if($flag_control or $insert_entrada)
      {
        //ADD EN STOCK, generamos el stock de muebleria y actualizamos el en_stock
        $select_stock = mysqli_query($conexion, "SELECT en_stock from producto where idproducto = '$id_producto[$i]'");
        $stock_corriente = intval(mysqli_fetch_assoc($select_stock)['en_stock']);
        $stock_de_esta_compra = $cantidad[$i];
        $stock_total = $stock_de_esta_compra + $stock_corriente;
        $update_stock = mysqli_query($conexion, "UPDATE producto set en_stock = '$stock_total' where idproducto = '$id_producto[$i]'");
        $flag_update_stock = 1;
      }
    }
  }

  if($flag_control == 1 or !$insert_entrada or $flag_update_stock == 1)
  {
    //todo bien
    $resultEntrada = 1;
  }
  else
  {
    //hubo un error, no se donde, intentalo de nuevo we
    $resultEntrada = 0;
  }

  $resultEntrada = mysqli_error($conexion);
  echo json_encode($resultEntrada,JSON_UNESCAPED_UNICODE);
  exit;
}

#funcion para mover producto de almacen
if ($_POST['action'] == 'transferir_producto_almacen') 
{  
  include "accion/conexion.php";
  if (!empty($_POST['idproducto_trans'])) 
  {
    $idproducto = $_POST['idproducto_trans'];
    $serie_producto = $_POST['serie_trans'];
    $nuevo_almacen_trans = $_POST['nuevo_almacen_trans'];

      $trans_almacen = mysqli_query($conexion, "UPDATE entrada_productos_serie SET almacen_actual = '$nuevo_almacen_trans' WHERE entrada_productos_serie.identrada_producto_serie = '$serie_producto'");
      if ($trans_almacen) 
      {
        $resultTransAlmacen = 1;
      } 
      else
      {
        $resultTransAlmacen = 0;
      }
  }
  else
  {
    $resultTransAlmacen = 0;
  }
  echo json_encode($resultTransAlmacen,JSON_UNESCAPED_UNICODE);
  exit;
}

//para editar salida
//para guardar la salida en la base de datos
if ($_POST['action'] == 'edit_salida_venta') 
{  
  include "accion/conexion.php";
  //ANTES DE INSERTAR NORMALMENTE, PRIMERO HAY QUE QUITAR DE STOCK Y PONER QUE TODAS LAS SERIES DE ESA SALIDA NO SE HAN VENDIDO, DESPUES YA ACTUALIZAMOS LA SALIDA, SALIDA PRODUCTOS Y SALIDA PRODUCTOS SERIE
  $id_salida = $_POST['flag_id_salida'];
  //primero quitar de stock
  $flag_control_stock = 0;
  $query = mysqli_query($conexion,"SELECT producto, cantidad from salida_productos where salida = '$id_salida'");
  while ($data = mysqli_fetch_assoc($query)) 
  {
    $idproducto = $data['producto'];
    $query_actual_stock = mysqli_query($conexion,"SELECT en_stock from producto where idproducto = '$idproducto'");
    $actual_stock = floatval(mysqli_fetch_assoc($query_actual_stock)['en_stock']);
    $new_stock = $actual_stock + floatval($data['cantidad']);
    $query_up_stock = mysqli_query($conexion,"UPDATE producto set en_stock = '$new_stock' where idproducto = '$idproducto'");
    if(!$query_up_stock)
    {
      $flag_control_stock = 1;
    }
  }
  //ahora quitamos el tag de que las series fueron vendidas
  

  //INSERTAMOS TODO
  $vendedor = $_POST['vendedor'];
  $id_cliente = $_POST['id_cliente'];
  $fecha = $_POST['fecha'];

  $id_documento = $_POST['tipo_documento'];
  $folio_venta = $_POST['folio_venta'];
  $folio_venta_serie = intval($_POST['folio_venta_serie']);

  //para actualizar la tabla de documentos
  $long_formato = 7;
  $next_serie = $folio_venta_serie + 1;
  $sizeno_serie = strlen(strval($next_serie));
  $ceros = "";
  for ($i=0; $i < $long_formato-$sizeno_serie; $i++) 
  { 
    $ceros = $ceros."0";
  }
  $next_str_folio_venta_serie = $ceros.strval($next_serie);


  $tipo_venta = $_POST['tipo_venta'];
  $modalidad_pago = $_POST['modalidad_pago'];
  $n_pagos = $_POST['n_pagos'];
  $pago_parcial = $_POST['pago_parcial'];
  $primer_dia_pago = $_POST['primer_dia_pago'];
  $dias_pago_semanal = (isset($_POST['dias_pago_semanal']) ? $_POST['dias_pago_semanal'] : NULL);
  $dias_pago_quincenal = (isset($_POST['dias_pago_quincenal']) ? $_POST['dias_pago_quincenal'] : NULL);
  $dias_pago_quincenal_2 = (isset($_POST['dias_pago_quincenal_2']) ? $_POST['dias_pago_quincenal_2'] : NULL);
  $dias_pago_mensual = (isset($_POST['dias_pago_mensual']) ? $_POST['dias_pago_mensual'] : NULL);

  $enganche_dado = $_POST['enganche_dado'];
  $subtotal1 = $_POST['subtotal1_flag'];
  $ivas = $_POST['ivas_flag'];
  $subtotal2 = $_POST['subtotal2_flag'];
  $descuento = (empty($_POST['descuento_venta']) ? 0 : $_POST['descuento_venta']);
  $total_venta = $_POST['total_flag'];

  //generamos id salida (la venta total)
  $resultIDSalida= mysqli_query($conexion, "SELECT UUID() as idsalida");
  $uuid_salida = mysqli_fetch_assoc($resultIDSalida)['idsalida'];
  //insertamos salida general 
  $insert_salida = mysqli_query($conexion, "INSERT INTO salida(idsalida, vendedor, cliente, fecha_salida, documento, folio_venta, folio_venta_serie, tipo_venta, modalidad_pago, no_pagos, pago_parcial, per_dia_pago, dias_pago_semanal, dias_pago_quincenal, dias_pago_quincenal_2, dias_pago_mensual, enganche, subtotal1, iva, subtotal2, descuento, total_general) VALUES ('$uuid_salida','$vendedor','$id_cliente','$fecha','$id_documento','$folio_venta','$folio_venta_serie','$tipo_venta','$modalidad_pago',".(!empty($n_pagos) ? "'$n_pagos'" : "NULL").",".(!empty($pago_parcial) ? "'$pago_parcial'" : "NULL").",".(!empty($primer_dia_pago) ? "'$primer_dia_pago'" : "NULL").",".(!empty($dias_pago_semanal) ? "'$dias_pago_semanal'" : "NULL").",".(!empty($dias_pago_quincenal) ? "'$dias_pago_quincenal'" : "NULL").", ".(!empty($dias_pago_quincenal_2) ? "'$dias_pago_quincenal_2'" : "NULL").",".(!empty($dias_pago_mensual) ? "'$dias_pago_mensual'" : "NULL").",'$enganche_dado','$subtotal1','$ivas','$subtotal2','$descuento','$total_venta')");


  //valor de cada producto a ingresar
  $id_producto = [];
  $cantidad = [];
  $tipo_precio = [];
  $precio = [];
  $flag_control = 1;
  $flag_update_stock = 0;
  for ($i=0; $i < 5; $i++) 
  { 
    if(!empty($_POST['identificador_pro_'.($i+1)]))
    {
      $id_producto[$i] = $_POST['identificador_pro_'.($i+1)];
      $cantidad[$i] = intval($_POST['cantidad_'.($i+1)]);
      $origen = $_POST['origen_'.($i+1)];
      $tipo_precio[$i] = $_POST['tipo_precio_'.($i+1)];
      $precio[$i] = doubleval($_POST['precio_'.($i+1)]);

      //calculamos el precio por unidad
      $precio_unidad = $precio[$i]/$cantidad[$i];

      //insertamos los productos en la tabla y lo asociamos a la salida
      //generamos el id de salida_producto(cada producto vendido
      $resultIDSalida_productos= mysqli_query($conexion, "SELECT UUID() as idsalida_productos");
      $uuid_salida_productos = mysqli_fetch_assoc($resultIDSalida_productos)['idsalida_productos'];
      $insert_salida_producto = mysqli_query($conexion, "INSERT INTO salida_productos(idsalida_producto, salida, producto, cantidad, tipo_precio, precio_x_unidad, precio_total) VALUES ('$uuid_salida_productos','$uuid_salida','$id_producto[$i]','$cantidad[$i]','$tipo_precio[$i]','$precio_unidad','$precio[$i]')");
      if(!$insert_salida_producto)
      {
        $flag_control = 0;
      }
      //ahora insertamos cada serie de los productos sacados
      if($cantidad[$i] == 1)
      {
        $resultIDSalida_origen= mysqli_query($conexion, "SELECT UUID() as idsalida_productos_origen");
        $uuid_salida_origen = mysqli_fetch_assoc($resultIDSalida_origen)['idsalida_productos_origen'];
        $insert_series = mysqli_query($conexion, "INSERT INTO salida_productos_origen(idsalida_producto_origen, salida_productos, salida, producto, serie_origen) VALUES ('$uuid_salida_origen','$uuid_salida_productos','$uuid_salida','$id_producto[$i]','$origen')");
        if($insert_series) 
        {
          //poner esa serie como vendida
          $update_serie = mysqli_query($conexion, "UPDATE entrada_productos_serie set vendido = 1 where identrada_producto_serie = '$origen'");
        }
        else
        {
          $flag_control = 0;
        }
      }
      else if($cantidad[$i] > 1)
      {
        //es mas de uno
        $origen_array = $_POST['origen_multi_'.($i+1)];
        $size_series = $cantidad[$i];
        for ($j=0; $j < $size_series; $j++) 
        { 
          //insertar cada serie
          $resultIDSalida_origen= mysqli_query($conexion, "SELECT UUID() as idsalida_productos_origen");
          $uuid_salida_origen = mysqli_fetch_assoc($resultIDSalida_origen)['idsalida_productos_origen'];
          $insert_series = mysqli_query($conexion, "INSERT INTO salida_productos_origen(idsalida_producto_origen, salida_productos, salida, producto, serie_origen) VALUES ('$uuid_salida_origen','$uuid_salida_productos','$uuid_salida','$id_producto[$i]','$origen_array[$j]')");
          if($insert_series)
          {
            //poner esa serie como vendida
            $update_serie = mysqli_query($conexion, "UPDATE entrada_productos_serie set vendido = 1 where identrada_producto_serie = '$origen_array[$j]'");
          } 
          else
          {
            $flag_control = 0;
          }
        }
      }
      if($flag_control or $insert_salida)
      {
        //QUITAR DEL STOCK, reducir la cantidad que haya disponible, si da negativo, ni modos, que no deberia
        //ponerlos en la tabla de series, para saber cuanto salieron, y de ahi mostrarlo
        $select_stock = mysqli_query($conexion, "SELECT en_stock from producto where idproducto = '$id_producto[$i]'");
        $stock_corriente = intval(mysqli_fetch_assoc($select_stock)['en_stock']);
        $stock_de_esta_venta = $cantidad[$i];
        $stock_total = $stock_corriente - $stock_de_esta_venta;
        $update_stock = mysqli_query($conexion, "UPDATE producto set en_stock = '$stock_total' where idproducto = '$id_producto[$i]'");
        $flag_update_stock = 1;
      }
    }
  }

  if($flag_control == 1 or !$insert_salida or $flag_update_stock == 1)
  {
    //todo bien
    $resultSalida = 1;
  }
  else
  {
    //hubo un error, no se donde, intentalo de nuevo we
    $resultSalida = 0;
  }

  //$resultSalida = mysqli_error($conexion);
  echo json_encode($resultSalida,JSON_UNESCAPED_UNICODE);
  exit;
}


