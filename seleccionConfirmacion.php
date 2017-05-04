<?php
include_once "config.php";

session_start();

if ( isset( $_SESSION['folio'] ) ) {
  $stmt = $pdo->prepare("SELECT `participante`.*, `qep`.`nombre` AS `qep_nombre`, `taller`.`nombre` AS `taller_nombre`, `taller`.`descripcion`, `taller`.`duracion` AS `taller_duracion`, `visita`.`empresa`, `hora_inicio`, `visita`.`duracion` AS `empresa_duracion` FROM `participante` INNER JOIN `visita` ON `participante`.`visita_id`=`visita`.`id` INNER JOIN `taller` ON `participante`.`taller_id`=`taller`.`id` INNER JOIN `qep` ON `participante`.`qep_id`=`qep`.`id` WHERE `folio_id`=:folio");
  $stmt->execute(array(":folio"=>$_SESSION['folio']));
  $participante = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
  header("Location: index.php");
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
    <div class="container panel">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3 page-header">
          <h1 class="text-center">Congreso de ingenier&iacute;a e innovaci&oacute;n</h1>
          <h4 class="text-center">Selecci&oacute;n de actividades</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
          <h3 class="text-center">Hoja de registro</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <h4>Datos personales</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <div class="table-responsive">
            <table cellspacing="0" class="table">
              <thead>
                <tr>
                  <th>Folio</th>
                  <th>Nombre</th>
                  <th>Fecha de nacimiento</th>
                  <th>Email</th>
                  <th>Celular</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $participante['folio_id']; ?></td>
                  <td><?php echo "{$participante['nombre']} {$participante['ap_paterno']} {$participante['ap_materno']}"; ?></td>
                  <td><?php echo $participante['nacimiento']; ?></td>
                  <td><?php echo $participante['email']; ?></td>
                  <td><?php echo $participante['celular']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <h4>Escuela de procedencia</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <div class="table-responsive">
            <table cellspacing="0" class="table">
              <thead>
                <tr>
                  <th>Escuela</th>
                  <th>Carrera</th>
                  <th>Semestre</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $participante['escuela']; ?></td>
                  <td><?php echo $participante['carrera']; ?></td>
                  <td><?php echo $participante['semestre']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <h4>Mi&eacute;rcoles - ¿Qu&eacute; est&aacute; pasando?</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <div class="table-responsive">
            <table cellspacing="0" class="table">
              <thead>
                <tr>
                  <th>Empresa</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $participante['qep_nombre'] == ""? "No Participa": $participante['qep_nombre']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <h4>Jueves - Taller</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <div class="table-responsive">
            <table cellspacing="0" class="table">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Descripci&oacute;n</th>
                  <th>Duraci&oacute;n</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $participante['taller_nombre']; ?></td>
                  <td><?php echo $participante['descripcion']; ?></td>
                  <td><?php echo $participante['taller_duracion']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <h4>Viernes - Visita/Concurso</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <div class="table-responsive">
            <table cellspacing="0" class="table">
              <thead>
                <tr>
                  <th>Empresa</th>
                  <th>Hora de inicio</th>
                  <th>Duraci&oacute;n</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $participante['empresa']; ?></td>
                  <td><?php echo $participante['hora_inicio']; ?></td>
                  <td><?php echo $participante['empresa_duracion']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <button id="print" class="btn btn-success hidden-print"> <span class="glyphicon glyphicon-print"></span> Imprimir </button>
          <a href="registrado.php" class="btn btn-primary pull-right hidden-print">Aceptar</a>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#print").on('click', function() {
          window.print();
        });
      });
    </script>
  </body>
</html>
