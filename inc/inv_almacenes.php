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

                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Costo:
                                <br>
                                <h2 align="center">$24,000</h2>
                                <br>
                                <br>
                                Contado:
                                <br>
                                <h2 align="center">$44,000</h2>
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
                <th>Categoría</th>
                <th>Subcategoría</th>
                <th>Modelo</th>
                <th>Sucursal</th>
                <th>Almacén</th>
                <th>Stock M</th>
                <th>Costo + IVA</th>
                <th>Costo contado</th>
                <th>Costo cr1</th>
                <th width="10">Trans</th>
                <!-- <th style="text-align: center;">Herramientas</th> -->
            </tr>
        </thead>
        <tbody>
                    <tr>
                        <td>Linea blanca</td>
                        <td>Lavadora</td>
                        <td>asd</td>
                        <td>TODAS</td>
                        <td>TODAS</td>
                        <td>6</td>
                        <td>$6,000</td>
                        <td>$12,000</td>
                        <td>$12,000</td>
                        <td width="10" align="center">
                                <button onClick='eliminar_inventario()' class='btn btn-primary btn-sm' type='submit'><i style='color: white;' class='fas fa-exchange-alt'></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Linea blanca</td>
                        <td>Lavadora</td>
                        <td>asd2</td>
                        <td>TODAS</td>
                        <td>TODAS</td>
                        <td>6</td>
                        <td>$6,000</td>
                        <td>$12,000</td>
                        <td>$12,000</td>
                        <td width="10" align="center">
                                <button onClick='eliminar_inventario()' class='btn btn-primary btn-sm' type='submit'><i style='color: white;' class='fas fa-exchange-alt'></i></button>
                        </td>
                    </tr>
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
