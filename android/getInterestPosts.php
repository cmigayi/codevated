<?php
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$userId = $func->validateFormInput($_POST['user_id']);
	$interestId = $func->validateFormInput($_POST['interest_id']);

	echo $func->getInterestPosts($userId,$interestId);
?>