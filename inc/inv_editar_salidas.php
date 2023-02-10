<?php 
ob_start();
include_once "header.php";
include "accion/conexion.php";

// Mostrar Datos
if (empty($_GET['id'])) 
{
  header("Location: lista_salidas.php");
}
else
{
    $id_salida = $_GET['id'];
    $sql = mysqli_query($conexion, "SELECT * FROM salida where idsalida = '$id_salida'");
    $result_sql = mysqli_num_rows($sql);
    if ($result_sql == 0) {
      header("Location: lista_salidas.php");
    }
    else
    {
        $data = mysqli_fetch_array($sql);
        $up_vendedor = $data['vendedor'];
        $up_cliente = $data['cliente'];
        $up_fecha = date("Y-m-d", strtotime($data['fecha_salida']));
        $up_docu = $data['documento'];
        $up_folio = $data['folio_venta'];
        $up_tipo_venta = $data['tipo_venta'];
        $up_modalidad = $data['modalidad_pago'];
        $up_no_pagos = $data['no_pagos'];
        $up_pago_parcial = $data['pago_parcial'];
        $up_per_dia_pago = $data['per_dia_pago'];
        $up_dias_pago_semanal = $data['dias_pago_semanal'];
        $up_dias_pago_quincenal = $data['dias_pago_quincenal'];
        $up_dias_pago_quincenal_2 = $data['dias_pago_quincenal_2'];
        $up_dias_pago_mensual = $data['dias_pago_mensual'];
        $up_enganche = $data['enganche'];
        //montos
        $up_subtotal1 = $data['subtotal1'];   
        $up_ivas = $data['iva']; 
        $up_subtotal2 = $data['subtotal2'];  
        $up_descuento = $data['descuento'];   
        $up_total_general = $data['total_general'];

        $up_activo = $data['activo'];
        $up_nivel_salida = $data['nivel_salida'];

        //info del cliente
        $sql_cliente = mysqli_query($conexion, "SELECT zona,subzona,tel1_cliente from cliente where idcliente ='$up_cliente'");
        $data_cliente = mysqli_fetch_assoc($sql_cliente);
        $up_tel_cliente = $data_cliente['tel1_cliente'];
        $up_zona = $data_cliente['zona'];
        $up_subzona = $data_cliente['subzona'];


    } 
}

function actualizar_fechas($f, $size_fechas, $fechas_ideales, $up_dias_pago_mensual, $up_dias_pago_quincenal, $up_dias_pago_quincenal_2, $up_modalidad)
{
    //esto es para cuando se pasa aun mas de lo esperado, ir sumando nuevos rangos
                                if($f+1 >= $size_fechas-1)
                                {
                                    //ir agregando al array las nuevas fechas, por atrasarse más de lo ideal
                                    $new_fecha = $fechas_ideales[$size_fechas-1];
                                    //////// ir agregando las fechas
                                    if($up_modalidad == "mensual")
                                    {
                                        //up_dias_pago_mensual
                                        //$new_fecha = date("Y-m-d", strtotime($new_fecha. ' + 1 month'));
                                        list($anio, $mes, $dia) = explode("-", $new_fecha);

                                        if(intval($dia) <= intval($up_dias_pago_mensual)-10)
                                        {
                                            $new_fecha = $anio."-".$mes."-".$up_dias_pago_mensual;
                                            $new_fecha = date("Y-m-d", strtotime($new_fecha));
                                        }
                                        else
                                        {
                                            if(intval($mes) == 12)
                                            {
                                                $new_fecha = strval(intval($anio)+1)."-01-".$up_dias_pago_mensual;
                                                $new_fecha = date("Y-m-d", strtotime($new_fecha));
                                            }
                                            else
                                            {
                                                $new_fecha = $anio."-".strval(intval($mes)+1)."-".$up_dias_pago_mensual;
                                                $new_fecha = date("Y-m-d", strtotime($new_fecha));
                                            }
                                        }
                                    }
                                    else if($up_modalidad == "quincenal")
                                    {
                                        //$new_fecha = date("Y-m-d", strtotime($new_fecha. ' + 2 weeks'));
                                        list($anio, $mes, $dia) = explode("-", $new_fecha);
                                        if($dia <= intval($up_dias_pago_quincenal)-10 or $dia >= intval($up_dias_pago_quincenal_2)-10)
                                        {
                                            $new_fecha = $anio."-".strval(intval($mes)+1)."-".$up_dias_pago_quincenal;
                                            $new_fecha = date("Y-m-d", strtotime($new_fecha));
                                        }
                                        else
                                        {
                                            $new_fecha = $anio."-".$mes."-".$up_dias_pago_quincenal_2;
                                            $new_fecha = date("Y-m-d", strtotime($new_fecha));
                                        }
                                    }
                                    else if($up_modalidad == "semanal")
                                    {
                                        $new_fecha = date("Y-m-d", strtotime($new_fecha. ' + 1 week'));
                                    }
                                    //add to array
                                    array_push($fechas_ideales, $new_fecha);
                                }
    return $fechas_ideales;
}

function actualizar_fechas_inicial($fechas_ideales, $up_dias_pago_mensual, $up_dias_pago_quincenal, $up_dias_pago_quincenal_2, $up_modalidad, $hoy)
{
    //esto es para cuando se pasa aun mas de lo esperado, ir sumando nuevos rangos
    while (True) 
    {
        $size_fechas = sizeof($fechas_ideales);
                                if($hoy >= $fechas_ideales[$size_fechas-1])
                                {
                                    //ir agregando al array las nuevas fechas, por atrasarse más de lo ideal
                                    $new_fecha = $fechas_ideales[$size_fechas-1];
                                    //////// ir agregando las fechas
                                    if($up_modalidad == "mensual")
                                    {
                                        //up_dias_pago_mensual
                                        //$new_fecha = date("Y-m-d", strtotime($new_fecha. ' + 1 month'));
                                        list($anio, $mes, $dia) = explode("-", $new_fecha);
                                        if(intval($dia) <= intval($up_dias_pago_mensual)-10)
                                        {
                                            $new_fecha = $anio."-".$mes."-".$up_dias_pago_mensual;
                                            $new_fecha = date("Y-m-d", strtotime($new_fecha));
                                        }
                                        else
                                        {
                                            if(intval($mes) == 12)
                                            {
                                                $new_fecha = strval(intval($anio)+1)."-01-".$up_dias_pago_mensual;
                                                $new_fecha = date("Y-m-d", strtotime($new_fecha));
                                            }
                                            else
                                            {
                                                $new_fecha = $anio."-".strval(intval($mes)+1)."-".$up_dias_pago_mensual;
                                                $new_fecha = date("Y-m-d", strtotime($new_fecha));
                                            }
                                        }
                                    }
                                    else if($up_modalidad == "quincenal")
                                    {
                                        //$new_fecha = date("Y-m-d", strtotime($new_fecha. ' + 2 weeks'));
                                        list($anio, $mes, $dia) = explode("-", $new_fecha);
                                        if($dia <= intval($up_dias_pago_quincenal)-10 or $dia >= intval($up_dias_pago_quincenal_2)-10)
                                        {
                                            $new_fecha = $anio."-".strval(intval($mes)+1)."-".$up_dias_pago_quincenal;
                                            $new_fecha = date("Y-m-d", strtotime($new_fecha));
                                        }
                                        else
                                        {
                                            $new_fecha = $anio."-".$mes."-".$up_dias_pago_quincenal_2;
                                            $new_fecha = date("Y-m-d", strtotime($new_fecha));
                                        }
                                    }
                                    else if($up_modalidad == "semanal")
                                    {
                                        $new_fecha = date("Y-m-d", strtotime($new_fecha. ' + 1 week'));
                                    }
                                    //add to array
                                    array_push($fechas_ideales, $new_fecha);
                                }
                                else
                                {
                                    break;
                                }   
    }    
    return $fechas_ideales;
}                     

?>

