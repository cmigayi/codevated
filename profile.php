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
	$userTotalInterest = $func->getTotalUserInterests($user);
	$profileComplete = $func->checkIfUserProfileIsComplete($user);
	
	require_once("template/header2.inc");	
?>
<script>
$(document).ready(function() {
    $("li").click(function() {
        $("li").removeClass('current');
        $(this).addClass('current');
    });
});
</script>
<style>
.bio{
	float:left;
	width:25%;
	padding:1%;
	margin-left:2.5%;
	margin-top:2%;
}
.bio .prof-img{
	width:80%;
	margin-left:10%;
	border:#edeeef solid 0.1em;
	border-radius:7px;
	background:#edeeef;
	overflow:hidden;
}
.bio img{
	width:100%;
}
.bio h4{
	text-align:center;
}
.bio h4 span{
	color:#808182;
	font-weight:500;
	font-size:15px;
}
.bio-data{
	border-top:#edeeef solid 0.1em;
	margin-top:10px;
	padding-top:5%;
}
.bio-data-item{
	margin-top:0px;
	margin-bottom:0px;
	padding-left:0px;
	width:100%;
	text-align:center;
}
.bio-data-item span{
	font-weight:600;
}
.preference{
	width:70.5%;
	margin-left:27%;
	margin-top:2%;
}
.bio-data-btn{
	margin-top:3%;
	border-top:#edeeef solid 0.1em;
	padding:1%;
}
.bio-data-btn ul{ 
	list-style:none;
	margin:0px;
	padding:0px;
}
.bio-data-btn li{}
.bio-data-btn li img{
	width:5%;
	margin-left:0px;
}
.bio-data-btn li a{
	color:#769ADB;
	font-size:13px;
}
.bio-data-btn li a:hover{
	text-decoration:none;
}
.bio-data-btn li a:visited{
	text-decoration:none;
}
.bio-data-btn li a:active{
	text-decoration:none;
}
#tabs-1,#tabs-2,#tabs-3,#tabs-4,#tabs-5,#tabs-6{
	border-top:#ddd solid 0.1em;
	margin-top:5px;
	height:400px;
	overflow:auto;
}
.preference h4{
	padding:1%;
}
.preference ul{
	list-style:none;
	margin:0px;
	padding:0px;
}
.preference li:first-child{	
	margin-left:0%;
}
.preference li{
	display:inline;
	width:30%;
	margin-left:5%;
	padding:0.5%;
}
.preference li a{
	color:#000;
	outline:none;
}
.preference li a:hover{
	text-decoration:none;
}
.preference #tabs-1 li{
	display:block;
	width:100%;
	margin-top:1%;
	margin-left:0%;
	padding:1%;
	border-bottom:#eee solid 0.1em;	
	font-size:13px;
}
.preference #tabs-1 li img{
	width:2%;
}
.preference #tabs-1 li a{
	color:#669CF2;
	outline:none;
}
.preference #tabs-1 li a:hover{
	text-decoration:underline;
}
.preference #tabs-3 li{
	display:block;
	width:90%;
	margin-top:1%;
	margin-left:0%;
	padding:1%;
	font-size:13px;
	border-bottom:#eee solid 0.1em;	
}
.preference #tabs-3 li img{
	width:15%;
}
.preference #tabs-3 li a{
	outline:none;	
	float:left;
	color:#242424;
	font-weight:600;
}
.preference #tabs-3 li a:hover{
	text-decoration:underline;
}
.preference #tabs-3 li .remove-item{
	width:10%;
	margin-left:90%;
}
.preference #tabs-3 li .remove-item img{
	width:25%;
}
.preference #tabs-3 li .remove-item img:hover{
	opacity:0.9;
	background:#fff;
}
.preference #tabs-6 li{
	display:block;
	width:90%;
	margin-top:1%;
	margin-left:0%;
	padding:1%;
	font-size:13px;
	border-bottom:#eee solid 0.1em;	
}
.preference #tabs-6 li img{
	width:2%;
}
.preference #tabs-6 li a{
	outline:none;
	color:#242424;
	font-weight:500;
}
.preference #tabs-6 li a:hover{
	text-decoration:underline;
	color:#74B1ED;
}
.preference .current{
	border-bottom:#000 solid 0.1em;
	border-width:3px;
}
.preference .current a{
	text-decoration:none;
	color:#000;
	font-weight:600;
}

.user-interest-div{
	float:left;
	width:23%;
	height:180px;
	overflow:hidden;
	margin:2%;
	border:#eee solid 0.1em;
	border-radius:2px;
	padding:1%;
}
.user-interest-div-img{
	height:150px;
	overflow:hidden;
}
.user-interest-div-img img{
	width:80%;
	margin-left:10%;
}
.remove-item{
	width:10%;
}
.remove-item img{
	width:100%;
}
</style>
<div class="bio">
	<div class="prof-img">
        <img src="img/cilo.jpg"/>
        <?php 
            //$func->displayGenderIcon($user);
        ?>
    </div>
	<h4>
	<?php 
		if($userData['name'] != "none"){
			echo $userData['name'];
		}
		echo " <span>".$userData['username']."</span>";
		?>
	</h4>
	<div class="bio-data">		
		<div class="bio-data-item"><span>Email: </span><?php echo $userData['email'];?></div>
		<div class="bio-data-item"><span>Joined on </span><?php echo date("d-M-Y", strtotime($userData['dateTime']));?></div>
	</div>
	<div class="bio-data-btn">
		<ul>
			<li><img src="img/edit.png"/> <a href="profile_edit.php">Edit profile</a></li>
		</ul>
	</div>
</div>
<div class="preference">
	<?php
		if($profileComplete == false){
			echo "<div class='tip'>
				<p>
				<span>Note!</span> Updating your profile with your name, location, and a profile picture 
				helps other codevated users get to know you.
				</p>
				<div class='tip-btn'><a href='profile_edit.php'>Edit profile</a></div>				
				
			</div>
			";
		}
	?>
	<ul>
	  <li class="current"><a href="#tabs-1">Activities</a></li>
		<li><a href="#tabs-2">Circles [3]</a></li>
		<li><a href="#tabs-3">Interests [<?php echo $userTotalInterest;?>]</a></li>
		<li><a href="#tabs-4">Mentors [0]</a></li>
		<li><a href="#tabs-5">Mentees [10]</a></li>
		<li><a href="#tabs-6">Concepts [<?php echo $func->getTotalUserConcepts($user);?>]</a></li>
	  </ul>
	  <div id="tabs-1">
			<h4>Your activities</h4>
			<?php
				$func->getUserActivity($user);
			?>
	  </div>
	  <div id="tabs-2">
			<h4>Your circles</h4>
			<?php
				//$func->getClassesInvite($user);
			?>
	  </div>
	  <div id="tabs-3">
			<h4>Your interests</h4>
			<?php
				$func->getUserProfileInterests($user);
			?>
	  </div>
	  <div id="tabs-4">
			<h4>Your mentors</h4>
			<?php
				//$func->getOtherClasses($user);
			?>
	  </div>
	  <div id="tabs-5">
			<h4>Your mentees</h4>
			<?php
				//$func->getOtherClasses($user);
			?>
	  </div>
	  <div id="tabs-6">
			<h4>Your concepts</h4>
			<?php
				$func->getAllUserConcepts($user);
			?>
	  </div>
	  <div class="clear"></div>
	</div>
<div class="clear"></div>
<script>
 $(function() {
    $( ".preference" ).tabs();
  });
</script>
<?php
	require_once("template/user_footer.inc");			
?>
