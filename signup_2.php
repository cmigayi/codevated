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

	
	if(isset($_POST['submit'])){
		
		$professionType = $_POST['profession'];
		$speciality = $_POST['speciality'];
	
		if(empty($error)){
			$state = $func->postProfessionOnSignUp($user,$professionType,$speciality);
			
			if($state == true){
				header("Location: signup_3.php");
			}else{
				$error="Falied to post";
			}
		}
	}
	
	include_once("template/login_page_header.inc");	
?>
<script>
	$(document).ready(function(){
		$("input[name='type']").click(function(){
			var radioValue = $("input[name='type']:checked").val();
			if(radioValue == "student"){
			    $('.student-question').css("display","block");
					$("input[name='type']:not(checked)").attr('disabled', 'disabled');
					$(this).removeAttr('disabled');
			}
		 });
		
		$('.login').fadeIn(1000).css("display","block");
		$('.login h4:nth-child(2)').fadeIn(5000).css("display","block");

		$('.profession').fadeIn(7000).css("display","block");
		;		
	});
	
	function showSpeciality(str) {
	    if (str.length == 0) {
		document.getElementById("txtHint").innerHTML = "";
		return;
	    } else {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		        document.getElementById("txtHint").innerHTML = this.responseText;
		    }
		};
		xmlhttp.open("GET", "getSpeciality.php?q=" + str, true);
		xmlhttp.send();
	    }
	}
</script>
<style>
	.login-page{
		padding-bottom:30px;
		margin-top:3%;
		width:100%;
	}
	.logo-div{
		width:6%;
		margin-left:47%;
	}	
	.logo-div img{
		width:100%;
	}
	.login-page h3{
		background:#F5F5F5;
		padding:0.8%;
		width:25%;
		margin-left:37.5%;
		color:#000;
		font-weight:500;
		font-size:19px;
		text-align:center;
		margin-top:0px;
		margin-bottom:0px;
		border-radius:5px 5px 0px 0px;
	}
	.header-title{
		width:100%;
		text-align:center;
		background:#DBDBDB;	
		margin-bottom:2%;
	}
	.header-title p{
		color:#000;
		font-size:20px;
		font-weight:500;
		padding:0.5%;
	}
	.login{
		float:left;
		width:25%;
		margin-top:0px;	
		margin-left:7.5%;
		display:none;
	}
	.login h4:nth-child(2){
		color:#fff;
		font-weight:600;
		background:#76DB51;
		padding:2%;
		margin-bottom:0px;
		display:none;
	}
	.login h4{
		text-align:center;
	}	
	.login form{
		padding:5%;
		border:solid #DBDBDB 0.1em;
		border-radius:1%;
		background:#fff;
		opacity:0.7;
	}
	.login form div{
		margin-bottom:3%;
	}
	.login form input[type="text"]{
		width:100%;
		padding:1.5%;
		border:solid 0.1em #CFD1D1;
		border-radius:2px;
		font-size:15px;
	}
	.login form input[type="password"]{
		width:100%;
		padding:1.5%;
		border:solid 0.1em #CFD1D1;
		border-radius:2px;
		font-size:15px;
	}
	.login form input[type="submit"]{
		width:100%;
		background:#92d050;
		color:#fff;
		border:#86BF49 solid 0.1em;
		border-radius:2px;
		padding:1.7%;
		border-radius:3px;
		font-size:15px;
		font-weight:600;
	}
	.login .btw{
		text-align:center;
		background:#FAFAFA;
		padding:5px;
	}
	.login form img{
		width:50%;
	}
	.login form ul{
		list-style:none;
		padding:0px;
		margin:0px;
	}
	.login form li{
		width:20%;
		float:left;
		margin-left:5%;
	}
	.login form ul{}
	.profession{
		width:25%;
		margin-left:37.5%;
		margin-top:0px;	
		display:none;
	}
	.profession h4{
		text-align:center;
	}	
	.profession form{
		padding:5%;
		border:solid #DBDBDB 0.1em;
		border-radius:1%;
		background:#fff;
	}
	.profession form div{
		margin-bottom:3%;
	}
	.profession .question{}
	.profession .question .ans{}
	.profession .question .optns{
		margin-left:1%;
		float:left;
		width:45%;
	}
	.profession .student-question{
		display:none;	
	}
	.profession form input[type="text"]{
		width:100%;
		padding:1.5%;
		border:solid 0.1em #CFD1D1;
		border-radius:2px;
		font-size:15px;
	}
	.profession form input[type="password"]{
		width:100%;
		padding:1.5%;
		border:solid 0.1em #CFD1D1;
		border-radius:2px;
		font-size:15px;
	}
	.profession form input[type="submit"]{
		width:100%;
		background:#92d050;
		color:#fff;
		border:#86BF49 solid 0.1em;
		border-radius:2px;
		padding:1.7%;
		border-radius:3px;
		font-size:15px;
		font-weight:600;
	}
	.profession .btw{
		text-align:center;
		background:#FAFAFA;
		padding:5px;
	}
	.profession form img{
		width:50%;
	}
	.profession form ul{
		list-style:none;
		padding:0px;
		margin:0px;
	}
	.profession form li{
		width:20%;
		float:left;
		margin-left:5%;
	}
