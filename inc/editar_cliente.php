<?php
ob_start();
include_once "header.php";
include "accion/conexion.php";

$id_cliente = $_GET['id'];
if (empty($id_cliente)) 
{
  header("Location: clientes.php");
}
else
{
    $sql = mysqli_query($conexion, "SELECT * from cliente where idcliente = '$id_cliente'");
    $result_sql = mysqli_num_rows($sql);
    if ($result_sql == 0) {
      header("Location: clientes.php");
    }
    else
    {
        $data = mysqli_fetch_array($sql);
        $up_nombre_cliente = $data['nombre_cliente'];
        $up_zona = $data['zona'];
        $up_domicilio_cliente = $data['domicilio_cliente'];
        $up_subzona =  $data['subzona'];
        $up_tel1_cliente = $data['tel1_cliente'];
        $up_tel2_cliente = $data['tel2_cliente'];
        $up_cp_cliente =$data['cp_cliente'];
        $up_idestado_civil = $data['idestado_civil'];
        $up_trabajo_cliente = $data['trabajo_cliente'];
        $up_puesto_cliente = $data['puesto_cliente'];
        $up_direccion_trabajo_cliente = $data['direccion_trabajo_cliente'];
        $up_antiguedadA_trabajo_cliente = $data['antiguedadA_trabajo_cliente'];
        $up_antiguedadM_trabajo_cliente = $data['antiguedadM_trabajo_cliente'];
        $up_ingresos_cliente = $data['ingresos_cliente'];
        $up_tipo_ingresos_cliente = $data['tipo_ingresos_cliente'];
        $up_nombre_conyugue_cliente = $data['nombre_conyugue_cliente'];
        $up_antiguedadA_vinculo = $data['antiguedadA_vinculo'];
        $up_antiguedadM_vinculo = $data['antiguedadM_vinculo'];
        $up_trabajo_conyugue = $data['trabajo_conyugue'];
        $up_puesto_conyugue = $data['puesto_conyugue'];
        $up_ingreso_mensual_conyugue = $data['ingreso_mensual_conyugue'];
        $up_direccion_trabajo_conyugue = $data['direccion_trabajo_conyugue'];
        $up_tel_conyugue = $data['tel_conyugue'];
        $up_tipo_vivienda_cliente = $data['tipo_vivienda_cliente'];
        $up_edad_residencia = $data['edad_residencia'];
        $up_renta_mensual = $data['renta_mensual'];
        $up_ndependientes = $data['ndependientes'];
        $up_nombre_aval = $data['nombre_aval'];
        $up_tel_aval = $data['tel_aval'];
        $up_domicilio_aval = $data['domicilio_aval'];
        $up_trabajo_aval = $data['trabajo_aval'];
        $up_puesto_aval = $data['puesto_aval'];
        $up_ingreso_mensual_aval = $data['ingreso_mensual_aval'];
        $up_nombre_conyugue_aval = $data['nombre_conyugue_aval'];
        $up_apto_credito = $data['apto_credito'];
        $up_nivel_apto = $data['nivel_apto'];
        $up_estado_cliente = $data['estado_cliente'];

        $sql2 = mysqli_query($conexion, "SELECT nombre, domicilio, relacion, tel, nota, idcliente from referencias_cliente where idcliente = '$id_cliente'");

        $up_nombre_ref = [];
        $up_relacion_ref = [];
        $up_domicilio_ref = [];
        $up_tel_ref = [];
        $up_notas_ref = [];

        while($row = mysqli_fetch_assoc($sql2)) 
        {
            $up_nombre_ref[] = $row['nombre'];
            $up_relacion_ref[] = $row['relacion'];
            $up_domicilio_ref[] = $row['domicilio'];
            $up_tel_ref[] = $row['tel'];
            $up_notas_ref[] = $row['nota'];
        }
        #print_r($nombre_ref);
        $num_refs = sizeof($up_nombre_ref);
    } 
}

