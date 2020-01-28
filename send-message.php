<?php
include('./database/DB.php');
include('./Login/Login.php');

if(Login::isLoggedIn()) {
  $user_id = Login::isLoggedIn();

}else{
  die("<script type='text/javascript'> alert(' Not logged in!');
        setTimeout(
                 function(){
                           window.location.href = 'login.php';
                                },10
                                    );

                                         </script>");
}
if(isset($_POST['send'])){

  if(DB::query('SELECT user_id FROM users WHERE user_id=:receiver', array(':receiver'=>$_GET['receiver']))){
  DB::query("INSERT INTO messages VALUES ('', :body, :sender, :receiver, 0)", array(':body'=>$_POST['body'], ':sender'=>$user_id, ':receiver'=>htmlspecialchars($_GET['receiver'])));
  echo "Message sent" ;
}else{
  die("The receiver does not exist");
}
}
?>
<h1>Send a message</h1>

<form action="send-message.php?receiver=<?php echo htmlspecialchars($_GET['receiver']);?>" method="post">
  <textarea name="body" rows="8" cols="80"></textarea>
  <input type="submit" name="send" value="Send Message">
</form>
