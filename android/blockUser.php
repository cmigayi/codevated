<?php
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$userId = $func->validateFormInput($_POST['user_id']);
	$blockeduserId = $func->validateFormInput($_POST['blocked_user']);

	echo $func->blockUser($userId,$blockeduserId);
?>