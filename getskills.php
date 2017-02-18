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

	$sql="SELECT * FROM interest_cartegory WHERE speciality_id='$q'";	
	$query = mysql_query($sql)or die(mysql_error());
	while($row=mysql_fetch_array($query)){
		echo "
			<div class='speciality-items'>
				<div class='item'>
					<span>".$row['cartegory_name']."</span> <input name='' type='checkbox'/>
				</div>				
			</div>	

		";
	}
	echo "<div class='clear'></div>";
?>
