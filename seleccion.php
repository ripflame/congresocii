<?php
function search_table($array, $column, $id) {
  foreach ($array as $row) {
    if ($row['id'] == $id) {
      return $row[$column];
    }
  }
}

  include_once "config.php";

  session_start();
  if (!isset($_SESSION['folio'])) {
    header("Location: index.php");
  }

  $error_overflow_taller = false;
  $error_overflow_visita = false;
  $error_overflow_qep    = false;

  $taller_stmt = $pdo->prepare("SELECT * FROM `taller`");
  $taller_stmt->execute();
  $talleres = $taller_stmt->fetchAll(PDO::FETCH_ASSOC);

  $visita_stmt = $pdo->prepare("SELECT * FROM `visita`");
  $visita_stmt->execute();
  $visitas = $visita_stmt->fetchAll(PDO::FETCH_ASSOC);

  $qep_stmt = $pdo->prepare("SELECT * FROM `qep`");
  $qep_stmt->execute();
  $empresas = $qep_stmt->fetchAll(PDO::FETCH_ASSOC);

  if (isset($_POST['submit'])){
    extract($_POST, EXTR_PREFIX_ALL, "form");
    $taller_stmt = $pdo->prepare("SELECT * FROM `taller`");
    $taller_stmt->execute();
    $talleres = $taller_stmt->fetchAll(PDO::FETCH_ASSOC);

    $visita_stmt = $pdo->prepare("SELECT * FROM `visita`");
    $visita_stmt->execute();
    $visitas = $visita_stmt->fetchAll(PDO::FETCH_ASSOC);

    $qep_stmt = $pdo->prepare("SELECT * FROM `qep`");
    $qep_stmt->execute();
    $empresas = $qep_stmt->fetchAll(PDO::FETCH_ASSOC);

    $talleres_available = search_table($talleres, 'cupo_disponible', $form_taller) - search_table($talleres, 'inscritos', $form_taller) > 0;
    $visitas_available  = search_table($visitas, 'cupo_disponible', $form_ac_viernes) - search_table($visitas, 'inscritos', $form_ac_viernes) > 0;
    $empresas_available = search_table($empresas, 'cupo_disponible', $form_qep) - search_table($empresas, 'inscritos', $form_qep) > 0;

    if ($talleres_available && $visitas_available && $empresas_available) {
      $stmt = $pdo->prepare("UPDATE `taller` SET `inscritos`=:inscritos WHERE `id`=:id");
      $stmt->execute(array(":inscritos"=>search_table($talleres, 'inscritos', $form_taller) + 1, ":id"=>search_table($talleres, 'id', $form_taller)));

      $stmt = $pdo->prepare("UPDATE `visita` SET `inscritos`=:inscritos WHERE `id`=:id");
      $stmt->execute(array(":inscritos"=>search_table($visitas, 'inscritos', $form_visita) + 1, ":id"=>search_table($visitas, 'id', $form_visita)));

      $stmt = $pdo->prepare("UPDATE `qep` SET `inscritos`=:inscritos WHERE `id`=:id");
      $stmt->execute(array(":inscritos"=>search_table($empresas, 'inscritos', $form_qep) + 1, ":id"=>search_table($empresas, 'id', $form_qep)));

      $stmt = $pdo->prepare("INSERT INTO `participante`(`nombre`, `ap_paterno`, `ap_materno`, `nacimiento`, `sexo`, `email`, `escuela`, `carrera`, `semestre`, `folio_id`, `taller_id`, `visita_id`, `qep_id`, `celular`) VALUES(:nombre, :ap_paterno, :ap_materno, :nacimiento, :sexo, :email, :escuela, :carrera, :semestre, :folio_id, :taller_id, :visita_id, :qep_id, :celular)");
      $data = array(
        ":nombre"     => $form_nombre,
        ":ap_paterno" => $form_ap_paterno,
        ":ap_materno" => $form_ap_materno,
        ":nacimiento" => $form_nacimiento,
        ":sexo"       => $form_sexo,
        ":email"      => $form_correo,
        ":escuela"    => $form_escuela,
        ":carrera"    => $form_carrera,
        ":semestre"   => $form_semestre,
        ":folio_id"   => $_SESSION['folio'],
        ":taller_id"  => $form_taller,
        ":visita_id"  => $form_ac_viernes,
        ":qep_id" => $form_qep,
        ":celular" => $form_celular
      );
      $result = $stmt->execute($data);

      if ($result) {
        $stmt = $pdo->prepare("UPDATE `folio` SET `registrado`=:registrado WHERE `id`=:id");
        $data = array(":registrado" => 1, ":id" => $_SESSION['folio']);
        $success = $stmt->execute($data);

        if ($success) {
          header( "Location: seleccionConfirmacion.php" );
        }
      }
    } else if(!$talleres_available) {
      $error_overflow_taller = true;
    } else if (!$visitas_available) {
      $error_overflow_visita = true;
    } else if (!$empresas_available) {
      $error_overflow_qep = true;
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
          <h4 class="text-center">Selecci&oacute;n de actividades</h4>
        </div>
      </div>
      <form action="" method="post" class="panel" id="registerForm" data-toggle="validator">
        <div class="row">
          <div class="col-sm-4 col-sm-offset-4">
            <h3 class="text-center">Llena esta secci&oacute;n con tus datos personales</h3>
            <?php if ($error_overflow_taller) : ?>
            <h3 class="text-center text-danger">Ya no hay cupo para el taller que elegiste</h3>
            <?php endif; ?>
            <?php if ($error_overflow_visita) : ?>
            <h3 class="text-center text-danger">Ya no hay cupo para la actividad del viernes que elegiste</h3>
            <?php endif; ?>
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input value="<?php echo $form_nombre; ?>" type="text" id="nombre" name="nombre" class="form-control" data-error="Ingresa tu nombre" required>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label for="ap_paterno">Apellido paterno</label>
              <input value="<?php echo $form_ap_paterno; ?>" type="text" id="ap_paterno" name="ap_paterno" class="form-control" data-error="Ingresa tu apellido paterno" required>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label for="ap_materno">Apellido materno</label>
              <input value="<?php echo $form_ap_materno; ?>" type="text" class="form-control" name="ap_materno" id="ap_materno" data-error="Ingresa tu apellido materno" required>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label for="nacimiento">Fecha de nacimiento</label>
              <div class="input-group date">
                <input value="<?php echo $form_nacimiento; ?>" type="text" class="form-control" name="nacimiento" pattern="^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$" maxlength="10" data-error="Selecciona tu fecha de nacimiento" required><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
              </div>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label for="sexo">Sexo</label>
              <label class="radio-inline"> <input type="radio" name="sexo" value="1" <?php if ($form_sexo != 2) echo "checked"; ?>> Hombre </label>
              <label class="radio-inline"> <input type="radio" name="sexo" value="2" <?php if ($form_sexo == 2) echo "checked"; ?>> Mujer </label>
            </div>
            <div class="form-group">
              <label for="correo">Correo electr&oacute;nico</label>
              <input value="<?php echo $form_correo; ?>" type="email" class="form-control" name="correo" id="correo" data-error="Correo no v&aacute;lido" required>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label for="celular">N&uacute;mero de celular</label>
              <input value="<?php echo $form_celular; ?>" type="number" class="form-control" name="celular" id="celular" data-error="Celular no v&aacute;lido" required>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label for="escuela">Escuela</label>
              <input value="<?php echo $form_escuela; ?>" type="text" class="form-control" name="escuela" id="escuela" data-error="Ingresa el nombre de tu escuela" required>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label for="carrera">Carrera</label>
              <input value="<?php echo $form_carrera; ?>" type="text" class="form-control" name="carrera" id="carrera" data-error="Ingresa el nombre de tu carrera" required>
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              <label for="semestre">Semestre</label>
              <select id="semestre" name="semestre" class="form-control">
                <option value="1"<?php if ($form_semestre == 1) echo "selected"; ?>>1</option>
                <option value="2"<?php if ($form_semestre == 2) echo "selected"; ?>>2</option>
                <option value="3"<?php if ($form_semestre == 3) echo "selected"; ?>>3</option>
                <option value="4"<?php if ($form_semestre == 4) echo "selected"; ?>>4</option>
                <option value="5"<?php if ($form_semestre == 5) echo "selected"; ?>>5</option>
                <option value="6"<?php if ($form_semestre == 6) echo "selected"; ?>>6</option>
                <option value="7"<?php if ($form_semestre == 7) echo "selected"; ?>>7</option>
                <option value="8"<?php if ($form_semestre == 8) echo "selected"; ?>>8</option>
                <option value="9"<?php if ($form_semestre == 9) echo "selected"; ?>>9</option>
                <option value="10"<?php if ($form_semestre == 10) echo "selected"; ?>>10</option>
                <option value="Egresado" <?php if ($form_semestre == "Egresado") echo "selected"; ?>>Egresado</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-sm-offset-4">
            <h3 class="text-center">Selecciona tus actividades</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2 col-sm-offset-3">
            <h4 class="text-left">D&iacute;a Mi&eacute;rcoles</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-sm-offset-4">
            <div class="form-group">
              <h4>¿Qu&eacute; est&aacute; pasando?</h4>
            </div>
            <div class="form-group">
              <label for="qep">Empresa invitada</label>
              <select id="qep" class="form-control" name="qep">
                <?php foreach ( $empresas as $empresa ) : ?>
                <?php if ($empresa['cupo_disponible'] - $empresa['inscritos'] > 0) : ?>
                <option value="<?php echo $empresa['id']; ?>" <?php if ($form_empresa == $empresa['id']) echo "selected"; ?>><?php echo $empresa['nombre']; ?> [<?php echo $empresa['cupo_disponible'] - $empresa['inscritos']; ?>]</option>
                <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2 col-sm-offset-3">
            <h4 class="text-left">D&iacute;a Jueves</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-sm-offset-4">
            <div class="form-group">
              <label for="taller">Taller</label>
              <select class="form-control" name="taller" id="taller">
                <?php foreach ($talleres as $taller): ?>
                <?php if ($taller['cupo_disponible'] - $taller['inscritos'] != 0):?>
                <option value="<?php echo $taller['id']; ?>" <?php if ($form_taller == $taller['id']) echo "selected"?>><?php echo $taller['nombre']; ?>  [<?php echo $taller['cupo_disponible'] - $taller['inscritos']; ?>]</option>
                <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2 col-sm-offset-3">
            <h4 class="text-left">D&iacute;a Viernes</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-sm-offset-4">
            <div class="form-group">
              <label for="ac_viernes">Actividad</label>
              <select class="form-control" name="ac_viernes" id="ac_viernes">
                <option value="100" <?php if (100 == $form_ac_viernes) echo "selected"; ?>>Concurso - Participante</option>
                <option value="101" <?php if (101 == $form_ac_viernes) echo "selected"; ?>>Concurso - Espectador</option>
                <?php foreach ($visitas as $visita): ?>
                <?php  if ($visita['id'] != 100 && $visita['id'] != 101 && $visita['cupo_disponible'] - $visita['inscritos'] != 0): ?>
                <option value="<?php echo $visita['id']; ?>" <?php if ($form_ac_viernes == $visita['id']) echo "selected"; ?>>Visita - <?php echo $visita['empresa']; ?> [<?php echo $visita['cupo_disponible'] - $visita['inscritos']; ?>]</option>
                <?php endif; ?>
                <?php endforeach; ?>
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
      $(document).ready(function() {
        if( $("#ac_viernes").val() == 100){
          $("#submit").on('click', function(e) {
            window.open("http://bit.ly/ARobo16", "_blank");
          });
        } else {
          $("#submit").unbind('click');
        }
        $('#ac_viernes').on('change', function() {
          if( $("#ac_viernes").val() == 100){
            $("#submit").on('click', function(e) {
              window.open("http://bit.ly/ARobo16", "_blank");
            });
          } else {
            $("#submit").unbind('click');
          }
        });
      });
      $('.input-group.date').datepicker({
        format: "yyyy-mm-dd",
        startView: 2,
        autoclose: true
      });
    </script>
  </body>
</html>
