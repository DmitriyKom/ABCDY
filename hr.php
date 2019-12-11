<?php

/* Date         Name            Changes
 * 10/27/2019   Andrey          Coding page
 *
 *
 *
 */
include('wrapper/Header.php');
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true  ||!isset($_SESSION["role"]) || $_SESSION["role"]!=="HR"){
    header("location: index.php");
    exit;
}
?>
    <title>Welcome</title>
	 <link rel="stylesheet" href="./design/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif;
            text-align: center;
            background-image: url("wrapper/Background.jpeg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }
		table {
		  font-family: arial, sans-serif;
		  border-collapse: collapse;
		}
        
        .page-header{
            background-color: white;
            margin-left: -10%;
            width: 40%;
        }
        tr {
            background:gray;
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
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the HR Page	.</h1>
		<br><br>
		<table align="center">
		  <tr>
			<tr>
			<a href="./register.php" class="row">Add New User Into System</a>
			</tr>
			<tr>
			 <a href="./showAllUsers.php" class="row">Show All Users of System</a>
			</tr>			
			
		</table>
        <p>
            <a href="./php_scripts/sign_out.php" class="btn btn-danger">Sign Out of Your Account</a>
        </p>
    </div>
<?php
include('wrapper/Footer.php');
?>