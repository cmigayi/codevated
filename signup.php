<?php
	require_once("classes/function_class.php");	
	$func = new FunctionClass();	
	if(isset($_POST['submit'])){
		if(empty($_POST['username'])){
			$error = "<div class='error'>Hey :-),<br/> all fields must be filled, before submission!</div>";
		}else{
			$username = $func->validateFormInput($_POST['username']);
		}		
		if(empty($_POST['email'])){
			$error = "<div class='error'>Hey :-),<br/> all fields must be filled, before submission!</div>";
		}elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
			$error = "<div class='error'>Hey :-),<br/> the email address you entered is invalid!</div>";
		}else{
			$email = $func->validateFormInput($_POST['email']);				
		}	
		
		if(empty($_POST['password'])){
			$error = "<div class='error'>Hey :-),<br/> all fields must be filled, before submission!</div>";
		}else{
			if($_POST['password'] == $_POST['password2']){
				$pwd = $func->validateFormInput($_POST['password2']);
			}else{
				$error = "<div class='error'>Hey :-),<br/> your passwords do not match!</div>";
			}
		}		
		if(empty($_POST['gender'])){
			$error = "<div class='error'>Hey :-),<br/> all fields must be filled, before submission!</div>";
		}else{
			$gender=$_POST['gender'];
		}		
		if(empty($error)){
			if($func->signUpUser($username,$email,$pwd,$gender)== true){
				$userID = $func->checkIfUserIsRegistered($username,$pwd);
				$row = $func->getUserSignUpInfo($userID);
				session_start();
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['phone'] = $row['phone'];
				$_SESSION['gender'] = $row['gender'];
				$_SESSION['codevatedTeam'] = $row['codevatedTeam'];
				$_SESSION['dateTime'] = $row['dateTime'];				
				header("Location: signup_2.php");
			}else{
				$error = "<div class='error'>Hey :-),<br/> sorry we were not able to log you in,<br/> please try again!</div>";
			}
		}
	}
	
	include_once("template/login_page_header.inc");	
?>
<script>

</script>
<style>
	.login-page{
		padding-bottom:30px;
		margin-top:3%;
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
		width:25%;
		margin-left:37.5%;
		border:solid #DBDBDB 0.1em;
		border-radius:1%;
		background:#fff;
		margin-top:0px;	
	}	
	.login form{
		padding:5%;
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
</style>
<div class="login-page">
	<div class="logo-div"><img src="img/logo.png"/></div>
	<h3>Join Codevated</h3>	
	<div class="login">
		<?php
			if(!empty($error)){
				echo $error;
			}
		?>
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
			<div><input name="username" type="text" value="<?php echo $username;?>" placeholder="Username"/></div>
			<div><input name="email" type="text" value="<?php echo $email;?>" placeholder="Email"/></div>
			<div><input name="password" type="password" placeholder="Password"/></div>
			<div><input name="password2" type="password" placeholder="Match Password"/></div>
			<div>
				<ul><li>Gender:</li>					
					<li><img src="img/female_user.png"/> <input name="gender" type="radio" value="female"/></li>
					<li><img src="img/male_user.png"/> <input name="gender" type="radio" value="male"/></li>
					<div class="clear"></div>
				</ul>
			</div>
			<div><input name="checkbox" type="checkbox" /> I have read and agreed to <a href="">Codevated Terms and Conditions</a></div>
			<div><input name="submit" type="submit" value="Sign Up"/></div>
			<div class="btw"> <a href="login.php">Already have an account?</a></div>
		</form>
	</div>
</div>
<?php
	include_once("template/footer1.inc");
?>
