<?php 
ob_start();
include_once "header.php";
include "accion/conexion.php";

?>

<div style="posicion: fixed; top: 15%;" id="mensaje_repetido" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    
                    <div align="center" >
                        <br>
                        <!-- <img src="../img/ok.gif" width="100px" height="100px"> -->
                        <div class="swal2-header">
                            <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;">
                                <div class="swal2-icon-content">!
                                </div>
                            </div>   
                            <h2 id="swal2-title" class="swal2-title" style="display: flex;">¡El producto ya existe!</h2>
                        </div>

                        <div class="swal2-content">
                            <div id="swal2-content" class="swal2-html-container" style="display: block;">
                               Favor de poner otro indentificar para este nuevo producto
                            </div>
                        </div>
                        <div class="swal2-actions" style="display: flex;">
                            <button data-dismiss="modal" class="swal2-confirm swal2-styled" arial-label type="button" style="display: inline-block;">Ok</button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div style="posicion: fixed; top: 15%;" id="mensaje_success" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    
                    <div align="center" >
                        <br>
                        <!-- <img src="../img/ok.gif" width="100px" height="100px"> -->
                        <div class="swal2-header">
                            <div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
                                <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                <span class="swal2-success-line-tip"></span>
                                <span class="swal2-success-line-long"></span>
                                <div class="swal2-success-ring"></div>
                                <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                            </div>    
                            <h2 id="swal2-title" class="swal2-title" style="display: flex;">¡Listo!</h2>
                        </div>

                        <div class="swal2-content">
                            <div id="swal2-content" class="swal2-html-container" style="display: block;">
                                Producto guardado correctamete
                            </div>
                        </div>
                        <div class="swal2-actions">
                            <a href="productos.php" class="swal2-confirm swal2-styled" type="button" style="display: inline-block;">Ok</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div style="posicion: fixed; top: 15%;" id="mensaje_error" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    
                    <div align="center" >
                        <br>
                        <!-- <img src="../img/ok.gif" width="100px" height="100px"> -->
                        <div class="swal2-header">
                            <div class="swal2-icon swal2-error swal2-icon-show" style="display: flex;">
                                <span class="swal2-x-mark">
                                    <span class="swal2-x-mark-line-left"></span>
                                    <span class="swal2-x-mark-line-right"></span>
                                </span>
                            </div>    
                            <h2 id="swal2-title" class="swal2-title" style="display: flex;">Oops... Ocurrio un problema!</h2>
                        </div>

                        <div class="swal2-content">
                            <div id="swal2-content" class="swal2-html-container" style="display: block;">
                                El nuevo producto no se guardo correctamente, intente nuevamente.
                            </div>
                        </div>
                        <div class="swal2-actions">
                            <a href="productos.php" class="swal2-confirm swal2-styled" type="button" style="display: inline-block;">Ok</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div id="prueba">
    <!-- <input type="text" name="pruebai" id="pruebai">-->
</div>

