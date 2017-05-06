<?php
	require_once("../classes/function_class.php");	
	$func = new FunctionClass();

	$userId = $func->validateFormInput($_POST['user_id']);
	$industryId = $func->validateFormInput($_POST['industry_id']);

	$content["signupContent"] = array();
	$data = array();

	if(!empty($userId) && !empty($industryId)){
		//Allowed to proceed
		$sql="SELECT * FROM speciality WHERE industry_id='$industryId'";	
		$query=mysql_query($sql)or die(mysql_error());

		if(mysql_num_rows($query) == 0){
			//if no speciality at all
			$data['status'] = "none";
			array_push($content["signupContent"],$data);
		}else{

			while($row=mysql_fetch_array($query)){		

				$data['speciality_id'] = $row['speciality_id'];
				$data['speciality_name'] = $row['speciality_name'];

				array_push($content["signupContent"],$data);
			}
		}

	}else{
		//should return to signup first page
		$data['status'] = "fail";
		array_push($content["signupContent"],$data);
	}

	echo json_encode($content)
?>