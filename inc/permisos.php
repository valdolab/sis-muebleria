<?php
ob_start(); 
include_once "header.php";
include "accion/conexion.php";
$id_usuario = $_GET['id'];
$sqlpermisos = mysqli_query($conexion, "SELECT * FROM permiso");



$usuarios = mysqli_query($conexion, "SELECT * FROM usuario WHERE idusuario = '$id_usuario'");
$sqlpermisos_usuario = mysqli_query($conexion, "SELECT idpermiso_usuario,permiso_idpermiso,permiso_idusuario FROM permiso_usuario where permiso_idusuario = '$id_usuario'");
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
        foreach ($permisos as $permiso) 
        {
            $sql = mysqli_query($conexion, "INSERT INTO permiso_usuario(permiso_idpermiso,permiso_idusuario) VALUES ($permiso,'$id_usuario')");
            if ($sql == 1) {
                header("Location: permisos.php?id=".$id_usuario."&m=si");
            } else {
                $alert = '<div class="alert alert-primary" role="alert">
                            Error al actualizar permisos
                        </div>';
            }
        }
    }
}
?>

                    <div class="row">
                    <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header bg-secundary text-black">
                        Asigna los permisos requeridos al usuario
                        </div>

                    <div class="card-body">
                    <form method="post" action="">
                        <?php if(isset($_GET['m']) && $_GET['m'] == 'si') 
                        { ?>
                            <div class="alert alert-success" role="alert">
                                Permisos actualizado
                            </div>

                        <?php } ?>

                        <?php 
                        $con = 0;
                        $divrow = "<div id='prueba' class='row'>";
                        while ($row = mysqli_fetch_assoc($sqlpermisos)) 
                        { 
                            $con += 1;
                            if ($con == 3)
                            {
                                $col = "col-lg-3";
                                $con = 0;
                            }
                            else
                            {
                                $col = "col-lg-4";
                            }

                            echo $divrow;
                            ?>

                            <div class="form-check form-check-inline <?php echo $col; ?>">

                                <input id="permiso<?php echo $row['idpermiso'];?>" name="permisos[]" value="<?php echo $row['idpermiso'];?>" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="secondary" data-size="sm" data-on="SI" data-off="NO"
                                <?php 
                                if (isset($datos[$row['idpermiso']])) {
                             echo "checked";
                             }
                            ?> >

                                <label for="permiso<?php echo $row['idpermiso']; ?>" class="p-2 text-uppercase"><?php echo $row['permiso']; ?></label>  
                            </div>

                        <?php 
                        
                        if($con == 0)
                        {
                            echo "</div>";
                            $divrow = "<div class='row'>";
                            echo "<br>";
                        }
                        else
                        {
                            $divrow = "";
                            $divrowend = "";
                            $salto = "";
                        }
                    }
                    echo "</div>"; 
                    ?>
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
                </div>
<?php 
ob_end_flush();
include_once "footer.php"; ?>