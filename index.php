<?php 
	require_once("config.php");

	use usuario\Usuario;

	// $result = Usuario::getList();

	// echo json_encode($result);

	$user = new Usuario;
	$user->loadById(3);
	$user->delete();

	echo $user;
 ?>