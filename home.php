
<?php
include ('./database/DB.php');
include ('./Login/Login.php');
include ('./database/post.php');
include ('./database/Comment.php');


$showTimeline = False;

if(Login::isLoggedIn()){
  $user_id = Login::isLoggedIn();
  $showTimeline = True;

}else{
  die("not logged in");
}
if(isset($_GET['post_id'])){
  Post::likePost($_GET['post_id'], $user_id);
}
if (isset($_POST['comment'])) {
        Comment::createComment($_POST['commentbody'], $_GET['post_id'], $user_id);
}

$followingposts = DB::query('SELECT posts.id, posts.body, posts.likes, users.username FROM users,posts,followers
WHERE posts.user_id=followers.user_id
AND users.user_id = posts.user_id
AND follower_id= :user_id
ORDER BY posts.likes DESC;', array(':user_id'=>$user_id));


  foreach ($followingposts as $posts) {

      echo $posts['body']." ~ ".$posts['username'];

      echo "<form action='index.php?post_id=".$posts['id']."' method='post'>";
      if(!DB::query('SELECT post_id FROM posts_like WHERE post_id=:post_id AND user_id=:user_id', array(':post_id'=>$posts['id'], ':user_id'=>$user_id))){

      echo"<input type='submit' name='like' value='like'>";
      }else{
        echo"<input type='submit' name='Unlike' value='Unlike'>";
      }
      echo "<span>".$posts['likes']." likes</span>
      </form>
      <form action='index.php?post_id=".$posts['id']."' method='post'>
      <textarea name='commentbody' rows='3' cols='50'></textarea>
      <input type='submit' name='comment' value='Comment'>
      </form>";
      Comment::displayComments($posts['id']);
      echo "
      <hr/><br/>";


}

?>
