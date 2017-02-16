<?php
	require_once("classes/function_class.php");
	session_start();	
	$func = new FunctionClass();

	if(isset($_SESSION['user_id'])){
		$user = $_SESSION['user_id'];
		$userData = $func->getUserSignUpInfo($user);	
	}else{
		header("Location: signup.php");
	}

	if(isset($_GET['q'])){
		
		$q = $_GET['q'];			
	
	}

	$sql="SELECT * FROM speciality WHERE industry_id='$q'";	
	$query = mysql_query($sql)or die(mysql_error());

	echo "<div class='question'>
		Select your specialization:
		<div class='ans'>
			<select name='speciality'>";						
			while($row=mysql_fetch_array($query)){
				echo "<option value='".$row['speciality_id']."'>".$row['speciality_name']."</option>";
			}
		echo"</select>			
			</div>			
		</div>";
	
?>
