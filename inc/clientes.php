<?php 
ob_start();
include_once "header.php";
include "accion/conexion.php";

?>

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

<div class="col-lg-12">

<div class="card">
<div class="card-body">
    <div class="row">
        <div class="col-lg-10">
            <h4><strong>GESTION DE CLIENTES</strong></h4>
            <!--<input type="" name="prueba" id="prueba">-->
        </div>
        <div align="right" class="col-lg-2">
            <?php 
            if($nuevo_cliente)
            {
                echo '<a href="agregar_cliente.php" class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Nuevo cliente</a>';
            }
            else
            {
                echo '<button disabled class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Nuevo cliente</button>';
            }
         ?>
        </div>
    </div>
</div>
</div>

<br>

<div class="card">
<div class="card-body">
<div class="table-responsive ">
    <table class="table" id="tbl">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Nombre del Cliente</th>
                <th>Zona</th>
                <th>Subzona</th>
                <th>Teléfono</th>
                <th>Nivel de credito</th>
                <th style="text-align: center;">Herramientas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conexion, "SELECT * FROM cliente ORDER BY nivel_apto ASC, idcliente ASC");
            $result = mysqli_num_rows($query);

            if ($result > 0) 
            {
                while ($data = mysqli_fetch_assoc($query))
                {
                    $idcliente = $data['idcliente'];
                    $no_cliente = $data['no_cliente'];
                    if($data['estado_cliente'])
                    {
                        if ($data['apto_credito'] == 1) 
                        {
                            if ($data['nivel_apto'] == 0)
                            {
                                $estado = '<div style="text-align:center;"><h5><span class="badge badge-pill badge-secondary">'.$data['nivel_apto'].'</span></h5></div>';
                            }
                            if ($data['nivel_apto'] == 1)
                            {
                                $estado = '<div style="text-align:center;"><h5><span class="badge badge-pill badge-dark" style="background-color: #FF7A33;">'.$data['nivel_apto'].'</span></h5></div>';
                            }
                            if ($data['nivel_apto'] == 2)
                            {
                                $estado = '<div style="text-align:center;"><h5><span class="badge badge-pill badge-warning">'.$data['nivel_apto'].'</span></h5></div>';
                            }
                            if ($data['nivel_apto'] == 3)
                            {
                                $estado = '<div style="text-align:center;"><h5><span class="badge badge-pill badge-success">'.$data['nivel_apto'].'</span></h5></div>';
                            }
                            if ($data['nivel_apto'] == 4)
                            {
                                $estado = '<div style="text-align:center;"><h5><span class="badge badge-pill badge-info">'.$data['nivel_apto'].'</span></h5></div>';
                            }
                            if ($data['nivel_apto'] == 5)
                            {
                                $estado = '<div style="text-align:center;"><h5><span class="badge badge-pill badge-primary">'.$data['nivel_apto'].'</span></h5></div>';
                            }
                        } 
                        else 
                        {
                            $estado = '<div style="text-align:center;"><h5><span class="badge badge-pill badge-danger">NA</span></h5></div>';
                        }
                        #lo del boton editar cuando esta suspendido
                        $button_editar = '<a href="editar_cliente.php?id='.$idcliente.'" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>';
                    }
                    else
                    {
                        $estado = '<div style="text-align:center;"><h5><span class="badge badge-pill badge-secondary">Suspendido</span></h5></div>';
                        $button_editar = '<button disabled class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>';
                    }

                    $idzona = $data['zona'];
                    $idsubzona = $data['subzona'];

                    #esto es para lo del rol y puesto
                    $query2 = mysqli_query($conexion, "SELECT zona FROM zonas where idzona=$idzona");
                    $zona_cliente = mysqli_fetch_array($query2)['zona'];
                    $query3 = mysqli_query($conexion, "SELECT subzona FROM subzonas where idsubzona=$idsubzona");
                    $subzona_cliente = mysqli_fetch_array($query3)['subzona'];
                    $ceros = "0000";
                        if ($no_cliente > 9)
                        {
                            $ceros = "000";
                        }
                        elseif ($no_cliente > 99) 
                        {
                            $ceros = "00";
                        }
                        elseif ($no_cliente > 999) 
                        {
                            $ceros = "0";
                        }
                        elseif ($no_cliente > 9999) 
                        {
                            $ceros = "";
                        }
                    ?>
                    <tr>
                        <td><?php echo $ceros.$no_cliente; ?></td>
                        <td><?php echo $data['nombre_cliente']; ?></td>
                        <td><?php echo $zona_cliente; ?></td>
                        <td><?php echo $subzona_cliente; ?></td>
                        <td><?php echo $data['tel1_cliente']; ?></td>
                        <td><?php echo $estado; ?></td>
                        <td align="center">
                                <?php 
                                echo $button_editar; 
                                if($editar_cliente_full)
                                {
                                    ?>
                                        <button title='suspender cliente' onClick='suspender_cliente("<?php echo $idcliente; ?>");' class='btn btn-warning btn-sm' type='submit'><i style='color: white;' class='fas fa-power-off'></i></button>
                                        <button onClick='eliminar_cliente("<?php echo $idcliente ?>")' class='btn btn-danger btn-sm' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>
                                    <?php 
                                }
                                else
                                {
                                    ?>
                                        <button disabled title='suspender cliente' class='btn btn-warning btn-sm' type='submit'><i style='color: white;' class='fas fa-power-off'></i></button>
                                        <button disabled class='btn btn-danger btn-sm' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>
                                    <?php 
                                }
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

<?php 
ob_end_flush();
include_once "footer.php"; 
?>
