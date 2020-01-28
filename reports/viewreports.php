<?php

include("connect.php");

session_start();
if(isset($_SESSION['name'])){

$name = $_SESSION['name'];
//$role = $_SESSION['role'];
}else
{
	header('location:index.html');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Trevalex</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width; initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/form.css">
<style>
#login_circle 
{
position: absolute;
  left: 55%;
  top: 52%;
  margin-left: -32px; /* -1 * image width / 2 */
  margin-top: -32px; /* -1 * image height / 2 */
}
table { width: 640px; } /* Make table wider */
td, th { border: 1px solid #CCC; padding:6px; } /* Add borders to cells */
table {
border-collapse: collapse;
border-spacing: 0;
}
td, th { border: 1px solid #CCC; }
</style>
</head>
<body>
<div class="resize"></div>
<div id="Wrapper">
  <?php include_once('header.php'); ?>
  <div id="Wrapper2">
    <aside id="sidebar-wrapper">
	  <nav class="sidebar">
        <div class="form-style-2">
	
<div class="form-style-2-heading"></div>

</div>
      </nav>
    </aside>
    <article id="contents">
	<?php
echo "<div class='form-style-2-heading'>".$name." (ADMIN)</div>";
?> 
	<span id="login_circle"></span>
	<div class="form-style-2">
	
<?php include_once('greports.php'); ?>

</div>
      
      
    </article>
  </div>
  <footer id="copyrights">
    <p><small>&copy; 2018 <a href="">All rights reserved</a></small></p>
    
  </footer>
</div>
<script src="js/jquery-3.1.1.min.js"></script>

</body>
</html>