<div style="posicion: fixed; top: 15%;" id="mensaje_imgsuccess" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    
                    <div align="center" >
                        <br>
                        <!-- <img src="../img/ok.gif" width="100px" height="100px"> -->
                        <div class="swal2-header">
                            <div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
                                <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                <span class="swal2-success-line-tip"></span>
                                <span class="swal2-success-line-long"></span>
                                <div class="swal2-success-ring"></div>
                                <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                            </div>    
                            <h2 id="swal2-title" class="swal2-title" style="display: flex;">¡Listo!</h2>
                        </div>

                        <div class="swal2-content">
                            <div id="swal2-content" class="swal2-html-container" style="display: block;">
                                La imágen del producto se guardado correctamete
                            </div>
                        </div>
                        <div class="swal2-actions">
                            <a href="productos.php" class="swal2-confirm swal2-styled" type="button" style="display: inline-block;">Ok</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div style="posicion: fixed; top: 15%;" id="mensaje_imgerror" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    
                    <div align="center" >
                        <br>
                        <!-- <img src="../img/ok.gif" width="100px" height="100px"> -->
                        <div class="swal2-header">
                            <div class="swal2-icon swal2-error swal2-icon-show" style="display: flex;">
                                <span class="swal2-x-mark">
                                    <span class="swal2-x-mark-line-left"></span>
                                    <span class="swal2-x-mark-line-right"></span>
                                </span>
                            </div>    
                            <h2 id="swal2-title" class="swal2-title" style="display: flex;">Oops... Ocurrio un problema!</h2>
                        </div>

                        <div class="swal2-content">
                            <div id="swal2-content" class="swal2-html-container" style="display: block;">
                                La imágen no se guardo correctamente, intente nuevamente.
                            </div>
                        </div>
                        <div class="swal2-actions">
                            <a href="productos.php" class="swal2-confirm swal2-styled" type="button" style="display: inline-block;">Ok</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div style="posicion: fixed; top: 15%;" id="mensaje_imgnoallow" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    
                    <div align="center" >
                        <br>
                        <!-- <img src="../img/ok.gif" width="100px" height="100px"> -->
                        <div class="swal2-header">
                            <div class="swal2-icon swal2-error swal2-icon-show" style="display: flex;">
                                <span class="swal2-x-mark">
                                    <span class="swal2-x-mark-line-left"></span>
                                    <span class="swal2-x-mark-line-right"></span>
                                </span>
                            </div>    
                            <h2 id="swal2-title" class="swal2-title" style="display: flex;">¡Imágen invalida!</h2>
                        </div>

                        <div class="swal2-content">
                            <div id="swal2-content" class="swal2-html-container" style="display: block;">
                                La imágen no esta dentro de las extenciones permitidas (png, jpg, jpge).
                            </div>
                        </div>
                        <div class="swal2-actions">
                            <a href="productos.php" class="swal2-confirm swal2-styled" type="button" style="display: inline-block;">Ok</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div style="posicion: fixed; top: 15%;" id="mensaje_imggrande" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    
                    <div align="center" >
                        <br>
                        <!-- <img src="../img/ok.gif" width="100px" height="100px"> -->
                        <div class="swal2-header">
                            <div class="swal2-icon swal2-error swal2-icon-show" style="display: flex;">
                                <span class="swal2-x-mark">
                                    <span class="swal2-x-mark-line-left"></span>
                                    <span class="swal2-x-mark-line-right"></span>
                                </span>
                            </div>    
                            <h2 id="swal2-title" class="swal2-title" style="display: flex;">¡Imágen muy grande!</h2>
                        </div>

                        <div class="swal2-content">
                            <div id="swal2-content" class="swal2-html-container" style="display: block;">
                                Tamaño maximo soportado: 0.5 MB.
                            </div>
                        </div>
                        <div class="swal2-actions">
                            <a href="productos.php" class="swal2-confirm swal2-styled" type="button" style="display: inline-block;">Ok</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div id="img_producto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog  modal-xl" role="document">
        <div class="modal-content">
        <form action="" method="post" autocomplete="on" id="formAdd_img" enctype="multipart/form-data">
            <div class="modal-header">
                    <h2 class="modal-title">Imágen del producto</h2>
                <div class="row">
                    <div class="col-lg-6">
                          <div class="form-group">
                                  <div class="custom-file">
                                    <?php 
                                        if($imagenes)
                                        {
                                            ?>
                                                <input name="imgProducto" type="file" accept=".jpg, .jpeg, .png" class="custom-file-input" id="imgProducto" lang="es">
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <input disabled="disabled" type="file" accept=".jpg, .jpeg, .png" class="custom-file-input" lang="es">
                                            <?php
                                        }
                                     ?>
                                      <label class="custom-file-label" for="customFileLang" data-browse="Seleccionar">Subir imágen png</label>
                                    </div>
                            </div>  
                        </div>
                        <div class="col-lg-6">
                            <?php 
                                if($imagenes)
                                {
                                    ?>
                                        <button id="btn_borrar_img" type="button" class="btn btn-lg btn-danger"><i class="fas fa-trash-alt"></i> Borrar</button>
                                    <?php 
                                }
                                else
                                {
                                    ?>
                                        <button disabled="disabled" type="button" class="btn btn-lg btn-danger"><i class="fas fa-trash-alt"></i> Borrar</button>
                                    <?php 
                                }
                             ?>
                            <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal" aria-label="Close" id="btn_cancerlarimg">
                            Cancelar
                            </button>
                            <?php 
                                if($imagenes)
                                {
                                    ?>
                                        <input type="submit" value="Subir" class="btn btn-lg btn-success" id="btn_subirimg">
                                    <?php 
                                }
                                else
                                {
                                    ?>
                                        <input disabled="disabled" type="button" value="Subir" class="btn btn-lg btn-success">
                                    <?php 
                                }
                             ?>
                        </div>
                </div>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="productoImg" align="center">
                                
                            </div>
                        </div>
                    </div>
                    <input value="load_img" name="action" id="action" hidden readonly>
                    <input type="text" name="flagid_producto_img" id="flagid_producto_img" readonly hidden>
            </div>
        </form>
        </div>
    </div>
</div>

