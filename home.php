<?php
	require_once("classes/function_class.php");	
	session_start();
	$func = new FunctionClass();
	
	$page = "home";

	if(isset($_SESSION['user_id'])){
		$user = $_SESSION['user_id'];
	}else{
		header("Location: index.php");
	}
	
	if(isset($_GET['remove'])){
		$item = $_GET['remove'];
		$func->removeUserInterestItem($user,$item);
	}

	if(isset($_GET['ud'])){
		$userChatId = $_GET['ud'];
		$userChatData = $func->getUserSignUpInfo($userChatId);
	}
	
	$userTotalInterest = $func->getTotalUserInterests($user);
	$userGroupTotal = $func->getTotalUserGroups($user);	
	
	if(isset($_POST['submit-cartegory'])){
		$cartegory = $_POST['cartegory'];
		
		foreach($cartegory as $d){
			$status = $func->addUserInterest($user,$d);
			if($status == true){
				$func->userActivity($user,"add interest","none","$d");
				header("Location: home.php");
			}
		}
	}
	
	if(isset($_POST['submit'])){
		
		$allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma", "avi");
		$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		
		if ((($_FILES["file"]["type"] == "video/mp4")
		|| ($_FILES["file"]["type"] == "video/avi")
		|| ($_FILES["file"]["type"] == "audio/mp3")
		|| ($_FILES["file"]["type"] == "audio/wma")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg"))

		&& ($_FILES["file"]["size"] < 20000)
		&& in_array($extension, $allowedExts))
		  {
		  if ($_FILES["file"]["error"] > 0)
			{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			}
		  else
			{
			echo "Upload: " . $_FILES["file"]["name"] . "<br />";
			echo "Type: " . $_FILES["file"]["type"] . "<br />";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

			if (file_exists("video-tutorials/" . $_FILES["file"]["name"]))
			  {
			  echo $_FILES["file"]["name"] . " already exists. ";
			  }
			else
			  {
			  move_uploaded_file($_FILES["file"]["tmp_name"],
			  "video-tutorials/" . $_FILES["file"]["name"]);
			  echo "Stored in: " . "video-tutorials/" . $_FILES["file"]["name"];
			  }
			}
		  }
		else
		  {
		  echo "Invalid file";
		  }		
		
	}
		
	require_once("template/header2.inc");
?>
<style>
	.add-tutorial{
				position:absolute;
				z-index:1002;
				width:60%;
				top:5%;
				left:20%;
				display:none;
				background:#fff;
				border-radius:5px;
			}
			.add-tutorial h3{}
			.add-tutorial form{
				width:60%;
				margin-left:20%;
				padding:1%;
			}
			.add-tutorial form input[type="text"]{
				width:100%;
				padding:1%;
				border:#eee solid 0.1em;
				border-radius:3px;
				margin-top:15px;	
				font-size:15px;				
			}
			.add-tutorial form textarea{
				width:100%;
				padding:1%;
				border:#eee solid 0.1em;
				border-radius:3px;	
				margin-top:15px;	
				font-size:15px;
			}
			.add-tutorial form input[type="submit"]{
				width:25%;
				margin-left:40%;
				border:#5C7BD1 solid 0.1em;
				background:#5C7BD1;
				color:#fff;
				padding:1%;
				border-radius:3px;
				margin-top:15px;	
			}
			.add-tutorial form input[type="file"]{
				margin-left:30%;
			}
			.add-tutorial .header{
				padding:1%;
				background:#eee;
				border-radius:5px 5px 0px 0px;
			}
			.add-tutorial .header h3{
				margin-top:0px;
				float:left;
				width:70%;
			}
			.add-tutorial .header .close-btn{
				float:right;
				width:10%;
				color:#414241;
				padding:0.5%;
				text-align:center;
				cursor:pointer;
	}
	.add-cartegory{
		position:fixed;
		z-index:1002;
		width:60%;
		top:2%;
		left:20%;
		display:none;
		background:#fff;
		border-radius:5px;
	}
	.add-cartegory .header{
		padding:0.5%;
		background:#eee;
		border-radius:5px 5px 0px 0px;		
	}
	.add-cartegory .header h3{
		margin-top:0px;
		margin-bottom:0px;
		padding:5px;
		float:left;
		width:70%;
	}
	.add-cartegory .header .close-btn{
		float:right;
		width:10%;
		color:#414241;
		padding:0.5%;
		text-align:center;
		cursor:pointer;
	}
	.add-cartegory form{
		width:80%;
		margin-left:10%;
		padding:1%;
	}
	.cartegory-group{
		height:480px;
		overflow:scroll;
		padding:1%;
	}
	.cartegory-item{
		width:30%;
		float:left;
		margin-left:2%;
		margin-top:2%;
		padding:1%;
		border:#F5F5F5 solid 0.1em;
		background:#F5F5F5;
	}
	.cartegory-item:hover{
		border:#F5F5F5 solid 0.1em;
		background:#fff;
	}
	.cartegory-item .img{
		width:200px;
		height: 100px;
		overflow:hidden;
		margin-bottom:5px;
	}
	.cartegory-item .remove img{
		width:10%;
	}
	.cartegory-item .img img{
		width:45%;
		margin-left:20%;
	}
	.cartegory-item .choice{
		text-align:center;
	}
	.add-cartegory input[type="submit"]{
		width:40%;
		margin-left:30%;
		padding:1%;
		margin-top:20px;
		text-align:center;
		background:#669DD4;
		border:#669DD4 solid 0.1em;
		color:#fff;
	}
	.groups{
		width:100%;	
	}
	.groups-content{
		border-radius:5px;
		padding:0%;
		display:none;
	}
	.groups-content-header{
		width:100%;
		padding:1%;
		margin-bottom:20px;
        border:#F0F0F0 solid 0.1em;
		background:#F0F0F0;
	}
	.groups-content-header h4{
        float:left;
		width:50%;
        font-size:14px;
        font-weight: 600;
        padding:0.5%;
	}
	.groups-content-header .btns{
		float:right;
		width:30%;
		padding:0.1%;
		text-align:center;
	}	
	.groups-content-header .group-info-btn{
		width:30%;
		float:left;
		margin-left:40%;		
		cursor:pointer;
	}
	.groups-content-header .group-info-btn img{
		width:30%;
	}
	.groups-content-header .close-btn{
		margin-left:90%;
		width:10%;
		border:#eee solid 0.1em;
        border-radius:5px;
		background:#F9F9F9;
		text-align:center;
	}
	.groups-content-header .close-btn a{
		color:#000;
		font-size:12px;
	}
	.groups a{
		color:#fff;
		font-size:13px;
	}
	.group-notice{
		color:#000;
		font-size:13px;
		text-align:right;
		margin-bottom:2%;
		width:100%;
	}
	.group-notice span{
		color:#fff;
		background:#727273;
		font-size:13px;
		text-align:right;
		padding:0.5%;
	}
	.group-notice span a{
		color:#fff;
	}
	.group-notice span a:hover{
		text-decoration:none;
	}	
	.groups .circle-data{
		width:100%;
	}
    .groups .circle{
		float:left;
		width:46%;
		margin-left:2%;
		margin-bottom:2%;
		border:#ddd solid 0.1em;
		border-radius:3px;
		background:#fff;
		padding:0.5%;
		text-align:center;
	}
    .groups .circle h4 a{
        color:#97b1fc;
    }
	.open-group{
		cursor:pointer;
		width:100%;
		border-bottom:#ddd solid 0.1em;
		border-width:3px;
		font-size:13px;
		font-weight:600;
	}
	.open-posts{
		cursor:pointer;
		width:100%;
		text-align:right;
		border-bottom:#ddd solid 0.1em;
		border-width:3px;
		font-size:13px;
		font-weight:600;
	}
	.posts{
		width:100%;
	}
	.posts-content{
		display:block;
	}
	.posts-content-header{
		width:100%;        
		border:#F0F0F0 solid 0.1em;
		background:#F0F0F0;
        margin-bottom:15px;
        padding:1%;
	}
	.posts-content-header h4{
		float:left;
		width:50%;
        font-size:14px;
        font-weight: 600;
        padding:0.5%;
	}
	.posts-content-header .close-btn{
		margin-left:90%;
		width:10%;
		border:#eee solid 0.1em;
        border-radius:5px;
		background:#F9F9F9;
		text-align:center;
	}
	.posts-content-header .close-btn a{
		color:#000;
		font-size:12px;
	}
	.open-activities{
		cursor:pointer;
		width:100%;
		text-align:right;
		border-bottom:#ddd solid 0.1em;
		border-width:3px;
		font-size:13px;
		font-weight:600;
	}
	.activities-content{
		display:block;
	}
	.activities-content-header{
		width:100%;
        border:#F0F0F0 solid 0.1em;
		background:#F0F0F0;
        margin-bottom:15px;
        padding:1%;
	}
	.activities-content-header h4{	
        width:50%;
        font-size:14px;
        font-weight: 600;
        padding:0.5%;
        margin-bottom:0px;
	}
	.activities-content ul{
		list-style:none;
		margin:0px;
		padding:0px;
	}
	.activities-content li:last-child{
		border-bottom:none;
	}
	.activities-content li{
		margin-top:5px;
		padding:1%;
		border-bottom:#F0F0F0 solid 0.1em;
		font-size:13px;
	}
	.activities-content li img{
		width:2%;
	}
	.about_interests{
		padding:1%;
		width:20%;
		position:absolute;
		z-index:1002;
		display:none;
		background:#fff;
		border:#ccc solid 0.1em;
		border-radius:5px;
		right:18%;
		top:5%;
	}
	.about_interests-header{
		width:100%;
	}
	.about_interests-header h4{
		width:50%;
		float:left;
		margin-top:0px;
	}
	.about_interests-header .close-btn{
		width:10%;
		margin-left:90%;
		cursor:pointer;
	}	
	.about_groups{
		padding:1%;
		width:20%;
		position:absolute;
		z-index:1002;
		display:none;
		background:#fff;
		border:#ccc solid 0.1em;
		border-radius:5px;
		right:18%;
		top:5%;
	}
	.about_groups_header{
		width:100%;
	}
	.about_groups_header h4{
		width:50%;
		float:left;
		margin-top:0px;
	}
	.about_groups_header .close-btn{
		width:10%;
		margin-left:90%;
		cursor:pointer;
	}
	.groups_more_info{
		padding:1%;
		width:20%;
		position:absolute;
		display:none;
		background:#fff;
		border:#ccc solid 0.1em;
		border-radius:5px;
		right:22%;
		top:13%;
	}
	.groups_more_info_header{
		width:100%;
	}
	.groups_more_info_header h4{
		width:50%;
		float:left;
		margin-top:0px;
	}
	.groups_more_info_header .close-btn{
		width:10%;
		margin-left:90%;
		cursor:pointer;
	}
    .right-aside{
        width:18%;
		margin-left:81%;
        position: fixed;
    }
	.suggestions{		
		border:solid 0.1em #eaeaea;
		border-top:none;
		border-radius:5px 5px 0px 0px;
	}
	.suggestions-header{
		border-bottom:#76DB51 solid 0.1em ;
		background:#76DB51;
		width:100%;
		padding:3%;
		border-radius:5px 5px 0px 0px;
	}
	.suggestions-header h4{
		width:100%;
		text-align:left;
		font-size:13px;
		font-weight:600;
		color:#fff;
		margin:0px;
	}
	.suggestions-content{
		background:#fcfcfc;
		width:100%;
		padding:2%;
		border-radius:0px 0px 3px 3px;
		max-height:450px;
	}
	.add-mentor-div:last-child{
		border-bottom:none;
	}			
	.add-mentor-div{
		width:90%;
        margin-left:5%;
		margin-bottom:3%;
		padding:1%;
		padding-bottom:3%;
        border-bottom:#ccc dotted 0.1em;
	}
	.add-mentor-div-left{
		float:left;
		width:20%;	
	}	
	.mentor-img{
		float:left;
		width:100%;
		border-radius:10px;
        border: #eee solid 0.1em;
        background: #eee;
		overflow:hidden;
        height:40px;        
	}
	.mentor-img img{
		width:100%;
		margin-left:0%;
	}
	.add-mentor-div-right{
		margin-left:25%;
		width:75%;
	}
	.add-mentor-div-right-top{
		width:100%;	
	}
	.add-mentor-div-right-top h4{
		width:80%;
		float:left;
		color:#3B3B3B;
		font-weight:600;
		font-size:13px;
		margin-top:0px;
		margin-bottom:0px;	
	}
	.add-mentor-div-right-top .mentor-rating{
		width:15%;
		margin-left:85%;
		border-radius:3px;
        background:#ccc;
        text-align:center;
	}	
	.mentor-rating .rating-text{
		width:100%;	
		font-size:12px;
		color:#000;
		font-weight:600;
	}
	.add-mentor-div-right p{
		margin-top:0px;
		margin-bottom:0px;
		font-size:12px;
	}	
	.add-mentor-div-right-bottom{}
	.add-mentor-btn{
		background:#eee;
		border:#ccc solid 0.1em;
		border-radius:3px;
		padding:2%;
		text-align:center;
		width:60%;
		margin-left:25%;
		font-size:12px;
	}
	.add-mentor-btn a{
		color:#3B3B3B;
		font-weight:600;
		font-size:13px;
	}
	.add-mentor-btn a:hover{
		text-decoration:none;
	}
	.add-mentor-btn a img{
		width:15%;
	}
    .interest-latest-posts{
        width:100%;
    }
    .suggestions-footer{
		width:100%;
		padding:2%;
        border-top:solid 0.1em #eaeaea;
        background: #fff;
    }	
    .suggestions-footer ul{
        margin:0px;
        padding:0px;
        list-style:disc;
    }
    .suggestions-footer li{
        display:inline;
        margin-left:5%;
        width:35%;
    }
    .suggestions-footer li a{
        font-size:12px;
    }
    .mentor-chat{
        border:solid 0.1em #eaeaea;
		border-radius:5px 5px 0px 0px;
        margin-top:10%;        
        background: #fff;
        padding:1%;
        padding-bottom: 2%;
    }
    .mentor-chat h4{
        margin-left:5%;
        width:90%;
    }
    .mentor-chat-content{
        
    }
    .mentor-chat-content ul{
        padding: 0px;
        margin: 0px;
        list-style: none;
    }
    .mentor-chat-content li{
        margin-top:2%;
        border: #ccc solid 0.1em;
        padding:2%;
        margin-left:5%;
        width:90%;
    }
    .mentor-chat-content li img{
        width:10%;
    }
    .mentor-chat-content li a{
        color:#000;
    }
    .mentor-chat-content li span img{
        width:7%;
    }
    .mentor-chat-content li span{
        font-size:12px;
    }
</style>
<script type="text/javascript">			
	$(document).ready(function(){
		
		$(".open-group").click(function(){
			$(".groups-content").fadeIn(1000).css("display","block");	
			//$(".open-group").fadeOut(1000).css("display","none");
			$(".groups-content").css("margin-bottom","2px");
		});
		
		$(".open-posts").click(function(){
			$(".posts-content").fadeIn(1000).css("display","block");	
			//$(".open-posts").fadeOut(1000).css("display","none");
			$(".posts-content").css("margin-top","2px");
		});
		
		$(".open-activities").click(function(){
			$(".activities-content").fadeIn(1000).css("display","block");	
			//$(".open-activities").fadeOut(1000).css("display","none");
			$(".activities-content").css("margin-top","2px");
		});
		
		$(".groups-content-header .close-btn").click(function(){
			$(".groups-content").fadeOut(2000).css("display","none");			
			//$(".open-group").fadeIn(1000).css("display","block");	
		});		
		
		$('.groups-content-header .group-info-btn').click(function(){					
			$('.groups_more_info').fadeOut(1000).css("display","block");
		});
		
		$(".groups_more_info_header .close-btn").click(function(){
			$('.groups_more_info').fadeOut(1000).css("display","none");	
		});
		
		$(".posts-content-header .close-btn").click(function(){
			$(".posts-content").fadeOut(2000).css("display","none");	
			//$(".open-posts").fadeIn(1000).css("display","block");
		});
		
		$(".activities-content-header .close-btn").click(function(){
			$(".activities-content").fadeOut(2000).css("display","none");
			//$(".open-activities").fadeIn(1000).css("display","block");
		});
		
		$(".addCarteg").click(function(){
			$('.dark-cover').css("display","block");
			$(".add-cartegory").css("display","block");
			event.preventDefault();
		});
		
		$('.close-btn').click(function(){					
			$('.dark-cover').css("display","none");
			$('.add-tutorial').css("display","none");
			$('.add-cartegory').css("display","none");
			event.preventDefault();
		});
		
		$('.about_feature_interests').click(function(){
			$('.dark-cover').css("display","block");
			$('.about_interests').css("display","block");
		});
		
		$('.about_interests-header .close-btn').click(function(){					
			$('.about_interests').fadeOut(1000).css("display","none");
		});
		
		$('.about_feature_group').click(function(){
			$('.dark-cover').css("display","block");
			$('.about_groups').css("display","block");
		});
		
		$('.about_groups_header .close-btn').click(function(){	
			$('.about_groups').fadeOut(1000).css("display","none");
		});
        
        $('.interest-cart .unhide').click(function(event){
            event.preventDefault();
            var t = <?php echo $userTotalInterest;?>;            
            var h = $('.interest-cart-content').height();
            var hauto = $('.interest-cart-content').css("height","auto").height();
            if(h == 240){
                $('.interest-cart-content')
                    .animate({height:hauto});
                $(this).text("Hide");
                $('.interest-cart-content-footer li:first-child')
                    .text("0 items hidden");
            }else{ 
                $('.interest-cart-content')
                    .animate({height:'240px',overflow:'hidden'});
                $(this).text("Show");
                var s = t-6;
                $('.interest-cart-content-footer li:first-child')
                    .text(s+" items hidden");
            } 
        });
        
        setInterval(function(){
            $('.interest-latest-posts').load("latest_posts.php").fadeIn("slow");
        },1000);
	});
</script>
	<div class="about_interests">
		<div class="about_interests-header">
			<h4>Interests</h4>
			<div class="close-btn">X</div>
			<div class="clear"></div>
		</div>
		<p>
			Interests are in cartegories, you are expected to choose them on the left side of 
			the screen, as titled "Interests".
		</p>
		<p>
			<img src="img/interest1.png"/>
		</p>
		<p>
			For you to enable this feature, you must atleast have one interest selected. Do that by 
			clicking the <img src="img/addInterestBtn.png"/> button and select whichever cartegory you are interested in.
		</p>
		<p>
			The Posts listed, will be based on the interests you select.
		</p>
	</div>
	<div class="groups_more_info">
		<div class="groups_more_info_header">
			<h4>Groups Info</h4>
			<div class="close-btn">X</div>
			<div class="clear"></div>
		</div>
		<p>
		Groups consists of classes you are currently enrolled in as a participant and projects you 
		are currently contributing in. Blocks in <font style="color:#db4930;font-weight:600">Red</font> are your projects 
		and blocks in <font style="color:#000;font-weight:600">Black</font> are classes you are enrolled 
		in.
		</p>
	</div>
	<div class="about_groups">
		<div class="about_groups_header">
			<h4>Groups</h4>
			<div class="close-btn">X</div>
			<div class="clear"></div>
		</div>
		<p>
			You can be in more than two groups, groups are meant to help you manage activities you 
			have with other codevated members.
		</p>
		<p>
			For instance you can be a contributer and also a project collaborator. In fact you can be a 
			collaborator and a contributor to more than one concept or item with different followers.
		</p>
		
		<p><h5>Stating point: select any of the two from the right top menu</h5>
			<img src="img/groups_starting_point.png"/>
		</p>
		<p>
			Groups in codevated are in two forms: collaborate or contribute. The branches they take depends on
			 the audience you have and the names you give them.
		</p>
	</div>
	<div class="add-cartegory">
		<div class="header">
			<h3>Add Cartegories</h3>
			<div class="close-btn">X Close</div>
			<div class="clear"></div>
		</div>		
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			<p>
				Choose cartegories below, based on your interests. You can choose multiple items.
			</p>
			<div class="cartegory-group">
			<?php
				$sql = "SELECT * FROM interest_cartegory ORDER BY cartegory_name ASC";
				$query = mysql_query($sql) or die(mysql_error());	
				
				while($row = mysql_fetch_array($query)){
					if($func->checkIfItsUserInterest($user,$row['interest_cartegory_id']) == true){
						
					}else{
						echo "
							<div class='cartegory-item'>
								<div class='img'><img src='".$row['cartegory_icon']."'/></div>
								<div class='choice'>
									<span>".$row['cartegory_name']."</span>				
									<input name='cartegory[]' type='checkbox' value='".$row['interest_cartegory_id']."'/>								
									</div>
							</div>						
						";
					}
				}
			?>								
				<div class="clear"></div>
			</div>			
			<input type="submit" value="Submit Selection" name="submit-cartegory"/>
		</form>
	</div>
<div class="interests">
            <div class="left-aside">
				<div class="interest-cart">
					<div class="interest-cart-header">
						<h4>Interests <span><?php echo $userTotalInterest;?></span></h4>
						<div class="add-btn">
							<a href="#" class="addCarteg">+ Add</a>
						</div>
					</div>
					<div class="interest-cart-content">
						<?php
							if($userTotalInterest > 0){
								$func->getUserInterestList($user);
							}else{
								echo "<p>You have not added any interests you have so far!</p>";
							}							
						?>
					</div>
                    <div class="interest-cart-content-footer">
                        <ul>
                            <?php
                                $total = $userTotalInterest-6;
                                
                                if($total <= 0){
                                    $total = 0;
                                echo "<li>".$total." items hidden</li>
                                <li></li>";
                                } else{
                                echo "<li>".$total." items hidden</li>
                                <li>
                                    <a href='#' class='unhide'>Show</a>
                                </li>";
                                }    
                            ?>
                        </ul>
                    </div>
				</div>
                <div class="discussion-tab">
                    <div class="discussion-tab-header">
                        <h4>Discussions</h4>
                        <div class="unhide">
                            <a href="discussions.php">Page</a></div>
                    </div>
                    <div class="discussion-tab-content">
                        <ul>                            
                            <li>
                                The best business models to adopt when running an IT consulting business with industrial examples 
                                <div class="list-item-footer">
                                    <ul>
                                        <li>
                                            <img src="img/participants.png"/>    0                     
                                        </li>
                                        <li>
                                            <img src="img/watched_dark.png"/>   0                      
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                The best business models to adopt when running an IT consulting business with industrial examples 
                                <div class="list-item-footer">
                                    <ul>
                                        <li>
                                            <img src="img/participants.png"/>   0                    
                                        </li>
                                        <li>
                                            <img src="img/watched_dark.png"/>   0                      
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
				<div class="interest-content">
					<div class="groups">
					
						<div class="group-notice">
							<?php
								if($userGroupTotal > 0){
									echo "
										<div class='open-group'>Your Circles</div>
									";
								}else{
									echo "
										You have not joined any circles yet, 
										<span><a href='#' class='about_feature_group'>Learn about circles</a></span>
									";
								}
							?>						
						</div>						
						<div class="groups-content">
							<div class="groups-content-header">
								<h4>Your circles</h4>
								<div class="close-btn">
                                    <a href="#">- minimize</a>
                                </div>				
							</div>
							<div class="circle-data">
                                <?php
                                    $func->getUserCircles($user);
                                ?>
                            </div>
							<div class="clear"></div>						
						</div>
					</div>
					
					<div class="posts">
						<div class="group-notice">
							<?php
								if($userTotalInterest > 0){
									echo "<div class='open-posts'>
											Latest Posts
										</div>";
								}else{
									echo "
									You have not added your interests yet, 
									<span><a href='#' class='about_feature_interests'>Learn about interests</a></span>
									";
								}
							?>							
						</div>
					
						<div class="posts-content">
							<div class="posts-content-header">
								<h4>Latest Posts</h4>
								<div class="close-btn"><a href="#">- minimize</a></div>								
							</div>
							<div class="interest-latest-posts">                      <div class="wait-loading">Wait loading data...</div>
                            </div>
							
						</div>						
					</div>
					<div class="activities">
						<div class="group-notice">
							<div class="open-activities">
								Recent Activities
							</div>
						</div>						
						<div class="activities-content">
							<div class="activities-content-header">
								<h4>Recent Activities</h4>								
							</div>
							<?php 
								$func->getUserActivity($user);
							?>			
						</div>
						
					</div>
					
				</div>
			</div>
            <div class="right-aside">
                <div class="suggestions">
                    <div class="suggestions-header">
                        <h4>Suggested mentors:</h4>
                    </div>
                    <div class="suggestions-content">
                        <?php
                            $func->getMentorSuggestionsForUser($user);
                        ?>							
                    </div>
                    <div class="suggestions-footer">
                        <ul>
                            <li><a href="mentor.php">Find a mentor</a></li>
                            <li><a href="#">Refresh</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mentor-chat">
                    <h4>Chat</h4>
                    <div class="mentor-chat-content">
                        <ul>
                            <li>
                                <a href=""><img src="img/mentor.png"/> Jack Oyoo</a>
                                <span>
                                    <img src="img/chat_grey.png"/> idle
                                </span>
                            </li>
                            <li>
                                <a href=""><img src="img/mentor.png"/> Jack Oyoo</a>
                                <span>
                                    <img src="img/chat_red.png"/> busy
                                </span>
                            </li>
                            <li>
                                <a href=""><img src="img/mentee.png"/> Jack Oyoo</a>
                                <span>
                                    <img src="img/chat_grey.png"/> idle
                                </span>
                            </li>
                            <li>
                                <a href=""><img src="img/mentor.png"/> Jack Oyoo</a>
                                <span>
                                    <img src="img/chat_red.png"/> busy
                                </span>
                            </li>
                            <li>
                                <a href=""><img src="img/mentee.png"/> Jack Oyoo</a>
                                <span>
                                    <img src="img/chat_green.png"/> active
                                </span>
                            </li>
                            <li>
                                <a href=""><img src="img/mentor.png"/> Jack Oyoo</a>
                                <span>
                                    <img src="img/chat_red.png"/> busy
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
			
<?php
	require_once("template/user_footer.inc");			
?>

