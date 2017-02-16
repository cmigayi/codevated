<?php
	require_once("classes/function_class.php");
	session_start();
	$func = new FunctionClass();
	
	if(isset($_SESSION['user_id'])){
		$user = $_SESSION['user_id'];
		$func->removeUserOnline($user);
		$func->userLogout();
	}else{
		header("Location: index.php");
	}	
?>