<div id="nueva_cat" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog  modal-xl" role="document">
        <div class="modal-content">
        <form action="" method="post" autocomplete="on" id="formAdd_cat">
            <div class="modal-header">
                <h3 class="modal-title">Detalle Categoría</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal" aria-label="Close" id="btn_cancerlarcat">
                            Cancelar
                        </button>
                    </div>
                    <div class="col-lg-6">
                        <input type="submit" value="Guardar" class="btn btn-lg btn-success" id="btn_guardarcat">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="nombre_cat">Nombre</label>
                                <div class="input-group">
                                  <input type="text" class="form-control" name="nombre_cat" id="nombre_cat" required onkeyup="mayusculas(this)">
                                  &nbsp;
                                  <input id="tiene_subcat" name="tiene_subcat" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="secondary" data-size="m" data-on="SI" data-off="NO">
                                </div>
                            </div>  
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr1">Atributo 1</label>
                                <input type="text" class="form-control" name="atr1" id="atr1" disabled value="MARCA" onkeyup="mayusculas(this)">
                            </div>  
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr2">Atributo 2</label>
                                <input type="text" class="form-control" name="atr2" id="atr2" onkeyup="mayusculas(this)">
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr3">Atributo 3</label>
                                <input type="text" class="form-control" name="atr3" id="atr3" onkeyup="mayusculas(this)">
                            </div>  
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr4">Atributo 4</label>
                                <input type="text" class="form-control" name="atr4" id="atr4" onkeyup="mayusculas(this)">
                            </div>  
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr5">Atributo 5</label>
                                <input type="text" class="form-control" name="atr5" id="atr5" onkeyup="mayusculas(this)">
                            </div>  
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-lg">
                            <label for="contado">Contado:</label>
                            <div class="input-group mb-3">
                              <input name="contado" id="contado" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="especial">Especial:</label>
                    <fieldset id="especial_cat">
                            <div class="input-group mb-3">
                              <input name="especial" id="especial" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                    </fieldset>
                        </div>

                        <div class="form-group col-lg">
                            <label for="mesespago">Meses de pago:</label>
                            <input name="mesespago" id="mesespago" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                        </div>
                        <div class="form-group col-lg">
                            <label for="garantia">Meses de garantía:</label>
                            <input name="garantia" id="garantia" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                        </div>
                        <div class="form-group col-lg">
                            <label for="garantia">Enganche:</label>
                            <div class="input-group mb-3">
                              <input name="enganche" id="enganche" type="number" class="form-control" required step="0.01">
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-3">
                            <h4>Credito 1</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg">
                            <label for="credito1">Base inicial:</label>
                            <div class="input-group mb-3">
                              <input name="base_inicial_c1" id="base_inicial_c1" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="credito2">% de ganancia inicial:</label>
                            <div class="input-group mb-3">
                              <input name="ganancia_inicial_c1" id="ganancia_inicial_c1" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="credito2">Rango:</label>
                            <div class="input-group mb-3">
                              <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="rango_c1" id="rango_c1" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="credito2">% de ganancia subsecuente:</label>
                            <div class="input-group mb-3">
                              <input name="ganancia_subsecuente_c1" id="ganancia_subsecuente_c1" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="credito2">Limite de costo:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="limite_costo_c1" id="limite_costo_c1" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-3">
                            <h4>Credito 2</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg">
                            <label for="credito1">Base inicial:</label>
                            <div class="input-group mb-3">
                              <input name="base_inicial_c2" id="base_inicial_c2" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="credito2">% de ganancia inicial:</label>
                            <div class="input-group mb-3">
                              <input name="ganancia_inicial_c2" id="ganancia_inicial_c2" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="credito2">Rango:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="rango_c2" id="rango_c2" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="credito2">% de ganancia subsecuente:</label>
                            <div class="input-group mb-3">
                              <input name="ganancia_subsecuente_c2" id="ganancia_subsecuente_c2" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="credito2">Limite de costo:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="limite_costo_c2" id="limite_costo_c2" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                            </div>
                        </div>
                    </div>

                    <input value="insert_categoria" name="action" id="action" hidden>
                    <input type="text" value="" id="flagidcategoria" name="flagidcategoria" hidden>
            </div>
        </form>
        </div>
    </div>
</div>

