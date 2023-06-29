<?php 
ob_start();
include_once "header.php";
include "accion/conexion.php";


?>

<div id="detalles_salida" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-secundary text-black">
                        <h5 class="modal-title" id="my-modal-title">Notas de la salida &nbsp;</h5> <h5 style="font-weight: bold;" class="modal-title" id="folio_nota_salida"></h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="" method="post" id="formAdd_nota_salida" autocomplete="on">
                            <div class="form-group">
                                 <textarea class="form-control" name="nota_salida" title="Ingrese las notas requeridas" id="nota_salida" placeholder="Ingrese las notas requeridas" maxlength="50000" style="height: 400px;"></textarea>
                            </div>

                            <input value="insert_edit_nota_salida" name="action" id="action" hidden readonly>
                            <!-- el id salida se pone mediante java script -->
                            <input value="aqui_va_id_salida" name="flag_id_salida" id="flag_id_salida" hidden readonly>
                            <div align="right">
                                <input id="btn_nota_salida" type="submit" class="btn btn-primary" value="Guardar">
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
        <div class="col-lg-8">
            <h2><strong>LISTA DE SALIDAS</strong></h2>
            <!--<input type="" name="prueba" id="prueba">-->
        </div>

        <div align="right" class="col-lg-4">
            <?php 
                $query_t = mysqli_query($conexion, "SELECT sum(total_general) as total from salida");
                $total_total = mysqli_fetch_assoc($query_t)['total'];
             ?>
            <!--<h3><strong>Total:</strong><h2><?php echo "$".number_format($total_total,2,'.',','); ?></h2></h3>-->
            <a href="pronostico.php" class="btn btn-primary" type="button" ><i class="fas fa-chart-line"></i> Pronóstico de cobranza</a>
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
                <th>Fecha</th>
                <th>Vendedor</th>
                <th>Folio Venta</th>
                <th>Tipo</th>
                <th>Modalidad</th>
                <th>Días de pagos</th>
                <th>Total</th>
                <th>Actual</th>
                <th>Nivel</th>
                <th>Estado</th>
                <th style="text-align: center;">Herramientas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conexion, "SELECT salida.idsalida,salida.fecha_salida, salida.folio_venta, venta_tipo.nombre_venta, salida.modalidad_pago, salida.dias_pago_semanal, salida.dias_pago_quincenal, salida.dias_pago_quincenal_2, salida.dias_pago_mensual, salida.total_general, salida.activo, salida.nivel_salida, usuario.usuario_acceso, salida.enganche, salida.pago_parcial from salida INNER JOIN venta_tipo on venta_tipo.idtipo_venta = salida.tipo_venta INNER JOIN usuario on usuario.idusuario = salida.vendedor");
            $result = mysqli_num_rows($query);
            if ($result > 0) 
            {
                while ($data = mysqli_fetch_assoc($query)) 
                {
                    //sacamos los dias de pago
                    $dias_de_pago = "";
                    if($data['modalidad_pago'] == "semanal")
                    {
                        $dias_de_pago = "Cada <strong>".$data['dias_pago_semanal']."</strong>";
                    }
                    else if($data['modalidad_pago'] == "quincenal")
                    {
                        $dias_de_pago = "Cada <strong>".$data['dias_pago_quincenal']."</strong> y <strong>".$data['dias_pago_quincenal_2']."</strong>";
                    }
                    else if($data['modalidad_pago'] == "mensual")
                    {
                        $dias_de_pago = "Cada <strong>".$data['dias_pago_mensual']."</strong>";
                    }

                    //ESTO ES PARA CALCULAR EL NIVEL DE SALIDAA
                    //y no tener que estar entrando para que se calcula el nivel
                    $id_salida = $data['idsalida'];
                    $query_select_fi = mysqli_query($conexion, "SELECT fecha_ideal from salida where idsalida = '$id_salida'");
                    $fechas_ideales_recalled = mysqli_fetch_assoc($query_select_fi)['fecha_ideal'];

                    $nivel_actual_salida = 0;
                    $up_enganche = $data['enganche'];
                    $up_pago_parcial = $data['pago_parcial'];
                    $up_total_general = $data['total_general'];
                    $up_modalidad = $data['modalidad_pago'];

                    //print($fechas_ideales_recalled);
                    if($fechas_ideales_recalled != null)
                    {
                        $fechas_ideales = unserialize($fechas_ideales_recalled);
                        //calculamos su nivel con la regla
                            $query_nivel_sal = mysqli_query($conexion, "SELECT saldo_al_momento FROM movimiento WHERE salida = '$id_salida' order by creado_en DESC LIMIT 1");
                            $debe_al_momento = floatval(mysqli_fetch_assoc($query_nivel_sal)['saldo_al_momento']);
                            $hoy = date("Y-m-d");
                            //$hoy = date('2023-03-20');

                            $j = 1;
                            $size_fechas = sizeof($fechas_ideales);
                            $total_ideal = $up_enganche;
                            while ($hoy > $fechas_ideales[$j]) 
                            {
                                $total_ideal = $total_ideal + $up_pago_parcial;

                                if($j+1 >= $size_fechas)
                                {
                                    break;
                                }
                                $j = $j + 1;
                            }

                            $total_pagado = $up_total_general - $debe_al_momento;
                            $diff_totalPagado_ideal = $total_ideal - $total_pagado;
                            if($up_modalidad == "mensual")
                            {
                                $dias_atraso_aux = round(($diff_totalPagado_ideal*30)/$up_pago_parcial, 2);
                                $periodo_atraso = round($dias_atraso_aux/30,2);
                            }
                            else if($up_modalidad == "quincenal")
                            {
                                $dias_atraso_aux = round(($diff_totalPagado_ideal*15)/$up_pago_parcial, 2);
                                $periodo_atraso = round($dias_atraso_aux/15,2);
                            }
                            else if($up_modalidad == "semanal")
                            {
                                $dias_atraso_aux = round(($diff_totalPagado_ideal*7)/$up_pago_parcial, 2);
                                $periodo_atraso = round($dias_atraso_aux/7,2);
                            }

                            if($dias_atraso_aux <= 0)
                            {
                                $nivel_actual_salida = 5;
                            }
                            else if($dias_atraso_aux < 15)
                            {
                                $nivel_actual_salida = 4;
                            }
                            else if($dias_atraso_aux < 30)
                            {
                                $nivel_actual_salida = 3;
                            }
                            else if($dias_atraso_aux < 60)
                            {
                                $nivel_actual_salida = 2;
                            }
                            else if($dias_atraso_aux >= 60)
                            {
                                $nivel_actual_salida = 1;
                            }

                            //insertar en la bd, actualizar la tabla salida
                            $query_act_sal = mysqli_query($conexion, "UPDATE salida set nivel_salida = '$nivel_actual_salida' where idsalida = '$id_salida'");
                    }

                    //FIN CALCULAR NIVEL DE SALIDA
                    //echo $nivel_actual_salida;
                    //nivel de la venta
                    $nivel_salida = "";
                    if ($nivel_actual_salida == 0)
                            {
                                $nivel_salida = '<div style="text-align:center;"><h5><span class="badge badge-pill badge-secondary">'.$data['nivel_salida'].'</span></h5></div>';
                            }
                            if ($nivel_actual_salida == 1)
                            {
                                $nivel_salida = '<div style="text-align:center;"><h5><span class="badge badge-pill badge-dark" style="background-color: #FF7A33;">'.$data['nivel_salida'].'</span></h5></div>';
                            }
                            if ($nivel_actual_salida == 2)
                            {
                                $nivel_salida = '<div style="text-align:center;"><h5><span class="badge badge-pill badge-warning">'.$data['nivel_salida'].'</span></h5></div>';
                            }
                            if ($nivel_actual_salida == 3)
                            {
                                $nivel_salida = '<div style="text-align:center;"><h5><span class="badge badge-pill badge-success">'.$data['nivel_salida'].'</span></h5></div>';
                            }
                            if ($nivel_actual_salida == 4)
                            {
                                $nivel_salida = '<div style="text-align:center;"><h5><span class="badge badge-pill badge-info">'.$data['nivel_salida'].'</span></h5></div>';
                            }
                            if ($nivel_actual_salida == 5)
                            {
                                $nivel_salida = '<div style="text-align:center;"><h5><span class="badge badge-pill badge-primary">'.$data['nivel_salida'].'</span></h5></div>';
                            }

                    $idsalida = $data['idsalida'];
                    $folio_venta = $data['folio_venta'];
                    if ($data['activo'] == 1) {
                        $estado = '<span class="badge badge-pill badge-success">Activo</span>';
                    } else {
                        $estado = '<span class="badge badge-pill badge-danger">Suspendido</span>';
                    }?>
                    <tr>
                        <td><?php echo $data['fecha_salida']; ?></td>
                        <td><?php echo $data['usuario_acceso']; ?></td>
                        <td><?php echo $data['folio_venta']; ?></td>
                        <td><?php echo $data['nombre_venta']; ?></td>
                        <td><?php echo $data['modalidad_pago']; ?></td>
                        <td><?php echo $dias_de_pago;  ?></td>
                        <td><?php echo "$".number_format($data['total_general'],2,'.',','); ?></td>
                        <td><?php echo "$".number_format($data['total_general'],2,'.',','); ?></td>
                        <td><?php echo $nivel_salida; ?></td>
                        <td><?php echo $estado ?></td>
                        <td align="center">
                                <a href="inv_editar_salidas.php?id=<?php echo $idsalida; ?>" class="btn btn-success btn-sm"><i class='fas fa-edit'></i></a>
                                <button onClick='suspender_salida("<?php echo $idsalida; ?>")' class='btn btn-warning btn-sm' type='submit'><i style='color: white;' class='fas fa-power-off'></i></button>
                                <button data-toggle="modal" data-target="#detalles_salida" onClick='show_message_salida("<?php echo $idsalida; ?>","<?php echo $folio_venta; ?>")' class='btn btn-info btn-sm' type='submit'><i style='color: white;' class='fas fa-clipboard-list'></i></button>
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
