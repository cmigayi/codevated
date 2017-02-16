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
<style>
.discussion-left{
	float:left;
	width:15%;
	padding:1%;
	margin-top:0px;
}
.discussion-left h3{}
.discussion-left h3 img{
	width:25%;
}
.discussion-left-content{
	width:100%;
}
.discussion-left-content .start-a-discussion-btn{
	text-align:center;
	padding:2%;
	border:#ccc solid 0.1em;
	background:#e3e4e5;
	border-radius:4px;
}
.discussion-left-content .start-a-discussion-btn a{
	color:#000;
}
.discussions{
	width:80%;
	margin-left:15%;
	padding:1%;
}
.discussions-form{
	width:80%;
	margin-left:10%;
	border:#eee solid 0.1em;
	padding:1%;
}
.discussions-form h4{
	text-align:center;
}
.discussions-form form{}
.discussions-form form div{
	margin-top:10px;
	width:90%;
	margin-left:5%;
}
.discussions-form form span{
	font-style:italic;
	margin-left:1%;
	font-size:13px;
}
.discussions-form form span a{
	color:#79797a;
}
.discussions-form form input[type="text"]{
	width:100%;
	border:#ddd solid 0.1em;
	border-radius:3px;
	padding:1%;
	outline:none;
}
.discussions-form form textarea{
	width:100%;
	border:#ddd solid 0.1em;
	border-radius:3px;
	padding:1%;
	outline:none;
}

.discussions-form form select{
	width:100%;
	border:#ddd solid 0.1em;
	border-radius:3px;
	padding:1%;
	outline:none;
}
.discussions-form form input[type="submit"]{
	width:30%;
	margin-left:35%;
	border:#76DB51 solid 0.1em;
	border-radius:3px;
	padding:1%;
	outline:none;
	background:#76DB51;
	color:#fff;
	font-weight:600;
}
</style>
<div class="discussion-left">
	<h3><img src="img/discussion.png"/> Discussions</h3>
	<div class="discussion-left-content">
		<div class="start-a-discussion-btn">
			<a href="discussions.php">Discussion forum</a>
		</div>
	</div>
</div>
<div class="discussions">
	<div class="discussions-form">
		<h4>Start a discussion</h4>
		<form>
			<div>
				Discussion title:
				<textarea name="title" placeholder="Discussion title"></textarea>
			</div>
			<div>Select discussion cartegory:
				<select>
					<option>Select cartegory</option>
				</select>
			</div>
			<div>
				Choose people to second:<span><a href="">Why this is important?</a></span>
				<input name="seconding" type="text" placeholder="Choose any two people to second"/>
			</div>
			<div>
				<input name="submit" value="Create discussion" type="submit" />
			</div>
		</form>
	</div>
</div>
<?php
	require_once("template/user_footer.inc");			
?>
