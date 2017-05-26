<?php
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$userId = $func->validateFormInput($_POST['user_id']);
	$notificationId = $func->validateFormInput($_POST['notification_id']);

	echo $func->markNotificationAsRead($notificationId);
?>