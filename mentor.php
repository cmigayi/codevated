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
	.mentor-page{
		width:100%;
		padding:1%;
	}
	.mentor-page-header{
		width:80%;
		margin-left:10%;
		margin-bottom:2%;
	}
	.find-by-username{		
		float:left;
		width:55%;
	}
	.find-by-username h4{
		float:left;
		width:22%;
		margin-top:5px;	
	}
	.find-by-username form{
		margin-left:23%;
		width:75%;
	}
	.find-by-username input[type="text"]{
		width:100%;
		padding:1%;
		border:#ccc solid 0.1em;
		border-radius:4px;
	}	
	.find-by-interest{
		width:35%;
		margin-left:65%;
	}
	.find-by-interest select{
		width:100%;
		padding:1%;
		background:#76DB51;
		color:#fff;
		border:#76DB51 solid 0.1em;
	}
	.find-by-interest select:hover{
		padding:1%;
		background:#e3fce0;
		color:#000;
		border:#e3fce0 solid 0.1em;
		cursor:pointer;
	}
	.mentor-page-content{
		width:80%;
		margin-left:10%;
		border:#eee solid 0.1em;
		border-radius:5px;
	}
	.mentor-page-content-header{
		background:#ededed;
		border:#ccc solid 0.1em;
		border-radius:2px 2px 0px 0px;
		padding:1%;
		color:#000;
		width:100%;
	}
	.mentor-page-content-header h4{
		margin-top:0px;
		margin-bottom:0px;
		font-size:14px;
	}
	.mentor-page-content-content{
		padding:2%;
	}
	.mentor-page-content .mentor{
		float:left;
		width:20%;
		height:200px;
		margin:2%;
		border:#ddd solid 0.1em;
		border-radius:2px;
		padding:1%;
	}
	.mentor-page-content .mentor .mentor-img{
		width:90%;
		margin-left:5%;
		height:120px;
		overflow:hidden;
		margin-bottom:0px;
	}
	.mentor-page-content .mentor .mentor-img img{
		width:100%;
		border-radius:2px;
		border:none;

	}
	.mentor-page-content .mentor .mentor-det{
		width:98%;
		margin-left:1%;
		margin-top:0px;
		padding:1%;				
	}
	.mentor-page-content .mentor .mentor-det .username{
		text-align:center;
		font-size:13px;	
		height:20px;
		overflow:hidden;				
	}
	.mentor-page-content .mentor .mentor-det .username a{
		color:#67d15c;				
	}
	.mentor-page-content .mentor .mentor-det .profession{
		text-align:center;
		font-size:13px;	
		height:20px;
		overflow:hidden;						
	}
	.mentor-page-content .mentor .mentor-det .add-mentor-btn{
		width:98%;
		margin-left:1%;
		padding:1%;
		background:#67d15c;
		border:#67d15c solid 0.1em;
		text-align:center;
		border-radius:1px;						
	}
	.mentor-page-content .mentor .mentor-det .add-mentor-btn img{
		width:10%;
		padding-bottom:1%;
	}
	.mentor-page-content .mentor .mentor-det .add-mentor-btn a{
		color:#fff;
		font-weight:600;						
	}
	.mentor-page-content .mentor .mentor-det .add-mentor-btn a:hover{
		text-decoration:none;
	}	
</style>
<div class="mentor-page">
	<div class="mentor-page-header">		
		<div class="find-by-username">
			<h4>Find a mentor</h4>
			<form>				
				<input name="" type="text" placeholder="Find by mentor username"/>
			</form>
		</div>
		<div class="find-by-interest">
			<form>
				<select name="interest">
					<option>Find a mentor by interest</option>
				</select>
			</form>
		</div>		
	</div>
	<div class="mentor-page-content">
		<div class="mentor-page-content-header">
			<h4>Result found</h4>
		</div>		
		<div class="mentor-page-content-content">			
			<div class="mentor">
				<div class="mentor-img">
					<img src="img/female_user.png"/>
				</div>
				<div class="mentor-det">
					<div class="username">
						<a href="">Cilo</a>
					</div>
					<div class="profession">
						Software developer
					</div>
					<div class="add-mentor-btn">
						<a href=""><img src="img/add-mentor-white.png"/> add mentor</a>
					</div>
				</div>
			</div>
			
			<div class="mentor">
				<div class="mentor-img">
					<img src="img/female_user.png"/>
				</div>
				<div class="mentor-det">
					<div class="username">
						<a href="">Cilo</a>
					</div>
					<div class="profession">
						Software developer
					</div>
					<div class="add-mentor-btn">
						<a href=""><img src="img/add-mentor-white.png"/> add mentor</a>
					</div>
				</div>
			</div>
			
			<div class="mentor">
				<div class="mentor-img">
					<img src="img/female_user.png"/>
				</div>
				<div class="mentor-det">
					<div class="username">
						<a href="">Cilo</a>
					</div>
					<div class="profession">
						Software developer
					</div>
					<div class="add-mentor-btn">
						<a href=""><img src="img/add-mentor-white.png"/> add mentor</a>
					</div>
				</div>
			</div>

			<div class="mentor">
				<div class="mentor-img">
					<img src="img/female_user.png"/>
				</div>
				<div class="mentor-det">
					<div class="username">
						<a href="">Cilo</a>
					</div>
					<div class="profession">
						Software developer
					</div>
					<div class="add-mentor-btn">
						<a href=""><img src="img/add-mentor-white.png"/> add mentor</a>
					</div>
				</div>
			</div>

			<div class="mentor">
				<div class="mentor-img">
					<img src="img/cilo.jpg"/>
				</div>
				<div class="mentor-det">
					<div class="username">
						<a href="">Cilo</a>
					</div>
					<div class="profession">
						php, c++, c#, android, java, python
					</div>
					<div class="add-mentor-btn">
						<a href=""><img src="img/add-mentor-white.png"/> add mentor</a>
					</div>
				</div>
			</div>

			<div class="clear"></div>
		</div>
	</div>
</div>
<?php
	require_once("template/user_footer.inc");			
?>
