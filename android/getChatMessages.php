<?php
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$userId = $func->validateFormInput($_POST['user_id']);
	$respId = $func->validateFormInput($_POST['respondent']);

	echo $func->getUserChatMessages($userId,$respId);
?>