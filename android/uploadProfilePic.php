<?php
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$userId = $func->validateFormInput($_POST['user_id']);
	$image = $func->validateFormInput($_POST['pic']);

	echo $func->uploadUserProfilePic($userId,$image);	
?>