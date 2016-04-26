<!DOCTYPE html>
<html>
  <head>
    <title>Congreso de Ingenier&iacute;a e innovaci&oacute;n</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
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
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <h3 class="text-center">Escribe el folio y clave ubicados en tu boleto</h3>
          <form action="seleccion.php" method="post">
            <div class="form-group">
              <label for="folio">Folio</label>
              <input value="" type="text" id="folio" name="folio" class="form-control">
            </div>
            <div class="form-group">
              <label for="clave">Clave</label>
              <input value="" type="password" id="clave" name="clave" class="form-control">
            </div>
            <a href="index.php" class="btn btn-default">Regresar</a>
            <button type="submit" class="btn btn-primary pull-right">Entrar</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
