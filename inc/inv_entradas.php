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
                <h5 class="modal-title" id="my-modal-title">Agregar proveedor</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="on" id="formAdd_proveedor">
                    <div class="row">
                        <div class="col-lg-8">
                          <div class="form-group">
                            <label for="correo">Proveedor</label>
                            <input type="text" class="form-control" name="nuevoProveedor" id="nuevoProveedor" required maxlength="99">
                        </div>  
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="correo">Teléfono</label>
                                <input type="text" class="form-control" name="telProveedor" id="telProveedor" required maxlength="99">
                        </div>
                        </div>
                    </div>

                    <input value="insert_proveedor" name="action" id="action" hidden readonly>
                    <input value="nuevo_proveedor" name="flagid_Proveedor" id="flagid_Proveedor" hidden readonly>
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
            <h3><strong>ENTRADAS</strong></h3>
            <!--<input type="" name="prueba" id="prueba">-->
        </div>

        <div align="right" class="col-lg-2">
            <a href="lista_entradas.php" class="btn btn-primary" type="button" ><i class="fas fa-list"></i> Entradas realizadas</a>
        </div>
    </div>
</div>
</div>
</div>

<form method="post" autocomplete="on" id="formAdd_entrada">
<div class="col-lg-12">
<div class="card"> 
            <div class="card-body">
                    <div class="row">
                        <div class="col-lg">
                            <label for="Comprador">Comprador</label>
                            <select class="form-control js-example-data-array" id="comprador" name="comprador">
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
                        <div class="form-group col-lg-4">
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
                                    <button disabled="disabled" title="Agregar nueva proveedor" class="btn btn-primary btn-xs" type="button"><i class="fas fa-plus"></i></button>
                                    <button disabled title="editar proveedor" class="btn btn-success btn-xs" type="button" href="#" ><i class="fas fa-edit"></i></button>
                                    <button disabled title="Eliminar proveedor" class="btn btn-danger btn-xs" type="button"><i class="fas fa-trash"></i></button>
                                    <?php 
                                } 
                             ?>
                                <select class="form-control js-example-data-array" id="proveedor_entrada" name="proveedor_entrada" required>
                                <option selected hidden></option>
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

                        <div class="form-group col-lg">
                            <label for="domicilio_aval">Teléfono</label>
                            <input type="text" class="form-control" placeholder="exp. 9610000000" name="tel_proveedor_entrada" id="tel_proveedor_entrada" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>

                        <div class="form-group col-lg">
                            <label for="trabajo_aval">Fecha</label>
                            <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" placeholder="" name="fecha_entrada" id="fecha_entrada">
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="folio_venta">Folio de compra</label>
                            <input type="text" class="form-control" name="folio_compra" id="folio_compra" onkeyup="mayusculas(this)">
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
                              while($row = mysqli_fetch_assoc($result))
                              {
                                if($_SESSION['idsucursal'] == $row["idsucursales"])
                                {
                                    echo "<option selected value='".$row["idsucursales"]."'>".$row["sucursales"]."</option>";
                                }
                                else
                                {
                                    echo "<option value='".$row["idsucursales"]."'>".$row["sucursales"]."</option>";
                                }
                              }
                            }
                            ?>                        
                          </select>
                        </div>

                        <div class="form-group col-lg">
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

                        <div class="form-group col-lg">
                            <label for="n_pagos">No. pagos</label>
                            <input type="number" class="form-control" name="n_pagos_entrada" id="n_pagos_entrada" value="4" step="any">
                        </div>

                        <div class="form-group col-lg">
                            <label for="pago_parcial">Pago parcial</label>
                            <input type="text" class="form-control" name="pago_parcial_entrada" id="pago_parcial_entrada" step="any">
                        </div>

                        <div align="right" class="form-group col-lg">
                            <br>
                            <button type="button" class="btn btn-lg btn-primary" id="add_compra" onclick="add_entrada()">Añadir</button>
                        </div>

                    </div>
            </div>
        </div>
    </div>

<!-- modal para poner las series que quieres -->
<div id="series_modales">
</div>
                        


