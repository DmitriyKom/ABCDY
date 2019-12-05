<?php

/* Date         Name            Changes
 * 9/22/2019    Charles 		  web template
 * 10/27/2019   Andrey          Coding page
 * 10/28/2019   Dmitriy         Code Cleanup
 *	11/29/2019   Andrey 			  Some addings
 *
 *
 */
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Trainee</title>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">-->
    <link rel="stylesheet" href="./design/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
            text-align: center;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 75%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
<div class="page-header">
    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the training site.</h1>
</div>
    <br><br>
    <table align="center">
        <tr>
            <th>Training Completed?</th>
            <th>Training Course</th>
            <th>Link To Training</th>
        </tr>
        <tr>
            <td>No</td>
            <td>ForkLift Traning 101</td>
            <td><a href="ForkLift.php">Start Training</a></td>
		 </tr>
		 <?php 
		 	include_once("./includes/open_conn.inc"); //opening connection to db
		 	$select_query = "SELECT * FROM training_assigned where assigned_user_id='".$_SESSION['user_id']."'";
		 	if ($res = mysqli_query($link, $select_query)) {
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_array($res)) {
                        	echo "<tr>";
                        	echo "<td>".($row['completed_dt'] == NULL ? "NOT YET" : "Yes AT: ".$row['completed_dt'])."</td>";
                        	echo "<td>".getTrainingName($row['training_id'], $link)."</td>";
                        	echo "<td><a href='./startTraining.php?training_id=".htmlspecialchars($row['training_id'])."&user_id=".htmlspecialchars($row['assigned_user_id'])."' class='btn btn-info' title='Click this button to assign training ".htmlspecialchars($row['training_id'])." to users'>Start Training</a></td>";
                        	
									
                        	echo "</tr>";
                        }
                    }
                 }
		 
		 	include_once("./includes/close_conn.inc"); //closing connection to db
		 ?>
    </table>

<p>

    <a href="./php_scripts/sign_out.php" class="btn btn-danger">Sign Out of Your Account</a>
</p>
</body>
</html>