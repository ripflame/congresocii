<?php
  include_once "config.php";

  $talleres = $db->taller();
  $visitas = $db->visita();

  if (isset($_POST['submit'])){
    session_start();
    extract($_POST, EXTR_PREFIX_ALL, "form");
    $participante = $db->participante();
    $data = array(
      "nombre" => $form_nombre,
      "ap_paterno" => $form_ap_paterno,
      "ap_materno" => $form_ap_materno,
      "nacimiento" => $form_nacimiento,
      "sexo" => $form_sexo,
      "email" => $form_correo,
      "escuela" => $form_escuela,
      "carrera" => $form_carrera,
      "semestre" => $form_semestre,
      "folio_id" => 1,
      "taller_id" => $form_taller,
      "visita_id" => $form_ac_viernes
    );
    $result = $participante->insert($data);
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
    <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3 page-header">
          <h1 class="text-center">Congreso de ingenier&iacute;a e innovaci&oacute;n</h1>
          <h4 class="text-center">Selecci&oacute;n de actividades</h4>
        </div>
      </div>
      <form action="" method="post" class="panel">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <h3 class="text-center">Llena esta secci&oacute;n con tus datos personales</h3>
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input value="" type="text" id="nombre" name="nombre" class="form-control">
            </div>
            <div class="form-group">
              <label for="ap_paterno">Apellido paterno</label>
              <input value="" type="text" id="ap_paterno" name="ap_paterno" class="form-control">
            </div>
            <div class="form-group">
              <label for="ap_materno">Apellido materno</label>
              <input value="" type="text" class="form-control" name="ap_materno" id="ap_materno">
            </div>
            <div class="form-group">
              <label for="nacimiento">Fecha de nacimiento</label>
              <div class="input-group date">
                <input type="text" class="form-control" name="nacimiento" readonly><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
              </div>
            </div>
            <div class="form-group">
              <label for="sexo">Sexo</label>
              <label class="radio-inline"> <input type="radio" name="sexo" value="1" checked> Hombre </label>
              <label class="radio-inline"> <input type="radio" name="sexo" value="2"> Mujer </label>
            </div>
            <div class="form-group">
              <label for="correo">Correo electr&oacute;nico</label>
              <input value="" type="email" class="form-control" name="correo" id="correo">
            </div>
            <div class="form-group">
              <label for="escuela">Escuela</label>
              <input value="" type="text" class="form-control" name="escuela" id="escuela">
            </div>
            <div class="form-group">
              <label for="carrera">Carrera</label>
              <input value="" type="text" class="form-control" name="carrera" id="carrera">
            </div>
            <div class="form-group">
              <label for="semestre">Semestre</label>
              <select id="semestre" name="semestre" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="Egresado">Egresado</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <h3 class="text-center">Selecciona tus actividades</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-md-offset-2">
            <h4 class="text-center">D&iacute;a Jueves</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div class="form-group">
              <label for="taller">Taller</label>
              <select class="form-control" name="taller" id="taller">
                <?php foreach ($talleres as $taller): ?>
                <option value="<?php echo $taller['id']; ?>"><?php echo $taller['nombre']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-md-offset-2">
            <h4 class="text-center">D&iacute;a Viernes</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div class="form-group">
              <label for="ac_viernes">Actividad</label>
              <select class="form-control" name="ac_viernes" id="ac_viernes">
                <!-- <option value="1">Visita</option> -->
                <?php foreach ($visitas as $visita): ?>
                <option value="<?php echo $visita['id']; ?>">Visita - <?php echo $visita['empresa']; ?></option>
                <?php endforeach; ?>
                <option value="100">Concurso - Participante</option>
                <option value="101">Concurso - Expectador</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <a href="seleccionLogin.php" class="btn btn-default">Regresar</a>
            <button type="submit" name="submit" class="btn btn-primary pull-right">Entrar</button>
          </div>
        </div>
      </form>
    </div>
    <script type="text/javascript">
      $('.input-group.date').datepicker({
        format: "yyyy/mm/dd",
        startView: 2,
        autoclose: true
      });
    </script>
  </body>
</html>
