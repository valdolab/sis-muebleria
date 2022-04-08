<?php 
ob_start();
include_once "header.php";
include "accion/conexion.php";

?>

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
            <a href="agregar_sucursal.php" class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Nueva sucursal</a> 
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
                <th>Usuarios</th>
                <th>Documentos</th>
                <th style="text-align: center;">Tipo</th>
                <th style="text-align: center;">Estatus</th>
                <th style="text-align: center;">Herramientas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //HACERLO CON INNER JOIN
            $query = mysqli_query($conexion, "SELECT idsucursales,sucursales,descripcion,estado,matriz,tipo FROM sucursales ORDER BY matriz DESC, idsucursales DESC");
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

                    $ceros = "00";
                        if ($id_sucursal > 9)
                        {
                            $ceros = "0";
                        }
                        elseif ($id_sucursal > 99) 
                        {
                            $ceros = "";
                        }

                        //quitar lo de -matriz del nombre de sucursal
                        //ESTO SE VA A QUITAR PORQUE VA A IR EL INNER JOIN
                        $arraynames_sucursal = explode("-", $data['sucursales']);
                        $name_tipo = mysqli_query($conexion, "SELECT nombre_tipo from tipo where idtipo=$data[tipo]");
                        $name_tipo = mysqli_fetch_assoc($name_tipo)['nombre_tipo'];
                    ?>
                    <tr>
                        <td><?php echo "SUC-".$ceros.$id_sucursal; ?></td>
                        <td><?php echo $arraynames_sucursal[0]; ?></td>
                        <td><?php echo $data['descripcion']; ?></td>
                        <td align="center"><?php echo $num_asignaciones; ?></td>
                        <td align="center"><?php echo $num_asignaciones_docs; ?></td>
                        <td align="center"><?php echo $name_tipo; ?></td>
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
                                    echo '<button class="btn btn-primary btn-sm" type="submit" title="Matriz Asiganda"><i style="color: white;" class="fas fa-home"></i></button>';
                                    echo "&nbsp;";
                                    echo '<a title="editar" href="editar_sucursal.php?id='.$id_sucursal.'" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>';
                                    echo "&nbsp;";
                                    echo "<button disabled title='suspender' class='btn btn-warning btn-sm' type='submit'><i style='color: white;' class='fas fa-power-off'></i></button>";
                                    echo "&nbsp;";
                                    echo "<button disabled title='eliminar' class='btn btn-danger btn-sm' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>";
                                    echo "&nbsp;";
                                }
                                else
                                {
                                    echo '<button class="btn btn-secondary btn-sm" type="submit" onclick="asignar_matriz('.$id_sucursal.')" '.$estado_matriz.' title="Asignar como matriz"><i style="color: white;" class="fas fa-home"></i></button>';
                                    echo "&nbsp;";
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
                                echo '<button class="btn btn-secondary btn-sm" disabled '.$estado_matriz.' title="Se encuentra suspendido, activala para asignar como matriz"><i style="color: white;" class="fas fa-home"></i></button>';
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
