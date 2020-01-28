<html>
<head>
     <title>Tulime</title>
     <link rel="shortcut icon" href="css/Images/hoe1.png" type="image/x-icon">
     <link rel="stylesheet" type="text/css" href="css/event.css">
      <link rel="stylesheet" type="text/css" href="css/style.css">

 </head>
    <?php


    $DB_HOST = "localhost";
    $DB_NAME = "tulime";
    $DB_USER = "root";
    $DB_PASS = "";

    $con = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

    $id = (isset($_POST['id']) ? $_POST['id'] : '');

    if(isset($_POST['submit'])) {
        $id = (isset($_POST['id']) ? $_POST['id'] : '');
        $body = (isset($_POST['body'])  ? $_POST['body'] : '');
        $posted_at= (isset($_POST['posted_at'])  ? $_POST['posted_at'] : '');
        $user_id = (isset($_POST['user_id'])  ? $_POST['user_id'] : '');
        $likes = (isset($_POST['likes'])  ? $_POST['likes'] : '');
        // $postimg = $_POST['postimg'];
        // $topics = $_POST['topics'];


        //update db
        // $sql= "UPDATE posts SET id='$_POST[id]',
        // body='$_POST[body]',posted_at='$_POST[posted_at]',
        // user_id='$_POST[user_id]',likes='$_POST[likes]',
        // postimg='$_POST[postimg]',topics='$_POST[topics]',
        //  WHERE id='$_POST[id]' ";

         $sql="UPDATE posts SET id=$id,
         body=$body,posted_at=$posted_at,
         user_id=$user_id,likes=$likes,
         WHERE id = $id";


        if ($con->query($sql) === TRUE) {
            $success = "Post updated successfully";
            header("Location:postreport.php");
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
                    <li><a  class="active" href="adminlogout.php">Logout</a>

                </ul>
            </nav>
            <section></section>
            <section class="content">


            </section>
        </div>


        <?php
        $result = $con->query('SELECT * FROM posts where id = "' . $_GET["id"] . '"');



        if($result === FALSE) {
            die(mysql_error()); // TODO: better error handling
        }while($row = mysqli_fetch_array($result)) {
        ?>

        <div class="loginbox">
            <img src="css/Images/avatar.png" class="avatar">
            <h1>Update Posts</h1>
            <form method="post">
                <p>id</p>
                <input type="text" name="Event_id" value="<?php echo $row['id'] ;?>" required>
                <p>Post</p>
                <input type="text" name="post"  value="<?php echo $row['body'] ;?>"   required>
                <p>Date</p>
                <input type="datetime" name="Date"   value="<?php echo $row['posted_at'] ;?>" required>
                <p>user_id</p>
                <input type="text" name="post"  value="<?php echo $row['user_id'] ;?>"   required>
                <p>likes</p>
                <input type="text" name="Likes" value="<?php echo $row['likes'] ;?>" required>

                 <button type="submit" name="submit" class="btn btn-info">Edit Post</button>


                <?php   } ?>

            </form>
        </div>
    </body>
</html>