<div id="vendedores" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Asignaciones</h3>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="on" id="formAdd_vendedores_a_cargo">
                    <div class="row">
                        <div class="col-lg">
                            <label for="persona_a_cargo">Persona a cargo</label>
                            <select id='persona_a_cargo' name='persona_a_cargo' class='form-control' required>
                                <option selected hidden value=''>Seleccione un usuario</option>
                                <?php 
                                $result = mysqli_query($conexion,"SELECT idusuario,usuario_acceso,nombre FROM usuario order by usuario_acceso desc");                        
                                if (mysqli_num_rows($result) > 0) 
                                {  
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        echo "<option value='".$row["idusuario"]."'>".$row["usuario_acceso"]."</option>";
                                    }
                                }
                                ?>
                            </select> 
                        </div>
                        <div class="col-lg">
                            <label for="vendedor_venta">Cobrador designado</label>
                                    <select id='vendedor_venta' name='vendedor_venta' class='form-control'>
                                        <option selected hidden value=''>Seleccione una opción</option>
                                        <?php 
                                            $result = mysqli_query($conexion,"SELECT idusuario,usuario_acceso,nombre FROM usuario order by usuario_acceso desc");                        
                                            if (mysqli_num_rows($result) > 0) {  
                                              while($row = mysqli_fetch_assoc($result))
                                              {
                                                if($up_vendedor== $row["idusuario"])
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
                    </div>
                    <br>
                    <input value="<?php echo $id_salida; ?>" name="flag_id_salida" id="flag_id_salida"  readonly>
                    <?php 
                        $result = mysqli_query($conexion,"SELECT idsalida_usuarios_a_cargo from salida_usuarios_a_cargo where salida = '$id_salida'"); 
                        if(mysqli_num_rows($result) == 0)
                        {
                            echo '<input value="nueva_personas_a_cargo" name="flag_id_persona_a_cargo" id="flag_id_persona_a_cargo" readonly>';
                        }
                        else
                        {
                            $idsalida_usuarios_a_cargo = mysqli_fetch_assoc($result)['idsalida_usuarios_a_cargo'];
                            echo '<input value="'.$idsalida_usuarios_a_cargo.'" name="flag_id_persona_a_cargo" id="flag_id_persona_a_cargo" readonly>';
                        }
                     ?>
                    <input value="insert_edit_personas_a_cargo" name="action" id="action"  readonly>
                    <div align="right">
                        <input type="submit" value="Agregar" class="btn btn-lg btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- aqui van los atrasos, solo sera mostrar toda la info de los atrasos -->



<div id="nueva_modaliadad_pago" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Nuevo acuerdo</h3>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="on" id="formAdd_modalidad_pago_actual">
                    <div class="row">
                        <div class="col-lg">
                            <label for="modalidad_pago_actual">Modalidad de pagos</label>
                            <select id='modalidad_pago_actual' name='modalidad_pago_actual' class='form-control' required>
                                <option selected hidden value=''>Seleccione una modalidad</option>
                                <option value='semanal'>Semanal</option>
                                <option value='quincenal'>Quincenal</option>
                                <option value='mensual'>Mensual</option>
                            </select> 
                        </div>
                        <div class="col-lg">
                            <label for="dias_pago_semanal">Semanal</label>
                                    <select id='dias_pago_semanal_actual' name='dias_pago_semanal_actual' class='form-control' disabled>
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
                        <div class="col-lg">
                                    <label for="dias_pago_mensual">Mensual</label>
                                    <input type="number" class="form-control" name="dias_pago_mensual_actual" id="dias_pago_mensual_actual" disabled>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg">
                                    <label for="dias_pago_quincenal">Quincenal</label>
                                    <input type="number" class="form-control" name="dias_pago_quincenal_actual" id="dias_pago_quincenal_actual" disabled>
                        </div>
                        <div class="col-lg">
                                    <label for="dias_pago_quincenal">Quincenal 2</label>
                                    <input type="number" class="form-control" name="dias_pago_quincenal_2_actual" id="dias_pago_quincenal_2_actual" disabled>
                        </div>
                        <div class="col-lg">
                                    <label for="dias_pago_mensual">Nuevo pago</label>
                                    <input type="number" class="form-control" name="nuevo_pago" id="nuevo_pago">
                        </div>
                    </div>
                    <br>
                    <input value="<?php echo $id_salida; ?>" name="flag_id_salida" id="flag_id_salida"  readonly>
                    <input value="nueva_modaliadad_pago_actual" name="flag_id_modaliadad_pago_actual" id="flag_id_modaliadad_pago_actual"  readonly>
                    <input value="insert_edit_modalidad_pago_actual" name="action" id="action"  readonly>
                    <div align="right">
                        <input type="submit" value="Agregar" class="btn btn-lg btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="haz_movimiento" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Movimiento</h3>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="on" id="formAdd_movimiento">
                    <div class="row">
                        <div class="col-lg">
                          <div class="form-group">
                            <label for="correo">Fecha:</label>
                            <input type="date" name="fecha_abono" id="fecha_abono" class="form-control" value="<?php echo date("Y-m-d"); ?>">
                        </div>  
                        </div>
                        <div class="col-lg">
                          <div class="form-group">
                            <label for="correo">Abono:</label>
                            <input type="number" name="abono_hecho" id="abono_hecho" class="form-control">
                        </div>  
                        </div>
                        <div class="col-lg">
                          <div class="form-group">
                            <label for="correo">Descuento:</label>
                            <input type="number" name="descuento_hecho" id="descuento_hecho" class="form-control">
                        </div>  
                        </div>
                        <div class="col-lg">
                          <div class="form-group">
                            <label for="correo">Recargo:</label>
                            <input type="number" name="recargo" id="recargo" class="form-control">
                        </div>  
                        </div>
                    </div>
                    <br>
                    <input value="<?php echo $id_salida; ?>" name="flag_id_salida" id="flag_id_salida"  readonly>
                    <input value="nuevo_movimiento" name="flag_id_movimiento" id="flag_id_movimiento"  readonly>
                    <input value="insert_edit_movimiento" name="action" id="action"  readonly>
                    <div align="right">
                        <input type="submit" value="Agregar" class="btn btn-lg btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
        <div class="col-lg-8">
            <h3><strong>SALIDAS</strong></h3>
            <!--<input type="" name="prueba" id="prueba">-->
        </div>


        <?php 
            $query_salida_pro = mysqli_query($conexion, "SELECT idsalida_producto, salida, producto, cantidad, tipo_precio, precio_x_unidad, precio_total FROM salida_productos WHERE salida = '$id_salida'");
            $num_salida_pro = mysqli_num_rows($query_salida_pro);
         ?>
        <div align="right" class="col-lg-4">
            <a onclick="editar_salida(<?php echo $num_salida_pro; ?>)" class="btn btn-primary" type="button" ><i class="fas fa-edit"></i> Editar</a>
            <a href="lista_salidas.php" class="btn btn-primary" type="button" ><i class="fas fa-list"></i> Salidas realizadas</a>
        </div>
    </div>
</div>
</div>
</div>

<fieldset id="form_edit_salida" disabled>
<form action="" method="post" autocomplete="on" id="formEdit_salida">
<div class="col-lg-12">
<div class="card"> 
            <div class="card-body">
                    <div class="row">

                        <div class="col-lg-2">
                            <label for="vendedor">Vendedor</label>
                            <select class="form-control js-example-data-array" id="vendedor" name="vendedor" disabled>
                                <?php
                                #codigo para la lista de sucursales que se extraen de la base de datos
                                $result = mysqli_query($conexion,"SELECT idusuario,usuario_acceso,nombre FROM usuario order by usuario_acceso desc");                        
                                if (mysqli_num_rows($result) > 0) {  
                                  while($row = mysqli_fetch_assoc($result))
                                  {
                                    if($up_vendedor== $row["idusuario"])
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
                            <select class="form-control js-example-data-array" id="id_cliente" name="id_cliente" required disabled>
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
                                        if($up_cliente == $row["idcliente"])
                                        {
                                            echo "<option selected value='".$row["idcliente"]."'>".$ceros.$row["no_cliente"]."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value='".$row["idcliente"]."'>".$ceros.$row["no_cliente"]."</option>";
                                        }
                                      }
                                    }
                                 ?>
                            </select>
                            <!--
                            <input onkeyup="mayusculas(this)" type="text" class="form-control" placeholder="Buscar por ID cliente" name="id_cliente" id="id_cliente"> -->
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="nombre_aval">Cliente</label>
                            <select class="form-control js-example-data-array" id="nom_cliente" name="nom_cliente" required disabled>
                            <option selected hidden></option>
                                <?php 
                                    #codigo para la lista de idclientes que se extraen de la base de datos
                                    $result = mysqli_query($conexion,"SELECT idcliente,nombre_cliente,no_cliente FROM cliente order by no_cliente");                        
                                    if (mysqli_num_rows($result) > 0) {  
                                      while($row = mysqli_fetch_assoc($result))
                                      {
                                        if($up_cliente == $row["idcliente"])
                                        {
                                             echo "<option selected value='".$row["idcliente"]."'>".$row["nombre_cliente"]."</option>";
                                        }
                                        else
                                        {
                                             echo "<option value='".$row["idcliente"]."'>".$row["nombre_cliente"]."</option>";
                                        }
                                      }
                                    }
                                 ?>
                            </select>
                            <!--
                            <input type="text" class="form-control" placeholder="Buscar por nombre del cliente" name="nom_cliente" id="nom_cliente"> -->
                        </div>

                        <div class="form-group col-lg-2">
                            <label for="domicilio_aval">Teléfono</label>
                            <input type="text" class="form-control" placeholder="exp. 9610000000" name="tel_cliente" id="tel_cliente" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $up_tel_cliente; ?>">
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="trabajo_aval">Fecha</label>
                            <input type="date" class="form-control" placeholder="" name="fecha" id="fecha" value="<?php echo $up_fecha; ?>">
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
                                    if($up_zona == $row["idzona"])
                                        {
                                            echo "<option selected value='".$row["idzona"]."'>".$row["zona"]."</option>";
                                        }
                                        else
                                        {
                                             echo "<option value='".$row["idzona"]."'>".$row["zona"]."</option>";
                                        }
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
                                <?php
                                #codigo para la lista de sucursales que se extraen de la base de datos
                                $result = mysqli_query($conexion,"SELECT idsubzona,subzona FROM subzonas where idzona = '$up_zona'");                        
                                if (mysqli_num_rows($result) > 0) {  
                                  while($row = mysqli_fetch_assoc($result))
                                  {
                                    if($up_subzona == $row["idsubzona"])
                                        {
                                            echo "<option selected value='".$row["idsubzona"]."'>".$row["subzona"]."</option>";
                                        }
                                        else
                                        {
                                             echo "<option value='".$row["idsubzona"]."'>".$row["subzona"]."</option>";
                                        }
                                  }
                                }
                                ?>
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
                                    if($up_docu== $row["iddocumento"])
                                        {
                                            echo "<option selected value='".$row["iddocumento"]."' data-folio='".$row["folio"]."' data-serie='".$row["serie"]."'>".$row["name_documento"]."</option>";
                                        }
                                        else
                                        {
                                             echo "<option value='".$row["iddocumento"]."' data-folio='".$row["folio"]."' data-serie='".$row["serie"]."'>".$row["name_documento"]."</option>";
                                        }
                                  }
                                }
                                ?>
                            </select> 
                        </div>

                        <div class="form-group col-lg-2">
                            <label for="folio_venta">Folio de venta</label>
                            <input readonly type="text" class="form-control" name="folio_venta" id="folio_venta" value="<?php echo $up_folio; ?>">
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
                                    if($up_tipo_venta == $row["idtipo_venta"])
                                        {
                                            echo "<option selected value='".$row["idtipo_venta"]."'>".$row["nombre_venta"]."</option>";
                                        }
                                        else
                                        {
                                             echo "<option value='".$row["idtipo_venta"]."'>".$row["nombre_venta"]."</option>";
                                        }
                                  }
                                }
                                ?>
                            </select> 
                        </div>

                        <div class="form-group col-lg-2">
                            <label for="puesto_aval">Modalidad de pagos</label>
                            <select id='modalidad_pago' name='modalidad_pago' class='form-control' required disabled>
                                <option selected hidden value=''>Seleccione una modalidad</option>
                                <?php 
                                    if($up_modalidad == "semanal")
                                        {
                                            echo "<option selected value='semanal'>Semanal</option>
                                                <option value='quincenal'>Quincenal</option>
                                                <option value='mensual'>Mensual</option>";
                                        }
                                        else if($up_modalidad == "quincenal")
                                        {
                                             echo "<option value='semanal'>Semanal</option>
                                                <option selected value='quincenal'>Quincenal</option>
                                                <option value='mensual'>Mensual</option>";
                                        }
                                        else if($up_modalidad == "mensual")
                                        {
                                            echo "<option value='semanal'>Semanal</option>
                                                <option value='quincenal'>Quincenal</option>
                                                <option selected value='mensual'>Mensual</option>";
                                        }
                                 ?>
                            </select> 
                        </div>

                        <div class="form-group col-lg">
                            <label for="n_pagos">No. pagos</label>
                            <input type="number" class="form-control" name="n_pagos" id="n_pagos" step="any" value="<?php echo $up_no_pagos; ?>">
                        </div>

                        <div class="form-group col-lg">
                            <label for="pago_parcial">Pago parcial</label>
                            <input type="number" class="form-control" name="pago_parcial" id="pago_parcial" step="any" value="<?php echo $up_pago_parcial; ?>">
                        </div>

                        <div class="form-group col-lg-2">
                            <label for="n_pagos">1er día de pago</label>
                            <input type="date" class="form-control" name="primer_dia_pago" id="primer_dia_pago" required value="<?php echo $up_per_dia_pago; ?>">
                        </div>

                        <div class="form-group col-lg">
                            <label for="dias_pago_semanal">Semanal</label>
                            <?php 
                                if($up_dias_pago_semanal == NULL)
                                {
                                    ?>
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
                                    <?php 
                                }
                                else
                                {
                                    ?>
                                    <select id='dias_pago_semanal' name='dias_pago_semanal' class='form-control' disabled>
                                        <option selected hidden value=''>Seleccione una opción</option>
                                    <?php 
                                        if($up_dias_pago_semanal == "lunes")
                                        {
                                            echo '<option selected value="lunes">Lunes</option>
                                                    <option value="martes">Martes</option>
                                                    <option value="miercoles">Miercoles</option>
                                                    <option value="jueves">Jueves</option>
                                                    <option value="viernes">Viernes</option>
                                                    <option value="sabado">Sábado</option>
                                                    <option value="domingo">Domingo</option>';
                                        }
                                        else if($up_dias_pago_semanal == "martes")
                                        {
                                            echo '<option value="lunes">Lunes</option>
                                                    <option selected value="martes">Martes</option>
                                                    <option value="miercoles">Miercoles</option>
                                                    <option value="jueves">Jueves</option>
                                                    <option value="viernes">Viernes</option>
                                                    <option value="sabado">Sábado</option>
                                                    <option value="domingo">Domingo</option>';
                                        }
                                        else if($up_dias_pago_semanal == "miercoles")
                                        {
                                            echo '<option value="lunes">Lunes</option>
                                                    <option value="martes">Martes</option>
                                                    <option selected value="miercoles">Miercoles</option>
                                                    <option value="jueves">Jueves</option>
                                                    <option value="viernes">Viernes</option>
                                                    <option value="sabado">Sábado</option>
                                                    <option value="domingo">Domingo</option>';
                                        }
                                        else if($up_dias_pago_semanal == "jueves")
                                        {
                                            echo '<option value="lunes">Lunes</option>
                                                    <option value="martes">Martes</option>
                                                    <option value="miercoles">Miercoles</option>
                                                    <option selected value="jueves">Jueves</option>
                                                    <option value="viernes">Viernes</option>
                                                    <option value="sabado">Sábado</option>
                                                    <option value="domingo">Domingo</option>';
                                        }
                                        else if($up_dias_pago_semanal == "viernes")
                                        {
                                            echo '<option value="lunes">Lunes</option>
                                                    <option value="martes">Martes</option>
                                                    <option value="miercoles">Miercoles</option>
                                                    <option value="jueves">Jueves</option>
                                                    <option selected value="viernes">Viernes</option>
                                                    <option value="sabado">Sábado</option>
                                                    <option value="domingo">Domingo</option>';
                                        }
                                        else if($up_dias_pago_semanal == "sabado")
                                        {
                                            echo '<option value="lunes">Lunes</option>
                                                    <option value="martes">Martes</option>
                                                    <option value="miercoles">Miercoles</option>
                                                    <option value="jueves">Jueves</option>
                                                    <option value="viernes">Viernes</option>
                                                    <option selected value="sabado">Sábado</option>
                                                    <option value="domingo">Domingo</option>';
                                        }
                                        else if($up_dias_pago_semanal == "domingo")
                                        {
                                            echo '<option value="lunes">Lunes</option>
                                                    <option value="martes">Martes</option>
                                                    <option value="miercoles">Miercoles</option>
                                                    <option value="jueves">Jueves</option>
                                                    <option value="viernes">Viernes</option>
                                                    <option value="sabado">Sábado</option>
                                                    <option selected value="domingo">Domingo</option>';
                                        }
                                     ?>
                                    </select> 
                                    <?php 
                                }
                             ?>
                        </div>

                        <div class="form-group col-lg">
                            <label for="dias_pago_quincenal">Quincenal</label>
                            <?php 
                                if($up_dias_pago_quincenal == NULL)
                                {
                                    echo '<input type="number" class="form-control" name="dias_pago_quincenal" id="dias_pago_quincenal" disabled>';
                                }
                                else
                                {
                                    echo '<input type="number" class="form-control" name="dias_pago_quincenal" id="dias_pago_quincenal" disabled value="'.$up_dias_pago_quincenal.'">';
                                }
                             ?>
                        </div>

                        <div class="form-group col-lg">
                            <label for="dias_pago_quincenal">Quincenal 2</label>
                            <?php 
                                if($up_dias_pago_quincenal == NULL)
                                {
                                    echo '<input type="number" class="form-control" name="dias_pago_quincenal_2" id="dias_pago_quincenal_2" disabled>';
                                }
                                else
                                {
                                    echo '<input type="number" class="form-control" name="dias_pago_quincenal_2" id="dias_pago_quincenal_2" disabled value="'.$up_dias_pago_quincenal_2.'">';
                                }
                             ?>
                        </div>

                        <div class="form-group col-lg">
                            <label for="dias_pago_mensual">Mensual</label>
                            <?php 
                                if($up_dias_pago_mensual == NULL)
                                {
                                    echo '<input type="number" class="form-control" name="dias_pago_mensual" id="dias_pago_mensual" disabled>';
                                }
                                else
                                {
                                    echo '<input type="number" class="form-control" name="dias_pago_mensual" id="dias_pago_mensual" disabled value="'.$up_dias_pago_mensual.'">';
                                }
                             ?>
                        </div>

                        <div class="form-group col-lg-1">
                            <label for="dias_pago_mensual">Enganche</label>
                            <input type="number" class="form-control" name="enganche_dado" id="enganche_dado" step="any" value="<?php echo $up_enganche; ?>" disabled>
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
    <?php 
        //para mostrar los productos que compro y eso
        $query_salida_pro = mysqli_query($conexion, "SELECT idsalida_producto, salida, producto, cantidad, tipo_precio, precio_x_unidad, precio_total FROM salida_productos WHERE salida = '$id_salida'");
        $num_salida_pro = mysqli_num_rows($query_salida_pro);

        $up_id_producto = [];
        $up_cantidad = [];
        $up_tipo_precio = [];
        $up_precio_x_unidad = [];
        $up_precio_total = [];
        $up_id_salida_producto = [];
        while ($data_salida = mysqli_fetch_assoc($query_salida_pro)) 
        {
            array_push($up_id_producto, $data_salida['producto']);
            array_push($up_cantidad, $data_salida['cantidad']);
            array_push($up_tipo_precio, $data_salida['tipo_precio']);
            array_push($up_precio_x_unidad, $data_salida['precio_x_unidad']);
            array_push($up_precio_total, $data_salida['precio_total']);
            array_push($up_id_salida_producto, $data_salida['idsalida_producto']);
        }

        for ($i=0; $i < $num_salida_pro; $i++) 
        { 
            ?>
                <!-- card1 -->
                <div id="card_salida<?php echo ($i+1); ?>" class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="identificador_pro">Identificador</label>
                                    <select class="form-control js-example-data-array identificadorpro" id="identificador_pro_<?php echo ($i+1); ?>" name="identificador_pro_<?php echo ($i+1); ?>" onchange="cargar_series(<?php echo ($i+1); ?>)" disabled>
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
                                                    if($up_id_producto[$i] == $row["idproducto"])
                                                    {
                                                        echo "<option selected value='".$row["idproducto"]."'>".$row["identificador"]."</option>";
                                                    }
                                                    else
                                                    {
                                                        echo "<option value='".$row["idproducto"]."'>".$row["identificador"]."</option>";
                                                    }
                                                }
                                              }
                                            }
                                         ?>
                                    </select>
                                </div>
                                <div class="col-lg-1">
                                    <label for="cantidad">Cantidad</label>
                                    <input onchange="multiplicar_precio(<?php echo ($i+1); ?>)" type="number" class="form-control" name="cantidad_<?php echo ($i+1); ?>" id="cantidad_<?php echo ($i+1); ?>" value="<?php echo $up_cantidad[$i] ?>">
                                </div>
                                <div class="col-lg-3">
                                    <label for="origen">Origen</label>
                                    <!--<input type="text" class="form-control" name="origen_1" id="origen_1" onkeyup="mayusculas(this)"> -->
                                    <?php 
                                        $query_salida_series = mysqli_query($conexion,"SELECT entrada.folio_compra, entrada_productos_serie.serie, entrada_productos_serie.identrada_producto_serie from entrada INNER JOIN entrada_productos_serie on entrada_productos_serie.entrada = entrada.identrada INNER JOIN salida_productos_origen on salida_productos_origen.serie_origen = entrada_productos_serie.identrada_producto_serie INNER JOIN salida_productos on salida_productos.idsalida_producto = salida_productos_origen.salida_productos WHERE salida_productos.idsalida_producto = '$up_id_salida_producto[$i]'");
                                        $data_series =  mysqli_fetch_assoc($query_salida_series);
                                        if($up_cantidad[$i] == 1)
                                        {
                                            ?>
                                            <div id="divorigen_<?php echo ($i+1); ?>">
                                                <select class="form-control js-example-data-array" id="origen_<?php echo ($i+1); ?>" name="origen_<?php echo ($i+1); ?>" disabled>
                                                    <?php 
                                                        #solo mostrar los productos que tengan stock
                                                        #codigo para la lista de idclientes que se extraen de la base de datos
                                                        $result = mysqli_query($conexion,"SELECT identrada_producto_serie,serie from entrada_productos_serie where producto = '$up_id_producto[$i]' and vendido = 0");  
                                                        if (mysqli_num_rows($result) > 0) 
                                                        {  
                                                          while($row = mysqli_fetch_assoc($result))
                                                          {
                                                            echo "<option value='".$row["identrada_producto_serie"]."'>".$data_series["folio_compra"]."-".$row['serie']."</option>"; 
                                                          }
                                                          echo "<option selected value='".$data_series["identrada_producto_serie"]."'>".$data_series["folio_compra"]."-".$data_series['serie']."</option>"; 
                                                        }
                                                     ?>
                                                </select>
                                            </div>
                                            <div id="divorigen_multi_<?php echo ($i+1); ?>" hidden>
                                                <select class="form-control js-example-basic-multiple" id="origen_multi_<?php echo ($i+1); ?>" name="origen_multi_<?php echo ($i+1); ?>[]" multiple="multiple" disabled>
                                                </select>
                                            </div>
                                            <?php 
                                        }
                                        else
                                        {
                                            ?>
                                            <div id="divorigen_<?php echo ($i+1); ?>" hidden>
                                                <select class="form-control js-example-data-array" id="origen_<?php echo ($i+1); ?>" name="origen_<?php echo ($i+1); ?>">
                                                    <option value=0 selected hidden></option>
                                                </select>
                                            </div>

                                            <div id="divorigen_multi_<?php echo ($i+1); ?>">
                                                <select class="form-control js-example-basic-multiple" id="origen_multi_<?php echo ($i+1); ?>" name="origen_multi_<?php echo ($i+1); ?>[]" multiple="multiple" disabled>
                                                    <?php 
                                                        #solo mostrar los productos que tengan stock
                                                        #codigo para la lista de idclientes que se extraen de la base de datos
                                                        $result = mysqli_query($conexion,"SELECT entrada_productos_serie.identrada_producto_serie,entrada_productos_serie.serie, entrada.folio_compra from entrada_productos_serie INNER JOIN entrada on entrada.identrada = entrada_productos_serie.entrada where producto = '$up_id_producto[$i]' and vendido = 0");  
                                                        if (mysqli_num_rows($result) > 0) 
                                                        {  
                                                          while($row = mysqli_fetch_assoc($result))
                                                          {
                                                            echo "<option value='".$row["identrada_producto_serie"]."'>".$row["folio_compra"]."-".$row['serie']."</option>";    
                                                          }
                                                          $query_salida_series = mysqli_query($conexion,"SELECT entrada.folio_compra, entrada_productos_serie.serie, entrada_productos_serie.identrada_producto_serie from entrada INNER JOIN entrada_productos_serie on entrada_productos_serie.entrada = entrada.identrada INNER JOIN salida_productos_origen on salida_productos_origen.serie_origen = entrada_productos_serie.identrada_producto_serie INNER JOIN salida_productos on salida_productos.idsalida_producto = salida_productos_origen.salida_productos WHERE salida_productos.idsalida_producto = '$up_id_salida_producto[$i]'"); 
                                                          while ($data_series =  mysqli_fetch_assoc($query_salida_series)) 
                                                          {
                                                              echo "<option selected value='".$data_series["identrada_producto_serie"]."'>".$data_series["folio_compra"]."-".$data_series['serie']."</option>";  
                                                          }
                                                        }
                                                     ?>
                                                </select>
                                            </div>

                                            <?php 
                                            //multi 
                                        }


                                     ?>

                                </div>
                                <div class="col-lg-2">
                                    <label for="tipo_precio">Tipo de precio</label>
                                      <select onchange="mostrar_precios(<?php echo ($i+1); ?>)" class="form-control" id="tipo_precio_<?php echo ($i+1); ?>" name="tipo_precio_<?php echo ($i+1); ?>">
                                        <option value=0 selected hidden></option>
                                        <?php 
                                            if($up_tipo_precio[$i] == "costo_contado")
                                            {
                                                echo '<option selected value="costo_contado">Costo contado</option>
                                                    <option value="costo_especial">Costo especial</option>
                                                    <option value="costo_cr1">Costo credito 1</option>
                                                    <option value="costo_cr2">Costo credito 2</option>';
                                            }
                                            else if($up_tipo_precio[$i] == "costo_especial")
                                            {
                                                echo '<option value="costo_contado">Costo contado</option>
                                                    <option selected value="costo_especial">Costo especial</option>
                                                    <option value="costo_cr1">Costo credito 1</option>
                                                    <option value="costo_cr2">Costo credito 2</option>';
                                            }
                                            else if($up_tipo_precio[$i] == "costo_cr1")
                                            {
                                                echo '<option value="costo_contado">Costo contado</option>
                                                    <option value="costo_especial">Costo especial</option>
                                                    <option selected value="costo_cr1">Costo credito 1</option>
                                                    <option value="costo_cr2">Costo credito 2</option>';
                                            }
                                            else if($up_tipo_precio[$i] == "costo_cr2")
                                            {
                                                echo '<option value="costo_contado">Costo contado</option>
                                                    <option value="costo_especial">Costo especial</option>
                                                    <option value="costo_cr1">Costo credito 1</option>
                                                    <option selected value="costo_cr2">Costo credito 2</option>';
                                            }
                                         ?>
                                      </select>
                                </div>
                                <div class="col-lg-2">
                                    <label for="precio">Precio</label>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                      </div>
                                      <input name="precio_<?php echo ($i+1); ?>" id="precio_<?php echo ($i+1); ?>" type="number" class="form-control" aria-label="Monto en pesos mexicanos" step="any" value="<?php echo $up_precio_x_unidad[$i]; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-1" align="right">
                                        <a style="pointer-events: none;" href="#" onclick="borrar_card_salida(<?php echo ($i+1); ?>)"><i style="color: red;" class="fas fa-trash-alt fa-2x"></i></a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fin card1 -->
            <?php 
        }

        for ($i=$num_salida_pro; $i < 5; $i++) 
        { 
            ?>
            <!-- card3 -->
            <div id="card_salida<?php echo ($i+1); ?>" class="row" hidden>
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="identificador_pro">Identificador</label>
                                    <select class="form-control js-example-data-array identificadorpro" id="identificador_pro_<?php echo ($i+1); ?>" name="identificador_pro_<?php echo ($i+1); ?>">
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
                                    <input onchange="multiplicar_precio(3)" type="number" value=1 class="form-control" name="cantidad_<?php echo ($i+1); ?>" id="cantidad_<?php echo ($i+1); ?>">
                                </div>
                                <div class="col-lg-3">
                                    <label for="origen">Origen</label>
                                    <div id="divorigen_<?php echo ($i+1); ?>">
                                        <select class="form-control js-example-data-array" id="origen_<?php echo ($i+1); ?>" name="origen_<?php echo ($i+1); ?>">
                                            <option value=0 selected hidden></option>
                                        </select>
                                    </div>

                                    <div id="divorigen_multi_<?php echo ($i+1); ?>" hidden>
                                        <select class="form-control js-example-basic-multiple" id="origen_multi_<?php echo ($i+1); ?>" name="origen_multi_<?php echo ($i+1); ?>[]" multiple="multiple">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <label for="tipo_precio">Tipo de precio</label>
                                      <select onchange="mostrar_precios(3)" class="form-control" id="tipo_precio_<?php echo ($i+1); ?>" name="tipo_precio_<?php echo ($i+1); ?>">
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
                                      <input name="precio_<?php echo ($i+1); ?>" id="precio_<?php echo ($i+1); ?>" type="number" class="form-control" aria-label="Monto en pesos mexicanos">
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
            <?php 
        }
     ?>

