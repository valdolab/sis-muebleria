<?php
ob_start(); 
include_once "header.php";
include "accion/conexion.php";
$id_usuario = $_GET['id'];
$sqlpermisos = mysqli_query($conexion, "SELECT * FROM permiso");



$usuarios = mysqli_query($conexion, "SELECT * FROM usuario WHERE idusuario = '$id_usuario'");
$sqlpermisos_usuario = mysqli_query($conexion, "SELECT permiso_idpermiso,permiso_idusuario FROM permiso_usuario where permiso_idusuario = '$id_usuario'");
$resultUsuario = mysqli_num_rows($usuarios);
if (empty($resultUsuario)) {
    header("Location: usuarios.php");
}
$datos = array();
foreach ($sqlpermisos_usuario as $asignado) {
    $datos[$asignado['permiso_idpermiso']] = true;
}

#print_r($datos);
if (isset($_POST['permisos'])) {
    $id_usuario = $_GET['id'];
    $permisos = $_POST['permisos'];
    mysqli_query($conexion, "DELETE FROM permiso_usuario WHERE permiso_idusuario = '$id_usuario'");
    if ($permisos != "") 
    {
        $insert_correctly = 1;
        foreach ($permisos as $permiso) 
        {
            $sql = mysqli_query($conexion, "INSERT INTO permiso_usuario(permiso_idpermiso,permiso_idusuario) VALUES ($permiso,'$id_usuario')");
            if (!$sql) 
            {
                $insert_correctly = 0;
            }
        }
        if($insert_correctly)
        {
            header("Location: permisos.php?id=".$id_usuario."&m=ac5585d98646d255299c");
        }
        else
        {
            $alert = '<div class="alert alert-primary" role="alert">
                            Error al actualizar todos los permisos, actualize e intente de nuevo
                        </div>';
        }
    }
}
?>

                    <div class="row">
                    <div class="col-md-11 mx-auto">
                    <div class="card">
                        <div class="card-header bg-secundary text-black">
                        Asigna los permisos requeridos al usuario
                        </div>

                    <div class="card-body">
                    <form method="post" action="">
                        <?php if(isset($_GET['m']) && $_GET['m'] == 'ac5585d98646d255299c') 
                        { ?>
                            <div class="alert alert-success" role="alert">
                                Permisos actualizado
                            </div>
                        <?php } ?>

                        <div class="row">
                        <?php 
                        $con = 0;
                        function esMayuscula($cadena)
                        {
                            return $cadena === strtoupper($cadena);
                        }
                        $col = 0;
                        while ($row = mysqli_fetch_assoc($sqlpermisos)) 
                        { 
                            if (esMayuscula($row['permiso'])) 
                            {
                                $subpermiso = 0;
                                $col = $col + 1;
                                $checked_master = 0;
                                if ($con!=0)
                                {
                                    echo "</div></ul></div>";
                                }
                                ?>
                                <div class='col-lg-2'>
                                <ul class='list-group'>
                                <li class="list-group-item list-group-item-secondary" style="text-align: center;">
                                    <label for="permiso<?php echo $row['idpermiso']; ?>" class="p-2">
                                    <?php echo $row['permiso']; ?>
                                    </label>
                                    <br>
                                  <input onchange="bloquear_subpermisos()" id="permisoMaster<?php echo $col;?>" name="permisos[]" value="<?php echo $row['idpermiso'];?>" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="secondary" data-size="sm" data-on="SI" data-off="NO" <?php 
                                        if (isset($datos[$row['idpermiso']])) {
                                            $checked_master = 1;
                                     echo "checked";
                                     }
                                    ?>>
                              </li>

                            <?php 
                            }
                            else 
                            {
                                if ($subpermiso == 0)
                                {
                                    if($checked_master == 0)
                                    {
                                        $blockper = "hidden";
                                    }
                                    else
                                    {
                                        $blockper = "";
                                    }

                                    echo '<div id="subpermisos'.$col.'" '.$blockper.'>';
                                }
                                ?>
                                    <li class="list-group-item" style="text-align: center;">
                                    <label for="permiso<?php echo $row['idpermiso']; ?>" class="p-2">
                                    <?php echo $row['permiso']; ?>
                                    </label>
                                    <br>
                                  <input id="subpermiso<?php echo $row['idpermiso'];?>" name="permisos[]" value="<?php echo $row['idpermiso'];?>" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="secondary" data-size="sm" data-on="SI" data-off="NO" <?php 
                                        if (isset($datos[$row['idpermiso']])) {
                                     echo "checked";
                                     }
                                    ?>>
                                    </li>
                                <?php 
                                $subpermiso = 1;
                            }
                            $con = $con + 1;
                        }
                    ?>  
                        </div>
                        </div>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-lg-3">
                                <a href="usuarios.php" class="btn btn-outline-primary btn-block" type="button">Regresar</a>
                            </div>
                            <div class="col-lg-6"></div>
                            <div class="col-lg-3" align="right">
                                <button class="btn btn-primary btn-block" type="submit">Modificar</button>
                            </div>
                        </div>
                    </form>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>

<script type="text/javascript">
function bloquear_subpermisos()
{
  if (!document.getElementById('permisoMaster1').checked)
  {
    $("#subpermisos1").attr("hidden","hidden");
  }
  else
  {
    $("#subpermisos1").removeAttr("hidden");
  }

  if (!document.getElementById('permisoMaster2').checked)
  {
    $("#subpermisos2").attr("hidden","hidden");
  }
  else
  {
    $("#subpermisos2").removeAttr("hidden");
  }

  if (!document.getElementById('permisoMaster3').checked)
  {
    $("#subpermisos3").attr("hidden","hidden");
  }
  else
  {
    $("#subpermisos3").removeAttr("hidden");
  }

  if (!document.getElementById('permisoMaster4').checked)
  {
    $("#subpermisos4").attr("hidden","hidden");
  }
  else
  {
    $("#subpermisos4").removeAttr("hidden");
  }

  if (!document.getElementById('permisoMaster5').checked)
  {
    $("#subpermisos5").attr("hidden","hidden");
  }
  else
  {
    $("#subpermisos5").removeAttr("hidden");
  }
}
</script>

<?php 
ob_end_flush();
include_once "footer.php"; ?>