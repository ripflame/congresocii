<?php
 include_once "config.php";

  session_start();
  if (!isset($_SESSION['folio'])) {
    header("Location: index.php");
    exit();
  } else {
    $participante = $db->participante->where("participante.folio_id LIKE ?", $_SESSION['folio'])->fetch();
    session_destroy();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Congreso de Ingenier&iacute;a e innovaci&oacute;n</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="bootstrap-validator/dist/validator.min.js" type="text/javascript"></script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3 page-header">
          <h1 class="text-center">Congreso de ingenier&iacute;a e innovaci&oacute;n</h1>
          <h4 class="text-center">Registro al congreso</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <h4 class="text-center">¡Felicidades <?php echo "{$participante['nombre']} {$participante['ap_paterno']} {$participante['ap_materno']}"; ?>!, ya est&aacute;s registrado para el congreso</h4>
      </div>
      <div class="row">
        <div class="col-sm-2 col-sm-offset-5">
          <a href="index.php" class="btn btn-default center-block">Regresar</a>
        </div>
        </div>
      </div>
    </div>
  </body>
</html>
