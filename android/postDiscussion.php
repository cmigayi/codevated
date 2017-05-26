<?php
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$userId = $func->validateFormInput($_POST['user_id']);
	$topic = $func->validateFormInput($_POST['topic']);

	echo $func->postDiscussion($userId,$topic);
?>
