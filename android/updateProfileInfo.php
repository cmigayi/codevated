<?php
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$userId = $func->validateFormInput($_POST['user_id']);
	$email = $func->validateFormInput($_POST['email']);
	$bio = $func->validateFormInput($_POST['bio']);
	$location = $func->validateFormInput($_POST['location']);

	echo $func->updateProfileInfo($userId,$email,$bio,$location);	
?>