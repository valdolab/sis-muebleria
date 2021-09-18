<?php
ob_start();
include_once "header.php";
include "accion/conexion.php";

if (!empty($_POST)) 
{
   
}
?>

<div id="nueva_zona" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Nueva Zona</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="off">
                    <div class="form-group">

                <div class="table-responsive">
                    <table class="table table-sm" id="tbl" data-page-length='4'>
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Zona</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($conexion, "SELECT idzona,zona FROM zonas ORDER BY zona ASC");
                            $result = mysqli_num_rows($query);

                            if ($result > 0) {
                                $contador = 1;
                                while ($data = mysqli_fetch_assoc($query)) {
                                    $idzona = $data['idzona'];
                                    ?>
                                    <tr>
                                        <td><?php echo $contador; ?></td>
                                        <td><?php echo $data['zona']; ?></td>
                                        <td align="center" WIDTH="5">
                                        <button onClick='eliminar_zona("<?php echo $idzona; ?>")' class='btn btn-danger btn-sm' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>
                                            
                                        </td>
                                    </tr>
                            <?php 
                                $contador = $contador + 1;
                                }
                            } 
                            ?>
                        </tbody>
                    </table>
                </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="correo">Nueva zona</label>
                            <input type="text" class="form-control" name="newzona" id="newzona" required>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Nueva Colonia (SubZona)</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="off">
                    <div class="form-group">

                <div class="table-responsive">
                    <table class="table table-sm" id="tb2" data-page-length='4'>
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>SubZona</th>
                                <th>Zona</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($conexion, "SELECT idsubzona,subzona,idzona FROM subzonas ORDER BY idzona ASC");
                            $result = mysqli_num_rows($query);

                            if ($result > 0) {
                                $contador = 1;
                                while ($data = mysqli_fetch_assoc($query)) {
                                    $idsubzona = $data['idsubzona'];
                                    $idzona = $data['idzona'];
                                    $query2 = mysqli_query($conexion, "SELECT idzona,zona FROM zonas where idzona=$idzona");
                                    $data2 = mysqli_fetch_assoc($query2)
                                    ?>
                                    <tr>
                                        <td><?php echo $contador; ?></td>
                                        <td><?php echo $data['subzona']; ?></td>
                                        <td><?php echo $data2['zona']; ?></td>
                                        <td align="center" WIDTH="5">
                                        <button onClick='eliminar_subzona("<?php echo $idsubzona; ?>")' class='btn btn-danger btn-sm' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>
                                            
                                        </td>
                                    </tr>
                            <?php 
                                $contador = $contador + 1;
                                }
                            } 
                            ?>
                        </tbody>
                    </table>
                </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="correo">Nueva zona</label>
                            <input type="text" class="form-control" name="newsubzona" id="newsubzona" required>
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