#mensajes
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
                  $alert = '<div class="alert alert-primary" role="alert">
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
                  $alert = '<div class="alert alert-primary" role="alert">
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
        else if($ban == 'newcliente')
        {
            #vemos si tiene permisos full o lim
            if($editar_cliente_full)
            {
                $nombre_cliente = $_POST['nombre_cliente'];
                $idcliente = md5($nombre_cliente);
                #primero borramos todo lo de ese cliente para insertarlo de nuevo con lo actualizado
                $query_delete_cliente_refs = mysqli_query($conexion, "DELETE FROM referencias_cliente WHERE idcliente = '$idcliente'");
                $query_delete_cliente = mysqli_query($conexion, "DELETE FROM cliente WHERE idcliente = '$idcliente'");
                if ($query_delete_cliente and $query_delete_cliente_refs) 
                {
                  $elimino_cliente = 1;
                }else {
                  $elimino_cliente = 0;
                }
                #guardamos los datos a insertar en variables
                $zona = $_POST['zona'];
                $domicilio_cliente = $_POST['domicilio_cliente'];
                $subzona = $_POST['subzona'];
                $tel1_cliente = $_POST['tel1_cliente'];
                $tel2_cliente = $_POST['tel2_cliente'];
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
                
                $nivel_apto = $_POST['nivel_credito'];

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

                   $sql_insert = "INSERT INTO cliente(idcliente, nombre_cliente, zona, domicilio_cliente, subzona, tel1_cliente, tel2_cliente, cp_cliente, idestado_civil, trabajo_cliente, puesto_cliente, direccion_trabajo_cliente, antiguedadA_trabajo_cliente, antiguedadM_trabajo_cliente, ingresos_cliente, tipo_ingresos_cliente, nombre_conyugue_cliente, antiguedadA_vinculo, antiguedadM_vinculo, trabajo_conyugue, puesto_conyugue, ingreso_mensual_conyugue, direccion_trabajo_conyugue, tel_conyugue, tipo_vivienda_cliente, edad_residencia, renta_mensual, ndependientes, nombre_aval, tel_aval, domicilio_aval, trabajo_aval, puesto_aval, ingreso_mensual_aval, nombre_conyugue_aval, apto_credito, nivel_apto) VALUES ('$idcliente', '$nombre_cliente', $zona, '$domicilio_cliente', $subzona, ".(!empty($tel1_cliente) ? "'$tel1_cliente'" : "NULL").", ".(!empty($tel2_cliente) ? "'$tel2_cliente'" : "NULL").", $cp_cliente, $conyugue, '$trabajo_cliente', '$puesto_cliente', '$direccion_trabajo_cliente', $antiguedadA_trabajo_cliente, $antiguedadM_trabajo_cliente, $ingresos_cliente, '$tipo_ingreso_cliente', '$nombre_conyugue_cliente', $antiguedadA_vinculo, $antiguedadM_vinculo, '$trabajo_conyugue', '$puesto_conyugue', $ingreso_mensual_conyugue, '$direccion_trabajo_conyugue', '$tel_conyugue', '$tipo_vivienda_cliente', $edad_residencia, $renta_mensual, $ndependientes, ".(!empty($nombre_aval) ? "'$nombre_aval'" : "NULL").", ".(!empty($tel_aval) ? "'$tel_aval'" : "NULL").", ".(!empty($domicilio_aval) ? "'$domicilio_aval'" : "NULL").", ".(!empty($trabajo_aval) ? "'$trabajo_aval'" : "NULL").", ".(!empty($puesto_aval) ? "'$puesto_aval'" : "NULL").", ".(!empty($ingreso_mensual_aval) ? "$ingreso_mensual_aval" : "NULL").", ".(!empty($nombre_conyugue_aval) ? "'$nombre_conyugue_aval'" : "NULL").", $apto_credito, $nivel_apto)";

                $insert_correctly = FALSE;
                $insert_cliente = mysqli_query($conexion, $sql_insert);
                  if ($insert_cliente) {
                      $insert_correctly = TRUE;
                  } 
                }
                else#no tiene conyugue y no guardamos nada, puro null
                {
                    $conyugue = 0;
                    $sql_insert = "INSERT INTO cliente(idcliente, nombre_cliente, zona, domicilio_cliente, subzona, tel1_cliente, tel2_cliente, cp_cliente, idestado_civil, trabajo_cliente, puesto_cliente, direccion_trabajo_cliente, antiguedadA_trabajo_cliente, antiguedadM_trabajo_cliente, ingresos_cliente, tipo_ingresos_cliente, nombre_conyugue_cliente, antiguedadA_vinculo, antiguedadM_vinculo, trabajo_conyugue, puesto_conyugue, ingreso_mensual_conyugue, direccion_trabajo_conyugue, tel_conyugue, tipo_vivienda_cliente, edad_residencia, renta_mensual, ndependientes, nombre_aval, tel_aval, domicilio_aval, trabajo_aval, puesto_aval, ingreso_mensual_aval, nombre_conyugue_aval, apto_credito, nivel_apto) VALUES ('$idcliente', '$nombre_cliente', $zona, '$domicilio_cliente', $subzona, ".(!empty($tel1_cliente) ? "'$tel1_cliente'" : "NULL").", ".(!empty($tel2_cliente) ? "'$tel2_cliente'" : "NULL").", $cp_cliente, $conyugue, '$trabajo_cliente', '$puesto_cliente', '$direccion_trabajo_cliente', $antiguedadA_trabajo_cliente, $antiguedadM_trabajo_cliente, $ingresos_cliente, '$tipo_ingreso_cliente', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$tipo_vivienda_cliente', $edad_residencia, $renta_mensual, $ndependientes, ".(!empty($nombre_aval) ? "'$nombre_aval'" : "NULL").", ".(!empty($tel_aval) ? "'$tel_aval'" : "NULL").", ".(!empty($domicilio_aval) ? "'$domicilio_aval'" : "NULL").", ".(!empty($trabajo_aval) ? "'$trabajo_aval'" : "NULL").", ".(!empty($puesto_aval) ? "'$puesto_aval'" : "NULL").", ".(!empty($ingreso_mensual_aval) ? "$ingreso_mensual_aval" : "NULL").", ".(!empty($nombre_conyugue_aval) ? "'$nombre_conyugue_aval'" : "NULL").", $apto_credito, $nivel_apto)";

                    $insert_correctly = FALSE;
                    $insert_cliente = mysqli_query($conexion, $sql_insert);
                      if ($insert_cliente) 
                      {
                          $insert_correctly = TRUE;
                      } 
                }
                  
                #AHORA INSERTAMOS SUS REFERENCIAS
                #$insert_correctly2 = 1;
                $nombre_ref = $_POST['nombre_ref'];
                $relacion_ref = $_POST['relacion_ref'];
                $domicilio_ref = $_POST['dom_ref'];
                $tel_ref = $_POST['tel_ref'];
                $notas_ref = $_POST['notas_ref'];

                $size_refs = sizeof($nombre_ref);
                $insert_correctly2 = 1;
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

                if ($insert_correctly and $insert_correctly2 and $elimino_cliente) 
                  {
                      $modal = "$('#mensaje_success').modal('show');"; 
                      #header("Location: agregar_usuario.php");
                  } 
                  else
                  {
                      $alert = '<div class="alert alert-danger" role="alert">
                              Pudo haber ocurrido un error al actualizar el cliente, verifique, actualize e intente de nuevo en caso de ser necesario.
                          </div>';#.mysqli_error($conexion);

                  }
            }
            else if($editar_cliente_lim)
            {
                #SOLO PUEDE EDITAR SUS TELEFONOS, entonces solo actualizamos
                $tel1_cliente = $_POST['tel1_cliente'];
                $tel2_cliente = $_POST['tel2_cliente'];
                $query_update_cliente = mysqli_query($conexion,"UPDATE cliente SET tel1_cliente='$tel1_cliente',tel2_cliente='$tel2_cliente' where idcliente = '$id_cliente'");
                if($query_update_cliente)
                {
                    $modal = "$('#mensaje_success').modal('show');"; 
                }
                else
                {
                    $alert = '<div class="alert alert-danger" role="alert">
                              Pudo haber ocurrido un error al actualizar los datos del cliente, verifique, actualize e intente de nuevo en caso de ser necesario.
                          </div>';#.mysqli_error($conexion);
                }
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
                <form action="" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="correo">Nueva zona</label>
                            <input type="text" class="form-control" name="nuevazona" id="nuevazona" required>
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

<div id="nueva_subzona" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Nueva subZona (Colonia)</h5>
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
                            <input type="text" class="form-control" name="nuevasubzona" id="nuevasubzona" required>
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

<!-- Begin Page Content -->
<div class="container-fluid">
<div class="row">
    <div class="col-md-9 mx-auto">
        <form action="" method="post" autocomplete="on">
            <div align="left">
                <a href="clientes.php"  class="btn btn-secondary btn-lg" type="button" >Regresar</a> 
                <input name="bandera" id="bandera" value="newcliente" hidden>
                <?php 
                    if($editar_cliente_full)
                    {
                        echo '<input type="submit" value="Actualizar cliente" class="btn btn-primary btn-lg">';
                        $disabled_full = "";
                        $disabled_lim = "";
                    }
                    else if($editar_cliente_lim)
                    {
                        echo '<input type="submit" value="Actualizar cliente" class="btn btn-primary btn-lg">';
                        $disabled_lim = "";
                        $disabled_full = "disabled";
                    }
                    else
                    {
                        echo '<button disabled class="btn btn-primary btn-lg">Actualizar cliente</button>';
                        $disabled_lim = "disabled";
                        $disabled_full = "disabled";
                    }
                 ?>
            </div>
             <br>
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
                            <input maxlength="100" type="text" class="form-control" placeholder="" name="nombre_cliente" id="nombre_cliente" required value="<?php echo $up_nombre_cliente; ?>" <?php echo $disabled_full; ?>>
                        </div>

                        <div class="col-lg-5">
                            <label for="zona">Zona</label>
                            <select class="form-control" id="zona" name="zona" required <?php echo $disabled_full; ?>>
                                <option selected hidden>Seleccione una opción</option>
                                <?php
                                $result = mysqli_query($conexion,"SELECT idzona,zona FROM zonas");                         
                                if (mysqli_num_rows($result) > 0) {  
                                  while($row = mysqli_fetch_assoc($result))
                                  {
                                    if ($row['idzona'] == $up_zona)
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
                                <option value="newzona">Agregar nueva zona...</option>
                              </select>
                        </div>


                        <div class="form-group col-lg-7">
                            <label for="domicilio_cliente">Domicilio</label>
                            <input maxlength="400" required type="text" class="form-control" placeholder="" name="domicilio_cliente" id="domicilio_cliente" value="<?php echo $up_domicilio_cliente ?>" <?php echo $disabled_full; ?>>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="subzona">Colonia (Subzona) </label>
                            <button data-toggle="modal" data-target="#nueva_subzona" title="Agregar nueva Subzona" class="btn btn-primary btn-xs" type="button" href="#" <?php echo $disabled_full; ?>><i class="fas fa-plus"></i></button>
                            <div id="select_subzonas">
                                    <select id='subzona' name='subzona' class='form-control' required <?php echo $disabled_full; ?>>
                                        <?php 
                                            $result = mysqli_query($conexion,"SELECT idsubzona,subzona FROM subzonas where idzona=$up_zona");                         
                                            if (mysqli_num_rows($result) > 0) {  
                                              while($row = mysqli_fetch_assoc($result))
                                              {
                                                if ($row['idsubzona'] == $up_subzona)
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
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="tel1_cliente">Teléfono 1</label>
                            <input type="text" class="form-control" placeholder="exp. 9610000000" name="tel1_cliente" id="tel1_cliente" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $up_tel1_cliente; ?>" <?php echo $disabled_lim; ?>>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="tel2_cliente">Teléfono 2</label>
                            <input type="text" class="form-control" placeholder="exp. 9610000000" name="tel2_cliente" id="tel2_cliente" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $up_tel2_cliente; ?>" <?php echo $disabled_lim; ?>>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="cp_cliente">Código Postal</label>
                            <input type="number" class="form-control" placeholder="" name="cp_cliente" id="cp_cliente" required value="<?php echo $up_cp_cliente; ?>" <?php echo $disabled_full; ?>>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="idestado_civil">Conyugue</label>
                                <select class="form-control" id="idestado_civil" name="idestado_civil" required <?php echo $disabled_full; ?>>
                                <?php 
                                    if($up_idestado_civil == 1)
                                    {
                                        echo '<option selected value="si" >Sí</option>';
                                        echo '<option value="no" >No</option>';
                                    }
                                    else
                                    {
                                        echo '<option value="si" >Sí</option>';
                                        echo '<option selected value="no" >No</option>';
                                    }
                                ?>
                              </select>
                        </div>
                    </div>
            </div>
        </div>

<br>

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
                            <input type="text" class="form-control" placeholder="" name="trabajo_cliente" id="trabajo_cliente" required value="<?php echo $up_trabajo_cliente; ?>" <?php echo $disabled_full; ?>>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="puesto_cliente">Actividad o Puesto</label>
                            <input type="text" class="form-control" placeholder="" name="puesto_cliente" id="puesto_cliente" required value="<?php echo $up_puesto_cliente; ?>" <?php echo $disabled_full; ?>>
                        </div>

                        <div class="form-group col-lg-5">
                            <label for="direccion_trabajo_cliente">Dirección</label>
                            <input type="text" class="form-control" placeholder="" name="direccion_trabajo_cliente" id="direccion_trabajo_cliente" required value="<?php echo $up_direccion_trabajo_cliente; ?>" <?php echo $disabled_full; ?>>
                        </div>

                        <div class="col-lg-2"></div>

                        <div class="form-group col-lg-5">
                            <div>
                                <label for="antiguedad_trabajo_cliente">Antigüedad</label>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="number" class="form-control" placeholder="" name="antiguedadA_trabajo_cliente" id="antiguedadA_trabajo_cliente" required value="<?php echo $up_antiguedadA_trabajo_cliente; ?>" <?php echo $disabled_full; ?>> 
                                </div>
                                Años
                                
                                <div class="col-md-3">
                                    <input type="number" class="form-control" placeholder="" name="antiguedadM_trabajo_cliente" id="antiguedadM_trabajo_cliente" required value="<?php echo $up_antiguedadM_trabajo_cliente; ?>" <?php echo $disabled_full; ?>> 
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
                              <input name="ingresos_cliente" id="ingresos_cliente" type="number" class="form-control" aria-label="Monto en pesos mexicanos" value="<?php echo $up_ingresos_cliente; ?>" <?php echo $disabled_full; ?>>
                              <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                              </div>
                            </div>

                            <!--
                            <input type="text" name="ingresos_cliente" id="ingresos_cliente" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="$10,000.00" class="form-control" required>
                            -->
                    <?php 
                        $check_diario = "";
                        $check_semanal = "";
                        $check_quincenal = "";
                        if($up_tipo_ingresos_cliente == "Diario")
                        {
                            $check_diario = "checked";
                        }
                        else if($up_tipo_ingresos_cliente == "Semanal")
                        {
                            $check_semanal = "checked";
                        }
                        else if($up_tipo_ingresos_cliente == "Quincenal")
                        {
                            $check_quincenal = "checked";
                        }
                    ?>
                            

                        </div>

                        <div class="form-group col-lg-1">
                            <label>&nbsp;</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo_ingreso_cliente" value="Diario" id="flexRadioDefault1" <?php echo $check_diario; ?> <?php echo $disabled_full; ?>>
                              <label class="form-check-label" for="flexRadioDefault1">
                                Diario
                              </label>
                            </div>
                        </div>
                        
                        <div class="form-group col-lg-1">
                            <label>&nbsp;</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo_ingreso_cliente" value="Semanal" id="flexRadioDefault2" <?php echo $check_semanal; ?> <?php echo $disabled_full; ?>>
                              <label class="form-check-label" for="flexRadioDefault2">
                                Semanal
                              </label>
                            </div>
                        </div>
                        &nbsp;&nbsp;&nbsp;
                        <div class="form-group col-lg-1">
                            <label>&nbsp;</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo_ingreso_cliente" value="Quincenal" id="flexRadioDefault3" <?php echo $check_quincenal; ?> <?php echo $disabled_full; ?>>
                              <label class="form-check-label" for="flexRadioDefault3">
                                Quincenal
                              </label>
                            </div>
                        </div>
                        
                    </div>
            </div>
        </div>
        <br>
        <?php 
            if($up_idestado_civil == 1)
            {
                $muestra_card_conyugue = 'class="card collapse show"';
            }
            else
            {
                $muestra_card_conyugue = 'class="card collapse"';
            }
         ?>
    <div <?php echo $muestra_card_conyugue ?> id="card_conyugue" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="card-body">
                    <h4 align="center"><strong>DATOS DEL CONYUGUE</strong></h4>
                    <div class="row">

                        <div class="form-group col-lg-7">
                            <label for="nombre_conyugue">Nombre completo</label>
                            <input type="text" class="form-control" placeholder="Ingrese Nombre con apellidos" name="nombre_conyugue_cliente" id="nombre_conyugue" value="<?php echo $up_nombre_conyugue_cliente; ?>" <?php echo $disabled_full; ?>>
                        </div>

                        <div class="form-group col-lg-5">
                            <div>
                                <label for="antiguedadA_vinculo">Antigüedad del vinculo</label>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="number" class="form-control" placeholder="" name="antiguedadA_vinculo" id="antiguedadA_vinculo" value="<?php echo $up_antiguedadA_vinculo; ?>" <?php echo $disabled_full; ?>> 
                                </div>
                                Años

                                <div class="col-md-4">
                                    <input type="number" class="form-control" placeholder="" name="antiguedadM_vinculo" id="antiguedadM_vinculo" value="<?php echo $up_antiguedadM_vinculo; ?>" <?php echo $disabled_full; ?>> 
                                </div>
                                Meses
                            </div>
                        </div>

                        <div class="form-group col-lg-5">
                            <label for="trabajo_conyugue">Trabajo</label>
                            <input type="text" class="form-control" placeholder="" name="trabajo_conyugue" id="trabajo_conyugue" value="<?php echo $up_trabajo_conyugue; ?>" <?php echo $disabled_full; ?>>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="puesto_conyugue">Puesto</label>
                            <input type="text" class="form-control" placeholder="" name="puesto_conyugue" id="puesto_conyugue" value="<?php echo $up_puesto_conyugue; ?>" <?php echo $disabled_full; ?>>
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="ingreso_mensual_conyugue">Ingreso Mensual</label>

                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="ingreso_mensual_conyugue" id="ingreso_mensual_conyugue" type="number" class="form-control" aria-label="Monto en pesos mexicanos" value="<?php echo $up_ingreso_mensual_conyugue; ?>" <?php echo $disabled_full; ?>>
                              <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                              </div>
                            </div>

                            <!--<input type="text" name="ingreso_mensual_conyugue" id="ingreso_mensual_conyugue" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="$10,000.00" class="form-control">-->
                        </div>
                        <div class="form-group col-lg-8">
                            <label for="direccion_trabajo_conyugue">Dirección de trabajo</label>
                            <input type="phone" class="form-control" placeholder="" name="direccion_trabajo_conyugue" id="direccion_trabajo_conyugue" value="<?php echo $up_direccion_trabajo_conyugue; ?>" <?php echo $disabled_full; ?>>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="tel_conyugue">Teléfono personal</label>
                            <input type="text" class="form-control" placeholder="exp. 9610000000" name="tel_conyugue" id="tel_conyugue" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $up_tel_conyugue; ?>" <?php echo $disabled_full; ?>>
                        </div>
                    </div>
            </div>
        </div> <!-- carta del conyugue, este se va a desplegar si se necesita -->

        <?php 
                        $check_propia = "";
                        $check_familiares = "";
                        $check_rentada = "";
                        $mostrar_renta = "hidden";
                        if($up_tipo_vivienda_cliente == "Propia")
                        {
                            $check_propia = "checked";
                        }
                        else if($up_tipo_vivienda_cliente == "Familiares")
                        {
                            $check_familiares = "checked";
                        }
                        else if($up_tipo_vivienda_cliente == "Rentada")
                        {
                            $check_rentada = "checked";
                            $mostrar_renta = "";
                        }
                    ?>

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
                              <input class="form-check-input" type="radio" name="tipo_vivienda_cliente" value="Propia" id="flexRadioDefault1c" <?php echo $check_propia; ?> <?php echo $disabled_full; ?>>
                              <label class="form-check-label" for="flexRadioDefault1c">
                                Propia
                              </label>
                            </div>
                        </div>

                        &nbsp;&nbsp;&nbsp;
                        <div class="form-group col-lg-2">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo_vivienda_cliente" value="Familiares" id="flexRadioDefault3c" <?php echo $check_familiares; ?> <?php echo $disabled_full; ?>>
                              <label class="form-check-label" for="flexRadioDefault3c">
                                Familiares
                              </label>
                            </div>
                        </div>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-group col-lg-2">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo_vivienda_cliente" value="Rentada" id="flexRadioDefault2c" <?php echo $check_rentada; ?> <?php echo $disabled_full; ?>>
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
                                    <input type="number" class="form-control" placeholder="" name="edad_residencia" id="edad_residencia" required value="<?php echo $up_edad_residencia; ?>" <?php echo $disabled_full; ?>> 
                                </div>
                                Años
                            </div>
                        </div>                        

                        <div class="form-group col-lg-4">
                            <label for="ndependientes">N° de dependientes Económicos</label>
                            <input type="number" class="form-control" placeholder="" name="ndependientes" id="ndependientes" required value="<?php echo $up_ndependientes; ?>" <?php echo $disabled_full; ?>>
                        </div>
                        <!--<div class="col-lg-1"></div>-->

                        <div class="form-group col-lg-4" id="div_renta" <?php echo $mostrar_renta; ?>>
                            <label for="renta_mensual">Renta Mensual</label>

                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="renta_mensual" id="renta_mensual" type="number" class="form-control" aria-label="Monto en pesos mexicanos" value="<?php echo $up_renta_mensual; ?>" <?php echo $disabled_full; ?>>
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

        <?php 
            for ($i=0; $i < $num_refs; $i++) 
            { 
                $newidnota = $i + 1;
                $id_notasrefs = "notas_referencias".$newidnota;
                ?>
                    <div id="<?php echo $id_notasrefs; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
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
                                             <textarea <?php echo $disabled_full; ?> class="form-control" name="notas_ref[]" title="Ingrese las notas requeridas" id="notas" placeholder="Ingrese las notas requeridas" maxlength="50000" style="height: 400px;"><?php echo $up_notas_ref[$i]; ?></textarea>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php      
            }
         ?>
        <div id=modalref>
        </div>
        <!-- fin notas de cada referencia -->

        <?php 
            for ($i=0; $i < $num_refs; $i++) 
            {
                $newidnota = $i + 1;
                $id_notasrefs = "notas_referencias".$newidnota;
                ?>
                    <div class="card" id='borrador<?php echo $newidnota; ?>' >
                    <div class="card-body">
                            <h4 align="center"><strong>REFERENCIAS FAMILIARES/NO FAMILIARES</strong></h4>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="nombre_ref1">Nombre Referencia</label>
                                    <input type="text" class="form-control" placeholder="" name="nombre_ref[]" required value="<?php echo $up_nombre_ref[$i]; ?>" <?php echo $disabled_full; ?>>
                                </div>
                                <div class="col-lg-2" align="center">
                                    <!-- aqui va a ir el boton para hacer las notas -->
                                    <label>Notas</label><br>
                                    <a onclick="" data-toggle="modal" data-target="#notas_referencias<?php echo $newidnota; ?>" href="#"><i class="far fa-clipboard fa-4x"></i></a>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="relacion_ref1">Relación</label>
                                    <input type="text" class="form-control" placeholder="" name="relacion_ref[]" required value="<?php echo $up_relacion_ref[$i]; ?>" <?php echo $disabled_full; ?>>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="dom_ref1">Domicilio Referencia</label>
                                    <input type="text" class="form-control" placeholder="" name="dom_ref[]" required value="<?php echo $up_domicilio_ref[$i]; ?>" <?php echo $disabled_full; ?>>
                                </div>
                                <div class="col-lg-2"></div>
                                <div class="form-group col-lg-3">
                                    <label for="tel_ref1">Teléfono</label>
                                    <input type="text" class="form-control" placeholder="exp. 9610000000" name="tel_ref[]" required oninput='this.value = this.value.replace(/[^0-9]/g, "").replace(/(\..*)\./g, "$1");' value="<?php echo $up_tel_ref[$i]; ?>" <?php echo $disabled_full; ?>>
                                </div>
                                <?php 
                                    if($newidnota >= 2)
                                    {
                                        if($disabled_full == "disabled")
                                        {
                                            echo "<div class='col-lg-1' align='right'>
                                                <a class='remover_campo'><i style='color: gray;' class='fas fa-trash-alt fa-2x'></i></a>
                                            </div>";
                                        }
                                        else
                                        {
                                            echo "<div class='col-lg-1' align='right'>
                                                <a href='#referencias' onclick='borrar_card(".$newidnota.")' class='remover_campo'><i style='color: red;' class='fas fa-trash-alt fa-2x'></i></a>
                                            </div>";
                                        }
                                        
                                    }
                                 ?>
                            </div>
                    </div>
                </div>
                <?php 
            }
         ?>
        <div id="listas">
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div align="right">
                    <div id="button_agregar">
                        <button <?php echo $disabled_full; ?> id="button_agre" onclick="mostrar_refs(<?php echo $num_refs+1; ?>);" class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Añadir Referencia</button>
                    </div>
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
                            <input type="text" class="form-control" placeholder="Ingrese Nombre con apellidos" name="nombre_aval" id="nombre_aval" required value="<?php echo $up_nombre_aval; ?>" <?php echo $disabled_full; ?>>
                        </div>

                        <div class="form-group col-lg-5">
                            <label for="tel_aval">Teléfono</label>
                            <input type="text" class="form-control" placeholder="exp. 9610000000" name="tel_aval" id="tel_aval" required oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $up_tel_aval; ?>" <?php echo $disabled_full; ?>>
                        </div>

                        <div class="form-group col-lg-8">
                            <label for="domicilio_aval">Domicilio</label>
                            <input type="text" class="form-control" placeholder="" name="domicilio_aval" id="domicilio_aval" required value="<?php echo $up_domicilio_aval; ?>" <?php echo $disabled_full; ?>>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="trabajo_aval">Trabajo actual</label>
                            <input type="text" class="form-control" placeholder="" name="trabajo_aval" id="trabajo_aval" required value="<?php echo $up_trabajo_aval; ?>" <?php echo $disabled_full; ?>>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="nombre_conyugue_aval">Conyugue</label>
                            <input type="text" class="form-control" placeholder="" name="nombre_conyugue_aval" id="nombre_conyugue_aval" required value="<?php echo $up_nombre_conyugue_aval; ?>" <?php echo $disabled_full; ?>>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="puesto_aval">Puesto actual</label>
                            <input type="text" class="form-control" name="puesto_aval" id="puesto_aval" required value="<?php echo $up_puesto_aval; ?>" <?php echo $disabled_full; ?>>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="ingreso_mensual_aval">Ingreso Mensual</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input name="ingreso_mensual_aval" id="ingreso_mensual_aval" type="number" class="form-control" aria-label="Monto en pesos mexicanos" value="<?php echo $up_ingreso_mensual_aval; ?>" <?php echo $disabled_full; ?>>
                              <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                              </div>
                            </div>

                            <!--<input type="text" name="ingreso_mensual_aval" id="ingreso_mensual_aval" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="$10,000.00" class="form-control" required>-->
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
                        <?php 
                            $check_apto_credito = "";
                            $disabled_nivel = "disabled";
                            if($up_apto_credito == 1)
                            {
                                $check_apto_credito = "checked";
                                $disabled_nivel = "";
                            }
                         ?>

                        <div class="col-lg-3">
                            <select id="nivel_credito" name="nivel_credito" <?php echo $disabled_nivel; ?> class="form-control" required <?php echo $disabled_full; ?>>
                                <option hidden value="">Seleccione un nivel</option>
                                <?php 
                                    if($up_nivel_apto == 0)
                                    {
                                        echo '<option selected value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>';
                                    }
                                    else if($up_nivel_apto == 1)
                                    {
                                        echo '<option value="0">0</option>
                                                <option selected value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>';
                                    }
                                    else if($up_nivel_apto == 2)
                                    {
                                        echo '<option value="0">0</option>
                                                <option value="1">1</option>
                                                <option selected value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>';
                                    }
                                    else if($up_nivel_apto == 3)
                                    {
                                        echo '<option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option selected value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>';
                                    }
                                    else if($up_nivel_apto == 4)
                                    {
                                        echo '<option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option selected value="4">4</option>
                                                <option value="5">5</option>';
                                    }
                                    else if($up_nivel_apto == 5)
                                    {
                                        echo '<option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option selected value="5">5</option>';
                                    }
                                 ?>
                            </select>
                        </div>

                        <div class="col-lg-1" align="right">
                            <input id="apto_credito" name="apto_credito" value="" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="outline-secondary" data-size="sm" data-on="SI" data-off="NO" onchange="bloquear_campo()" required <?php echo $check_apto_credito; ?> <?php echo $disabled_full; ?>>
                        </div>
                    </div>
            </div>
        </div>
    <br>
            
        </form>
    </div>
</div>

<!-- /.container-fluid -->
</div>
<br><br><br><br>
<!-- End of Main Content -->

<script type="text/javascript">

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
