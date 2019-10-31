<?php

/* Date         Name            Changes
 * 10/27/2019   Andrey          Coding page
 * 10/28/2019   Dmitriy         Code Cleanup
 *
 *
 *
 */

session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["role"]) || $_SESSION["role"] !== "Manager") {
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
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
    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the Manager Portal.</h1>
    <br><br>
    <table align="center">
        <tr>
            <th>Action Name</th>
            <th>Action Link</th>
        </tr>
        <tr>
            <td><label>Show All Trainings</label></td>
            <td><a href="./showAllTrainings.php" style="color:red;">Click here to view all trainings</a></td>
        </tr>
       
        <tr>
            <td><label>Create New Training</label></td>
            <td><a href="./addNewTraining.php" style="color:red;">Click here to start creation of New Training</a></td>
        </tr>

    </table>
</div>
<p>

    <a href="./php_scripts/sign_out.php" class="btn btn-danger">Sign Out of Your Account</a>
</p>
</body>
</html>