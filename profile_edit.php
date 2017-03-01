<?php
	require_once("classes/function_class.php");	
	session_start();
	
	if(isset($_SESSION['user_id'])){
		$user = $_SESSION['user_id'];
	}else{
		header("Location: index.php");
	}

	$func = new FunctionClass();
	$userData = $func->getUserSignUpInfo($user);

	$target_dir = "profile_img/";
			$target_file = $target_dir . basename($_FILES["file"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES["file"]["tmp_name"]);
			    if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			    } else {
				echo "File is not an image.";
				$uploadOk = 0;
			    }
			}
			// Check if file already exists
			if (file_exists($target_file)) {
			    echo "Sorry, file already exists.";
			    $uploadOk = 0;
			}
			// Check file size
			if ($_FILES["file"]["size"] > 500000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
			    } else {
				echo "Sorry, there was an error uploading your file.";
			    }
			}	
	
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
.setting-form h3{
	border-bottom:solid 0.1em #ccc;
	border-width:1px;
	width:100%;
	margin-top:0px;
}
.setting-form .form-update-profile{
	width:67%;
	float:left;
}
.setting-form form div{
	margin-top:1%;
}
.setting-form input[type="text"]{
	width:100%;
	padding:1%;
	border-radius:5px;
	border:#ddd solid 0.1em;
}
.setting-form textarea{
	width:100%;
	padding:1%;
	border-radius:5px;
	border:#ddd solid 0.1em;
}
.setting-form .form-update-profile input[type="submit"]{
	width:100%;
	padding:1%;
	border-radius:5px;
	border:#ddd solid 0.1em;
	font-weight:600;
	padding:1%;
}
.setting-form .form-upload-pic{
	padding:1%;
	width:30%;
	margin-left:70%;
}
.setting-form .form-upload-pic h4{
	font-size:15px;
	font-weight:600;
	padding:1%;
}
.setting-form .form-upload-pic .prof-img{
	width:65%;
	margin-left:17.5%;
	border:#edeeef  solid 0.1em;
	border-radius:10px;
	background:#edeeef ;
	padding:1%;
	overflow:hidden;
}
.setting-form .form-upload-pic img{
	width:100%;
}
.form-upload-pic input[type="file"]{
	width:90%;
	margin-top:5%;
	margin-left:5%;
}
.form-upload-pic input[type="submit"]{
	width:90%;
	margin-top:2%;
	margin-left:5%;
	padding:1.5%;
	border-radius:5px;
	border:#ddd solid 0.1em;
	font-weight:600;
}
</style>
<div class="setting-menu">
	<ul>
		<li>Personal Settings</li>
		<li class="current"><a href="">Profile</a></li>
		<li><a href="profile_account.php">Account</a></li>
		<li><a href="profile_block_user.php">Blocked Users</a></li>
	</ul>
</div>
<div class="setting-form">
	<h3>Profile</h3>
	<form class="form-update-profile">
		<div>Name:</div>
		<div><input name="name" type="text" placeholder="Name"/></div>
		<div>Email:</div>
		<div><input name="" type="text" value="<?php echo $userData['email'];?>" placeholder="Email"/></div>
		<div>Bio:</div>
		<div><textarea name="about-me" placeholder="Tell us a little about yourself"></textarea></div>
		<div>Location:</div>
		<div><input name="location" type="text" placeholder="Where are you based / live?"/></div>
		<div><input name="submit" type="submit" value="Update Profile"/></div>
	</form>
	<form class="form-upload-pic" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<h4>Profile picture</h4>
		<div class="prof-img">
			<?php $func->displayGenderIcon($user);?>
		</div>
		<div>
			<input name="file" type="file"/>
		</div>
		<div><input name="submit" type="submit" value="Upload new picture"/></div>
	</form>
</div>
<?php
	require_once("template/user_footer.inc");			
?>
