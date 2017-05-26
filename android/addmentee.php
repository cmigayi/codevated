<?php
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$userId = $func->validateFormInput($_POST['user_id']);
	$menteeId = $func->validateFormInput($_POST['mentee_id']);

	echo $func->addMentee($userId,$menteeId);
?>