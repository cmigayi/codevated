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
.discussions{
	width:79%;
	margin-left:1%;
	padding:1%;
    float:left;
    background:#fff;
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
.discussions-header .start-a-discussion-btn{
	text-align:center;
	padding:2%;
	border:#ccc solid 0.1em;
	background:#e3e4e5;
	border-radius:4px;
}
.discussions-header .start-a-discussion-btn a{
	color:#000;
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
	<div class="start-a-discussion-btn">
		<a href="discussion_create.php">Start a discussion</a>
	</div>
	<div class="discussion-item">
		<table>
			<tr><th>Topic</th><th>Cartegory</th><th>Participants</th><th>Views</th><th>Last Post</th></tr>
			<tr><td>Application of AI in Kenya or Africa <div class="you-took-part-btn"><a href="">You took part <img src="img/tick.png"/></a></div></td><td>AI</td><td><img src="img/hireus.png"/><img src="img/mascot2.png"/><img src="img/mascot.png"/></td><td>120</td><td>31 Dec</td></tr>			
			<tr><td>The best business models to adopt when running an IT consulting business with industrial examples <div class="take-part-btn"><a href="">Take part</a></div></td><td>IT, Business</td><td><img src="img/hireus.png"/><img src="img/mascot2.png"/><img src="img/mascot.png"/></td><td>120</td><td>31 Dec</td></tr>			
		</table>
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
