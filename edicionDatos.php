<?php
  include_once "config.php";

  session_start();
  if (!isset($_SESSION['folio'])) {
    header("Location: index.php");
  } else {
    $participante = $db->participante->where("participante.folio_id LIKE ?", $_SESSION['folio'])->fetch();

    if ( isset($_POST['submit'])) {
      extract($_POST, EXTR_PREFIX_ALL, "form");

      $noChanges = $participante['nombre'] == $form_nombre && $participante['ap_paterno'] == $form_ap_paterno &&
                   $participante['ap_materno'] == $form_ap_materno && $participante['nacimiento'] == $form_nacimiento &&
                   $participante['sexo'] == $form_sexo && $participante['email'] == $form_correo &&
                   $participante['escuela'] == $form_escuela && $participante['carrera'] == $form_carrera &&
                   $participante['semestre'] == $form_semestre;

      if ($noChanges) {
        header( "Location: seleccionConfirmacion.php" );
        exit();
      }

      $participantes = $db->participante->where("participante.folio_id LIKE ?", $_SESSION['folio'])->fetch();
      $data = array(
        "nombre"         => $form_nombre,
        "ap_paterno"     => $form_ap_paterno,
        "ap_materno"     => $form_ap_materno,
        "nacimiento"     => $form_nacimiento,
        "sexo"           => $form_sexo,
        "email"          => $form_correo,
        "escuela"        => $form_escuela,
        "carrera"        => $form_carrera,
        "semestre"       => $form_semestre,
      );
      $result = $participantes->update($data);

      if ($result) {
        header( "Location: seleccionConfirmacion.php" );
        exit();
      } else {
        echo "FUCK!";
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
    <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3 page-header">
          <h1 class="text-center">Congreso de ingenier&iacute;a e innovaci&oacute;n</h1>
          <h4 class="text-center">Selecci&oacute;n de actividades</h4>
        </div>
      </div>
      <form action="" method="post" class="panel" id="registerForm" data-toggle="validator">
        <div class="row">
          <div class="col-sm-4 col-sm-offset-4">
            <h3 class="text-center">Llena esta secci&oacute;n con tus datos personales</h3>
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input value="<?php echo $participante['nombre']; ?>" type="text" id="nombre" name="nombre" class="form-control" data-error="Ingresa tu nombre" required>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label for="ap_paterno">Apellido paterno</label>
              <input value="<?php echo $participante['ap_paterno']; ?>" type="text" id="ap_paterno" name="ap_paterno" class="form-control" data-error="Ingresa tu apellido paterno" required>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label for="ap_materno">Apellido materno</label>
              <input value="<?php echo $participante['ap_materno']; ?>" type="text" class="form-control" name="ap_materno" id="ap_materno" data-error="Ingresa tu apellido materno" required>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label for="nacimiento">Fecha de nacimiento</label>
              <div class="input-group date">
                <input value="<?php echo $participante['nacimiento']; ?>" type="text" class="form-control" name="nacimiento" pattern="^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$" maxlength="10" data-error="Selecciona tu fecha de nacimiento" required><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
              </div>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label for="sexo">Sexo</label>
              <label class="radio-inline"> <input type="radio" name="sexo" value="1" <?php if ($participante['sexo'] != 2) echo "checked"; ?>> Hombre </label>
              <label class="radio-inline"> <input type="radio" name="sexo" value="2" <?php if ($participante['sexo'] == 2) echo "checked"; ?>> Mujer </label>
            </div>
            <div class="form-group">
              <label for="correo">Correo electr&oacute;nico</label>
              <input value="<?php echo $participante['email']; ?>" type="email" class="form-control" name="correo" id="correo" data-error="Correo no v&aacute;lido" required>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label for="escuela">Escuela</label>
              <input value="<?php echo $participante['escuela']; ?>" type="text" class="form-control" name="escuela" id="escuela" data-error="Ingresa el nombre de tu escuela" required>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label for="carrera">Carrera</label>
              <input value="<?php echo $participante['carrera']; ?>" type="text" class="form-control" name="carrera" id="carrera" data-error="Ingresa el nombre de tu carrera" required>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label for="semestre">Semestre</label>
              <select id="semestre" name="semestre" class="form-control">
                <option value="1"<?php if ($participante['semestre'] == 1) echo "selected"; ?>>1</option>
                <option value="2"<?php if ($participante['semestre'] == 2) echo "selected"; ?>>2</option>
                <option value="3"<?php if ($participante['semestre'] == 3) echo "selected"; ?>>3</option>
                <option value="4"<?php if ($participante['semestre'] == 4) echo "selected"; ?>>4</option>
                <option value="5"<?php if ($participante['semestre'] == 5) echo "selected"; ?>>5</option>
                <option value="6"<?php if ($participante['semestre'] == 6) echo "selected"; ?>>6</option>
                <option value="7"<?php if ($participante['semestre'] == 7) echo "selected"; ?>>7</option>
                <option value="8"<?php if ($participante['semestre'] == 8) echo "selected"; ?>>8</option>
                <option value="9"<?php if ($participante['semestre'] == 9) echo "selected"; ?>>9</option>
                <option value="10"<?php if ($participante['semestre'] == 10) echo "selected"; ?>>10</option>
                <option value="Egresado" <?php if ($participante['semestre'] == "Egresado") echo "selected"; ?>>Egresado</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-sm-offset-4">
            <a href="seleccionLogin.php" class="btn btn-default">Regresar</a>
            <button type="submit" name="submit" id="submit" class="btn btn-primary pull-right">Guardar</button>
          </div>
        </div>
      </form>
    </div>
    <script type="text/javascript">
      $('.input-group.date').datepicker({
        format: "yyyy-mm-dd",
        startView: 2,
        autoclose: true
      });
    </script>
  </body>
</html>
