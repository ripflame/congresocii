<?php
include_once "config.php";

 $sql = $pdo->prepare('SELECT * FROM taller');
    $sql->execute();
    $resultado = $sql->fetchAll();

	$sql2 = $pdo->prepare('SELECT * FROM visita');
    $sql2->execute();
    $resultado2 = $sql2->fetchAll();

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
          <h4 class="text-center">Talleres</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <div class="table-responsive">
            <table cellspacing="0" class="table">
              <thead>
                <tr>
                  <th>Taller</th>
                  <th>Tallerista</th>
                  <th>Ocupados</th>
                  <th>Cupo</th>
                </tr>
              </thead>
              <tbody>
                <?php  foreach ($resultado as $row) { ?>
                <tr>
                  <td><?php echo $row['nombre']; ?></td>
                  <td><?php echo $row['tallerista']; ?></td>
                  <td><?php echo $row['inscritos']; ?></td>
                  <td><?php echo $row['cupo_disponible']; ?></td>
                </tr>
                <?php 	} ?>
              </tbody>
            </table>
          </div>
        </div>
	<div class="row">
        <div class="col-sm-6 col-sm-offset-3 page-header">
          <h4 class="text-center">Visitas y Concurso</h4>
        </div>
      </div>
        <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <div class="table-responsive">
            <table cellspacing="0" class="table">
              <thead>
                <tr>
                  <th>Empresa</th>
                  <th>Hora de Inicio</th>
                  <th>Ocupados</th>
                  <th>Cupo</th>
                </tr>
              </thead>
              <tbody>
                <?php  foreach ($resultado2 as $row2) { ?>
                <tr>
                  <td><?php echo $row2['empresa']; ?></td>
                  <td><?php echo $row2['hora_inicio']; ?></td>
                  <td><?php echo $row2['inscritos']; ?></td>
                  <td><?php echo $row2['cupo_disponible']; ?></td>
                </tr>
                <?php 	} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </body>
</html>
