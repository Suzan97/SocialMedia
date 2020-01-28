<?php
include ('./database/DB.php');
include ('./database/post.php');
include ('./login/Login.php');
include ('./database/Image.php');


if (isset($_GET['topics'])) {
      if(DB::query("SELECT topics FROM posts WHERE FIND_IN_SET(':topic', topics)",array(':topic'=>$_GET['topics']))){
        echo "Valid Topic";
      }

}
?>
