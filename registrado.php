<?php
session_start();
$folio['id']= $_SESSION['folio'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Congreso de Ingenier&iacute;a e innovaci&oacute;n</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
  </head>
  <body>
    <div class="container">
      <div class="page-header">
        <h1 class="text-center">Congreso de ingenier&iacute;a e innovaci&oacute;n</h1>
      </div>
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4 btn-group-vertical">
          <a href="seleccionConfirmacion.php" class="btn btn-primary" >Ver datos de registro</a>
          <a href="edicionDatos.php" class="btn btn-primary" >Editar datos de personales</a>
          <a href="http://www.unimodelo.edu.mx/merida/ci+i" target="blank" class="btn btn-primary">P&aacute;gina del congreso</a>
          <a href="logout.php" class="btn btn-primary">Salir</a>
        </div>
      </div>
    </div>
  </body>
</html>
