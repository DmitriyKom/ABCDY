<?php
/* Date         Name            Changes
 * 11/27/2019   Andrey          Coding page
 *
 *
 *
 */
include('wrapper/Header.php');
	session_start();//session is starting
	//checking if loggedin session is set, and role is Manager, if not rederecting to main page
	if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["role"]) || $_SESSION["role"] !== "Manager") {
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
	function getUserName($user_id, $link){//this function is returning training title(aka name) from the training id
		$select_user_name_query = "SELECT username from users where id='".$user_id."'";	
		$answr = "UNKNOWN ERROR";	
		if ($result = mysqli_query($link, $select_user_name_query)) {
	        if (mysqli_num_rows($result) > 0) {
	            while ($row = mysqli_fetch_array($result)) {
	            	$answr = $row['username'];
	            }
	        }
      }
		return $answr;
	}
?>
    <script type="text/javascript" src="./js_scripts/addMoreLinks.js"></script>
    <title>Trainings</title>

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
            width: 95%;
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
    </style>
<div class="page-header">
    <h1><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> here you will be able to see all assigned trainings.</h1>
    <br><br>
    <div>
        <form action="./php_scripts/NONE.php" method="get">
            <table align="center">
                <tr>
                    <th>Training ID</th>
                    <th>Training Title</th>
                    <th>Assigned To</th>
                    <th>Assigned By</th>
						  <th>Assigned Date</th>
                    <th>Completed Date</th>
                </tr>
					<?php 
					  include_once("./includes/open_conn.inc"); //opening connection to db
					  $select_query = "SELECT * FROM training_assigned";
					  if ($res = mysqli_query($link, $select_query)) {
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_array($res)) {
                        	echo "<tr>";
                        	echo "<td>". $row['training_id'] ."</td>";
                        	echo "<td>".getTrainingName($row['training_id'], $link)."</td>";
                        	echo "<td>".getUserName($row['assigned_user_id'], $link)."</td>";
                        	echo "<td>".getUserName($row['assigned_by'], $link)."</td>";
									echo "<td>".$row['assigned_dt']."</td>";
									echo "<td>".$row['completed_dt']."</td>";
                        	echo "</tr>";
                        }
                    }
                 }
					
					
					 include_once("./includes/close_conn.inc"); //closing connection to db
					?>
                
            </table>
        </form>
        <p>
            <a href="./manager.php" type="reset" class="btn btn-default" value="Back">Back</a>
        </p>
	</div>
</div>
<?php
include('wrapper/Footer.php');
?>



























