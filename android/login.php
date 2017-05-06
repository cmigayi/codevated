<?php
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$emailOrUsername = $func->validateFormInput($_POST['emailOrUsername']);
	$pass = $func->validateFormInput($_POST['pass']);	
	
	$userID = $func->checkIfUserIsRegistered($emailOrUsername,$pass);

	$content["userContent"] = array();
	$data = array();

	if($userID == false){

		$data["status"] = "failed";

		array_push($content["userContent"],$data);
	}else{
		session_start();
		$data['session_id'] = session_id();		
		$data['status'] = "success";
		$row = $func->getUserSignUpInfo($userID);		
		
		$data['user_id'] = $row['user_id'];
		$data['username'] = $row['username'];
		$data['email'] = $row['email'];
		$data['pass'] = $row['password'];
		$data['phone'] = $row['phone'];
		$data['gender'] = $row['gender'];
		$data['codevatedTeam'] = $row['codevatedTeam'];
		$data['dateTime'] = $row['dateTime'];
		$data['industry'] = $func->getAllIndustries();
		$data['speciality'] = $func->getAllSpecialities();

		array_push($content["userContent"],$data);	
	}

	echo json_encode($content);	
?>