</div>

<div id="costos_calculados">
    <div class="row">
        <div class="col-lg-9">
            <!-- 
            aqui va el costo calculado sin iva y sin descuento el primer subtotal
            -->
        </div>
        <div class="col-lg-2" align="right">
            <h4><strong id="subtotal1"><?php echo "$".number_format($up_subtotal1,2,'.',','); ?></strong></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9" align="right">
            <h4>IVA</h4>
        </div>
        <div class="col-lg-2" align="right">
            <h4><strong id="ivas"><?php echo "$".number_format($up_ivas,2,'.',','); ?></strong></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9" align="right">
            <h4>SubTotal</h4>
        </div>
        <div class="col-lg-2" align="right">
            <h4><strong id="subtotal2"><?php echo "$".number_format($up_subtotal2,2,'.',','); ?></strong></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9" align="right">
            <h4>Descuento</h4>
        </div>
        <div class="col-lg-2" align="right">
            <input id="descuento_venta" type="number" name="descuento_venta" class="form-control" value="<?php echo $up_descuento; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9" align="right">
            <h3>TOTAL</h3>
        </div>
        <div class="col-lg-2" align="right" id="mostrar_total">
            <h3><strong id="total_general"><?php echo "$".number_format($up_total_general,2,'.',','); ?></strong></h3>
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
        <button id="btn_vender"  onclick="calcular_cuenta(1)" type="button" class="btn btn-block btn-primary"><i class="fas fa-cash-register"></i> Calcular</button>
    </div>
    <div class="col-lg-5">
        <button id="btn_haz_venta" type="submit" class="btn btn-block btn-success"><i class="fas fa-money-check"></i> Actualizar</button>
    </div>
