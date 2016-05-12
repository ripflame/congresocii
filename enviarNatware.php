<?php
include_once "config.php";

session_start();
$folio['id']= $_SESSION['folio'];

if ( $_SESSION['folio'] !="" ) {
  $participante = $db->participante->where("participante.folio_id LIKE ?", $_SESSION['folio'])->fetch();
} else {
  header("Location: index.php");
}
if ($participante['sexo']==1){
	$sexotf= "true";
} else {
	$sexotf= "false";
}
$fecha= str_replace("-","",$participante['nacimiento']);

$link= "http://modelo.natware.mx/social/Auth/CongresoModeloAuth.aspx?QS_Usuario=".$participante->folio['id']."&QS_Clave=".$participante->folio['clave']."&QS_Nombre=".$participante['nombre']."&QS_PrimerApellido=".$participante['ap_paterno']."&QS_SegundoApellido=".$participante['ap_materno']."&QS_FechaNacimiento=".$fecha."&QS_Sexo=".$sexotf."&QS_Email=".$participante['email']; 

$folio = $db->folio->where("id LIKE ?", $_SESSION['folio']);
        $data  = array(
          "natware" => '1'
		  );
$success = $folio->update($data);

//echo $link;

header('Location: ' . $link);

?>