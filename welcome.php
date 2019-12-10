<?php

/* Date         Name            Changes
 * 9/22/2019    Charles 		  web template
 * 10/27/2019   Andrey          Coding page
 * 10/28/2019   Dmitriy         Code Cleanup
 *	11/29/2019   Andrey 			  Some addings
 *
 *
 */
include('wrapper/Header.php');
	// Initialize the session
	session_start();
	
	// Check if the user is logged in, if not then redirect him to login page
	if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["role"]) || $_SESSION["role"] !== "Trainee") {
	    header("location: index.php");
	    exit;
	}
	function getTrainingName($training_id, $link){//this function is returning training title(aka name) from the training id
		$select_title_query = "SELECT training_title from training where training_id='".$training_id."'";	
		$answr = "UNKNOWN ERROR";	
		if ($result = mysqli_query($link, $select_title_query)) {
	        if (mysqli_num_rows($result) > 0) {
	            while ($row = mysqli_fetch_array($result)) {
	            	$answr = $row['training_title'];
	            }
	        }
      }
		return $answr;
	}
?>
    <title>Welcome Trainee</title>
    <link rel="stylesheet" href="./design/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
            text-align: center;
            background-image: url("wrapper/Background.jpeg");
            background-repeat: no-repeat;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 75%;
        }

        td, th {
            text-align: center;
            padding: 8px;
        }

        .page-header{
            background-color: white;
            margin-left: -17%;
            width: 60%;
            margin-top: -30px;
            display:block;
            overflow: scroll;
            height: 800px;
            display:block;
        }
        
    </style>
</head>
<body>
<div class="page-header">
    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the training site.</h1>
    <br><br>
    <table align="center">
        <tr>
            <th>Training Completed?</th>
            <th>Training Course</th>
            <th>Link To Training</th>
            <th>I already completed This Training</th>
        </tr>
      
		 <?php 
		 	include_once("./includes/open_conn.inc"); //opening connection to db
		 	$select_query = "SELECT * FROM training_assigned where assigned_user_id='".$_SESSION['user_id']."'";
		 	if ($res = mysqli_query($link, $select_query)) {
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_array($res)) {
                        	echo "<tr>";
                        	echo "<td>".($row['completed_dt'] == NULL ? "NO" : "Yes AT: ".$row['completed_dt'])."</td>";
                        	echo "<td>".getTrainingName($row['training_id'], $link)."</td>";
                        	if($row['completed_dt']==NULL){
                        		echo "<td><a href='./startTraining.php?training_id=".htmlspecialchars($row['training_id'])."' class='btn btn-info' title='Click this button to assign training ".htmlspecialchars($row['training_id'])." to users'>Start Training</a></td>";
                        		echo "<td><a href='./php_scripts/makeTrainingComplete.php?training_id=".htmlspecialchars($row['training_id'])."' class='btn btn-info' title='Click this button to make ".getTrainingName(htmlspecialchars($row['training_id']),$link)." training complete'>Make Completed</a></td>";
                        		echo "</tr>";
                        	
                        	}else{
										echo   "<td>Unavalable</td>";  
										echo   "<td>Training Already Completed</td>";                     	
                        	}
									
                        }
                    }
                 }
		 
		 	include_once("./includes/close_conn.inc"); //closing connection to db
		 ?>
    </table>
<br>
<p>
    <a href="./php_scripts/sign_out.php" class="btn btn-danger">Sign Out of Your Account</a>
</p>
</div>
<?php
include('wrapper/Footer.php');
?>