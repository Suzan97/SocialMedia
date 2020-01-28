<?php

class Comment{
  public static function createComment($commentBody, $postId, $userId){


    if(strlen($commentBody) > 160 || strlen($commentBody)<1){
      die('Incorrect length');
    }

    if(!DB::query('SELECT id FROM posts WHERE id=:post_id', array(':post_id'=>$postId))){
      echo "invalid post id";
    }else{
      // DB::query('INSERT INTO comments VALUES (\'\', :comment, :user_id, :posted_at, NOW(), :post_id)', array(':comment'=>$commentBody, ':user_id'=>$userId, ':post_id'=>$postId));
      DB::query('INSERT INTO comments VALUES (\'\', :comment, :user_id, NOW(), :post_id)', array(':comment'=>$commentBody, ':user_id'=>$userId, ':post_id'=>$postId));
    }
  }

  public static function displayComments($postId){

    $comments = DB::query('SELECT comments.comment, users.username FROM comments, users WHERE `post_id`= :post_id AND comments.user_id = users.user_id', array(':post_id'=>$postId));
    foreach ($comments as $comment) {
      echo $comment['comment']. " ~ " .$comment['username']."<hr/>";
    }

  }
}

?>
