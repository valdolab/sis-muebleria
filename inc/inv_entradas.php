<?php 
ob_start();
include_once "header.php";
include "accion/conexion.php";


?>

<div id="nueva_zona" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Agregar nueva zona</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="on" id="formAdd_zona">
                    <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="correo">Nueva zona</label>
                            <input type="text" class="form-control" name="nuevazona" id="nuevazona" required maxlength="99">
                        </div>  
                        </div>
                    </div>

                    <input value="insert_zona" name="action" id="action" hidden>
                    <div align="right">
                        <input type="submit" value="Agregar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="editar_zona" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Editar zona</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="on" id="formEdit_zona">
                    <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="correo">zona</label>
                            <input type="text" name="idnewzona_edit" id="idnewzona_edit" hidden>
                            <input type="text" class="form-control" name="newzona_edit" id="newzona_edit" required maxlength="99">
                        </div>  
                        </div>
                    </div>

                    <input value="edit_zona" name="action" id="action" hidden>
                    <div align="right">
                        <input type="submit" value="Actualizar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="nueva_subzona" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Nueva subzona (Colonia)</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="on" id="formAdd_subzona">
                    <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="correo">Nueva subzona</label>
                            <input type="text" class="form-control" name="nuevasubzona" id="nuevasubzona" required maxlength="99">
                        </div>  
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="correo">Pertenece a la zona:</label>
                            <select class="form-control" id="zona_subzona" name="zona_subzona" required>
                                <option selected hidden>Seleccione una opción</option>
                                <?php
                                #codigo para la lista de sucursales que se extraen de la base de datos
                                $result = mysqli_query($conexion,"SELECT idzona,zona FROM zonas");                        
                                if (mysqli_num_rows($result) > 0) {  
                                  while($row = mysqli_fetch_assoc($result))
                                  {
                                    echo "<option value='".$row["idzona"]."'>".$row["zona"]."</option>";
                                  }
                                }
                                ?>
                              </select>
                        </div>  
                        </div>
                    </div>

                    <input value="insert_subzona" name="action" id="action" hidden>
                    <div align="right">
                        <input type="submit" value="Agregar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="editar_subzona" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Editar subzona (Colonia)</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="off" id="formEdit_subzona">
                    <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="correo">subzona</label>
                            <input type="text" name="idnewsubzona_edit" id="idnewsubzona_edit" hidden>
                            <input type="text" class="form-control" name="newsubzona_edit" id="newsubzona_edit" required maxlength="99">
                        </div>  
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="correo">Pertenece a la zona:</label>
                            <select class="form-control" id="zona_subzona_edit" name="zona_subzona_edit" required>
                                <?php
                                #codigo para la lista de sucursales que se extraen de la base de datos
                                $result = mysqli_query($conexion,"SELECT idzona,zona FROM zonas");                        
                                if (mysqli_num_rows($result) > 0) {  
                                  while($row = mysqli_fetch_assoc($result))
                                  {
                                    echo "<option value='".$row["idzona"]."'>".$row["zona"]."</option>";
                                  }
                                }
                                ?>
                              </select>
                        </div>  
                        </div>
                    </div>

                    <input value="edit_subzona" name="action" id="action" hidden>
                    <div align="right">
                        <input type="submit" value="Agregar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- agregar tipo de compra -->
<div id="nuevo_tipo_compra" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg text-black">
                <h5 class="modal-title" id="my-modal-title">Agregar tipo de compra</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="on" id="formAdd_tipo_compra">
                    <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="correo">Tipo de compra</label>
                            <input type="text" class="form-control" name="nuevatipo_compra" id="nuevatipo_compra" required maxlength="99">
                        </div>  
                        </div>
                    </div>

                    <input value="insert_tipo_compra" name="action" id="action" hidden>
                    <input value="nuevo_tipo_de_compra" name="flagid_tipoCompra" id="flagid_tipoCompra" hidden>
                    <div align="right">
                        <input type="submit" value="Agregar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- agregar proveedor -->
