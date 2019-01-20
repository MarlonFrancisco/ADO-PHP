<?php 
	require_once("config.php");

	use usuario\Usuario;

	// $result = Usuario::getList();

	// echo json_encode($result);

	$user = new Usuario;
	$user->logar("user", "123456");

	echo $user;
 ?>