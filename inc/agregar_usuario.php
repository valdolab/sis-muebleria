<?php
ob_start();
include_once "header.php";
include "accion/conexion.php";

$id_user = $_SESSION['iduser'];
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
        if($ban == 'newusuario')
        {
          $nombre = $_POST['nombre'];
          $pass = md5($_POST['pass']);
          $rol = $_POST['rol'];
          $puesto = $_POST['puesto'];
          $sucursal = $_POST['sucursal'];

          $usuario_acceso = $_POST['usuario'];
          $resultIDtipo = mysqli_query($conexion, "SELECT UUID() as idtipo");
          $idusuario = mysqli_fetch_assoc($resultIDtipo)['idtipo'];

          $query = mysqli_query($conexion, "SELECT idusuario FROM usuario where usuario_acceso = '$usuario_acceso'");
          $result = mysqli_fetch_array($query);
          if ($result > 0) {
              $alert = '<div class="alert alert-warning" role="alert">
                          El usuario ya existe
                      </div>';
          }
          else
          {
            #print_r($sucursal);
            #echo $sucursal[0];
            if($rol == "SuperAdmin")
            {
                $superadmin = 1;
            }
            else
            {
                $superadmin = 0;
            }

              if (sizeof($sucursal) != 1) #es para insertar con varias sucursales, multisucursal
              {
                    $query_insert = mysqli_query($conexion, "INSERT INTO usuario(idusuario,usuario_acceso,nombre,pass,rol,puesto,estado,superadmin) values ('$idusuario', '$usuario_acceso', '$nombre', '$pass', '$rol', '$puesto', 1, $superadmin)");
                    if (!$query_insert)
                    { 
                              $alert = '<div class="alert alert-danger" role="alert">
                                      Hubo un Error al registrar
                                  </div>';
                    }

                    $con = 0;
                    foreach($sucursal as $value)
                    {
                        #echo "value : ".$value.'<br/>';
                        $query_insert3 = mysqli_query($conexion, "INSERT INTO sucursal_usuario(sucursal_idusuario,sucursal_idsucursales) values ('$idusuario', $value)");
                        if ($query_insert3) 
                        {
                          $con = $con + 1;
                        }
                    }
                    if ($con == sizeof($sucursal)) 
                    {
                          $modal = "$('#mensaje_success').modal('show');"; 
                          #$alert = '<div class="alert alert-success" role="alert">Usuario registrado correctamente</div>'; #?estado=e0fc59eb3bbaab9dbd70738144fd4d0d
                          #header("Location: usuarios.php");
                    } 
                    else
                    { 
                          $alert = '<div class="alert alert-danger" role="alert">
                                  Error al registrar
                              </div>';

                              #borrar lo que se pudo haber agregado antes del usuario
                            $query_delete = mysqli_query($conexion, "DELETE FROM usuario WHERE idusuario = '$idusuario'");
                            $query_delete2 = mysqli_query($conexion, "DELETE FROM sucursal_usuario WHERE sucursal_idusuario = '$idusuario'");
                    }  
              }
              else if(sizeof($sucursal) == 1)
              {
                $sucursal_val = $sucursal[0];
                $query_insert = mysqli_query($conexion, "INSERT INTO usuario(idusuario,usuario_acceso,nombre,pass,rol,puesto,estado,superadmin) values ('$idusuario','$usuario_acceso', '$nombre', '$pass', '$rol' , '$puesto', 1, $superadmin)");
                    if (!$query_insert)
                    {
                        #$modal = "$('#mensaje_error').modal('show');"; 
                        $alert = '<div class="alert alert-danger" role="alert">
                                      Hubo un Error al registrar
                                  </div>';
                    }
                
                $query_insert2 = mysqli_query($conexion, "INSERT INTO sucursal_usuario(sucursal_idusuario,sucursal_idsucursales) values ('$idusuario', $sucursal_val)");
                  if ($query_insert2)
                  {
                      $modal = "$('#mensaje_success').modal('show');";                      
                  }
                  else
                  {
                      $modal = "$('#mensaje_error').modal('show');"; 
                  }
              }    
            }
        }
    }
}
?>

