<?php
include ('./database/DB.php');
include ('./database/post.php');
include ('./login/Login.php');
include ('./database/Image.php');


if (isset($_GET['topic'])) {

      if(DB::query("SELECT topics FROM posts WHERE FIND_IN_SET(:topic, topics)",array(':topic'=>$_GET['topic']))){
        $posts = DB::query("SELECT * FROM posts WHERE FIND_IN_SET(:topic, topics)", array(':topic'=>$_GET['topic']));
                foreach($posts as $post) {
                         echo $post['body']."<br />";
      }
    }

}
?>
