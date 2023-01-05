<?php 
ob_start();
include_once "header.php";
include "accion/conexion.php";

?>

<div id="nuevo_almacen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Datos del nuevo almacén</h3>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="on" id="formAdd_almacen">
                    <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="correo">Nombre:</label>
                            <input type="text" class="form-control" name="nombre_almacen" id="nombre_almacen" required maxlength="99">
                        </div>  
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="correo">Sucursal:</label>
                            <select class="form-control" id="sucursal_almacen" name="sucursal_almacen" required>
                                <option id="opSucursal" value="" hidden selected>Seleccione una opción</option>
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
                        </div>
                    </div>
                    <br>
                    <input value="insert_almacen" name="action" id="action" hidden>
                    <div align="right">
                        <input type="submit" value="Agregar" class="btn btn-lg btn-primary">
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
            <h4><strong>INVENTARIO ACTUAL</strong></h4>
            <!--<input type="" name="prueba" id="prueba">-->
        </div>

        <div align="right" class="col-lg-2">
            <!-- <a data-toggle="modal" data-target="#nuevo_documento"  class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Nuevo documento</a> -->
            <a data-toggle="modal" data-target="#nuevo_almacen" class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Nuevo almacén</a> 
        </div>
    </div>
</div>
</div>

<div class="card">
<div class="card-body">
    <div class="row">
        <div class="col-lg-5">

            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <h4><strong>Valor total de la mercancía</strong></h4>
                            </div>
                            <?php 
                                $sql = mysqli_query($conexion, "SELECT sum(total) as total from entrada");
                                $costo_real = floatval(mysqli_fetch_assoc($sql)['total']);
                                //con puros INNER JOIN
                                //SELECT entrada.total from entrada INNER JOIN entrada_productos_serie on entrada_productos_serie.entrada = entrada.identrada INNER JOIN salida_productos_origen on salida_productos_origen.serie_origen = entrada_productos_serie.identrada_producto_serie
                                $sql = mysqli_query($conexion, "SELECT sum(entrada.total) as total_sacados from entrada where entrada.identrada in (SELECT entrada_productos_serie.entrada from entrada_productos_serie INNER JOIN salida_productos_origen on salida_productos_origen.serie_origen = entrada_productos_serie.identrada_producto_serie)");
                                $costo_real_e = floatval(mysqli_fetch_assoc($sql)['total_sacados']);
                                $costo_real = $costo_real - $costo_real_e;

                                $sql = mysqli_query($conexion, "SELECT sum(costo_iva) as total_con_iva, sum(costo_contado) as total_contado, sum(costo_especial) as total_especial, sum(costo_cr1) as total_cr1, sum(costo_cr2) as total_cr2 from producto INNER JOIN entrada_productos on entrada_productos.producto = producto.idproducto");
                                $costos_entrada = mysqli_fetch_assoc($sql);
                                $costo_e = floatval($costos_entrada['total_con_iva']);
                                $especial_e = floatval($costos_entrada['total_contado']);
                                $contado_e = floatval($costos_entrada['total_especial']);
                                $cr1_e = floatval($costos_entrada['total_cr1']);
                                $cr2_e = floatval($costos_entrada['total_cr2']);

                                $sql_e = mysqli_query($conexion, "SELECT sum(costo_iva) as total_con_iva, sum(costo_contado) as total_contado, sum(costo_especial) as total_especial, sum(costo_cr1) as total_cr1, sum(costo_cr2) as total_cr2 from producto INNER JOIN salida_productos on salida_productos.producto = producto.idproducto");
                                $costos_salida = mysqli_fetch_assoc($sql_e);
                                $costo = floatval($costos_salida['total_con_iva']);
                                $especial = floatval($costos_salida['total_contado']);
                                $contado = floatval($costos_salida['total_especial']);
                                $cr1 = floatval($costos_salida['total_cr1']);
                                $cr2 = floatval($costos_salida['total_cr2']);
                                //restamos
                                $costo = $costo_e - $costo;
                                $especial = $especial_e - $especial;
                                $contado = $contado_e - $contado;
                                $cr1 = $cr1_e - $cr1;
                                $cr2 = $cr2_e - $cr2;
                             ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <br>
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-4">
                                        <h2 align="center"> <strong>Costo:</strong> <?php echo "$".number_format($costo,2,'.',','); ?></h2>
                                    </div>
                                    <div class="col-lg-4">
                                        <h2 align="center"> <strong>Costo real:</strong> <?php echo "$".number_format($costo_real,2,'.',','); ?></h2>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <h3 align="center"> <strong>Contado:</strong> <?php echo "$".number_format($contado,0,'.',','); ?></h3>
                                    </div>
                                    <div class="col-lg-3">
                                        <h3 align="center"> <strong>Especial:</strong> <?php echo "$".number_format($especial,0,'.',','); ?></h3>
                                    </div>
                                    <div class="col-lg-3">
                                        <h3 align="center"> <strong>CR1:</strong> <?php echo "$".number_format($cr1,0,'.',','); ?></h3>
                                    </div>
                                    <div class="col-lg-3">
                                        <h3 align="center"> <strong>CR2:</strong> <?php echo "$".number_format($cr2,0,'.',','); ?></h3>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-7">
            <div class="card border h-30 shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                <h4><strong>Filtrado por sucursal</strong></h4>
                            </div>
                        </div>
                        <input id="tiene_subcat" name="tiene_subcat" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="secondary" data-size="m" data-on="SI" data-off="NO">
                    </div>
                </div>
            </div>
            <div class="card border h-30 shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                <h4><strong>Filtrado por almacén</strong></h4>

                            </div>
                        </div>
                        <input id="tiene_subcat" name="tiene_subcat" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="secondary" data-size="m" data-on="SI" data-off="NO">
                    </div>
                </div>
            </div>
            <div class="card border h-30 shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div align="right" class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                <button class="btn btn-primary"><h4><strong>Descargar CSV</strong></h4></button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

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
                <th>Proveedor</th>
                <th>Tel Proveedor</th>
                <th>Sucursal</th>
                <th>Almácen</th>
                <th>Productos</th>
                <th>Folio+Serie</th>
                <th>Stock.M</th>
                <th>Costo U. IVA</th>
                <th>Total IVA</th>
                <th>Costo U. Real</th>
                <th>Total Real</th>
                <th width="10">Trans</th>
                <!-- <th style="text-align: center;">Herramientas</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
            //SELECT identrada, comprador, entrada.tel_proveedor, fecha, folio_compra, entrada.sucursal, almacen, no_pagos, pago_parcial, subtotal1, iva, subtotal2, descuento, total, activo, proveedor.nombre_proveedor as proveedor, compra_tipo.nombre_compra as tipo_compra, almacen.nombre as almacen, sucursales.sucursales as sucursal, producto.identificador, entrada_productos.cantidad, entrada_productos_serie.serie, producto.idproducto FROM entrada INNER JOIN proveedor on proveedor.idproveedor = entrada.proveedor INNER JOIN compra_tipo on compra_tipo.idtipo_compra = entrada.tipo_compra INNER JOIN almacen on almacen.idalmacen = entrada.almacen INNER JOIN sucursales on sucursales.idsucursales = entrada.sucursal INNER JOIN entrada_productos on entrada_productos.entrada = entrada.identrada INNER JOIN producto on producto.idproducto = entrada_productos.producto INNER JOIN entrada_productos_serie on entrada_productos_serie.entrada_productos = entrada_productos.identrada_producto where borrado_logico = 0 AND entrada.activo = 1 order by entrada.activo
            $query = mysqli_query($conexion, "SELECT identrada_producto, entrada, producto.identificador, producto.idproducto, sum(cantidad) as cantidad, sum(precio_x_unidad) as precio_x_unidad, sum(precio_total) as precio_total, sum(precio_x_unidad_iva) as precio_x_unidad_iva, sum(precio_total_iva) as precio_total_iva, con_iva, almacen_actual, almacen.nombre as almacen, entrada.fecha, entrada.activo, entrada.folio_compra, entrada.tel_proveedor, proveedor.nombre_proveedor, sucursales.sucursales FROM entrada_productos INNER JOIN producto on producto.idproducto = entrada_productos.producto INNER JOIN almacen on almacen.idalmacen = entrada_productos.almacen_actual INNER JOIN entrada on entrada.identrada = entrada_productos.entrada INNER JOIN proveedor on proveedor.idproveedor = entrada.proveedor INNER JOIN sucursales on sucursales.idsucursales = entrada.sucursal GROUP by producto.idproducto");
            $result = mysqli_num_rows($query);
            if ($result > 0) 
            {
                while ($data = mysqli_fetch_assoc($query)) 
                {
                    if ($data['activo'] == 1) {
                        $estado = '<span class="badge badge-pill badge-success">Activo</span>';
                    } else {
                        $estado = '<span class="badge badge-pill badge-danger">Suspendido</span>';
                    }
                    $identrada_producto = $data['identrada_producto'];
                    
                    $id_producto = $data['idproducto'];
                    $query_stock = mysqli_query($conexion, "SELECT en_stock from producto where idproducto = '$id_producto'");
                    $en_stock = floatval(mysqli_fetch_assoc($query_stock)['en_stock']);
                    $precio_unidad = $data['precio_x_unidad_iva'];
                    if($data['cantidad'] == 1)
                    {
                        $total_real = $data['precio_total_iva'];
                        $query_serie = mysqli_query($conexion, "SELECT entrada_productos_serie.serie as serie from entrada_productos_serie where entrada_productos = '$identrada_producto'");
                        $serie = mysqli_fetch_assoc($query_serie)['serie'];
                        $series = $data['folio_compra']."-".$serie;
                        //calcular precio a costo de la tabla productos
                        $query_costos = mysqli_query($conexion, "SELECT costo_iva, costo_contado, costo_especial, costo_cr1, costo_cr2 from producto where idproducto = '$id_producto'");
                        $costo_tabla = mysqli_fetch_assoc($query_costos)['costo_iva'];
                    }
                    else
                    {
                       //SELECT costo_iva from producto where idproducto = '929893e5-0839-11ed-8a78-feed01260033'
                       //$query_series = mysqli_query($conexion, "");

                    }
                    ?>
                    <tr>
                        <td><?php echo $data['fecha']; ?></td>
                        <td><?php echo $data['nombre_proveedor']; ?></td>
                        <td><?php echo $data['tel_proveedor']; ?></td>
                        <td><?php echo $data['sucursales'];  ?></td>
                        <td><?php echo $data['almacen']; ?></td>
                        <td><?php echo $data['identificador']; ?></td>
                        <td><?php echo $series; ?></td>
                        <td><?php echo $en_stock ?></td>
                        <td><?php echo "$".number_format($costo_tabla,2,'.',','); ?></td>
                        <td><?php echo "$".number_format($costo_tabla*$en_stock,2,'.',','); ?></td>
                        <td><?php echo "$".number_format($precio_unidad,2,'.',','); ?></td>
                        <td><?php echo "$".number_format($total_real,2,'.',','); ?></td>
                        <td width="10" align="center">
                                <button onClick='eliminar_inventario()' class='btn btn-primary btn-sm' type='submit'><i style='color: white;' class='fas fa-exchange-alt'></i></button>
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
