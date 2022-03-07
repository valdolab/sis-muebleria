<?php
ob_start();
$alert = '';
session_start();
if (!empty($_SESSION['active'])) {
  #session_destroy();
  header('location: inc/');
} else {
  require_once "inc/accion/conexion.php";
  if (!empty($_POST)) {
    if (empty($_POST['idusuario']) || empty($_POST['clave']) || empty($_POST['sucursal'])) {
      $alert = '<div class="alert alert-danger" role="alert">
                  Error, ingrese su usuario y su contraseña nuevamente.
                </div>';
    } else {
      $user = mysqli_real_escape_string($conexion, $_POST['idusuario']);
      $clave = md5(mysqli_real_escape_string($conexion, $_POST['clave']));
      $sucursal_name_aux = mysqli_real_escape_string($conexion, $_POST['sucursal']);
      if ($sucursal_name_aux == 'Multi-Sucursal')
      {
        $idsucursal = $_POST['SelectSucursal'];
      }
      else
      {
        $idsucursal = $_POST['idsucursal_flag'];
      }

      $query = mysqli_query($conexion, "SELECT idusuario,nombre,pass,rol FROM usuario WHERE idusuario = '$user' AND pass = '$clave'");
      $resultado = mysqli_num_rows($query);
      if ($resultado > 0) 
      {
        $dato = mysqli_fetch_array($query);

        $_SESSION['active'] = true;
        $_SESSION['iduser'] = $dato['idusuario'];
        $_SESSION['nombre'] = $dato['nombre'];;
        $_SESSION['rol'] = $dato['rol'];
        $_SESSION['idsucursal'] = $idsucursal;

        header('location: inc/');
      }
      else
      {
        $alert = '<div class="alert alert-danger" role="alert">
              Usuario o Contraseña Incorrecto
            </div>';
        session_destroy();
      }

    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Muebleria Compra Facil</title>

  <!-- Custom fonts for this template-->
  <link href="css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-3.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-12 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-4">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image">
                <img style="width: 545px; height: 565px;" src="img/compra_facil.png" class="img-thumbnail">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 style="font-size: 35px;" class="h4 text-gray-900 mb-4">Iniciar Sesión</h1>
                  </div>
                  <?php echo isset($alert) ? $alert : ""; ?>

                  <form class="user" method="POST">
                    <div class="form-group">
                      <label for="">Usuario</label>
                      <input type="text" class="form-control" placeholder="Introduce tu usuario" name="idusuario" id="idusuario" required>
                    </div>
                    
                    <div class="row">

                      <div id="div_sucursal" class="col-lg-12">
                        <div class="form-group">
                          <label for="">Sucursal</label>
                          <input type="text" class="form-control" value="" name="sucursal" id="sucursal" required readonly>
                          </div>
                      </div>

                      <input hidden value="" name="idsucursal_flag" id="idsucursal_flag">

                      <div class="col-lg-6">
                        <div class="form-group" id="divSucursal" name="divSucursal" hidden>
                          <label for="">Selecciona sucursal</label>
                          <select class="form-control" id="SelectSucursal" name="SelectSucursal">
                            <option value="" hidden selected>Seleccione una opción</option>
                            <?php
                            #codigo para la lista de sucursales que se extraen de la base de datos
                            $result = mysqli_query($conexion,"SELECT idsucursales,sucursales FROM sucursales");                        
                            if (mysqli_num_rows($result) > 0) {  
                              while($row = mysqli_fetch_assoc($result)){
                              echo "<option value='".$row["idsucursales"]."'>".$row["sucursales"]."</option>";
                              }
                            }
                            ?>                      
                          </select>
                        </div>
                      </div>

                    </div>

                    <div class="form-group">
                      <label for="">Contraseña</label>
                      <input type="password" class="form-control" placeholder="Introduce tu contraseña" name="clave" required>
                    </div>
                    <input type="submit" value="Iniciar" class="btn btn-primary">
                    
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="js/jquery/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="js/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script type="text/javascript">
  // buscar sucursal del usuario en el LOGIN
  // buscar Cliente
  $('#idusuario').keyup(function(e) {
    $('#div_sucursal').attr('class','col-lg-12');
    e.preventDefault();
    var cl = $(this).val();
    
    var action = 'searchSucursal';
    $.ajax({
      url: 'findsucursal.php',
      type: "POST",
      async: true,
      data: {action:action,usuario:cl},
      success: function(response) {
        //$('#sucursal').val(response);

        if (response == 0) {
          $('#sucursal').val('---');
          $('#divSucursal').attr('hidden','hidden');
          $('#SelectSucursal').removeAttr('required');
        }else {
          var data = $.parseJSON(response);
          if (data.multi == 2)
          {
            $('#sucursal').val('Multi-Sucursal');
            $('#divSucursal').removeAttr('hidden');
            $('#SelectSucursal').attr('required','required');
            $('#div_sucursal').attr('class','col-lg-6');
          }
          else
          {
            $('#sucursal').val(data.sucursales);
            $('#idsucursal_flag').val(data.idsucursales);
            $('#divSucursal').attr('hidden','hidden');
            $('#SelectSucursal').removeAttr('required');
            $('#div_sucursal').attr('class','col-lg-12');
          }
        }
      },
      error: function(error) {
        $('#sucursal').val('error');
      }
    });
    
  });
</script>

</body>

</html>
<?php
 ob_end_flush();
 mysqli_close($conexion); 
?>