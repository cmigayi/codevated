<?php
    require_once("classes/function_class.php");	
	session_start();
	
	if(isset($_SESSION['user_id'])){
		$user = $_SESSION['user_id'];
	}else{
		header("Location: index.php");
	}
	$func = new FunctionClass();

    $circleID = 1;
echo "ye";

//    if($func->addUserToCircle($user,$circleID) == true){
//        echo "done";
//    }else{
//        echo "failed";
//    }
?>