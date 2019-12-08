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
require_once "./includes/open_conn.inc";
$username = "";
$password = "";
$role = "";
$username_err = "";
$password_err = "";
$enabled = b'0';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, username, password, role, enabled FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $user_id, $username, $hashed_password, $role,$enabled);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                        	if($enabled==b'1'){ // checking if users account is not disabled
                        		changeLastLogInTime($user_id, $link);
	                           session_start();
	                           $_SESSION["loggedin"] = true;
	                           $_SESSION["user_id"] = $user_id;
	                           $_SESSION["username"] = $username;    
										$_SESSION["role"] = $role; 	
										switch($role){
											case "HR":
												header("location: hr.php");
												break;
											case "Trainee":
												header("location: welcome.php");
												break;
											case "Manager":
												header("location: manager.php");
												break;
											default:
												header("location: welcome.php");
												break;
										}
									}
									
							} else{
								$password_err = "The password you entered was not valid.";
						}
                    }
                } else{
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}

	function changeLastLogInTime($u_id, $link){
		$update_query = "UPDATE users SET last_login=CURRENT_TIMESTAMP WHERE id=".$u_id."";
		mysqli_query($link, $update_query);
	}
?>
    <title>Login</title>
    <link rel="stylesheet" href="./design/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif;
            background-image: url("wrapper/Background.jpeg");
            background-repeat: no-repeat;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        #wrapper{
            background-color: white;
        }
        
        .wrapper{ width: 350px; padding: 20px; background-color: white; }
    </style>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register_For_Testing_ONLY.php">Sign up For Testing ONLY now</a>.</p>
        </form>
    </div>
<?php
include('wrapper/Footer.php');
?>