<div id="nuevo_estadocivil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Nueva Estado Civil</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" autocomplete="off">
                    <div class="form-group">

                <div class="table-responsive">
                    <table class="table table-sm" id="tb3" data-page-length='4'>
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Estado Civil</th>
                                <th>Tiene Conyugue</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($conexion, "SELECT idestado_civil,estado_civil,es_conyugue FROM estado_civil ORDER BY idestado_civil ASC");
                            $result = mysqli_num_rows($query);

                            if ($result > 0) {
                                $contador = 1;
                                while ($data = mysqli_fetch_assoc($query)) {
                                    $idestadocivil = $data['idestado_civil'];
                                    if($data['es_conyugue'])
                                    {
                                        $tiene_conyugue = "Sí";
                                    }
                                    else
                                    {
                                        $tiene_conyugue = "No";
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $contador; ?></td>
                                        <td><?php echo $data['estado_civil']; ?></td>
                                        <td><?php echo $tiene_conyugue; ?></td>
                                        <td align="center" WIDTH="5">
                                        <button onClick='eliminar_estadocivil("<?php echo $idestadocivil; ?>")' class='btn btn-danger btn-sm' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>
                                            
                                        </td>
                                    </tr>
                            <?php 
                                $contador = $contador + 1;
                                }
                            } 
                            ?>
                        </tbody>
                    </table>
                </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="correo">Nuevo estado civil</label>
                            <input type="text" class="form-control" name="newestado_civil" id="newestado_civil" required>
                          </div>  
                        </div>
                        <div class="col-lg-3" align="center">
                            <label for="tiene_conyugue">¿Tiene conyugue?</label>
                            <input id="tiene_conyugue" name="tiene_conyugue" value="" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="outline-secondary" data-size="sm" data-on="SI" data-off="NO">
                        </div>
                        
                    </div>

                    <input value="estado_civil" name="bandera" id="bandera" hidden>

                    <div align="right">
                        <input type="submit" value="Agregar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<br>
<!-- Begin Page Content -->
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
                    <h4 align="center"><strong>DATOS DEL SOLICITANTE</strong></h4>
                    <div class="row">
                        <div class="form-group col-lg-7">
                            <label for="nombre">Nombre completo</label>
                            <input type="text" class="form-control" placeholder="" name="nombre" id="nombre" required>
                        </div>

                        <div class="col-lg-5">
                            <label for="nombre">Zona</label>
                            <select class="form-control" id="zonas" name="zonas" required>
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
                                <option onClick="add_zona()" value="-1" >Agregar nueva zona...</option>
                              </select>
                        </div>


                        <div class="form-group col-lg-7">
                            <label for="domicilio">Domicilio</label>
                            <input required type="text" class="form-control" placeholder="" name="domicilio" id="domicilio">
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="colonia">Colonia (Subzona) </label>
                            <div id="select_subzonas">
                                    <select id='colonia' name='colonia' class='form-control' required>
                                        <option selected hidden value=''>Seleccione una colonia (subzona)</option>
                                        <option onClick='add_subzona()' value='-1'>Agregar nueva colonia (subzona)...</option>
                                    </select>
                            </div>
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="telefono1">Teléfono 1</label>
                            <input type="tel" class="form-control" placeholder="exp. (111)111-1111" name="telefono1" id="telefono1" required>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="telefono2">Teléfono 2</label>
                            <input type="tel" class="form-control" placeholder="exp. (111)111-1111" name="telefono2" id="telefono2">
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="postal">Código Postal</label>
                            <input type="number" class="form-control" placeholder="" name="postal" id="postal" required>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="estado_civil">Estado Civil</label>
                                <select class="form-control" id="estado_civil" name="estado_civil" required>
                                <option selected hidden>Seleccione una opción</option>
                                <?php
                                #codigo para la lista de sucursales que se extraen de la base de datos
                                $result = mysqli_query($conexion,"SELECT idestado_civil,estado_civil,es_conyugue FROM estado_civil");                        
                                if (mysqli_num_rows($result) > 0) {  
                                  while($row = mysqli_fetch_assoc($result))
                                  {
                                    if ($row["es_conyugue"] == 1)
                                    {
                                        echo "<option onClick='show_dataconyugue(1)' value='".$row["idestado_civil"]."'>".$row["estado_civil"]."</option>";
                                    }
                                    else
                                    {
                                        echo "<option onClick='show_dataconyugue(0)' value='".$row["idestado_civil"]."'>".$row["estado_civil"]."</option>";
                                    }
                                  }
                                }
                                ?>
                                <option onClick="add_estadocivil()" value="-1" >Agregar nuevo estado civil...</option>
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
                            <label for="trabajo">Lugar de Trabajo</label>
                            <input type="text" class="form-control" placeholder="" name="trabajo" id="trabajo" required>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="puesto">Actividad o Puesto</label>
                            <input type="text" class="form-control" placeholder="" name="puesto" id="puesto" required>
                        </div>

                        <div class="form-group col-lg-5">
                            <label for="direccion_trabajo">Dirección</label>
                            <input type="text" class="form-control" placeholder="" name="direccion_trabajo" id="direccion_trabajo" required>
                        </div>

                        <div class="col-lg-2"></div>

                        <div class="form-group col-lg-5">
                            <div>
                                <label for="antiguedad">Antigüedad</label>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="number" value="0" class="form-control" placeholder="" name="antiguedad" id="antiguedad_ano" required> 
                                </div>
                                Años
                                
                                <div class="col-md-3">
                                    <input type="number" value="0" class="form-control" placeholder="" name="antiguedad" id="antiguedad_mes" required> 
                                </div>
                                Meses
                            </div>
                            
                        </div>
                        
                        <div class="form-group col-lg-4">
                            <label for="ingresos">Ingresos</label>
                            <input type="text" name="ingresos" id="ingresos" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="$10,000.00" class="form-control" required>
                        </div>

                        <div class="form-group col-lg-1">
                            <label>&nbsp;</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo_ingreso" value="diario" id="flexRadioDefault1">
                              <label class="form-check-label" for="flexRadioDefault1">
                                Diario
                              </label>
                            </div>
                        </div>
                        
                        <div class="form-group col-lg-1">
                            <label>&nbsp;</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo_ingreso" value="semanal" id="flexRadioDefault2">
                              <label class="form-check-label" for="flexRadioDefault2">
                                Semanal
                              </label>
                            </div>
                        </div>
                        &nbsp;&nbsp;&nbsp;
                        <div class="form-group col-lg-1">
                            <label>&nbsp;</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo_ingreso" value="quincenal" id="flexRadioDefault3" checked>
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
                            <label for="nombre_con">Nombre completo</label>
                            <input type="text" class="form-control" placeholder="Ingrese Nombre con apellidos" name="nombre_con" id="nombre_con" required>
                        </div>

                        <div class="form-group col-lg-5">
                            <div>
                                <label for="antiguedad_vinculo">Antigüedad del vinculo</label>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="number" value="0" class="form-control" placeholder="" name="antiguedad_vinculo" id="antiguedad_vinculo" required> 
                                </div>
                                Años

                                <div class="col-md-4">
                                    <input type="number" value="0" class="form-control" placeholder="" name="antiguedad" id="antiguedad_mes" required> 
                                </div>
                                Meses
                            </div>
                        </div>

                        <div class="form-group col-lg-5">
                            <label for="trabajo_con">Trabajo</label>
                            <input type="text" class="form-control" placeholder="" name="trabajo_con" id="trabajo_con" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="puesto_con">Puesto</label>
                            <input type="text" class="form-control" placeholder="" name="puesto_con" id="puesto_con" required>
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="ingreso_con">Ingreso Mensual</label>
                            <input type="text" name="ingreso_con" id="ingreso_con" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="$10,000.00" class="form-control" required>
                        </div>
                        <div class="form-group col-lg-8">
                            <label for="direccion_job_con">Dirección de trabajo</label>
                            <input type="phone" class="form-control" placeholder="" name="direccion_job_con" id="direccion_job_con" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="telefono_con">Teléfono</label>
                            <input type="tel" class="form-control" placeholder="exp. (111)111-1111" name="telefono_con" id="telefono_con" required>
                        </div>
                    </div>
            </div>
        </div> <!-- carta del conyugue, este se va a desplegar si se necesita -->

        <br>
        <div class="card">
            <div class="card-body">
                    <h4 align="center"><strong>VIVIENDA</strong></h4>
                    <div class="row">

                        <div class="form-group col-lg-2">
                            <label>Habita en casa:</label>
                        </div>

                        <div class="form-group col-lg-2">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo_casa" value="propia" id="flexRadioDefault1c" checked>
                              <label class="form-check-label" for="flexRadioDefault1c">
                                Propia
                              </label>
                            </div>
                        </div>

                        &nbsp;&nbsp;&nbsp;
                        <div class="form-group col-lg-2">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo_casa" value="rentada" id="flexRadioDefault2c">
                              <label class="form-check-label" for="flexRadioDefault2c">
                                Rentada
                              </label>
                            </div>
                        </div>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-group col-lg-2">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="tipo_casa" value="familiares" id="flexRadioDefault3c">
                              <label class="form-check-label" for="flexRadioDefault3c">
                                Familiares
                              </label>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>

                        <div class="form-group col-lg-3">
                            <div>
                                <label for="anos_recidencia">Años de Residencia</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="number" value="0" class="form-control" placeholder="" name="anos_recidencia" id="anos_recidencia" required> 
                                </div>
                                Años
                            </div>
                        </div>

                        <div class="form-group col-lg-4">
                            <label for="renta_mensual">Renta Mensual</label>
                            <input type="text" name="renta_mensual" id="renta_mensual" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="$10,000.00" class="form-control" required>
                        </div>
                        <div class="col-lg-1"></div>

                        <div class="form-group col-lg-4">
                            <label for="dependientes">N° de dependientes Económicos</label>
                            <input type="number" value="0" class="form-control" placeholder="" name="dependientes" id="dependientes" required>
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
                        <h5 class="modal-title" id="my-modal-title">Notas de la referencia 1</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                 <textarea class="form-control" name="notas[]" title="Ingrese las notas requeridas" id="notas" placeholder="Ingrese las notas requeridas" maxlength="10000" style="height: 400px;"></textarea>
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
                            <label for="nombre_ref1">Nombre Referencia 1</label>
                            <input type="text" class="form-control" placeholder="" name="nombre_ref[]" required>
                        </div>
                        <div class="col-lg-2">
                            <!-- aqui va a ir el boton para hacer las notas -->
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a onclick="" data-toggle="modal" data-target="#notas_referencias1" href="#"><i class="far fa-clipboard fa-4x"></i></a>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="relacion_ref1">Relación 1</label>
                            <input type="text" class="form-control" placeholder="" name="relacion_ref[]" required>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="dom_ref1">Domicilio Referencia 1</label>
                            <input type="text" class="form-control" placeholder="" name="dom_ref[]" required>
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="form-group col-lg-3">
                            <label for="tel_ref1">Teléfono 1</label>
                            <input type="text" class="form-control" placeholder="" name="tel_ref[]" required>
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
                            <input type="text" class="form-control" placeholder="Ingrese Nombre con apellidos" name="nombre_aval" id="nombre_aval" required>
                        </div>

                        <div class="form-group col-lg-5">
                            <label for="tel_aval">Teléfono</label>
                            <input type="tel" class="form-control" placeholder="exp. (111)111-1111" name="tel_aval" id="tel_aval" required>
                        </div>

                        <div class="form-group col-lg-8">
                            <label for="dirreccion_aval">Domicilio</label>
                            <input type="text" class="form-control" placeholder="" name="dirreccion_aval" id="dirreccion_aval" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="job_aval">Trabajo actual</label>
                            <input type="text" class="form-control" placeholder="" name="job_aval" id="job_aval" required>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="con_aval">Conyugue</label>
                            <input type="text" class="form-control" placeholder="" name="con_aval" id="con_aval" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="puesto_aval">Puesto actual</label>
                            <input type="text" class="form-control" name="puesto_aval" id="puesto_aval" required>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="ingreso_aval">Ingreso Mensual</label>
                            <input type="text" name="ingreso_aval" id="ingreso_aval" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" value="" data-type="currency" placeholder="$10,000.00" class="form-control" required>
                        </div>
                    </div>
            </div>
        </div>
        <br>

        <div class="card">
            <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <h4 align="left"><strong>APTO PARA EL CRÉDITO</strong></h4>
                        </div>

                        <div class="col-lg-2">
                            <select id="nivel_credito" name="nivel_credito" disabled class="form-control">
                                <option selected hidden value="">Seleccione un nivel</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <div class="col-lg-1" align="right">
                            <input id="apto_credito" name="apto_credito" value="" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="outline-secondary" data-size="sm" data-on="SI" data-off="NO" onchange="bloquear_campo()" >
                        </div>
                        
                    </div>
            </div>
        </div>

                    <br>
                    <?php echo isset($alert) ? $alert : ''; ?>
                    

                    <div class="row">
                        <div align="right" class="col-lg-10">
                            <a type="submit" class="btn btn-secondary btn-lg" href="usuarios.php">Regresar</a>
                        </div>
                        <div align="right" class="col-lg-2">
                            <input name="bandera" id="bandera" value="newusuario" hidden>
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

function show_dataconyugue(is_show)
{
    if(is_show)
    {
        $('#card_conyugue').collapse('show');
    }
    else
    {
        $('#card_conyugue').collapse('hide');
    }
    
}

function add_zona()
{
    $('#nueva_zona').modal('show');
}

function add_subzona()
{
    $('#nueva_subzona').modal('show');
}

function add_estadocivil()
{
    $('#nuevo_estadocivil').modal('show');
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

</script>

<?php ob_end_flush(); ?>
<?php include_once "footer.php"; ?>