<div id="nuevo_proveedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg text-black">
                <h5 class="modal-title" id="my-modal-title">Agregar nuevo proveedor</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="on" id="formAdd_proveedor">
                    <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="correo">Proveedor</label>
                            <input type="text" class="form-control" name="nuevoProveedor" id="nuevoProveedor" required maxlength="99">
                        </div>  
                        </div>
                    </div>

                    <input value="insert_proveedor" name="action" id="action" hidden>
                    <input value="nuevo_proveedor" name="flagid_Proveedor" id="flagid_Proveedor" hidden>
                    <div align="right">
                        <input type="submit" value="Agregar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="prueba">
</div>

<div class="col-lg-12">

<div class="card">
<div class="card-body">
    <div class="row">
        <div class="col-lg-10">
            <h2><strong>ENTRADAS</strong></h2>
            <!--<input type="" name="prueba" id="prueba">-->
        </div>

        <div align="right" class="col-lg-2">
            <!-- <a data-toggle="modal" data-target="#nuevo_documento"  class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Nuevo documento</a> -->
        </div>
    </div>
</div>
</div>
</div>

<br>

<div class="row">
<div class="col-lg-1"></div>
<div class="col-lg-10">
<div class="card"> 
            <div class="card-body">
                    <div class="row">

                        <div class="form-group col-lg-5">
                            <label for="nombre_aval">Proveedor</label>
                            <?php 
                                if($_SESSION['rol'] == "SuperAdmin" or $_SESSION['rol'] == "Administrador")
                                {
                                    ?>
                                    <button data-toggle="modal" data-target="#nuevo_proveedor" onclick="nuevo_proveedor();" title="Agregar nuevo Proveedor" class="btn btn-primary btn-xs" type="button" href="#" ><i class="fas fa-plus"></i></button>
                                    <button disabled data-toggle="modal" data-target="#nuevo_proveedor" id="btnedit_proveedor" onclick="editar_proveedor();" title="editar proveedor" class="btn btn-success btn-xs" type="button" href="#" ><i class="fas fa-edit"></i></button>
                                    <button disabled id="btneliminar_proveedor" onclick="eliminar_proveedor();" title="Eliminar Proveedor" class="btn btn-danger btn-xs" type="button" href="#" ><i class="fas fa-trash"></i></button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <button disabled="disabled" title="Agregar nueva zona" class="btn btn-primary btn-xs" type="button"><i class="fas fa-plus"></i></button>
                                    <button disabled title="editar zona" class="btn btn-success btn-xs" type="button" href="#" ><i class="fas fa-edit"></i></button>
                                    <button disabled title="Eliminar zona" class="btn btn-danger btn-xs" type="button"><i class="fas fa-trash"></i></button>
                                    <?php 
                                } 
                             ?>
                                <select class="form-control" id="proveedor" name="proveedor" required>
                                <option selected hidden>Seleccione una opción</option>
                                <?php
                                $result = mysqli_query($conexion,"SELECT idproveedor,nombre_proveedor FROM proveedor");                        
                                if (mysqli_num_rows($result) > 0) {  
                                  while($row = mysqli_fetch_assoc($result))
                                  {
                                    echo "<option value='".$row["idproveedor"]."'>".$row["nombre_proveedor"]."</option>";
                                  }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-lg-2">
                            <label for="domicilio_aval">Teléfono</label>
                            <input type="text" class="form-control" placeholder="exp. 9610000000" name="tel_cliente" id="tel_cliente" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="trabajo_aval">Fecha</label>
                            <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" placeholder="" name="fecha" id="fecha">
                        </div>

                        <div class="form-group col-lg-2">
                            <label for="folio_venta">Folio de compra</label>
                            <input type="text" class="form-control" name="folio_venta" id="folio_venta">
                        </div>
                        
                        <div class="form-group col-lg-3">
                            <label for="puesto_aval">Tipo de compra</label>
                            <?php 
                                if($_SESSION['rol'] == "SuperAdmin" or $_SESSION['rol'] == "Administrador")
                                {
                                    ?>
                                    <button data-toggle="modal" onclick="nuevo_tipo_compra();" data-target="#nuevo_tipo_compra" title="Agregar nuevo tipo de compra" class="btn btn-primary btn-xs" type="button" href="#" ><i class="fas fa-plus"></i></button>
                                    <button disabled data-toggle="modal" data-target="#nuevo_tipo_compra" id="btnedit_tipo_compra" onclick="editar_tipo_compra();" title="editar tipo de compra" class="btn btn-success btn-xs" type="button" href="#" ><i class="fas fa-edit"></i></button>
                                    <button disabled id="btneliminar_tipo_compra" onclick="eliminar_tipo_compra();" title="Eliminar tipo de compra" class="btn btn-danger btn-xs" type="button" href="#" ><i class="fas fa-trash"></i></button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <button disabled="disabled" title="Agregar nuevo tipo de compra" class="btn btn-primary btn-xs" type="button"><i class="fas fa-plus"></i></button>
                                    <button disabled title="editar tipo de compra" class="btn btn-success btn-xs" type="button" href="#" ><i class="fas fa-edit"></i></button>
                                    <button disabled title="Eliminar tipo de compra" class="btn btn-danger btn-xs" type="button"><i class="fas fa-trash"></i></button>
                                    <?php 
                                } 
                             ?>

                            <select id='tipo_compra' name='tipo_compra' class='form-control' required>
                                <option selected hidden value=''>Seleccione un tipo</option>
                                <?php
                                $result = mysqli_query($conexion,"SELECT idtipo_compra,nombre_compra FROM compra_tipo");                        
                                if (mysqli_num_rows($result) > 0) {  
                                  while($row = mysqli_fetch_assoc($result))
                                  {
                                    echo "<option value='".$row["idtipo_compra"]."'>".$row["nombre_compra"]."</option>";
                                  }
                                }
                                ?>
                            </select> 
                        </div>

                        <div class="form-group col-lg-2">
                          <label>Sucursal</label>
                          <select class="form-control" id="sucursal" name="sucursal" required>
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

                        <div class="form-group col-lg-2">
                          <label>Almacen</label>
                          <select class="form-control" id="almacen" name="almacen" required>
                            <option id="opAlmacen" value="" hidden selected>Seleccione una opción</option>
                            <?php
                            #codigo para la lista de sucursales que se extraen de la base de datos
                            $result = mysqli_query($conexion,"SELECT idalmacen,nombre FROM almacen");                        
                            if (mysqli_num_rows($result) > 0) {  
                              while($row = mysqli_fetch_assoc($result)){
                              echo "<option value='".$row["idalmacen"]."'>".$row["nombre"]."</option>";
                              }
                            }
                            ?>                        
                          </select>
                        </div>

                        <div class="form-group col-lg-1">
                            <label for="n_pagos">No. pagos</label>
                            <input type="number" class="form-control" name="n_pagos" id="n_pagos">
                        </div>

                        <div class="form-group col-lg-2">
                            <label for="pago_parcial">Pago parcial</label>
                            <input type="text" class="form-control" name="pago_parcial" id="pago_parcial">
                        </div>

                        <div align="right" class="form-group col-lg-2">
                            <br>
                            <button class="btn btn-lg btn-primary" id="add_venta">Añadir</button>
                        </div>

                    </div>
            </div>
        </div>
    </div>
</div>

<br>

<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-10">
                        
                </div>

                <div align="right" class="col-lg-2">
                    <!-- <a data-toggle="modal" data-target="#nuevo_documento"  class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Nuevo documento</a> -->
                </div>
            </div>
        </div>
        </div>  
    </div>
</div>

<br><br>

<script type="text/javascript">

//funcion para poner mayusculas los inputs
function mayusculas(e) {
    e.value = e.value.toUpperCase();
}

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
