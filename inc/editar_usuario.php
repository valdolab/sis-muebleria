<?php
ob_start();
include_once "header.php";
include "accion/conexion.php";

$modal = "";
// Mostrar Datos
if (empty($_GET['id'])) {
  header("Location: usuarios.php");
}
$idusuario = $_GET['id'];
$sql = mysqli_query($conexion, "SELECT * FROM usuario WHERE idusuario = '$idusuario'");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: usuarios.php");
}
else 
{
    $data = mysqli_fetch_array($sql);
    $up_nombre = $data['nombre'];
    $up_idusuario = $data['idusuario'];
    $up_rol = $data['rol'];
    $up_puesto = $data['puesto'];

    $sql2 = mysqli_query($conexion, "SELECT sucursal_idsucursales FROM sucursal_usuario WHERE sucursal_idusuario = '$idusuario'");
    #$up_sucursal_array = mysqli_fetch_assoc($sql2);
    while($row = mysqli_fetch_assoc($sql2))
    {
      $up_sucursal_array[] = $row["sucursal_idsucursales"];
      #echo $row["sucursal_idsucursales"];
    }
    #print_r($up_sucursal_array);
    #$existe = in_array(2, $up_sucursal_array);
    #echo $existe;
    #$sucursal = $data['sucursal'];
}

