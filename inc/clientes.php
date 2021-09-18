<?php 
ob_start();
include_once "header.php";
include "accion/conexion.php";

#editar permisos


?>

<input onClick='se_agrego()' name='bandera' id='bandera' value='new' hidden>

<div class="col-lg-12">

<br>


<div id="ver_sucursales" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
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


<div class="card">
<div class="card-body">
    <div class="row">
        <div class="col-lg-10">
            <h4><strong>GESTION DE CLIENTES</strong></h4>
            <!--<input type="" name="prueba" id="prueba">-->
        </div>

        <div align="right" class="col-lg-2">
            <a href="agregar_cliente.php" class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Nuevo cliente</a>
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
                <th>#</th>
                <th>Rol</th>
                <th>Nombre</th>
                <th>Puesto</th>
                <th>Sucursal</th>
                <th>Usuario</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conexion, "SELECT idusuario,nombre,pass,idrol,puesto,estado FROM usuario ORDER BY idrol,estado ASC");
            $result = mysqli_num_rows($query);

            if ($result > 0) {
                $contador = 1;
                #while ($data = mysqli_fetch_assoc($query))
                while ($data = 0) {
                    if ($data['estado'] == 1) {
                        $estado = '<span class="badge badge-pill badge-success">Activo</span>';
                    } else {
                        $estado = '<span class="badge badge-pill badge-danger">Inactivo</span>';
                    }
                    $idrol = $data['idrol'];
                    $idpuesto = $data['puesto'];

                    #esto es para lo del rol y puesto
                    $query2 = mysqli_query($conexion, "SELECT rol FROM rol where idrol=$idrol");
                    $rol_usuario = mysqli_fetch_array($query2);
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
                            $new_array[] = $row;
                        }

                        foreach($new_array as $fila)
                        {
                         foreach($fila as $columna)
                         {
                            $lista = $lista."<li>".$columna."</li>";
                            #echo $columna;
                         }
                        #echo "<br>";
                        }
                        $sucursales = "<a data-toggle='modal' data-target='#ver_sucursales' onClick='visualizar(\"$data[idusuario]\",\"$lista\");' href='#'>Ver todas <i class='fas fa-eye'></i></a>";                        
                    }

                    ##poner que no se puueda borrar a superadmin
                        if ($idrol == 1)
                        {
                            $boton_eliminar = "<button disabled class='btn btn-danger btn-sm' type='submit'><i style='color: white;'' class='fas fa-trash-alt'></i></button>";
                        }
                        else
                        {
                            $boton_eliminar = "<button onClick='eliminar(\"$data[idusuario]\");' class='btn btn-danger btn-sm' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>";
                        }
                    ?>
                    <tr>
                        <td><?php echo $contador; ?></td>
                        <td><?php echo $rol_usuario['rol']; ?></td>
                        <td><?php echo $data['nombre']; ?></td>
                        <td><?php echo $puesto_usuario['puesto']; ?></td>
                        <td><?php echo $sucursales; ?></td>
                        <td><?php echo $data['idusuario']; ?></td>
                        <td WIDTH="110">
                            <?php if ($data['estado'] == 1) { ?>
                                <a href="rol.php?id=<?php echo $data['idusuario']; ?>" class="btn btn-warning btn-sm"><i class='fas fa-key'></i></a>
                                <a href="editar_usuario.php?id=<?php echo $data['idusuario']; ?>" class="btn btn-success btn-sm"><i class='fas fa-edit'></i></a>
                                <?php echo $boton_eliminar; ?>
                                    
                                
                            <?php } ?>
                        </td>
                    </tr>
            <?php 
                $contador = $contador + 1;
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

function eliminar(idusuario)
{
    Swal.fire({
            title: 'Esta seguro de eliminar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var action = 'eliminarUsuario';
                $.ajax({
                  url: 'eliminador.php',
                  type: "POST",
                  async: true,
                  data: {action:action,usuario:idusuario},
                  success: function(response) {
                    //$('#prueba').val(response);
                    if (response == 0) 
                    {
                        Swal.fire({
                          icon: 'Error',
                          title: 'Oops...',
                          text: 'Ocurrio un error, intente de nuevo!',
                        }).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "usuarios.php";
                            }
                        })   
                    }
                    else
                    {
                        Swal.fire(
                          'Eliminado!',
                          'Se elimino correctamente!',
                          'success'
                        ).then((result) => {
                            if (result.isConfirmed){
                                window.location.href = "usuarios.php";
                            }
                        })
                    }
                    
                  },
                  error: function(error) {
                    //$('#prueba').val('error');
                  }
                });      
              }
        })
}

</script>

<?php 
ob_end_flush();
include_once "footer.php"; 
?>
