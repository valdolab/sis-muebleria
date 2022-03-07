<?php
ob_start();
include_once "header.php";
include "accion/conexion.php";

// Mostrar Datos
if (empty($_GET['id'])) 
{
  header("Location: sucursales.php");
}
else
{
    $id_sucursal = $_GET['id'];
    $sql = mysqli_query($conexion, "SELECT idsucursales,sucursales,descripcion FROM sucursales WHERE idsucursales = $id_sucursal");
    $result_sql = mysqli_num_rows($sql);
    if ($result_sql == 0) {
      header("Location: sucursales.php");
    }
    else
    {
        $data = mysqli_fetch_array($sql);
        $up_sucursales = $data['sucursales'];
        $up_desc = $data['descripcion'];
    } 
}

#editar sucursal
#agregar nueva sucursal
if (!empty($_POST)) 
{
    $new_sucursales = $_POST['newsucursal'];
    $new_desc = $_POST['desc_sucursal'];
    $insert_sucursal= mysqli_query($conexion, "UPDATE sucursales set sucursales = '$new_sucursales', descripcion = '$new_desc') where idsucursales = $id_sucursal");
    if ($insert_sucursal) 
    {
        
        $modal = "$('#mensaje_success').modal('show');";
    }
    else
    {
        $alert = '<div class="alert alert-danger" role="alert"> Hubo un Error al registrar, intente de nuevo.</div>';
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
                            <h2 id="swal2-title" class="swal2-title" style="display: flex;">Listo!</h2>
                        </div>

                        <div class="swal2-content">
                            <div id="swal2-content" class="swal2-html-container" style="display: block;">
                                Documento agregado correctamete
                            </div>
                        </div>
                        <div class="swal2-actions">
                            <a href="documentos.php" class="swal2-confirm swal2-styled" type="button" style="display: inline-block;">Ok</a>
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
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg text-dark">
                <h5><strong>EDITAR SUCURSAL</strong></h5>
            </div>
            <div class="card-body">
                <form action="" method="post" autocomplete="off">
                    <div class="form-group">
                        <label for="correo">Nueva Sucursal</label>
                        <input type="text" class="form-control" placeholder="Ingrese Nombre completo" name="newsucursal" id="newsucursal" required value="<?php echo $up_sucursales; ?>">
                    </div>

                    <div class="form-group">
                         <textarea class="form-control" name="desc_sucursal" title="Ingrese descripción de la sucursal" id="desc_sucursal" placeholder="Indicar una breve descripción sobre la sucursal (Opcional)" maxlength="1000"><?php echo $up_desc; ?></textarea>
                    </div>

                    <div class="row">
                        <div align="right" class="col-lg-10">
                            <a type="submit" class="btn btn-secondary" href="sucursales.php">Regresar</a>
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

function agregar_sucursal()
{
      $('#nueva_sucursal').modal('show');
}

// Funcion JavaScript para la conversion a mayusculas
function mayusculas(e) {
    e.value = e.value.toUpperCase();
}

</script>

<?php ob_end_flush(); ?>
<?php include_once "footer.php"; ?>