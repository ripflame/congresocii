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
    
  }
?>
