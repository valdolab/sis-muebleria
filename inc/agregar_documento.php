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
        /*if ($ban == 'folio')
        {
          $new_folio = $_POST['newfolio'];
          $insert_puesto = mysqli_query($conexion, "INSERT INTO folio(idfolio) values ('$new_folio')");
              if ($insert_puesto) {
                  $alert = '<div class="alert alert-primary" role="alert">
                              Folio registrado
                          </div>';
                  #header("Location: agregar_documento.php");
              } 
              else
              {
                  $alert = '<div class="alert alert-danger" role="alert">
                          Error al registrar
                      </div>';
              }
        }*/ //elseif
        if($ban == 'sucursal')
        {
          $nomsucursal = $_POST['newsucursal'];
          $desc_sucursal = $_POST['desc_sucursal'];
          $insert_sucursal= mysqli_query($conexion, "INSERT INTO sucursales(sucursales,descripcion) values ('$nomsucursal','$desc_sucursal')");
              if ($insert_sucursal) {
                  $alert = '<div class="alert alert-primary" role="alert">
                              Sucursal registrado
                          </div>';
                          #header("Location: agregar_documento.php");
              }
              else
              {
                  $alert = '<div class="alert alert-danger" role="alert">
                          Error al registrar
                      </div>';
              }
        }
        else if($ban == 'newdocumento')
        {
          $id_doc = md5($_POST['nombre']);
          $name_documento = $_POST['nombre'];
          $folio = $_POST['folio'];
          $serie = $_POST['serie'];
          $sucursal = $_POST['sucursal'];

          $query = mysqli_query($conexion, "SELECT * FROM documento where iddocumento = '$id_doc'");
          $result = mysqli_fetch_array($query);
          if ($result > 0) {
              $alert = '<div class="alert alert-warning" role="alert">
                          El documento ya existe
                      </div>';
          }
          else
          {
                $query_insert = mysqli_query($conexion, "INSERT INTO documento(iddocumento,name_documento,folio,serie,idsucursal,estado) values ('$id_doc', '$name_documento','$folio', '$serie', $sucursal,1)");
                    if (!$query_insert)
                    {
                              $alert = '<div class="alert alert-danger" role="alert">
                                      Hubo un Error al registrar
                                  </div>';
                    }
                    else
                    {
                        #$alert = '<div class="alert alert-success" role="alert">Documento registrado correctamente</div>';
                        $modal = "$('#mensaje_success').modal('show');";
                    }   
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
                <h5><strong>AGREGAR DOCUMENTO</strong></h5>
            </div>
            <div class="card-body">
                <form action="" method="post" autocomplete="off">
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="correo">Nombre del documento</label>
                            <input required onkeyup="mayusculas(this)" type="text" class="form-control" placeholder="" name="nombre" id="nombre">
                        </div>
                        <div class="form-group col-lg-2">

                            <label for="folio">Folio</label>
                            <input onkeyup="mayusculas(this)" type="text" class="form-control" placeholder="" name="folio" id="folio">
                            
                            <!-- <input type="text" onkeyup="mayusculas(this);" class="form-control" placeholder="Ingrese Usuario" name="usuario" id="usuario"> -->

                        </div>
                        <div class="form-group col-lg-2">
                            <label for="documento">Serie</label>
                            <?php 
                                $sql_serie = mysqli_query($conexion,"SELECT valor_char from configuracion where configuracion = 'serie'");
                                $serie_valor = mysqli_fetch_array($sql_serie);
                                $num_serie = $serie_valor['valor_char'];

                             ?>
                            <input type="number" class="form-control" value="<?php echo $num_serie; ?>" placeholder="Ingrese Serie" name="serie" id="serie">
                        </div>

                        <div class="form-group col-lg-4">
                          <label>Sucursal</label>
                          <select onchange="mostrarSucursal()" class="form-control" id="sucursal" name="sucursal" required>
                            <option id="opSucursal" value="" selected>Seleccione una opción</option>
                            <?php
                            #codigo para la lista de sucursales que se extraen de la base de datos
                            $result = mysqli_query($conexion,"SELECT idsucursales,sucursales FROM sucursales");                        
                            if (mysqli_num_rows($result) > 0) {  
                              while($row = mysqli_fetch_assoc($result)){
                              echo "<option value='".$row["idsucursales"]."'>".$row["sucursales"]."</option>";
                              }
                            }
                            ?>                     
                            <option onClick="agregar_sucursal()" value="-1" >Agregar nueva sucursal...</option>    
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