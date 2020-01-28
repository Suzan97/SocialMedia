<?php
include('database/DB.php');
include('Login/Login.php');
if (!Login::isLoggedIn()) {
  echo "<script type='text/javascript'> alert('Not logged in');
                          setTimeout(
                                   function(){
                                             window.location.href = 'login.php';
                                                  },10
                                                      );

         </script>";
}
if (isset($_POST['confirm'])) {
        if (isset($_POST['alldevices'])) {
                DB::query('DELETE FROM login_tokens WHERE user_id=:user_id', array(':user_id'=>Login::isLoggedIn()));
        } else {
                if (isset($_COOKIE['SNID'])) {
                        DB::query('DELETE FROM login_tokens WHERE tokens=:tokens', array(':tokens'=>sha1($_COOKIE['SNID'])));
                }
                setcookie('SNID', '1', time()-3600);
                setcookie('SNID_', '1', time()-3600);
        }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tulime</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean1.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
    <link rel="shortcut icon" href="css/Images/hoe1.png" type="image/x-icon">
</head>

<body>
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
                    <form class="navbar-form navbar-left">
                        <div class="searchbox"><i class="glyphicon glyphicon-search"></i>
                            <input class="form-control sbox" type="text">
                            <ul class="list-group autocomplete" style="position:absolute;width:100%; z-index: 100">
                            </ul>
                        </div>
                    </form>
                    <ul class="nav navbar-nav hidden-md hidden-lg navbar-right">
                        <li role="presentation"><a href="profile.php">My Timeline</a></li>
                        <li class="dropdown open"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="#">User <span class="caret"></span></a>
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
                    <ul class="nav navbar-nav hidden-xs hidden-sm navbar-right">
                        <li class="active" role="presentation"><a href="index.html">Timeline</a></li>
                        <li role="presentation"><a href="messages.html">Messages</a></li>
                        <li role="presentation"><a href="notify.php">Notifications</a></li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">User <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <li role="presentation"><a href="profile.php">My Profile</a></li>
                                <li class="divider" role="presentation"></li>
                                <li role="presentation"><a href="index.html">Timeline </a></li>
                                <li role="presentation"><a href="messages.html">Messages </a></li>
                                <li role="presentation"><a href="notify.php">Notifications </a></li>
                                <li role="presentation"><a href="#">My Account</a></li>
                                <li role="presentation"><a href="logout.php">Logout </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
      <h1>Logout</h1>
      <p>Are you sure you'd like to logout?</p>
      <form action="logout.php" method="post">
              <input type="checkbox" name="alldevices" value="alldevices"> Logout of all devices?<br />
              <input type="submit" name="confirm" value="Confirm">
      </form>
  </body>
  </html>
