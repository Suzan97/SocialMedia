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
if (isset($_GET['mid'])) {
        $message = DB::query('SELECT * FROM messages WHERE id=:mid AND receiver=:receiver OR sender=:sender', array(':mid'=>$_GET['mid'], ':receiver'=>$user_id, ':sender'=>$user_id))[0];
        echo '<h1>View Message</h1>';
        echo htmlspecialchars($message['body']);
        echo '<hr />';
        if ($message['sender'] == $user_id) {
                $id = $message['receiver'];
        } else {
                $id = $message['sender'];
        }
        DB::query('UPDATE messages SET `read`=1 WHERE id=:mid', array (':mid'=>$_GET['mid']));
        ?>
        <form action="send-message.php?receiver=<?php echo $id; ?>" method="post">
                <textarea name="body" rows="8" cols="80"></textarea>
                <input type="submit" name="send" value="Send Message">
        </form>
        <?php
} else {
?>
<h1>My Messages</h1>
<?php
$messages = DB::query('SELECT messages.*, users.username FROM messages, users WHERE receiver=:receiver OR sender=:sender AND users.user_id = messages.sender', array(':receiver'=>$user_id, ':sender'=>$user_id));
foreach ($messages as $message) {
        if (strlen($message['body']) > 10) {
                $m = substr($message['body'], 0, 10)." ...";
        } else {
                $m = $message['body'];
        }
        if ($message['read'] == 0) {
                echo "<a href='mymessage.php?mid=".$message['id']."'><strong>".$m."</strong></a> sent by ".$message['username'].'<hr />';
        } else {
                echo "<a href='mymessage.php?mid=".$message['id']."'>".$m."</a> sent by ".$message['username'].'<hr />';
        }
      }
}
?>
