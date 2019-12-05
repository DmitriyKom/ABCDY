<?php
	session_start();
	//print_r($_POST);
	//echo "*************************<br />";
	//print_r($_SESSION);
	//print_r($_FILES);
	//$target_dir = "uploads/";
	//$target_file = $target_dir . basename($_FILES["file_training_document"]["name"]);	
	//echo $target_file;
	
	
	$training_title = "";
	$training_video_link = "";
	$training_document_link="";
	$training_local_file_link = "";
	$training_local_file_name = "";
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
	if(isset($_FILES['file_training_document']['name']) && $_FILES['file_training_document']['name']!=""){
		$training_local_file_name  = sanitizeString($_FILES['file_training_document']['name']);
	}
	
	
	
	//echo $training_title. stripslashes($training_video_link).$training_document_link.$training_text;	
	if($training_title!="")	{
		include_once "./../includes/open_conn.inc";
		$insert_training_query = "INSERT INTO training (created_by, training_title) values (". mysqli_real_escape_string($link, $_SESSION['user_id']) .",'". mysqli_real_escape_string($link,$training_title) ."')";
		//echo "<br>".$insert_training_query;
		
		if (mysqli_query($link, $insert_training_query)) {
		      //echo "Training added successfully";
				$training_id = mysqli_insert_id($link);//getting last inserted training id
	   } else {
	       echo "ERROR: Could not able to execute sql. "
	           . mysqli_error($link);
	      
	   }
	   
	   if($training_id!=-1){//if training was added successfully and training_id was returned.
	   	$training_directory_name = createDirectory($training_id); // this is craated new directory for training and return path to it
	   	
	   	$training_local_file_link = $training_directory_name."/".$training_local_file_name; // link to file on server, with file name
	   	
	   //	echo $training_local_file_link;	
	   	move_uploaded_file($_FILES['file_training_document']['tmp_name'], "./../training_documents/".$training_local_file_link ); //upload file to server
	   	
	   
	   	if(trim($training_text)!=""){
	   		$insert_training_query = "INSERT INTO training_document (training_id, training_doc_text) values (" .mysqli_real_escape_string($link,$training_id).",'".mysqli_real_escape_string($link,$training_text)."')";
	   		//echo $insert_training_query;
	   		if (mysqli_query($link, $insert_training_query)) {
		    
	   		} else {
	       		echo "ERROR: Could not able to execute sql. "
	           	. mysqli_error($link);
	      
	   		}
	   	} 
	   	if($training_video_link!=""){
				  $insert_training_query = "INSERT INTO training_link (training_id, training_link, training_link_type) values (" .$training_id.",'".mysqli_real_escape_string($link,$training_video_link)."', 'YV')"; 	
	   		  if (mysqli_query($link, $insert_training_query)) {
		    
	   		  } else {
	       		  echo "ERROR: Could not able to execute sql. "
	              . mysqli_error($link);
	      
	   		}
	   	}
	   	if($training_document_link!=""){
				  $insert_training_query = "INSERT INTO training_link (training_id, training_link, training_link_type) values (" .$training_id.",'".mysqli_real_escape_string($link,$training_document_link)."', 'EL')"; 	
	   		  if (mysqli_query($link, $insert_training_query)) {
		    
	   		  } else {
	       		  echo "ERROR: Could not able to execute sql. "
	              . mysqli_error($link);
	      
	   		}
	   	}
	   	if($training_local_file_name!="" && $training_local_file_link!=""){
				  $insert_training_query = "INSERT INTO training_link (training_id, training_link, training_link_type) values (" .$training_id.",'".mysqli_real_escape_string($link,$training_local_file_link)."', 'IL')"; 	
	   		  if (mysqli_query($link, $insert_training_query)) {
		    
	   		  } else {
	       		  echo "ERROR: Could not able to execute sql. "
	              . mysqli_error($link);
	      
	   		}
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
	
	function sanitizeMySQL($link, $str){
		$str = mysqli_real_escape_string($link, $str);
		$str = sanitizeString($str);
		return $str;
	}
	
	function createDirectory($training_id){  //function which is creating folder to hold training documents
		$main_folder = "./../training_documents";
		if(is_dir($main_folder)===false){
			mkdir($main_folder);		
		}
		if(is_dir($main_folder."/".$training_id)==false){
			mkdir($main_folder."/".$training_id);	
		}
		return $training_id;
	}
	
	
?>