if (!empty($_POST)) 
{
    $alert = "";
    if (empty($_POST['bandera'])) {
        $alert = '<div class="alert alert-danger" role="alert">
        Hubo un error inesperado, intente de nuevo
        </div>';
    } 
    else 
    {
        $ban = $_POST['bandera'];
        if ($ban == 'puesto')
        {
          $nompuesto = $_POST['newpuesto'];
          $desc_puesto = $_POST['desc_puesto'];
          $insert_puesto = mysqli_query($conexion, "INSERT INTO puesto(puesto,descripcion) values ('$nompuesto','$desc_puesto')");
              if ($insert_puesto) {
                  $alert = '<div class="alert alert-primary" role="alert">
                              Puesto registrado
                          </div>';
                  header("Location: editar_usuario.php");
              } 
              else
              {
                  $alert = '<div class="alert alert-danger" role="alert">
                          Error al actualizar
                      </div>';
              }
        }
        else if($ban == 'sucursal')
        {
          $nomsucursal = $_POST['newsucursal'];
          $desc_sucursal = $_POST['desc_sucursal'];
          $insert_sucursal= mysqli_query($conexion, "INSERT INTO sucursales(sucursales,descripcion) values ('$nomsucursal','$desc_sucursal')");
              if ($insert_sucursal) {
                  $alert = '<div class="alert alert-primary" role="alert">
                              Sucursal registrado
                          </div>';
                          header("Location: editar_usuario.php");
              }
              else
              {
                  $alert = '<div class="alert alert-danger" role="alert">
                          Error al registrar
                      </div>';
              }
        }
        else if($ban == 'editusuario')
        {
          #poner checkboxs para ver de cuales quieres cambiar 
          #ver cuales checkboxs estan seleccionados
          #ACTUALIZA IDUSUARIO
          if (isset($_POST['actualizar_idusuario']))
          {
            #si esta palomeado el checkbox hace esto, o sea significa que quiere actualizar ese campo
            $id_user = $_POST['usuario'];
            
            $query = mysqli_query($conexion, "SELECT * FROM usuario where idusuario = '$idusuario'");
            $a = mysqli_fetch_array($query);
            if (mysqli_fetch_array($query) > 0) 
            {
                $alert = '<div class="alert alert-warning" role="alert">
                            El usuario ya existe, introduce otro diferente
                        </div>';
            }
            else
            {
              $query_insert2 = mysqli_query($conexion, "UPDATE usuario SET idusuario='$id_user' where idusuario = '$idusuario'");

              $sql_select = mysqli_query($conexion,"SELECT sucursal_idsucursales FROM sucursal_usuario where sucursal_idusuario = '$idusuario'"); 
              $check_sucursales = mysqli_fetch_assoc($sql_select);
              #insertamos las sucursales al nuevo idusario
              $con = 0;
                    #echo "value : ".$value.'<br/>';
                    if (!$query_insert2) 
                    {
                        $flag_act_correcto = 1;
                    }

                    foreach($check_sucursales as $value)
                    {
                        $sql_insert2 = mysqli_query($conexion, "INSERT INTO sucursal_usuario(sucursal_idusuario,sucursal_idsucursales) values ('$id_user', $value)");
                        if ($sql_insert2) 
                        {
                          $con = $con + 1;
                        }
                    }
                    
                    if ($con != sizeof($check_sucursales)) 
                      {
                          $flag_act_correcto = 1;
                      } 

              #borramos las sucursales del viejo usuario
              $query_insert2_1 = mysqli_query($conexion, "DELETE FROM sucursal_usuario WHERE sucursal_idusuario = '$idusuario'");
              $idusuario = $id_user;
            }
          }#en el ELSE no hacer nada, no actulizar el campo

          #ACTUALIZA NOMBRE
          $flag_act_correcto = 0;
          if (isset($_POST['actualizar_nombre']))
          {
            #si esta palomeado el checkbox hace esto, o sea significa que quiere actualizar ese campo
            $nombre = $_POST['nombre'];
            $query_insert1 = mysqli_query($conexion, "UPDATE usuario SET nombre='$nombre' where idusuario='$idusuario'");
                    if (!$query_insert1) 
                    {
                      $flag_act_correcto = 1;
                    }
          }#en el ELSE no hacer nada, no actulizar el campo
          
          #ACTUALIZA CONTRASEÑA
          if (isset($_POST['actualizar_pass']))
          {
            #si esta palomeado el checkbox hace esto, o sea significa que quiere actualizar ese campo
            $pass = md5($_POST['pass']);
            $query_insert3 = mysqli_query($conexion, "UPDATE usuario SET pass='$pass' where idusuario='$idusuario'");
                    if (!$query_insert3) 
                    {
                              $flag_act_correcto = 1;
                    }
          }#en el ELSE no hacer nada, no actulizar el campo

          #ACTUALIZA ROL
          if (isset($_POST['actualizar_rol']))
          {
            #si esta palomeado el checkbox hace esto, o sea significa que quiere actualizar ese campo
            $rol = $_POST['rol'];
            if($rol == "SuperAdmin")
            {
                $superadmin = 1;
            }
            else
            {
                $superadmin = 0;
            }
            $query_insert4 = mysqli_query($conexion, "UPDATE usuario SET rol=$rol, superadmin=$superadmin where idusuario='$idusuario'");
                    if (!$query_insert4) 
                    {
                              $flag_act_correcto = 1;
                    }
          }#en el ELSE no hacer nada, no actulizar el campo

          #ACTUALIZA PUESTO
          if (isset($_POST['actualizar_puesto']))
          {
            #si esta palomeado el checkbox hace esto, o sea significa que quiere actualizar ese campo
            $puesto = $_POST['puesto'];
            $query_insert5 = mysqli_query($conexion, "UPDATE usuario SET puesto=$puesto where idusuario='$idusuario'");
                    if (!$query_insert5) 
                    {
                              $flag_act_correcto = 1;
                    }
          }#en el ELSE no hacer nada, no actulizar el campo

          #ACTUALIZA SUCURSAL O SUCURSALES
          if (isset($_POST['actualizar_sucursal']))
          {
            #si esta palomeado el checkbox hace esto, o sea significa que quiere actualizar ese campo
            $sucursal = $_POST['sucursal'];

            #===========
            if (sizeof($sucursal) != 1)
              {
                    $con = 0;
                    #sliminamos todo de ese usuario en la tabla para luego insertar los nuevos
                    $sql_delete = mysqli_query($conexion, "DELETE FROM sucursal_usuario WHERE sucursal_idusuario = '$idusuario'");
                    if (!$sql_delete) 
                    {
                        $flag_act_correcto = 1;
                    }
                    foreach($sucursal as $value)
                    {
                        $sql_insert = mysqli_query($conexion, "INSERT INTO sucursal_usuario(sucursal_idusuario,sucursal_idsucursales) values ('$idusuario', $value)");
                        if ($sql_insert) 
                        {
                          $con = $con + 1;
                        }
                    }
                    if ($con != sizeof($sucursal)) 
                      {
                          $flag_act_correcto = 1;
                      }  
              }
              else
              {
                
                $sql_delete2 = mysqli_query($conexion, "DELETE FROM sucursal_usuario WHERE sucursal_idusuario = '$idusuario'");
                        if (!$sql_delete2) 
                        {
                                  $flag_act_correcto = 1;
                        }
                $sucursal_val = $sucursal[0];
                $sql_insert2 = mysqli_query($conexion, "INSERT INTO sucursal_usuario(sucursal_idusuario,sucursal_idsucursales) values ('$idusuario', $sucursal_val)");
                  if (!$sql_insert2)
                  {
                      $flag_act_correcto = 1;
                  }
              } 
            #==========
          }#en el ELSE no hacer nada, no actulizar el campo
          
          if ($flag_act_correcto == 1)
          {
            #si es igual a 1 hubo algun error en cualquiera al actualizar
            $alert = '<div class="alert alert-danger" role="alert">
                                          Hubo un Error al actualizar!, Intente de nuevo.
                                      </div>';

          }
          else
          {
            #si no hubo ningun error, indicar que se hizo con exito
            #$alert = '<div class="alert alert-success" role="alert">Usuario actualizado correctamente! </div>';
            #header("Location: editar_usuario.php");
            $modal = "$('#mensaje_success').modal('show');";
          }
        }
    }
}
?>

