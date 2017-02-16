<?php
	require_once("classes/function_class.php");	
	session_start();
	$func = new FunctionClass();
	
	if(isset($_SESSION['user_id'])){
		$user = $_SESSION['user_id'];
	}else{
		header("Location: index.php");
	}

	if(isset($_GET['c'])){
		$cid=$_GET['c'];
		$conceptData = $func->getConceptItem($cid);
		$func->updateConceptView($cid,$conceptData['views']);
	}

	require_once("template/header2.inc");
?>
<style>
.concept-page{
	width:100%;
	margin-top:0px;
}
.concept-header{
	width:100%;	
	background:#f7f7f7;
	padding:2%;
}
.concept-header h4{
	width:40%;
	float:left;
}
.concept-header .concept-info{
	width:55%;
	margin-left:45%;
}
.concept-header .concept-info ul{
	list-style:none;
	margin:0px;
	padding:0px;
}
.concept-header .concept-info li:first-child{
	margin-left:0%;
}
.concept-header .concept-info li{
	float:left;
	width:24%;
	margin-left:1%;
	border:#ccc solid 0.1em;
	border-radius:3px;
	padding:1%;
	font-size:12px;
}
.concept-content{
	width:80%;
	margin-left:10%;
	padding:1%;
}
</style>
<div class="concept-page">
	<div class="concept-header">
		<h4>
		<?php
			echo $conceptData['name'];
		?>		
		</h4>
		<div class="concept-info">
			<ul>
			<?php
				echo"
					<li>Posted by ". $conceptData['username']."</li>
					<li>Content: ". $conceptData['content_type']."</li>
					<li>Resources: ". $conceptData['content_resources']."</li>
					<li>Views: ".$conceptData['views']."</li>
				"; 
			?>				
				<div class="clear"></div>		
			</ul>
		</div>
	</div>
	<div class="concept-content">
		<?php
			echo $conceptData['concept_content'];
		?>
	</div>
</div>
<?php
	require_once("template/user_footer.inc");			
?>
