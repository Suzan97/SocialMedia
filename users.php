<?php
ini_set('display_errors', '1');
include('./database/DB.php');
include('./Login/Login.php');
include('./database/post.php');
include('./database/Comment.php');


$showTimeline = False;
if(Login::isLoggedIn()) {
  $user_id = Login::isLoggedIn();
}else{
  echo "<script type='text/javascript'> alert('logged in!');
       setTimeout(
                function(){
                          window.location.href = 'login.php';
                               },10
                                   );

                                        </script>";
      }
      ?>

      <?php

    // session_start();
    // if(isset($_SESSION['username']) && isset($_SESSION['password'])){
    //
    //     $usernname = $_SESSION['username'];
    //     $password = $_SESSION['password'];
    //
    //     //$role = $_SESSION['role'];
    // }else
    // {
    //     header('location:login.php');
    // }


    ?>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tulime</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
        <link rel="stylesheet" href="assets/css/Footer-Dark.css">
        <link rel="stylesheet" href="assets/css/Highlight-Clean.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
        <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
        <link rel="stylesheet" href="assets/css/Navigation-Clean1.css">
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/untitled.css">
        <link rel="shortcut icon" href="css/Images/hoe1.png" type="image/x-icon">
    </head>

            <style>
                table {
                    border-collapse: collapse;
                    width: 70%;
                    margin-left: 10%;

                }

                th, td {
                    text-align: left;
                    padding: 8px;
                    height: 50px;
                }

                tr:nth-child(even){background-color: #f2f2f2}

                th {
                    background-color: #78AB46;
                    color: white;
                }
                tr td:hover{
                    color:#78AB46;
                }
                td a{
                    text-decoration: none;
                    color: #151515;
                    padding: 12px 30px;
                    text-transform: uppercase;
                    background-color: #78AB46;
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
                  <header class="hidden-sm hidden-md hidden-lg">
                      <div class="searchbox">
                        <form>
                            <h1 class="text-left">Tulime</h1>
                            <div class="searchbox"><i class="glyphicon glyphicon-search"></i>
                                <input class="form-control sbox" type="text">
                                <ul class="list-group autocomplete" style="position:absolute;width:100%; z-index: 100">
                               </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button">MENU <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li role="presentation"><a href="profile.php">My Profile</a></li>
                                    <li class="divider" role="presentation"></li>
                                    <li role="presentation"><a href="index.html">Timeline </a></li>
                                    <li role="presentation"><a href="messages.html">Messages </a></li>
                                    <li role="presentation"><a href="notify.php">Notifications </a></li>
                                    <li role="presentation"><a href="#">My Account</a></li>
                                    <li role="presentation"><a href="users.php">Users</a></li>
                                    <li role="presentation"><a href="logout.php">Logout </a></li>
                                </ul>
                            </div>
                        </form>
                      </div>
                      <hr>
                  </header>
                  <div>
                      <nav class="navbar navbar-default hidden-xs navigation-clean">
                          <div class="container">
                              <div class="navbar-header"><a class="navbar-brand navbar-link" href="#"><i class="icon ion-ios-navigate"></i></a>
                                  <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                              </div>
                              <div class="collapse navbar-collapse" id="navcol-1">
                                <form class="navbar-form navbar-left" action="users.php" method="post">

                                    <div class="searchbox"><i class="glyphicon glyphicon-search"></i>
                                        <input class="form-control sbox" type="text" name="valueToSearch" placeholder="Search Users">
                                        <button class="search-btn" type="submit" name="search" value="" >
                                            <i class="list-group autocomplete"></i>
                                        </button>
                                        <ul class="list-group autocomplete" style="position:absolute;width:100%; z-index: 100">
                                        </ul>
                                      </form>

                                  <ul class="nav navbar-nav hidden-md hidden-lg navbar-right">
                                      <li role="presentation"><a href="index.html">My Timeline</a></li>
                                      <li class="dropdown open"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="#">User <span class="caret"></span></a>
                                          <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                              <li role="presentation"><a href="#">My Profile</a></li>
                                              <li class="divider" role="presentation"></li>
                                              <li role="presentation"><a href="index.html">Timeline </a></li>
                                              <li role="presentation"><a href="#">Messages </a></li>
                                              <li role="presentation"><a href="notify.php">Notifications </a></li>
                                              <li role="presentation"><a href="#">My Account</a></li>
                                                <li role="presentation"><a href="users.php">Users</a></li>
                                              <li role="presentation"><a href="logout.php">Logout </a></li>
                                          </ul>
                                      </li>
                                  </ul>
                                  <ul class="nav navbar-nav hidden-xs hidden-sm navbar-right">
                                      <li class="active" role="presentation"><a href="index.html">Timeline</a></li>
                                      <li role="presentation"><a href="#">Messages</a></li>
                                      <li role="presentation"><a href="notify.php">Notifications</a></li>
                                      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">User <span class="caret"></span></a>
                                          <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                              <li role="presentation"><a href="profile.php">My Profile</a></li>
                                              <li class="divider" role="presentation"></li>
                                              <li role="presentation"><a href="index.html">Timeline </a></li>
                                              <li role="presentation"><a href="messages.html">Messages </a></li>
                                              <li role="presentation"><a href="notify.php">Notifications </a></li>
                                              <li role="presentation"><a href="#">My Account</a></li>
                                              <li role="presentation"><a href="users.php">Users</a></li>
                                              <li role="presentation"><a href="logout.php">Logout </a></li>
                                          </ul>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </nav>
                  </div>
                <section class="sec1"></section>
                <section class="content">
                    <?php
                    if(isset($_POST['search']))
                    {
                        $valueToSearch = $_POST['valueToSearch'];
                        $query="SELECT * FROM `users` WHERE CONCAT(`username`, `email`) LIKE '%".$valueToSearch."%' ";
                        $search_results=filterTable($query);

                    }else{
                        $query= "SELECT * FROM users";
                        $search_results=filterTable($query);

                    }
                    function filterTable($query)
                    {
                        $con=mysqli_connect('localhost','root','','tulime');
                        $results=mysqli_query($con,$query);
                        return $results;

                    }

                    ?>


              <div class="container">
                <div class="container">
                    <h1>Users </h1>

              </div>
            </div>
            <form action="users.php" method="post">


              <table>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                    <?php while ($row=mysqli_fetch_array($search_results)):?>
                    <tr>
                        <td><?php echo $row['username'];?></td>
                        <td><?php echo $row['email'];?></td>
                      <!-- <td><?php //echo //"<a href='book.php?id=$row[Event_id]'>Buy Ticket</a>";?></td> -->
                      <td><?php echo "<a href='profile.php?username=$row[username]'>View profile</a>";?></td>
                      <td><?php echo "<a href='messages.html?#$row[user_id]'>Send message</a>";?></td>

                    </tr>
                    <?php endwhile; ?>
                </table>
            </form>

        </body>
    </html>
