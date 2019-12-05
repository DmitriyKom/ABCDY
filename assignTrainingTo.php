<?php
/* Date         Name            Changes
 * 11/27/2019   Andrey          Coding page
 *
 *
 *
 */

	session_start();//session is starting
	//checking if loggedin session is set, and role is Manager, if not rederecting to main page
	if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["role"]) || $_SESSION["role"] !== "Manager") {
	    header("location: index.php");
	    exit;
	}
	include_once("./includes/open_conn.inc");	//opening connection to db
	function getTrainingName($training_id, $link){//this function is returning training title(aka name) from the training id
	//	include_once("./includes/open_conn.inc");	//opening connection to db
		$select_title_query = "SELECT training_title from training where training_id='".$training_id."'";	
		$answr = "UNKNOWN ERROR";	
		if ($result = mysqli_query($link, $select_title_query)) {
	        if (mysqli_num_rows($result) > 0) {
	            while ($row = mysqli_fetch_array($result)) {
	            	$answr = $row['training_title'];
	            }
	        }
      }
		//include_once("./includes/close_conn.inc"); //closing connection to db
		return $answr;
	}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="./js_scripts/addMoreLinks.js"></script>
    <meta charset="UTF-8">
    <title>Assign Training</title>

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
    <h1><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> please select users to whom assign <span style="color:red;"><?php echo htmlspecialchars(getTrainingName($_GET['training_id'], $link));?></span> Training to:</h1>
    <br><br>
    <div>
        <form action="./php_scripts/assignTraining.php" method="post">
            <table align="center">
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  <!--  <th></th>
                    <th></th>-->
                </tr>
					<?php 
						echo '<input type="hidden" name="training_id" value="'.$_GET['training_id'].'">'; // hidden field for sending training id into form action script
						$num_of_columns = 5;
						$counter = 0;
						
						//$select_query = "SELECT username, role, id from users where enabled=b'1'";		
						$select_query = "SELECT username, id, role, firstName, lastName from users, user_info where users.id = user_info.user_id and enabled=b'1' and role='Trainee'";	 // this query is selecting trainee user info from two tables: users and user_info
						if ($result = mysqli_query($link, $select_query)) {
					        if (mysqli_num_rows($result) > 0) {
					            while ($row = mysqli_fetch_array($result)) {
					            	if(($counter % $num_of_columns) == 0){
											echo "<tr>";					            	
					            	}
					            	
					            	echo "<td>";
					            	
					            	
					            	echo '<input type="checkbox" name="checked_trainiees[]" value="'.$row['id'].'" title="'.$row['username']." is ".$row['role']." whose id is ".$row['id'].' and name is '.$row['firstName']." ".$row['lastName'].'" > '.$row['username'];
					            	
					            	
					            	echo "</td>";
					            	
										if(($counter % $num_of_columns) == $num_of_columns-1){
					            		echo "</tr>";
					            	}
					            	
					            	$counter++;
					            	
					            }
					            if(($counter % $num_of_columns) != $num_of_columns-1 || ($counter % $num_of_columns) == $num_of_columns-1){
					            	echo "</tr>";
					            }
					        }
				      }
				      //print_r($link);
						include_once("./includes/close_conn.inc"); //closing connection to db					
					
					?>
          
            </table>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Assing Trainin To Selected Users">
            </div>
        </form>
        <p>
            <a href="./showAllTrainings.php" type="reset" class="btn btn-default" value="Back">Back</a>
            <a href="./php_scripts/sign_out.php" class="btn btn-danger">Sign Out of Your Account</a>
        </p>


</body>
</html>



























