<?php
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$username = $func->validateFormInput($_POST['username']);
	$email = $func->validateFormInput($_POST['email']);	
	$gender = $func->validateFormInput($_POST['gender']);	
	$pass = $func->validateFormInput($_POST['pass']);
	//$gender=$_POST['gender'];

	$content["userContent"] = array();
	$data = array();
	
	if($func->signUpUser($username,$email,$pass,$gender) == true){
		$userID = $func->checkIfUserIsRegistered($username,$pass);
		$row = $func->getUserSignUpInfo($userID);
		$data['status'] = "success";
		$data['user_id'] = $row['user_id'];
		$data['username'] = $row['username'];
		$data['email'] = $row['email'];
		$data['pass'] = md5($row['password']);
		$data['phone'] = $row['phone'];
		$data['gender'] = $row['gender'];
		$data['codevatedTeam'] = $row['codevatedTeam'];
		$data['dateTime'] = $row['dateTime'];
		$data['industry'] = $func->getAllIndustries();
		$data['speciality'] = $func->getAllSpecialities();

		array_push($content["userContent"],$data);		

	}else{
		$data["status"] = "failed";

		array_push($content["userContent"],$data);
	}

	echo json_encode($content);	
	
?>
