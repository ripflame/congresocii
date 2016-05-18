<?php
 include_once "config.php";

  session_start();
  if (!isset($_SESSION['folio'])) {
    header("Location: index.php");
    exit();
  } else {
    $participante = $db->participante->where("participante.folio_id LIKE ?", $_SESSION['folio'])->fetch();
    $talleres = $db->taller();
    $visitas = $db->visita();

    if (isset($_POST['submit'])) {
      extract($_POST, EXTR_PREFIX_ALL, "form");
      $part = $db->participante->where("participante.folio_id LIKE ?", $_SESSION['folio'])->fetch();

      if ($part->taller['id'] == $form_taller && $part->visita['id'] == $form_visita) {
        header("Location: edicionConfirmacionTalleres.php");
        exit();
      } else {
        $taller = $db->taller->where("id LIKE ?", $form_taller)->fetch();
        $taller_data = array(
          "inscritos" => $taller['inscritos'] + 1
        );
        $taller->update($taller_data);

        $taller_viejo = $db->taller->where("id LIKE ?", $part->taller["id"])->fetch();
        $taller_data = array(
          "inscritos" => $taller_viejo['inscritos'] - 1
        );
        $taller_viejo->update($taller_data);

        $visita = $db->visita->where("id LIKE ?", $form_visita)->fetch();
        $visita_data = array(
          "inscritos" => $visita['inscritos'] + 1
        );
        $visita->update($visita_data);

        $visita_viejo = $db->visita->where("id LIKE ?", $part->visita["id"])->fetch();
        $visita_data = array(
          "inscritos" => $visita_viejo['inscritos'] - 1
        );
        $visita_viejo->update($visita_data);

        $data = array(
          "taller_id" => $form_taller,
          "visita_id" => $form_visita
        );
        $result = $part->update($data);

        if ($result) {
          header("Location: edicionConfirmacionTalleres.php");
          exit();
        }
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
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-sm-offset-4">
            <div class="form-group">
              <label for="taller">Taller</label>
              <select class="form-control" name="taller" id="taller">
                <?php foreach ($talleres as $taller): ?>
                <option value="<?php echo $taller['id']; ?>" <?php if ($participante->taller['id'] == $taller['id']) echo "selected"?>><?php echo $taller['nombre']; ?>  [<?php echo "{$taller['inscritos']} / {$taller['cupo_disponible']}"; ?>]</option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-sm-offset-4">
            <div class="form-group">
              <label for="ac_viernes">Actividad</label>
              <select class="form-control" name="visita" id="visita">
                <option value="100" <?php if (100 == $participante->visita['id']) echo "selected"; ?>>Concurso - Participante</option>
                <option value="101" <?php if (101 == $participante->visita['id']) echo "selected"; ?>>Concurso - Espectador</option>
                <?php foreach ($visitas as $visita): ?>
                <?php  if ($visita['id'] != 100 && $visita['id'] != 101): ?>
                <option value="<?php echo $visita['id']; ?>" <?php if ($participante->visita['id'] == $visita['id']) echo "selected"; ?>>Visita - <?php echo $visita['empresa']; ?> [<?php echo "{$visita['inscritos']} / {$visita['cupo_disponible']}"; ?>]</option>
                <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-sm-offset-4">
            <a href="edicionLoginTalleres.php" class="btn btn-default">Regresar</a>
            <button type="submit" name="submit" id="submit" class="btn btn-primary pull-right">Guardar</button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
