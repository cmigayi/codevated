<?php

require_once("classes/function_class.php");	
	session_start();
	
	if(isset($_SESSION['user_id'])){
		$user = $_SESSION['user_id'];
	}else{
		header("Location: index.php");
	}

	$func = new FunctionClass();
    
    if(isset($_FILES['image'])){
      $errors= array();      
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      $file_name = $user.".".$file_ext;
        
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         if(move_uploaded_file($file_tmp,"profile_img/".$file_name)){
             $imgLink = "http://localhost/codevated/profile_img/".$file_name;
             if($func->updateUploadedProfilePic($user,$imgLink)==true){
                 echo "Upload successful!";
             }else{
                 echo "Upload failed!";
             }
         }
      }else{
         print_r($errors);
      }
   }
?>