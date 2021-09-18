<?php 
ob_start();
include_once "header.php";
include "accion/conexion.php";

#editar permisos


?>

<div class="col-lg-12">
<br>

<div class="card">
<div class="card-body">
    <div class="row">
        <div class="col-lg-10">
            <h4><strong>GESTION DE DOCUMENTOS</strong></h4>
            <!--<input type="" name="prueba" id="prueba">-->
        </div>

        <div align="right" class="col-lg-2">
            <!-- <a data-toggle="modal" data-target="#nuevo_documento"  class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Nuevo documento</a> -->
            <a href="agregar_documento.php"  class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Nuevo documento</a> 
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
                <th>Documento</th>
                <th>Folio</th>
                <th>Serie</th>
                <th>Sucursal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conexion, "SELECT iddocumento,name_documento,folio,serie,idsucursal,estado FROM documento ORDER BY name_documento ASC");
            $result = mysqli_num_rows($query);

            if ($result > 0) {
                $contador = 1;
                while ($data = mysqli_fetch_assoc($query)) {
                    if ($data['estado'] == 1) {
                        $estado = '<span class="badge badge-pill badge-success">Activo</span>';
                    } else {
                        $estado = '<span class="badge badge-pill badge-danger">Inactivo</span>';
                    }
                    #calculamos a que sucursales puede entrar el usuario
                    $id_documento = $data['iddocumento'];
                    $query4 = mysqli_query($conexion, "SELECT sucursales from sucursales where idsucursales in (select idsucursal from documento where iddocumento='$id_documento')");
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

                    ?>
                    <tr>
                        <td><?php echo $contador; ?></td>
                        <td><?php echo $data['name_documento']; ?></td>
                        <td><?php echo $data['folio']; ?></td>
                        <td><?php echo $data['serie']; ?></td>
                        <td><?php echo $sucursales ?></td>
                        <td WIDTH="110">
                            <?php if ($data['estado'] == 1) { ?>
                                <a href="editar_documento.php?id=<?php echo $id_documento; ?>" class="btn btn-success btn-sm"><i class='fas fa-edit'></i></a>
                                <button onClick='eliminar_doc("<?php echo $id_documento; ?>")' class='btn btn-danger btn-sm' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>
                                    
                                
                            <?php }else {
                                echo $estado;
                            } ?>
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

</script>

<?php 
ob_end_flush();
include_once "footer.php"; 
?>