<div id="nueva_subcat" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog  modal-xl" role="document">
        <div class="modal-content">
        <form action="" method="post" autocomplete="on" id="formAdd_subcat">
            <div class="modal-header">
                <h3 class="modal-title">Detalle Subcategoría</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <!-- agrandar SELECT -->
                        <select required="true" class="form-control" id="categoria_subcategoria" name="categoria_subcategoria">
                                <option value="" hidden selected>Selecciona categoría</option>
                                <?php
                                    #codigo para la lista de sucursales que se extraen de la base de datos
                                    $result_cat = mysqli_query($conexion,"SELECT idcategoria,nombre FROM categoria where tiene_subcat = 1 order by nombre asc");
                                    if (mysqli_num_rows($result_cat) > 0) 
                                    {  
                                      while($row = mysqli_fetch_assoc($result_cat))
                                      {
                                        echo "<option value='".$row["idcategoria"]."'>".$row["nombre"]."</option>";
                                      }
                                    }
                                ?>  
                            </select>
                    </div>
                    <div class="col-lg-3">
                        <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal" aria-label="Close" id="btn_cancerlarsubcat">
                            Cancelar
                        </button>
                    </div>
                    <div class="col-lg-3">
                        <input type="submit" class="btn btn-lg btn-success" value="Guardar" id="btn_guardarsubcat">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="nombre_subcat">Nombre</label>
                                <input type="text" class="form-control" name="nombre_subcat" id="nombre_subcat" required onkeyup="mayusculas(this);">
                            </div>  
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr1_sub">Atributo 1</label>
                                <input type="text" class="form-control" name="atr1_sub" id="atr1_sub" value="MARCA" disabled>
                            </div>  
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr2_sub">Atributo 2</label>
                                <input type="text" class="form-control" name="atr2_sub" id="atr2_sub" onkeyup="mayusculas(this);">
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr3_sub">Atributo 3</label>
                                <input type="text" class="form-control" name="atr3_sub" id="atr3_sub" onkeyup="mayusculas(this);">
                            </div>  
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr4_sub">Atributo 4</label>
                                <input type="text" class="form-control" name="atr4_sub" id="atr4_sub" onkeyup="mayusculas(this);">
                            </div>  
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr5_sub">Atributo 5</label>
                                <input type="text" class="form-control" name="atr5_sub" id="atr5_sub" onkeyup="mayusculas(this);">
                            </div>  
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-lg">
                            <label for="contado_sub">Contado:</label>
                            <div class="input-group mb-3">
                              <input name="contado_sub" id="contado_sub" type="number" class="form-control" aria-label="Monto en pesos mexicanos">
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="especial_sub">Especial:</label>
                        <fieldset id="especial_subcat">
                            <div class="input-group mb-3">
                              <input name="especial_sub" id="especial_sub" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </fieldset>
                        </div>
                        
                        <div class="form-group col-lg">
                            <label for="mesespago">Meses de pago:</label>
                            <input name="mesespago_sub" id="mesespago_sub" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                        </div>
                        <div class="form-group col-lg">
                            <label for="garantia">Meses de garantía:</label>
                            <input name="garantia_sub" id="garantia_sub" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                        </div>
                        <div class="form-group col-lg">
                            <label for="garantia">Enganche:</label>
                            <div class="input-group mb-3">
                              <input name="enganche_sub" id="enganche_sub" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required step="0.01">
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <h4>Credito 1</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg">
                            <label for="credito1">Base inicial:</label>
                            <div class="input-group mb-3">
                              <input name="base_inicial_c1_sub" id="base_inicial_c1_sub" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="credito2">% de ganancia inicial:</label>
                            <div class="input-group mb-3">
                              <input name="ganancia_inicial_c1_sub" id="ganancia_inicial_c1_sub" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="credito2">Rango:</label>
                            <div class="input-group mb-3">
                              <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="rango_c1_sub" id="rango_c1_sub" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="credito2">% de ganancia subsecuente:</label>
                            <div class="input-group mb-3">
                              <input name="ganancia_subsecuente_c1_sub" id="ganancia_subsecuente_c1_sub" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="credito2">Limite de costo:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="limite_costo_c1_sub" id="limite_costo_c1_sub" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-3">
                            <h4>Credito 2</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg">
                            <label for="credito1">Base inicial:</label>
                            <div class="input-group mb-3">
                              <input name="base_inicial_c2_sub" id="base_inicial_c2_sub" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="credito2">% de ganancia inicial:</label>
                            <div class="input-group mb-3">
                              <input name="ganancia_inicial_c2_sub" id="ganancia_inicial_c2_sub" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="credito2">Rango:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="rango_c2_sub" id="rango_c2_sub" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="credito2">% de ganancia subsecuente:</label>
                            <div class="input-group mb-3">
                              <input name="ganancia_subsecuente_c2_sub" id="ganancia_subsecuente_c2_sub" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="credito2">Limite de costo:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="limite_costo_c2_sub" id="limite_costo_c2_sub" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                            </div>
                        </div>
                    </div>

                    <input value="insert_subcategoria" name="action" id="action" hidden>
                    <input type="text" value="" id="flagidsubcategoria" name="flagidsubcategoria" hidden>
            </div>
        </form>
        </div>
    </div>
</div>

