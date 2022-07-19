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
            <h4><strong>INVENTARIO ACTUAL</strong></h4>
            <!--<input type="" name="prueba" id="prueba">-->
        </div>

        <div align="right" class="col-lg-2">
            <!-- <a data-toggle="modal" data-target="#nuevo_documento"  class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Nuevo documento</a> -->
            <a href="agregar_almacen.php"  class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Nuevo almacén</a> 
        </div>
    </div>
</div>
</div>

<div class="card">
<div class="card-body">
    <div class="row">
        <div class="col-lg-5">

            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <h4><strong>Valor total de la mercancía</strong></h4>
                            </div>

                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Costo:
                                <br>
                                <h3 align="center">$24,000</h3>
                                <br>
                                <br>
                                Contado:
                                <br>
                                <h3 align="center">$44,000</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-7">
            <div class="card border h-30 shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                <h4><strong>Filtrado por sucursal</strong></h4>
                            </div>
                        </div>
                        <input id="tiene_subcat" name="tiene_subcat" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="secondary" data-size="m" data-on="SI" data-off="NO">
                    </div>
                </div>
            </div>
            <div class="card border h-30 shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                <h4><strong>Filtrado por almacén</strong></h4>

                            </div>
                        </div>
                        <input id="tiene_subcat" name="tiene_subcat" type="checkbox" data-toggle="toggle" data-onstyle="primary" data-offstyle="secondary" data-size="m" data-on="SI" data-off="NO">
                    </div>
                </div>
            </div>
            <div class="card border h-30 shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                <button class="btn btn-primary"><h4><strong>Descargar CSV</strong></h4></button>
                            </div>

                        </div>
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
<div class="table-responsive">
    <table class="table" id="tbl">
        <thead class="thead-light">
            <tr>
                <th>No.</th>
                <th>Documento</th>
                <th>Folio</th>
                <th>Serie</th>
                <th>Sucursal</th>
                <th>Tipo</th>
                <th style="text-align: center;">Herramientas</th>
            </tr>
        </thead>
        <tbody>
                    <tr>
                        <td>asd</td>
                        <td>asd</td>
                        <td>asd</td>
                        <td>asd</td>
                        <td>asd</td>
                        <td>asd</td>
                        <td align="center">
                                <a href="editar_documento.php?id=" class="btn btn-success btn-sm"><i class='fas fa-edit'></i></a>
                                <button onClick='eliminar_doc()' class='btn btn-danger btn-sm' type='submit'><i style='color: white;' class='fas fa-trash-alt'></i></button>
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
