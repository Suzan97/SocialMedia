<html>
    <head>
        <title>Tukutane</title>
        <link rel="shortcut icon" href="css/Images/_ico-2.png" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="css/event.css">
         <link rel="stylesheet" type="text/css" href="css/style.css">

    </head>
    <?php

    $DB_HOST = "localhost";
    $DB_NAME = "tulime";
    $DB_USER = "root";
    $DB_PASS = "";

    $con = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);



    if(isset($_POST['submit'])) {
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $password= $_POST['password'];
        $email = $_POST['email'];
        $profileimg = $_POST['profileimg'];


        //update db
        $sql= "UPDATE users SET user_id='$_POST[user_id]',
        username='$_POST[username]',password='$_POST[password]',
        email='$_POST[email]',profileimg='$_POST[profileimg]' WHERE user_id='$_POST[user_id]' ";



        if ($con->query($sql) === TRUE) {
            $success = "Event updated successfully";
            header("password:editprof.php");
        } else {
            $error = "Error: " . $con->error;
        }


    }


    ?>


    <body>


         <div class="wrapper">
            <nav>
                <div class="logo">Tulime</div>
                <ul>
                    <li><a href="update.php">Update</a></li>
                    <li><a  class="active" href="logout.php">Logout</a>

                </ul>
            </nav>
            <section></section>
            <section class="content">


            </section>
        </div>


        <?php
        $user_id="";
        $result = $con->query('SELECT * FROM users where user_id = "' . $_GET["user_id"] . '"');



        if($result === FALSE) {
            die(mysql_error()); // TODO: better error handling
        }while($row = mysqli_fetch_array($result)) {
        ?>

        <div class="loginbox">
            <img src="css/Images/event.png" class="avatar">
            <h1>Update Events</h1>
            <form method="post">
                <p>id</p>
                <input type="text" name="user_id" value="<?php echo $row['Event_id'] ;?>" required>
                <p>Username</p>
                <input type="text" name="username"  value="<?php echo $row['username'] ;?>"   required>
                <p>password</p>
                <input type="text" name="password" value="<?php echo $row['password'] ;?>" required>
                <p>email</p>
                <input type="email" name="email"   value="<?php echo $row['email'] ;?>" required>
                <p>profileimg</p>
                <input type="Time" name="Begin_Time"  value="<?php echo $row['Begin_Time'] ;?>" required>

                 <button type="submit" name="submit" class="btn btn-info">Edit Records</button>


                <?php   } ?>

            </form>
        </div>
    </body>
</html>
