<?php
include('database/DB.php');
$pdo = new PDO('mysql:host=127.0.0.1;dbname=tulime;charset=utf8', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//error reporting

if(isset($_POST['createaccount'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  if(!DB::query('SELECT username FROM users WHERE username=:username',array(':username'=>$username))){
    if(strlen($username) >= 3 && strlen($username) <=32) {

      if(preg_match('/[a-zA-Z0-9_]+/', $username)){
        if (strlen($password) >= 6 && strlen($password) <= 60) {
                             if (filter_var($email, FILTER_VALIDATE_EMAIL)) {



                               DB::query('INSERT INTO users VALUES (\'\', :username, :password, :email, \'\')', array(':username'=>$username, ':password'=>password_hash($password, PASSWORD_BCRYPT), ':email'=>$email));
                                  echo "<script type='text/javascript'> alert('Successl');
                                         setTimeout(
                                                  function(){
                                                            window.location.href = 'login.php';
                                                                 },10
                                                                     );

          </script>";
                             } else {
                                     echo "<script type='text/javascript'> alert('Invalid email');
						                                setTimeout(
							                                       function(){
								                                               window.location.href = 'create-account.php';
							                                                      },10
						                                                            );

					   </script>";
                             }
                     } else {
                             echo "<script type='text/javascript'> alert('Invalid password!');
						                       setTimeout(
							                              function(){
								                                      window.location.href = 'create-account.php';
							                                             },10
						                                                   );

					   </script>";
                     }
                     } else {
                             echo "<script type='text/javascript'> alert('Invalid username!');
						setTimeout(
							function(){
								window.location.href = 'create-account.php';
							},10
						);

					   </script>";
                     }
             } else {
                     echo "<script type='text/javascript'> alert('Invalid username!');
						setTimeout(
							function(){
								window.location.href = 'create-account.php';
							},10
						);

					   </script>";
             }
     } else {
             echo"<script type='text/javascript'> alert('User already exists!');
						setTimeout(
							function(){
								window.location.href = 'create-account.php';
							},10
						);

					   </script>";
     }
    }
 ?>
 <html>
 <head>
   <head>
       <title>Tulime</title>
       <link rel="stylesheet" type="text/css" href="css/signup.css">
       <script type="text/javascript" href="js/text.js"></script>
       <link rel="shortcut icon" href="css/Images/hoe1.png" type="image/x-icon">
   </head>
 </head>
 <body>
   <div class="loginbox">
<h1>Register</h1>

<form action="create-account.php" method="post">
  <p>Username</p>
  <input type="text" name="username" value="" placeholder="enter username"><p />
    <p>Password</p>
  <input type="password" name="password" value="" placeholder="enter password"><p/>
    <p>Email</p>
  <input type="email" name="email" value="" placeholder="someone@somesite.com"><p/>
  <input type="submit" name="createaccount" value="Create Account" action="login.php">
  <a href="login.php">Already have an account?</a>

</form>
</div>
</body>
</html>
