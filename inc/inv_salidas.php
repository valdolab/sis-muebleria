<?php 
ob_start();
include_once "header.php";
include "accion/conexion.php";


?>

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

<!-- agregar modalidad de pago -->
<div id="nueva_modalidad_pago" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg text-black">
                <h5 class="modal-title" id="my-modal-title">Agregar modalidad de pago</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="on" id="formAdd_modalidad_pago">
                    <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="correo">Modalidad de pago</label>
                            <input type="text" class="form-control" name="nuevamodalidad_pago" id="nuevamodalidad_pago" required maxlength="99">
                        </div>  
                        </div>
                    </div>

                    <input value="insert_modalidad_pago" name="action" id="action" hidden>
                    <input value="nueva_modalidad_de_pago" name="flagid_modalidadPago" id="flagid_modalidadPago" hidden>
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

<div class="row">
<div class="col-lg-1"></div>
<div class="col-lg-10">
<div class="card"> 
            <div class="card-body">
                    <div class="row">

                        <div class="form-group col-lg-2">
                            <label for="nombre_aval">ID Cliente</label>
                            <input onkeyup="mayusculas(this)" type="text" class="form-control" placeholder="Buscar por ID cliente" name="id_cliente" id="id_cliente">
                        </div>

                        <div class="form-group col-lg-5">
                            <label for="nombre_aval">Cliente</label>
                            <input type="text" class="form-control" placeholder="Buscar por nombre del cliente" name="nom_cliente" id="nom_cliente">
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
                            <?php 
                                if($_SESSION['rol'] == "SuperAdmin" or $_SESSION['rol'] == "Administrador")
                                {
                                    ?>
                                    <button data-toggle="modal" data-target="#nueva_modalidad_pago" onclick="nueva_modadlidad_pago();" title="Agregar nuevo modalidad de pago" class="btn btn-primary btn-xs" type="button" href="#" ><i class="fas fa-plus"></i></button>
                                    <button disabled data-toggle="modal" data-target="#nueva_modalidad_pago" id="btnedit_modalidad_pago" onclick="editar_modalidad_pago();" title="editar modalidad de pago" class="btn btn-success btn-xs" type="button" href="#" ><i class="fas fa-edit"></i></button>
                                    <button disabled id="btndelete_modalidad_pago" onclick="eliminar_modalidad_pago();" title="Eliminar modalidad de pago" class="btn btn-danger btn-xs" type="button" href="#" ><i class="fas fa-trash"></i></button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <button disabled="disabled" title="Agregar nueva modalidad" class="btn btn-primary btn-xs" type="button"><i class="fas fa-plus"></i></button>
                                    <button disabled="disabled" title="editar modalidad" class="btn btn-success btn-xs" type="button"><i class="fas fa-edit"></i></button>
                                    <button disabled disabled="disabled" title="Eliminar modalidad" class="btn btn-danger btn-xs" type="button"><i class="fas fa-trash"></i></button>
                                    <?php 
                                } 
                             ?>
                            <select id='modalidad_pago' name='modalidad_pago' class='form-control' required>
                                <option selected hidden value=''>Seleccione una modalidad</option>
                                <?php
                                $result = mysqli_query($conexion,"SELECT idmodalidad_pago,nombre_modalidad FROM modalidad_pago");                        
                                if (mysqli_num_rows($result) > 0) {  
                                  while($row = mysqli_fetch_assoc($result))
                                  {
                                    echo "<option value='".$row["idmodalidad_pago"]."'>".$row["nombre_modalidad"]."</option>";
                                  }
                                }
                                ?>
                            </select> 
                        </div>

                        <div class="form-group col-lg-2">
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

                        <div class="form-group col-lg-3">
                            <label for="puesto_aval">Días de pago</label>
                            <select id='dias_pago' name='dias_pago' class='form-control' required>
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

                        <div align="right" class="form-group col-lg-3">
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