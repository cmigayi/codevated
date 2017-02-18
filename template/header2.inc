<!DOCTYPE html>
<html>
    <head>
        <title>codevated.com</title>
		<!-- App css -->
		
		<link rel="shortcut icon" href="" />
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>	
		
		<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>		
		
		
		  <script type="text/javascript">			
			$(document).ready(function(){
				 document.onkeydown=function(evt){
					var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
					if(keyCode == 13){
					    //your function call here
					    document.test.submit();
					}
				    }

				$('.btn').click(function(){
					$('.dark-cover').css("display","none");
					$('.notify').css("display","none");
					event.preventDefault();
				});

				$('.online-chat .online a').click(function(){
					$('.dark-cover').fadeIn(1000).css("display","block");
					$('.people-online').css("display","block");
					event.preventDefault();
				});

				$('.chat-btn a').click(function(){
					$('.dark-cover').css("display","none");
					$('.people-online').css("display","none");
					$('.chat-content').fadeIn(1000).css("display","block");
					event.preventDefault();
				});
				
				$('.profile-pic-btn').hover(function(){
					$('.profile-popup-menu').css("display","block");
					event.preventDefault();
				});

				$('.dark-cover').click(function(){
					$('.dark-cover').css("display","none");
					$('.people-online').css("display","none");
				});				

				$('html').click(function(){
					//$('.dark-cover').css("display","none");
					$('.profile-popup-menu').css("display","none");
					//$('.people-online').css("display","none");
					//event.preventDefault();
					event.stopPropagation();
				});
				$('.collapse-chat-btn').click(function(){
					$('.chat-content').fadeIn(1000).css("display","none");
					$('.collapse-expand-chat-btn').
					html("<span class='expand-chat-btn'><img src='img/expand.png'/></span>");
				});

				$('.expand-chat-btn').click(function(){
					$('.chat-content').fadeIn(1000).css("display","block");
					$('.collapse-expand-chat-btn').
					html("<span class='collapse-chat-btn'><img src='img/collapse.png'/></span>");
				});			
			});
			
			
		  </script>
			
		<style>
			body{
				background:#F5F5F5;
			}
			header,.content,footer{display:block;}
			header{
				width:100%;
				margin-top:0px;
				padding:0.5%;
				border-bottom:solid 0.1em #D6D6D6;
				border-width:1px;
				background:#F2F2F2;
				position:fixed;
				z-index:1000;
			}
			.logo{				
				width:4%;				
				margin-left:0%;
				float:left;
			}
			.logo img{
				width:100%;
			}
			.other-links{
				float:left;
				width:100%;
				margin-top:0.3%;;
			}
			.other-links ul{
				list-style:none;
				margin:0px;
				padding:0px;
			}
			.link1{
				float:left;
				width:48%;
				padding:0.5%;	
			}
			.link1 li{
				margin-left:3%;
				width:30%;
				display:inline;
				text-align:center;
			}
			.link1 li a{	
				color:#3B3B3B;
				font-weight:600;
				font-size:13px;
			}
			.link1 li a img{
				width:3%;
				margin-bottom:2px;
			}
			.link1 li a:hover{
				color:#4772b7;
				text-decoration:none;
			}
			.link1 li .current{
				opacity:0.3;
				text-decoration:none;
			}
			.online-chat{
				float:left;
				width:10%;
				margin-left:29%;
				text-align:center;
				padding:0.5%;
			}
			.online-chat img{
				width:20%;
				margin-bottom:2px;
			}
			.online-chat .online a {
				color:#27ae60;
				font-size:13px;
				font-weight:600;
			}
			.online-chat .online a:hover{
				text-decoration:none;
				color:#27ae60;
			}
			.online-chat .offline a {
				font-size:1.1em;
				color:#3B3B3B;
				font-weight:600;
				font-size:13px;
			}
			.link2{
				width:10%;
				margin-left:90%;
			}
			.link2 li{
				margin-left:10%;
				width:35%;
				float:left;	
			}
			.link2 li a{
				color:#000;	
				text-decoration:none;
				font-size:10px;
			}
			.link2 li a:hover{
				text-decoration:none;	
				opacity:0.4;
			}
			.link2 li a:active{
				text-decoration:none;
				opacity:0.4;
			}
			.link2 li a:visited{
				text-decoration:none;
				opacity:0.4;
			}
			.link2 li .current{
				opacity:0.3;
				text-decoration:none;
			}
			.link2 img{
				width:60%;
			}
			.clear{
				clear:both;
			}
			.error{
				background:#FFE9E6;
				padding:1%;
				border-radius:1px;
				width:80%;
				margin-left:10%;
				margin-top:5px;
				text-align:center;
			}
			.dark-cover{
				width:100%;
				height:100%;
				background:#000;
				opacity:0.9;
				z-index:1001;
				position:fixed;
				display:none;
			}
			.tip{
				width:100%;
				padding:2%;
				border-radius:5px;
				border:#eaf1fc solid 0.1em;
				color:#555656;
				background:#eaf1fc;
				margin-bottom:2%;
			}
			.tip p{
				float:left;				
				width:80%;
			}
			.tip span{
				font-weight:600;
			}
			.tip-btn{
				width:15%;
				margin-left:85%;
				border:#4eba44 solid 0.1em;
				border-radius:5px;
				background:#4eba44;
				padding:0.5%;
				text-align:center;
				font-weight:600;
			}
			.tip-btn a{				
				color:#fff;
			}
			.notify{
				z-index:1001;
				position:absolute;
				left:30%;
				top:30%;
				width:100%;
				display:none;
			}
			.notify img{
				width:4%;
				margin-left:17%;
			}
			.notify .notify-info{
				background:#fff;
				padding:1%;
				width:40%;				
				border-radius:3px;
			}
			.general-icon{
				width:2%;
			}
			.activity-icon{
				width:2%;
			}
			.activity-date{
				font-size:12px;
				color:#ADADAD;
			}
			.interest-home-icon{
				width:100%;
			}
			.btn{
				background:#609ADB;
				padding:1%;
				width:30%;
				border-radius:1%;
				text-align:center;
				margin-left:33%;
				border-radius:3px;
			}
			.btn a{
				color:#fff;				
			}
			.btn a:hover{
				text-decoration:none;				
			}
			.content{
				padding-top:2%;
				padding-bottom:5%;
				width:100%;
				background:#fcfcfc;
				position:absolute;
				top:6%;
			}
			.interests{
				float:left;
				width:78%;
				padding:1%;
			}
			.interest-cart{
				float:left;
				width:23%;
				border:solid 0.1em #eaeaea;
				border-radius:3px 3px 0px 0px;
			}
			.interest-cart-header{
				border-bottom:solid 0.1em #D6D6D6;
				background:#F2F2F2;
				width:100%;
				padding:2%;
			}
			.interest-cart-header h4{
				float:left;
				width:55%;
				margin-top:5px;
				text-align:left;
				font-size:14px;
				font-weight:600;
				color:#000;
			}
			.interest-cart-header h4 span{
				background:#7a7a7a;
				padding:2%;
				border-radius:3px;
				font-weight:500;
				color:#fff;
				font-size:12px;
			}
			.interest-cart-header .add-btn{
				margin-left:60%;
				width:40%;
				border:#71C951 solid 0.1em;
				background:#8BDE6D;
				border-radius:2px;
				padding:0.5%;
				text-align:center;
			}
			.interest-cart-header .add-btn a{
				color:#fff;				
				font-weight:600;
				font-size:13px;
				text-decoration:none;
			}
			.interest-cart-content{
				background:#fcfcfc;
				padding:1%;
				width:100%;
				border-radius:0px 0px 3px 3px;
			}
			.interest-cart-content p{
				padding:2%;
				width:100%;
			}
			.interest-cart-content ul{
				list-style:none;
				margin-right:15%;
				margin:0px;
				padding:0px;
			}
			.interest-cart-content li{
				padding:0.5%;
				border-bottom:#DBDBDB solid 0.1em;
				margin-bottom:1%;
			}
			.interest-cart-content li:hover{
				background:#DBDBDB;
			}
			.interest-cart-content li a{
				color:#242424;
				font-size:12px;
				font-weight:600;
				width:75%;
				float:left;
			}
			.interest-cart-content li a img{
				width:10%;
			}
			.interest-cart-content li a:hover{
				color:#fff;
				text-decoration:none;
			}
			.interest-cart-content li:last-child{
				border-bottom:#fcfcfc solid 0.1em;
			}
			.interest-cart-content li .remove-item{
				width:20%;
				margin-left:90%;
			}
			.interest-cart-content li .remove-item img{
				width:50%;
			}
			.interest-cart-content li .remove-item img:hover{
				opacity:0.9;
				background:#fff;
			}
			.interest-cart-content li .item-posts-total{
				color:#bcbcbc;
				font-size:11px;
				text-align:left;
			}
			.interest-content{
				width:77%;
				margin-left:25.5%;
				border:solid 0.1em #eaeaea;
				border-radius:3px 3px 0px 0px;
				padding:1%;
			}
			.interest-content h4{
				margin-top:0px;
			}
			.interest-content .interest-content-data:last-child{
				border-bottom:none;
			}
			.interest-content .interest-content-data{
				margin-top:10px;
				padding:1%;
				border-bottom:#eee dotted 0.1em;
				overflow:auto;				
			}
			.interest-content .interest-content-data:hover{}
			.interest-content .interest-content-data a{
				text-decoration:none;
				color:#3c3c3d;
				font-size:14px;
			}
			.interest-content-data-div{
				float:left;
				width:85%;
			}
			.interest-content-data p {
				margin-top:0px;
				margin-bottom:0px;
				font-size:15px;
			}
			.interest-content-data .tut-type{
				font-weight:600;
				font-size:14px;
				color:#000;
			}
			.interest-content-data .more-info{
				width:10%;
				padding:1%;
				margin-left:90%;
				background:#CFCFCF;
				text-align:center;
			}
			.interest-content-data .more-info img{
				width:30%;
				float:left;
			}
			.interest-content-data .more-info span{
				font-size:12px;
				color:#000;
				margin-left:4%;
				font-weight:600;
			}
			.interest-content .post-info{
				margin-top:0px;
				color:#A6A6A6;
				font-size:12px;
			}
			.interest-content .post-info a{
				font-size:12px;
				color:#a4a4a5;
				text-decoration:underline;
			}			
			.profile-popup-menu {
				display: none;
				width:13%;
				background:#fff;
				border:#ddd solid 0.1em;
				border-radius:5px;
				position: absolute;
				right: 1%;
				top:7%;
				padding:0.5%;
				margin: 0;
				margin-top: 3px;
				text-align: left;
				z-index:1001;
			}
			.profile-popup-menu h4{
				font-size:14px;
				text-align:center;
				border-bottom:#eee solid 0.1em;
				margin:0;
				padding:2%;
				margin-bottom:10px;
			}
			.profile-popup-menu h4 span{
				font-weight:600;
				text-transform:capitalize;
			}
			.profile-popup-menu ul{
				list-style:none;
				padding:0px;
				margin:0px;
			}
			.profile-popup-menu li{
				margin-bottom:7px;
			}
			.profile-popup-menu li:hover{
				background:#4298f4;
				text-decoration:none;
				color:#fff;
				cursor:pointer;
			}
			.profile-popup-menu li:last-child{
				border-bottom:#fff solid 0.1em;	
				padding:0.5%;
			}
			.profile-popup-menu li a{
				color:#000;
				font-size:14px;
			}
			.profile-popup-menu li a:hover{
				text-decoration:none;
				color:#fff;
			}
			.profile-popup-menu .closer{
				font-size:15px;
				text-align:center;
				border-top:#eee solid 0.1em;
				margin:0;
				padding:1%;
			}
			.chat{
				border:#ccc solid 0.1em ;
				border-top:none;
				border-radius:2px 2px 0px 0px;
				background:#fff;
				position:fixed;
				width:20%;
				z-index:10;
				bottom:0%;
				right:0.5%;
			}
			.chat .chat-header{
				border:#6c6c6d solid 0.1em ;
				background:#6c6c6d;
				padding:3%;
				width:100%;
			}
			.chat .chat-header .left{
				float:left;
				width:10%;
				color:#fff;
			}
			.chat .chat-header .left h4{
				margin-bottom:0px;
				margin-top:0px;
				font-size:15px;
				font-weight:600;
			}
			.chat .chat-header .center{
				float:left;
				width:45%;
				margin-left:15%;
				text-align:center;
			}
			.chat .chat-header .center a{
				color:#fff;
			}
			.chat .chat-header .right{
				width:20%;
				margin-left:80%;
			}
			.chat .chat-header .right ul{
				margin:0px;
				padding:0px;
			}
			.chat .chat-header .right li{
				display:inline;
				margin-left:5%;
				width:40%;
			}
			.chat .chat-header .right li span{}
			.chat .chat-header .right li span img{
				width:30%;
			}
			.chat .chat-content{
				width:100%;
				display:none;
				background:#EBEBEB;
			}
			.chat .chat-content form{
				width:100%;
			}
			.chat .chat-content form textarea{
				width:100%;
				padding:1%;
				height:70px;
				border-radius:2px;
				border-top:#ccc solid 0.1em ;
				border-left:none;
				border-right:none;
				border-bottom:none;
			}
			.chat-message{				
				height:300px;
				overflow:auto;
			}
			.chat-message-div{
				padding:2%;
			}
			.chat-message-div .chat-user{
				float:left;
				width:15%;
				border-radius:20px;
				border:#EBEBEB solid 0.1em;				
			}
			.chat-message-div .chat-user img{
				width:100%;
			}
			.chat-message-div .chat-reply{
				margin-left:20%;
				width:80%;
				padding:2%;
				border-radius:5px;
				background:#fff; 
				border:#EBEBEB solid 0.1em;				
			}
			.chat-message-div .chat-reply-you{
				margin-left:20%;
				width:80%;
				padding:2%;
				border-radius:5px;
				background:#D5E0E3; 
				border:#EBEBEB solid 0.1em;				
			}
			.chat .chat-bottom{
				border:#76DB51 solid 0.1em ;
				background:#76DB51;
				padding:1%;
				width:100%;
			}
			.chat .chat-bottom .chat-exit{
				text-align:center;
				width:40%;
				margin-left:30%;
			}
			.chat .chat-bottom .chat-exit a img{
				width:15%;
			}
			.chat .chat-bottom .chat-exit a{
				color:#fff;
			}
			.people-online{
				display:none;
				width:20%;
				padding:1%;
				top:6%;
				left:75%;
				position:absolute;
				z-index:1005;				
			}
			.people-online-header{
				border-bottom:#5C5C5C solid 0.1em ;
				background:#5C5C5C;
				width:100%;
				padding:1%;
				border-radius:3px 3px 0px 0px;
				color:#fff;
				text-align:center;
				font-weight:600;
				margin-bottom:0px;
			}
			.people-online-content{
				background:#fff;
			}
			.people-online-content-item{
				border-bottom:#ccc solid 0.1em ;
				padding:1%;
			}
			.people-online-content-item-img{
				float:left;
				width:30%;	
			}
			.people-online-content-item-img img{
				width:100%;	
			}
			.people-online-content-item-det{
				width:60%;
				margin-left:35%;
				font-size:13px;
			}
			.people-online-content-item-det h4{
				font-size:13px;
				margin-top:0px;
				margin-bottom:0px;
			}
			.people-online-content-item-det p{
				font-size:13px;
				margin-top:0px;
				margin-bottom:0px;
			}
			.chat-btn{
				border-bottom:#76DB51 solid 0.1em ;
				background:#76DB51;
				width:100%;
				padding:1%;
				border-radius:1px;
				text-align:center;
			}
			.chat-btn a{
				color:#fff;
				text-decoration:none;
			}
			.bottom-color-bar{
				width:100%;
				margin-top:0px;
				margin-bottom:0px;
				color:#515251;
				text-align:center;
			}
			footer{
				border-top:#E8E8E8 0.1em solid;				
				width:100%;
				padding:7px;
				font-size:12px;
				margin-top:5%;
			}
			footer p{
				margin-bottom:0px;
				margin-top:5px;
				text-align:center;
			}
			footer ul{
				list-style:none;
				margin-bottom:0px;
				margin-top:0px;
				margin-left:36%;
			}
			footer li{
				display:inline;
				margin-left:1%;
				text-align:center;
			}
			footer li a{
				font-weight:600;
				color:#515251;
			}			
		</style>
		</head>
    <body>
	<?php
		if(!empty($userChatData['username'])){
			echo"
				<script>
					$(document).ready(function(){
						$('.dark-cover').css('display','none');
						$('.people-online').css('display','none');
						$('.chat-content').fadeIn(1000).css('display','block');
						event.preventDefault();
					});
				</script>
			";
		}	
	?>
		<div class="dark-cover"></div>
		<div class="people-online">
			<div class="people-online-header">People online</div>
			<div class="people-online-content">
				<?php
					$func->displayOnlineUsersOnPopup();
				?>
			</div>
		</div>
		<div class="chat">
			<div class="chat-header">
				<div class="left">
					<h4>Chat</h4>
				</div>
				<div class="center">
					<a href="">
					<?php
						echo $userChatData['username']; 
					?>
					</a>
				</div>
				<div class="right">
					<ul>
						<li class="collapse-expand-chat-btn">
							<span class="expand-chat-btn"><img src="img/expand.png"/></span>
						</li>
						<li class="maximize-minimize-chat-btn">
							<span href="#" class="maximize-minimize-chat-btn"><img src="img/maximize.png"/></span>
						</li>
					</ul>				
				</div>
			</div>
			<div class="chat-content">
				<div class="chat-message">
					<div class="chat-message-div">
						<div class="chat-user">you</div>
						<div class="chat-reply-you">
							hi
						</div>
					</div>
					<div class="chat-message-div">
						<div class="chat-user">
							<img src="img/female_user.png"/>						
						</div>
						<div class="chat-reply">
							hi, dsdsa sdsad dsad dsad dsa dsad
