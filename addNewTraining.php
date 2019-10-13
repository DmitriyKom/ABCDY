<?php
session_start();//session is starting 
//checking if loggedin session is set, and role is Manager, if not rederecting to main page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["role"]) || $_SESSION["role"]!=="Manager"){
    header("location: index.php");
    exit;
}

$training_title="";
$training_title_err="";
$training_video_link="";
$training_video_link_err="";
$training_document_link="";
$training_document_link_err="";
$training_document="";
$training_document_err="";
$training_text="";
$training_text_err="";



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
        <h1><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b> please Fill all fields for Adding New Training.</h1>
		<br><br>
	<div>
		
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<table align="center">
			  <tr>
				<th>1</th>
				<th>2</th>
				<th>3</th>
			  </tr>
			  <tr>
					<td><label>Training Title:</label> </td>
					<td>
					<div class="form-group <?php echo (!empty($training_title_err)) ? 'has-error' : ''; ?>">
	                <input type="text" name="training_title" class="form-control" value="<?php echo $training_title; ?>">
	                <span class="help-block"><?php echo $training_title_err; ?></span>
	            </div> 				
					</td>
				</tr>
				
				<tr>
					<td><label>Training Video Link:</label> </td>
					<td>
					<div class="form-group <?php echo (!empty($training_video_link_err)) ? 'has-error' : ''; ?>">
	                <input type="text" name="training_video_link" class="form-control" value="<?php echo $training_video_link; ?>">
	                <span class="help-block"><?php echo $training_video_link_err; ?></span>
	            </div> 
					</td>
					<td>
						<button onclick="addLinkInputBox(); return false;">add more video links</button>
					</td>	
				</tr>
				<div id="add_video_links">
				
				
				</div>
				
				<tr>
					<td><label>Training Document Link:</label> </td>
					<td>
					<div class="form-group <?php echo (!empty($training_document_link_err)) ? 'has-error' : ''; ?>">
	                <input type="text" name="training_document_link" class="form-control" value="<?php echo $training_document_link; ?>">
	                <span class="help-block"><?php echo $training_document_link_err; ?></span>
	            </div> 
					</td>
					<td>
						<button onclick="addLinkInputBox();">add more document links</button>
					</td>	
				</tr>
				
				<tr>
					<td><label>Training Document</label> </td>
					<td>
					<div class="form-group <?php echo (!empty($training_document_err)) ? 'has-error' : ''; ?>">
							<input type="file" name="file" class="form-control" >	              
	                <span class="help-block"><?php echo $training_document_err; ?></span>
	            </div> 
					</td>
					<td>
						<button onclick="addLinkInputBox();">add more documents</button>
					</td>	
				</tr>
			
			
				<tr>
				<td>Training Text</td>
				<td> 
					<div class="form-group <?php echo (!empty($training_text_err)) ? 'has-error' : ''; ?>">
	                <textarea rows="20" cols="100" name="training_text">
	                
	                </textarea>
	                <span class="help-block"><?php echo $training_text_err; ?></span>
	            </div>			
				</td>
				</tr>
			</table>
			
			<div class="form-group">
				 <a href="./manager.php" type="reset" class="btn btn-default" value="Back">Back</a>
             <input type="submit" class="btn btn-primary" value="Submit">
             <input type="reset" class="btn btn-default" value="Reset" style="color: red;">
         </div>
		</form>
    
    <div class="" id="message_box">
    	<textarea rows="10" cols="100" name="output_text">
	        messages will be shown here        
	   </textarea>
    </div>
    <p>

        <a href="./php_scripts/sign_out.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    
    
    
    
</body>
</html>



























