<?php 
ob_start();
include_once "header.php";
include "accion/conexion.php";

?>

<div class="col-lg-12">

<div class="card">
<div class="card-body">
    <div class="row">
        <div class="col-lg-8">
            <h4><strong>CATALOGO DE PRODUCTOS</strong></h4>
            <!--<input type="" name="prueba" id="prueba">-->
        </div>

        <div align="right" class="col-lg-4">
            <button class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Nueva categoría</button>
            <button  class="btn btn-primary" type="button" ><i class="fas fa-plus"></i> Nuevo producto</button> 
        </div>
    </div>
</div>
</div>
<div class="card">
<div class="card-body">
    <div class="row">
        <div class="col-lg-2">
            <h4><strong>FILTROS</strong></h4>
            <!--<input type="" name="prueba" id="prueba">-->
        </div>
        <div align="right" class="col-lg-10">
            
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
