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
$(document).ready(function() {
    $("li").click(function() {
        $("li").removeClass('current');
        $(this).addClass('current');
    });
});
</script>
<style>
h3{
	float:left;
	width:15%;
	padding:1%;
	margin-top:0px;
}
h3 img{
	width:25%;
}
.circles-tabs{
	width:80%;
	margin-left:15%;
	margin-top:1%;
}
.circles-tabs ul{
	list-style:none;
	margin:0px;
	padding-bottom:10px;
	border-bottom:#bababa solid 0.1em;
}
.circles-tabs li:first-child{
	margin-left:0%;
}
.circles-tabs li:last-child{
	width:20%;
	margin-left:30%;
	padding:1%;
}
.circles-tabs li{
	display:inline;
	width:20%;
	margin-left:5%;
	padding:1%;
}
.circles-tabs li span{
	background:#e3e5e3;
	padding:0.5%;
	border-radius:10px;	
}
.circles-tabs li a{
	color:#000;
	outline:none;
}
.circles-tabs li a:hover{
	text-decoration:none;
}
.circles-tabs li a:visited{
	text-decoration:none;
	color:#000;
}
.circles li a:active{
	text-decoration:none;
	color:#000;
}
.circle-tab-header{
	margin-bottom:2%;
	padding:0.5%;
}
.circle-tab-header .find-by-name{
	float:left;
	width:50%;
}
.circle-tab-header .find-by-name h4{
	float:left;
	width:35%;
	margin-top:5px;
	font-size:15px;
}
.circle-tab-header .find-by-name form{
	margin-left:36%;
	width:55%;
}
.circle-tab-header .find-by-name form input[type="text"]{
	width:100%;
	border:#ddd solid 0.1em;
	padding:1%;
	border-radius:3px;
}
.circle-tab-header .find-by-interest{
	margin-left:70%;
	width:30%;
}
.circle-tab-header .find-by-interest form{}
.circle-tab-header .find-by-interest form select{
	width:100%;
	padding:1%;
	background:#76DB51;
	color:#fff;
	border:#76DB51 solid 0.1em;
}
.find-by-interest select:hover{
	padding:2%;
	background:#e3fce0;
	color:#000;
	border:#e3fce0 solid 0.1em;
	cursor:pointer;
}
.current{	
	border-bottom:#60605f solid 0.1em;
	border-width:4px;
}
.current a{
	text-decoration:none;
	color:#000;
	font-weight:500;
}
#tabs-1,#tabs-2,#tabs-3{
	padding:1%;
}
.tabs-content-header{
	background:#ededed;
	border:#ccc solid 0.1em;
	border-radius:2px 2px 0px 0px;
	padding:1%;
	color:#000;
	width:100%;
}
.tabs-content-header{
	background:#ededed;
	border:#ccc solid 0.1em;
	border-radius:2px 2px 0px 0px;
	padding:1%;
	color:#000;
	width:100%;
}
</style>
<h3><img src="img/circles.png"/> Circles</h3>
<div class="circles-tabs">
  <ul>
  <li class="current"><a href="#tabs-1">Open <span><?php echo $func->getTotalCircles("Open");?></span></a></li>
	<li><a href="#tabs-2">Member <span>1100</span></a></li>
	<li><a href="#tabs-3">Your Circles <span>5</span></a></li>
	<li><a href="#tabs-4">What is a circle</a></li>
  </ul>
  <div id="tabs-1">
		<div class="circle-tab-header">
			<div class="find-by-name">
				<h4>Find by circle name:</h4> 
				<form>
					<input name="" type="text" placeholder="Find by circle name"/>
				</form>			
			</div>
			<div class="find-by-interest">
				<form>
					<select>
						<option>Find by interest</option>
					</select>
				</form>			
			</div>
		</div>
		<div class="">
		<?php
			$func->getOpenClasses();
		?>
		</div>
  </div>
  <div id="tabs-2">
		<?php
			//$func->getClassesInvite($user);
		?>
  </div>
  <div id="tabs-3">
		<?php
			//$func->getParticipantClasses($user);
		?>
  </div>
  <div id="tabs-4">
		<?php
			//$func->getOtherClasses($user);
		?>
  </div>
  <div class="clear"></div>
</div>
	
<script>
 $(function() {
    $( ".circles-tabs" ).tabs();
  });
</script>
<?php
	require_once("template/user_footer.inc");			
?>
