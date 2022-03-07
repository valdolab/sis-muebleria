<?php
include "conexion.php";
if (!empty($_POST)) 
{
          $name_documento = $_POST['nombre'];
          $folio = $_POST['folio'];
          $serie = $_POST['serie'];
          $sucursal = $_POST['sucursal'];
                $query_insert = mysqli_query($conexion, "INSERT INTO documento(name_documento,folio,serie,idsucursal,estado) values ('$name_documento','$folio','$serie', $sucursal, 1)");
                    if (!$query_insert)
                    {
                                $newurl = $_SERVER['HTTP_REFERER']."?msgdoc=error_nuevo_doc";
                            header("Location: $newurl");
                    }
                    else
                    {
                      $newurl = $_SERVER['HTTP_REFERER']."?msgdoc=seregistro_doc";
                            header("Location: $newurl");
                    }  
}

?>
