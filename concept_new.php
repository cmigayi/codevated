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
	
	if(isset($_POST['submit'])){
		if(empty($_POST['concept'])){
			
			$error = "<div class='error'>Concept Name should not be empty!</div>";
		}else{
			$name = $func->validateFormInput($_POST['concept']);
		}
		
		if(empty($_POST['description'])){
			$error = "<div class='error'>Concept description should not be empty!</div>";
		}else{
			$desc = $func->validateFormInput($_POST['description']);
		}
		
		if($_POST['cartegory'] == "Select cartegory"){
			$error = "<div class='error'>Select a cartegory!</div>";
		}else{
			$cart = $_POST['cartegory'];
		}
		
		if(empty($_POST['type'])){
			$error = "<div class='error'>Choose who can should access this concept!</div>";
		}else{			
			if($_POST['type'] == "invite"){
				$circles = $func->validateFormInput($_POST['circles']);
				$indiv = $func->validateFormInput($_POST['individuals']);
				$type = $_POST['type'];
			}else{
				$type = $_POST['type'];
			}
		}

		if(empty($error)){
			switch($type){
				case "invite":
					if(empty($circles)){
						$circles = "none";
					}
					if(empty($indiv)){
						$indiv = "none";
					}
					$forWho = "c".$circles."#i".$indiv;
					$status = $func->postNewConcept($name,$user,$desc,$cart,$forWho,"","");
					if($status == true){						
						header("Location: concept_new_final.php");											
					}else{
						$error ="<div class='error'>Unable to post your concept!</div>";
					}
				break;
				default:
					$cid = $func->postNewConcept($name,$user,$desc,$cart,$type,"","");
					if($cid == false){						
						$error ="<div class='error'>Unable to post your concept!</div>";
					}else{
						header("Location: concept_new_final.php?c=$cid");
					}
				break;
			}			
		}else{
			$error ="<div class='error'>All fields must be filled!</div>";
		}		
	}
	
	require_once("template/header2.inc");	
?>
<script>
$(document).ready(function(){
    $("input[name='type']").click(function(){
        var radioValue = $("input[name='type']:checked").val();
        if(radioValue == "invite"){
            $('.invite-items').css("display","block");
			$("input[name='type']:not(checked)").attr('disabled', 'disabled');
			$(this).removeAttr('disabled');
        }
    });	
	
	$(".invite-items-close").click(function(){
		$('.invite-items').css("display","none");
		$("input[name='type']:not(checked)").removeAttr('disabled');
	});
        
});
</script>
<style>
.new-concept-content{
	width:50%;
	margin-left:25%;
	font-size:13px;
}
.new-concept-content-item div{
	margin-bottom:1%;
}
.new-concept-content form input[type="text"]{
	width:100%;
	padding:1%;
	border-radius:3px;
	border:#ddd solid 0.1em;
}
.new-concept-content form textarea{
	width:100%;
	padding:1%;
	border-radius:3px;
	border:#ddd solid 0.1em;
}
.new-concept-content form select{
	width:100%;
	padding:1%;
	border-radius:3px;
	border:#ddd solid 0.1em;
}
.new-concept-content form input[type="submit"]{
	width:20%;
	padding:1%;
	border-radius:3px;
	border:#91ED66 solid 0.1em;
	background:#91ED66;
	color:#fff;
	text-align:center;
}
.new-concept-content-item{
	margin-top:1%;
	border-top:#ccc solid 0.1em;
	padding:2%;
}
.new-concept-content-item img{
	width:3%;
}
.new-concept-content-item span{
	color:#A1A1A1;
}
.invite-items{
	background:#DEDEDE;
	padding:1%;
	display:none;
}
.invite-items-close{
	background:#404040;
	color:#fff;
	text-align:center;
	width:12%;
	float:right;
	padding:0.5%;
	cursor:pointer;
	border-radius:2px;
}
.invite-items-close:hover{
	background:#E85159;
}
</style>
<div class="new-concept-content">
	<h3>Post a new concept</h3>
	<p>
		A concept is a particular way of doing things in a field of interest, i.e 
		singing while your back is at 90 degrees makes you be more audible.
	</p>
	<form class="post-concept" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
		<div class="new-concept-content-item">
			<?php
				if(!empty($error)){
					echo $error;
				}
			?>
			<div>
				Concept Name: <span>Short Concept names are easy to remember</span><br/>			
				<input name="concept" type="text" placeholder="Concept Name:"/>
			</div>
			<div>Description (optional):<br/>
				<textarea name="description" placeholder="Concept description"></textarea>
			</div>
			<div>
				Select concept field or cartegory: <span>You can only post concepts based on your interests</span><br/>
				<?php
					$func->getAllUserInterestsInSelectOption($user);
				?>
			</div>
		</div>		
		<div class="new-concept-content-item">
			<div><img src="img/accessibility.png"/>Who should access this concept?</div>
			<div>			
				<input name="type" type="radio" value="open"/> Open <br/>
				<span>Any one can access this concept.</span>				
			</div>
			<div>
				<input name="type" type="radio" value="invite"/> Invites Only<br/>
				<span>Only invited persons or my circle members can access this concept.</span>
				<div class="invite-items">
					<div class="invite-items-close">X Remove</div>
					<p>Your circles: <input name="circles" type="text" placeholder="Type name of any of your circles"/></p>
					<p>Individuals: <input name="individuals" type="text" placeholder="Type names of people in your circles"/></p>
				</div>
			</div>
			<div>
				<input name="type" type="radio" value="mentee"/> Trainee / Mentee<br/>
				<span>Only my trainees or mentees can access this concept.</span>				
			</div>				
		</div>
		<div class="new-concept-content-item">
			<input name="submit" type="submit" value="Post Concept"/>			
		</div>
	</form>
</div>
<?php
	require_once("template/user_footer.inc");			
?>