<div id="nuevo_producto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog  modal-xl" role="document">
        <div class="modal-content">
        <form action="" method="post" autocomplete="on" id="formAdd_producto">
            <div class="modal-header">
                <h3 class="modal-title">Detalle del Producto</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal" aria-label="Close" id="btn_cancerlar_producto">
                            Cancelar
                        </button>
                    </div>
                    <div class="col-lg-6">
                        <input type="submit" value="Guardar" class="btn btn-lg btn-success" id="btn_guardar_producto">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3">
                          <div class="form-group">
                                <label for="nombre_cat">Identificador</label>
                                <input minlength="4" type="text" class="form-control" name="identificador" id="identificador" required>
                                <div id="msg_validador">
                                </div>
                            </div>  
                        </div>

                        <div class="col-lg-3">
                          <div class="form-group">
                                <label for="atr1">Código de Barras</label>
                                <input type="text" class="form-control" name="codigo_barras" id="codigo_barras">
                            </div>  
                        </div>

                        <div class="col-lg-2">
                            <label>Categoría:</label>
                            <select class="form-control" id="categoria_producto" name="categoria_producto" required>
                                <option selected hidden value="">Selecciona categoría</option>
                                <?php
                                    #codigo para la lista de sucursales que se extraen de la base de datos
                                    $result_cat = mysqli_query($conexion,"SELECT idcategoria,nombre FROM categoria order by nombre asc");
                                    if (mysqli_num_rows($result_cat) > 0) 
                                    {  
                                      while($row = mysqli_fetch_assoc($result_cat))
                                      {
                                        echo "<option value='".$row["idcategoria"]."'>".$row["nombre"]."</option>";
                                      }
                                    }
                                ?>  
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <label>Subcategoriía:</label>
                            <select class="form-control" id="subcategoria_producto" name="subcategoria_producto" required>
                                <option selected hidden value="">Selecciona subcategoría</option>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <label for="serializado">Serializado</label>
                            <input onchange="" id="serializado" name="serializado" value="si_serializado" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="secondary" data-size="m" data-on="SI" data-off="NO">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Descripción</label>
                            <textarea  class="form-control" name="descripcion" title="Ingrese la descripción del producto" id="descripcion" placeholder="Ingrese la descripción detallada del producto" maxlength="50000"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr1">Atributo 1: </label>
                                <label id="label_atr1" style="font-weight: bold;"></label>
                                <input type="text" class="form-control" name="atr1_producto" id="atr1_producto" readonly required>
                            </div>  
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr1">Atributo 2: </label>
                                <label id="label_atr2" style="font-weight: bold;"></label>
                                <input type="text" class="form-control" name="atr2_producto" id="atr2_producto" readonly required>
                            </div>  
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr1">Atributo 3: </label>
                                <label id="label_atr3" style="font-weight: bold;"></label>
                                <input type="text" class="form-control" name="atr3_producto" id="atr3_producto" readonly required>
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr1">Atributo 4: </label>
                                <label id="label_atr4" style="font-weight: bold;"></label>
                                <input type="text" class="form-control" name="atr4_producto" id="atr4_producto" readonly required>
                            </div>  
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr1">Atributo 5: </label>
                                <label id="label_atr5" style="font-weight: bold;"></label>
                                <input type="text" class="form-control" name="atr5_producto" id="atr5_producto" readonly required>
                            </div>  
                        </div>
                        <div class="col-lg-2">
                            <label for="stock_min">Stock Min: </label>
                            <input type="text" class="form-control" name="stock_min" id="stock_min">
                        </div>
                        <div class="col-lg-2">
                            <label for="stock_max">Stock Max: </label>
                            <input type="text" class="form-control" name="stock_max" id="stock_max">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="ext_p">EXT.-P:</label>
                              <input name="ext_p" id="ext_p" type="number" class="form-control" aria-label="Monto en pesos mexicanos">
                        </div>
                        <div class="form-group col">
                            <label for="costo">COSTO:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="costo" id="costo" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required min="0" onkeypress="return event.charCode != 45">
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="costoiva">COSTO+IVA:</label>
                            <!-- calcular el costo mas iva con el costo anterior -->
                            <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="costo_iva" id="costo_iva" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required readonly>
                              </div>
                        </div>
                        <div class="form-group col">
                            <label for="contado">Contado:</label>
                            <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="costo_contado" id="costo_contado" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required readonly>
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="especial">Especial:</label>
                        <fieldset id="especial_producto">
                            <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="costo_especial" id="costo_especial" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required readonly>
                          </div>
                        </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="cr1">CR1:</label>
                            <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="costo_cr1" id="costo_cr1" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required readonly>
                          </div>
                        </div>
                        <div class="form-group col">
                            <label for="cr2">CR2:</label>
                            <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="costo_cr2" id="costo_cr2" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required readonly>
                          </div>
                        </div>
                        <div class="form-group col">
                            <label for="p1">P1:</label>
                              <input name="costo_p1" id="costo_p1" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required readonly>
                        </div>
                        <div class="form-group col">
                            <label for="p2">P2:</label>
                              <input name="costo_p2" id="costo_p2" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required readonly>
                        </div>
                        <div class="form-group col">
                            <label for="e_q">E-Q:</label>
                            <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="costo_eq" id="costo_eq" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required readonly>
                          </div>
                        </div>
                        <div class="form-group col-lg">
                            <label for="costo_enganche">Enganche:</label>
                            <input name="costo_enganche" id="costo_enganche" type="number" class="form-control" required readonly>
                        </div>
                    </div>
                    <!-- <input type="number" name="asd1" id="asd1">
                    <input type="number" name="asd2" id="asd2"> -->
                    <input type="" name="action" id="action" value="insert_edit_producto" hidden>
                    <input type="" name="flagid_producto" id="flagid_producto" readonly hidden>
                    <input type="" name="flag_selectsubcat" id="flag_selectsubcat" readonly hidden>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="col-lg-12">
