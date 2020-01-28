<?php
$DB_HOST = "localhost";
$DB_NAME = "tulime";
$DB_USER = "root";
$DB_PASS = "";

$con = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if($con->connect_errno > 0) {
    die('Connection failed [' . $con->connect_error . ']');
}

if(isset($_GET['user_id'])){
$user_id = $_GET['user_id'];
#$Location=$_GET['Location'];

#$sql = "DELETE FROM event WHERE Event_id = '$id'";
# $sql= "DELETE FROM `project`.`event` WHERE `event`.`Event_id` = '$id'";
#$sql ="DELETE FROM event WHERE Location = '$Location' ";
$sql = "DELETE FROM posts WHERE user_id = '$user_id'";
}
if ($con->query($sql) === TRUE) {
    header("location:people.php");
}
else {
    echo "Error: " . $con->error;
}

$con->close();

?>
