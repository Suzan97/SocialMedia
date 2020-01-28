<?php
require_once ("DB.php");
require_once ("Mail.php");

$db = new DB("127.0.0.1", "tulime", "root", "");

if ($_SERVER['REQUEST_METHOD'] == "GET") {


  if ($_GET['url'] == "musers") {
  $tokens = $_COOKIE['SNID'];
            $userid = $db->query('SELECT user_id FROM login_tokens WHERE tokens=:tokens', array(':tokens'=>sha1($tokens)))[0]['user_id'];
            $users = $db->query("SELECT DISTINCT s.username AS Sender, r.username AS Receiver, s.user_id AS SenderID, r.user_id AS ReceiverID FROM messages LEFT JOIN users s ON s.user_id = messages.sender LEFT JOIN users r ON r.user_id = messages.receiver WHERE(s.user_id = :userid OR r.user_id = :userid)", array(":userid"=>$userid));

            $u = array();
            foreach ($users as $user) {
                    if (!in_array(array('username'=>$user['Receiver'], 'user_id'=>$user['ReceiverID']), $u)) {
                            array_push($u, array('username'=>$user['Receiver'], 'user_id'=>$user['ReceiverID']));
                    }
                    if (!in_array(array('username'=>$user['Sender'], 'user_id'=>$user['SenderID']), $u)) {
                            array_push($u, array('username'=>$user['Sender'], 'user_id'=>$user['SenderID']));
                    }
            }
            echo json_encode($u);

      }else if ($_GET['url'] == "auth") {

      }  else if ($_GET['url'] == "profile") {
         $tokens = $_COOKIE['SNID'];
         $userid = $db->query('SELECT user_id FROM login_tokens WHERE tokens=:tokens', array(':tokens'=>sha1($tokens)))[0]['user_id'];
         $username = $db->query('SELECT username FROM users WHERE user_id=:uid',array(':uid'=>$userid))[0]['username'];
         echo $username;

      }else if ($_GET['url'] == "message"){
        $sender = $_GET['sender'];
        $tokens = $_COOKIE['SNID'];
        $receiver = $db->query('SELECT user_id FROM login_tokens WHERE tokens=:tokens', array(':tokens'=>sha1($tokens)))[0]['user_id'];

        $messages = $db->query('SELECT messages.id, messages.body, s.username AS Sender, r.username AS Receiver
        FROM messages
        LEFT JOIN users s ON messages.sender = s.user_id
        LEFT JOIN users r ON messages.receiver = r.user_id
        WHERE (r.user_id=:r AND s.user_id=:s) OR r.user_id=:s AND s.user_id=:r', array(':r'=>$receiver, ':s'=>$sender));
        echo json_encode($messages);

      } else if ($_GET['url'] == "search") {

        $tosearch = explode(" ", $_GET['query']);
        if (count($tosearch) == 1) {
          $tosearch = str_split($tosearch[0], 2);
        }

   $whereclause = "";
   $paramsarray = array(':body'=>'%'.$_GET['query'].'%');
   for ($i = 0; $i < count($tosearch); $i++) {
     if($i % 2 ){
          $whereclause .= " OR body LIKE :p$i ";
          $paramsarray[":p$i"] = $tosearch[$i];
        }
   }
   $posts = $db->query('SELECT posts.id, posts.body, posts.posted_at, users.username FROM posts, users WHERE users.user_id = posts.user_id AND posts.body LIKE :body '. $whereclause.'LIMIT 10', $paramsarray);
   //echo '<br/>';
   echo json_encode($posts);
   // echo '</pre>';



        } else if ($_GET['url'] == "users") {
          $tokens = $_COOKIE['SNID'];
          $userid = $db->query('SELECT user_id FROM login_tokens WHERE tokens=:tokens', array(':tokens'=>sha1($tokens)))[0]['user_id'];
          $username = $db->query('SELECT username FROM users WHERE user_id=:uid',array(':uid'=>$userid))[0]['username'];
          echo $username;


        } else if ($_GET['url'] == "comments" && isset($_GET['post_id'])) {
                $output = "";
                $comments = $db->query('SELECT comments.comment, users.username FROM comments, users WHERE post_id = :post_id AND comments.user_id = users.user_id', array(':post_id'=>$_GET['post_id']));
                $output .= "[";
                foreach($comments as $comment) {
                        $output .= "{";
                        $output .= '"Comment": "'.$comment['comment'].'",';
                        $output .= '"CommentedBy": "'.$comment['username'].'"';
                        $output .= "},";
                        //echo $comment['comment']." ~ ".$comment['username']."<hr />";
                }
                $output = substr($output, 0, strlen($output)-1);
                $output .= "]";
                echo $output;

        } else if ($_GET['url'] == "posts") {

                $tokens = $_COOKIE['SNID'];

                $user_id = $db->query('SELECT user_id FROM login_tokens WHERE tokens=:tokens', array(':tokens'=>sha1($tokens)))[0]['user_id'];

                $followingposts = $db->query('SELECT posts.id, posts.body, posts.posted_at, posts.postimg, posts.likes, users.username FROM users,posts,followers
                WHERE (posts.user_id = followers.user_id
                OR posts.user_id = :user_id)
                AND users.user_id = posts.user_id
                AND follower_id= :user_id
                ORDER BY posts.likes DESC;', array(':user_id'=>$user_id), array(':user_id'=>$user_id));
                  $response = "[";

                  foreach ($followingposts as $posts) {

                    $response .= "{";
                                 $response .= '"PostId": '.$posts['id'].',';
                                 $response .= '"PostBody": "'.$posts['body'].'",';
                                 $response .= '"PostedBy": "'.$posts['username'].'",';
                                 $response .= '"PostDate": "'.$posts['posted_at'].'",';
                                  $response .= '"PostImage": "'.$posts['postimg'].'",';
                                 $response .= '"Likes": '.$posts['likes'].'';
                         $response .= "},";
                 }
                 $response = substr($response, 0, strlen($response)-1);
                 $response .= "]";
                 // http_response_code(200);
                 echo $response;

        } else if ($_GET['url'] == "profileposts") {

                $user_id = $db->query('SELECT user_id FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['user_id'];

                $followingposts = $db->query('SELECT posts.id, posts.body, posts.posted_at, posts.postimg, posts.likes, users.username FROM users,posts
                WHERE users.user_id = posts.user_id
                AND users.user_id = :user_id
                ORDER BY posts.posted_at DESC;', array(':user_id'=>$user_id));

                  $response = "[";

                  foreach ($followingposts as $posts) {

                    $response .= "{";
                                 $response .= '"PostId": '.$posts['id'].',';
                                 $response .= '"PostBody": "'.$posts['body'].'",';
                                 $response .= '"PostedBy": "'.$posts['username'].'",';
                                 $response .= '"PostDate": "'.$posts['posted_at'].'",';
                                 $response .= '"PostImage": "'.$posts['postimg'].'",';
                                 $response .= '"Likes": '.$posts['likes'].'';
                         $response .= "},";
                 }
                 $response = substr($response, 0, strlen($response)-1);
                 $response .= "]";
                 // http_response_code(200);
                 echo $response;

        }


} else if ($_SERVER['REQUEST_METHOD'] == "POST") {
          $tokens = $_COOKIE['SNID'];

          $userid = $db->query('SELECT user_id FROM login_tokens WHERE tokens=:tokens', array(':tokens'=>sha1($tokens)))[0]['user_id'];

          $postBody = file_get_contents("php://input");
          $postBody = json_decode($postBody);

          $body = $postBody->body;
          $receiver = $postBody->receiver;

          if(strlen($body) > 100){
            echo "{'Error' : 'Message too long!'}";
          }
          $db->query("INSERT INTO messages VALUES('', :body, :sender, :receiver, '0')", array(':body'=>$body,':sender'=>$userid, ':receiver'=>$receiver));

          echo '{"Success": "Message Sent"}';

        if ($_GET['url'] == "message") {

        } else if ($_GET['url'] == "users") {

                $postBody = file_get_contents("php://input");
                $postBody = json_decode($postBody);

                $username = $postBody->username;
                $email = $postBody->email;
                $password = $postBody->password;


                if (!$db->query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {

                        if (strlen($username) >= 3 && strlen($username) <= 32) {

                                if (preg_match('/[a-zA-Z0-9_]+/', $username)) {

                                        if (strlen($password) >= 6 && strlen($password) <= 60) {

                                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                                        if (!$db->query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))) {

                                                $db->query('INSERT INTO users VALUES (\'\', :username, :password, :email, \'0\', \'\')', array(':username'=>$username, ':password'=>password_hash($password, PASSWORD_BCRYPT), ':email'=>$email));
                                                Mail::sendMail('Welcome to our Tulime!', 'Your account has been created!', $email);
                                                echo '{ "Success": "User Created!" }';
                                                http_response_code(200);
                                        } else {
                                                echo '{ "Error": "Email in use!" }';
                                                http_response_code(409);
                                        }
                                } else {
                                        echo '{ "Error": "Invalid Email!" }';
                                        http_response_code(409);
                                        }
                                } else {
                                        echo '{ "Error": "Invalid Password!" }';
                                        http_response_code(409);
                                }
                                } else {
                                        echo '{ "Error": "Invalid Username!" }';
                                        http_response_code(409);
                                }
                        } else {
                                echo '{ "Error": "Invalid Username!" }';
                                http_response_code(409);
                        }

                } else {
                        echo '{ "Error": "User exists!" }';
                        http_response_code(409);
                }


        }

        if ($_GET['url'] == "auth") {
                $postBody = file_get_contents("php://input");
                $postBody = json_decode($postBody);

                $username = $postBody->username;
                $password = $postBody->password;

                if ($db->query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {
                        if (password_verify($password, $db->query('SELECT password FROM users WHERE username=:username', array(':username'=>$username))[0]['password'])) {
                                $cstrong = True;
                                $tokens = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                                $user_id = $db->query('SELECT id FROM users WHERE username=:username', array(':username'=>$username))[0]['id'];
                                $db->query('INSERT INTO login_tokens VALUES (\'\', :tokens, :user_id)', array(':tokens'=>sha1($tokens), ':user_id'=>$user_id));
                                echo '{ "tokens": "'.$tokens.'" }';
                        } else {
                                echo '{ "Error": "Invalid username or password!" }';
                                http_response_code(401);
                        }
                } else {
                        echo '{ "Error": "Invalid username or password!" }';
                        http_response_code(401);
                }

        }
        else if ($_GET['url'] == "likes") {
                $postId = $_GET['id'];
                $tokens = $_COOKIE['SNID'];
                $likerId = $db->query('SELECT user_id FROM login_tokens WHERE tokens=:tokens', array(':tokens'=>sha1($tokens)))[0]['user_id'];

                if (!$db->query('SELECT user_id FROM posts_like WHERE post_id=:post_id AND user_id=:user_id', array(':post_id'=>$postId, ':user_id'=>$likerId))) {
                        $db->query('UPDATE posts SET likes=likes+1 WHERE id=:post_id', array(':post_id'=>$postId));
                        $db->query('INSERT INTO posts_like VALUES (\'\', :post_id, :user_id)', array(':post_id'=>$postId, ':user_id'=>$likerId));
                        //Notify::createNotify("", $postId);
                } else {
                        $db->query('UPDATE posts SET likes=likes-1 WHERE id=:post_id', array(':post_id'=>$postId));
                        $db->query('DELETE FROM posts_like WHERE post_id=:post_id AND user_id=:user_id', array(':post_id'=>$postId, ':user_id'=>$likerId));
                }

                echo "{";
                echo '"Likes":';
                echo $db->query('SELECT likes FROM posts WHERE id=:post_id', array(':post_id'=>$postId))[0]['likes'];
                echo "}";
        }





}  else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
        if ($_GET['url'] == "auth") {
                if (isset($_GET['tokens'])) {
                        if ($db->query("SELECT tokens FROM login_tokens WHERE tokens=:tokens", array(':tokens'=>sha1($_GET['tokens'])))) {
                                $db->query('DELETE FROM login_tokens WHERE tokens=:tokens', array(':tokens'=>sha1($_GET['tokens'])));
                                echo '{ "Status": "Success" }';
                                http_response_code(200);
                        } else {
                                echo '{ "Error": "Invalid tokens" }';
                                http_response_code(400);
                        }
                } else {
                        echo '{ "Error": "Malformed request" }';
                        http_response_code(400);
                }
        }
} else {
        http_response_code(405);
}
?>