<div class="card">
<div class="card-body">
    <div class="row">
        <div class="col-lg-8">
            <h4><strong>CATALOGO DE PRODUCTOS</strong></h4>
            <!--<input type="" name="prueba" id="prueba">-->
        </div>

        <div align="right" class="col-lg-4">
            <?php 
                $conf_especial = mysqli_query($conexion,"SELECT valor_int from configuracion where configuracion='activador_especial'");
                $status_especial = mysqli_fetch_assoc($conf_especial)['valor_int'];
                if($_SESSION['rol'] == "SuperAdmin" or $_SESSION['rol'] == "Administrador")
                {
                    if($status_especial == 0)
                    {
                        ?>
                        <button id="btn_act_especial" title="Especial se encuentra DESACTIVADO" class="btn btn-warning" type="button" onclick="activar_especial('si')">Act. Esp</button>
                        <?php 
                    }
                    else
                    {
                        ?>
                        <button id="btn_act_especial" title="Especial se encuentra ACTIVADO" class="btn btn-success" type="button" onclick="activar_especial('no')">Des. Esp</button>
                        <?php 
                    }
                }
                else
                {
                    if($status_especial == 0)
                    {
                        ?>
                        <button id="btn_act_especial" title="Especial se encuentra DESACTIVADO" class="btn btn-warning" type="button" disabled="disabled">Act. Esp</button>
                        <?php 
                    }
                    else
                    {
                        ?>
                        <button id="btn_act_especial" title="Especial se encuentra ACTIVADO" class="btn btn-success" type="button" disabled="disabled">Des. Esp</button>
                        <?php 
                    }
                }

            if($nuevo_producto)
            {
                ?>
                <button data-toggle="modal" data-target="#nuevo_producto" class="btn btn-primary" type="button" onclick="nuevo_producto()"><i class="fas fa-plus"></i> Nuevo producto</button> 
                <?php 
            }
            else
            {
                ?>
                <button disabled="disabled" class="btn btn-primary" type="button"><i class="fas fa-plus"></i> Nuevo producto</button> 
                <?php 
            }
            ?>
        </div>
    </div>
</div>
</div>

