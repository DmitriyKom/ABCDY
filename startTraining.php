<?php

/* Date         Name            Changes
 * 11/27/2019   Andrey          Coding page
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Training</title>
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
    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
</div>


    <br><br>
   

<p>

    <a href="./php_scripts/sign_out.php" class="btn btn-danger">Sign Out of Your Account</a>
</p>
</body>
</html>