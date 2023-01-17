<?php 
ob_start();
include_once "header.php";
include "accion/conexion.php";


?>

<div class="col-lg-12">

<div class="card">
<div class="card-body">
    <div class="row">
        <div class="col-lg-6">
            <h2><strong>LISTA DE ENTRADAS</strong></h2>
            <!--<input type="" name="prueba" id="prueba">-->
        </div>

        <div align="right" class="col-lg-6">
            <?php 
                $query_t = mysqli_query($conexion, "SELECT sum(total) as total from entrada");
                $total_total = mysqli_fetch_assoc($query_t)['total'];
             ?>
            <h3><strong>Total:</strong></h3><h2><?php echo "$".number_format($total_total,2,'.',','); ?></h2>
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
                <th width="70">Fecha</th>
                <th>Proveedor</th>
                <th>Tel. Proveedor</th>
                <th>Folio</th>
                <th>Tipo de compra</th>
                <th>Sucursal</th>
                <th>Almácen</th>
                <th>Num Prod</th>
                <th>No. Pagos</th>
                <th>Pago parcial</th>
                <th>SubTotal</th>
                <th>IVA</th>
                <th>Descuento</th>
                <th>TOTAL</th>
                <th>Estatus</th>
                <th style="text-align: center;">Herramientas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conexion, "SELECT identrada, comprador, entrada.tel_proveedor, fecha, folio_compra, entrada.sucursal, almacen, no_pagos, pago_parcial, subtotal1, iva, subtotal2, descuento, total, activo, proveedor.nombre_proveedor as proveedor, compra_tipo.nombre_compra as tipo_compra, almacen.nombre as almacen, sucursales.sucursales as sucursal FROM entrada INNER JOIN proveedor on proveedor.idproveedor = entrada.proveedor INNER JOIN compra_tipo on compra_tipo.idtipo_compra = entrada.tipo_compra INNER JOIN almacen on almacen.idalmacen = entrada.almacen INNER JOIN sucursales on sucursales.idsucursales = entrada.sucursal where borrado_logico = 0 order by entrada.activo");
            $result = mysqli_num_rows($query);

            if ($result > 0) 
            {
                while ($data = mysqli_fetch_assoc($query)) 
                {
                    $identrada = $data['identrada'];
                    $num_prod = mysqli_query($conexion, "SELECT sum(cantidad) as num from entrada_productos where entrada = '$identrada'");
                    $num_productos_de_esa_entrada = mysqli_fetch_assoc($num_prod)['num'];

                    $identrada = $data['identrada'];
                    if ($data['activo'] == 1) {
                        $estado = '<span class="badge badge-pill badge-success">Activo</span>';
                    } else {
                        $estado = '<span class="badge badge-pill badge-danger">Suspendido</span>';
                    }?>
                    <tr>
                        <td><?php echo $data['fecha']; ?></td>
                        <td><?php echo $data['proveedor']; ?></td>
                        <td><?php echo $data['tel_proveedor']; ?></td>
                        <td><?php echo $data['folio_compra']; ?></td>
                        <td><?php echo $data['tipo_compra']; ?></td>
                        <td><?php echo $data['sucursal'];  ?></td>
                        <td><?php echo $data['almacen']; ?></td>
                        <td><?php echo $num_productos_de_esa_entrada; ?></td>
                        <td><?php echo $data['no_pagos']; ?></td>
                        <td><?php echo "$".number_format($data['pago_parcial'],2,'.',','); ?></td>
                        <td><?php echo "$".number_format($data['subtotal1'],2,'.',','); ?></td>
                        <td><?php echo "$".number_format($data['iva'],2,'.',','); ?></td>
                        <td><?php echo "$".number_format($data['descuento'],2,'.',','); ?></td>
                        <td><?php echo "$".number_format($data['total'],2,'.',','); ?></td>
                        <td><?php echo $estado ?></td>
                        <td align="center">
                                <a href="" class="btn btn-success btn-sm"><i class='fas fa-edit'></i></a>
                                <button onClick='suspender_entrada("<?php echo $identrada; ?>")' class='btn btn-warning btn-sm' type='submit'><i style='color: white;' class='fas fa-power-off'></i></button>
                                <!--<button onClick='eliminar_entrada("<?php echo $identrada; ?>")' class='btn btn-danger btn-sm' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>-->
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
