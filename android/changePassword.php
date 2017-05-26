<?php
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$userId = $func->validateFormInput($_POST['user_id']);
	$pass = $func->validateFormInput($_POST['pass']);

	echo $func->changeUserPassword($userId,$pass);
?>