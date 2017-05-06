<?php
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$userId = $func->validateFormInput($_POST['user_id']);
	$mentorId = $func->validateFormInput($_POST['mentor_id']);

	echo $func->removeMentor($userId,$mentorId);
?>