</div>
<input hidden readonly type="text" name="action" id="action" value="edit_salida_venta">
<input hidden readonly type="text" name="flag_id_salida" id="flag_id_salida" value="<?php echo $id_salida; ?>">
</form>
</fieldset>
<br><br>

    <div class="col-lg-12">
        <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <h3><strong>HISTORIAL DE ABONOS</strong></h3>
                    <!--<input type="" name="prueba" id="prueba">-->
                </div>
                <div class="col-lg-2">
                    <?php 
                        if($up_activo)
                        {
                            $query_nivel_sal_aux = mysqli_query($conexion, "SELECT saldo_al_momento FROM movimiento WHERE salida = '$id_salida' order by creado_en DESC LIMIT 1");
                            $debe_al_momento_aux = floatval(mysqli_fetch_assoc($query_nivel_sal_aux)['saldo_al_momento']);
                            if($debe_al_momento_aux == 0 and mysqli_num_rows($query_nivel_sal_aux) != 0)
                            {
                                echo '<h3><span class="badge badge-pill badge-primary">PAGADO</span></h3>';
                            }
                            else
                            {
                                echo '<h3><span class="badge badge-pill badge-success">ACTIVO</span></h3>';
                            }
                        }
                        else
                        {
                            echo '<h3><span class="badge badge-pill badge-danger">SUSPENDIDO</span></h3>';
                        }
                     ?>
                </div>
                <div class="col-lg-2">
                    <?php 
                    
                        //tambien para la tabla ideal que se mostrara más abajo
                        $tabla_credito_ideal = "";
                            //array to save all the dates in the ideal pay dates
                            $ultimo_pago_liquidacion = 0;
                            $fecha_liquidacion_ideal = 0;
                            $fechas_ideales = [$up_fecha];
                            $f = 1;
                                $new_total = $up_total_general - $up_enganche;
                                $tabla_credito_ideal = $tabla_credito_ideal."<tr>
                                        <td>1</td>
                                        <td>".date("d/m/Y", strtotime($up_fecha))."</td>
                                        <td>"."$".number_format($up_enganche,0,'.',',')."</td>
                                        <td>"."$".number_format($up_descuento,0,'.',',')."</td>
                                        <td>$0</td>
                                        <td>"."$".number_format($new_total,0,'.',',')."</td>
                                    </tr>";

                                $no_pagos_int = ceil($up_no_pagos);
                                //$up_total_general
                            $new_pago_parcial = $up_pago_parcial;
                            $new_fecha = $up_per_dia_pago;
                            for ($i=1; $i < $no_pagos_int; $i++) 
                            { 
                                if($new_pago_parcial > $new_total)
                                {   
                                    $new_pago_parcial = $new_total;
                                }
                                $new_total = $new_total - $new_pago_parcial;
                                $ultimo_pago_liquidacion = $new_pago_parcial;
                                $fecha_liquidacion_ideal = $new_fecha;
                                if($new_pago_parcial != 0)
                                {
                                    $tabla_credito_ideal = $tabla_credito_ideal."<tr>
                                        <td>".($i+1)."</td>
                                        <td>".date("d/m/Y", strtotime($new_fecha))."</td>
                                        <td>"."$".number_format($new_pago_parcial,0,'.',',')."</td>
                                        <td>"."$".number_format(0,0,'.',',')."</td>
                                        <td>$0</td>
                                        <td>"."$".number_format($new_total,0,'.',',')."</td>
                                    </tr>";
                                    $fechas_ideales[$f] = $new_fecha;
                                    $f = $f + 1;
                                    if($up_modalidad == "mensual")
                                    {
                                        //up_dias_pago_mensual
                                        //$new_fecha = date("Y-m-d", strtotime($new_fecha. ' + 1 month'));
                                        list($anio, $mes, $dia) = explode("-", $new_fecha);
                                        if(intval($dia) <= intval($up_dias_pago_mensual)-10)
                                        {
                                            $new_fecha = $anio."-".strval(intval($mes))."-".$up_dias_pago_mensual;
                                            $new_fecha = date("Y-m-d", strtotime($new_fecha));
                                        }
                                        else
                                        {
                                            if(intval($mes) == 12)
                                            {
                                                $new_fecha = strval(intval($anio)+1)."-01-".$up_dias_pago_mensual;
                                                $new_fecha = date("Y-m-d", strtotime($new_fecha));
                                            }
                                            else
                                            {
                                                $new_fecha = $anio."-".strval(intval($mes)+1)."-".$up_dias_pago_mensual;
                                                $new_fecha = date("Y-m-d", strtotime($new_fecha));
                                            }
                                        }
                                    }
                                    else if($up_modalidad == "quincenal")
                                    {
                                        //$new_fecha = date("Y-m-d", strtotime($new_fecha. ' + 2 weeks'));
                                        list($anio, $mes, $dia) = explode("-", $new_fecha);
                                        if($dia <= intval($up_dias_pago_quincenal)-10 or $dia >= intval($up_dias_pago_quincenal_2)-10)
                                        {
                                            $new_fecha = $anio."-".strval(intval($mes)+1)."-".$up_dias_pago_quincenal;
                                            $new_fecha = date("Y-m-d", strtotime($new_fecha));
                                        }
                                        else
                                        {
                                            $new_fecha = $anio."-".strval(intval($mes))."-".$up_dias_pago_quincenal_2;
                                            $new_fecha = date("Y-m-d", strtotime($new_fecha));
                                        }
                                    }
                                    else if($up_modalidad == "semanal")
                                    {
                                        $new_fecha = date("Y-m-d", strtotime($new_fecha. ' + 1 week'));
                                    }
                                }
                            }

                            //esto es para lo del nivel, calculamos con lo ya calculado
                            //calculamos su nivel con la regla
                            $query_nivel_sal = mysqli_query($conexion, "SELECT saldo_al_momento FROM movimiento WHERE salida = '$id_salida' order by creado_en DESC LIMIT 1");
                            $debe_al_momento = floatval(mysqli_fetch_assoc($query_nivel_sal)['saldo_al_momento']);
                            //$hoy = date("Y-m-d");
                            $hoy = date('2023-03-20');

                            $j = 1;
                            $size_fechas = sizeof($fechas_ideales);
                            $total_ideal = $up_enganche;
                            while ($hoy > $fechas_ideales[$j]) 
                            {
                                $total_ideal = $total_ideal + $up_pago_parcial;

                                if($j >= $size_fechas)
                                {
                                    break;
                                }
                                $j = $j + 1;
                            }

                            $total_pagado = $up_total_general - $debe_al_momento;
                            $diff_totalPagado_ideal = $total_ideal - $total_pagado;
                            if($up_modalidad == "mensual")
                            {
                                $dias_atraso_aux = round(($diff_totalPagado_ideal*30)/$up_pago_parcial, 2);
                                $periodo_atraso = round($dias_atraso_aux/30,2);
                            }
                            else if($up_modalidad == "quincenal")
                            {
                                $dias_atraso_aux = round(($diff_totalPagado_ideal*15)/$up_pago_parcial, 2);
                                $periodo_atraso = round($dias_atraso_aux/15,2);
                            }
                            else if($up_modalidad == "semanal")
                            {
                                $dias_atraso_aux = round(($diff_totalPagado_ideal*7)/$up_pago_parcial, 2);
                                $periodo_atraso = round($dias_atraso_aux/7,2);
                            }

                            $nivel_actual_salida = 0;
                            if($dias_atraso_aux <= 0)
                            {
                                $nivel_actual_salida = 5;
                            }
                            else if($dias_atraso_aux < 15)
                            {
                                $nivel_actual_salida = 4;
                            }
                            else if($dias_atraso_aux < 30)
                            {
                                $nivel_actual_salida = 3;
                            }
                            else if($dias_atraso_aux < 60)
                            {
                                $nivel_actual_salida = 2;
                            }
                            else if($dias_atraso_aux >= 60)
                            {
                                $nivel_actual_salida = 1;
                            }

                            //insertar en la bd, actualizar la tabla salida

                            //imprimir niveles
                            if ($nivel_actual_salida == 0)
                            {
                                echo '<h4>Nivel de la cuenta: &nbsp; <span class="badge badge-pill badge-secondary"><h3>0</h3></span></h4>';
                            }
                            if ($nivel_actual_salida == 1)
                            {
                                echo '<h4>Nivel de la cuenta: &nbsp; <span class="badge badge-pill badge-dark" style="background-color: #FF7A33;"><h3>1</h3></span></h4>';
                            }
                            if ($nivel_actual_salida  == 2)
                            {
                                echo '<h4>Nivel de la cuenta: &nbsp; <span class="badge badge-pill badge-warning"><h3>2</h3></span></h4>';
                            }
                            if ($nivel_actual_salida  == 3)
                            {
                                echo '<h4>Nivel de la cuenta: &nbsp; <span class="badge badge-pill badge-success"><h3>3</h3></span></h4>';
                            }
                            if ($nivel_actual_salida  == 4)
                            {
                                echo '<h4>Nivel de la cuenta: &nbsp; <span class="badge badge-pill badge-info"><h3>4</h3></span></h4>';
                            }
                            if ($nivel_actual_salida  == 5)
                            {
                                echo '<h4>Nivel de la cuenta: &nbsp; <span class="badge badge-pill badge-primary"><h4>5</h4></span></h4>';
                            }
                            
                     ?> 
                </div>

                <div align="right" class="col-lg-5">
                    <a data-toggle="modal" data-target="#vendedores" class="btn btn-primary" type="button" ><i class="fas fa-users"></i> Asignación</a>
                    <a data-toggle="modal" data-target="#atrasos" class="btn btn-primary" type="button" ><i class="fas fa-list"></i> Atrasos</a>
                    <a data-toggle="modal" data-target="#nueva_modaliadad_pago" class="btn btn-primary" type="button" ><i class="fas fa-edit"></i> Actualizar Modalidad de pago</a>
                    <a onclick="nuevo_movimiento()" data-toggle="modal" data-target="#haz_movimiento" class="btn btn-primary" type="button" ><i class="fas fa-edit"></i> Realizar movimiento</a>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="table-responsive">
                    <table class="table" id="tbl_ideal">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Fecha</th>
                                <th>Abonos</th>
                                <th>Descuento</th>
                                <th>Recargo</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                //ya se calculo y genero arriba, solo se imprime 
                                echo $tabla_credito_ideal;
                                //print_r($fechas_ideales);
                            ?>
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="col-lg-6">
                    <div class="table-responsive">
                    <table class="table" id="tbl_real">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Fecha</th>
                                <th>Abonos</th>
                                <th>Descuento</th>
                                <th>Recargo</th>
                                <th>Saldo</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            //checamos si hoy ya vencioeron algunos pagos, si si, agregarlos a bd con 0 de abono
                            //$hoy = date('Y-m-d');
                            $hoy = date('2023-03-20');
                            //print_r($pagos_parciales);
                            $fechas_ideales = actualizar_fechas_inicial($fechas_ideales, $up_dias_pago_mensual, $up_dias_pago_quincenal, $up_dias_pago_quincenal_2, $up_modalidad, $hoy);
                            //print_r($fechas_ideales);
                            $size_fechas = sizeof($fechas_ideales);
                            
                            $f = 0; 
                            for ($i=0; $i < $size_fechas-1; $i++)
                            {
                                if($fechas_ideales[$i+1] < $hoy)
                                {
                                    $key = $i + 1;
                                    $query_mov_chequeo = mysqli_query($conexion,"SELECT count(idmovimiento) num, sum(abono) as saldo_total_pagado FROM movimiento WHERE salida = '$id_salida' and fecha >= '$fechas_ideales[$i]' and fecha < '$fechas_ideales[$key]' order by fecha, creado_en ASC");
                                    $data_mov = mysqli_fetch_assoc($query_mov_chequeo);
                                    $n_mov = $data_mov['num'];
                                    $saldo_pagado = $data_mov['saldo_total_pagado'];
                                    //echo $n_mov;
                                    //echo "<br>";
                                    //echo $saldo_pagado;
                                    $query_total_acomulado = mysqli_query($conexion, "SELECT saldo_al_momento from movimiento where salida = '$id_salida' order by creado_en DESC LIMIT 1");
                                    if(mysqli_num_rows($query_total_acomulado) > 0)
                                    {
                                        $saldos_que_debe = floatval(mysqli_fetch_assoc($query_total_acomulado)['saldo_al_momento']);
                                    }
                                    else
                                    {
                                        $query_saldos_al_momento_vacio_1 = mysqli_query($conexion, "SELECT total_general from salida where idsalida = '$id_salida'");
                                        $saldos_que_debe = floatval(mysqli_fetch_assoc($query_saldos_al_momento_vacio_1)['total_general']);
                                    }

                                    if($n_mov == 0)
                                    {
                                        $fecha_aux_1 = date("Y-m-d", strtotime($fechas_ideales[$i+1]. ' - 1 day'));
                                        $resultIDmovimiento_1 = mysqli_query($conexion, "SELECT UUID() as idmovimiento");
                                        $uuid_movimiento_1 = mysqli_fetch_assoc($resultIDmovimiento_1)['idmovimiento'];
                                        $insert_mov_1 = mysqli_query($conexion,"INSERT INTO movimiento(idmovimiento, salida, fecha, abono, descuento, recargo, saldo_al_momento) VALUES ('$uuid_movimiento_1','$id_salida', '$fecha_aux_1','0','0','0','$saldos_que_debe')");
                                    }

                                    //no tiene ni un movimiento en esa fecha, entonces poner atraso completo
                                    $new_pago_parcial = $up_pago_parcial;
                                    if($new_pago_parcial > $saldos_que_debe)
                                    {   
                                        $new_pago_parcial = $saldos_que_debe;
                                    }
                                    if($saldo_pagado < $new_pago_parcial)
                                    {
                                        //le falto por pagar, aunque sea 1 peso
                                        $le_falto = $new_pago_parcial - $saldo_pagado;
                                        $fecha_inicio_atraso = $fechas_ideales[$i+1];

                                        $atraso_existente = mysqli_query($conexion, "SELECT idmovimiento_atraso from movimiento_atrasos where fecha_inicio = '$fecha_inicio_atraso'");
                                        if(mysqli_num_rows($atraso_existente) == 0)
                                        {
                                            $periodo_atraso = round($le_falto/$up_pago_parcial, 2);
                                            if($up_modalidad == "mensual")
                                            {
                                                $dias_atraso = round(($le_falto*30)/$up_pago_parcial, 2);
                                            }
                                            else if($up_modalidad == "quincenal")
                                            {
                                                $dias_atraso = round(($le_falto*15)/$up_pago_parcial, 2);
                                            }
                                            else if($up_modalidad == "semanal")
                                            {
                                                $dias_atraso = round(($le_falto*7)/$up_pago_parcial, 2);
                                            }

                                            //poner los atrasos
                                            $resultIDatraso = mysqli_query($conexion, "SELECT UUID() as idmovimiento_atraso");
                                            $uuid_mov_atraso = mysqli_fetch_assoc($resultIDatraso)['idmovimiento_atraso'];
                                            $insert_mov_atraso = mysqli_query($conexion,"INSERT INTO movimiento_atrasos(idmovimiento_atraso, salida, tipo_periodo_atraso, periodo_atraso, dias_atraso, base_atraso, debe_atrasado, fecha_inicio) VALUES ('$uuid_mov_atraso','$id_salida','$up_modalidad','$periodo_atraso','$dias_atraso','$up_pago_parcial','$le_falto','$fecha_inicio_atraso')");
                                        }
                                        //echo mysqli_error($conexion);
                                    }

                                }
                            }

                            //////////// eso es para mostrar la tabla
                            $query_movimientos = mysqli_query($conexion,"SELECT idmovimiento, salida, fecha, abono, descuento, recargo, saldo_al_momento FROM movimiento WHERE salida = '$id_salida' order by fecha,creado_en ASC");
                            $c = 1;
                            $f = 0;
                            $columna = "";
                            //$size_fechas = sizeof($fechas_ideales);

                            $cs = "";
                            $fechas = "";
                            $abonos = "";
                            $descuentos = "";
                            $recargos = "";
                            $saldos_al_momento = "";
                            $btns_editar = "";
                            $flag_control = 0;
                            while($row = mysqli_fetch_assoc($query_movimientos))
                            {
                                if($row['fecha'] >= $fechas_ideales[$f] and $row['fecha'] < $fechas_ideales[$f+1])
                                {
                                    $cs = $c."<br>";
                                    $fechas = $fechas.date("d/m/Y", strtotime($row['fecha']))."<br>";
                                    $abonos = $abonos.'$'.number_format($row['abono'],0,'.',',')."<br>";
                                    $descuentos = $descuentos.'$'.number_format($row['descuento'],0,'.',',')."<br>";
                                    $recargos = $recargos.'$'.number_format($row['recargo'],0,'.',',')."<br>";
                                    $saldos_al_momento = $saldos_al_momento.'$'.number_format($row['saldo_al_momento'],0,'.',',')."<br>";
                                    $btns_editar = $btns_editar.'<button onclick="editar_movimiento(\''.$row['idmovimiento'].'\')" data-toggle="modal" data-target="#haz_movimiento" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>'."<br>";
                                    $flag_control = 1;                              
                                }   
                                else
                                {   
                                    //antes que todo imprimimos como esta y hacemos cambio
                                    if($flag_control == 0)
                                    {
                                        $columna = $columna.'<tr>
                                        <td>'.$c.'</td>
                                        <td>'.date("d/m/Y", strtotime($row['fecha'])).'</td>
                                        <td>'.'$'.number_format($row['abono'],0,'.',',').'</td>
                                        <td>'.'$'.number_format($row['descuento'],0,'.',',').'</td>
                                        <td>'.'$'.number_format($row['recargo'],0,'.',',').'</td>
                                        <td>'.'$'.number_format($row['saldo_al_momento'],0,'.',',').'</td>
                                        <td><button onclick="editar_movimiento(\''.$row['idmovimiento'].'\')" data-toggle="modal" data-target="#haz_movimiento" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button></td>
                                        </tr>';
                                    }
                                    else
                                    {
                                        $columna = $columna.'<tr>
                                        <td>'.$cs.'</td>
                                        <td>'.$fechas.'</td>
                                        <td>'.$abonos.'</td>
                                        <td>'.$descuentos.'</td>
                                        <td>'.$recargos.'</td>
                                        <td>'.$saldos_al_momento.'</td>
                                        <td>'.$btns_editar.'</td>
                                        </tr>';                                        
                                        $flag_control = 0;
                                        $cs = "";
                                        $fechas = "";
                                        $abonos = "";
                                        $descuentos = "";
                                        $recargos = "";
                                        $saldos_al_momento = "";
                                        $btns_editar = "";
                                    }

                                    $f = $f + 1;
                                    $c = $c + 1;
                                    if($row['fecha'] >= $fechas_ideales[$f+1])
                                    {
                                        //ya no hay nada en ese rango
                                        //echo $c." ".$row['fecha']." ".$fechas_ideales[$f+1];
                                        //echo "<br>";
                                        //hay que guardar los vacios en la bd
                                        $fecha_aux = date("Y-m-d", strtotime($fechas_ideales[$f+1]. ' - 1 day'));
                                        $resultIDmovimiento= mysqli_query($conexion, "SELECT UUID() as idmovimiento");
                                        $uuid_movimiento = mysqli_fetch_assoc($resultIDmovimiento)['idmovimiento'];
                                        $insert_mov = mysqli_query($conexion,"INSERT INTO movimiento(idmovimiento, salida, fecha, abono, descuento, recargo, saldo_al_momento) VALUES ('$uuid_movimiento','$id_salida', '$fecha_aux','0','0','0','$saldo_al_momento_vacio')");

                                        $columna = $columna.'<tr>
                                        <td>'.$c.'</td>
                                        <td>'.date("d/m/Y", strtotime($fecha_aux)).'</td>
                                        <td>'.'$'.number_format(0,0,'.',',').'</td>
                                        <td>'.'$'.number_format(0,0,'.',',').'</td>
                                        <td>'.'$'.number_format(0,0,'.',',').'</td>
                                        <td>'.'$'.number_format($saldo_al_momento_vacio,0,'.',',').'</td>
                                        <td><button onclick="editar_movimiento(\''.$uuid_movimiento.'\')" data-toggle="modal" data-target="#haz_movimiento" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button></td>
                                        </tr>'; 
                                        $c = $c + 1;
                                    }

                                    //cerrar columna y abrir nueva con los datos que hay cargados ahorita
                                    //este es cada que se cambia
                                    $cs = $c."<br>";
                                    $fechas = $fechas.date("d/m/Y", strtotime($row['fecha']))."<br>";
                                    $abonos = $abonos.'$'.number_format($row['abono'],0,'.',',')."<br>";
                                    $descuentos = $descuentos.'$'.number_format($row['descuento'],0,'.',',')."<br>";
                                    $recargos = $recargos.'$'.number_format($row['recargo'],0,'.',',')."<br>";
                                    $saldos_al_momento = $saldos_al_momento.'$'.number_format($row['saldo_al_momento'],0,'.',',')."<br>";
                                    $btns_editar = $btns_editar.'<button onclick="editar_movimiento(\''.$row['idmovimiento'].'\')" data-toggle="modal" data-target="#haz_movimiento" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>'."<br>";
                                    $flag_control = 1;   
                                }
                                $saldo_al_momento_vacio = $row['saldo_al_momento'];
                                $size_fechas = sizeof($fechas_ideales);
                                $fechas_ideales = actualizar_fechas($f, $size_fechas, $fechas_ideales, $up_dias_pago_mensual, $up_dias_pago_quincenal, $up_dias_pago_quincenal_2, $up_modalidad);
                                //array_push($fechas_ideales, $next_fecha);
                                ///
                            }
                            //print_r($fechas_ideales);
                            $columna = $columna.'<tr>
                                        <td>'.$cs.'</td>
                                        <td>'.$fechas.'</td>
                                        <td>'.$abonos.'</td>
                                        <td>'.$descuentos.'</td>
                                        <td>'.$recargos.'</td>
                                        <td>'.$saldos_al_momento.'</td>
                                        <td>'.$btns_editar.'</td>
                                        </tr>';  
                            echo $columna;
                            
                        ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>

<!-- modal para ver atrasos -->
<div id="atrasos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Detalle de atrasos</h3>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="on" id="formAdd_movimiento">
                    <div class="row">
                        <div class="col-lg-4" align="center">
                           <h4>Días de atraso: <strong><?php echo $dias_atraso_aux; ?></strong></h4> 
                        </div>
                        <div class="col-lg-4" align="center">
                           <h4>Pagos de atraso: <strong><?php echo $periodo_atraso; ?></strong></h4> 
                        </div>
                        <div class="col-lg-4" align="center">
                           <h4>Debe: <strong><?php echo $diff_totalPagado_ideal; ?></strong></h4> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

//funcion para poner mayusculas los inputs
function mayusculas(e) {
    e.value = e.value.toUpperCase();
}

//document.getElementById('divzoom').style.zoom = "100%";
//document.getElementById('page-top').style.zoom = "80%";

</script>

<?php 
ob_end_flush();
include_once "footer.php"; 
?>
