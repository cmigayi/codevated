<?php
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$userId = $func->validateFormInput($_POST['user_id']);
	$username = $func->validateFormInput($_POST['username']);

	echo $func->searchUsername($username);
?>