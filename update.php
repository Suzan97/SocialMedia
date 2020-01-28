<?php
session_start();
if(isset($_SESSION['adminname'])){

    $adminname = $_SESSION['adminname'];
    //$role = $_SESSION['role'];
}else
{
    header('location:adminsign.php');
}
?>

<html>
    <head>
        <title>Tulime</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link rel="shortcut icon" href="css/Images/_ico-2.png" type="image/x-icon">
        </head>
        <body>
            <div class="loginbox">
                <form>
                <img src="css/Images/avatar.png" class="avatar">

                   <input type="submit" name="" formaction="people.php" value="View users">
                  <!-- <input type="submit" name="" formaction="addevent.php" value="Add events"> -->
                     <input type="submit" name="" formaction="greport.php" value="View reports">



                </form>
            </div>
        </body>
</html>
