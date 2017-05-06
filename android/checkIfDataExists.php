<?php
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$result = "failed";

	$fieldType = $func->validateFormInput($_POST['fieldType']);

	switch($fieldType){
		case "username":
			$username = $func->validateFormInput($_POST['username']);
			$result =  $func->checkIfUsernameExists($username);
		break;
		case "email":
			$email = $func->validateFormInput($_POST['email']);
			$result =  $func->checkIfEmailExists($email);
		break;
	}

	echo $result;
?>