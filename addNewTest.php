<?php
/* Date         Name            Changes
 * 11/3/2019   Dmitriy         Initial development
 *
 *
 *
 */
session_start();//session is starting
//checking if logged in session is set, and role is Manager, if not rederecting to main page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["role"]) || $_SESSION["role"] !== "Manager") {
    header("location: index.php");
    
    exit;
}
if(isset($_POST['Add'])){
    add_row();
}
if(isset($_POST['Submit'])){
    submit();
}
if(isset($_POST['Reset'])){
    unset($_POST);
    $_SESSION["Test_Question"] = 1;
    $testQuestion = 1;
}
if(isset($_POST['Back'])){
    header("../manager.php");
}
function add_row()
{
    $_SESSION["Test_Question"]++;
}
function submit( )
{

}
$testQuestion = $_SESSION["Test_Question"];
$answer = null;
$answer1 = null;
$answer2 = null;
$answer3 = null;
$question = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <script type="text/javascript" src="./js_scripts/addMoreLinks.js"></script>
    <meta charset="UTF-8">
    <title>Add New Training</title>
    <link rel="stylesheet" href="./design/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
            text-align: center;
        }
        #mainbox{
            border: 2px solid #dddddd;
            height: 300px;
            
        }
        #question{
            width: 100%;
            margin-top: 50px;
            
        }
        
        #answer{
            float: left;
            clear: right;
            width: 100%;
        }
        .inbox{
            float: left;
            border: 1px solid #dddddd;
            text-align: left;
            padding: 10px;
            margin 10px;
            clear: right;
        }
        .title{
            float: left;
            text-align: left;
            margin: 10px;
            
        }
        .outbox{
            float: left;
            margin-left: 30px;
            margin-top: 10px;
            
        }
        #quest{
            width: 75%;
        }
    </style>
</head>
<body>
<div class="page-header">
    <h1><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>
    </h1>

        <form action="addNewTest.php" method="post">
            <div >
                <?php
                if(!isset($testQuestion)){
                    $testQuestion = 1;
                    $_SESSION["Test_Question"] = $testQuestion;
                }
                for($x = 0; $x<$testQuestion; $x++){
                    if
                    echo "<div  id='mainbox' style = 'background-color = ".$color.">";
                        echo "<div class = 'title' id='question'>";
                            echo "Test Question ";
                            echo "<br>";
                            echo "<input type='text' name='test_".$x."' id='quest' class='inbox'>";
                        echo "</div>";
                        echo "<div class='title' id='answer'>";
                            echo "Correct answer";
                            echo "<br>";
                            echo "<input type='text' name='test_".$x."'  class='inbox'>";
                        echo "</div>";
                            echo "<br>";
                        echo "<div class='title' id='answer'>";
                            echo "Other possible choices";
                            echo "<br>";
                            echo "<input type='text' name='test_".$x."' class='inbox'>";
                            echo "<input type='text' name='test_".$x."' class='inbox'>";
                            echo "<input type='text' name='test_".$x."' class='inbox'>";
                        echo "</div>";
                    echo "</div>";
                }
                ?>
            <div class="outbox">
                <input type="Submit" name="Add" class="btn btn-default" value="Add Question">
                <input type="Submit" class="btn btn-default" name = "Reset" value="Reset" style="color: red;">
                <input  type="Submit" name = "Submit"class="btn btn-default" >
                <a href="./manager.php" type="reset" class="btn btn-default" value="Back">Back</a>
                
            </div>
        </form>

</body>
</html>




























