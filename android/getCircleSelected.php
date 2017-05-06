<?php
	
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$userId = $func->validateFormInput($_POST['user_id']);
	$circleId = $func->validateFormInput($_POST['circle_id']);

	echo $func->getCircleUsersConcepts(1);
?>