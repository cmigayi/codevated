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
   
});
</script>
<style>
.concepts{
	width:80%;
	margin-left:10%;
	padding:1%;
}
.concepts-header{
	margin-bottom:1%;
	width:98%;
	margin-left:1%;
}
.concepts-header .find-by-title{
	float:left;
	width:60%;
}
.concepts-header .find-by-title h4{
	float:left;
	width:24%;
}
.concepts-header .find-by-title form{
	margin-left:25%;
	width:65%;
}
.concepts-header .find-by-title form input[type="text"]{
	width:100%;
	border:#ccc solid 0.1em;
	border-radius:4px;
	padding:1%;
}
.concepts-header .find-by-interest{
	margin-left:63%;
}
.concepts-header .find-by-interest form{
	width:100%;
	padding:1%;
}
.concepts-header .find-by-interest form select{
	width:100%;
	padding:1%;
	background:#76DB51;
	color:#fff;
	border:#76DB51 solid 0.1em;
}
.concepts-header .find-by-interest select:hover{
	background:#e3fce0;
	color:#000;
	border:#e3fce0 solid 0.1em;
	cursor:pointer;
}
.concept-item{
	float:left;
	margin:1%;
	width:31%;
	height:200px;
	overflow:auto;
	background:#fff;
	border:#F2F2F2 solid 0.1em;
}
.concept-item:hover{
	background:#E0E0E0;
	border:#E0E0E0 solid 0.1em;
}
.concept-item h4{		
	padding:1%;
	padding-left:2%;
	margin-bottom:5%;
	margin-left:5%;
	width:90%;
	border-bottom:#000 dotted 0.1em;
}
.concept-item h4 img{
	width:10%;
}
.concept-item span{
	margin-left:1%;
	width:99%;
}
.concept-item h4 a{		
	color:#3c3c3d;
	font-size:14px;
	font-weight:500;
	text-transform:capitalize;
}
.concept-item h4 a:hover{
	color:#000;
	text-decoration:none;
}
.concept-item p{
	color:#656566;
	margin-top:0px;
	margin-bottom:0px;
	font-size:12px;	
	padding-left:2%;
	text-align:center;
}
.concept-item span{
	color:#296BD6;
	font-weight:600;
}
</style>
<div class="concepts">
	<div class="concepts-header">
		<div class="find-by-title">
			<h4>Find a concept</h4>
			<form>				
				<input name="" type="text" placeholder="Find concepts by title"/>
			</form>
		</div>
		<div class="find-by-interest">
			<form>
				<select name="interest">
					<option>All Concepts</option>
				</select>
			</form>	
		</div>
	</div>
	<?php
		$func->getAllConcepts();
	?>
  <div class="clear"></div>
</div>	

<?php
	require_once("template/user_footer.inc");			
?>
