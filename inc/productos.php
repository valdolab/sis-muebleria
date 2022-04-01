<?php 
ob_start();
include_once "header.php";
include "accion/conexion.php";

if (!empty($_POST)) 
{
    $ban = $_POST['bandera'];
    if($ban == "cat")
    {
        $modal = "$('#mensaje_success').modal('show');";
    }
    else if($ban == "producto")
    {
        $modal = "$('#mensaje_success').modal('show');";
    }
}
?>

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
                            <h2 id="swal2-title" class="swal2-title" style="display: flex;">Listo!</h2>
                        </div>

                        <div class="swal2-content">
                            <div id="swal2-content" class="swal2-html-container" style="display: block;">
                                Categoría registrada correctamete
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

<div id="nueva_cat" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
        <form action="" method="post" autocomplete="on">
            <div class="modal-header">
                <h3 class="modal-title">Detalle Categoría</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-lg btn-danger" data-dismiss="modal" aria-label="Close">
                            Cancelar
                        </button>
                    </div>
                    <div class="col-lg-6">
                        <input type="submit" value="Guardar" class="btn btn-lg btn-success">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="nombre_cat">Nombre</label>
                                <input type="text" class="form-control" name="nombre_cat" id="nombre_cat" required>
                            </div>  
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr1">Atributo 1</label>
                                <input type="text" class="form-control" name="atr1" id="atr1">
                            </div>  
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr2">Atributo 2</label>
                                <input type="text" class="form-control" name="atr2" id="atr2">
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr3">Atributo 3</label>
                                <input type="text" class="form-control" name="atr3" id="atr3">
                            </div>  
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr4">Atributo 4</label>
                                <input type="text" class="form-control" name="atr4" id="atr4">
                            </div>  
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr5">Atributo 5</label>
                                <input type="text" class="form-control" name="atr5" id="atr5">
                            </div>  
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <label for="iva">IVA:</label>
                            <div class="input-group mb-3">
                              <input name="iva" id="iva" type="number" class="form-control" aria-label="Monto en pesos mexicanos" value="16" disabled>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="iva">CON:</label>
                            <div class="input-group mb-3">
                              <input name="con" id="con" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="iva">ESP:</label>
                            <div class="input-group mb-3">
                              <input name="esp" id="esp" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="iva">ALT:</label>
                            <div class="input-group mb-3">
                              <input name="alt" id="alt" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <label for="iva">CR1:</label>
                            <div class="input-group mb-3">
                              <input name="cr1" id="cr1" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="iva">CR2:</label>
                            <div class="input-group mb-3">
                              <input name="cr2" id="cr2" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="iva">EN-Q:</label>
                            <input name="enq" id="enq" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="iva">Meses de pago:</label>
                            <input name="meses_pago" id="meses_pago" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                        </div>
                    </div>
                    <input value="cat" name="bandera" id="bandera" hidden>
            </div>
        </form>
        </div>
    </div>
</div>

<div id="nueva_subcat" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
        <form action="" method="post" autocomplete="on">
            <div class="modal-header">
                <h3 class="modal-title">Detalle Subcategoría</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-lg btn-danger" data-dismiss="modal" aria-label="Close">
                            Cancelar
                        </button>
                    </div>
                    <div class="col-lg-6">
                        <input type="submit" value="Guardar" class="btn btn-lg btn-success">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="nombre_cat">Nombre</label>
                                <input type="text" class="form-control" name="nombre_cat" id="nombre_cat" required>
                            </div>  
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr1">Atributo 1</label>
                                <input type="text" class="form-control" name="atr1" id="atr1">
                            </div>  
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr2">Atributo 2</label>
                                <input type="text" class="form-control" name="atr2" id="atr2">
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr3">Atributo 3</label>
                                <input type="text" class="form-control" name="atr3" id="atr3">
                            </div>  
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr4">Atributo 4</label>
                                <input type="text" class="form-control" name="atr4" id="atr4">
                            </div>  
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr5">Atributo 5</label>
                                <input type="text" class="form-control" name="atr5" id="atr5">
                            </div>  
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <label for="iva">IVA:</label>
                            <div class="input-group mb-3">
                              <input name="iva" id="iva" type="number" class="form-control" aria-label="Monto en pesos mexicanos" value="16" disabled>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="iva">CON:</label>
                            <div class="input-group mb-3">
                              <input name="con" id="con" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="iva">ESP:</label>
                            <div class="input-group mb-3">
                              <input name="esp" id="esp" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="iva">ALT:</label>
                            <div class="input-group mb-3">
                              <input name="alt" id="alt" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <label for="iva">CR1:</label>
                            <div class="input-group mb-3">
                              <input name="cr1" id="cr1" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="iva">CR2:</label>
                            <div class="input-group mb-3">
                              <input name="cr2" id="cr2" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                              <div class="input-group-append">
                                <span class="input-group-text">%</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="iva">EN-Q:</label>
                            <input name="enq" id="enq" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="iva">Meses de pago:</label>
                            <input name="meses_pago" id="meses_pago" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                        </div>
                    </div>
                    <input value="cat" name="bandera" id="bandera" hidden>
            </div>
        </form>
        </div>
    </div>
