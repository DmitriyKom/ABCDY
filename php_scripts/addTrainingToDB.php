<?php
	session_start();
	//print_r($_POST);
	//echo "*************************<br />";
	//print_r($_SESSION);
	
	$training_title = "";
	$training_video_link = "";
	$training_document_link="";
	$training_local_file_link = "";
	$training_text = "";
	$training_id = -1;	
	
	if(isset($_POST['training_title'])){
		$training_title = $_POST['training_title'];
	}
	if(isset($_POST['training_video_link'])){
		$training_video_link = $_POST['training_video_link'];
	}
	if(isset($_POST['training_document_link'])){
		$training_document_link = $_POST['training_document_link'];
	}
	if(isset($_POST['training_text'])){
		$training_text = sanitizeString($_POST['training_text']);
	}
	if(isset($_POST['file'])){
		$training_local_file_link  = sanitizeString($_POST['file']);
	}
	
	
	
	//echo $training_title. stripslashes($training_video_link).$training_document_link.$training_text;	
	if($training_title!="")	{
		include_once "./../includes/open_conn.inc";
		$insert_training_query = "INSERT INTO training (created_by, training_title) values (". $_SESSION['user_id'] .",'". mysqli_real_escape_string($link,$training_title) ."')";
		//echo "<br>".$insert_training_query;
		if (mysqli_query($link, $insert_training_query)) {
		      //echo "Training added successfully";
				$training_id = mysqli_insert_id($link);
	   } else {
	       echo "ERROR: Could not able to execute sql. "
	           . mysqli_error($link);
	      
	   };
	   if($training_id!=-1){
	   	if($training_text!=""){
	   		$insert_training_query = "INSERT INTO training_document (training_id, training_doc_text) values (" .$training_id.",'".mysqli_real_escape_string($link,$training_text)."')";
	   		//echo $insert_training_query;
	   		if (mysqli_query($link, $insert_training_query)) {
		    
	   		} else {
	       		echo "ERROR: Could not able to execute sql. "
	           	. mysqli_error($link);
	      
	   		};
	   	} 
	   	if($training_video_link!=""){
				  $insert_training_query = "INSERT INTO training_link (training_id, training_link, training_link_type) values (" .$training_id.",'".mysqli_real_escape_string($link,$training_video_link)."', 'YV')"; 	
	   		  if (mysqli_query($link, $insert_training_query)) {
		    
	   		  } else {
	       		  echo "ERROR: Could not able to execute sql. "
	              . mysqli_error($link);
	      
	   		};
	   	}
	   	if($training_document_link!=""){
				  $insert_training_query = "INSERT INTO training_link (training_id, training_link, training_link_type) values (" .$training_id.",'".mysqli_real_escape_string($link,$training_document_link)."', 'IL')"; 	
	   		  if (mysqli_query($link, $insert_training_query)) {
		    
	   		  } else {
	       		  echo "ERROR: Could not able to execute sql. "
	              . mysqli_error($link);
	      
	   		};
	   	}
	   	if($training_local_file_link!=""){
				  $insert_training_query = "INSERT INTO training_link (training_id, training_link, training_link_type) values (" .$training_id.",'".mysqli_real_escape_string($link,$training_local_file_link)."', 'EL')"; 	
	   		  if (mysqli_query($link, $insert_training_query)) {
		    
	   		  } else {
	       		  echo "ERROR: Could not able to execute sql. "
	              . mysqli_error($link);
	      
	   		};
	   	}
   	}
		include_once "./../includes/close_conn.inc";
		
   }
	header("location: ./../showAllTrainings.php");	
	
		
	
	function sanitizeString($str){
		if(get_magic_quotes_gpc()) $str = stripslashes($str);	
		$str= htmlentities($str);
		$str=strip_tags($str);
		return $str;
	}	
	
	function sanitizeMySQL($str){
		$str = mysqli_real_escape_string($str);
		$str = sanitizeString($str);
		return $str;
	}
?>