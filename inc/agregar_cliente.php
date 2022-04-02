<?php
ob_start();
include_once "header.php";
include "accion/conexion.php";

$id_user = $_SESSION['iduser'];
if (!empty($_POST)) 
{
    $alert = "";
    if (empty($_POST['bandera'])) {
        $alert = '<div class="alert alert-danger" role="alert">
        Hubo un error inesperado, intente de nuevo
        </div>';
    } 
    else 
    {
        $ban = $_POST['bandera'];
        if ($ban == 'zona')
        {
            $nueva_zona = $_POST['nuevazona'];
          $insert_zona = mysqli_query($conexion, "INSERT INTO zonas(zona) values ('$nueva_zona')");
              if ($insert_zona) {
                  $alert = '<div class="alert alert-success" role="alert">
                              Zona registrada correctamete.
                          </div>';
              } 
              else
              {
                  $alert = '<div class="alert alert-danger" role="alert">
                          Error al registrar una nueva zona, actualize e intente de nuevo.
                      </div>';
              }
        }
        else if($ban == 'subzona')
        {
            $nueva_subzona = $_POST['nuevasubzona'];
            $idzona_subzona = $_POST['zona_subzona'];
          $insert_subzona = mysqli_query($conexion, "INSERT INTO subzonas(subzona,idzona) values ('$nueva_subzona', $idzona_subzona)");
              if ($insert_subzona) {
                  $alert = '<div class="alert alert-success" role="alert">
                              Subzona registrada correctamete.
                          </div>';
              } 
              else
              {
                  $alert = '<div class="alert alert-danger" role="alert">
                          Error al registrar una nueva Subzona, actualize e intente de nuevo.
                      </div>';
              }
        }
        else if($ban == 'editzona')
        {
          $id_zona = $_POST['idnewzona_edit'];
          $nomzona_edit = $_POST['newzona_edit'];
          $update_zona = mysqli_query($conexion, "UPDATE zonas SET zona='$nomzona_edit' where idzona=$id_zona");
              if ($update_zona) {
                  $alert = '<div class="alert alert-success" role="alert">
                              ¡Zona actualizada!
                          </div>';
                  #header("Location: agregar_usuario.php");
              } 
              else
              {
                  $alert = '<div class="alert alert-danger" role="alert">
                          Error al actualizar la zona, intente de nuevo.
                      </div>';
              }
        }
        else if($ban == 'editsubzona')
        {
          $id_subzona = $_POST['idnewsubzona_edit'];
          $nomsubzona_edit = $_POST['newsubzona_edit'];
          $newid_zona_edit = $_POST['zona_subzona_edit'];
          $update_subzona = mysqli_query($conexion, "UPDATE subzonas SET subzona='$nomsubzona_edit', idzona=$newid_zona_edit where idsubzona=$id_subzona");
              if ($update_subzona) {
                  $alert = '<div class="alert alert-success" role="alert">
                              ¡Subzona actualizada!
                          </div>';
                  #header("Location: agregar_usuario.php");
              } 
              else
              {
                  $alert = '<div class="alert alert-danger" role="alert">
                          Error al actualizar la subzona, intente de nuevo.
                      </div>';//.mysqli_error($conexion).'/'.$id_subzona;
              }
        }
        else if($ban == 'newcliente')
        {
            #guardamos los datos a insertar en variables
            $nombre_cliente = $_POST['nombre_cliente'];
            $zona = $_POST['zona'];
            $domicilio_cliente = $_POST['domicilio_cliente'];
            $subzona = $_POST['subzona'];
            #numeros de telefono del cliente
            $tel1_cliente = $_POST['tel1_cliente'];
            $tel2_cliente = $_POST['tel2_cliente'];
            $curp = $_POST['curp'];
            $rfc = $_POST['rfc'];
            //calculamos el numero de cliente
            $sql2 = mysqli_query($conexion, "SELECT count(idcliente) as num from cliente");
            $no_cliente = mysqli_fetch_assoc($sql2)['num'] + 1;
            //formamos y calculamos el ID de cliente
            $idcliente = md5($curp.$no_cliente);

            $cp_cliente = $_POST['cp_cliente'];
            $es_conyugue = $_POST['idestado_civil'];
            $trabajo_cliente = $_POST['trabajo_cliente'];
            $puesto_cliente = $_POST['puesto_cliente'];
            $direccion_trabajo_cliente = $_POST['direccion_trabajo_cliente'];
            $antiguedadA_trabajo_cliente = $_POST['antiguedadA_trabajo_cliente'];
            $antiguedadM_trabajo_cliente = $_POST['antiguedadM_trabajo_cliente'];
            $ingresos_cliente = $_POST['ingresos_cliente'];
            $tipo_ingreso_cliente = $_POST['tipo_ingreso_cliente'];
            $tipo_vivienda_cliente = $_POST['tipo_vivienda_cliente'];
            $edad_residencia = $_POST['edad_residencia'];
            $renta_mensual = $_POST['renta_mensual'];
            $ndependientes = $_POST['ndependientes'];
            #DATOS DEL AVAL
            $nombre_aval = $_POST['nombre_aval'];
            $tel_aval = $_POST['tel_aval'];
            $domicilio_aval = $_POST['domicilio_aval'];
            $trabajo_aval = $_POST['trabajo_aval'];
            $puesto_aval = $_POST['puesto_aval'];
            $ingreso_mensual_aval = $_POST['ingreso_mensual_aval'];
            $nombre_conyugue_aval = $_POST['nombre_conyugue_aval'];

            if (isset($_POST['apto_credito']))
            {
                $apto_credito = 1;
            }
            else
            {
                $apto_credito = 0;
            }
            if(isset($_POST['nivel_credito']))
            {
              $nivel_apto = $_POST['nivel_credito'];
            }
            else
            {
              $nivel_apto = 0;
            }

            #calculamos si el cliente tiene conyugue
            #$query = mysqli_query($conexion, "SELECT `es_conyugue` FROM `estado_civil` WHERE idestado_civil = $idestado_civil");
            #$result = mysqli_fetch_array($query)['es_conyugue'];
            if ($es_conyugue=="si")  #$result == 1) #si tiene conyugue, entonces si guardamos datos
            {   
                #datos del conyugue del cliente
                $nombre_conyugue_cliente = $_POST['nombre_conyugue_cliente'];
                $antiguedadA_vinculo = $_POST['antiguedadA_vinculo'];
                $antiguedadM_vinculo = $_POST['antiguedadM_vinculo'];
                $trabajo_conyugue = $_POST['trabajo_conyugue'];
                $puesto_conyugue = $_POST['puesto_conyugue'];
                $ingreso_mensual_conyugue = $_POST['ingreso_mensual_conyugue'];
                $direccion_trabajo_conyugue = $_POST['direccion_trabajo_conyugue'];
                $tel_conyugue = $_POST['tel_conyugue'];
                $conyugue = 1;

                $sql_insert = "INSERT INTO cliente(idcliente, nombre_cliente, zona, domicilio_cliente, subzona, tel1_cliente, tel2_cliente, cp_cliente, idestado_civil, curp, rfc, trabajo_cliente, puesto_cliente, direccion_trabajo_cliente, antiguedadA_trabajo_cliente, antiguedadM_trabajo_cliente, ingresos_cliente, tipo_ingresos_cliente, nombre_conyugue_cliente, antiguedadA_vinculo, antiguedadM_vinculo, trabajo_conyugue, puesto_conyugue, ingreso_mensual_conyugue, direccion_trabajo_conyugue, tel_conyugue, tipo_vivienda_cliente, edad_residencia, renta_mensual, ndependientes, nombre_aval, tel_aval, domicilio_aval, trabajo_aval, puesto_aval, ingreso_mensual_aval, nombre_conyugue_aval, apto_credito, nivel_apto, no_cliente) VALUES ('$idcliente', '$nombre_cliente', $zona, ".(!empty($domicilio_cliente) ? "'$domicilio_cliente'" : "NULL").", $subzona, ".(!empty($tel1_cliente) ? "'$tel1_cliente'" : "NULL").", ".(!empty($tel2_cliente) ? "'$tel2_cliente'" : "NULL").", ".(!empty($cp_cliente) ? "'$cp_cliente'" : "NULL").", $conyugue, ".(!empty($curp) ? "'$curp'" : "NULL").", ".(!empty($rfc) ? "'$rfc'" : "NULL").", ".(!empty($trabajo_cliente) ? "'$trabajo_cliente'" : "NULL").", ".(!empty($puesto_cliente) ? "'$puesto_cliente'" : "NULL").", ".(!empty($direccion_trabajo_cliente) ? "'$direccion_trabajo_cliente'" : "NULL").", $antiguedadA_trabajo_cliente, $antiguedadM_trabajo_cliente, $ingresos_cliente, '$tipo_ingreso_cliente', '$nombre_conyugue_cliente', $antiguedadA_vinculo, $antiguedadM_vinculo, ".(!empty($trabajo_conyugue) ? "'$trabajo_conyugue'" : "NULL").", ".(!empty($puesto_conyugue) ? "'$puesto_conyugue'" : "NULL").", $ingreso_mensual_conyugue, ".(!empty($direccion_trabajo_conyugue) ? "'$direccion_trabajo_conyugue'" : "NULL").", ".(!empty($tel_conyugue) ? "'$tel_conyugue'" : "NULL").", '$tipo_vivienda_cliente', $edad_residencia, $renta_mensual, $ndependientes, ".(!empty($nombre_aval) ? "'$nombre_aval'" : "NULL").", ".(!empty($tel_aval) ? "'$tel_aval'" : "NULL").", ".(!empty($domicilio_aval) ? "'$domicilio_aval'" : "NULL").", ".(!empty($trabajo_aval) ? "'$trabajo_aval'" : "NULL").", ".(!empty($puesto_aval) ? "'$puesto_aval'" : "NULL").", ".(!empty($ingreso_mensual_aval) ? "$ingreso_mensual_aval" : "NULL").", ".(!empty($nombre_conyugue_aval) ? "'$nombre_conyugue_aval'" : "NULL").", $apto_credito, $nivel_apto, $no_cliente)";

            $insert_correctly = FALSE;
            $insert_cliente = mysqli_query($conexion, $sql_insert);
              if ($insert_cliente) {
                  $insert_correctly = TRUE;
              } 
            }
            else#no tiene conyugue y no guardamos nada, puro null
            {
                $conyugue = 0;
                $sql_insert = "INSERT INTO cliente(idcliente, nombre_cliente, zona, domicilio_cliente, subzona, tel1_cliente, tel2_cliente, cp_cliente, idestado_civil, curp, rfc, trabajo_cliente, puesto_cliente, direccion_trabajo_cliente, antiguedadA_trabajo_cliente, antiguedadM_trabajo_cliente, ingresos_cliente, tipo_ingresos_cliente, nombre_conyugue_cliente, antiguedadA_vinculo, antiguedadM_vinculo, trabajo_conyugue, puesto_conyugue, ingreso_mensual_conyugue, direccion_trabajo_conyugue, tel_conyugue, tipo_vivienda_cliente, edad_residencia, renta_mensual, ndependientes, nombre_aval, tel_aval, domicilio_aval, trabajo_aval, puesto_aval, ingreso_mensual_aval, nombre_conyugue_aval, apto_credito, nivel_apto, no_cliente) VALUES ('$idcliente', '$nombre_cliente', $zona, ".(!empty($domicilio_cliente) ? "'$domicilio_cliente'" : "NULL").", $subzona, ".(!empty($tel1_cliente) ? "'$tel1_cliente'" : "NULL").", ".(!empty($tel2_cliente) ? "'$tel2_cliente'" : "NULL").", ".(!empty($cp_cliente) ? "'$cp_cliente'" : "NULL").", $conyugue, ".(!empty($curp) ? "'$curp'" : "NULL").", ".(!empty($rfc) ? "'$rfc'" : "NULL").", ".(!empty($trabajo_cliente) ? "'$trabajo_cliente'" : "NULL").", ".(!empty($puesto_cliente) ? "'$puesto_cliente'" : "NULL").", ".(!empty($direccion_trabajo_cliente) ? "'$direccion_trabajo_cliente'" : "NULL").", $antiguedadA_trabajo_cliente, $antiguedadM_trabajo_cliente, $ingresos_cliente, '$tipo_ingreso_cliente', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$tipo_vivienda_cliente', $edad_residencia, $renta_mensual, $ndependientes, ".(!empty($nombre_aval) ? "'$nombre_aval'" : "NULL").", ".(!empty($tel_aval) ? "'$tel_aval'" : "NULL").", ".(!empty($domicilio_aval) ? "'$domicilio_aval'" : "NULL").", ".(!empty($trabajo_aval) ? "'$trabajo_aval'" : "NULL").", ".(!empty($puesto_aval) ? "'$puesto_aval'" : "NULL").", ".(!empty($ingreso_mensual_aval) ? "$ingreso_mensual_aval" : "NULL").", ".(!empty($nombre_conyugue_aval) ? "'$nombre_conyugue_aval'" : "NULL").", $apto_credito, $nivel_apto, $no_cliente)";

                $insert_correctly = FALSE;
                $insert_cliente = mysqli_query($conexion, $sql_insert);
                  if ($insert_cliente) 
                  {
                      $insert_correctly = TRUE;
                  } 
            }
              
            #AHORA INSERTAMOS SUS REFERENCIAS
            #$insert_correctly2 = 1;
            $insert_correctly2 = 1;
            if(!empty($_POST['nombre_ref'][0]))
            {
              $nombre_ref = $_POST['nombre_ref'];
              $relacion_ref = $_POST['relacion_ref'];
              $domicilio_ref = $_POST['dom_ref'];
              $tel_ref = $_POST['tel_ref'];
              $notas_ref = $_POST['notas_ref'];

              $size_refs = sizeof($nombre_ref);
              for ($i=0; $i < $size_refs; $i++) 
              { 
                  //insertamos cada uno de las referencias
                  $query_insertrefs = "INSERT INTO referencias_cliente(nombre, domicilio, relacion, tel, nota, idcliente) VALUES ('$nombre_ref[$i]', '$domicilio_ref[$i]', '$relacion_ref[$i]', '$tel_ref[$i]', '$notas_ref[$i]', '$idcliente')";
                  $sql = mysqli_query($conexion, $query_insertrefs);
                  if (!$sql) 
                  {
                      $insert_correctly2 = 0;
                  }
              }
            }

            if ($insert_correctly and $insert_correctly2) 
              {
                  $modal = "$('#mensaje_success').modal('show');"; 
                  #header("Location: agregar_usuario.php");
              } 
              else
              {
                  $alert = '<div class="alert alert-danger" role="alert">
                          Error al registrar un nuevo cliente, actualize e intente de nuevo
                      </div>';#.mysqli_error($conexion);
              }
        }
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
                                Cliente registrado correctamete
                            </div>
                        </div>
                        <div class="swal2-actions">
                            <a href="clientes.php" class="swal2-confirm swal2-styled" type="button" style="display: inline-block;">Ok</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

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
                <form action="" method="post" autocomplete="on">
                    <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="correo">Nueva zona</label>
                            <input type="text" class="form-control" name="nuevazona" id="nuevazona" required maxlength="99">
                        </div>  
                        </div>
                    </div>

                    <input value="zona" name="bandera" id="bandera" hidden>
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
                <form action="" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="correo">zona</label>
                            <input type="text" name="idnewzona_edit" id="idnewzona_edit" hidden>
                            <input type="text" class="form-control" name="newzona_edit" id="newzona_edit" required maxlength="99">
                        </div>  
                        </div>
                    </div>

                    <input value="editzona" name="bandera" id="bandera" hidden>
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
                <form action="" method="post" autocomplete="off">
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

                    <input value="subzona" name="bandera" id="bandera" hidden>
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
                <form action="" method="post" autocomplete="off">
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

                    <input value="editsubzona" name="bandera" id="bandera" hidden>
                    <div align="right">
                        <input type="submit" value="Agregar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Begin Page Content -->
<br>
<div class="container-fluid">
<div class="row">
    <div class="col-md-9 mx-auto">
        <form action="" method="post" autocomplete="on">

        <div class="card">
            <!-- 
            <div class="card-header bg text-dark">
                <h3><strong>AGREGAR CLIENTE</strong></h3>
            </div> -->

            <div class="card-body">
                <div id="prueba">
                    
                </div>
                    <?php #echo $tel1_cliente; ?>
                    <?php echo isset($alert) ? $alert : ''; ?>
                    <h4 align="center"><strong>DATOS DEL SOLICITANTE</strong></h4>
                    <div class="row">
                        <div class="form-group col-lg-7">
                            <label for="nombre_cliente">Nombre completo</label>
                            <input maxlength="100" type="text" class="form-control" placeholder="" name="nombre_cliente" id="nombre_cliente" required>
                        </div>

                        <?php 
                            if($editar_cliente_full)
                            {
                                $disabled_full = "";
                                $disabled_lim = "";
                                $show_modals_btn = 'data-toggle="modal"';
                            }
                            else if($editar_cliente_lim)
                            {
                                $disabled_lim = "";
                                $disabled_full = "disabled";
                                $show_modals_btn = '';
                            }
                            else
                            {
                                $disabled_lim = "disabled";
                                $disabled_full = "disabled";
                                $show_modals_btn = '';
                            }
                         ?>

                        <div class="col-lg-5">
                          <fieldset id="tools_zona" <?php echo $disabled_full; ?>>
                            <label for="zona">Zona</label>
                            <button <?php echo $show_modals_btn; ?> data-target="#nueva_zona" title="Agregar nueva zona" class="btn btn-primary btn-xs" type="button" href="#" ><i class="fas fa-plus"></i></button>
                            <button disabled <?php echo $show_modals_btn; ?> data-target="#editar_zona" id="btnedit_zona" onclick="editar_zona();" title="editar zona" class="btn btn-success btn-xs" type="button" href="#" ><i class="fas fa-edit"></i></button>
                            <button disabled id="btneliminar_zona" onclick="eliminar_zona();" title="Eliminar zona" class="btn btn-danger btn-xs" type="button" href="#" ><i class="fas fa-trash"></i></button>
                          </fieldset>

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


                        <div class="form-group col-lg-7">
                            <label for="domicilio_cliente">Domicilio</label>
                            <input maxlength="400" type="text" class="form-control" placeholder="" name="domicilio_cliente" id="domicilio_cliente">
                        </div>
                        <div class="form-group col-lg-5">
                          <fieldset id="tools_subzona" <?php echo $disabled_full; ?>>
                                <label for="subzona">Colonia (Subzona) </label>
                                <button <?php echo $show_modals_btn; ?> data-target="#nueva_subzona" title="Agregar nueva subzona" class="btn btn-primary btn-xs" type="button" href="#" ><i class="fas fa-plus"></i></button>
                              <button disabled id="btnedit_subzona" <?php echo $show_modals_btn; ?> data-target="#editar_subzona" onclick="editar_subzona();" title="editar subzona" class="btn btn-success btn-xs" type="button" href="#" ><i class="fas fa-edit"></i></button>
                              <button disabled id="btneliminar_subzona" onclick="eliminar_subzona();" title="Eliminar subzona" class="btn btn-danger btn-xs" type="button" href="#" ><i class="fas fa-trash"></i></button>
                          </fieldset>

                                        <select id='subzona' name='subzona' class='form-control' required>
                                            <option selected hidden value=''>Seleccione una colonia (subzona)</option>
                                        </select> 
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="tel1_cliente">Teléfono 1</label>
                            <input type="text" class="form-control" placeholder="exp. 9610000000" name="tel1_cliente" id="tel1_cliente" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="tel2_cliente">Teléfono 2</label>
                            <input type="text" class="form-control" placeholder="exp. 9610000000" name="tel2_cliente" id="tel2_cliente" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="cp_cliente">Código Postal</label>
                            <input type="number" class="form-control" placeholder="" name="cp_cliente" id="cp_cliente">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="idestado_civil">Conyugue</label>
                                <select class="form-control" id="idestado_civil" name="idestado_civil" required>
                                <option value="si" >Sí</option>
                                <option selected value="no" >No</option>
                              </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-lg-3">
                            <label for="curp">CURP</label>
                            <input onkeyup="mayusculas(this)" minlength="18" maxlength="18" type="text" class="form-control" placeholder="" name="curp" id="curp">
                        </div>
                      <div class="form-group col-lg-3">
                          <label for="rfc">RFC</label>
                          <input onkeyup="mayusculas(this)" minlength="13" maxlength="13" type="text" class="form-control" placeholder="" name="rfc" id="rfc">
                      </div>
                      <div class="col-lg-2"></div>
                      <div class="col-lg-3"> 
                        <br>
                        <h5 align="left"><strong>Cargar más datos sobre el cliente:</strong></h5>
                      </div>
                    <div class="col-lg-1">
                        <br>
                            <input id="masinfo" name="masinfo" value="" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="outline-secondary" data-size="xl" data-on="SI" data-off="NO" onchange="mostrar_mas_info()">
                        </div>
                    </div>
            </div>
        </div>

<br>
<div id="masdetalles_cliente" hidden>
        <div class="card">
            <!-- 
            <div class="card-header bg text-dark">
                <h3><strong>AGREGAR CLIENTE</strong></h3>
            </div> -->
            
            <div class="card-body">
                
                    <h4 align="center"><strong>DATOS LABORALES DEL SOLICITANTE</strong></h4>
                    <div class="row">

                        <div class="form-group col-lg-7">
                            <label for="trabajo_cliente">Lugar de Trabajo</label>
                            <input type="text" class="form-control" placeholder="" name="trabajo_cliente" id="trabajo_cliente">
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="puesto_cliente">Actividad o Puesto</label>
                            <input type="text" class="form-control" placeholder="" name="puesto_cliente" id="puesto_cliente">
                        </div>

                        <div class="form-group col-lg-5">
                            <label for="direccion_trabajo_cliente">Dirección</label>
                            <input type="text" class="form-control" placeholder="" name="direccion_trabajo_cliente" id="direccion_trabajo_cliente">
                        </div>

                        <div class="col-lg-2"></div>

                        <div class="form-group col-lg-5">
                            <div>
                                <label for="antiguedad_trabajo_cliente">Antigüedad</label>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="number" value="0" class="form-control" placeholder="" name="antiguedadA_trabajo_cliente" id="antiguedadA_trabajo_cliente" required> 
                                </div>
                                Años
                                
                                <div class="col-md-3">
                                    <input type="number" value="0" class="form-control" placeholder="" name="antiguedadM_trabajo_cliente" id="antiguedadM_trabajo_cliente" required> 
                                </div>
                                Meses
                            </div>
                            
                        </div>
                        
                        <div class="form-group col-lg-4">
                            <label for="ingresos_cliente">Ingresos</label>

                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="ingresos_cliente" id="ingresos_cliente" type="number" class="form-control" aria-label="Monto en pesos mexicanos" value="0">
                              <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                              </div>
                            </div>

                        </div>

                        <div class="form-group col-lg-1">
                            <label>&nbsp;</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo_ingreso_cliente" value="Diario" id="flexRadioDefault1">
                              <label class="form-check-label" for="flexRadioDefault1">
                                Diario
                              </label>
                            </div>
                        </div>
                        
                        <div class="form-group col-lg-1">
                            <label>&nbsp;</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo_ingreso_cliente" value="Semanal" id="flexRadioDefault2">
                              <label class="form-check-label" for="flexRadioDefault2">
                                Semanal
                              </label>
                            </div>
                        </div>
                        &nbsp;&nbsp;&nbsp;
                        <div class="form-group col-lg-1">
                            <label>&nbsp;</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo_ingreso_cliente" value="Quincenal" id="flexRadioDefault3" checked>
                              <label class="form-check-label" for="flexRadioDefault3">
                                Quincenal
                              </label>
                            </div>
                        </div>
                        
                    </div>
            </div>
        </div>
        <br>
    <div class="card collapse" id="card_conyugue" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <!-- 
            <div class="card-header bg text-dark">
                <h3><strong>AGREGAR CLIENTE</strong></h3>
            </div> -->
            
            <div class="card-body">
                    <h4 align="center"><strong>DATOS DEL CONYUGUE</strong></h4>
                    <div class="row">

                        <div class="form-group col-lg-7">
                            <label for="nombre_conyugue">Nombre completo</label>
                            <input type="text" class="form-control" placeholder="Ingrese Nombre con apellidos" name="nombre_conyugue_cliente" id="nombre_conyugue">
                        </div>

                        <div class="form-group col-lg-5">
                            <div>
                                <label for="antiguedadA_vinculo">Antigüedad del vinculo</label>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="number" value="0" class="form-control" placeholder="" name="antiguedadA_vinculo" id="antiguedadA_vinculo"> 
                                </div>
                                Años

                                <div class="col-md-4">
                                    <input type="number" value="0" class="form-control" placeholder="" name="antiguedadM_vinculo" id="antiguedadM_vinculo"> 
                                </div>
                                Meses
                            </div>
                        </div>

                        <div class="form-group col-lg-5">
                            <label for="trabajo_conyugue">Trabajo</label>
                            <input type="text" class="form-control" placeholder="" name="trabajo_conyugue" id="trabajo_conyugue">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="puesto_conyugue">Puesto</label>
                            <input type="text" class="form-control" placeholder="" name="puesto_conyugue" id="puesto_conyugue">
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="ingreso_mensual_conyugue">Ingreso Mensual</label>

                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="ingreso_mensual_conyugue" id="ingreso_mensual_conyugue" type="number" class="form-control" aria-label="Monto en pesos mexicanos" value="0">
                              <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                              </div>
                            </div>

                            <!--<input type="text" name="ingreso_mensual_conyugue" id="ingreso_mensual_conyugue" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="$10,000.00" class="form-control">-->
                        </div>
                        <div class="form-group col-lg-8">
                            <label for="direccion_trabajo_conyugue">Dirección de trabajo</label>
                            <input type="phone" class="form-control" placeholder="" name="direccion_trabajo_conyugue" id="direccion_trabajo_conyugue">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="tel_conyugue">Teléfono personal</label>
                            <input type="text" class="form-control" placeholder="exp. 9610000000" name="tel_conyugue" id="tel_conyugue" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                    </div>
            </div>
        </div> <!-- carta del conyugue, este se va a desplegar si se necesita -->

        <br>
        <div class="card">
            <div class="card-body">
                    <h4 align="center"><strong>VIVIENDA</strong></h4>
                    <div class="row" onclick="mostrar_campo_renta()">

                        <div class="form-group col-lg-2">
                            <label>Habita en casa:</label>
                        </div>

                        <div class="form-group col-lg-2">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo_vivienda_cliente" value="Propia" id="flexRadioDefault1c" checked>
                              <label class="form-check-label" for="flexRadioDefault1c">
                                Propia
                              </label>
                            </div>
                        </div>

                        &nbsp;&nbsp;&nbsp;
                        <div class="form-group col-lg-2">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo_vivienda_cliente" value="Familiares" id="flexRadioDefault3c">
                              <label class="form-check-label" for="flexRadioDefault3c">
                                Familiares
                              </label>
                            </div>
                        </div>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-group col-lg-2">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo_vivienda_cliente" value="Rentada" id="flexRadioDefault2c">
                              <label class="form-check-label" for="flexRadioDefault2c">
                                Rentada
                              </label>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>

                        <div class="form-group col-lg-3">
                            <div>
                                <label for="edad_residencia">Años de Residencia</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="number" value="0" class="form-control" placeholder="" name="edad_residencia" id="edad_residencia" required> 
                                </div>
                                Años
                            </div>
                        </div>                        

                        <div class="form-group col-lg-4">
                            <label for="ndependientes">N° de dependientes Económicos</label>
                            <input type="number" value="0" class="form-control" placeholder="" name="ndependientes" id="ndependientes" required>
                        </div>
                        <!--<div class="col-lg-1"></div>-->

                        <div class="form-group col-lg-4" id="div_renta" hidden>
                            <label for="renta_mensual">Renta Mensual</label>

                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="renta_mensual" id="renta_mensual" type="number" class="form-control" aria-label="Monto en pesos mexicanos" value="0">
                              <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                              </div>
                            </div>
                            <!--<input type="text" name="renta_mensual" id="renta_mensual" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="$10,000.00" class="form-control">-->
                        </div>

                    </div>
            </div>
        </div>
        <br>

        <!-- notas de cada referencia en un array llamano notas[] -->
        <div id="notas_referencias1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-secundary text-black">
                        <h5 class="modal-title" id="my-modal-title">Notas de la referencia</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                 <textarea class="form-control" name="notas_ref[]" title="Ingrese las notas requeridas" id="notas" placeholder="Ingrese las notas requeridas" maxlength="50000" style="height: 400px;"></textarea>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div id=modalref>
            
        </div>
        <!-- fin notas de cada referencia -->

        <div class="card">
            <div class="card-body">
                    <h4 align="center"><strong>REFERENCIAS FAMILIARES/NO FAMILIARES</strong></h4>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="nombre_ref1">Nombre Referencia</label>
                            <input type="text" class="form-control" placeholder="" name="nombre_ref[]">
                        </div>
                        <div class="col-lg-2" align="center">
                            <!-- aqui va a ir el boton para hacer las notas -->
                            <label>Notas</label><br>
                            <a onclick="" data-toggle="modal" data-target="#notas_referencias1" href="#"><i class="far fa-clipboard fa-4x"></i></a>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="relacion_ref1">Relación</label>
                            <input type="text" class="form-control" placeholder="" name="relacion_ref[]">
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="dom_ref1">Domicilio Referencia</label>
                            <input type="text" class="form-control" placeholder="" name="dom_ref[]">
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="form-group col-lg-3">
                            <label for="tel_ref1">Teléfono</label>
                            <input type="text" class="form-control" placeholder="exp. 9610000000" name="tel_ref[]" oninput='this.value = this.value.replace(/[^0-9]/g, "").replace(/(\..*)\./g, "$1");'>
                        </div>
                    </div>
            </div>
        </div>

        <div id="listas">
            
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div align="right">
                    <a id="add_field" class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Añadir Referencia</a>
                </div>
            </div> 
        </div>
        <br>
        
        <div class="card"> 
            <div class="card-body">
                    <h4 align="center"><strong>DATOS DEL AVAL</strong></h4>
                    <div class="row">

                        <div class="form-group col-lg-7">
                            <label for="nombre_aval">Nombre completo</label>
                            <input type="text" class="form-control" placeholder="Ingrese Nombre con apellidos" name="nombre_aval" id="nombre_aval">
                        </div>

                        <div class="form-group col-lg-5">
                            <label for="tel_aval">Teléfono</label>
                            <input type="text" class="form-control" placeholder="exp. 9610000000" name="tel_aval" id="tel_aval" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>

                        <div class="form-group col-lg-8">
                            <label for="domicilio_aval">Domicilio</label>
                            <input type="text" class="form-control" placeholder="" name="domicilio_aval" id="domicilio_aval">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="trabajo_aval">Trabajo actual</label>
                            <input type="text" class="form-control" placeholder="" name="trabajo_aval" id="trabajo_aval">
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="nombre_conyugue_aval">Conyugue</label>
                            <input type="text" class="form-control" placeholder="" name="nombre_conyugue_aval" id="nombre_conyugue_aval">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="puesto_aval">Puesto actual</label>
                            <input type="text" class="form-control" name="puesto_aval" id="puesto_aval">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="ingreso_mensual_aval">Ingreso Mensual</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="ingreso_mensual_aval" id="ingreso_mensual_aval" type="number" class="form-control" aria-label="Monto en pesos mexicanos" value="0">
                              <div class="input-group-append">
                                <span class="input-group-text">.00</span>
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
                    <div class="row">
                        <div class="col-lg-8">
                            <h4 align="left"><strong>APTO PARA EL CRÉDITO</strong></h4>
                        </div>

                        <div class="col-lg-3">
                            <select id="nivel_credito" name="nivel_credito" disabled class="form-control" required>
                                <option selected hidden value="0">Seleccione un nivel</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <div class="col-lg-1" align="right">
                            <input id="apto_credito" name="apto_credito" value="" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="outline-secondary" data-size="sm" data-on="SI" data-off="NO" onchange="bloquear_campo()">
                        </div>
                        
                    </div>
            </div>
        </div>

                    <br>
                    <div class="row">
                        <div align="right" class="col-lg-10">
                            <a type="submit" class="btn btn-secondary btn-lg" href="clientes.php">Regresar</a>
                        </div>
                        <div align="right" class="col-lg-2">
                            <input name="bandera" id="bandera" value="newcliente" hidden>
                            <input type="submit" value="Registrar" class="btn btn-primary btn-lg">
                        </div>
                    </div>
            
        </form>
    </div>
</div>

<!-- /.container-fluid -->
</div>
<br><br><br><br>
<!-- End of Main Content -->

<script type="text/javascript">
//funcion para poner mayusculas los inputs
function mayusculas(e) {
    e.value = e.value.toUpperCase();
}

function bloquear_campo()
{
  if (document.getElementById('apto_credito').checked)
  {
    $('#nivel_credito').removeAttr('disabled');
  }
  else
  {
    $('#nivel_credito').attr('disabled','disabled');
  }
}

function mostrar_mas_info()
{
  if (document.getElementById('masinfo').checked)
  {
    $('#masdetalles_cliente').removeAttr('hidden');
  }
  else
  {
    $('#masdetalles_cliente').attr('hidden','hidden');
  }
}

function mostrar_campo_renta()
{
  if (document.getElementById('flexRadioDefault2c').checked)
  {
    $('#div_renta').removeAttr('hidden');
  }
  else
  {
    $('#div_renta').attr('hidden','hidden');
  }
}

</script>

<?php ob_end_flush(); ?>
<?php include_once "footer.php"; ?>
