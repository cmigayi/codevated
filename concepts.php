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
.current{
	border:#F5F5F5 solid 0.1em;
	background:#F5F5F5;
}
.current a{
	text-decoration:none;
	color:#000;
	font-weight:600;
}
.concepts{
	width:80%;
	margin-left:15%;;
	padding:1%;
}
.concepts form{
	width:40%;
	margin-left:60%;
	padding:1%;
}
.concepts form select{
	width:100%;
	padding:1%;
	border:#F5F5F5 solid 0.1em;
	background:#F5F5F5;
	cursor:pointer;
	color:#6EA1D4;
}
.concepts form select:hover{
	background:#E0E0E0;
	border:#E0E0E0 solid 0.1em;
}
.concept-item{
	float:left;
	margin:1%;
	width:31%;
	height:200px;
	overflow:auto;
	background:#F2F2F2;
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
.class-notify{
	padding:1%;
	font-size:14px;
	font-weight:600;
}
</style>
<h3><img src="img/concept.png"/> Concepts</h3>
<div class="concepts">
	<form>
		Specify Cartegory:
		<select name="interest">
			<option>All</option>
		</select>
	</form>
	<?php
		$func->getAllConcepts();
	?>
  <div class="clear"></div>
</div>
	
<script>
 $(function() {
    $( ".classes-tabs" ).tabs();
  });
</script>
<?php
	require_once("template/user_footer.inc");			
?>
