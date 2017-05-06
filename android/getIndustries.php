<?php
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$userId = $func->validateFormInput($_POST['user_id']);

	$content["signupContent"] = array();
	$data = array();

	if(!empty($userId)){
		//Allowed to proceed
		$sql="SELECT * FROM industry";
		$query=mysql_query($sql)or die(mysql_error());

		while($row=mysql_fetch_array($query)){		

			$data['industry_id'] = $row['industry_id'];
			$data['industry_name'] = $row['industry_name'];

			array_push($content["signupContent"],$data);
		}

	}else{
		//should return to signup first page
		$data = "fail";
		array_push($content["signupContent"],$data);
	}

	echo json_encode($content)
?>