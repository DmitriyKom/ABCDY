<?php
/* Date         Name            Changes
 * 11/27/2019   Dmitriy           Coding page
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
include_once("./includes/open_conn.inc");    //opening connection to db
function getTrainingName($test_id, $link)
{//this function is returning  test title(aka name) from the  test id
    //	include_once("./includes/open_conn.inc");	//opening connection to db
    $select_title_query = "SELECT  test_title from  test where  test_id='" . $test_id . "'";
    $answr = "UNKNOWN ERROR";
    if ($result = mysqli_query($link, $select_title_query)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $answr = $row['test_title'];
            }
        }
    }
    return $answr;
}


?>
<script type="text/javascript" src="./js_scripts/addMoreLinks.js"></script>
<title>Assign Training</title>
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

    .page-header {
        background-color: white;
        margin-left: -10%;
        width: 700px;
        margin-top: -30px;
        display: block;
        overflow: auto;
        height: 600px;
        display: block;
    }
</style>
<div class="page-header">
    <h1><b><?php echo htmlspecialchars($_SESSION["username"]); ?>
        </b> please select users to assign<span style="color:red;"></h1>
    <h1><?php echo htmlspecialchars(getTrainingName($_GET['test_id'], $link)); ?></span>
        Training to:</h1>
    <br><br>
    <div>
        <form action="./php_scripts/assignTest.php" method="post">
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
                echo '<input type="hidden" name=" test_id" value="' . $_GET['test_id'] . '">'; // hidden field for sending  test id into form action script
                $num_of_columns = 5;
                $counter = 0;
                $select_query = "SELECT username, id, role, firstName, lastName from users, user_info where users.id = user_info.user_id and enabled=b'1' and role='Trainee'";     // this query is selecting trainee user info from two tables: users and user_info
                if ($result = mysqli_query($link, $select_query)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            if (($counter % $num_of_columns) == 0) {
                                echo "<tr>";
                            }
                            
                            echo "<td>";
                            echo '<input type="checkbox" name="checked_trainiees[]" value="' . $row['id'] . '" title="' . $row['username'] . " is " . $row['role'] . " whose id is " . $row['id'] . ' and name is ' . $row['firstName'] . " " . $row['lastName'] . '" > ' . $row['username'];
                            echo "</td>";
                            
                            if (($counter % $num_of_columns) == $num_of_columns - 1) {
                                echo "</tr>";
                            }
                            
                            $counter++;
                            
                        }
                        if (($counter % $num_of_columns) != $num_of_columns - 1 || ($counter % $num_of_columns) == $num_of_columns - 1) {
                            echo "</tr>";
                        }
                    }
                }
                include_once("./includes/close_conn.inc"); //closing connection to db
                ?>
            </table>
            <br>
            <div class="form-group">
                <a href="./showAllTrainings.php" type="reset" class="btn btn-default" value="Back">Back</a>
                <input type="submit" class="btn btn-primary" value="Assign Test To Selected Users">
            </div>
        </form>
        <?php
        include('wrapper/Footer.php');
        ?>



























