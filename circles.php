<?php
	require_once("classes/function_class.php");	
	session_start();
	
	if(isset($_SESSION['user_id'])){
		$user = $_SESSION['user_id'];
	}else{
		header("Location: index.php");
	}

	$func = new FunctionClass();

    if(isset($_GET['c'])){
        $circle = $_GET['c'];
    }
	
	require_once("template/header2.inc");	
?>
<script>
$(document).ready(function() {
    $(".circles-tabs-menu li").click(function() {
        $(".circles-tabs-menu li").removeClass('current');
        $(this).addClass('current');
    });
    
     $('.circle-btns ul li:first-child').click(function(){       
        $.ajax({
            url:"join_circle.php",
            type:"POST",
            data:{'circle_id':1},
            success: function(result){ 
                alert(result);
                //$('.open-circle').load("open_circles.php").fadeIn(1000);
            },
            error: function(a,b,c){
                alert(error);
            }
        });
     });
       
    setInterval(function(){
        $('.open-circle').load("open_circles.php").fadeIn(1000);
    },1000);
});
</script>
<style>
.circle-content{
    width:79%;
    float:left;
    margin-left:1%;
    border:solid 0.1em #eaeaea;
	border-radius:5px 5px 0px 0px;
	padding:1%;
	background:#fcfcfc;
}
.circles-tabs{
	width:98%;
    margin-left:1%;
}
.circles-tabs ul{
	list-style:none;
	width:100%;
    margin-bottom:1%;
	padding:0px;
	padding-bottom:5px;
	border-bottom:#ddd solid 0.1em;
	border-width:3px;
}
.circles-tabs li:first-child{
	margin-left:0%;
}
.circles-tabs li:last-child{
	width:20%;
	margin-left:30%;
	padding:1%;
}
.circles-tabs li{
	display:inline;
	width:20%;
	margin-left:5%;
	padding:0.5%;
}
.circles-tabs li span{
	background:#e3e5e3;
	padding:0.2%;
	border-radius:10px;	
}
.circles-tabs li a{
	color:#000;
	outline:none;
    font-size:14px;
}
.circles-tabs li a:hover{
	text-decoration:none;
}
.circles-tabs li a:visited{
	text-decoration:none;
	color:#000;
}
.circles li a:active{
	text-decoration:none;
	color:#000;
}
.circle-tab-header{
	padding:1%;
	border:#ddd solid 0.1em;
    background: #fff;
	width:98%;    
    margin-left: 1%;
    margin-bottom:2%;
}
.circle-tab-header .find-by-name{
	float:left;
	width:50%;
}
.circle-tab-header .find-by-name h4{
	float:left;
	width:30%;
	margin-top:5px;
	font-size:15px;
}
.circle-tab-header .find-by-name form{
	margin-left:31%;
	width:55%;
}
.circle-tab-header .find-by-name form input[type="text"]{
	width:100%;
	border:#ddd solid 0.1em;
	padding:2%;
	border-radius:1px;
    font-size:13px;
}
.circle-tab-header .find-by-interest{
	margin-left:70%;
	width:30%;
}
.circle-tab-header .find-by-interest form{}
.circle-tab-header .find-by-interest form select{
	width:100%;
	padding:2%;
	background:#76DB51;
	color:#fff;
	border:#76DB51 solid 0.1em;
}
.find-by-interest select:hover{
	padding:2%;
	background:#e3fce0;
	color:#000;
	border:#e3fce0 solid 0.1em;
	cursor:pointer;
}
.circles-tabs .current{	
	border-bottom:#60605f solid 0.1em;
	border-width:5px;
}
.circles-tabs .current a{
	text-decoration:none;
	color:#000;
	font-weight:500;
}
#tabs-1,#tabs-2,#tabs-3{
	width:100%;
    background: #fff;
    padding: 1%;
}
.circles-item{
	float:left;
	margin:1%;
    padding:1%;
	width:48%;
	height:200px;
	background:#fff;
	border:#ddd solid 0.1em;
    border-radius:3px;
}
.circles-item:hover{
	background:#eee;
	border:#eee solid 0.1em;
}
.circles-item .circle-desc{
    margin-bottom: 2%;
}
.circles-item .circle-btns{
    margin-left:20%;
    width:80%;
}
.circles-item .circle-btns ul{
    list-style: none;
    padding: 0px;
    margin: 0px;
    border: none;
}
.circles-item .circle-btns li{
    float:left;
    background: #97b1fc;
    border:#97b1fc solid 0.1em;
    border-radius:1px;
    color:#fff;
    text-align:center;
    padding: 1%;
    width:30%;
    margin-left: 1%;
}
.circles-item .circle-btns li:last-child{
    background:#fff;
    border:#ccc solid 0.1em;
    color:#000;
}
.circles-item .circle-btns li:hover{
    cursor: pointer;
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
		width:100%;
		margin-bottom:4%;
		padding:1%;
		padding-bottom:3%;
	}
	.add-mentor-div-left{
		float:left;
		width:30%;	
	}	
	.mentor-img{
		float:left;
		width:80%;
		border-radius:10px;
        border: #eee solid 0.1em;
        background: #eee;
		overflow:hidden;		
	}
	.mentor-img img{
		width:100%;
		margin-left:0%;
	}
	.add-mentor-div-right{
		margin-left:32%;
		width:68%;
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
		width:20%;
		margin-left:80%;
		border-radius:1px;
	}
    .mentor-rating img{
		width:45%;
        float:left;
	}	
	.mentor-rating .rating-text{
		width:50%;		
		margin-left:50%;
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
		border-radius:5px;
		padding:1%;
		text-align:center;
		width:50%;
		margin-left:30%;
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
<div class="circle-content">
<div class="circles-tabs">
  <ul class="circles-tabs-menu">
  <li class="current"><a href="#tabs-1">Open <span><?php echo $func->getTotalCircles("Open");?></span></a></li>
	<li><a href="#tabs-2">Member <span>1100</span></a></li>
	<li><a href="#tabs-3">Your Circles <span>5</span></a></li>
	<li><a href="#tabs-4">What is a circle</a></li>
  </ul>
  <div id="tabs-1">
		<div class="circle-tab-header">
			<div class="find-by-name">
				<h4>Find circle by name:</h4> 
				<form>
					<input name="" type="text" placeholder="Find circle by name"/>
				</form>			
			</div>
			<div class="find-by-interest">
				<form>
					<select>
						<option>Find circle by interest</option>
					</select>
				</form>			
			</div>
		</div>
		<div class="open-circle">
		
		</div>
  </div>
  <div id="tabs-2">
      <div class="circle-tab-header">
			<div class="find-by-name">
				<h4>Find circle by name:</h4> 
				<form>
					<input name="" type="text" placeholder="Find circle by name"/>
				</form>			
			</div>
			<div class="find-by-interest">
				<form>
					<select>
						<option>Find by interest</option>
					</select>
				</form>			
			</div>
		</div>
		<div class="">		
		<?php
			//$func->getClassesInvite($user);
		?>
        </div>
  </div>
  <div id="tabs-3">
        <div class="circle-tab-header">
			<div class="find-by-name">
				<h4>Find circle by name:</h4> 
				<form>
					<input name="" type="text" placeholder="Find circle by name"/>
				</form>			
			</div>
			<div class="find-by-interest">
				<form>
					<select>
						<option>Find by interest</option>
					</select>
				</form>			
			</div>
		</div>
		<div class="">
		<?php
			$func->getUserCircles($user);
		?>
        </div>
  </div>
  <div id="tabs-4">
        <div class="circle-tab-header">
			<div class="find-by-name">
				<h4>Find circle by name:</h4> 
				<form>
					<input name="" type="text" placeholder="Find circle by name"/>
				</form>			
			</div>
			<div class="find-by-interest">
				<form>
					<select>
						<option>Find by interest</option>
					</select>
				</form>			
			</div>
		</div>
		<div class="">
		<?php
			//$func->getOtherClasses($user);
		?>
        </div>
  </div>
  <div class="clear"></div>
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
<script>
 $(function() {
    $( ".circles-tabs" ).tabs();
  });
</script>
<?php
	require_once("template/user_footer.inc");			
?>
