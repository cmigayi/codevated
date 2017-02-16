<?php
	require_once("classes/function_class.php");	
	session_start();
	
	if(isset($_SESSION['user_id'])){
		$user = $_SESSION['user_id'];
	}else{
		header("Location: index.php");
	}

	$func = new FunctionClass();
	
	require_once("template/header2.inc");	
?>
<script>

</script>
<style>
.setting-menu{
	float:left;
	width:18%;
	margin-left:5%;
	border:solid 0.1em #ccc;
	border-radius:5px;
	margin-top:2%;
	border-top:solid 0.1em #fff;
}
.setting-menu ul{
	margin:0px;
	padding:0px;
	list-style:none;
}
.setting-menu li:first-child{
	background:#ddd;
	font-weight:600;
	border-top:solid 0.1em #ccc;
	text-align:center;
	padding:2%;
}
.setting-menu li:first-child:hover{
	background:#ddd;
}
.setting-menu li{
	border-top:solid 0.1em #ccc;
	padding:2%;
}
.setting-menu li:hover{
	background:#F5F5F5;
}
.setting-menu .current{
	border-left:#EB545E solid 0.1em;
	border-left-width:5px;
	font-weight:600;
}
.setting-menu li a{
	color:#000;
}
.setting-menu li a:hover{
	text-decoration:none;
}
.setting-form{
	width:70%;
	margin-left:25%;
	margin-top:2%;
}
.setting-form-item{
	margin-bottom:5%;
}
.setting-form h3:last-child{
	border-bottom:solid 0.1em #ccc;
	border-width:1px;
	width:100%;
	margin-top:0px;
	color:#F55B65;
}
.setting-form h3{
	border-bottom:solid 0.1em #ccc;
	border-width:1px;
	width:100%;
	margin-top:0px;
}
.setting-form form div{
	margin-top:1%;
}
.setting-form input[type="text"]{
	width:60%;
	padding:0.5%;
	border-radius:5px;
	border:#ddd solid 0.1em;
}
.setting-form input[type="submit"]{
	width:15%;
	padding:0.5%;
	border-radius:5px;
	border:#ddd solid 0.1em;
	font-weight:600;
}
.setting-form a{
	margin-left:1%;
}
.setting-form-item .delete-btn{
	width:15%;
	padding:0.5%;
	border-radius:5px;
	border:#ddd solid 0.1em;
	margin-top:1%;
}
.setting-form-item .delete-btn a{
	font-weight:600;
	color:#F55B65;
}
</style>
<div class="setting-menu">
	<ul>
		<li>Personal Settings</li>
		<li><a href="profile_edit.php">Profile</a></li>
		<li><a href="profile_account.php">Account</a></li>
		<li class="current"><a href="profile_block_user.php">Blocked Users</a></li>
	</ul>
</div>
<div class="setting-form">
	<div class="setting-form-item">
		<h3>Block a user</h3>
		<div>
			Prevent a user from the following:
			<ul>
				<li>Accessing and commenting on your posts.</li>
				<li>Inviting you to their circle.</li>
				<li>Viewing your activities.</li>
				<li>Sending you any notifications.</li>
				<li>Viewing your profile.</li>
			</ul>
		</div>
	</div>
	<div class="setting-form-item">
		<h3>Search by user names, username or email address</h3>
		<form>
			<div>Search by user names, username or email address</div>
			<div><input name="" type="text" placeholder="User email, username or names"/></div>		
			<div><input name="submit" type="submit" value="Block User"/></div>
		</form>
	</div>
	<div class="setting-form-item">
		<h3>Blocked Users</h3>
		<div>You have not blocked any user</div>
	</div>
</div>
<?php
	require_once("template/user_footer.inc");			
?>