<div class="card">
<div class="card-body">
<!-- <form action="" method="post" autocomplete="on"> -->
    <div class="row">
        <div class="col-lg-2">
            <label>Categoría:</label>
            <?php 
                if($_SESSION['rol'] == "SuperAdmin" or $_SESSION['rol'] == "Administrador")
                {
                    ?>
                    <button data-toggle="modal" data-target="#nueva_cat" title="Agregar nueva categoría" class="btn btn-primary btn-xs" type="button" onclick="nueva_categoria();"><i class="fas fa-plus"></i></button>
                    <button disabled data-toggle="modal" data-target="#nueva_cat" onclick="editar_categoria();" title="editar categoría" class="btn btn-success btn-xs" type="button" href="#" id="btnedit_categoria"><i class="fas fa-edit"></i></button>
                    <button disabled onclick="eliminar_categoria();" title="Eliminar categoría" class="btn btn-danger btn-xs" type="button" href="#" id="btneliminar_categoria"><i class="fas fa-trash"></i></button>
                    <?php 
                }
                else
                {
                    ?>
                    <button disabled="disabled" title="Agregar nueva categoría" class="btn btn-primary btn-xs" type="button"><i class="fas fa-plus"></i></button>
                    <button disabled="disabled" title="editar categoría" class="btn btn-success btn-xs" type="button"><i class="fas fa-edit"></i></button>
                    <button disabled="disabled" title="Eliminar categoría" class="btn btn-danger btn-xs" type="button"><i class="fas fa-trash"></i></button>
                    <?php 
                }
             ?>

            <select class="form-control" id="categoria" name="categoria">
                <option selected hidden>Selecciona categoría</option>
                <?php
                    #codigo para la lista de sucursales que se extraen de la base de datos
                    $result_cat = mysqli_query($conexion,"SELECT idcategoria,nombre FROM categoria order by nombre asc");
                    if (mysqli_num_rows($result_cat) > 0) 
                    {  
                      while($row = mysqli_fetch_assoc($result_cat))
                      {
                        echo "<option value='".$row["idcategoria"]."'>".$row["nombre"]."</option>";
                      }
                    }
                ?>  
            </select>
        </div>
        <div class="col-lg-2">
            <label>Subcategoría:</label>

            <?php 
                if($_SESSION['rol'] == "SuperAdmin" or $_SESSION['rol'] == "Administrador")
                {
                    ?>
                    <button data-toggle="modal" data-target="#nueva_subcat" title="Agregar nueva subcategoría" class="btn btn-primary btn-xs" type="button" onclick="nueva_subcategoria();" ><i class="fas fa-plus"></i></button>
                    <button disabled data-toggle="modal" data-target="#nueva_subcat" onclick="editar_subcategoria();" title="editar subcategoria" class="btn btn-success btn-xs" type="button" href="#" id="btnedit_subcategoria"><i class="fas fa-edit"></i></button>
                    <button disabled onclick="eliminar_subcategoria();" title="Eliminar subcategoria" class="btn btn-danger btn-xs" type="button" href="#" id="btneliminar_subcategoria"><i class="fas fa-trash"></i></button>
                    <?php 
                }
                else
                {
                    ?>
                    <button disabled="disabled" title="Agregar nueva subcategoría" class="btn btn-primary btn-xs" type="button"><i class="fas fa-plus"></i></button>
                    <button disabled="disabled" title="editar subcategoría" class="btn btn-success btn-xs" type="button"><i class="fas fa-edit"></i></button>
                    <button disabled="disabled" title="Eliminar subcategoría" class="btn btn-danger btn-xs" type="button"><i class="fas fa-trash"></i></button>
                    <?php 
                }
             ?>

           <select class="form-control" id="subcategoria" name="subcategoria">
            </select>
        </div>
        <div align="left" class="col-lg-1">
            <label>Atributo 1:</label>
            <select class="form-control" id="filtro_atr1" name="filtro_atr1">
                <option selected hidden value="LABEL">---</option>
            </select>
        </div>
        <div align="left" class="col-lg-1">
            <label>Atributo 2:</label>
            <select class="form-control" id="filtro_atr2" name="filtro_atr2">
                <option selected hidden value="LABEL">---</option>
            </select>
        </div>
        <div align="left" class="col-lg-1">
            <label>Atributo 3:</label>
            <select class="form-control" id="filtro_atr3" name="filtro_atr3">
                <option selected hidden value="LABEL">---</option>
            </select>
        </div>
        <div align="left" class="col-lg-1">
            <label>Atributo 4:</label>
            <select class="form-control" id="filtro_atr4" name="filtro_atr4">
                <option selected hidden value="LABEL">---</option>
            </select>
        </div>
        <div align="left" class="col-lg-1">
            <label>Atributo 5:</label>
            <select class="form-control" id="filtro_atr5" name="filtro_atr5">
                <option selected hidden value="LABEL">---</option>
            </select>
        </div>
        <div class="col-lg-3">
            
            <div class="row">
              <div class="col-12 col-sm-2">
                <?php 
                    if($ver_costos)
                    {
                        echo '<button onclick="show_costoiva();" type="button" class="btn btn-primary py-3 btn-sm" style="width: 75px !important;">Ver Costos</button>';
                    }
                    else
                    {
                        echo '<button disabled="disabled" type="button" class="btn btn-primary py-3 btn-sm" style="width: 75px !important;">Ver Costos</button>';
                    }
                 ?>
              </div>
              &nbsp;&nbsp;&nbsp;
              <?php 
                if($editar_lista)
                {
                    ?>
                    <div class="col-12 col-sm-3">
                    <div class="row">
                        <div class="col-12 col-sm-7" align="center" style="padding-left: 12px; padding-right: 0px;">
                            <button onClick='show_new_costo();' class='btn btn-primary btn-block' type='submit'><i style='color: white;' class='fas fa-edit'></i></button>
                        </div>
                        <div class="col-12 col-sm-5" align="center" style="padding-left: 0px; padding-right: 0px;">
                            <button onClick='drop_ext_p();' class='btn btn-primary btn-block' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>
                        </div>
                    </div>

                <!--
                    <div class="row">
                        <div class="col-12 col-sm-12" align="center">
                            <button onclick="show_new_costo();" type="button" class="btn btn-primary py-3 btn-sm" style="width: 88px !important; height: 38px !important; line-height: 0px;">Editar Lista</button>
                        </div>
                    </div>
                -->

                    <div class="row">
                        <div class="col-12 col-sm-12" align="center">
                            <button disabled="disabled" id="btn_save_lista" onClick="guardar_lista();" type="button" class="btn btn-primary py-3 btn-sm" style="width: 88px !important; height: 38px !important; line-height: 0px;">Guardar</button>
                        </div>
                    </div>
                    </div>
                    <?php 
                }
                else
                {
                    ?>
                    <div class="col-12 col-sm-3">
                    <div class="row">
                        <div class="col-12 col-sm-7" align="center" style="padding-left: 12px; padding-right: 0px;">
                            <button disabled="disabled" class='btn btn-primary btn-block' type='submit'><i style='color: white;' class='fas fa-edit'></i></button>
                        </div>
                        <div class="col-12 col-sm-5" align="center" style="padding-left: 0px; padding-right: 0px;">
                            <button disabled="disabled" class='btn btn-primary btn-block' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12" align="center">
                            <button disabled="disabled" type="button" class="btn btn-success py-3 btn-sm" style="width: 88px !important; height: 38px !important; line-height: 0px;">Guardar</button>
                        </div>
                    </div>
                    </div>
                    <?php 
                }
               ?>

              <div class="col-12 col-sm-3">
                <a href="accion/download_zip.php" type="button" class="btn btn-primary py-3 btn-sm" style="width: 95px !important;">Descargar Catalogo</a>
              </div>
              <div class="col-12 col-sm-3">
                  <a href="accion/download_excel_lista.php" type="button" class="btn btn-primary py-3 btn-sm" style="width: 95px !important;">Descargar Lista</a>
              </div>
            </div>

        </div>
    </div>
<!-- </form> -->
</div>
</div>

