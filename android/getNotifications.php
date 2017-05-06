<?php
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$userId = $func->validateFormInput($_POST['user_id']);
	$data = $func->validateFormInput($_POST['data']);

	if($data == "all"){

		echo $func->getAllNotification($userId);

	}else{
		echo $func->getTotalUnreadNotifications($userId);
	}
?>