<?php
	require_once("classes/function_class.php");	
	session_start();
	$func = new FunctionClass();
	
	if(isset($_SESSION['user_id'])){
		$user = $_SESSION['user_id'];
	}else{
		header("Location: index.php");
	}

	require_once("template/header2.inc");
?>
<style>
	.interest-page{
		margin-left:5%;
		width:90%;
	}
	.speciality{}
	.speciality h4{
		background:#bababa;
		padding:1%;
	}
	.item{
		width:23%;
		margin:1%;
		border:#eee solid 0.1em;
		background:#eee;
		padding:0.5%;
		border-radius:3px;
		float:left;	
	}	
	.item .img{
		width:20%;
		float:left;
		height:50px;
		overflow:hidden;	
	}
	.item .img img{
		width:100%;	
	}
	.item-name{
		float:left;
		width:70%;
		margin-left:1%;
		font-size:18px;
		font-weight:600;
		margin-top:5%;
	}
	.item input[type="checkbox"]{
		width:8%;
		margin-left:1%;
		margin-top:7%;
		zoom:1.5;	
	}
	.speciality{
		width:100%;
		margin-top:1%;	
	}
</style>
<div class="interest-page">
	<?php
		$sql="SELECT * FROM signup_interest_specialities WHERE user_id='$user'";
		$query=mysql_query($sql)or die(mysql_error());

		while($row=mysql_fetch_array($query)){
			$speciality = $func->getSpecialityItem($row['speciality_id']);
			
			echo "<div class='speciality'>
				<h4>".$speciality['speciality_name']."</h4>";
				$func->getAllInterestCartegorySpeciality($row['speciality_id']);
			echo "</div>";			
		}	
	?>
</div>
<?php
	require_once("template/user_footer.inc");			
?>
