<?php
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$userId = $func->validateFormInput($_POST['user_id']);
	$interestId = $func->validateFormInput($_POST['interest_id']);

	$content["userInterest"] = array();
	$data = array();

	if($func->addUserInterest($userId,$interestId) == true){
		$data['state'] = 1;
	}else{
		$data['state'] = 0;
	}
	array_push($content["userInterest"] , $data);

	echo json_encode($content);
?>