<?php
  include_once "config.php";

  function is_valid_folio ( $folio, $clave ) {
    global $db;

    $folio = $db->real_escape_string($folio);
    $clave = $db->real_escape_string($clave);

    $query = "SELECT * FROM `folio` WHERE `id`='$folio' AND `clave`='$clave' AND `registrado`='0'";
    $result = $db->query( $query );

    if ( $result->num_rows == 1 ) {
      return true;
    } else {
      return false;
    }
  }

  function get_talleres() {
    global $db;

    $query = "SELECT * FROM `taller`";
    $result = $db->query( $query );

    $talleres = array();

    while ($row = $result->fetch_assoc()) {
      $talleres[] = $row;
    }

    return $talleres;
  }

  function get_visitas() {
    global $db;

    $query = "SELECT * FROM `visita`";
    $result = $db->query( $query );

    $visitas = array();

    while($row = $result->fetch_assoc()) {
      $visitas[] = $row;
    }

    return $visitas;
  }
?>
