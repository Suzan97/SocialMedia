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
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link rel="shortcut icon" href="css/Images/hoe1.png" type="image/x-icon">
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
         <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">

        <script type="text/javascript">
            $(window).on('scroll',function() {
                if($(window).scrollTop()) {
                    $('nav').addClass('black');
                }
                else{
                    $('nav').removeClass('black');
                }
            })

        </script>
        <style>
            table {
                border-collapse: collapse;
                width: 70%;
                align-content: center;
                margin-left: 10%;


            }

            th, td {
                text-align: left;
                padding: 8px;
                height: 50px;
            }

            tr:nth-child(even){background-color: #f2f2f2}

            th {
                background-color: darkgrey;
                color: white;
            }
               tr td:hover{
                color: #069370;
            }
            td a{
                text-decoration: none;
                color: #151515;
                padding: 12px 30px;
                text-transform: uppercase;
                background-color:  darkgray;
                text-align: center;
                display: inline-block;
                line-height: 20px;
                text-decoration: none;
                text-transform: uppercase;
                transition: .3x;
                border-radius: 10px;




            }
            a:hover{
                color: white;
            }
        </style>

    </head>
    <body>
        <div class="wrapper">
            <nav>
                <div class="logo">Tulime</div>
                <ul>
                    <li><a href="update.php">Update</a></li>
                    <li><a href="events.php">Events</a></li>
                    <li><a href="greport.php">Report</a></li>
                    <li><a  class="active" href="adminlogout.php">Logout</a>

                </ul>
            </nav>
            <section class="sec1"></section>
            <section class="content">


                <?php
                $con=mysqli_connect('localhost', 'root', '','tulime')
                    or die("Could not establish connection");

                mysqli_select_db($con,'tulime') or
                    die ("Could not select the db");

                $sql="SELECT * FROM users";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row

                    echo "<table><tr><th>user id</th><th>Username</th><th>Email</th><th>Image</th><th></th><th></th></tr>";
                    while($row = $result->fetch_assoc()) {


                        echo "<tr>
                         <td>" .$row['user_id'] ."</td>
                        <td>" .$row['username'] ."</td>
                        <td>" .$row['email']."</td>
                        <td>" .$row['profileimg']."</td>



                        <td><a href=\"deleteuser.php?user_id=$row[user_id]\">Delete</a></td>


                        </tr>" ;


                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }

                ?>







            </section>
        </div>
    </body>
    <!-- <footer class="footer-distributed">

            <div class="footer-left">

                <h3>Tulime<span>logo</span></h3>

                <p class="footer-links">
                    <a href="homepage.php">Home</a>
                    .
                    <a href="profile.php">Profile</a>
                    .
                    <a href="search.php">Search</a>
                    .
                    <a href="#">Contact</a>

                </p>

                <p class="footer-company-name">Tulime &copy; 2018</p>
            </div>

            <div class="footer-center">

                <div>
                    <i class="fa fa-map-marker"></i>
                    <p><span>Africa Nazarene</span>Rongai, Kajiado</p>
                </div>

                <div>
                    <i class="fa fa-phone"></i>
                    <p>+25471234567</p>
                </div>

                <div>
                    <i class="fa fa-envelope"></i>
                    <p><a href="mailto:support@company.com">Tulime@company.com</a></p>
                </div>

            </div>

            <div class="footer-right">

                <p class="footer-company-about">
                    <span>About the company</span>
                    Tulime is an online platform for people
                    to book events, and view events.
                </p>

                <div class="footer-icons">

                    <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                    <a href="https://twitter.com/"><i class="fa fa-twitter"></i></a>
                    <a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a>
                    <a href="https://github.com/"><i class="fa fa-github"></i></a>

                </div>

            </div>

        </footer> -->

</html>
