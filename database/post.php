<?php
class Post{

    public static function createPost($postbody, $loggedInUserId, $profileUserId){


      if(strlen($postbody) > 160 || strlen($postbody)<1){
        die('Incorrect length');
      }
      $topics = self::getTopics($postbody);

      if($loggedInUserId == $profileUserId){

        if(count(Notify::createNotify($postbody)) !=0){
          foreach (Notify::createNotify($postbody) as $key => $n){
            $s = $loggedInUserId;
            $r = DB::query('SELECT user_id FROM users WHERE username=:username', array(':username'=>$key))[0]['user_id'];
            if($r != 0){

            DB::query('INSERT INTO notifications VALUES(\'\', :type, :receiver, :sender, :extra)', array(':type'=>$n["type"], ':receiver'=>$r, ':sender'=>$s, ':extra'=>$n["extra"]));
            }
          }
        }

      DB::query('INSERT INTO posts VALUES (\'\', :postbody, NOW(), :user_id, 0, \'\', :topics)', array(':postbody'=>$postbody, ':user_id'=>$profileUserId, ':topics'=>$topics));

    }else{
      die('Incorrect user');
      }
    }

    public static function createImgPost($postbody, $loggedInUserId, $profileUserId){


      if(strlen($postbody) > 160){
        die('Incorrect length');
      }
        $topics = self::getTopics($postbody);

      if($loggedInUserId == $profileUserId){

        if(count(Notify::createNotify($postbody)) !=0){
          foreach (Notify::createNotify($postbody) as $key => $n){
            $s = $loggedInUserId;
            $r = DB::query('SELECT user_id FROM users WHERE username=:username', array(':username'=>$key))[0]['user_id'];
            if($r != 0){


            DB::query('INSERT INTO notifications VALUES(\'\', :type, :receiver, :sender, :extra)', array(':type'=>$n["type"], ':receiver'=>$r, ':sender'=>$s, ':extra'=>$n["extra"]));
            }
          }
        }


      DB::query('INSERT INTO posts VALUES (\'\', :postbody, NOW(), :user_id, 0, \'\', \'\')', array(':postbody'=>$postbody, ':user_id'=>$profileUserId));
      $postid = DB::query('SELECT id FROM posts WHERE user_id=:user_id ORDER BY id DESC LIMIT 1;', array(':user_id'=>$loggedInUserId))[0]['id'];
      return $postid;


    }else {
      die('Incorrect user!');
      }
    }

    public static function likePost($post_id, $likerId){

      if(!DB::query('SELECT user_id FROM posts_like WHERE post_id=:post_id AND user_id=:user_id', array(':post_id'=> $post_id,':user_id'=> $likerId))){
      DB::query('UPDATE posts SET likes=likes+1 WHERE id=:post_id', array(':post_id'=>$post_id));
      DB::query('INSERT INTO posts_like VALUES(\'\', :post_id, :user_id)', array(':post_id'=>$post_id, ':user_id'=>$likerId));
    //  Notify::createNotify("", $post_id);

    }else{
      DB::query('UPDATE posts SET likes=likes-1 WHERE id=:post_id', array(':post_id'=>$post_id));
      DB::query('DELETE FROM posts_like WHERE post_id=:post_id AND user_id=:user_id', array(':post_id'=>$post_id, ':user_id'=>$likerId));
      }

    }

    public static function getTopics($text){

      $text = explode(" ", $text);

      $topics = "";

      foreach ($text as $word) {
         if(substr($word, 0, 1) == " #"){
           $topics .=substr($word, 1).",";
         }
      }

      return $topics;
    }



    public static function link_add($text){
      $text = explode(" ", $text);
      $newstring = "";

      foreach ($text as $word) {
         if(substr($word, 0, 1) == "@"){
           $newstring .= "<a href='profile.php?username=".substr($word, 1)."'>".htmlspecialchars($word)."</a>";
         }elseif ((substr($word, 0, 1) == "#")) {
           $newstring .= "<a href='topics.php?topic=".substr($word, 1)."'>".htmlspecialchars($word)."</a>";
         } else{
         $newstring .= htmlspecialchars($word)." ";
       }
      }

      return $newstring;
    }



    public static function displayPosts($user_id, $username, $loggedInUserId){
      $dbposts = DB::query('SELECT * FROM posts WHERE user_id=:user_id ORDER BY id DESC', array(':user_id'=>$user_id));
      $posts = "";

      foreach ($dbposts as $p) {

        if(!DB::query('SELECT post_id FROM posts_like WHERE post_id=:post_id AND user_id=:user_id', array(':post_id'=>$p['id'], ':user_id'=>$loggedInUserId))){

          $posts .= "<img src='".isset($p['postimg'])."'>".self::link_add($p['body'])."
        <form action='profile.php?username=$username&post_id=".$p['id']."' method='post'>
          <input type='submit' name='like' value='like'>
          <span>".$p['likes']." likes</span>
        ";
        if($user_id == $loggedInUserId){
            $posts .="<input type='submit' name='deletepost' value='Delete' />";
        }
        $posts .= "
        </form><hr/><br/>
        ";
      }else{
        $posts .= "<img src='".isset($p['postimg'])."'>".htmlspecialchars(self::link_add($p['body']))."


        <form action='profile.php?username=$username&post_id=".$p['id']."' method='post'>
          <input type='submit' name='Unlike' value='Unlike'>
          <span>".$p['likes']." likes</span>
        ";
        if($user_id == $loggedInUserId){
            $posts .="<input type='submit' name='deletepost' value='x' />";
        }
        $posts .= "
        </form><hr/><br/>
        ";

      }

    }
    return $posts;

    }

}


?>
