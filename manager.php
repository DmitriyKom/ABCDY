<?php

/* Date         Name            Changes
 * 10/27/2019   Andrey          Coding page
 * 10/28/2019   Dmitriy         Code Cleanup
 *
 *
 *
 */
include('wrapper/Header.php');
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["role"]) || $_SESSION["role"] !== "Manager") {
    header("location: index.php");
    exit;
}
if (isset($_SESSION["Test_Question"])){
    unset($_SESSION["Test_Question"]);
}
?>
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
            margin-left: -10%;
            width: 40%;
            text-decoration: none;
        }
        a:hover{
            text-decoration: none;
            background-color: lightblue;
        }
        .row{
            color:#000000;
            margin-top: -100px;
            text-decoration: none;
            font-weight:  bold;
            font-size: 2.5em;
            line-height: 1.42857143;
            text-align: center;
            vertical-align: middle;
            border-radius: 10px;
        }
    </style>
<div class="page-header">
    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the Manager Portal.</h1>
    <br><br>
    <table align="center">
        <tr>
           <a href="./showAllTrainings.php" class="row">Show All Trainings</a>
        </tr>
        <tr>
            <a href="./showAllAssignedTrainings.php" class="row">Show All Assigned Trainings</a>
        </tr>
        <tr>
            <a href="./addNewTraining.php" class="row">Create New Training</a>
        </tr>
			<tr>
            <a href="./addNewTest.php" class="row">Create New Test</a>
        </tr>

    </table>
    <br>
    <p>
        <a href="./php_scripts/sign_out.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</div>
<?php
include('wrapper/Footer.php');
?>