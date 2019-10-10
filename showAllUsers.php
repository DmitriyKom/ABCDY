<?php
session_start();//session is starting 
//checking if loggedin session is set, and role is Manager, if not rederecting to main page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["role"]) || $_SESSION["role"]!=="HR"){
    header("location: index.php");
    exit;
}

?>
 
<!DOCTYPE html>
<html lang="en">
	<head>
	
		<script type="text/javascript" src="./js_scripts/addMoreLinks.js"></script>
	    <meta charset="UTF-8">
	    <title>Add New Training</title>
	    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">-->
		 <link rel="stylesheet" href="./design/bootstrap.css">
	    <style type="text/css">
	        body{ font: 14px sans-serif; text-align: center; }
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
			
			<form action="./editUser.php" method="post">
			
				<table align="center">
				  <tr>
					<th>ID</th>
					<th>Login</th>
					<th>Role</th>
					<th>Enabled</th>
					<th>Edit</th>
					<th>Disable Account</th>
				  </tr>
				  
			`			<?php 
							include_once("./includes/open_conn.inc"); //opening connection to db
							$web_string="";
				  			$select_query = "SELECT id, userName, role, enabled, created_at from users";
				  			if ($res = mysqli_query($link, $select_query)) { 
			 					if (mysqli_num_rows($res) > 0) { 
			     					while ($row = mysqli_fetch_array($res)) { 
										$web_string='<tr>';
				         			$web_string.="<td>$row[id]</td>";
										$web_string.="<td>$row[userName]</td>";
										$web_string.="<td>$row[role]</td>";
										$web_string.="<td>$row[enabled]</td>";
										$web_string.='<td><a href="./php_scripts/editAccount.php" class="btn btn-danger" id="'.$row[id].'">Edit</a></td>';
										$_disable="";
										if($row[enabled]==1){
											$_disable = "Disable";
										}else{
											$_disable = "Enable";
										}	
										$web_string.='<td><a href="./php_scripts/disableAccount.php" class="btn btn-danger" id="'.$row[id].'">'.$_disable .' Acct</a></td>';					
										$web_string.="</tr>";
										echo $web_string;
					
			     					} 
			     					mysqli_free_result($res);
			 					}else { 
			     					//echo "No matching records are found."; 
			 					} 
							} else { 
    							echo "ERROR: Could not able to execute $sql. "
                                .mysqli_error($link); 
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



























