<?php 
	require_once("config.php");

	use usuario\Usuario;

	// $result = Usuario::getList();

	// echo json_encode($result);

	$user = new Usuario;
	$user->setDesUsuario("marlinho");
	$user->setSenhaUsuario("5346");
	$user->insert();

	echo $user;
 ?>