<div class="card">
<div class="card-body">
<div class="table-responsive" id="tablaproductos">
    <table class="table" id="tbl_productos">
        <thead class="thead-light">
            <tr>
                <th>Descripción</th>
                <th>Nuevo costo</th>
                <th>Costo actual</th>
                <th>Costo+IVA</th>
                <th>Nuevo Ext.-P</th>
                <th>Ext.-P</th>
                <th>Ext.-M</th>
                <th>Contado</th>
                <th>Especial</th>
                <th>CR1</th>
                <th>P1</th>
                <th>CR2</th>
                <th>P2</th>
                <th>E-Q</th>
                <th>GAR</th>
                <th style="text-align: center;">Herramientas</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $query = mysqli_query($conexion, "SELECT * from producto order by creado_en desc");
            $result = mysqli_num_rows($query);
            if ($result > 0) 
            {
                while ($data = mysqli_fetch_assoc($query)) 
                {
                    $id_producto = $data['idproducto'];
                    $identificador = $data['identificador'];
                    //aqui vamos a ver si tienen foto o no, para mostrar los iconos acorde
                    if($data['subcategoria'] == null)
                    {
                        $idcategoria = $data['categoria'];
                        $query_meses = mysqli_query($conexion, "SELECT meses_garantia from categoria where idcategoria = '$idcategoria'");
                        $garantia = mysqli_fetch_assoc($query_meses)['meses_garantia'];

                        //no tiene sub
                        $select_producto_nosub = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, atr1_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria WHERE idproducto = '$id_producto'");
                        $data_producto = mysqli_fetch_assoc($select_producto_nosub);
                        $catproducto = $data_producto['catproducto'];
                        $atr1_producto = $data_producto['atr1_producto'];
                        //creamos la ubicacion
                        $estructura = "../img/catalogo_productos/".$catproducto."/".$atr1_producto;
                    }
                    else
                    {
                        $idsubcategoria = $data['subcategoria'];
                        $query_meses = mysqli_query($conexion, "SELECT meses_garantia from subcategoria where idsubcategoria = '$idsubcategoria'");
                        $garantia = mysqli_fetch_assoc($query_meses)['meses_garantia'];

                        $select_producto_full = mysqli_query($conexion, "SELECT categoria.nombre as catproducto, subcategoria.nombre as subcat_producto, atr1_producto FROM producto INNER JOIN categoria on categoria.idcategoria = producto.categoria INNER JOIN subcategoria on subcategoria.idsubcategoria = producto.subcategoria WHERE idproducto = '$id_producto'");
                        $data_producto = mysqli_fetch_assoc($select_producto_full);
                        $catproducto = $data_producto['catproducto'];
                        $subcat_producto = $data_producto['subcat_producto'];
                        $atr1_producto = $data_producto['atr1_producto'];
                        //creamos la ubicacion
                        $estructura = "../img/catalogo_productos/".$catproducto."/".$subcat_producto."/".$atr1_producto;
                    }
                    //aqui vamos a ver si tienen foto o no, para mostrar los iconos acorde
                    $archivador = $estructura."/".$identificador.".png";
                    if(is_file($archivador))
                    {
                        $boton_img = "btn btn-primary btn-sm";
                        $siimagen = 1;
                    }
                    else
                    {
                        $boton_img = "btn btn-secondary btn-sm";
                        $siimagen = 0;
                    }

             ?>
                <tr>
                        <td><?php echo $data['descripcion']; ?></td>
                        <td width="110"><input type="number" name="nuevo_costo[]" id="nuevo_costo[]" class="form-control"><input type="text" name="flag_new_costo_idproducto[]" id="flag_new_costo_idproducto[]" value="<?php echo $id_producto; ?>" readonly hidden></td>
                        <td><?php echo "$".number_format($data['costo'],2, '.', ','); ?></td>
                        <td><?php echo "$".number_format($data['costo_iva'],2, '.', ','); ?></td>
                        <td width="110"><input type="number" name="nuevo_ext_p[]" id="nuevo_ext_p[]" class="form-control"><input type="text" name="flag_new_extp_idproducto[]" id="flag_new_extp_idproducto[]" value="<?php echo $id_producto; ?>" readonly hidden></td>
                        <td><?php echo $data['ext_p']; ?></td>
                        <td>---</td>
                        <td><?php echo "$".number_format($data['costo_contado'],2, '.', ','); ?></td>
                        <td><?php echo "$".number_format($data['costo_especial'],2, '.', ','); ?></td>
                        <td><?php echo "$".number_format($data['costo_cr1'],2, '.', ','); ?></td>
                        <td><?php echo round($data['costo_p1'],2); ?></td>
                        <td><?php echo "$".number_format($data['costo_cr2'],2, '.', ','); ?></td>
                        <td><?php echo round($data['costo_p2'],2); ?></td>
                        <td><?php echo "$".number_format($data['costo_eq'],2, '.', ','); ?></td>
                        <td><?php echo $garantia." Meses" ?></td>
                        <td align="center">
                            <button data-toggle="modal" data-target="#img_producto" onclick="mostrar_img('<?php echo $id_producto; ?>','<?php echo $archivador; ?>',<?php echo $siimagen; ?>);" class="<?php echo $boton_img; ?>"><i class="fas fa-camera"></i></button>
                            <?php 
                                if($editar_productos)
                                {
                                    ?>
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#nuevo_producto" onclick='editar_producto("<?php echo $id_producto; ?>");'><i class='fas fa-edit'></i></button>
                                    <?php 
                                }
                                else
                                {
                                    ?>
                                    <button disabled="disabled" class="btn btn-success btn-sm"><i class='fas fa-edit'></i></button>
                                    <?php 
                                }
                                if($eliminar_productos)
                                {
                                    ?>
                                    <button onClick='eliminar_producto("<?php echo $id_producto; ?>");' class='btn btn-danger btn-sm' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>
                                    <?php 
                                }
                                else
                                {
                                    ?>
                                    <button disabled="disabled" class='btn btn-danger btn-sm' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>
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
