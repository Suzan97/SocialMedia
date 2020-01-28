<?php
$connect = mysqli_connect("localhost", "root", "","tulime");
// $query = "SELECT posts.id,posts.posted_at,posts.user_id, users.username FROM posts
//  INNER JOIN users ON posts.user_id = users.user_id
//   WHERE Month(posted_at) = ['posted_at']
// ";
$query = "SELECT posts.id,posts.posted_at,posts.user_id, users.username FROM posts
 INNER JOIN users ON posts.user_id = users.user_id";
$result = mysqli_query($connect, $query);
$chart_data = '';
while($row = mysqli_fetch_array($result))
{
 $chart_data .= "{ month:'".$row["posted_at"]."', username:".$row["username"].", user_id:".$row["user_id"]."}, ";
}
$chart_data = substr($chart_data, 0, -2);
?>
<head>
  <title>Tulime</title>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

 </head>
 <body>
  <br /><br />
  <div class="container" style="width:900px;">
   <h2 align="center">Tulime</h2>
   <h3 align="center">Post Data</h3>
   <br /><br />
   <div id="chart"></div>
  </div>
 </body>
</html>

<script>
Morris.Bar({
 element : 'chart',
 data:[<?php echo $chart_data; ?>],
 xkey:'month',
 ykeys:['username', 'user_id'],
 labels:['username', 'user_id'],
 hideHover:'auto',
 stacked:true
});
</script>
