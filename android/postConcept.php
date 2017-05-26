<?php	
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$userId = $func->validateFormInput($_POST['user_id']);
	$title = $func->validateFormInput($_POST['title']);
	$content = $func->validateFormInput($_POST['content']);
	$cart = $func->validateFormInput($_POST['interest_id']);

	echo $func->postConcept($userId,$title,$content,$cart);
?>