<div style="posicion: fixed; top: 15%;" id="mensaje_success" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    
                    <div align="center" >
                        <br>
                        <!-- <img src="../img/ok.gif" width="100px" height="100px"> -->
                        <div class="swal2-header">
                            <div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
                                <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                <span class="swal2-success-line-tip"></span>
                                <span class="swal2-success-line-long"></span>
                                <div class="swal2-success-ring"></div>
                                <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                            </div>    
                            <h2 id="swal2-title" class="swal2-title" style="display: flex;">Actualizado!</h2>
                        </div>

                        <div class="swal2-content">
                            <div id="swal2-content" class="swal2-html-container" style="display: block;">
                                Usuario editado correctamete
                            </div>
                        </div>
                        <div class="swal2-actions">
                            <a href="usuarios.php" class="swal2-confirm swal2-styled" type="button" style="display: inline-block;">Ok</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div id="nuevo_puesto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Nuevo Puesto</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="off">
                    <div class="form-group">
                        <label for="correo">Nuevo puesto</label>
                        <input type="text" class="form-control" placeholder="Ingrese Nombre completo" name="newpuesto" id="newpuesto" required>
                    </div>

                    <div class="form-group">
                         <textarea class="form-control" name="desc_puesto" title="Ingrese descripción del puesto" id="desc_puesto" placeholder="Indicar una breve descripción sobre el puesto (Opcional)" maxlength="1000"></textarea>
                    </div>

                    <input value="puesto" name="bandera" id="bandera" hidden>

                    <div align="right">
                        <input type="submit" value="Agregar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="nueva_sucursal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Nueva Sucursal</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="off">
                    <div class="form-group">
                      <label for="sucursal">Sucursales existentes</label>
                      <select class="form-control" id="s" name="s" >
                        <?php
                        #codigo para la lista de sucursales que se extraen de la base de datos
                        $result = mysqli_query($conexion,"SELECT idsucursales,sucursales FROM sucursales");                        
                        if (mysqli_num_rows($result) > 0) {  
                          while($row = mysqli_fetch_assoc($result)){
                          echo "<option value='".$row["idsucursales"]."'>".$row["sucursales"]."</option>";
                          }
                        }
                        ?>                        
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="correo">Nueva Sucursal</label>
                        <input type="text" class="form-control" placeholder="Ingrese Nombre completo" name="newsucursal" id="newsucursal" required>
                    </div>
                    
                    <div class="form-group">
                         <textarea class="form-control" name="desc_sucursal" title="Ingrese descripción de la sucursal" id="desc_sucursal" placeholder="Indicar una breve descripción sobre la sucursal (Opcional)" maxlength="1000"></textarea>
                    </div>

                    <input value="sucursal" name="bandera" id="bandera" hidden>
                    <div align="right">
                        <input type="submit" value="Agregar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<br>
