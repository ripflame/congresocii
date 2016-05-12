<?php
include_once "config.php";

$login_error = false;

if (isset($_POST['submit'])) {
  extract($_POST, EXTR_PREFIX_ALL, "form");

  $result = $db->folio->where("id LIKE ?", $form_folio);
  if(count($result) <= 0){
    $login_error = true;
  }
  foreach($result as $folio) {
    if ($folio == $form_folio && $folio['clave'] == $form_clave && !$folio['registrado']) {
      session_start();
      $_SESSION['folio'] = $folio['id'];
      header('Location: seleccion.php');
      exit();
	  } elseif ($folio == $form_folio && $folio['clave'] == $form_clave && $folio['registrado']) {
      session_start();
      $_SESSION['folio'] = $folio['id'];
      header('Location: registrado.php');
      exit();
    } else {
      $login_error = true;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="bootstrap-validator/dist/validator.min.js" type="text/javascript"></script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3 page-header">
          <h1 class="text-center">Congreso de ingenier&iacute;a e innovaci&oacute;n</h1>
          <h4 class="text-center">Selecci&oacute;n de actividades</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
          <h3 class="text-center">Escribe el folio y clave ubicados en tu boleto</h3>
          <?php if ($login_error): ?>
          <p class="text-center text-danger">El folio o la clave son incorrectos o este folio ya ha sido registrado antes</p>
          <?php endif; ?>
          <form action="" method="post" data-toggle="validator">
            <div class="form-group">
              <label for="folio">Folio</label>
              <input value="" type="number" id="folio" name="folio" class="form-control" data-error="Ingresa el folio de tu boleto" required>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label for="clave">Clave</label>
              <input value="" type="password" id="clave" name="clave" class="form-control" data-error="Ingresa la clave de tu boleto" required>
              <div class="help-block with-errors"></div>
            </div>
            <a href="index.php" class="btn btn-default">Regresar</a>
            <button type="submit" class="btn btn-primary pull-right" name="submit">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
