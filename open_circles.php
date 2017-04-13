<?php
    require_once("classes/function_class.php");	
    session_start();
	$func = new FunctionClass();
    if(isset($_SESSION['user_id'])){
		$user = $_SESSION['user_id'];
	}else{
		header("Location: index.php");
	}

    $func->getOpenCircles();
?>