</div>

<div id="nuevo_producto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
        <form action="" method="post" autocomplete="on">
            <div class="modal-header">
                <h3 class="modal-title">Detalle del Producto</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-lg btn-danger" data-dismiss="modal" aria-label="Close">
                            Cancelar
                        </button>
                    </div>
                    <div class="col-lg-6">
                        <input type="submit" value="Guardar" class="btn btn-lg btn-success">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3">
                          <div class="form-group">
                                <label for="nombre_cat">Identificador</label>
                                <input type="text" class="form-control" name="identificador" id="identificador" required>
                            </div>  
                        </div>

                        <div class="col-lg-3">
                          <div class="form-group">
                                <label for="atr1">Código de Barras</label>
                                <input type="text" class="form-control" name="codebarras" id="codebarras">
                            </div>  
                        </div>

                        <div class="col-lg-4">
                            <label>Categorias:</label>
                            <select class="form-control" id="categoria_producto" name="categoria_producto">
                                <option selected hidden>Selecciona categoría</option>
                                <option value="Lavadora">Lavadora</option>
                                <option value="Televición">Televición</option>
                                <option value="Refrigerador">Refrigerador</option>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <label for="atr3">Serializado</label>
                            <input onchange="" id="serializado" name="serializado" value="si_serializado" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="secondary" data-size="sm" data-on="SI" data-off="NO">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Descripción</label>
                            <textarea  class="form-control" name="desc" title="Ingrese la descripción del producto" id="desc" placeholder="Ingrese la descripción detallada del producto" maxlength="50000"></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <label for="iva">COSTO:</label>
                            <div class="input-group mb-3">
                              <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="costo" id="costo" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                            </div>
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="iva">IVA:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="iva" id="iva" type="number" class="form-control" aria-label="Monto en pesos mexicanos" value="400" disabled>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="iva">CON:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="con" id="con" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                            </div>
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="iva">EN-Q:</label>
                            <input name="enq" id="enq" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                        </div>
                        <div class="form-group col-lg-2">
                            <label for="iva">Extra:</label>
                            <input name="extra" id="extra" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <label for="iva">ALT:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="alt" id="alt" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="iva">CR1:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="cr1" id="cr1" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="iva">CR2:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="cr2" id="cr2" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="iva">ESP:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="esp" id="esp" type="number" class="form-control" aria-label="Monto en pesos mexicanos" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr1">Atributo 1: </label>
                                <label id="label_atr1" style="font-weight: bold;"></label>
                                <input type="text" class="form-control" name="atr1_producto" id="atr1_producto" disabled>
                            </div>  
                        </div>

                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr1">Atributo 2: </label>
                                <label id="label_atr2" style="font-weight: bold;"></label>
                                <input type="text" class="form-control" name="atr2_producto" id="atr2_producto" disabled>
                            </div>  
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr1">Atributo 3: </label>
                                <label id="label_atr3" style="font-weight: bold;"></label>
                                <input type="text" class="form-control" name="atr3_producto" id="atr3_producto" disabled>
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr1">Atributo 4: </label>
                                <label id="label_atr4" style="font-weight: bold;"></label>
                                <input type="text" class="form-control" name="atr4_producto" id="atr4_producto" disabled>
                            </div>  
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                                <label for="atr1">Atributo 5: </label>
                                <label id="label_atr5" style="font-weight: bold;"></label>
                                <input type="text" class="form-control" name="atr5_producto" id="atr5_producto" disabled>
                            </div>  
                        </div>
                    </div>
                    <input value="producto" name="bandera" id="bandera" hidden>
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
            <button data-toggle="modal" data-target="#nuevo_producto" class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Nuevo producto</button> 
        </div>
    </div>
</div>
</div>

