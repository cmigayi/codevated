<?php
	require_once("classes/function_class.php");	
	session_start();
	$func = new FunctionClass();
	
	if(isset($_SESSION['user_id'])){
		$user = $_SESSION['user_id'];
	}else{
		header("Location: index.php");
	}

	if(isset($_POST['submit-cartegory'])){
		$cartegory = $_POST['cartegory'];
		
		foreach($cartegory as $d){
			$status = $func->addUserInterest($user,$d);
			if($status == true){
				$func->userActivity($user,"add interest","none","$d");
				header("Location: home.php");
			}
		}
	}

	require_once("template/header2.inc");
?>
<style>
	.link1,.link2,.online-chat,.chat{
		display:none;
	}
	.logo{
		margin-left:45%;
	}
	.logo img{
		width:100%;
	}
	.interest-page{
		margin-left:5%;
		width:90%;
	}
	.selection-items{
		padding:1%;
	}
	.interest-page .submit{
		position:fixed;
		width:100%;
		bottom:0px;
		background:#fff;
		padding:1%;
	}
	.interest-page form input[type="submit"]{
		width:20%;
		margin-left:40%;
		font-size:14px;
		border-radius:3px;
		font-weight:600;
		padding:1%;
		text-align:center;
		background:#669DD4;
		border:#669DD4 solid 0.1em;
		color:#fff;
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
		width:15%;
		float:left;
		height:40px;
		overflow:hidden;	
	}
	.item .img img{
		width:100%;	
	}
	.item-name{
		float:left;
		width:70%;
		margin-left:1%;
		font-size:15px;
		font-weight:600;
		margin-top:3%;
	}
	.item input[type="checkbox"]{
		width:8%;
		margin-left:1%;
		margin-top:5%;
		zoom:1.5;	
	}
	.speciality{
		width:100%;
		margin-top:1%;	
	}
</style>
<div class="interest-page">
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			<p>
				Choose cartegories below, based on your interests. You can choose multiple items.
			</p>
		<div class="selection-items">
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
		<div class="submit">
			<input type="submit" value="Submit Selection" name="submit-cartegory"/>
		</div>
	</form>
</div>
<?php
	require_once("template/user_footer.inc");			
?>