<!-- aqui va los añadidios dinamicos de las entradas -->
<!-- ya no se hizo dinamicamente, lo que se muestra a continuacion NO ES UNA PRACTICA ADECUADA -->
<!-- se hizo así por fines rapidos y practicos, ya no habia mucho tiempo, y funciona para el poco uso que tendra-->
<!-- ya esta empezado lo de que sea dinamico, pero aun tiene varios bugs por arreglar, si tienen tiempo, haganlo bien, por si quieren intentar.... -->
<div id="lista_entrada">
    <!-- card1 -->
    <div id="card_entrada1" class="row" hidden>
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="identificador_pro">Identificador</label>
                            <select class="form-control js-example-data-array" id="identificador_pro_1" name="identificador_pro_1" onchange="es_serializado(1)">
                            <option value=0 selected hidden></option>
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
                        <div class="col-lg-1">
                            <label for="cantidad">Cantidad</label>
                            <input onchange="multiplicar_precio_entrada(1)" type="number" value=1 class="form-control" name="cantidad_1" id="cantidad_1">
                        </div>
                        <div class="col-lg-3">
                            
                            <label for="origen">Serie</label>
                            <fieldset id="div_serie_1" disabled>
                                <input type="text" class="form-control" name="serie_1" id="serie_1" onkeyup="mayusculas(this)"> 
                            <!--
                                <button type="button" data-toggle="modal" data-target="#series" class="form-group btn btn-primary">Cargar Series</button> 
                            -->
                            </fieldset>
                            <input hidden readonly value="0" type="number" name="flag_producto_serie_1" id="flag_producto_serie_1">
                        </div>
                        <div class="col-lg-2">
                            <label for="precio">Precio</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input onkeyup="mostrar_pagos(1)" name="precio_1" id="precio_1" type="number" class="form-control" aria-label="Monto en pesos mexicanos" step="any">
                            </div>
                        </div>
                        <div class="col-lg" align="center">
                            <label for="con_iva">¿IVA?</label>
                            <input id="tiene_iva_1" name="tiene_iva_1" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="secondary" data-size="sm" data-on="SI" data-off="NO">
                        </div>
                        <div class="col-lg" align="right">
                                <a href="#" onclick="borrar_card_entrada(1)"><i style="color: red;" class="fas fa-trash-alt fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fin card1 -->
     <!-- card2 -->
    <div id="card_entrada2" class="row" hidden>
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="identificador_pro">Identificador</label>
                            <select class="form-control js-example-data-array" id="identificador_pro_2" name="identificador_pro_2" onchange="es_serializado(2)">
                            <option value=0 selected hidden></option>
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
                        <div class="col-lg-1">
                            <label for="cantidad">Cantidad</label>
                            <input onchange="multiplicar_precio_entrada(2)" type="number" value=1 class="form-control" name="cantidad_2" id="cantidad_2">
                        </div>
                        <div class="col-lg-3">
                            <label for="origen">Serie</label>
                            <fieldset id="div_serie_2" disabled>
                                <input type="text" class="form-control" name="serie_2" id="serie_2" onkeyup="mayusculas(this)"> 
                            <!--
                                <button type="button" data-toggle="modal" data-target="#series" class="form-group btn btn-primary">Cargar Series</button> 
                            -->
                            </fieldset>
                            <input hidden readonly value="0" type="number" name="flag_producto_serie_2" id="flag_producto_serie_2">
                        </div>
                        <div class="col-lg-2">
                            <label for="precio">Precio</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input onkeyup="mostrar_pagos(2)" name="precio_2" id="precio_2" type="number" class="form-control" aria-label="Monto en pesos mexicanos" step="any">
                            </div>
                        </div>
                        <div class="col-lg" align="center">
                            <label for="con_iva">¿IVA?</label>
                            <input id="tiene_iva_2" name="tiene_iva_2" value="si_iva_2" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="secondary" data-size="sm" data-on="SI" data-off="NO">
                        </div>
                        <div class="col-lg-1" align="right">
                                <a href="#" onclick="borrar_card_entrada(2)"><i style="color: red;" class="fas fa-trash-alt fa-2x"></i></a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fin card2 -->
     <!-- card3 -->
    <div id="card_entrada3" class="row" hidden>
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="identificador_pro">Identificador</label>
                            <select class="form-control js-example-data-array" id="identificador_pro_3" name="identificador_pro_3" onchange="es_serializado(3)">
                            <option value=0 selected hidden></option>
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
                        <div class="col-lg-1">
                            <label for="cantidad">Cantidad</label>
                            <input onchange="multiplicar_precio_entrada(3)" type="number" value=1 class="form-control" name="cantidad_3" id="cantidad_3">
                        </div>
                        <div class="col-lg-3">
                            <label for="origen">Serie</label>
                            <fieldset id="div_serie_3" disabled>
                                <input type="text" class="form-control" name="serie_3" id="serie_3" onkeyup="mayusculas(this)"> 
                            <!--
                                <button type="button" data-toggle="modal" data-target="#series" class="form-group btn btn-primary">Cargar Series</button> 
                            -->
                            </fieldset>
                            <input hidden readonly value="0" type="number" name="flag_producto_serie_3" id="flag_producto_serie_3">
                        </div>
                        <div class="col-lg-2">
                            <label for="precio">Precio</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input onkeyup="mostrar_pagos(3)" name="precio_3" id="precio_3" type="number" class="form-control" aria-label="Monto en pesos mexicanos" step="any">
                            </div>
                        </div>
                        <div class="col-lg" align="center">
                            <label for="con_iva">¿IVA?</label>
                            <input id="tiene_iva_3" name="tiene_iva_3" value="si_iva_3" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="secondary" data-size="sm" data-on="SI" data-off="NO">
                        </div>
                        <div class="col-lg-1" align="right">
                                <a href="#" onclick="borrar_card_entrada(3)"><i style="color: red;" class="fas fa-trash-alt fa-2x"></i></a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fin card3 -->
     <!-- card4 -->
    <div id="card_entrada4" class="row" hidden>
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="identificador_pro">Identificador</label>
                            <select class="form-control js-example-data-array" id="identificador_pro_4" name="identificador_pro_4" onchange="es_serializado(4)">
                            <option value=0 selected hidden></option>
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
                        <div class="col-lg-1">
                            <label for="cantidad">Cantidad</label>
                            <input onchange="multiplicar_precio_entrada(4)" type="number" value=1 class="form-control" name="cantidad_4" id="cantidad_4">
                        </div>
                        <div class="col-lg-3">
                            <label for="origen">Serie</label>
                            <fieldset id="div_serie_4" disabled>
                                <input type="text" class="form-control" name="serie_4" id="serie_4" onkeyup="mayusculas(this)"> 
                            <!--
                                <button type="button" data-toggle="modal" data-target="#series" class="form-group btn btn-primary">Cargar Series</button> 
                            -->
                            </fieldset>
                            <input hidden readonly value="0" type="number" name="flag_producto_serie_4" id="flag_producto_serie_4">
                        </div>
                        <div class="col-lg-2">
                            <label for="precio">Precio</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input onkeyup="mostrar_pagos(4)" name="precio_4" id="precio_4" type="number" class="form-control" aria-label="Monto en pesos mexicanos" step="any">
                            </div>
                        </div>
                        <div class="col-lg" align="center">
                            <label for="con_iva">¿IVA?</label>
                            <input id="tiene_iva_4" name="tiene_iva_4" value="si_iva_4" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="secondary" data-size="sm" data-on="SI" data-off="NO">
                        </div>
                        <div class="col-lg-1" align="right">
                                <a href="#" onclick="borrar_card_entrada(4)"><i style="color: red;" class="fas fa-trash-alt fa-2x"></i></a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fin card4 -->
     <!-- card5 -->
    <div id="card_entrada5" class="row" hidden>
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="identificador_pro">Identificador</label>
                            <select class="form-control js-example-data-array" id="identificador_pro_5" name="identificador_pro_5" onchange="es_serializado(5)">
                            <option value=0 selected hidden></option>
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
                        <div class="col-lg-1">
                            <label for="cantidad">Cantidad</label>
                            <input onchange="multiplicar_precio_entrada(5)" type="number" value=1 class="form-control" name="cantidad_5" id="cantidad_5">
                        </div>
                        <div class="col-lg-3">
                            <label for="origen">Serie</label>
                            <fieldset id="div_serie_5" disabled>
                                <input type="text" class="form-control" name="serie_5" id="serie_5" onkeyup="mayusculas(this)"> 
                            <!--
                                <button type="button" data-toggle="modal" data-target="#series" class="form-group btn btn-primary">Cargar Series</button> 
                            -->
                            </fieldset>
                            <input hidden readonly value="0" type="number" name="flag_producto_serie_5" id="flag_producto_serie_5">
                        </div>
                        <div class="col-lg-2">
                            <label for="precio">Precio</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input onkeyup="mostrar_pagos(5)" name="precio_5" id="precio_5" type="number" class="form-control" aria-label="Monto en pesos mexicanos" step="any">
                            </div>
                        </div>
                        <div class="col-lg" align="center">
                            <label for="con_iva">¿IVA?</label>
                            <input id="tiene_iva_5" name="tiene_iva_5" value="si_iva_5" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="secondary" data-size="sm" data-on="SI" data-off="NO">
                        </div>
                        <div class="col-lg-1" align="right">
                                <a href="#" onclick="borrar_card_entrada(5)"><i style="color: red;" class="fas fa-trash-alt fa-2x"></i></a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fin card5 -->
</div>

<div id="costos_calculados_entrada" hidden>
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
            <input id="descuento_compra" type="number" name="descuento_compra" class="form-control">
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
        <button id="btn_comprar"  onclick="calcular_cuenta_entrada()" type="button" class="btn btn-block btn-primary" disabled><i class="fas fa-cash-register"></i> Calcular</button>
    </div>
    <div class="col-lg-5">
        <button id="btn_haz_compra" disabled type="submit" class="btn btn-block btn-success"><i class="fas fa-money-check"></i> Comprar</button>
    </div>
</div>
<input hidden readonly type="text" name="action" id="action" value="insert_entrada_compra">
</form>


<br><br>
<script type="text/javascript">

//funcion para poner mayusculas los inputs
function mayusculas(e) {
    e.value = e.value.toUpperCase();
}

document.getElementById('divzoom').style.zoom = "100%";
//document.getElementById('page-top').style.zoom = "80%";

</script>

<?php 
ob_end_flush();
include_once "footer.php"; 
?>
