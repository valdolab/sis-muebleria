<?php 
ob_start();
include_once "header.php";
include "accion/conexion.php";


?>
<!--</div>-->

<div id="nueva_zona" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg text-black">
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

<div id="nueva_subzona" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg text-black">
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
            <div class="modal-header bg text-black">
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

<!-- agregar tipo de venta -->
<div id="nuevo_tipo_venta" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg text-black">
                <h5 class="modal-title" id="my-modal-title">Agregar tipo de venta</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="on" id="formAdd_tipo_venta">
                    <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="correo">Tipo de venta</label>
                            <input type="text" class="form-control" name="nuevatipo_venta" id="nuevatipo_venta" required maxlength="99">
                        </div>  
                        </div>
                    </div>

                    <input value="insert_tipo_venta" name="action" id="action" hidden>
                    <input value="nuevo_tipo_de_venta" name="flagid_tipoVenta" id="flagid_tipoVenta" hidden>
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
            <h2><strong>SALIDAS</strong></h2>
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

<form action="" method="post" autocomplete="on" id="formAdd_salida">
<div class="col-lg-12">
<div class="card"> 
            <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-2">
                            <label for="id_cliente">ID Cliente</label>
                            <select class="form-control js-example-data-array" id="id_cliente" name="id_cliente">
                            <option selected hidden></option>
                                <?php 
                                    #codigo para la lista de idclientes que se extraen de la base de datos
                                    $result = mysqli_query($conexion,"SELECT idcliente,no_cliente FROM cliente order by no_cliente");                        
                                    if (mysqli_num_rows($result) > 0) 
                                    {  
                                      while($row = mysqli_fetch_assoc($result))
                                      {
                                        $long_formato_idcliente = 4;
                                        $sizeno_cliente = strlen($row["no_cliente"]);
                                        $ceros = "";
                                        for ($i=0; $i < $long_formato_idcliente-$sizeno_cliente; $i++) 
                                        { 
                                            $ceros = $ceros."0";
                                        }
                                        echo "<option value='".$row["idcliente"]."'>".$ceros.$row["no_cliente"]."</option>";
                                      }
                                    }
                                 ?>
                            </select>
                            <!--
                            <input onkeyup="mayusculas(this)" type="text" class="form-control" placeholder="Buscar por ID cliente" name="id_cliente" id="id_cliente"> -->
                        </div>

                        <div class="form-group col-lg-4">
                            <label for="nombre_aval">Cliente</label>
                            <select class="form-control js-example-data-array" id="nom_cliente" name="nom_cliente">
                            <option selected hidden></option>
                                <?php 
                                    #codigo para la lista de idclientes que se extraen de la base de datos
                                    $result = mysqli_query($conexion,"SELECT idcliente,nombre_cliente,no_cliente FROM cliente order by no_cliente");                        
                                    if (mysqli_num_rows($result) > 0) {  
                                      while($row = mysqli_fetch_assoc($result))
                                      {
                                        echo "<option value='".$row["idcliente"]."'>".$row["nombre_cliente"]."</option>";
                                      }
                                    }
                                 ?>
                            </select>
                            <!--
                            <input type="text" class="form-control" placeholder="Buscar por nombre del cliente" name="nom_cliente" id="nom_cliente"> -->
                        </div>

                        <div class="form-group col-lg-2">
                            <label for="domicilio_aval">Teléfono</label>
                            <input type="text" class="form-control" placeholder="exp. 9610000000" name="tel_cliente" id="tel_cliente" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="trabajo_aval">Fecha</label>
                            <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" placeholder="" name="fecha" id="fecha">
                        </div>

                        <div class="col-lg-2">
                            <label for="zona">Zona</label>
                             <?php 
                                if($_SESSION['rol'] == "SuperAdmin" or $_SESSION['rol'] == "Administrador")
                                {
                                    ?>
                                    <button data-toggle="modal" data-target="#nueva_zona" title="Agregar nueva zona" class="btn btn-primary btn-xs" type="button" href="#" ><i class="fas fa-plus"></i></button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <button disabled="disabled" title="Agregar nueva zona" class="btn btn-primary btn-xs" type="button"><i class="fas fa-plus"></i></button>
                                    <?php 
                                } 
                             ?>
                            <select class="form-control" id="zona" name="zona" required>
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

                        <div class="form-group col-lg-2">
                            <label for="subzona">Subzona</label>
                            <?php 
                                if($_SESSION['rol'] == "SuperAdmin" or $_SESSION['rol'] == "Administrador")
                                {
                                    ?>
                                    <button data-toggle="modal" data-target="#nueva_subzona" title="Agregar nueva subzona" class="btn btn-primary btn-xs" type="button" href="#" ><i class="fas fa-plus"></i></button>
                                    <button disabled id="btnedit_subzona" data-toggle="modal" data-target="#editar_subzona" onclick="editar_subzona();" title="editar subzona" class="btn btn-success btn-xs" type="button" href="#" ><i class="fas fa-edit"></i></button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <button disabled="disabled" title="Agregar nueva subzona" class="btn btn-primary btn-xs" type="button"><i class="fas fa-plus"></i></button>
                                    <button disabled="disabled" title="editar subzona" class="btn btn-success btn-xs" type="button"><i class="fas fa-edit"></i></button>
                                    <?php 
                                } 
                             ?>

                            <select id='subzona' name='subzona' class='form-control' required>
                                <option selected hidden value=''>Seleccione una colonia (subzona)</option>
                            </select> 
                        </div>

                        <div class="form-group col-lg-2">
                            <label for="folio_venta">Folio de venta</label>
                            <input type="text" class="form-control" name="folio_venta" id="folio_venta">
                        </div>
                        
                        <div class="form-group col-lg-3">
                            <label for="tipo_venta">Tipo de venta</label>
                            <?php 
                                if($_SESSION['rol'] == "SuperAdmin" or $_SESSION['rol'] == "Administrador")
                                {
                                    ?>
                                    <button data-toggle="modal" onclick="nuevo_tipo_venta();" data-target="#nuevo_tipo_venta" title="Agregar nuevo tipo de venta" class="btn btn-primary btn-xs" type="button" href="#" ><i class="fas fa-plus"></i></button>
                                    <button disabled data-toggle="modal" data-target="#nuevo_tipo_venta" id="btnedit_tipo_venta" onclick="editar_tipo_venta();" title="editar tipo de venta" class="btn btn-success btn-xs" type="button" href="#" ><i class="fas fa-edit"></i></button>
                                    <button disabled id="btneliminar_tipo_venta" onclick="eliminar_tipo_venta();" title="Eliminar tipo de venta" class="btn btn-danger btn-xs" type="button" href="#" ><i class="fas fa-trash"></i></button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <button disabled="disabled" title="Agregar nuevo tipo de venta" class="btn btn-primary btn-xs" type="button"><i class="fas fa-plus"></i></button>
                                    <button disabled title="editar tipo de venta" class="btn btn-success btn-xs" type="button" href="#" ><i class="fas fa-edit"></i></button>
                                    <button disabled title="Eliminar tipo de venta" class="btn btn-danger btn-xs" type="button"><i class="fas fa-trash"></i></button>
                                    <?php 
                                } 
                             ?>
                            <select id='tipo_venta' name='tipo_venta' class='form-control' required>
                                <option selected hidden value=''>Seleccione un tipo</option>
                                <?php
                                $result = mysqli_query($conexion,"SELECT idtipo_venta,nombre_venta FROM venta_tipo");                        
                                if (mysqli_num_rows($result) > 0) {  
                                  while($row = mysqli_fetch_assoc($result))
                                  {
                                    echo "<option value='".$row["idtipo_venta"]."'>".$row["nombre_venta"]."</option>";
                                  }
                                }
                                ?>
                            </select> 
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="puesto_aval">Modalidad de pagos</label>
                            <select id='modalidad_pago' name='modalidad_pago' class='form-control' required>
                                <option selected hidden value=''>Seleccione una modalidad</option>
                                <option value='semanal'>Semanal</option>
                                <option value='quincenal'>Quincenal</option>
                                <option value='mensual'>Mensual</option>
                            </select> 
                        </div>

                        <div class="form-group col-lg-1">
                            <label for="n_pagos">No. pagos</label>
                            <input type="text" class="form-control" name="n_pagos" id="n_pagos">
                        </div>

                        <div class="form-group col-lg-2">
                            <label for="pago_parcial">Pago parcial</label>
                            <input type="text" class="form-control" name="pago_parcial" id="pago_parcial">
                        </div>

                        <div class="form-group col-lg-2">
                            <label for="n_pagos">1er día de pago</label>
                            <input type="date" class="form-control" name="n_pagos" id="n_pagos">
                        </div>

                        <div class="form-group col-lg-2">
                            <label for="dias_pago_semanal">Días de pago semanal</label>
                            <select id='dias_pago_semanal' name='dias_pago_semanal' class='form-control' disabled required>
                                <option selected hidden value=''>Seleccione una opción</option>
                                <option value="lu">Lunes</option>
                                <option value="ma">Martes</option>
                                <option value="mi">Miercoles</option>
                                <option value="ju">Jueves</option>
                                <option value="vi">Viernes</option>
                                <option value="sa">Sábado</option>
                                <option value="do">Domingo</option>
                            </select> 
                        </div>

                        <div class="form-group col-lg">
                            <label for="dias_pago_quincenal">Día de pago quin</label>
                            <input type="number" class="form-control" name="dias_pago_quincenal" id="dias_pago_quincenal" disabled required>
                        </div>

                        <div class="form-group col-lg">
                            <label for="dias_pago_mensual">Día de pago mensual</label>
                            <input type="number" class="form-control" name="dias_pago_mensual" id="dias_pago_mensual" disabled required>
                        </div>

                        <div align="right" class="form-group col-lg">
                            <br>
                            <a onclick="add_salida()" class="btn btn-lg btn-primary" type="button" ><i class="fas fa-plus"></i> Añadir</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
