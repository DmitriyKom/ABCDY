<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
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
			<td> <a href="ForkLift.php">Click here to view your training</a> </td>

		</table>
    </div>
    <p>

        <a href="index.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>