</style>
<div class="login-page">
	<div class="logo-div"><img src="img/logo.png"/></div>
	<h3>Join Codevated</h3>	
	<div class="login">
		<h4>Personal info:</h4>
		<h4>Completed</h4>
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">			
			<div><input name="username" type="text" value="<?php echo $_SESSION['username'];?>" placeholder="Username"/></div>
			<div><input name="email" type="text" value="<?php echo $_SESSION['email'];?>" placeholder="Email"/></div>
			<div><input name="password" type="password" value="<?php echo $_SESSION['password'];?>" placeholder="Password"/></div>
			<div><input name="password2" type="password" value="<?php echo $_SESSION['password'];?>" placeholder="Match Password"/></div>
			<div>
				<ul><li>Gender:</li>
					<?php
						if($_SESSION['gender'] == "female"){
							echo "
								<li><img src='img/female_user.png'/> <input name='gender' type='radio' 									value='female' checked></li>
					<li><img src='img/male_user.png'/> <input name='gender' type='radio' value='male'/></li>
							";
						}else{
							echo "
								<li><img src='img/female_user.png'/> <input name='gender' type='radio' 									value='female'/></li>
					<li><img src='img/male_user.png'/> <input name='gender' type='radio' value='male'checked></li>
							";
						}
					?>					
					
					<div class="clear"></div>
				</ul>
			</div>
		</form>
	</div>

	<div class="profession">
		<h4>Professional info:</h4>
		<?php
			if(!empty($error)){
				echo $error;
			}
		?>
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
			<div class="question">
				<span>Your profession?</span>
				<div class="ans">
					<div class="optns"><input name='profession' type='radio' value='student'> Student</div>
					<div class="optns"><input name='profession' type='radio' value='Freelancer'> Freelancer</div>
					<div class="optns"><input name='profession' type='radio' value='Specialist'> Specialist</div>
					<div class="optns"><input name='profession' type='radio' value='Employee'> Employee</div>
				</div>
			</div>
			<div class="question">
				Select your industry:
				<div class="ans">
					<select onChange="showSpeciality(this.value)">
						<option>None</option>
				<?php
					$sql="SELECT * FROM industry";
					$query=mysql_query($sql)or die(mysql_error());

					while($row=mysql_fetch_array($query)){
						echo "<option value='".$row['industry_id']."'>
						".$row['industry_name']."
						</option>";
					}
				?>
						
					</select>			
				</div>			
			</div>
			<div id="txtHint"></div>
			
			<div><input name="submit" type="submit" value="Proceed"/></div>			
		</form>
	</div>
</div>
<?php
	include_once("template/footer1.inc");
?>
