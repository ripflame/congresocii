<?php
 include_once "config.php";

  session_start();
  if (!isset($_SESSION['folio'])) {
    header("Location: index.php");
    exit();
  } else {
    $stmt = $pdo->prepare("SELECT * FROM `participante` WHERE `folio_id`=:folio_id");
    $stmt->execute(array(":folio_id"=>$_SESSION['folio']));
    $participante = $stmt->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['submit'])) {
      extract($_POST, EXTR_PREFIX_ALL, "form");

      $stmt = $pdo->prepare("UPDATE `folio` SET `pulsera`=:pulsera, `kit`=:kit, `registro_evento`=:registro_evento WHERE `id`=:folio");
      $result = $stmt->execute(array(":folio"=> $_SESSION['folio'], ":pulsera" => $form_pulsera, ":kit"=>$form_kit, ":registro_evento" => $form_registrado));

      if ($result) {
        header("Location: registroConfirmacion.php");
        exit();
      }
    }
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
      <form action="" method="post" class="panel" id="registerForm" data-toggle="validator">
        <div class="row">
          <div class="col-sm-4 col-sm-offset-4">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input value="<?php echo "{$participante['nombre']} {$participante['ap_paterno']} {$participante['ap_materno']}"; ?>" type="text" id="nombre" name="nombre" class="form-control" data-error="Ingresa tu nombre" disabled>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label for="pulsera">C&oacute;digo de pulsera</label>
              <input type="number" id="pulsera" name="pulsera" class="form-control" data-error="Ingresa el c&oacute;digo de la pulsera" required>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label> <input type="checkbox" name="registrado" value="1"> Registrado</label>
            </div>
            <div class="form-group">
              <label> <input type="checkbox" name="kit" value="1"> Kit entregado</label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-sm-offset-4">
            <a href="registroLogin.php" class="btn btn-default">Regresar</a>
            <button type="submit" name="submit" id="submit" class="btn btn-primary pull-right">Guardar</button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
