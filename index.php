<?php 
	require_once("config.php");

	use usuario\Usuario;

	// $result = Usuario::getList();

	// echo json_encode($result);

	$user = new Usuario;
	$user->loadById(1);
	$user->update("marlingx", "6562354");

	echo $user;
 ?>