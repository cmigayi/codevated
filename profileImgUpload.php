<?php

require_once("classes/function_class.php");	
	session_start();
	
	if(isset($_SESSION['user_id'])){
		$user = $_SESSION['user_id'];
	}else{
		header("Location: index.php");
	}

	$func = new FunctionClass();
    

if(is_array($_FILES))   
 {  
      foreach ($_FILES['files']['name'] as $name => $value)  
      {  
           $file_name = explode(".", $_FILES['files']['name'][$name]);  
           $allowed_ext = array("jpg", "jpeg", "png", "gif");  
           if(in_array($file_name[1], $allowed_ext))  
           {  
                $new_name = substr(sha1(mt_rand()),0,50) . '.' . $file_name[1];  
                $sourcePath = $_FILES['files']['tmp_name'][$name];  
                $target = "profile_img/".$new_name;  
                if(move_uploaded_file($sourcePath, $target))  
                {  
                     //mysqli_query($con, "INSERT INTO images VALUES('".$target."')");
                     echo "<img src='$target' />";
                }                 
           }            
      }   
 }  

?>