<?php
ob_start();
include_once "header.php";
include "accion/conexion.php";

// Mostrar Datos
$id_documento = $_GET['id'];
if (empty($id_documento)) 
{
  header("Location: documentos.php");
}
else
{
    $sql = mysqli_query($conexion, "SELECT * FROM documento WHERE iddocumento = '$id_documento'");
    $result_sql = mysqli_num_rows($sql);
    if ($result_sql == 0) {
      header("Location: documentos.php");
    }
    else
    {
        $data = mysqli_fetch_array($sql);
        $up_name_documento = $data['name_documento'];
        $up_folio = $data['folio'];
        $up_serie = $data['serie'];
        $up_idsucursal = $data['idsucursal'];
    } 
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
        if($ban == 'newdocumento')
        {
          #$id_doc = md5($_POST['nombre']);
          $name_documento = $_POST['nombre'];
          $folio = $_POST['folio'];
          $serie = $_POST['serie'];
          $sucursal = $_POST['sucursal'];

        
                $query_insert = mysqli_query($conexion,"UPDATE documento SET name_documento='$name_documento',folio='$folio',serie='$serie',idsucursal=$sucursal where iddocumento = $id_documento");
                #$query_insert = mysqli_query($conexion,"UPDATE documento SET name_documento='$name_documento', serie='$serie',idsucursal='$sucursal' where folio = '$id_documento'");
                    if (!$query_insert)
                    {
                              $alert = '<div class="alert alert-danger" role="alert">
                                      Hubo un Error al registrar
                                  </div>';
                                  #echo $id_documento;
                                  #echo mysqli_error($conexion);
                    }
                    else
                    {
                        #$alert = '<div class="alert alert-success" role="alert">Documento actualizado correctamente</div>';
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
                                Documento editado correctamete
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
    <div class="col-md-9 mx-auto">
        <div class="card">
            <div class="card-header bg text-dark">
                <h5><strong>EDITAR DOCUMENTO</strong></h5>
            </div>
            <div class="card-body">
                <form action="" method="post" autocomplete="off">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="correo">Nombre del documento</label>
                            <input onkeyup="mayusculas(this)" type="text" class="form-control" placeholder="Ingrese Nombre del documento" name="nombre" id="nombre" value="<?php echo $up_name_documento; ?>">
                        </div>
                        <div class="form-group col-lg-2">

                            <label for="nombre">Folio</label>
                            <input onkeyup="mayusculas(this)" type="text" class="form-control" placeholder="Ingrese Nombre del documento" name="folio" id="folio" value="<?php echo $up_folio; ?>">

                        </div>
                        <div class="form-group col-lg-2">
                            <label for="documento">Serie</label>
                            <input type="number" class="form-control" value="<?php echo $up_serie; ?>" placeholder="Ingrese Serie" name="serie" id="serie">
                        </div>
                    
                        <div class="form-group col-lg-4">
                          <label>Sucursal</label>
                          <select onchange="mostrarSucursal()" class="form-control" id="sucursal" name="sucursal" required>
                            <?php
                            #codigo para la lista de sucursales que se extraen de la base de datos
                            $result = mysqli_query($conexion,"SELECT idsucursales,sucursales FROM sucursales");                        
                            if (mysqli_num_rows($result) > 0) {  
                              while($row = mysqli_fetch_assoc($result))
                              {
                                if ($row[idsucursales] == $up_idsucursal)
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
                    

                    <br>

                    <div class="row">
                        <div align="right" class="col-lg-10">
                            <a type="submit" class="btn btn-secondary" href="documentos.php">Regresar</a>
                        </div>
                        <div align="right" class="col-lg-2">
                            <input name="bandera" id="bandera" value="newdocumento" hidden>
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


<?php ob_end_flush(); ?>
<?php include_once "footer.php"; ?>