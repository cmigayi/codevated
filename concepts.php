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
	width:79%;
	margin-left:1%;
    float:left;
    border:solid 0.1em #eaeaea;
	border-radius:5px 5px 0px 0px;
	padding:1%;
	background:#fcfcfc;
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
	border:#ddd solid 0.1em;
    border-radius:5px;
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