<!-- aqui va los añadidios dinamicos de las salidas -->
<div id="lista_salida">
    
</div>
<!--
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="identificador_pro">Identificador</label>
                            <select class="form-control js-example-data-array" id="identificador_pro" name="identificador_pro">
                            <option selected hidden></option>
                                <?php 
                                    #codigo para la lista de idclientes que se extraen de la base de datos
                                    $result = mysqli_query($conexion,"SELECT idproducto,identificador FROM producto order by identificador");                        
                                    if (mysqli_num_rows($result) > 0) 
                                    {  
                                      while($row = mysqli_fetch_assoc($result))
                                      {
                                        echo "<option value='".$row["idproducto"]."'>".$row["identificador"]."</option>";
                                      }
                                    }
                                 ?>
                            </select>
                        </div>

                        <div class="col-lg-2">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" class="form-control" name="cantidad" id="cantidad">
                        </div>
                        <div class="col-lg-2">
                            <label for="origen">Origen</label>
                            <input type="text" class="form-control" name="origen" id="origen" onkeyup="mayusculas(this)">
                        </div>
                        <div class="col-lg-2">
                            <label for="ingresos_cliente">Precio</label>

                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="precio" id="precio" type="number" class="form-control" aria-label="Monto en pesos mexicanos">
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <label for="serializado">Incluye IVA</label>
                            <input onchange="" id="incluye_iva" name="incluye_iva" value="si_iva" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="secondary" data-size="m" data-on="SI" data-off="NO">
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
-->

</form>
<br><br>

<script type="text/javascript">

//funcion para poner mayusculas los inputs
function mayusculas(e) {
    e.value = e.value.toUpperCase();
}

document.getElementById('divzoom').style.zoom = "100%";
document.getElementById('page-top').style.zoom = "80%";

</script>

<?php 
ob_end_flush();
include_once "footer.php"; 
?>
