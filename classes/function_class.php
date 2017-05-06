<?php

	class FunctionClass{
		function __construct(){
			error_reporting(0);
			//mysql_connect("localhost","codevate_cilo","cilo123");
			//mysql_select_db("codevate_codevated");
			mysql_connect("localhost","root","");
			mysql_select_db("codevated");
		}
		
		function validateFormInput($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
		
		function userActivity($userid,$action,$who,$what){
			$sql = "INSERT INTO activity(user_id,action,who,what,dateTime) 
			VALUES('$userid','$action','$who','$what',NOW())";
			$query = mysql_query($sql)or die(mysql_error());
			
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		function getUserActivity($userID){
			$sql = "SELECT * FROM activity WHERE user_id = '$userID' ORDER BY dateTime DESC LIMIT 10";
			$q = mysql_query($sql)or die(mysql_error());
			
			echo "<ul>";
			while($row = mysql_fetch_array($q)){
				switch($row['action']){
					case "signup":
						echo "<li><img class='activity-icon' src='img/code.png'/> you joined codevated on <span class='activity-date'>".date('D, d-M-Y',strtotime($row['dateTime']))."</span> </li>";
					break;
					case "add interest":
						$data = $this->getInterestCartegoryItem($row['what']);
						echo "<li><img class='activity-icon' src='img/code.png'/> you added an interest <a href=''><img class='activity-icon' src='".$data['cartegory_icon']."'/> ".$data['cartegory_name']."</a>, <span class='activity-date'>".date('D, d-M-Y',strtotime($row['dateTime']))."</span> </li>";
					break;
					case "remove interest":
						$data = $this->getInterestCartegoryItem($row['what']);
						echo "<li><img class='activity-icon' src='img/code.png'/> you removed an interest <a href=''><img class='activity-icon' src='".$data['cartegory_icon']."'/> ".$data['cartegory_name']."</a>, <span class='activity-date'>".date('D, d-M-Y',strtotime($row['dateTime']))."</span> </li>";
					break;
					case "post concept":
						$data = $this->getConceptItem($row['what']);
						$cart = $this->getInterestCartegoryItem($data['interest_cartegory_id']);
						echo "<li><img class='activity-icon' src='img/concept.png'/> you posted a concept <a href=''>".$data['name']."</a>, <span class='activity-date'>".date('D, d-M-Y',strtotime($row['dateTime']))."</span> </li>";
					break;
				}								
			}
			echo "</ul>";
		}
		
		public function signup_github(){
			$client_id = '20b5ec98e0087847c3f9';
			$redirect_url = '';
			 
			//get request , either code from github, or login request
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
				//authorised at github
				if(isset($_GET['code'])){
					$code = $_GET['code'];
					 
					//perform post request now
					$post = http_build_query(array(
						'client_id' => $client_id ,
						'redirect_uri' => $redirect_url ,
						'client_secret' => '90c3eb2a65c0ffdd622ace844b2854210df60610',
						'code' => $code ,
					));
					 
					$context = stream_context_create(array("http" => array(
						"method" => "POST",
						"header" => "Content-Type: application/x-www-form-urlencodedrn" .
									"Content-Length: ". strlen($post) . "rn".
									"Accept: application/json" ,  
						"content" => $post,
					))); 
					 
					$json_data = file_get_contents("https://github.com/login/oauth/access_token", false, $context);
					 
					$r = json_decode($json_data , true);
					 
					$access_token = $r['access_token'];
					 
					$url = "https://api.github.com/user?access_token=$access_token";
					 
					$data =  file_get_contents($url);
					 
					//echo $data;
					$user_data  = json_decode($data , true);
					$username = $user_data['login'];
					 
					 
					$emails =  file_get_contents("https://api.github.com/user/emails?access_token=$access_token");
					$emails = json_decode($emails , true);
					$email = $emails[0];
					 
					$signup_data = array(
						'username' => $username ,
						'email' => $email ,
						'source' => 'github' ,
					);
					 
					$this->signUpUser($username,$email,"","");
				}else{
					$url = "https://github.com/login/oauth/authorize?client_id=$client_id&redirect_uri=$redirect_url&scope=user";
					header("Location: $url");
				}
			}
		}
		
		function signUpUser($username,$email,$password,$gender){
			$pwd = md5($password);
			$code = md5(uniqid(rand()));
			$sql = "INSERT INTO users (name,location,bio,username,email,password,phone,profImg,gender,codevatedTeam,userStatus,regCode,dateTime) 
			VALUES('none','none','none','$username','$email','$pwd','none','n','$gender','n','n','$code',NOW())";
			$query = mysql_query($sql)or die(mysql_error());
			$userid = mysql_insert_id(); 
			
			if($query){
				//$sendEmail = $this->sendNewUserActivationEmail($userid,$code,$email,$username);
				//if($sendEmail == true){
					$activity = $this->userActivity($userid,"signup","none","none");
					if($activity == true){
						return true;
					}else{
						return false;
					}
				//}else{
					//return false;
				//}								
			}else{
				return false;
			}
		}
		
		function sendNewUserActivationEmail($userID,$regCode,$email,$username){
			$key = base64_encode($userID);
			$id = $key;			
			$message = "     
			  Hello $username,
			  <br /><br />
			  Welcome to Codevated!<br/>
			  To complete your registration, just click following link<br/>
			  <br /><br />
			  <a href='http://www.codevated.com/verify.php?id=$id&code=$regCode'>Click HERE to Activate :)</a>
			  <br /><br />
			  Thanks,";			  
			$subject = "Confirm Registration";
			
			if($this->sendMail($email,$message,$subject) == true){
				return true;
			}else{
				return false;
			}			
		}

		function checkIfUserIsRegistered($username,$pwd){
			$pwd = md5($pwd);
			$sql = "SELECT * FROM users WHERE username='$username' AND password='$pwd'";
			$query = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_array($query);
			
			if(mysql_num_rows($query) == 1){
				return $row['user_id'];
			}else{
				return false;
			}
		}
		
		function getUserSignUpInfo($userID){
			$sql = "SELECT * FROM users WHERE user_id='$userID'";
			$query = mysql_query($sql) or die(mysql_error());
			
			return mysql_fetch_array($query);
		}
		
		function checkIfUserProfileIsComplete($userID){
			$sql = "SELECT * FROM users WHERE user_id='$userID'";
			$query = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_array($query);
			
			if($row['name'] == "none" || $row['location'] == "none" || $row['bio'] == "none"){
				return false;
			}else{
				return true;
			}
		}

		function postProfessionOnSignUp($userID,$professionType,$specialityID){
			$sql="INSERT INTO profession(user_id,profession_type,speciality_id,dateTime) VALUES('$userID','$professionType','$specialityID',NOW())";
			$query = mysql_query($sql) or die(mysql_error());

			if($query){
				return true;			
			}else{
				return false;
			}
		}
		function postUserSpeciality($userID,$interestcartegoryID){
			$sql="INSERT INTO user_speciality
(user_id,interest_cartegory_id,dateTime) VALUES('$userID','$interestcartegoryID',NOW())";
			$query = mysql_query($sql) or die(mysql_error());

			if($query){
				return true;			
			}else{
				return false;
			}
		}

		function postSpecialityInterestsOnSignUp($userID,$specialityID){
			$sql="INSERT INTO signup_interest_specialities(user_id,speciality_id,dateTime) VALUES('$userID','$specialityID',NOW())";
			$query = mysql_query($sql) or die(mysql_error());

			if($query){
				return true;			
			}else{
				return false;
			}
		}
        
        function updateUploadedProfilePic($user,$imgLink){
            $sql="UPDATE users SET profImg='$imgLink' WHERE user_id='$user'";
            $query = mysql_query($sql) or die(mysql_error());
            if($query){
                return true;
            }else{
                return false;
            }
        }
		
		function getSpecialityItem($specialityID){
			$sql = "SELECT * FROM speciality WHERE speciality_id='$specialityID'";
			$query = mysql_query($sql) or die(mysql_error());
			
			return mysql_fetch_array($query);
		}

		function getInterestSpecialist($interestID){
			$sql = "SELECT * FROM user_speciality WHERE interest_cartegory_id='$interestID'";
			$query = mysql_query($sql) or die(mysql_error());
			
			return mysql_fetch_array($query);
		}
        
		function getLatestPosts($userID){
			$sql = "SELECT * FROM concepts ORDER BY dateTime DESC";
			$query = mysql_query($sql) or die(mysql_error());
			$count=0;
			while($row = mysql_fetch_array($query)){
                if($count < 10){
                    $userInterest = $this->checkIfItsUserInterest($userID,$row['interest_cartegory_id']);                
                    if($userInterest==true){
                        $interest = $this->getInterestCartegoryItem($row['interest_cartegory_id']);
                    $userData = $this->getUserSignUpInfo($row['user_id']);
                    echo "
                        <div class='interest-content-data'>
                            <div class='interest-content-data-user-img'>				<img src='".$this->getUserProfileImg($userData['user_id'])."'/>
                            </div>
                            <div class='interest-content-data-div'>
                                <p><span class='tut-type'>".$interest['cartegory_name'].":</span>
                                <a href='concept_item.php?c=".$row['concept_id']."'>".$row['name']."</a>
                                </p>
                                <div class='post-info'>
                                    Content: Video | Resources: Attached |
                                    Posted by <a href=''>".ucwords($userData['username'])."</a>,
                                    <span>".date('D, d-M-Y',strtotime($row['dateTime']))."</span>
                                </div>
                            </div>

                            <div class='more-info'>
                                <img src='img/watched_dark.png'/><span>".$row['views']."</span>
                            </div>
                        </div>

                    ";
                        $count++;                        
                    }                    
                }                
                
			}          
            if(empty($interest)){
                echo "<div class='notify'>Sorry no posts on your interests yet, be the first to post a concept on your interests!</div>";
                
            }
		}	
		
		function getMentorSuggestionsForUser($userID){
			$sql = "SELECT * FROM user_interest WHERE user_id = '$userID' LIMIT 3";
			$query = mysql_query($sql) or die(mysql_error());
			
			if(mysql_num_rows($query) > 0){

				while($row=mysql_fetch_array($query)){
					$specialityData = $this->getInterestSpecialist($row['interest_cartegory_id']);
					$userData = $this->getUserSignUpInfo($specialityData['user_id']);
					echo "
						<div class='add-mentor-div'>
						<div class='add-mentor-div-left'>
							<div class='mentor-img'>
								<img src='".
                        $this->getUserProfileImg($userData['user_id'])
                        ."'/>
							</div>
						</div>
						<div class='add-mentor-div-right'>
							<div class='add-mentor-div-right-top'>
								<h4>".$userData['username']."</h4>
								<div class='mentor-rating'>
                                    <div class='rating-text'>10</div> 
								</div>
							</div>
							<p>php, sql, laravel</p>
						</div>
						<div class='add-mentor-div-right-bottom'>
							<div class='add-mentor-btn'>
								<a href=''><img src='img/add-mentor.png'/> add mentor</a>
							</div>
						</div>
					</div>					
					";
				}

			}else{
				echo "No mentor suggestions yet!";			
			}
		}		

		function checkGender($userID){
			$sql = "SELECT * FROM users WHERE user_id='$userID'";
			$query = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_array($query);
			
			if($row['gender'] == "female"){
				return "female";
			}else{
				return "male";
			}
		}
		
		function displayGenderIcon($userID){
            $userData = $this->getUserSignUpInfo($userID);
            
            if($userData['profImg'] == "" || $userData['profImg'] == 'n'){
                if($userData['gender'] == "female"){
                    echo "<img src='img/female_user.png'/>";
                }else{
                    echo "<img src='img/male_user.png'/>";
                }
            }else{
                echo "<img src='".$userData['profImg']."'/>";
            }			
		}
        function getUserProfileImg($userID){
            $userData = $this->getUserSignUpInfo($userID);
            
            if($userData['profImg'] == "" || $userData['profImg'] == 'n'){
                if($userData['gender'] == "female"){
                    return "img/female_user.png";
                }else{
                    return "img/male_user.png";
                }
            }else{
                return $userData['profImg'];
            }
        }
		function addUserInterest($userID,$cartegoryID){
			$sql = "INSERT INTO user_interest (user_id,interest_cartegory_id,dateTime) 
			VALUES ('$userID','$cartegoryID',NOW())";
			
			$query = mysql_query($sql)or die(mysql_error());	

			if($query){
				return true;
			}else{
				return false;
			}			
		}		
		function getTotalUserInterests($userID){
			$sql = "SELECT * FROM user_interest WHERE user_id = '$userID'";
			$query = mysql_query($sql) or die(mysql_error());
			
			return mysql_num_rows($query);
		}
		
		function getTotalUserGroups($userID){
			$sql = "SELECT * FROM user_group WHERE user_id = '$userID'";
			$query = mysql_query($sql) or die(mysql_error());
			
			return mysql_num_rows($query);
		}
		
		function getUserProfileInterests($userID){
			$sql = "SELECT * FROM user_interest WHERE user_id = '$userID'";
			$query = mysql_query($sql) or die(mysql_error());
			
			while($row = mysql_fetch_array($query)){
				$cartegory = $this->getInterestCartegoryItem($row['interest_cartegory_id']);
				echo "
					<div class='user-interest-div'>
						<div class='remove-item'>
								<a class='interest-home-icon' href='home.php?remove=".$row['interest_cartegory_id']."'>
									<img src='img/remove.png'/>
								</a>				
						</div>							
						<div class='user-interest-div-img'>
							<a href=''><img src='".$cartegory['cartegory_icon']."'/></a>
						</div>		
					</div>
				";							
			}
		}
		
		function getUserInterestList($userID){
			$sql = "SELECT * FROM user_interest WHERE user_id = '$userID'";
			$query = mysql_query($sql) or die(mysql_error());
			
			while($row = mysql_fetch_array($query)){
				$cartegory = $this->getInterestCartegoryItem($row['interest_cartegory_id']);
				echo "
					<ul>
						<li>
							<a href=''>
								<img src='".$cartegory['cartegory_icon']."'/> ". 
								$cartegory['cartegory_name']
							."</a>
							<div class='remove-item'>
								<a class='interest-home-icon' href='home.php?remove=".$row['interest_cartegory_id']."'>
									<img src='img/remove.png'/>
								</a>								
								<div class='clear'></div>
							</div>
						<div class='item-posts-total'>
							10 posts
						</div>
						</li>
					</ul>
				";							
			}
		}
		
		function getInterestCartegoryItem($cartegoryID){
			$sql = "SELECT * FROM interest_cartegory WHERE interest_cartegory_id='$cartegoryID'";
			$query = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_array($query);
			
			return $row;
		}

		function getAllInterestCartegorySpeciality($specialityID){
			$sql = "SELECT * FROM interest_cartegory WHERE speciality_id='$specialityID'";
			$query = mysql_query($sql) or die(mysql_error());

			while($row = mysql_fetch_array($query)){
				echo "
				<div class='item'>					
					<div class='img'>
						<img src='".$row['cartegory_icon']."'/>
					</div>
					<div class='item-name'>".
						$row['cartegory_name']					
					."</div>
					<input name='cartegory[]' type='checkbox' value='".$row['interest_cartegory_id']."'/>				
				</div>
			";
			}
			echo "<div class='clear'></div>";
		}
		
		function checkIfItsUserInterest($userID,$cartegoryID){
			$sql = "SELECT * FROM user_interest WHERE user_id='$userID' AND interest_cartegory_id = '$cartegoryID'";			
			$query = mysql_query($sql) or die(mysql_error());			
			if(mysql_num_rows($query)==1){
				return true;
			}else{
				return false;
			}			
		}
		function removeUserInterestItem($userID,$cartegoryID){
			$sql = "DELETE FROM user_interest WHERE user_id='$userID' AND interest_cartegory_id = '$cartegoryID'";
			$query = mysql_query($sql) or die(mysql_error());			
			if(mysql_affected_rows()>0){
				$status = $this->userActivity($userID,"remove interest","none",$cartegoryID);
				if($status == true){
					return true;
				}else{
					return false;
				}				
			}else{
				return false;
			}
		}
		function getAllUserInterestsInSelectOption($userID){
			$sql = "SELECT * FROM user_interest WHERE user_id='$userID'";
			$query = mysql_query($sql) or die(mysql_error());
			
			echo "<select name='cartegory'>
				<option>Select cartegory</option>
			";
			while($row = mysql_fetch_array($query)){
				$data = $this->getInterestCartegoryItem($row['interest_cartegory_id']);
				echo "<option value='".$row['interest_cartegory_id']."'>".$data['cartegory_name']."</option>";
			}
			echo "</select>";
		}
		function postNewConcept($name,$userID,$desc,$cart,$forWho,$contentType,$content){
			$sql = "INSERT INTO concepts(name,user_id,description,interest_cartegory_id,forWho,content_type,content_resources,concept_content,views,dateTime) 
					VALUES('$name','$userID','$desc','$cart','$forWho','$contentType','none','$content','0',NOW())";
			$query = mysql_query($sql)or die(mysql_error());
			$id = mysql_insert_id();
			if($query){
				return $id;
			}else{
				return false;
			}
		}
		function postFinalConcept($conceptID,$userID,$type,$content){
			$sql = "UPDATE concepts SET content_type='$type', concept_content='$content' WHERE concept_id='$conceptID'";
			$query = mysql_query($sql)or die(mysql_error());			
			if(mysql_affected_rows()==1){
				if($this->userActivity($userID,"post concept","none",$conceptID) == true){					
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		function getUserConceptData($userID,$conceptID){
			$sql = "SELECT * FROM concepts WHERE user_id='$userID' AND concept_id='$conceptID'";
			$query = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_array($query);			
			return $row;			
		}
		function getConceptItem($conceptID){
			$sql = "SELECT * FROM concepts WHERE concept_id='$conceptID'";
			$query = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_array($query);			
			return $row;			
		}
		function getAllUserConcepts($userID){
			$sql = "SELECT * FROM concepts WHERE user_id='$userID' ORDER BY dateTime DESC";
			$query = mysql_query($sql) or die(mysql_error());
			
			if(mysql_num_rows($query)>0){
				echo "<ul>";
				while($row = mysql_fetch_array($query)){
					$cartegory = $this->getInterestCartegoryItem($row['interest_cartegory_id']);
					echo "<li>
							<a href='?".$row['concept_id']."'>
								<img src='".$cartegory['cartegory_icon']."'/> ".$row['name']."
							</a>
						</li>";
				}
				echo "</ul>";
			}else{
				echo "<div>You have not posted any concepts yet!</div>";
			}		
		}
		function getTotalUserConcepts($userID){
			$sql = "SELECT * FROM concepts WHERE user_id='$userID'";
			$query = mysql_query($sql) or die(mysql_error());
			return mysql_num_rows($query);
		}
		function getAllConcepts(){
			$sql = "SELECT * FROM concepts ORDER BY dateTime DESC";
			$query = mysql_query($sql) or die(mysql_error());
			
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_array($query)){
					$cartegory = $this->getInterestCartegoryItem($row['interest_cartegory_id']);
					$userData = $this->getUserSignUpInfo($row['user_id']);
					echo "
						<div class='concept-item'>
							<h4><img src='".$cartegory['cartegory_icon']."'/><span><a href='concept_item.php?c=".$row['concept_id']."'>".ucfirst($row['name'])."</a></span></h4>
							<p>
								<span>Content:</span> ".$row['content_type']." | <span>Resources:</span> Attached | <span>Views</span> ".$row['views']."
							</p>
							<p>
								<span>Posted by</span> ".ucwords($userData['username']).", ".date('D, d-M-Y',strtotime($row['dateTime']))."
							</p>
						</div> 
					";
				}
			}else{
				echo "No concepts posted yet!";
			}
		}
		
		function addUserOnline($userID){
			$sql="INSERT INTO online(user_id,dateTime) VALUES('$userID',NOW())";
			$query = mysql_query($sql)or die(mysql_error());

			if($query){
				return true;
			}else{
				return false;
			}		
		}

		function checkUserOnline($userID){
			$sql="SELECT * FROM online";
			$query = mysql_query($sql)or die(mysql_error());

			if(mysql_num_rows($query)>0){
				if($this->checkIfThisUserOnline($userID) == true){
					return mysql_num_rows($query)-1;
				}else{
					return mysql_num_rows($query);
				}
			}else{
				return 0;
			}
		}

		function checkIfThisUserOnline($userID){
			$sql="SELECT * FROM online WHERE user_id='$userID'";
			$query = mysql_query($sql)or die(mysql_error());
			if(mysql_num_rows($query)==1){
				return true;
			}else{
				return false;
			}
		}

		function displayOnlineUsersOnPopup(){
			$sql="SELECT * FROM online";
			$query = mysql_query($sql)or die(mysql_error());
			while($row=mysql_fetch_array($query)){
				$userData = $this->getUserSignUpInfo($row['user_id']);
				echo "
					<div class='people-online-content-item'>
					<div class='people-online-content-item-img'>
						<img src='img/male_user.png'/>
					</div>
					<div class='people-online-content-item-det'>
						<h4>".$userData['username']."</h4>
						<p>Php,Html,Python</p>
						<div class='bottom'>
							<div class='chat-btn'>
								<a href='home.php?ud=".$userData['user_id']."'>Chat</a>
							</div>							
						</div>
					</div>
					<div class='clear'></div>			
				</div>
				";
			}
		}

		function removeUserOnline($userID){
			$sql="DELETE FROM online WHERE user_id='$userID'";
			$query = mysql_query($sql)or die(mysql_error());
			if(mysql_affected_rows() > 0){
				return true;
			}else{
				return false;
			}
		}

		function checkIfMyClasses($userID){
			$sql = "SELECT * FROM circle WHERE creator_user_id='$userID'";			
			$query = mysql_query($sql) or die(mysql_error());			
			if(mysql_num_rows($query)>0){
				return true;
			}else{
				return false;
			}
		}
        function getCircle($circleID){
            $sql = "SELECT * FROM circle WHERE circle_id='$circleID'";
			$query = mysql_query($sql)or die(mysql_error());
			if(mysql_num_rows($query) == 1){                
                return mysql_fetch_array($query);                
            }else{
                return false;
            }
        }
		function getTotalCircles($circleType){
			$sql = "SELECT * FROM circle WHERE circle_type='$circleType'";
			$query = mysql_query($sql)or die(mysql_error());
			return mysql_num_rows($query);
		}
		
		function getOpenCircles(){
			$sql = "SELECT * FROM circle WHERE circle_type='Open'";
			$query = mysql_query($sql)or die(mysql_error());
			$num = mysql_num_rows($query);
			if($num>0){
				while($row = mysql_fetch_array($query)){
					$interest = $this->getInterestCartegoryItem($row['interest_cartegory_id']);
					$creator = $this->getUserSignUpInfo($row['creator_user_id']);
					echo "
					<div class='circles-item'>
						<h4><a href='getcircles.php?circ=".$row['circle_id']."'>".$row['circle_name']."</a></h4>
						<div class='circle-desc'>
                            Cartegory: ".$interest['cartegory_name'].",
                            Service Type: ".$row['service_type'].",
                            Circle Type: ".$row['circle_type'].",
                            Members: ".$row['members'].",
                            Creator: ".$creator['username'].", Posted: 2 days ago
                        </div>
                        <div class='circle-btns'>
                            <ul>
                                <li>Join</a></li>
                                <li>Preview</li>
                            </ul>
                        </div>
					</div>		
					";
				}
                echo "<div class='clear'></div>";
			}else{
				echo "<div class='class-notify'>There are currently no open circles.</div>";
			}			
		}        
        function getUserCircles($userID){
			$sql = "SELECT * FROM user_circle WHERE user_id='$userID'";
			$query = mysql_query($sql)or die(mysql_error());
			$num = mysql_num_rows($query);
			if($num>0){
				while($row = mysql_fetch_array($query)){
                    $circleData = $this->getCircle($row['circle_id']);
					$interest = $this->getInterestCartegoryItem($circleData['interest_cartegory_id']);
					$creator = $this->getUserSignUpInfo($circleData['creator_user_id']);
					echo "
					<div class='circle'>
						<h4><a href='getcircles.php?circ=".$circleData['circle_id']."'>".$circleData['circle_name']."</a></h4>
						<p>Cartegory: ".$interest['cartegory_name']."</p>
						<p>Service Type: ".$circleData['service_type']."</p>
						<p>Circle Type: ".$circleData['circle_type']."</p>
						<p>Members: ".$circleData['members']."</p>
						<p>Creator: ".$creator['username'].", Posted: 2 days ago</p>
					</div>		
					";
				}
                echo "<div class='clear'></div>";
			}else{
				echo "<div class='class-notify'>
                        You are currently not a member of any circle.
                    </div>";
			}
			
		}
        function addUserToCircle($userID,$circleID){
            $sql="INSERT INTO user_circle(circle_id,user_id,dateTime) VALUES('$circleID','$userID',NOW())";
			$query = mysql_query($sql)or die(mysql_error());

			if($query){
				return true;
			}else{
				return false;
			}
        }

		function updateConceptView($conceptID,$views){
			$views = $views+1;
			$sql="Update concepts SET views='$views' WHERE concept_id='$conceptID'";
			$query = mysql_query($sql)or die(mysql_error());
			if($query){
				return true;			
			}else{
				return false;
			}
		}

		function getAllIndustries(){
			$sql="SELECT * FROM industry";
			$query=mysql_query($sql)or die(mysql_error());

			$content["industries"] = array();

			while($row=mysql_fetch_array($query)){		
				$data = array();
				$data['industry_id'] = $row['industry_id'];
				$data['industry_name'] = $row['industry_name'];

				array_push($content["industries"] , $data);
			}

			return $content;
		}

		function getAllSpecialities(){
			$sql="SELECT * FROM speciality";
			$query=mysql_query($sql)or die(mysql_error());

			$content["specialities"] = array();

			while($row=mysql_fetch_array($query)){		
				$data = array();
				$data['speciality_id'] = $row['speciality_id'];
				$data['speciality_name'] = $row['speciality_name'];
				$data['industry_id'] = $row['industry_id'];

				array_push($content["specialities"] , $data);
			}

			return $content;
		}

		function getAllInterests(){
			$sql="SELECT * FROM interest_cartegory ORDER BY cartegory_name ASC";
			$query=mysql_query($sql)or die(mysql_error());

			$content["interests"] = array();

			while($row=mysql_fetch_array($query)){		
				$data = array();
				$data['interest_cartegory_id'] = $row['interest_cartegory_id'];
				$data['speciality_id'] = $row['speciality_id'];
				$data['cartegory_name'] = $row['cartegory_name'];
				$data['cartegory_total'] = $this->getTotalConceptsPerInterest($row['interest_cartegory_id']);
				$data['cartegory_icon'] = "http://10.0.2.2/codevated/".$row['cartegory_icon'];

				array_push($content["interests"] , $data);
			}

			return json_encode($content);
		}
		function getInterestPosts($userId,$interestId){
			$sql = "SELECT * FROM concepts WHERE interest_cartegory_id='$interestId' ORDER BY dateTime DESC";
			$query=mysql_query($sql)or die(mysql_error());

			$content["concepts"] = array();

			while($row = mysql_fetch_array($query)){
					$data = array();

                    $userInterest = $this->checkIfItsUserInterest($userId,$row['interest_cartegory_id']);                
                    if($userInterest==true){
                        $interest = $this->getInterestCartegoryItem($row['interest_cartegory_id']);
                    	$userData = $this->getUserSignUpInfo($row['user_id']);

                    	$data["num_rows"] = $numRows;
                   		$data["profile_img"] = "http://10.0.2.2/codevated/".$this->getUserProfileImg($userData['user_id']);
                        $data["cartegory_name"] = $interest['cartegory_name'];
                        $data["cartegory_icon"] = "http://10.0.2.2/codevated/".$interest['cartegory_icon'];
                        $data["concept_id"] = $row['concept_id'];
                        $data["name"] = $row['name'];
                        $data["content_type"] = $row['content_type'];
                        $data["username"] = ucwords($userData['username']);
                        $data["posted_date"] = date('D, d-M-Y',strtotime($row['dateTime']));
                        $data["views"] = $row['views'];  

                        array_push($content["concepts"] , $data);                     
                    }                                                          
            	}

			return json_encode($content);
		}
		function getTotalConceptsPerInterest($interestID){
			$sql = "SELECT * FROM concepts WHERE interest_cartegory_id='$interestID'";
			$query = mysql_query($sql) or die(mysql_error());

			return mysql_num_rows($query);
		}
		function checkIfUsernameExists($username){
			$sql="SELECT * FROM users WHERE username = '$username'";
			$query=mysql_query($sql)or die(mysql_error());

			$content["data"] = array();
			$data = array();

			if(mysql_num_rows($query)>0){
				
				$data['fieldState'] = 0;				
			}else{
				
				$data['fieldState'] = 1;	
			}
			array_push($content["data"] , $data);

			return json_encode($content);
		}

		function checkIfEmailExists($email){
			$sql="SELECT * FROM users WHERE email = '$email'";
			$query=mysql_query($sql)or die(mysql_error());

			$content["data"] = array();
			$data = array();

			if(mysql_num_rows($query)>0){
				
				$data['fieldState'] = 0;				
			}else{
				
				$data['fieldState'] = 1;	
			}
			array_push($content["data"] , $data);

			return json_encode($content);
		}

		function getLatestConceptsPosted($userID){

			$sql = "SELECT * FROM concepts ORDER BY dateTime DESC";
			$query = mysql_query($sql) or die(mysql_error());
			$numRows = mysql_num_rows($query);

			$content["concepts"] = array();			

				while($row = mysql_fetch_array($query)){
					$data = array();

                    $userInterest = $this->checkIfItsUserInterest($userID,$row['interest_cartegory_id']);                
                    if($userInterest==true){
                        $interest = $this->getInterestCartegoryItem($row['interest_cartegory_id']);
                    	$userData = $this->getUserSignUpInfo($row['user_id']);

                    	$data["num_rows"] = $numRows;
                   		$data["profile_img"] = "http://10.0.2.2/codevated/".$this->getUserProfileImg($userData['user_id']);
                        $data["cartegory_name"] = $interest['cartegory_name'];
                        $data["cartegory_icon"] = "http://10.0.2.2/codevated/".$interest['cartegory_icon'];
                        $data["concept_id"] = $row['concept_id'];
                        $data["name"] = $row['name'];
                        $data["content_type"] = $row['content_type'];
                        $data["username"] = ucwords($userData['username']);
                        $data["posted_date"] = date('D, d-M-Y',strtotime($row['dateTime']));
                        $data["views"] = $row['views'];  

                        array_push($content["concepts"] , $data);                     
                    }                                                          
            	}
            	
				return json_encode($content);
		}
		function getCircles(){
			$sql = "SELECT * FROM circle";
			$query = mysql_query($sql)or die(mysql_error());
			$num = mysql_num_rows($query);

			$content["circles"] = array();
			$data = array();

			if($num>0){
				while($row = mysql_fetch_array($query)){					

					$interest = $this->getInterestCartegoryItem($row['interest_cartegory_id']);
					$creator = $this->getUserSignUpInfo($row['creator_user_id']);
					
					$data['circle_id'] = $row['circle_id'];
					$data['circle_name'] = $row['circle_name'];
					$data['cartegory_name'] = $interest['cartegory_name'];
					$data['service_type'] = $row['service_type'];
					$data['circle_type'] = $row['circle_type'];
					$data['members'] = $this->getTotalCircleMembers($row['circle_id']);
					$data['posts'] = $this->getTotalCirclePosts($row['circle_id']);
					$data['username'] = $creator['username'];

					array_push($content["circles"] , $data); 					
				}
			}else{
				$data["state"] = 0;
				array_push($content["circles"], $data);
			}

			return json_encode($content);			
		}
		function getAllUserCircles($userID){
			$sql = "SELECT * FROM circle WHERE creator_user_id='$userID'";
			$query = mysql_query($sql)or die(mysql_error());
			$num = mysql_num_rows($query);

			$content["circles"] = array();
			$data = array();

			if($num>0){
				while($row = mysql_fetch_array($query)){					

					$interest = $this->getInterestCartegoryItem($row['interest_cartegory_id']);
					$creator = $this->getUserSignUpInfo($row['creator_user_id']);
					
					$data['circle_id'] = $row['circle_id'];
					$data['circle_name'] = $row['circle_name'];
					$data['cartegory_name'] = $interest['cartegory_name'];
					$data['service_type'] = $row['service_type'];
					$data['circle_type'] = $row['circle_type'];
					$data['members'] = $this->getTotalCircleMembers($row['circle_id']);
					$data['posts'] = $this->getTotalCirclePosts($row['circle_id']);
					$data['username'] = $creator['username'];

					array_push($content["circles"] , $data); 					
				}
			}else{
				$data["state"] = 0;
				array_push($content["circles"], $data);
			}

			return json_encode($content);			
		}
		function getTotalCircleMembers($circleID){
			$sql = "SELECT * FROM user_circle WHERE circle_id='$circleID'";
			$query = mysql_query($sql)or die(mysql_error());

			return mysql_num_rows($query);
		}
		function getTotalCirclePosts($circleId){
			$sql = "SELECT * FROM user_circle WHERE circle_id='$circleId'";
			$query = mysql_query($sql)or die(mysql_error());
			$num = 0;

				while($row = mysql_fetch_array($query)){					

					$userID = $row['user_id'];
					if($this->checkIfUsersConceptsExists($userID) == true){					
						$num++;
					}										
				}

			return $num;
		}
		function checkIfUsersConceptsExists($userID){
			$sql = "SELECT * FROM concepts WHERE user_id='$userID'";
			$query = mysql_query($sql) or die(mysql_error());
			$num = mysql_num_rows($query);
			if($num > 0){
				return true;
			}else{
				return false;
			}
		}
		function getCircleUsersConcepts($circleId){
			$sql = "SELECT * FROM user_circle WHERE circle_id='$circleId'";
			$query = mysql_query($sql)or die(mysql_error());
			$num = mysql_num_rows($query);

			$content["userConcepts"] = array();
			$data = array();

			if($num>0){
				while($row = mysql_fetch_array($query)){					

					$userID = $row['user_id'];
					$data["user"] = json_decode($this->getUserConcepts($userID));
					
					array_push($content["userConcepts"], $data);					
				}
			}else{
				$data["state"] = 0;
				array_push($content["userConcepts"], $data);
			}
			return json_encode($content);
		}
		function getUserConcepts($userID){
			$sql = "SELECT * FROM concepts WHERE user_id='$userID' ORDER BY dateTime DESC";
			$query = mysql_query($sql) or die(mysql_error());
			$num = mysql_num_rows($query);

			$content["concepts"] = array();
			$data = array();
			
			if($num>0){
				while($row = mysql_fetch_array($query)){

                    $userInterest = $this->checkIfItsUserInterest($userID,$row['interest_cartegory_id']);                
                    if($userInterest==true){
                        $interest = $this->getInterestCartegoryItem($row['interest_cartegory_id']);
                    	$userData = $this->getUserSignUpInfo($row['user_id']);

                    	$data["num_rows"] = $numRows;
                   		$data["profile_img"] = "http://10.0.2.2/codevated/".$this->getUserProfileImg($userData['user_id']);
                        $data["cartegory_name"] = $interest['cartegory_name'];
                        $data["cartegory_icon"] = "http://10.0.2.2/codevated/".$interest['cartegory_icon'];
                        $data["concept_id"] = $row['concept_id'];
                        $data["name"] = $row['name'];
                        $data["content_type"] = $row['content_type'];
                        $data["username"] = ucwords($userData['username']);
                        $data["posted_date"] = date('D, d-M-Y',strtotime($row['dateTime']));
                        $data["views"] = $row['views'];  

                        array_push($content["concepts"] , $data);                     
                    }                                                          
            	}
            }else{
				$data["state"] = 0;
				array_push($content["concepts"] , $data);
			}
            return json_encode($content);		
		}
		function postConcept($userID,$title,$content,$cart){
			$sql = "INSERT INTO concepts(name,user_id,description,interest_cartegory_id,forWho,content_type,content_resources,concept_content,views,dateTime) 
					VALUES('$title','$userID','none','$cart','none','text','none','$content','0',NOW())";
			$query = mysql_query($sql)or die(mysql_error());
			$id = mysql_insert_id();

			$content["concepts"] = array();
			$data = array();

			if($query){
				$data['state'] = 1;
			}else{
				$data['state'] = 0;
			}
			array_push($content["concepts"] , $data);

			return json_encode($content);
		}
		function postNotification($destination,$source,$title,$message){
			$sql = "INSERT INTO notification(user_id,source,title,message,status,dateTime) 
					VALUES('$destination','$source','$title','$message','unread',NOW())";
			$query = mysql_query($sql)or die(mysql_error());

			if($query){
				return true;
			}else{
				return false;
			}
		}
		function getAllNotification($userID){
			$sql = "SELECT * FROM notification WHERE user_id='$userID' ORDER BY dateTime DESC";
			$query = mysql_query($sql) or die(mysql_error());
			$num = mysql_num_rows($query);

			$content["notification"] = array();
			$data = array();
			
			if($num>0){
				while($row = mysql_fetch_array($query)){

					if($row['source'] == "Codevated team"){
						$source = $row['source'];
					}else{
						$userData = $this->getUserSignUpInfo($row['source']);
                    	$source = ucwords($userData['username']);
                    } 

                    $data["notification_id"] = $row['notification_id'];
                    $data["source"] = $source;
                    $data["title"] = $row['title'];
                    $data["message"] = $row['message'];
                    $data["status"] = $row['status'];
                    $data["posted_date"] = date('D, d-M-Y',strtotime($row['dateTime']));  
                    $data["posted_date_two"] = date('d-m-Y',strtotime($row['dateTime']));               	
                                       

                    array_push($content["notification"] , $data);           
                }
            }else{
				$data["state"] = 0;
				array_push($content["notification"] , $data);
			}
            return json_encode($content);
		}
		function getTotalUnreadNotifications($userID){
			$sql = "SELECT * FROM notification WHERE user_id='$userID' AND status='unread'";
			$query = mysql_query($sql) or die(mysql_error());
			$num = mysql_num_rows($query);

			$content["notification"] = array();
			$data = array();
			
			if($num>0){
				$data["unread"] = $num;
            }else{
				$data["unread"] = 0;				
			}
			array_push($content["notification"] , $data);
            return json_encode($content);
		}
		function getUserInterests($userID){
			$sql = "SELECT * FROM user_interest WHERE user_id='$userID'";
			$query = mysql_query($sql) or die(mysql_error());
			$num = mysql_num_rows($query);
			$interests = array();
			$d = 0;
			if($num > 0){
				while($row=mysql_fetch_array($query)){
					$interests[$d] = $row['interest_cartegory_id'];
					$d++;
				}
				return $interests;
			}
		}
		function getUserInterestSpecialists($userID){		

			$content['userMentors'] =array();
			$specialist = array();

			$interests = $this->getUserInterests($userID);

			for($i=0;$i<count($interests);$i++){

				$userInterestID = $interests[$i];
				$sql = "SELECT * FROM user_speciality WHERE interest_cartegory_id='$userInterestID'";
				$query = mysql_query($sql) or die(mysql_error());
				$num = mysql_num_rows($query);

				if($num > 0){
					while($row=mysql_fetch_array($query)){	

						if($this->checkIfUserMentor($userID,$row['user_id']) == false){

							$userData = $this->getUserSignUpInfo($row['user_id']);
							$specialist['interest'] = $userInterestID;
							$specialist['user_id'] = $row['user_id'];
							$specialist['username'] = ucwords($userData['username']);
							$specialist['prof_img'] = $userData['profImg'];
							$specialist['status'] = "0";

							array_push($content['userMentors'],$specialist);
						}												
																
					}
				}
			}
			return json_encode($content);			
		}
		function addMentor($userID,$mentorID){
			$sql = "INSERT INTO user_mentor(user_id,mentor_id,dateTime) 
					VALUES('$userID','$mentorID',NOW())";
			$query = mysql_query($sql)or die(mysql_error());

			$content["mentor"] = array();
			$data = array();

			if($query){
				$data['state'] = 1;
				$userData = $this->getUserSignUpInfo($userID);
				$title = "I added you as a mentor";
				$mentorData = $this->getUserSignUpInfo($mentorID);
				$message = "Hi ".ucwords($mentorData['username']).", i added you as a mentor. I can now view any concepts that you post and have a chat with you. ".ucwords($userData['username']);
				$this->postNotification($mentorID,$userID,$title,$message);
			}else{
				$data['state'] = 0;
			}
			array_push($content["mentor"] , $data);

			return json_encode($content);
		}
		function removeMentor($userID,$mentorID){
			$sql = "DELETE FROM user_mentor WHERE user_id='$userID' AND mentor_id='$mentorID'";
			$query = mysql_query($sql)or die(mysql_error());

			$content["mentor"] = array();
			$data = array();

			if($query){
				$data['state'] = 1;
			}else{
				$data['state'] = 0;
			}
			array_push($content["mentor"] , $data);

			return json_encode($content);
		}
		function getAllUserMentors($userID){
			$sql = "SELECT * FROM user_mentor WHERE user_id='$userID'";
			$query = mysql_query($sql)or die(mysql_error());

			$content["userMentors"] = array();
			$data = array();

			if(mysql_num_rows($query) > 0){
				while($row = mysql_fetch_array($query)){
					$userData = $this->getUserSignUpInfo($row['mentor_id']);
					$data['user_id'] = $row['mentor_id'];
					$data['username'] = ucwords($userData['username']);
					$data['prof_img'] = $userData['profImg'];					
					$data['status'] = "1";
					array_push($content['userMentors'],$data); 						
				}
			}else{
				$data['state'] = 0;
			}
			return json_encode($content);
		}
		function checkIfUserMentor($userID,$mentorID){
			$sql = "SELECT * FROM user_mentor WHERE user_id='$userID' AND mentor_id='$mentorID'";
			$query = mysql_query($sql)or die(mysql_error());

			if(mysql_num_rows($query) > 0){
				return true;
			}else{
				return false;
			}
		}

		public function plural( $count, $text ) { 
			return $count . ( ( $count == 1 ) ? ( " $text" ) : ( " ${text}s" ) );
		}
 
		public function ago( $datetime ) {
			$interval = date_create('now')->diff( $datetime );
			$suffix = ( $interval->invert ? ' ago' : '' );
			if ( $v = $interval->y >= 1 ) return $this->plural( $interval->y, 'year' ) . $suffix;
			if ( $v = $interval->m >= 1 ) return $this->plural( $interval->m, 'month' ) . $suffix;
			if ( $v = $interval->d >= 1 ) return $this->plural( $interval->d, 'day' ) . $suffix;
			if ( $v = $interval->h >= 1 ) return $this->plural( $interval->h, 'hour' ) . $suffix;
			if ( $v = $interval->i >= 1 ) return $this->plural( $interval->i, 'minute' ) . $suffix;
			return $this->plural( $interval->s, 'second' ) . $suffix;
		}
		function userLogout(){
			session_start();
			unset($_SESSION['user_id']);
			unset($_SESSION['username']);
			unset($_SESSION['email']);
			unset($_SESSION['password']);
			unset($_SESSION['phone']);
			unset($_SESSION['codevatedTeam']);
			unset($_SESSION['dateTime']);
			session_destroy();
			header("Location: index.php");
		}
		function sendMail($email,$message,$subject){      
		  require_once('class.phpmailer.php');
		  require_once('class.smtp.php');
		  $mail = new PHPMailer();
		  $mail->IsSMTP(); 
		  $mail->SMTPDebug  = 0;                     
		  $mail->SMTPAuth   = true;                  
		  $mail->SMTPSecure = "ssl";                 
		  $mail->Host       = "smtp.gmail.com";      
		  $mail->Port       = 465;             
		  $mail->AddAddress($email);
		  $mail->Username="yourgmailid@gmail.com";  
		  $mail->Password="yourgmailpassword";            
		  $mail->SetFrom('you@yourdomain.com','Coding Cage');
		  $mail->AddReplyTo("you@yourdomain.com","Coding Cage");
		  $mail->Subject = $subject;
		  $mail->MsgHTML($message);
		  if($mail->Send()){
			  return true;
		  }else{
			  return false;
		  }
		} 
	}
?>
