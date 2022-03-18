<?php 
ob_start();
include_once "header.php";
include "accion/conexion.php";

#agregar nueva sucursal
if (!empty($_POST)) 
{
    $nomsucursal = $_POST['newsucursal'];
    $desc_sucursal = $_POST['desc_sucursal'];
    $insert_sucursal= mysqli_query($conexion, "INSERT INTO sucursales(sucursales,descripcion) values ('$nomsucursal','$desc_sucursal')");
    if ($insert_sucursal) 
    {
        #$alert = '<div class="alert alert-primary" role="alert"> Sucursal registrado </div>';
        $modal = "$('#mensaje_success').modal('show');";
    }
    else
    {
        #$alert = '<div class="alert alert-danger" role="alert"> Error al registrar </div>';
        $modal = "$('#mensaje_error').modal('show');";
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
                                La sucursal no pudo ser registrada, intente nuevamente.
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
                            <h2 id="swal2-title" class="swal2-title" style="display: flex;">Registrada!</h2>
                        </div>

                        <div class="swal2-content">
                            <div id="swal2-content" class="swal2-html-container" style="display: block;">
                                Sucursal registrada correctamete
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

<div id="nueva_sucursal_avanzado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
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
                        <label for="correo">Nueva Sucursal</label>
                        <input type="text" class="form-control" placeholder="Ingrese Nombre completo" name="newsucursal" id="newsucursal" required>
                    </div>

                    <div class="form-group">
                         <textarea class="form-control" name="desc_sucursal" title="Ingrese descripción de la sucursal" id="desc_sucursal" placeholder="Indicar una breve descripción sobre la sucursal (Opcional)" maxlength="1000"></textarea>
                    </div>

                    <!-- <div class="form-group">
                        <label>Asignar como sucursal Matriz</label> &nbsp;
                        <input id="esmatriz" name="esmatriz" value="" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="secondary" data-size="sm" data-on="SI" data-off="NO">
                    </div> -->

                    <div align="right">
                        <input type="submit" value="Agregar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="col-lg-12">

<div class="card">
<div class="card-body">
    <div class="row">
        <div class="col-lg-10">
            <h4><strong>GESTION DE SUCURSALES</strong></h4>
            <!--<input type="" name="prueba" id="prueba">-->
        </div>

        <div align="right" class="col-lg-2">
            <!-- <a data-toggle="modal" data-target="#nuevo_documento"  class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Nuevo documento</a> -->
            <a href="#" data-toggle="modal" data-target="#nueva_sucursal_avanzado" class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Nueva sucursal</a> 
        </div>
    </div>
</div>
</div>

<br>

<div class="card">
<div class="card-body">
<div class="table-responsive">
    <table class="table" id="tbl">
        <thead class="thead-light">
            <tr>
                <th>No.</th>
                <th>Sucursal</th>
                <th>Descripción</th>
                <th>Usuarios asignados</th>
                <th>Documentos asignados</th>
                <th style="text-align: center;">Sucursal Matriz</th>
                <th style="text-align: center;">Estatus</th>
                <th style="text-align: center;">Herramientas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conexion, "SELECT idsucursales,sucursales,descripcion,estado,matriz FROM sucursales ORDER BY matriz DESC, idsucursales DESC");
            $result = mysqli_num_rows($query);

            if ($result > 0) 
            {
                while ($data = mysqli_fetch_assoc($query)) {
                    if ($data['estado'] == 1) {
                        $estado = '<a title="Sucursal Activo"><span class="badge badge-pill badge-success">Activo</span></a>';
                        $estado_matriz = 'href="#"';
                    } else {
                        $estado = '<a title="Sucursal Suspendido"><span class="badge badge-pill badge-warning">Suspendido</span></a>';
                        $estado_matriz = "";
                    }
                    #calculamos a que sucursales puede entrar el usuario
                    $id_sucursal = $data['idsucursales'];

                    $query4 = mysqli_query($conexion, "SELECT count(sucursal_idsucursales) as num_sucursales from sucursal_usuario where sucursal_idsucursales = $id_sucursal");
                    $num_asignaciones = mysqli_fetch_array($query4)['num_sucursales'];
                    #buscamos cuantos documentos tiene asignados esa matriz
                    $query5 = mysqli_query($conexion, "SELECT count(folio) as num_docs from documento where idsucursal = $id_sucursal");
                    $num_asignaciones_docs = mysqli_fetch_array($query5)['num_docs'];

                    if ($data['matriz'] == 1)
                    {
                        $matriz = '<a title="Matriz Asiganda"><span class="badge badge-pill badge-primary">Matriz</span></a>';
                    }
                    else
                    {
                        if ($data['estado'] == 1)
                        {
                            $matriz = '<a onclick="asignar_matriz('.$id_sucursal.')" '.$estado_matriz.' title="Asignar como matriz"><span class="badge badge-pill badge-secondary">No Matriz</span></a>';
                        }
                        else
                        {
                            $matriz = '<a disabled '.$estado_matriz.' title="Se encuentra suspendido, activala para asignar como matriz"><span class="badge badge-pill badge-secondary">No Matriz</span></a>';
                        }
                    }
                    $ceros = "00";
                        if ($id_sucursal > 9)
                        {
                            $ceros = "0";
                        }
                        elseif ($id_sucursal > 99) 
                        {
                            $ceros = "";
                        }

                    ?>
                    <tr>
                        <td><?php echo $ceros.$id_sucursal; ?></td>
                        <td><?php echo $data['sucursales']; ?></td>
                        <td><?php echo $data['descripcion'] ?></td>
                        <td align="center"><?php echo $num_asignaciones ?></td>
                        <td align="center"><?php echo $num_asignaciones_docs ?></td>
                        <td align="center"> <?php echo $matriz; ?> </td>
                        <td align="center"> <?php echo $estado; ?> </td>
                        
                        <td>
                            <?php 
                            if ($data['estado'] == 1) 
                            { 
                                $sql = mysqli_query($conexion, "SELECT matriz FROM sucursales WHERE idsucursales = $id_sucursal");
                                $data = mysqli_fetch_array($sql);
                                if ($data['matriz'] == 1)
                                {
                                    #si es matriz no dejar editarlo, ni eliminarlo ni suspenderlo
                                    echo '<a title="editar" href="editar_sucursal.php?id='.$id_sucursal.'" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>';
                                    echo "&nbsp;";
                                    echo "<button disabled title='suspender' class='btn btn-warning btn-sm' type='submit'><i style='color: white;' class='fas fa-power-off'></i></button>";
                                    echo "&nbsp;";
                                    echo "<button disabled title='eliminar' class='btn btn-danger btn-sm' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>";
                                    echo "&nbsp;";
                                }
                                else
                                {
                                    echo '<a title="editar" href="editar_sucursal.php?id='.$id_sucursal.'" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>';
                                    echo "&nbsp;";
                                    echo "<button title='suspender' onClick='suspender_sucursal(\"$id_sucursal\");' class='btn btn-warning btn-sm' type='submit'><i style='color: white;' class='fas fa-power-off'></i></button>";
                                    echo "&nbsp;";
                                    echo "<button title='eliminar' onClick='eliminar_sucursal(\"$id_sucursal\");' class='btn btn-danger btn-sm' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>";
                                    echo "&nbsp;";
                                }
                                ?>
                            <?php 
                            }
                            else
                            {
                                ?>
                                <button disabled title="editar" href="editar_sucursal.php?id=<?php echo $id_sucursal; ?>" class="btn btn-success btn-sm"><i class='fas fa-edit'></i></button>
                                <button title="suspender" onClick='suspender_sucursal(<?php echo $id_sucursal; ?>)' class='btn btn-warning btn-sm' type='submit'><i style='color: white;' class='fas fa-power-off'></i></button>
                                <button disabled title="eliminar" class='btn btn-danger btn-sm' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>

                      <?php } ?>
                        </td>
                    </tr>
            <?php 
                }
            } 
            ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
<br><br>

<script type="text/javascript">
function visualizar(idusuario,lista)
        {
          //alert(m+"  "+q);
          var xmlhttp;      
            if (window.XMLHttpRequest)
            {
            xmlhttp=new XMLHttpRequest();
            }
          else
            {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
          xmlhttp.onreadystatechange=function()
            {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
             {
             document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
             }
            }

          $("#my_modal_title").html("Sucursales permitidas a "+idusuario);  
          $("#listamodal_sucursales").html(lista); 

          $('#ver_sucursales').modal('show');
        }

</script>

<?php 
ob_end_flush();
include_once "footer.php"; 
?>
