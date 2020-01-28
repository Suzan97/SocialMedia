<?php

include('database/DB.php');

if(isset($_POST["month"]))
{

 $query = "
 SELECT posts.id,posts.posted_at,posts.user_id, users.username
  FROM posts INNER JOIN users ON posts.user_id = users.user_id
 WHERE Month(posted_at) = '".$_POST["posted_at"]."'
 ORDER BY id ASC
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'week'   => $row["week"],
   'post'  => floatval($row["post"])
  );
 }
 echo json_encode($output);
}

?>