<div style="posicion: fixed; top: 15%;" id="mensaje_error" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    
                    <div align="center" >
                        <br>
                        <!-- <img src="../img/ok.gif" width="100px" height="100px"> -->
                        <div class="swal2-header">
                            <div class="swal2-icon swal2-error swal2-icon-show" style="display: flex;">
                                <span class="swal2-x-mark">
                                    <span class="swal2-x-mark-line-left"></span>
                                    <span class="swal2-x-mark-line-right"></span>
                                </span>
                            </div>    
                            <h2 id="swal2-title" class="swal2-title" style="display: flex;">Oops... Ocurrio un problema!</h2>
                        </div>

                        <div class="swal2-content">
                            <div id="swal2-content" class="swal2-html-container" style="display: block;">
                                El usuario no pudo registrarse, intente nuevamente más tarde.
                            </div>
                        </div>
                        <div class="swal2-actions">
                            <a href="sucursales.php" class="swal2-confirm swal2-styled" type="button" style="display: inline-block;">Ok</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

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
                            <h2 id="swal2-title" class="swal2-title" style="display: flex;">¡Listo!</h2>
                        </div>

                        <div class="swal2-content">
                            <div id="swal2-content" class="swal2-html-container" style="display: block;">
                                Usuario guardado correctamete
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
            <div class="modal-header bg text-black">
                <h5 class="modal-title" id="my-modal-title">Nuevo Puesto</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="off" id="formAdd_puesto">
                    <div class="form-group">
                        <label for="correo">Nuevo puesto</label>
                        <input type="text" class="form-control" placeholder="Ingrese Nombre completo" name="newpuesto" id="newpuesto" required maxlength="99">
                    </div>

                    <div class="form-group">
                         <textarea class="form-control" name="desc_puesto" title="Ingrese descripción del puesto" id="desc_puesto" placeholder="Indicar una breve descripción sobre el puesto (Opcional)" maxlength="1000"></textarea>
                    </div>

                    <input value="insert_puesto" name="action" id="action" hidden>
                    <div align="right">
                        <input type="submit" value="Agregar" class="btn btn-primary" id="btn_addpuesto">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="editar_puesto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg text-black">
                <h5 class="modal-title" id="my-modal-title">Editar Puesto</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="off" id="formEdit_puesto">
                    <div class="form-group">
                        <label for="correo">Puesto</label>
                        <input type="text" class="form-control" placeholder="Ingrese Nombre completo" name="newpuesto_edit" id="newpuesto_edit" required maxlength="99">
                        <input type="" name="idpuesto_flag" id="idpuesto_flag" hidden>
                    </div>

                    <div class="form-group">
                         <textarea class="form-control" name="desc_puesto_edit" title="Ingrese descripción del puesto" id="desc_puesto_edit" placeholder="Indicar una breve descripción sobre el puesto (Opcional)" maxlength="10000"></textarea>
                    </div>

                    <input value="update_puesto" name="action" id="action" hidden>
                    <div align="right">
                        <input type="submit" value="Actualizar" class="btn btn-primary" id="btn_editpuesto">
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
                <h5><strong>AGREGAR USUARIO</strong></h5>
            </div>
            <div class="card-body">
                <form action="" method="post" autocomplete="off">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="row">
                        <div class="form-group col-lg-5">
                            <label for="correo">Nombre completo</label>
                            <input type="text" class="form-control" placeholder="Ingrese Nombre completo" name="nombre" id="nombre" required>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="nombre">Usuario</label>
                            <input type="text" class="form-control" placeholder="Ingrese Usuario" name="usuario" id="usuario" required>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="usuario">Contraseña</label>
                            <input type="password" class="form-control" placeholder="Ingrese Contraseña" name="pass" id="pass" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3">
                          <label>Rol</label>
                          <select class="form-control" id="rol" name="rol" required>
                            <option hidden value='' selected>Seleccione una opción</option>
                            <?php 
                            $iduser = $_SESSION['iduser'];
                            $query = mysqli_query($conexion, "SELECT rol FROM usuario where idusuario='$iduser'");
                            $rol = mysqli_fetch_assoc($query)['rol'];
                            if ($rol=="SuperAdmin")
                            {
                                echo "<option value='SuperAdmin'>SuperAdmin</option>";
                                echo "<option value='Administrador'>Administrador</option>";
                                echo "<option value='Usuario'>Usuario</option>";
                            }
                            else
                            {
                                echo "<option value='Administrador'>Administrador</option>";
                                echo "<option value='Usuario'>Usuario</option>";
                            }
                             ?>                
                          </select>
                        </div>

                        <div class="form-group col-lg-4">
                          <label>Puesto</label>
                          <?php 
                                if($_SESSION['rol'] == "SuperAdmin" or $_SESSION['rol'] == "Administrador")
                                {
                                    ?>
                                    <button data-toggle="modal" data-target="#nuevo_puesto" title="Agregar nuevo puesto" class="btn btn-primary btn-xs" type="button" href="#" ><i class="fas fa-plus"></i></button>
                                    <button disabled data-toggle="modal" data-target="#editar_puesto" onclick="editar_puesto();" title="editar puesto" class="btn btn-success btn-xs" type="button" href="#" id="btn_editarpuesto"><i class="fas fa-edit"></i></button>
                                    <button disabled onclick="eliminar_puesto();" title="Eliminar puesto" class="btn btn-danger btn-xs" type="button" href="#" id="btn_eliminarpuesto"><i class="fas fa-trash"></i></button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <button disabled="disabled" title="Agregar nuevo puesto" class="btn btn-primary btn-xs" type="button"><i class="fas fa-plus"></i></button>
                                    <button disabled="disabled" title="editar puesto" class="btn btn-success btn-xs" type="button"><i class="fas fa-edit"></i></button>
                                    <button disabled="disabled" title="Eliminar puesto" class="btn btn-danger btn-xs" type="button"><i class="fas fa-trash"></i></button>
                                    <?php 
                                } 
                             ?>

                          <select class="form-control" id="puesto" name="puesto" required>
                            <option hidden value="" selected>Seleccione una opción</option>
                            <?php
                            #codigo para la lista de sucursales que se extraen de la base de datos
                            $result = mysqli_query($conexion,"SELECT idpuesto,puesto FROM puesto");                        
                            if (mysqli_num_rows($result) > 0) {  
                              while($row = mysqli_fetch_assoc($result)){
                              echo "<option value='".$row["idpuesto"]."'>".$row["puesto"]."</option>";
                              }
                            }
                            ?>     
                          </select>
                        </div>
                    
                    
                        <div class="form-group col-lg-4">
                          <label>Sucursal</label>
                          <a onclick="cargar_todas_sucursales();" href="#">Agregar todas</a>
                            <div class="input-group mb-3">
                              <select class="form-control js-example-basic-multiple" id="sucursal" name="sucursal[]" multiple="multiple" required>
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
                        </div>
                    </div>
                    
                    <br>

                    <div class="row">
                        <div align="right" class="col-lg-10">
                            <a type="submit" class="btn btn-secondary" href="usuarios.php">Regresar</a>
                        </div>
                        <div align="right" class="col-lg-2">
                            <input name="bandera" id="bandera" value="newusuario" hidden>
                            <input type="submit" value="Registrar" class="btn btn-primary">
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

<script type="">
  document.getElementById('divzoom').style.zoom = "100%";
</script>

<?php ob_end_flush(); ?>
<?php include_once "footer.php"; ?>