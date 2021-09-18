<?php session_start(); ?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>En mantenimiento</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
      header{
        background-color: #104773;
      }
      
      footer {
        height: 100%;
        display: block;
        background-color: #555555;
        color: white;
        padding: 15px;
      }
      html, body {
        height: 100%;
      }
      #main {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        margin: 0 auto -60px;
      }

      #footer{
        height: auto !important;
        margin-top: 0;
        background-color: #555555;
        color: white;
        font-size: 17px;
        /*font-weight: bold;*/
        width: 100%;
      }

      .sprite {
        background-image: url(/img/redes.png);
        background-repeat: no-repeat;
        display: inline-block;
      }

      .sprite-f1 {
        width: 55px;
        height: 55px;
        background-position: -5px -5px;
      }
      
      .sprite-f1:hover{
        width: 55px;
        height: 55px;
        background-position: -70px -5px;
      }

      .sprite-t1 {
        width: 55px;
        height: 55px;
        background-position: -5px -70px;
      }
      
      .sprite-t1:hover{
        width: 55px;
        height: 55px;
        background-position: -70px -70px;
      }
      
      .sprite-y1 {
        width: 55px;
        height: 55px;
        background-position: -135px -5px;
      }
      .sprite-y1:hover{
        width: 55px;
        height: 55px;
        background-position: -135px -70px;
      }
      
      li{
        display: inline;
      }
      @media screen and (max-width: 767px) {
        .row.content {
          height:auto;
        } 
      }
    </style>
  </head>

  <body>
  
  <header class="container-fluid hidden-print" id="cabecera">
      <div align="center"><a><img class="img-responsive" src="/img/header.png" alt="Dirección General de Extensión Universitaria" /></a></div>
  </header>

    <div class="container-fluid" id="main">  
      <div class="row content">
        <div class="col-sm-12 text-center">
          <h1>SUVID está en mantenimiento.</h1>
          <img src="/img/mantenimiento.jpg" class="center-block img-responsive">
          <h1>Estamos haciendo mejoras al sistema, disculpa las molestias.</h1>
        </div> <!--End Column-->
      </div> <!--End Row-->
    </div> <!-- End Container Cuerpo-->

    <div id="footer" class="text-center hidden-print">
      <p>Dirección de Vinculación y Servicio Social | 2a. Poniente Sur #118 Tuxtla Gutiérrez, Chiapas, México.| SUVID &copy; <?php echo date("Y");?></p>
      <center><a href="http://facebook.com/unachoficial" target="_blank" class="sprite sprite-f1" title="Facebook UNACH"></a>
      <a href="https://twitter.com/comunica_unach" target="_blank" class="sprite sprite-t1" title="Twitter UNACH"></a>
      <a href="https://www.youtube.com/user/unachoficial" target="_blank" class="sprite sprite-y1" title="Youtube UNACH"></a></center>

    </div>

  </body>

</html>