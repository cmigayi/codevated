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
	
	if(isset($_GET['c'])){
		$cid = $func->validateFormInput($_GET['c']);
		$userConceptData = $func->getUserConceptData($user,$cid);
	}	
	
	if(isset($_POST['submit'])){
		
		$conceptID = $_POST['concept_id'];
		$type = $_POST['type'];
		echo $_POST['concept_content'];
		switch($type){
			case "text":
				if(empty($_POST['concept_content'])){
					$error ="<div class='error'>You must provide content to proceed!</div>";
				}else{
					$content = $_POST['concept_content'];
				}				
				$status = $func->postFinalConcept($conceptID,$user,$type,$content);
				if($status == true){					
					header("Location: concept_new.php");
				}else{
					$error ="<div class='error'>Unable to post your concept!</div>";
				}
			break;
			default:
				$error ="<div class='error'>Select the type of content!</div>";
			break;
		}	
		if(empty($error)){			
			
		}			
	}
	
	require_once("template/header2.inc");	
?>			
<script>
$(document).ready(function(){
    $("input[name='type']").click(function(){
        var radioValue = $("input[name='type']:checked").val();
		switch(radioValue){
			case "text":
				$('.text-post').css("display","block");
				//$("input[name='type']:not(checked)").attr('disabled', 'disabled');
				//$(this).removeAttr('disabled');
				$('.info').css("display","none");
				$('.video-post').css("display","none");
				$('.audio-post').css("display","none");
			break;
			case "video":
				$('.video-post').css("display","block");
				//$("input[name='type']:not(checked)").attr('disabled', 'disabled');
				//$(this).removeAttr('disabled');
				$('.info').css("display","none");
				$('.text-post').css("display","none");
				$('.audio-post').css("display","none");
			break;
			case "audio":
				$('.audio-post').css("display","block");
				//$("input[name='type']:not(checked)").attr('disabled', 'disabled');
				//$(this).removeAttr('disabled');
				$('.info').css("display","none");
				$('.text-post').css("display","none");
				$('.video-post').css("display","none");
			break;
			default:
				$('.info').css("display","block");
				$('.text-post').css("display","none");
				$('.video-post').css("display","none");
				$('.audio-post').css("display","none");
			break;
		}
    });	
	
	$(".invite-items-close").click(function(){
		$('.invite-items').css("display","none");
		$("input[name='type']:not(checked)").removeAttr('disabled');
	});
    
    $('.textarea').on('keyup',function(){
        var charCount = $(this).text().length;
        $(".result").text(charCount + " chars");
	});
    
     $('.textarea').click(function(){
         $('.textarea-menu').fadeIn(1000).css("dispaly","block");
     });
    
    $('.textarea img').mousedown(function(event){            
        event.preventDefault();
        if(event.which == 3){
            alert("wow");
        }
    });
    
    $('.textarea').contextmenu(function() {
        return false;
    });
    
    $('.menu-img').click(function(){
        $('.textarea-menu-img').fadeIn(1000).css("display","block");
        $('.textarea-menu-main').fadeOut(1000).css("display","none");
    });
    $('.menu-link').click(function(){
        $('.textarea-menu-link').fadeIn(1000).css("display","block");
        $('.textarea-menu-main').fadeOut(1000).css("display","none");
    });
    $('.menu-font').click(function(){
        $('.textarea-menu-font').fadeIn(1000).css("display","block");
        $('.textarea-menu-main').fadeOut(1000).css("display","none");
    });
    $('.close-btn').click(function(){
         $('.textarea-menu-main').fadeIn(1000).css("display","block");
         $('.textarea-menu-img').fadeOut(1000).css("display","none");
         $('.textarea-menu-link').fadeOut(1000).css("display","none");
         $('.textarea-menu-font').fadeOut(1000).css("display","none");
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
.new-concept-content form .textarea{
	width:100%;
	padding:1%;
	border-radius:3px;
	border:#ddd solid 0.1em;
    -moz-appearance: textfield-multiline;
    -webkit-appearance: textarea;
    font: medium -moz-fixed;
    font: -webkit-small-control;
    height: 118px;
    overflow: auto;
    resize: both;
    background: #fff;
}
.textarea img{
    cursor:pointer;
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
.new-concept-content-item .concept-name{
	color:#5198E8;
	font-weight:500;
	font-size:14px;
	width:100%;
	padding:1%;
	border-radius:3px;
	border:#ddd solid 0.1em;
}
.new-concept-content-item .content-type ul{
	list-style:none;
	margin:0px;
	padding:0px;
	background:#EBEBEB;
}
.new-concept-content-item .content-type li:first-child{
	margin-left:20%;
}
.new-concept-content-item .content-type li{
	float:left;
	width:10%;
	margin-left:5%;
	padding:0px;
}
.info{
	display:block;
	font-size:13px;
	font-weight:600;
	background:#E8FCD7;
	padding:2%;
}
#txtEditor{
	overflow:scroll;				
	height:400px;
	margin-top:0px;
}
.text-post{display:none;}
.video-post{display:none;}
.audio-post{display:none;}
.textarea-menu{
    display: none;
    margin-top:3%;
}
.textarea-menu ul{
    padding: 0px;
    margin: 0px;
    list-style: none;
}
.textarea-menu li{
    display: inline;
    width:10%;
    border:#ccc solid 0.1em;
    padding:1%;
}
.textarea-menu li img{
    width:3%;
}
.textarea-menu-main{
    display:block;
    width:100%;
}
.textarea-menu-img{
    display:none;
    width:100%;
}
.textarea-menu-link{
    display:none;
    width:100%  
}
.textarea-menu-font{
    display:none;
    width:100% 
}
</style>
<div class="new-concept-content">
	<h3>Final Stage: Posting a new concept</h3>
	<form class="post-concept" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
		<div class="new-concept-content-item">
			<?php
				if(!empty($error)){
					echo $error;
				}
			?>
			<div>
				Your concept: <div class="concept-name"><?php echo $userConceptData['name'];?></div>
			</div>
			<div class="content-type">Choose content type:
				<ul>
					<li><input name="type" type="radio" value="text"/> Text</li>
					<li><input name="type" type="radio" value="video"/> Video</li>
					<li><input name="type" type="radio" value="audio"/> Audio</li>
				<ul>
				<div class="clear"></div>
			</div>			
		</div>		
		<div class="new-concept-content-item">
			<div class="info">Select content type above to continue...</div>
			<div class="text-post">	
				Write your content in the text area below:
				<div name="concept_content" class="textarea" 
                     contenteditable></div>
                <div class="result"></div>
                <div class="textarea-menu">
                    <div class="textarea-menu-main">
                        <ul>
                            <li class="menu-img"><img src="img/camera.png"/> add image</li>
                            <li class="menu-link">Add link</li>
                            <li class="menu-font">change font</li>
                        </ul>
                    </div> 
                    <div class="textarea-menu-img">
                        <a href="#" class="close-btn">X Close</a>
                        <form>
                            <input type="file" name="file"/>
                        </form>
                    </div>
                    <div class="textarea-menu-link">
                        <a href="#" class="close-btn">X Close</a>
                        <form>
                            <input name="link" type="text"/>
                        </form>
                    </div>
                    <div class="textarea-menu-font">
                        <a href="#" class="close-btn">X Close</a>
                        <form>
                            <select>
                                <option value="arial">arial</option>
                                <option value="verdana">verdana</option>
                                <option value="Comic Sans MS">comic sans</option>
                                <option value="Mavenpro">Mavenpro</option>
                            </select>
                            <input name="" placeholder="font size"/>
                        </form>
                    </div>
                </div>
			</div>
			<div class="video-post">
				Choose video file:
				<input name="video" type="file"/>
			</div>
			<div class="audio-post">
				Choose audio file:
				<input name="audio" type="file"/>
			</div>
		</div>
		<div class="new-concept-content-item">
			<input name="concept_id" type="hidden" value="<?php echo $userConceptData['concept_id'];?>"/>			
			<input name="submit" type="submit" value="Submit" disabled="disabled">			
		</div>
	</form>
</div>
<?php
	require_once("template/user_footer.inc");			
?>