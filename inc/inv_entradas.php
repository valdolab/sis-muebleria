<?php 
ob_start();
include_once "header.php";
include "accion/conexion.php";


?>

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
                            <input type="date" class="form-control" placeholder="" name="fecha" id="fecha">
                        </div>

                        <div class="col-lg-2">
                            <label for="zona">Zona</label>
                             <?php 
                                if($_SESSION['rol'] == "SuperAdmin" or $_SESSION['rol'] == "Administrador")
                                {
                                    ?>
                                    <button data-toggle="modal" data-target="#nueva_zona" title="Agregar nueva zona" class="btn btn-primary btn-xs" type="button" href="#" ><i class="fas fa-plus"></i></button>
                                    <button disabled data-toggle="modal" data-target="#editar_zona" id="btnedit_zona" onclick="editar_zona();" title="editar zona" class="btn btn-success btn-xs" type="button" href="#" ><i class="fas fa-edit"></i></button>
                                    <button disabled id="btneliminar_zona" onclick="eliminar_zona();" title="Eliminar zona" class="btn btn-danger btn-xs" type="button" href="#" ><i class="fas fa-trash"></i></button>
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
                                    <button disabled id="btneliminar_subzona" onclick="eliminar_subzona();" title="Eliminar subzona" class="btn btn-danger btn-xs" type="button" href="#" ><i class="fas fa-trash"></i></button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <button disabled="disabled" title="Agregar nueva subzona" class="btn btn-primary btn-xs" type="button"><i class="fas fa-plus"></i></button>
                                    <button disabled="disabled" title="editar subzona" class="btn btn-success btn-xs" type="button"><i class="fas fa-edit"></i></button>
                                    <button disabled disabled="disabled" title="Eliminar subzona" class="btn btn-danger btn-xs" type="button"><i class="fas fa-trash"></i></button>
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
                            <label for="puesto_aval">Tipo de venta</label>

                            <button disabled="disabled" title="Agregar nuevo tipo" class="btn btn-primary btn-xs" type="button"><i class="fas fa-plus"></i></button>
                            <button disabled="disabled" title="editar tipo" class="btn btn-success btn-xs" type="button"><i class="fas fa-edit"></i></button>
                            <button disabled disabled="disabled" title="Eliminar tipo" class="btn btn-danger btn-xs" type="button"><i class="fas fa-trash"></i></button>

                            <select id='tipo_venta' name='tipo_venta' class='form-control' required>
                                <option selected hidden value=''>Seleccione un tipo</option>
                                <option value="Credito">Credito</option>
                                <option value="Contado">Contado</option>
                                <option value="PayJoy">PayJoy</option>
                            </select> 
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="puesto_aval">Modalidad de pagos</label>

                            <button disabled="disabled" title="Agregar nueva modalidad" class="btn btn-primary btn-xs" type="button"><i class="fas fa-plus"></i></button>
                            <button disabled="disabled" title="editar modalidad" class="btn btn-success btn-xs" type="button"><i class="fas fa-edit"></i></button>
                            <button disabled disabled="disabled" title="Eliminar modalidad" class="btn btn-danger btn-xs" type="button"><i class="fas fa-trash"></i></button>

                            <select id='modalidad_pago' name='modalidad_pago' class='form-control' required>
                                <option selected hidden value=''>Seleccione una modalidad</option>
                                <option value="Quincenal">Quincenal</option>
                                <option value="Semanal">Semanal</option>
                                <option value="Mensual">Mensual</option>
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

                        <div class="form-group col-lg-3">
                            <label for="n_pagos">1er día de pago</label>
                            <input type="date" class="form-control" name="n_pagos" id="n_pagos">
                        </div>

                        <div align="right" class="form-group col-lg-5">
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
