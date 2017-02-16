<?php
	class FunctionClass{
		
		function __construct(){
			error_reporting(0);
			mysql_connect("localhost","root","");
			mysql_select_db("codevated");
		}
		
		function validateFormInput($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
		
		function signUpUser($username,$email,$password,$gender){
			$sql = "INSERT INTO users (name,location,bio,username,email,password,phone,gender,codevatedTeam,dateTime) 
			VALUES('none','none','none','$username','$email','$password','none','$gender','n',NOW())";
			$query = mysql_query($sql)or die(mysql_error());
			$userid = mysql_insert_id(); 
			
			if($query){
				$activity = $this->userActivity($userid,"signup","none","none");
				if($activity == true){
					return true;
				}else{
					return false;
				}				
			}else{
				return false;
			}
		}

		function checkIfUserIsRegistered($username,$pwd){
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
		
		function getLanguages(){
			$sql = "SELECT * FROM languages";
			$q = mysql_query($sql)or die(mysql_error());
			
			while($row = mysql_fetch_array($q)){
				echo $row['lang_name'];
			}
		}
		
		function createTut($langID,$level,$topic){
			$sql = "INSERT INTO tutorials(lang_id,level,topic,dateTime) 
			VALUES('$langID','$level','$topic',NOW())";
			$q = mysql_query($sql)or die(mysql_error());
		}
		
		function createTutContent($tutID,$content,$imgUrl){
			$sql = "INSERT INTO tutorialsContent(tut_id,content,imgUrl) 
			VALUES('$tutID','$content','$imgUrl')";
			$q = mysql_query($sql)or die(mysql_error());
		}
		
		function getLanguagesOnSelectOption(){
			$sql = "SELECT * FROM languages";
			$query = mysql_query($sql) or die(mysql_error());
			echo "<select name='langSelected'>";
			while($row = mysql_fetch_array($query)){				
			echo "<option id=".$row['lang_id'].">".$row['lang_name']."</option>";	
			}
			echo "</select>";
			
		}		
			
		
	}
?>