<?php
/* Date         Name            Changes
 * 10/27/2019   Andrey          Coding page
 * 10/28/2019   Dmitriy         Code Cleanup
 *
 *
 *
 */

session_start();//session is starting
//checking if loggedin session is set, and role is Manager, if not rederecting to main page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["role"]) || $_SESSION["role"] !== "HR") {
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="./js_scripts/addMoreLinks.js"></script>
    <meta charset="UTF-8">
    <title>Handle Users</title>

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
    <h1><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> here you will be able to edit users.</h1>
    <br><br>
    <div>
        <form action="./php_scripts/handleAccnt.php" method="get">
            <table align="center">
                <tr>
                    <th>ID</th>
                    <th>Login</th>
                    <th>Role</th>
                    <th>Created On</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Disable/Enable Account</th>
                </tr>

                ` <?php
                include_once("./includes/open_conn.inc"); //opening connection to db
                $web_string = "";  // variable to write on the web page
                $select_query = "SELECT user_id, userName, role, enabled_1, created_at from users";
                if ($res = mysqli_query($link, $select_query)) {
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_array($res)) {
                            $web_string = '<tr>';
                            $web_string .= "<td>$row[user_id]</td>";
                            $web_string .= "<td>$row[userName]</td>";
                            $web_string .= "<td>$row[role]</td>";
                            $web_string .= "<td>$row[created_at]</td>";
                            $web_string .= "<td>($row[enabled]." == 1 ? 'Enabled' : "Disabled )</td>";
                            $web_string .= '<td><a href="./editAccount.php?user)id=' . $row[user_id] . '" class="btn btn-danger">Edit</a></td>';
                            
                            $_disable = "";
                            
                            $user_id = $row[user_id];
                            $_disable = ($row[enabled] == 0 ? "Enable" : "Disable"); // checking if account is Disabled or Not and assign String value to variable
                            
                            $web_string .= '<td><input type="submit" class="btn btn-danger" name="' . $row[user_id] . '" value="' . $_disable . '" /></td>';
                            $web_string .= "</tr>";
                            echo $web_string; // printing to the web page.
                        }
                        mysqli_free_result($res);
                    } else {
                        //echo "No matching records are found.";
                    }
                } else {
                    echo "ERROR: Could not able to execute $sql. "
                        . mysqli_error($link);
                    https://www.w3schools.com/
                    return false;
                };
                
                
                include_once("./includes/close_conn.inc"); //closing connection to db
                ?>
            </table>
        </form>
        <p>
            <a href="./hr.php" type="reset" class="btn btn-default" value="Back">Back</a>
            <a href="./php_scripts/sign_out.php" class="btn btn-danger">Sign Out of Your Account</a>
        </p>


</body>
</html>


























