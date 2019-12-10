<?php

/* Date         Name            Changes
 * 10/27/2019   Andrey          Coding page
 * 10/28/2019   Dmitriy         Code Cleanup
 *
 *
 *
 */
//include('wrapper/Header.php');
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["role"]) || $_SESSION["role"] !== "Manager") {
    header("location: index.php");
    exit;
}
if (isset($_SESSION["Test_Question"])){
    unset($_SESSION["Test_Question"]);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">-->
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
            text-decoration: none;
            opacity: 70%;
       
        }
        a:hover{
            text-decoration: none;
            background-color: lightblue;
        }
        .row{
            color:#000000;
            text-decoration: none;
            font-weight:  bold;
            font-size: 2.5em;
            text-align: center;
            vertical-align: middle;
            padding-bottom: -100px;
            display: block;
        }
		  #Banner{
				margin-left: auto;
  				margin-right: auto;
            width: 100%;
            height: 130px;
            background-color: whitesmoke;
				text-align: center;
        }
        #Logo{

            margin-left: auto;
  				margin-right: auto;
            width:100px;
            height: 100px;
            margin-top: 10px;
            text-align: center;
            font-size: 7em;
            font-family: "Brush Script MT";
        }
    </style>
</head> 
<body>   
<div id="Banner">
    <div id="Logo">ABCDY</div>
</div>
<div class="page-header">
    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?>.
           <br>
        </b> Welcome to the Manager Portal.</h1>
</div> 
    <br>
    <br>
    <br>
    <a href="./showAllTrainings.php" class="row">Show All Trainings</a></li>
    <br>
    <a href="./showAllAssignedTrainings.php" class="row">Show All Assigned Trainings</a></li>
    <br>
    <a href="./ShowAllTest.php" class="row">Show All Tests</a></li>
    <br>
    <a href="./showAllAssignedTest.php" class="row">Show All Assigned Tests</a>
    <br>
    <a href="./addNewTraining.php" class="row">Create New Training</a>
    <br>
    <a href="./addNewTest.php" class="row">Create New Test</a>
    <br>
    <p>
        <a href="./php_scripts/sign_out.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>

<?php
include('wrapper/Footer.php');
?>