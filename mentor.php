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
	.mentor-page{
		width:79%;
        margin-left:1%;
        float:left;
        border:solid 0.1em #eaeaea;
        border-radius:5px 5px 0px 0px;
        padding:1%;
        background:#fcfcfc;
	}
	.mentor-page-header{
		width:90%;
        margin-left: 5%;
		margin-bottom:2%;
	}
	.find-by-username{		
		float:left;
		width:55%;
	}
	.find-by-username h4{
		float:left;
		width:25%;
		margin-top:5px;	
	}
	.find-by-username form{
		margin-left:26%;
		width:74%;
	}
	.find-by-username input[type="text"]{
		width:100%;
		padding:1%;
		border:#ccc solid 0.1em;
		border-radius:4px;
	}	
	.find-by-interest{
		width:35%;
		margin-left:65%;
	}
	.find-by-interest select{
		width:100%;
		padding:1%;
		background:#76DB51;
		color:#fff;
		border:#76DB51 solid 0.1em;
	}
	.find-by-interest select:hover{
		padding:1%;
		background:#e3fce0;
		color:#000;
		border:#e3fce0 solid 0.1em;
		cursor:pointer;
	}
	.mentor-page-content{
		width:90%;
        margin-left: 5%;
		border:#eee solid 0.1em;
		border-radius:5px;
	}
	.mentor-page-content-header{
		background:#ededed;
		border:#ccc solid 0.1em;
		border-radius:2px 2px 0px 0px;
		padding:1%;
		color:#000;
		width:100%;
	}
	.mentor-page-content-header h4{
		margin-top:0px;
		margin-bottom:0px;
		font-size:14px;
	}
	.mentor-page-content-content{
		padding:2%;
	}
	.mentor-page-content .mentor{
		float:left;
		width:18%;
		height:200px;
		margin:1%;
		border:#ddd solid 0.1em;
		border-radius:2px;
		padding:1%;
	}
	.mentor-page-content .mentor .mentor-img{
		width:90%;
		margin-left:5%;
		height:120px;
		overflow:hidden;
		margin-bottom:0px;
	}
	.mentor-page-content .mentor .mentor-img img{
		width:100%;
		border-radius:2px;
		border:none;

	}
	.mentor-page-content .mentor .mentor-det{
		width:98%;
		margin-left:1%;
		margin-top:0px;
		padding:1%;				
	}
	.mentor-page-content .mentor .mentor-det .username{
		text-align:center;
		font-size:13px;	
		height:20px;
		overflow:hidden;				
	}
	.mentor-page-content .mentor .mentor-det .username a{
		color:#67d15c;				
	}
	.mentor-page-content .mentor .mentor-det .profession{
		text-align:center;
		font-size:13px;	
		height:20px;
		overflow:hidden;						
	}
	.mentor-page-content .mentor .mentor-det .add-mentor-btn{
		width:98%;
		margin-left:1%;
		padding:1%;
		background:#67d15c;
		border:#67d15c solid 0.1em;
		text-align:center;
		border-radius:1px;						
	}
	.mentor-page-content .mentor .mentor-det .add-mentor-btn img{
		width:10%;
		padding-bottom:1%;
	}
	.mentor-page-content .mentor .mentor-det .add-mentor-btn a{
		color:#fff;
		font-weight:600;						
	}
	.mentor-page-content .mentor .mentor-det .add-mentor-btn a:hover{
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
	.suggestions .add-mentor-div:last-child{
		border-bottom:none;
	}			
	.suggestions .add-mentor-div{
		width:100%;
		margin-bottom:4%;
		padding:1%;
		padding-bottom:3%;
	}
	.suggestions .add-mentor-div-left{
		float:left;
		width:30%;	
	}	
	.suggestions .mentor-img{
		float:left;
		width:80%;
		border-radius:10px;
        border: #eee solid 0.1em;
        background: #eee;
		overflow:hidden;		
	}
	.suggestions .mentor-img img{
		width:100%;
		margin-left:0%;
	}
	.suggestions .add-mentor-div-right{
		margin-left:32%;
		width:68%;
	}
	.suggestions .add-mentor-div-right-top{
		width:100%;	
	}
	.suggestions .add-mentor-div-right-top h4{
		width:80%;
		float:left;
		color:#3B3B3B;
		font-weight:600;
		font-size:13px;
		margin-top:0px;
		margin-bottom:0px;	
	}
	.suggestions .add-mentor-div-right-top .mentor-rating{
		width:20%;
		margin-left:80%;
		border-radius:1px;
	}
    .suggestions .mentor-rating img{
		width:45%;
        float:left;
	}	
	.suggestions .mentor-rating .rating-text{
		width:50%;		
		margin-left:50%;
		font-size:12px;
		color:#000;
		font-weight:600;
	}
	.suggestions .add-mentor-div-right p{
		margin-top:0px;
		margin-bottom:0px;
		font-size:12px;
	}	
	.suggestions .add-mentor-div-right-bottom{}
	.suggestions .add-mentor-btn{
		background:#eee;
		border:#ccc solid 0.1em;
		border-radius:5px;
		padding:1%;
		text-align:center;
		width:50%;
		margin-left:30%;
		font-size:12px;
	}
	.suggestions .add-mentor-btn a{
		color:#3B3B3B;
		font-weight:600;
		font-size:13px;
	}
	.suggestions .add-mentor-btn a:hover{
		text-decoration:none;
	}
	.suggestions .add-mentor-btn a img{
		width:15%;
	}
    .suggestions .interest-latest-posts{
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
<div class="mentor-page">
	<div class="mentor-page-header">		
		<div class="find-by-username">
			<h4>Find a mentor</h4>
			<form>				
				<input name="" type="text" placeholder="Find by mentor username"/>
			</form>
		</div>
		<div class="find-by-interest">
			<form>
				<select name="interest">
					<option>Find a mentor by interest</option>
				</select>
			</form>
		</div>		
	</div>
	<div class="mentor-page-content">
		<div class="mentor-page-content-header">
			<h4>Result found</h4>
		</div>		
		<div class="mentor-page-content-content">			
			<div class="mentor">
				<div class="mentor-img">
					<img src="img/female_user.png"/>
				</div>
				<div class="mentor-det">
					<div class="username">
						<a href="">Cilo</a>
					</div>
					<div class="profession">
						Software developer
					</div>
					<div class="add-mentor-btn">
						<a href=""><img src="img/add-mentor-white.png"/> add mentor</a>
					</div>
				</div>
			</div>
			
			<div class="mentor">
				<div class="mentor-img">
					<img src="img/female_user.png"/>
				</div>
				<div class="mentor-det">
					<div class="username">
						<a href="">Cilo</a>
					</div>
					<div class="profession">
						Software developer
					</div>
					<div class="add-mentor-btn">
						<a href=""><img src="img/add-mentor-white.png"/> add mentor</a>
					</div>
				</div>
			</div>
			
			<div class="mentor">
				<div class="mentor-img">
					<img src="img/female_user.png"/>
				</div>
				<div class="mentor-det">
					<div class="username">
						<a href="">Cilo</a>
					</div>
					<div class="profession">
						Software developer
					</div>
					<div class="add-mentor-btn">
						<a href=""><img src="img/add-mentor-white.png"/> add mentor</a>
					</div>
				</div>
			</div>

			<div class="mentor">
				<div class="mentor-img">
					<img src="img/female_user.png"/>
				</div>
				<div class="mentor-det">
					<div class="username">
						<a href="">Cilo</a>
					</div>
					<div class="profession">
						Software developer
					</div>
					<div class="add-mentor-btn">
						<a href=""><img src="img/add-mentor-white.png"/> add mentor</a>
					</div>
				</div>
			</div>

			<div class="mentor">
				<div class="mentor-img">
					<img src="img/cilo.jpg"/>
				</div>
				<div class="mentor-det">
					<div class="username">
						<a href="">Cilo</a>
					</div>
					<div class="profession">
						php, c++, c#, android, java, python
					</div>
					<div class="add-mentor-btn">
						<a href=""><img src="img/add-mentor-white.png"/> add mentor</a>
					</div>
				</div>
			</div>

			<div class="clear"></div>
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