<div class="card">
<div class="card-body">
<form action="" method="post" autocomplete="off">
    <div class="row">
        <div class="col-lg-2">
            <label>Categoria:</label>
            <button data-toggle="modal" data-target="#nueva_cat" title="Agregar nuevo puesto" class="btn btn-primary btn-xs" type="button" href="#" ><i class="fas fa-plus"></i></button>
            <button data-toggle="modal" data-target="#editar_puesto" onclick="editar_puesto();" title="editar puesto" class="btn btn-success btn-xs" type="button" href="#" id="btn_editarpuesto"><i class="fas fa-edit"></i></button>
            <button onclick="eliminar_puesto();" title="Eliminar puesto" class="btn btn-danger btn-xs" type="button" href="#" id="btn_eliminarpuesto"><i class="fas fa-trash"></i></button>

            <select class="form-control" id="filtro1" name="filtro1">
                <option selected hidden>Selecciona categoría</option>
                <option value="Lavadora">Lavadora</option>
                <option value="Televición">Televición</option>
                <option value="Refrigerador">Refrigerador</option>
            </select>
        </div>
        <div class="col-lg-2">
            <label>Subcategoria:</label>
            <button data-toggle="modal" data-target="#nueva_subcat" title="Agregar nuevo puesto" class="btn btn-primary btn-xs" type="button" href="#" ><i class="fas fa-plus"></i></button>
            <button data-toggle="modal" data-target="#editar_puesto" onclick="editar_puesto();" title="editar puesto" class="btn btn-success btn-xs" type="button" href="#" id="btn_editarpuesto"><i class="fas fa-edit"></i></button>
            <button onclick="eliminar_puesto();" title="Eliminar puesto" class="btn btn-danger btn-xs" type="button" href="#" id="btn_eliminarpuesto"><i class="fas fa-trash"></i></button>

            <select class="form-control" id="filtro1" name="filtro1">
                <option selected hidden>Selecciona categoría</option>
                <option value="Lavadora">Lavadora</option>
                <option value="Televición">Televición</option>
                <option value="Refrigerador">Refrigerador</option>
            </select>
        </div>
        <div align="left" class="col-lg-1">
            <label>Atributo 1:</label>
            <select class="form-control" id="filtro1" name="filtro1">
                <option selected hidden>Tinas</option>
                <option value="1">1</option>
                <option value="1">2</option>
                <option value="1">3</option>
            </select>
        </div>
        <div align="left" class="col-lg-1">
            <label>Atributo 2:</label>
            <select class="form-control" id="filtro1" name="filtro1">
                <option selected hidden>KG</option>
                <option value="1">9</option>
                <option value="1">12</option>
            </select>
        </div>
        <div align="left" class="col-lg-1">
            <label>Atributo 3:</label>
            <select class="form-control" id="filtro1" name="filtro1">
                <option selected hidden>Tipo</option>
                <option value="1">A</option>
                <option value="1">B</option>
            </select>
        </div>
        <div align="left" class="col-lg-1">
            <label>Atributo 4:</label>
            <select class="form-control" id="filtro1" name="filtro1">
                <option selected hidden>Secadora</option>
                <option value="1">Sí</option>
                <option value="1">No</option>
            </select>
        </div>
        <div align="left" class="col-lg-1">
            <label>Atributo 5:</label>
            <select class="form-control" id="filtro1" name="filtro1">
                <option selected hidden>---</option>
            </select>
        </div>
        <div class="col-lg-3">
            <input value="modificarLista" name="bandera" id="bandera" hidden>
            <button type="submit" class="btn btn-primary py-3 btn-sm" style="width: 65px !important;">Ver Costos</button>

            <input value="modificarLista" name="bandera" id="bandera" hidden>
            <button type="submit" class="btn btn-primary py-3 btn-sm" style="width: 70px !important;">Editar Listas</button>

            <input value="modificarLista" name="bandera" id="bandera" hidden>
            <button type="submit" class="btn btn-primary py-3 btn-sm" style="width: 95px !important;">Descargar Catalogo</button>

            <input value="modificarLista" name="bandera" id="bandera" hidden>
            <button type="submit" class="btn btn-primary py-3 btn-sm" style="width: 95px !important;">Descargar Lista</button>
        </div>
    </div>
</form>
</div>
</div>



<div class="card">
<div class="card-body">
<div class="table-responsive">
    <table class="table" id="tbl">
        <thead class="thead-light">
            <tr>
                <th>Descripción</th>
                <th>Costo</th>
                <th>Costo+IVA</th>
                <th>Ext.-P</th>
                <th>Ext-M</th>
                <th>Contado</th>
                <th>CR1</th>
                <th>P1</th>
                <th>CR2</th>
                <th>P2</th>
                <th>E-Q</th>
                <th>P2</th>
                <th>E-Q</th>
                <th>GAR</th>
                <th style="text-align: center;">Herramientas</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                        <td>Lavadora LG con secadora</td>
                        <td>$5,000</td>
                        <td>$5,500</td>
                        <td>$4,000</td>
                        <td>$4,000</td>
                        <td>$5,000</td>
                        <td>$4,000</td>
                        <td>$5,000</td>
                        <td>$4,000</td>
                        <td>$5,000</td>
                        <td>$4,000</td>
                        <td>$5,000</td>
                        <td>$4,000</td>
                        <td>$5,000</td>
                        <td align="center">
                                <a href="#" class="btn btn-success btn-sm"><i class='fas fa-edit'></i></a>
                                <button onClick='eliminar_producto()' class='btn btn-danger btn-sm' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>
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
