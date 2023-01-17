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
            <h3><strong>SALIDAS</strong></h3>
            <!--<input type="" name="prueba" id="prueba">-->
        </div>

        <div align="right" class="col-lg-2">
            <a href="lista_salidas.php" class="btn btn-primary" type="button" ><i class="fas fa-list"></i> Salidas realizadas</a>
        </div>
    </div>
</div>
</div>
</div>


<form action="" method="post" autocomplete="on" id="formAdd_salida">
<div class="col-lg-12">
<div class="card"> 
            <div class="card-body">
                    <div class="row">

                        <div class="col-lg-2">
                            <label for="vendedor">Vendedor</label>
                            <select class="form-control js-example-data-array" id="vendedor" name="vendedor">
                                <?php
                                #codigo para la lista de sucursales que se extraen de la base de datos
                                $result = mysqli_query($conexion,"SELECT idusuario,usuario_acceso,nombre FROM usuario order by usuario_acceso desc");                        
                                if (mysqli_num_rows($result) > 0) {  
                                  while($row = mysqli_fetch_assoc($result))
                                  {
                                    if($_SESSION['iduser'] == $row["idusuario"])
                                    {
                                        echo "<option selected value='".$row["idusuario"]."'>".$row["usuario_acceso"]."</option>";
                                    }
                                    else
                                    {
                                        echo "<option value='".$row["idusuario"]."'>".$row["usuario_acceso"]."</option>";
                                    }
                                  }
                                }
                                ?>
                              </select>
                        </div>

                        <div class="form-group col-lg-2">
                            <label for="id_cliente">ID Cliente</label>
                            <select class="form-control js-example-data-array" id="id_cliente" name="id_cliente" required>
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

                        <div class="form-group col-lg-3">
                            <label for="nombre_aval">Cliente</label>
                            <select class="form-control js-example-data-array" id="nom_cliente" name="nom_cliente" required>
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
                            <input disabled type="text" class="form-control" placeholder="exp. 9610000000" name="tel_cliente" id="tel_cliente" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
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
                            <select disabled class="form-control" id="zona" name="zona">
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

                            <select disabled id='subzona' name='subzona' class='form-control'>
                                <option selected hidden value=''>Seleccione una colonia (subzona)</option>
                            </select> 
                        </div>

                        <div class="form-group col-lg-2">
                            <label for="tipo_documento">Tipo documento</label>
                            <select id='tipo_documento' name='tipo_documento' class='form-control' required>
                                <option selected hidden value="0">Seleccione un documento</option>
                                <?php
                                #codigo para la lista de documentos
                                $id_sucursal = $_SESSION['idsucursal'];
                                $result = mysqli_query($conexion,"SELECT iddocumento,name_documento,folio,serie,idsucursal FROM documento where idsucursal = '$id_sucursal'");                        
                                if (mysqli_num_rows($result) > 0) 
                                {
                                  while($row = mysqli_fetch_assoc($result))
                                  {
                                    echo "<option value='".$row["iddocumento"]."' data-folio='".$row["folio"]."' data-serie='".$row["serie"]."'>".$row["name_documento"]."</option>";
                                  }
                                }
                                ?>
                            </select> 
                        </div>

                        <div class="form-group col-lg-2">
                            <label for="folio_venta">Folio de venta</label>
                            <input readonly type="text" class="form-control" name="folio_venta" id="folio_venta">
                            <input hidden readonly type="number" name="folio_venta_serie" id="folio_venta_serie">
                        </div>
                        
                        <div class="form-group col-lg-2">
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

                        <div class="form-group col-lg-2">
                            <label for="puesto_aval">Modalidad de pagos</label>
                            <select id='modalidad_pago' name='modalidad_pago' class='form-control' required>
                                <option selected hidden value=''>Seleccione una modalidad</option>
                                <option value='semanal'>Semanal</option>
                                <option value='quincenal'>Quincenal</option>
                                <option value='mensual'>Mensual</option>
                            </select> 
                        </div>

                        <div class="form-group col-lg">
                            <label for="n_pagos">No. pagos</label>
                            <input type="number" class="form-control" name="n_pagos" id="n_pagos" step="any">
                        </div>

                        <div class="form-group col-lg">
                            <label for="pago_parcial">Pago parcial</label>
                            <input type="number" class="form-control" name="pago_parcial" id="pago_parcial" step="any">
                        </div>

                        <div class="form-group col-lg-2">
                            <label for="n_pagos">1er día de pago</label>
                            <input type="date" class="form-control" name="primer_dia_pago" id="primer_dia_pago" required>
                        </div>

                        <div class="form-group col-lg">
                            <label for="dias_pago_semanal">Semanal</label>
                            <select id='dias_pago_semanal' name='dias_pago_semanal' class='form-control' disabled>
                                <option selected hidden value=''>Seleccione una opción</option>
                                <option value="lunes">Lunes</option>
                                <option value="martes">Martes</option>
                                <option value="miercoles">Miercoles</option>
                                <option value="jueves">Jueves</option>
                                <option value="viernes">Viernes</option>
                                <option value="sabado">Sábado</option>
                                <option value="domingo">Domingo</option>
                            </select> 
                        </div>

                        <div class="form-group col-lg">
                            <label for="dias_pago_quincenal">Quincenal</label>
                            <input type="number" class="form-control" name="dias_pago_quincenal" id="dias_pago_quincenal" disabled>
                        </div>

                        <div class="form-group col-lg">
                            <label for="dias_pago_quincenal">Quincenal 2</label>
                            <input type="number" class="form-control" name="dias_pago_quincenal_2" id="dias_pago_quincenal_2" disabled>
                        </div>

                        <div class="form-group col-lg">
                            <label for="dias_pago_mensual">Mensual</label>
                            <input type="number" class="form-control" name="dias_pago_mensual" id="dias_pago_mensual" disabled>
                        </div>

                        <div class="form-group col-lg-1">
                            <label for="dias_pago_mensual">Enganche</label>
                            <input type="number" class="form-control" name="enganche_dado" id="enganche_dado" step="any">
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
<!-- ya no se hizo dinamicamente, lo que se muestra a continuacion NO ES UNA PRACTICA ADECUADA -->
<!-- se hizo así por fines rapidos y practicos, ya no habia mucho tiempo, y funciona para el poco uso que tendra-->
<!-- ya esta empezado lo de que sea dinamico, pero aun tiene varios bugs por arreglar, si tienen tiempo, haganlo bien, por si quieren intentar.... -->
<div id="lista_salida">
    <!-- card1 -->
    <div id="card_salida1" class="row" hidden>
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="identificador_pro">Identificador</label>
                            <select class="form-control js-example-data-array identificadorpro" id="identificador_pro_1" name="identificador_pro_1" onchange="cargar_series(1)">
                            <option value=0 selected hidden></option>
                            <?php 
                                    #solo mostrar los productos que tengan stock
                                    #codigo para la lista de idclientes que se extraen de la base de datos
                                    $result = mysqli_query($conexion,"SELECT idproducto,identificador,en_stock FROM producto order by identificador");                        
                                    if (mysqli_num_rows($result) > 0) 
                                    {  
                                      while($row = mysqli_fetch_assoc($result))
                                      {
                                        if($row["en_stock"] >= 1)
                                        {
                                            echo "<option value='".$row["idproducto"]."'>".$row["identificador"]."</option>";
                                        }
                                      }
                                    }
                                 ?>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <label for="cantidad">Cantidad</label>
                            <input onchange="multiplicar_precio(1)" type="number" value=1 class="form-control" name="cantidad_1" id="cantidad_1">
                        </div>
                        <div class="col-lg-3">
                            <label for="origen">Origen</label>
                            <!--<input type="text" class="form-control" name="origen_1" id="origen_1" onkeyup="mayusculas(this)"> -->

                            <div id="divorigen_1">
                                <select class="form-control js-example-data-array" id="origen_1" name="origen_1">
                                    <option value=0 selected hidden></option>
                                </select>
                            </div>

                            <div id="divorigen_multi_1" hidden>
                                <select class="form-control js-example-basic-multiple" id="origen_multi_1" name="origen_multi_1[]" multiple="multiple">
                                </select>
                            </div>

                        </div>
                        <div class="col-lg-2">
                            <label for="tipo_precio">Tipo de precio</label>
                              <select onchange="mostrar_precios(1)" class="form-control" id="tipo_precio_1" name="tipo_precio_1">
                                <option value=0 selected hidden></option>
                                <!--<option value="costo">Costo normal</option>
                                <option value="costo_iva">Costo </option>-->
                                <option value="costo_contado">Costo contado</option>
                                <option value="costo_especial">Costo especial</option>
                                <option value="costo_cr1">Costo credito 1</option>
                                <option value="costo_cr2">Costo credito 2</option>
                              </select>
                        </div>
                        <div class="col-lg-2">
                            <label for="precio">Precio</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="precio_1" id="precio_1" type="number" class="form-control" aria-label="Monto en pesos mexicanos" step="any">
                            </div>
                        </div>
                        <div class="col-lg-1" align="right">
                                <a href="#" onclick="borrar_card_salida(1)"><i style="color: red;" class="fas fa-trash-alt fa-2x"></i></a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fin card1 -->
    <!-- card2 -->
    <div id="card_salida2" class="row" hidden>
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="identificador_pro">Identificador</label>
                            <select class="form-control js-example-data-array identificadorpro" id="identificador_pro_2" name="identificador_pro_2"  onchange="cargar_series(2)">
                            <option value=0 selected hidden></option>
                            <?php 
                                    #solo mostrar los productos que tengan stock
                                    #codigo para la lista de idclientes que se extraen de la base de datos
                                    $result = mysqli_query($conexion,"SELECT idproducto,identificador,en_stock FROM producto order by identificador");                        
                                    if (mysqli_num_rows($result) > 0) 
                                    {  
                                      while($row = mysqli_fetch_assoc($result))
                                      {
                                        if($row["en_stock"] >= 1)
                                        {
                                            echo "<option value='".$row["idproducto"]."'>".$row["identificador"]."</option>";
                                        }
                                      }
                                    }
                                 ?>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <label for="cantidad">Cantidad</label>
                            <input onchange="multiplicar_precio(2)" type="number" value=1 class="form-control" name="cantidad_2" id="cantidad_2">
                        </div>
                        <div class="col-lg-3">
                            <label for="origen">Origen</label>
                            <!--<input type="text" class="form-control" name="origen_1" id="origen_1" onkeyup="mayusculas(this)"> -->
                            <div id="divorigen_2">
                                <select class="form-control js-example-data-array" id="origen_2" name="origen_2">
                                    <option value=0 selected hidden></option>
                                </select>
                            </div>

                            <div id="divorigen_multi_2" hidden>
                                <select class="form-control js-example-basic-multiple" id="origen_multi_2" name="origen_multi_2[]" multiple="multiple">
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label for="tipo_precio">Tipo de precio</label>
                              <select onchange="mostrar_precios(2)" class="form-control" id="tipo_precio_2" name="tipo_precio_2">
                                <option value=0 selected hidden></option>
                                <!--<option value="costo">Costo normal</option>
                                <option value="costo_iva">Costo </option>-->
                                <option value="costo_contado">Costo contado</option>
                                <option value="costo_especial">Costo especial</option>
                                <option value="costo_cr1">Costo credito 1</option>
                                <option value="costo_cr2">Costo credito 2</option>
                              </select>
                        </div>
                        <div class="col-lg-2">
                            <label for="precio">Precio</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="precio_2" id="precio_2" type="number" class="form-control" aria-label="Monto en pesos mexicanos">
                            </div>
                        </div>
                        <div class="col-lg-1" align="right">
                                <a href="#" onclick="borrar_card_salida(2)"><i style="color: red;" class="fas fa-trash-alt fa-2x"></i></a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fin card2 -->
    <!-- card3 -->
    <div id="card_salida3" class="row" hidden>
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="identificador_pro">Identificador</label>
                            <select class="form-control js-example-data-array identificadorpro" id="identificador_pro_3" name="identificador_pro_3">
                            <option value=0 selected hidden></option>
                            <?php 
                                    #solo mostrar los productos que tengan stock
                                    #codigo para la lista de idclientes que se extraen de la base de datos
                                    $result = mysqli_query($conexion,"SELECT idproducto,identificador,en_stock FROM producto order by identificador");                        
                                    if (mysqli_num_rows($result) > 0) 
                                    {  
                                      while($row = mysqli_fetch_assoc($result))
                                      {
                                        if($row["en_stock"] >= 1)
                                        {
                                            echo "<option value='".$row["idproducto"]."'>".$row["identificador"]."</option>";
                                        }
                                      }
                                    }
                                 ?>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <label for="cantidad">Cantidad</label>
                            <input onchange="multiplicar_precio(3)" type="number" value=1 class="form-control" name="cantidad_3" id="cantidad_3">
                        </div>
                        <div class="col-lg-3">
                            <label for="origen">Origen</label>
                            <div id="divorigen_3">
                                <select class="form-control js-example-data-array" id="origen_3" name="origen_3">
                                    <option value=0 selected hidden></option>
                                </select>
                            </div>

                            <div id="divorigen_multi_3" hidden>
                                <select class="form-control js-example-basic-multiple" id="origen_multi_3" name="origen_multi_3[]" multiple="multiple">
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label for="tipo_precio">Tipo de precio</label>
                              <select onchange="mostrar_precios(3)" class="form-control" id="tipo_precio_3" name="tipo_precio_3">
                                <option value=0 selected hidden></option>
                                <!--<option value="costo">Costo normal</option>
                                <option value="costo_iva">Costo </option>-->
                                <option value="costo_contado">Costo contado</option>
                                <option value="costo_especial">Costo especial</option>
                                <option value="costo_cr1">Costo credito 1</option>
                                <option value="costo_cr2">Costo credito 2</option>
                              </select>
                        </div>
                        <div class="col-lg-2">
                            <label for="precio">Precio</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="precio_3" id="precio_3" type="number" class="form-control" aria-label="Monto en pesos mexicanos">
                            </div>
                        </div>
                        <div class="col-lg-1" align="right">
                                <a href="#" onclick="borrar_card_salida(3)"><i style="color: red;" class="fas fa-trash-alt fa-2x"></i></a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fin card3 -->
    <!-- card4 -->
    <div id="card_salida4" class="row" hidden>
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="identificador_pro">Identificador</label>
                            <select class="form-control js-example-data-array identificadorpro" id="identificador_pro_4" name="identificador_pro_4">
                            <option value=0 selected hidden></option>
                            <?php 
                                    #solo mostrar los productos que tengan stock
                                    #codigo para la lista de idclientes que se extraen de la base de datos
                                    $result = mysqli_query($conexion,"SELECT idproducto,identificador,en_stock FROM producto order by identificador");                        
                                    if (mysqli_num_rows($result) > 0) 
                                    {  
                                      while($row = mysqli_fetch_assoc($result))
                                      {
                                        if($row["en_stock"] >= 1)
                                        {
                                            echo "<option value='".$row["idproducto"]."'>".$row["identificador"]."</option>";
                                        }
                                      }
                                    }
                                 ?>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <label for="cantidad">Cantidad</label>
                            <input onchange="multiplicar_precio(4)" type="number" value=1 class="form-control" name="cantidad_4" id="cantidad_4">
                        </div>
                        <div class="col-lg-3">
                            <label for="origen">Origen</label>
                            <div id="divorigen_4">
                                <select class="form-control js-example-data-array" id="origen_4" name="origen_4">
                                    <option value=0 selected hidden></option>
                                </select>
                            </div>

                            <div id="divorigen_multi_4" hidden>
                                <select class="form-control js-example-basic-multiple" id="origen_multi_4" name="origen_multi_4[]" multiple="multiple">
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label for="tipo_precio">Tipo de precio</label>
                              <select onchange="mostrar_precios(4)" class="form-control" id="tipo_precio_4" name="tipo_precio_4">
                                <option value=0 selected hidden></option>
                                <!--<option value="costo">Costo normal</option>
                                <option value="costo_iva">Costo </option>-->
                                <option value="costo_contado">Costo contado</option>
                                <option value="costo_especial">Costo especial</option>
                                <option value="costo_cr1">Costo credito 1</option>
                                <option value="costo_cr2">Costo credito 2</option>
                              </select>
                        </div>
                        <div class="col-lg-2">
                            <label for="precio">Precio</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="precio_4" id="precio_4" type="number" class="form-control" aria-label="Monto en pesos mexicanos">
                            </div>
                        </div>
                        <div class="col-lg-1" align="right">
                                <a href="#" onclick="borrar_card_salida(4)"><i style="color: red;" class="fas fa-trash-alt fa-2x"></i></a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fin card4 -->
    <!-- card5 -->
    <div id="card_salida5" class="row" hidden>
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="identificador_pro">Identificador</label>
                            <select class="form-control js-example-data-array identificadorpro" id="identificador_pro_5" name="identificador_pro_5">
                            <option value=0 selected hidden></option>
                            <?php 
                                    #solo mostrar los productos que tengan stock
                                    #codigo para la lista de idclientes que se extraen de la base de datos
                                    $result = mysqli_query($conexion,"SELECT idproducto,identificador,en_stock FROM producto order by identificador");                        
                                    if (mysqli_num_rows($result) > 0) 
                                    {  
                                      while($row = mysqli_fetch_assoc($result))
                                      {
                                        if($row["en_stock"] >= 1)
                                        {
                                            echo "<option value='".$row["idproducto"]."'>".$row["identificador"]."</option>";
                                        }
                                      }
                                    }
                                 ?>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <label for="cantidad">Cantidad</label>
                            <input onchange="multiplicar_precio(5)" type="number" value=1 class="form-control" name="cantidad_5" id="cantidad_5">
                        </div>
                        <div class="col-lg-3">
                            <label for="origen">Origen</label>
                            <div id="divorigen_5">
                                <select class="form-control js-example-data-array" id="origen_5" name="origen_5">
                                    <option value=0 selected hidden></option>
                                </select>
                            </div>

                            <div id="divorigen_multi_5" hidden>
                                <select class="form-control js-example-basic-multiple" id="origen_multi_5" name="origen_multi_5[]" multiple="multiple">
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label for="tipo_precio">Tipo de precio</label>
                              <select onchange="mostrar_precios(5)" class="form-control" id="tipo_precio_5" name="tipo_precio_5">
                                <option value=0 selected hidden></option>
                                <!--<option value="costo">Costo normal</option>
                                <option value="costo_iva">Costo </option>-->
                                <option value="costo_contado">Costo contado</option>
                                <option value="costo_especial">Costo especial</option>
                                <option value="costo_cr1">Costo credito 1</option>
                                <option value="costo_cr2">Costo credito 2</option>
                              </select>
                        </div>
                        <div class="col-lg-2">
                            <label for="precio">Precio</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="precio_5" id="precio_5" type="number" class="form-control" aria-label="Monto en pesos mexicanos">
                            </div>
                        </div>
                        <div class="col-lg-1" align="right">
                                <a href="#" onclick="borrar_card_salida(5)"><i style="color: red;" class="fas fa-trash-alt fa-2x"></i></a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fin card5 -->
