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
.discussions-header{
	margin-bottom:1%;
}
.discussions-header .find-by-title{
	float:left;
	width:60%;
}
.discussions-header .find-by-title h4{
	float:left;
	width:24%;
}
.discussions-header .find-by-title form{
	margin-left:25%;
	width:67%;
}
.discussions-header .find-by-title form input[type="text"]{
	width:100%;
	border:#ccc solid 0.1em;
	border-radius:4px;
	padding:1%;
}
.discussions-header .find-by-interest{
	margin-left:63%;
}
.discussions-header .find-by-interest form{
	width:100%;
	padding:1%;
}
.discussions-header .find-by-interest form select{
	width:100%;
	padding:1%;
	background:#76DB51;
	color:#fff;
	border:#76DB51 solid 0.1em;
}
.discussions-header .find-by-interest select:hover{
	background:#e3fce0;
	color:#000;
	border:#e3fce0 solid 0.1em;
	cursor:pointer;
}
.discussion-item{}
.discussion-item table{
	width:100%;
}
.discussion-item table th:first-child{
	width:40%;
}
.discussion-item table th{
	width:100%;
	background:#666666;
	padding:0.5%;
	color:#fff;
	width:15%;
	text-align:left;
	border:#fff solid 0.1em;
}
.discussion-item table th:nth-child(2){
	width:10%;
	text-align:center;
}
.discussion-item table th:nth-child(3){
	width:15%;
	text-align:center;
}
.discussion-item table th:nth-child(4){
	width:10%;
	text-align:center;
}
.discussion-item table th:nth-child(5){
	width:10%;
	text-align:center;
}
.discussion-item table td:nth-child(2){
	width:10%;
	text-align:center;
}
.discussion-item table td:nth-child(3){
	width:15%;
	text-align:center;
}
.discussion-item table td:nth-child(4){
	width:10%;
	text-align:center;
}
.discussion-item table td:nth-child(5){
	width:10%;
	text-align:center;
}
.discussion-item table td{
	background:#fff;
	padding:1%;
	width:20%;
	border-bottom:#ccc solid 0.1em;
}
.discussion-item table td img{
	width:13%;
	margin-left:2%;
}
.take-part-btn{
	width:20%;
	background:#F5AF76;	
	text-align:center;
	border-radius:5%;	
	padding:0.5%;
}
.take-part-btn a{
	color:#5C5B5A;
	font-weight:600;
}
.take-part-btn a:hover{
	text-decoration:none;
	color:#fff;
}
.you-took-part-btn{
	width:30%;
	background:#F2EA8F;	
	text-align:center;	
	padding:0.5%;
	border-radius:5%;
}
.you-took-part-btn img{
	width:3%;
} 
.you-took-part-btn a{
	color:#5C5B5A;
	font-weight:600;
	text-decoration:none;
}

</style>
<div class="discussion-left">
	<h3><img src="img/discussion.png"/> Discussions</h3>
	<div class="discussion-left-content">
		<div class="start-a-discussion-btn">
			<a href="discussion_create.php">Start a discussion</a>
		</div>
	</div>
</div>
<div class="discussions">
	<div class="discussions-header">
		<div class="find-by-title">
			<h4>Find a discussion</h4>
			<form>				
				<input name="" type="text" placeholder="Find by discussion  title"/>
			</form>
		</div>
		<div class="find-by-interest">
			<form>
				<select name="interest">
					<option>All Discussions</option>
				</select>
			</form>	
		</div>
	</div>
	
	<div class="discussion-item">
		<table>
			<tr><th>Topic</th><th>Cartegory</th><th>Participants</th><th>Views</th><th>Last Post</th></tr>
			<tr><td>Application of AI in Kenya or Africa <div class="you-took-part-btn"><a href="">You took part <img src="img/tick.png"/></a></div></td><td>AI</td><td><img src="img/hireus.png"/><img src="img/mascot2.png"/><img src="img/mascot.png"/></td><td>120</td><td>31 Dec</td></tr>			
			<tr><td>The best business models to adopt when running an IT consulting business with industrial examples <div class="take-part-btn"><a href="">Take part</a></div></td><td>IT, Business</td><td><img src="img/hireus.png"/><img src="img/mascot2.png"/><img src="img/mascot.png"/></td><td>120</td><td>31 Dec</td></tr>			
		</table>
	</div>
</div>
<?php
	require_once("template/user_footer.inc");			
?>