<!-- Begin Page Content -->
<div class="container-fluid">
<div class="row">
    <div class="col-md-9 mx-auto">
        <div class="card">
            <div class="card-header bg text-dark">
                <h5><strong>PERFIL DEL USUARIO</strong></h5>
            </div>
            <div class="card-body">
                <form action="#" method="POST" autocomplete="off">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="row">
                        <div class="form-group col-lg-5">
                            <label for="correo">Nombre completo</label>
                            <input required disabled value="<?php echo $up_nombre; ?>" type="text" class="form-control" placeholder="Ingrese Nombre completo" name="nombre" id="nombre">

                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input onchange="bloquear_campo()" name="actualizar_nombre" value="1" class="form-check-input" type="checkbox" id="flexCheckDefaultn">
                            <label style="color: #adadad;" class="form-check-label" for="flexCheckDefaultn">
                              Actualizar
                            </label>
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="nombre">Usuario</label>
                            <input required disabled value="<?php echo $up_idusuario; ?>" type="text" class="form-control" placeholder="Ingrese Usuario" name="usuario" id="usuario">

                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input onchange="bloquear_campo()" name="actualizar_idusuario" class="form-check-input" type="checkbox" value="actualizar_idusuario" id="flexCheckDefaultu">
                            <label style="color: #adadad;" class="form-check-label" for="flexCheckDefaultu">
                              Actualizar
                            </label>

                        </div>
                        <div class="form-group col-lg-3">
                            <label for="con">Contraseña</label>
                            <input required disabled type="text" class="form-control" placeholder="Ingrese Contraseña" name="pass" id="pass">

                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input onchange="bloquear_campo()" name="actualizar_pass" class="form-check-input" type="checkbox" value="actualizar_pass" id="flexCheckDefaultc">
                            <label style="color: #adadad;" class="form-check-label" for="flexCheckDefaultc">
                              Actualizar
                            </label>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3">
                          <label>Rol</label>
                          <select disabled class="form-control" id="rol" name="rol" required>
                            <?php 
                            $iduser = $_SESSION['iduser'];
                            $query = mysqli_query($conexion, "SELECT rol FROM usuario where idusuario='$iduser'");
                            $rol = mysqli_fetch_assoc($query)['rol'];
                            if ($rol=="SuperAdmin")
                            {
                                $NoesSuperAdmin = "";
                            }
                            else
                            {
                                $NoesSuperAdmin = "hidden";
                            }
                            if ($up_rol=="SuperAdmin")
                                {
                                    echo "<option selected value='SuperAdmin'>SuperAdmin</option>";
                                }
                                else if ($up_rol=="Administrador")
                                {
                                    echo "<option ".$NoesSuperAdmin." value='SuperAdmin'>SuperAdmin</option>";
                                    echo "<option selected value='Administrador'>Administrador</option>";
                                    echo "<option value='Usuario'>Usuario</option>";
                                }
                                else
                                {
                                    echo "<option ".$NoesSuperAdmin." value='SuperAdmin'>SuperAdmin</option>";
                                    echo "<option value='Administrador'>Administrador</option>";
                                    echo "<option selected value='Usuario'>Usuario</option>";
                                }
                            ?>                 
                          </select>

                          &nbsp;&nbsp;&nbsp;&nbsp;
                          <?php 
                            if ($up_rol == "SuperAdmin")
                            {
                           ?>
                            <input disabled onchange="bloquear_campo()" name="actualizar_rol" class="form-check-input" type="checkbox" value="actualizar_rol" id="flexCheckDefaultr">
                            <label disabled style="color: #adadad;" class="form-check-label" for="flexCheckDefaultr">
                              Actualizar
                            </label>
                          <?php 
                          }
                          else
                          {
                            ?>
                              <input onchange="bloquear_campo()" name="actualizar_rol" class="form-check-input" type="checkbox" value="actualizar_rol" id="flexCheckDefaultr">
                            <label style="color: #adadad;" class="form-check-label" for="flexCheckDefaultr">
                              Actualizar
                            </label>
                            <?php
                          }
                         ?>

                        </div>

                        <div class="form-group col-lg-4">
                          <label>Puesto</label>
                          <select disabled class="form-control" id="puesto" name="puesto" required>
                            <option value="" hidden selected>Seleccione una opción</option>
                            <?php
                            #codigo para la lista de sucursales que se extraen de la base de datos
                            $result = mysqli_query($conexion,"SELECT idpuesto,puesto FROM puesto");                        
                            if (mysqli_num_rows($result) > 0) {  
                              while($row = mysqli_fetch_assoc($result))
                              {
                                if ($row[idpuesto] == $up_puesto)
                                {
                                  echo "<option selected value='".$row[idpuesto]."'>".$row[puesto]."</option>";
                                }
                                else
                                {
                                  echo "<option value='".$row[idpuesto]."'>".$row[puesto]."</option>";
                                }
                              }
                            }
                            ?>   
                            <option value="newpuesto" >Agregar nuevo puesto...</option>    
                          </select>

                          &nbsp;&nbsp;&nbsp;&nbsp;
                          <input onchange="bloquear_campo()" name="actualizar_puesto" class="form-check-input" type="checkbox" value="actualizar_puesto" id="flexCheckDefaultp">
                            <label style="color: #adadad;" class="form-check-label" for="flexCheckDefaultp">
                              Actualizar
                            </label>

                        </div>
                    
                        <div class="form-group col-lg-4">
                          <label>Sucursal</label>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a id="agregar_todos">Agregar todas</a>
                          &nbsp;
                          <div class="input-group mb-3">
                          <select disabled class="form-control js-example-basic-multiple" id="sucursal" name="sucursal[]" multiple="multiple" required>
                            <?php
                            #codigo para la lista de sucursales que se extraen de la base de datos
                            $result = mysqli_query($conexion,"SELECT idsucursales,sucursales FROM sucursales");                        
                            if (mysqli_num_rows($result) > 0) 
                            {  
                              while($row = mysqli_fetch_assoc($result))
                              {
                                if (in_array($row[idsucursales],$up_sucursal_array))
                                {
                                  echo "<option selected value='".$row[idsucursales]."'>".$row[sucursales]."</option>";
                                }
                                else
                                {
                                  echo "<option value='".$row[idsucursales]."'>".$row[sucursales]."</option>";
                                }
                                
                              }
                            }
                            ?>                        
                          </select>
                          <div class="input-group-append">
                            <a data-toggle="modal" data-target="#nueva_sucursal" title="Agregar nueva sucursal" class="btn btn-primary btn-xs" type="button" href="#" ><i class="fas fa-plus"></i></a>
                        </div>
                    </div>


                          &nbsp;&nbsp;&nbsp;&nbsp;
                            <input onchange="bloquear_campo()" name="actualizar_sucursal" class="form-check-input" type="checkbox" value="actualizar_sucursal" id="flexCheckDefaults">
                            <label style="color: #adadad;" class="form-check-label" for="flexCheckDefaults">
                              Actualizar
                            </label>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div align="right" class="col-lg-10">
                            <a type="submit" class="btn btn-secondary" href="usuarios.php">Regresar</a>
                        </div>
                        <div align="right" class="col-lg-2">
                            <input name="bandera" id="bandera" value="editusuario" hidden>
                            <input type="submit" value="Actualizar" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->
