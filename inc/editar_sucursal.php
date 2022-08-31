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
    $sql = mysqli_query($conexion, "SELECT idsucursales,sucursales,descripcion,estado,matriz,tipo FROM sucursales WHERE idsucursales = $id_sucursal");
    $result_sql = mysqli_num_rows($sql);
    if ($result_sql == 0) {
      header("Location: sucursales.php");
    }
    else
    {
        $data = mysqli_fetch_array($sql);
        $up_sucursales = $data['sucursales'];
        $up_desc = $data['descripcion'];
        $up_tipo = $data['tipo'];
        $es_matriz = $data['matriz'];
    } 
}

#editar sucursal
#agregar nueva sucursal
if (!empty($_POST)) 
{
    $ban = $_POST['bandera'];
    if($ban == 'addsucursal')
    {
        $new_sucursales = $_POST['newsucursal'];
        $idtipo = $_POST['tipo'];
        $new_desc = $_POST['desc_sucursal'];
        //ver si se edito una matriz
        if($es_matriz)
        {
            $new_sucursales = $new_sucursales."-Matriz";
        }

        $insert_sucursal= mysqli_query($conexion, "UPDATE sucursales set sucursales = '$new_sucursales', descripcion = '$new_desc', tipo = '$idtipo' where idsucursales = $id_sucursal");
        if ($insert_sucursal) 
        {
            
            $modal = "$('#mensaje_successSuc').modal('show');";
        }
        else
        {
            $modal = "$('#mensaje_errorSuc').modal('show');";
        }
    }
}

?>

<div style="posicion: fixed; top: 15%;" id="mensaje_successSuc" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
                                Surursal editada correctamete
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

<div style="posicion: fixed; top: 15%;" id="mensaje_errorSuc" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
                                La sucursar no pudo actualizarse, intente nuevamente.
                            </div>
                        </div>
                        <div class="swal2-actions">
                            <a href="#" class="swal2-confirm swal2-styled" type="button" style="display: inline-block;">Ok</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div id="nuevo_tipo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg text-black">
                <h5 class="modal-title" id="my-modal-title">Agregar nuevo tipo</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="on" id="formAdd_tipo">
                    <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="correo">Nueva tipo</label>
                            <input type="text" class="form-control" name="nuevotipo" id="nuevotipo" required maxlength="99">
                        </div>  
                        </div>
                    </div>

                    <input value="insert_tipo" name="action" id="action" hidden>
                    <div align="right">
                        <input type="submit" value="Agregar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="editar_tipo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg text-black">
                <h5 class="modal-title" id="my-modal-title">Editar tipo</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="on" id="formEdit_tipo">
                    <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="correo">Tipo</label>
                            <input type="text" class="form-control" name="newedit_tipo" id="newedit_tipo" required maxlength="99">
                            <input type="text" name="idflag_tipo" id="idflag_tipo" hidden>
                        </div>  
                        </div>
                    </div>

                    <input value="update_tipo" name="action" id="action" hidden>
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
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg text-dark">
                <h5>EDITAR SUCURSAL <strong><?php echo ($es_matriz ? "MATRIZ" : ""); ?></strong></h5>
            </div>
            <div class="card-body">
                <form action="" method="post" autocomplete="off">    
                    <?php 
                        
                            //calculamos solo el nombre, sin el -Matriz
                            $name_sinmatriz = explode("-", $up_sucursales)[0];
                            ?>
                            <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="correo">Nueva Sucursal</label>
                                    <input type="text" class="form-control" placeholder="Ingrese Nombre completo" name="newsucursal" id="newsucursal" required value="<?php echo $name_sinmatriz; ?>">
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="newsucursal">Tipo</label>
                                <?php 
                                if($_SESSION['rol'] == "SuperAdmin" or $_SESSION['rol'] == "Administrador")
                                {
                                    ?>
                                    <button data-toggle="modal" data-target="#nuevo_tipo" title="Agregar nuevo Tipo" class="btn btn-primary btn-xs" type="button" href="#" ><i class="fas fa-plus"></i></button>
                                    <button disabled data-toggle="modal" data-target="#editar_tipo" onclick="editar_tipo();" title="Editar Tipo" class="btn btn-success btn-xs" type="button" href="#" id="btn_editartipo"><i class="fas fa-edit"></i></button>
                                    <button disabled onclick="eliminar_tipo();" title="Eliminar Tipo" class="btn btn-danger btn-xs" type="button" href="#" id="btn_eliminartipo"><i class="fas fa-trash"></i></button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <button disabled="disabled" title="Agregar nuevo Tipo" class="btn btn-primary btn-xs" type="button"><i class="fas fa-plus"></i></button>
                                    <button disabled="disabled" title="Editar Tipo" class="btn btn-success btn-xs" type="button"><i class="fas fa-edit"></i></button>
                                    <button disabled="disabled" title="Eliminar Tipo" class="btn btn-danger btn-xs" type="button"><i class="fas fa-trash"></i></button>
                                    <?php 
                                } 
                             ?>

                                <select class="form-control" id="tipo" name="tipo">
                                    <option selected hidden>Selecciona un tipo</option>
                                    <?php
                                    #codigo para la lista de sucursales que se extraen de la base de datos
                                    $result_tipo = mysqli_query($conexion,"SELECT idtipo,nombre_tipo FROM tipo");                        
                                    if (mysqli_num_rows($result_tipo) > 0) {  
                                      while($row = mysqli_fetch_assoc($result_tipo))
                                      {
                                        if ($row['idtipo'] == $up_tipo)
                                        {
                                          echo "<option selected value='".$row[idtipo]."'>".$row[nombre_tipo]."</option>";
                                        }
                                        else
                                        {
                                          echo "<option value='".$row[idtipo]."'>".$row[nombre_tipo]."</option>";
                                        }
                                      }
                                    }
                                    ?>  
                                </select>  
                            </div>
                            </div>

                    <div class="form-group">
                         <textarea class="form-control" name="desc_sucursal" title="Ingrese descripción de la sucursal" id="desc_sucursal" placeholder="Indicar una breve descripción sobre la sucursal (Opcional)" maxlength="1000"><?php echo $up_desc; ?></textarea>
                    </div>

                    <div class="row">
                        <input value="addsucursal" name="bandera" id="bandera" hidden>
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

document.getElementById('divzoom').style.zoom = "90%";
</script>

<?php ob_end_flush(); ?>
<?php include_once "footer.php"; ?>