<?php
  include_once "config.php";

  $login_error        = false;
  $login_registered   = false;
  $login_unregistered = false;

  if (isset($_POST['submit'])) {
    $folio = $_POST['folio'];

    $stmt = $pdo->prepare("SELECT `id`, `registro_evento`, `registrado` FROM `folio` WHERE `id`=:id");
    $stmt->execute(array(":id"=>$folio));

    if ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      if ($result['registro_evento'] != 0) {
        $login_registered = true;
      } elseif ($result['registrado'] == 0) {
        $login_unregistered = true;
      } else {
        session_start();
        $_SESSION['folio'] = $folio;
        header("Location: registro.php");
        exit();
      }
    } else {
      $login_error = true;
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
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3 page-header">
          <h1 class="text-center">Congreso de ingenier&iacute;a e innovaci&oacute;n</h1>
          <h4 class="text-center">Registro al congreso.</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
          <h3 class="text-center">Escribe el folio de tu boleto</h3>
          <?php if ($login_error): ?>
          <p class="text-center text-danger">El folio es incorrecto</p>
          <?php endif; ?>
          <?php if ($login_registered): ?>
          <p class="text-center text-danger">El folio ya ha sido registrado</p>
          <?php endif; ?>
          <?php if ($login_unregistered): ?>
          <p class="text-center text-danger">El participante no ha sido registrado</p>
          <?php endif; ?>
          <form action="" method="post">
            <div class="form-group">
              <label for="folio">Folio</label>
              <input value="" type="text" id="folio" name="folio" class="form-control">
            </div>
            <a href="index.php" class="btn btn-default">Regresar</a>
            <button type="submit" name="submit" class="btn btn-primary pull-right">Entrar</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