</div>

<div id="costos_calculados" hidden>
    <div class="row">
        <div class="col-lg-9">
            <!-- 
            aqui va el costo calculado sin iva y sin descuento el primer subtotal
            -->
        </div>
        <div class="col-lg-2" align="right">
            <h4><strong id="subtotal1"></strong></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9" align="right">
            <h4>IVA</h4>
        </div>
        <div class="col-lg-2" align="right">
            <h4><strong id="ivas"></strong></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9" align="right">
            <h4>SubTotal</h4>
        </div>
        <div class="col-lg-2" align="right">
            <h4><strong id="subtotal2"></strong></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9" align="right">
            <h4>Descuento</h4>
        </div>
        <div class="col-lg-2" align="right">
            <input id="descuento_venta" type="number" name="descuento_venta" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9" align="right">
            <h3>TOTAL</h3>
        </div>
        <div class="col-lg-2" align="right" id="mostrar_total">
            <h3><strong id="total_general"></strong></h3>
        </div>
    </div>
    <input type="number" name="subtotal1_flag" id="subtotal1_flag" readonly hidden>
    <input type="number" name="ivas_flag" id="ivas_flag" readonly hidden>
    <input type="number" name="subtotal2_flag" id="subtotal2_flag" readonly hidden>
    <input type="number" name="total_flag" id="total_flag" readonly hidden>
</div>

<div class="row">
    <div class="col-lg-1"></div>
    <div class="form-group col-lg-5">
        <button id="btn_vender"  onclick="calcular_cuenta(0)" type="button" class="btn btn-block btn-primary" disabled><i class="fas fa-cash-register"></i> Calcular</button>
    </div>
    <div class="col-lg-5">
        <button id="btn_haz_venta" disabled type="submit" class="btn btn-block btn-success"><i class="fas fa-money-check"></i> Vender</button>
    </div>
</div>
<input hidden readonly type="text" name="action" id="action" value="insert_salida_venta">
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