</div>
<br><br><br><br>
<!-- End of Main Content -->



<script type="text/javascript">

function bloquear_campo()
{
  if (document.getElementById('flexCheckDefaultn').checked)
  {
    $('#nombre').removeAttr('disabled');
  }
  else
  {
    $('#nombre').attr('disabled','disabled');
  }

  if (document.getElementById('flexCheckDefaultu').checked)
  {
    $('#usuario').removeAttr('disabled');
  }
  else
  {
    $('#usuario').attr('disabled','disabled');
  }

  if (document.getElementById('flexCheckDefaultc').checked)
  {
    $('#pass').removeAttr('disabled');
  }
  else
  {
    $('#pass').attr('disabled','disabled');
  }

  if (document.getElementById('flexCheckDefaultr').checked)
  {
    $('#rol').removeAttr('disabled');
  }
  else
  {
    $('#rol').attr('disabled','disabled');
  }

  if (document.getElementById('flexCheckDefaultp').checked)
  {
    $('#puesto').removeAttr('disabled');
  }
  else
  {
    $('#puesto').attr('disabled','disabled');
  }

  if (document.getElementById('flexCheckDefaults').checked)
  {
    $('#sucursal').removeAttr('disabled');
    $('#agregar_todos').attr('href', "#");
    $('#agregar_todos').attr('onClick', 'cargar_todas_sucursales();');
  }
  else
  {
    $('#sucursal').attr('disabled','disabled');
    $('#agregar_todos').removeAttr('href');
    $('#agregar_todos').removeAttr('onClick');
  }
  
}

document.getElementById('divzoom').style.zoom = "100%";

</script>

<?php ob_end_flush(); ?>
<?php include_once "footer.php"; ?>