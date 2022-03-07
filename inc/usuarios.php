<?php 
ob_start();
include_once "header.php";
include "accion/conexion.php";



?>

<input onClick='se_agrego()' name='bandera' id='bandera' value='new' hidden>

<div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Nuevo Usuario</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="off">
                    
                </form>
            </div>
        </div>
    </div>
</div>


<div id="ver_sucursales" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my_modal_title"></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="listamodal_sucursales"  class="list-group">

                    <!-- <li class='list-group-item'>Cras justo odio</li> -->
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12">
<div class="card">
<div class="card-body">
    <div class="row">
        <div class="col-lg-10">
            <h4><strong>GESTION DE USUARIOS</strong></h4>
            <!--<input type="" name="prueba" id="prueba">-->
        </div>

        <div align="right" class="col-lg-2">
            <a href="agregar_usuario.php" class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Nuevo usuario</a>
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
                <th>ID</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Puesto</th>
                <th>Sucursal</th>
                <th style="text-align: center;">Herramientas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conexion, "SELECT idusuario,nombre,pass,rol,puesto,estado,superadmin,iduser_auto FROM usuario ORDER BY superadmin DESC, rol ASC");
            $result = mysqli_num_rows($query);
            if ($result > 0) 
            {
                while ($data = mysqli_fetch_assoc($query)) 
                {
                    $id = $data['iduser_auto'];
                    if ($data['estado'] == 1) 
                    {
                        $estado = '<span class="badge badge-pill badge-success">Activo</span>';
                    }
                    else
                    {
                        $estado = '<span class="badge badge-pill badge-danger">Inactivo</span>';
                    }
                    $rol = $data['rol'];
                    $idpuesto = $data['puesto'];

                    #esto es para lo del puesto
                    $query3 = mysqli_query($conexion, "SELECT puesto FROM puesto where idpuesto=$idpuesto");
                    $puesto_usuario = mysqli_fetch_array($query3);
                    
                    #calculamos a que sucursales puede entrar el usuario
                    $idusuario = $data['idusuario'];
                    $query4 = mysqli_query($conexion, "SELECT sucursales from sucursales where idsucursales in (select sucursal_idsucursales from sucursal_usuario where sucursal_idusuario='$idusuario')");
                    $cuantas = mysqli_num_rows($query4);
                    if ($cuantas == 1)
                    {
                        $sucursal_usuario = mysqli_fetch_array($query4);
                        $sucursales = $sucursal_usuario['sucursales'];
                    }
                    else
                    {
                        $lista = "";
                        $new_array = [];
                        while ($row = mysqli_fetch_assoc($query4))
                        {
                            $lista = $lista.'<li>'.$row["sucursales"].'</li>';
                        }

                        $sucursales = "<a data-toggle='modal' data-target='#ver_sucursales' onClick='visualizar(\"$data[idusuario]\",\"$lista\");' href='#'>Ver todas <i class='fas fa-eye'></i></a>";                        
                    }

                    ##poner que no se puueda borrar a superadmin
                        if ($rol == "SuperAdmin")
                        {
                            $boton_eliminar = "<button disabled class='btn btn-danger btn-sm' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>";
                            $boton_permisos = "<button disabled class='btn btn-warning btn-sm'><i class='fas fa-key'></i></button>";
                        }
                        else
                        {
                            $boton_eliminar = "<button onClick='eliminar_user(\"$data[idusuario]\");' class='btn btn-danger btn-sm' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>";
                            $boton_permisos = "<a href='permisos.php?id=".$data["idusuario"]."' class='btn btn-warning btn-sm'><i class='fas fa-key'></i></a>";
                        }
                        $ceros = "00";
                        if ($id > 9)
                        {
                            $ceros = "0";
                        }
                        elseif ($id > 99) 
                        {
                            $ceros = "";
                        }
                    ?>
                    <tr>
                        <td><?php echo $ceros.$id; ?></td>
                        <td><?php echo $data['idusuario']; ?></td>
                        <td><?php echo $data['nombre']; ?></td>
                        <td><?php echo $rol; ?></td>
                        <td><?php echo $puesto_usuario['puesto']; ?></td>
                        <td><?php echo $sucursales; ?></td>
                        <td align="center">
                            <?php if ($data['estado'] == 1) 
                            { 
                                echo $boton_permisos;
                                ?>

                                <a href="editar_usuario.php?id=<?php echo $data['idusuario']; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                
                                <?php 
                                echo $boton_eliminar;
                            }
                            else
                                echo $estado;
                            ?>
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
