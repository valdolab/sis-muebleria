<?php
include "conexion.php";
if (!empty($_POST)) 
{
    $nomsucursal = $_POST['newsucursal'];
          $desc_sucursal = $_POST['desc_sucursal'];
          $insert_sucursal= mysqli_query($conexion, "INSERT INTO sucursales(sucursales,descripcion) values ('$nomsucursal','$desc_sucursal')");
              if ($insert_sucursal) 
              {
              	  $newurl = $_SERVER['HTTP_REFERER']."?msgsuc=sucursal_insertada";
                  header("Location: $newurl");
              }
              else
              {
              	  $newurl = $_SERVER['HTTP_REFERER']."?msgsuc=error_nueva_sucursal";
                  header("Location: $newurl");
              }
}

?>
