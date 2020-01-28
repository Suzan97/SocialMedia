<?php
// session_start();
// if(isset($_SESSION['username']) && isset($_SESSION['password'])){
//    header("location:index.html");
// }
// else{
//
// }
?>
<html>
<head>
  <title>Tulime</title>
          <link rel="stylesheet" type="text/css" href="css/login.css">
          <script type="text/javascript" href="js/text.js"></script>
          <link rel="shortcut icon" href="css/Images/hoe1.png" type="image/x-icon">



</head>
<body>
  <?php

  include('database/DB.php');

  if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {
                if (password_verify($password, DB::query('SELECT password FROM users WHERE username=:username', array(':username'=>$username))[0]['password'])) {
                        echo "<script type='text/javascript'> alert('logged in!');
						                  setTimeout(
							                         function(){
								                                 window.location.href = 'index.html';
							                                        },10
						                                              );
//
					                                                     </script>";

                        $cstrong = True;
                        $tokens = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));

                        $user_id = DB::query('SELECT user_id FROM users WHERE username=:username', array(':username'=>$username))[0]['user_id'];
                        DB::query('INSERT INTO login_tokens VALUES (\'\', :tokens, :user_id)', array(':tokens'=>sha1($tokens), ':user_id'=>$user_id));
                        setcookie("SNID", $tokens, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);

                        setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);


                } else {
                        echo "<script type='text/javascript'> alert('Incorrect password');
						                  setTimeout(
							                         function(){
								                                 window.location.href = 'login.php';
							                                        },10
						                                              );

					   </script>";
                }
        } else {
                echo "<script type='text/javascript'> alert('User not registered!');
						          setTimeout(
							                 function(){
								                         window.location.href = 'login.php';
							                                },10
						                                      );

					   </script>";
        }
}
?>
<div class="loginbox">
<h1>Login </h1>
  <form action="login.php" method="post">
    <p>Username</p>
    <input type="text" name="username" value="" placeholder="Username ..."><p />
    <p>Password</p>
    <input type="password" name="password" value="" placeholder="Password ..."><p />
    <input type="submit" name="login" value="Login">
      <a href="create-account.php">Dont have an account?</a>
  </form>
</div>
</body>
</html>
