<?php
ob_start();
include_once "header.php";
include "accion/conexion.php";

$modal = "";
// Mostrar Datos
$idusuario = $_SESSION['iduser'];
$sql = mysqli_query($conexion, "SELECT * FROM usuario WHERE idusuario = '$idusuario'");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: index.php");
}
else 
{
    $data = mysqli_fetch_array($sql);
    $up_nombre = $data['nombre'];
    $up_idusuario = $data['idusuario'];
    $up_rol = $data['rol'];
    $up_idpuesto = $data['puesto'];
    $sqlpuesto = mysqli_query($conexion, "SELECT puesto FROM puesto WHERE idpuesto = $up_idpuesto");
    $up_name_puesto = mysqli_fetch_assoc($sqlpuesto)['puesto'];

    $sql2 = mysqli_query($conexion, "SELECT sucursal_idsucursales FROM sucursal_usuario WHERE sucursal_idusuario = '$idusuario'");
    #$up_sucursal_array = mysqli_fetch_assoc($sql2);
    while($row = mysqli_fetch_assoc($sql2))
    {
      $up_sucursal_array[] = $row["sucursal_idsucursales"];
      #echo $row["sucursal_idsucursales"];
    }
    $result = mysqli_query($conexion,"SELECT idsucursales,sucursales FROM sucursales");                        
                            if (mysqli_num_rows($result) > 0) 
                            {  
                              while($row = mysqli_fetch_assoc($result))
                              {
                                if (in_array($row['idsucursales'],$up_sucursal_array))
                                {
                                  $up_name_sucursales[] = $row['sucursales'];
                                }
                              }
                            }
}

if (!empty($_POST)) 
{   
    //por ultimo, actualizar la passs, lo de aqui abajo
    if(!empty($_POST['actual_pass']) and !empty($_POST['newpass']) and !empty($_POST['confirmpass']))
    {
        $actual_pass = md5($_POST['actual_pass']);
        //verificar si la contraseña actual es la correcta
        $select_pass = mysqli_query($conexion,"SELECT pass from usuario where idusuario='$idusuario'");
        $Trueactual_pass = mysqli_fetch_assoc($select_pass)['pass'];
        if($Trueactual_pass == $actual_pass)
        {
            //si es la pass actual, entonces procedemos con comparar las nuevas
            //luego comparar que las dos nuevas pass conicidan
            $new_pass= md5($_POST['newpass']);
            $confirm_pass = md5($_POST['confirmpass']);
            if($new_pass == $confirm_pass)
            {
                //si son iguales, actualizamos la nueva pass
                $query_actualizar_user = mysqli_query($conexion,"UPDATE usuario SET pass='$new_pass' where idusuario = '$idusuario'");
                    if ($query_actualizar_user)
                    {
                       $modal = "$('#mensaje_success').modal('show');";      
                    }
                    else
                    {
                        $alert = '<div class="alert alert-danger" role="alert">
                                      ¡Hubo un error al actualizar tus datos, intenta de nuevo!
                                  </div>';
                    }
            }
            else
            {
                //no coiciden, avisar
                $alert = '<div class="alert alert-warning" role="alert">
                                      ¡Contraseñas no coiciden!. Verifica que la nueva contraseña sea la misma que la contraseña de confirmación. 
                                  </div>';
            }
        }
        else
        {
            //avisar que no es la pass actual
            $alert = '<div class="alert alert-warning" role="alert">
                                      ¡Contraseña actual incorrecta!
                                  </div>';
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
                            <h2 id="swal2-title" class="swal2-title" style="display: flex;">¡Actualizado!</h2>
                        </div>

                        <div class="swal2-content">
                            <div id="swal2-content" class="swal2-html-container" style="display: block;">
                                Contraseña guardada correctamente
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
    <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Información Personal</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nombre: <strong><?php echo $up_nombre; ?></strong></label>
                            </div>
                            <div class="form-group">
                                <label>Usuario: <strong><?php echo $up_idusuario; ?></strong></label>
                            </div>
                            <div class="form-group">
                                <label>Rol: <strong><?php echo $up_rol; ?></strong></label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Puesto: <strong><?php echo $up_name_puesto; ?></strong></label>
                            </div>
                            <div class="form-group">
                                <label>Sucursales asignadas: </label>
                                <ul>
                                    <?php 
                                        foreach ($up_name_sucursales as $value) 
                                        {
                                            echo "<li>".$value."</li>";     
                                        }
                                     ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Cambio de Contraseña</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Contraseña Actual</label>
                                <div class="input-group">
                                    <input type="password" name="actual_pass" id="actual_pass" required class="form-control border-right-0">
                                    <span onclick="mostrar_pass();" class="input-group-append bg-white border-left-0">
                                        <span class="input-group-text bg-transparent">
                                            <i id="apass" class="fa fa-eye-slash"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nueva Contraseña</label>
                                <div class="input-group">
                                    <input type="password" name="newpass" id="newpass" required class="form-control border-right-0">
                                    <span onclick="mostrar_pass2();" class="input-group-append bg-white border-left-0">
                                        <span class="input-group-text bg-transparent">
                                            <i id="npass" class="fa fa-eye-slash"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Confirmar Contraseña</label>
                                <div class="input-group">
                                    <input type="password" name="confirmpass" id="confirmpass" required class="form-control border-right-0">
                                    <span onclick="mostrar_pass3();" class="input-group-append bg-white border-left-0">
                                        <span class="input-group-text bg-transparent">
                                            <i id="cpass" class="fa fa-eye-slash"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <?php echo isset($alert) ? $alert : ''; ?>
                            <div>
                                <button type="submit" class="btn btn-primary btn-m">Cambiar Contraseña</button>
                            </div>
                        </form>
                    </ul>
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

function mostrar_pass()
{
        var cambio = document.getElementById("actual_pass");
        if(cambio.type == "password")
        {
            cambio.type = "text";
            $('#apass').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        }
        else
        {
            cambio.type = "password";
            $('#apass').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
} 
function mostrar_pass2()
{
        var cambio = document.getElementById("newpass");
        if(cambio.type == "password")
        {
            cambio.type = "text";
            $('#npass').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        }
        else
        {
            cambio.type = "password";
            $('#npass').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
} 
function mostrar_pass3()
{
        var cambio = document.getElementById("confirmpass");
        if(cambio.type == "password")
        {
            cambio.type = "text";
            $('#cpass').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        }
        else
        {
            cambio.type = "password";
            $('#cpass').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
} 

</script>

<?php ob_end_flush(); ?>
<?php include_once "footer.php"; ?>