dsdssd dsadas sadsad dsad dsad dsad dsa dsadsa sadsa dsad sadsad.
						</div>
					</div>
					<div class="chat-message-div">
						<div class="chat-user">you</div>
						<div class="chat-reply-you">
							hi
						</div>
					</div>
					<div class="chat-message-div">
						<div class="chat-user">
							<img src="img/female_user.png"/>						
						</div>
						<div class="chat-reply">
							hi, dsdsa sdsad dsad dsad dsa dsad
dsdssd dsadas sadsad dsad dsad dsad dsa dsadsa sadsa dsad sadsad.
						</div>
					</div>
					<div class="chat-message-div">
						<div class="chat-user">you</div>
						<div class="chat-reply-you">
							hi
						</div>
					</div>
					<div class="chat-message-div">
						<div class="chat-user">
							<img src="img/female_user.png"/>						
						</div>
						<div class="chat-reply">
							hi, dsdsa sdsad dsad dsad dsa dsad
dsdssd dsadas sadsad dsad dsad dsad dsa dsadsa sadsa dsad sadsad.
						</div>
					</div>
					<div class="chat-message-div">
						<div class="chat-user">you</div>
						<div class="chat-reply-you">
							hi
						</div>
					</div>
				</div>
				<form name="test" method="post">
					<textarea name="chat" placeholder="Say sth.."></textarea>
				</form>				
				<div class="chat-bottom">
					<div class="chat-exit">
						<a href=""><img src="img/exit.png"/> Leave chat</a>
					</div>
				</div>			
			</div>
		</div>
		<div class="profile-popup-menu">
			<h4>Signed in as <span><?php echo $_SESSION['username'];?></span></h4>
			<ul>
				<li><a href="profile.php">Your profile</a></li>
				<li><a href="">Help</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>		
		<header>
			<div class="other-links">
				<div class="link1">
					<ul>
					<li><a href="home.php"><img src="img/home.png"/>  Home</a></li>
					<li><a href="concepts.php"><img src="img/concept.png"/> Concepts</a></li>
					<li><a href="discussions.php"><img src="img/discussion.png"/> Discussions</a></li>
					<li><a href="circles.php"><img src="img/circles.png"/> Circles</a></li>
					<li><a href="mentor.php"><img src="img/mentor.png"/> Mentor</a></li>
					<li><a href="mentee.php"><img src="img/mentee.png"/> Mentee</a></li>
					</ul>
				</div>
			<div class="logo">
				<a href="home.php"><img src="img/logo.png"/></a>
			</div>
				<div class="online-chat">
					<?php
						if($func->checkUserOnline($user) == 0){
							echo "<div class='offline'>
								<img src='img/offline.png'/> Offline
</div>";
						}else{
							echo "<div class='online'>
								<a href='#'><img src='img/online2.png'/> ". $func->checkUserOnline($user)." online</a>
							</div>";
						}
					?>
					
				</div>
				<div class="link2">
					<ul>					
					<li><a href="" title="Notification"><img src="img/notify2.png"/></a></li>
					<li>
						<a href="#" class="profile-pic-btn" title="Account">
							<?php $func->displayGenderIcon($user);?>
						</a>
					</li>
					</ul>					
				</div>				
				<div class="clear"></div>
			</div>			
			<div class="clear"></div>
		</header>
		<div class="content">
			
