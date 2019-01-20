<?php 
	require_once("config.php");

	$ado = new Ado;

	$results = $ado->select("SELECT * FROM TB_USUARIO");

	echo json_encode($results);
 ?>