<?php
ob_start();
include_once "header.php";
include "accion/conexion.php";

$modal = "";
// Mostrar Datos
$idusuario = $_GET['id'];
if (empty($idusuario)) 
{
  header("Location: usuarios.php");
}
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
      $new_nombre = $_POST['nombre'];
       $query_actualizar_user = mysqli_query($conexion,"UPDATE usuario SET nombre='$new_nombre' where idusuario = '$idusuario'");
                    if ($query_actualizar_user)
                    {
                         $actualizo_user = TRUE;
                    }
                    else
                    {
                        $actualizo_user = FALSE;
                    }

    $actualizo_pass = 0;
    if(!empty($_POST['pass']))
    {
      $new_pass = md5($_POST['pass']);
       $query_actualizar_user = mysqli_query($conexion,"UPDATE usuario SET pass='$new_pass' where idusuario = '$idusuario'");
                    if ($query_actualizar_user)
                    {
                       $actualizo_pass = 1;       
                    }
                    else
                    {
                        $actualizo_pass = -1;
                    }
    }
    if($actualizo_user and $actualizo_pass >= 0)
    {
      $modal = "$('#mensaje_success').modal('show');";
    }
    else
    {
      $alert = '<div class="alert alert-danger" role="alert">
                                      Hubo un error al actualizar tus datos, intenta de nuevo!
                                  </div>';
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
                            <a href="index.php" class="swal2-confirm swal2-styled" type="button" style="display: inline-block;">Ok</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<br>
<!-- Begin Page Content -->
<div class="container-fluid">
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header bg text-dark">
                <h5><strong>PERFIL DEL USUARIO</strong></h5>
            </div>
            <div class="card-body">
                <form action="#" method="POST" autocomplete="off">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="row">
                      <div class="form-group col-lg-3">
                            <label for="nombre">Usuario</label>
                            <input required disabled value="<?php echo $up_idusuario; ?>" type="text" class="form-control" placeholder="Ingrese Usuario" name="usuario" id="usuario">
                        </div>

                        <div class="form-group col-lg-5">
                            <label for="correo">Nombre completo</label>
                            <input value="<?php echo $up_nombre; ?>" type="text" class="form-control" placeholder="Ingrese Nombre completo" name="nombre" id="nombre">
                        </div>

                        <div class="form-group col-lg-4">
                            <label for="con">Contraseña</label>
                            <input type="text" class="form-control" placeholder="Ingrese Contraseña" name="pass" id="pass">
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
                        </div>
                    
                        <div class="form-group col-lg-5">
                          <label>Sucursal</label>
                          &nbsp;
                          <div class="input-group mb-4">
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
                    </div>
                </div>
                    </div>

                    <br>

                    <div class="row">
                        <div align="right" class="col-lg-10">
                        </div>
                        <div align="right" class="col-lg-2">
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

document.getElementById('divzoom').style.zoom = "100%";

</script>

<?php ob_end_flush(); ?>
<?php include_once "footer.php"; ?>