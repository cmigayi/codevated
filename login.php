<?php
	require_once("classes/function_class.php");
	
	$func = new FunctionClass();
	
	if($_GET['by'] == "git"){
		
		$func->signup_github();
	}
	
	if(isset($_POST['submit'])){
		if(empty($_POST['username'])){
			$error = "<div class='error'>Hey :-),<br/> all fields must be filled, before submission!</div>";
		}else{
			$username = $func->validateFormInput($_POST['username']);
		}
		
		if(empty($_POST['password'])){
			$error = "<div class='error'>Hey :-),<br/> all fields must be filled, before submission!</div>";
		}else{
			$pwd = $_POST['password'];
		}
		
		if(empty($error)){
			if($func->checkIfUserIsRegistered($username,$pwd) != false){
				$userID = $func->checkIfUserIsRegistered($username,$pwd);
				$row = $func->getUserSignUpInfo($userID);
				
				session_start();
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['phone'] = $row['phone'];
				$_SESSION['codevatedTeam'] = $row['codevatedTeam'];
				$_SESSION['dateTime'] = $row['dateTime'];
				
				$func->addUserOnline($_SESSION['user_id']);
				header("Location: home.php");
			}
		}
	}
	
	include_once("template/login_page_header.inc");
?>
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
	.social-login{
		padding:5%;
		text-align:center;		
	}
	.social-login img{
		width:7%;
		float:left;
	}
	.social-login ul{
		list-style:none;		
	}
	.social-login li{
		width:100%;
		margin-bottom:5%;
		padding:1.7%;
		text-align:center;
		font-weight:600;
	}
	.social-login li a{
		color:#fff;
		text-decoration:none;
	}
	.social-login li a:hover{
		
	}
	.social-login #fb{
		background:#7E8AD6;
		border:#7E8AD6 0.1em solid;
		border-radius:2px;
	}
	.social-login #google{
		background:#FA7C69;
		border:#FA7C69 0.1em solid;
		border-radius:2px;
	}
	.social-login #github{
		background:#4B4D4B;
		border:#4B4D4B 0.1em solid;
		border-radius:2px;
	}
</style>
<div class="login-page">
	<div class="logo-div"><img src="img/logo.png"/></div>
	<h3>Sign in to Codevated</h3>	
	<div class="login">
		<?php
			if(!empty($error)){
				echo $error;
			}
		?>
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
			<div>Username:</div>
			<div><input name="username" type="text" value="<?php echo $username;?>" placeholder="Username"/></div>
			<div>Password:</div>
			<div><input name="password" type="password" placeholder="Password"/></div>
			<div><input name="submit" type="submit" value="Sign in"/></div>
			<div class="btw"><a href="">Forgot password?</a> <br/>OR,<br/> <a href="signup.php">Do not have an account yet?</a></div>
		</form>
		<div class="social-login">
			<ul>
				<li id="github"><a href="login.php?by=git"><img src="img/github.png"/>Login with Github</a></li>
			</ul>
		</div>
	</div>
</div>
<?php
	include_once("template/footer1.inc");
?>
