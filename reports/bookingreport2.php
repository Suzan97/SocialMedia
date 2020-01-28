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

if(isset($_GET['dadded']))
{
	$filterquery1 = "WHERE date_added = '".$_GET['dadded']."'";
}else
{
	$filterquery1 = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Trevalex</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width; initial-scale=1">

<!-- Table css -->
        <link href="assets/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css" rel="stylesheet" type="text/css" media="screen">
<!-- DataTables -->
        <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />



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
	<?php include_once('greports.php'); ?>
<!--<div class="form-style-2-heading">Filter by date added</div>
<form id="" method="get" action="townsreport.php">
<label for="field4"><span>Date added: </span>
<input  class="input-field" type="date" name="dadded" required />
</label>

<label><span>&nbsp;</span><input type="submit" value="Filter" /></label>
</form>-->
</div>
      </nav>
    </aside>
    <article id="contents">
	<span id="login_circle"></span>
	<div class="form-style-2">
	
<div class="form-style-2-heading">Bookings</div>
<?php

$sql ="SELECT       `trip_id`,
             COUNT(`trip_id`) AS `mosttrips` 
    FROM     `bookings`
    GROUP BY `trip_id`
    ORDER BY `mosttrips` DESC
    LIMIT    1;";
$result =$connect->query($sql);
if ($result ->num_rows>0){
	//output data of each row
	while($row =$result->fetch_assoc()){
		
		$sql2 ="SELECT * FROM trips WHERE trip_id='".$row["mosttrips"]."' ";
$result2 =$connect->query($sql2);
while($row1 =$result2->fetch_assoc()){
	$dtown = $row1["departure_town"];
	$atown = $row1["arrival_town"];
	$ddate = $row1["departure_date"];
	$dtime = $row1["departure_time"];
	$price = $row1["price"];
	$busof = $row1["bus_id"];
}

$sql3 ="SELECT * FROM buses WHERE bus_id='".$busof."' ";
$result3 =$connect->query($sql3);
while($row1 =$result3->fetch_assoc()){
	$busname = $row1["bus_name"];
}	

$sql4 ="SELECT * FROM towns WHERE town_id='".$dtown."' ";
$result4 =$connect->query($sql4);
while($row1 =$result4->fetch_assoc()){
	$dtownname = $row1["town_name"];
}	
$sql5 ="SELECT * FROM towns WHERE town_id='".$atown."' ";
$result5 =$connect->query($sql5);
while($row1 =$result5->fetch_assoc()){
	$atownname = $row1["town_name"];
}	


	}
}


$sql23 ="SELECT       `seats`
    FROM     `bookings`
    GROUP BY `seats`
    ORDER BY COUNT(*) DESC
    LIMIT    1;";
$result23 =$connect->query($sql23);
if ($result23 ->num_rows>0){
	while($row23 =$result23->fetch_assoc()){
		$mostseats = $row23["seats"];
	}
}
else{
	$mostseats = 0;
}


$sql24 ="SELECT       `user_id`
    FROM     `bookings`
    GROUP BY `user_id`
    ORDER BY COUNT(*) DESC
    LIMIT    1;";
$result24 =$connect->query($sql24);
if ($result24 ->num_rows>0){
	while($row24 =$result24->fetch_assoc()){
		
		$sql33 ="SELECT * FROM users WHERE user_id='".$row24["user_id"]."' ";
$result33 =$connect->query($sql33);
while($row13 =$result33->fetch_assoc()){
	$mostuser = $row13["user_name"];
}	
	}
}

	?>
	<div class='table-rep-plugin'>
                                <div class='table-responsive' data-pattern='priority-columns'>
                                    <table id='datatable-buttons' class='table  table-striped'>
	<thead>
	<tr>
	<th>Statement</th>
	<th></th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td>Most departed from towns</td>
		<td><?php echo $dtownname; ?></td>
		</tr>
		<tr>
		<td>Most visited towns</td>
		<td><?php echo $atownname; ?></td>
		</tr>
		<tr>
		<td>Trips</td>
		<td><?php echo $dtownname; ?> - <?php echo $atownname; ?></td>
		</tr>
		<tr>
		<td>Bus most used</td>
		<td><?php echo $busname; ?></td>
		</tr>
		<tr>
		<td>Most booked seat</td>
		<td><?php echo $mostseats; ?></td>
		</tr>
		<tr>
		<td>Most active user</td>
		<td><?php echo $mostuser; ?></td>
		</tr>
		
		
		</tbody>
	</table>
	</div>
	</div>

</div>
      
      
    </article>
  </div>
  <footer id="copyrights">
    <p><small>&copy; 2018 <a href="">All rights reserved</a></small></p>
    
  </footer>
</div>
<script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>

        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
<!-- Datatables-->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>
		<!-- responsive-table-->
        <script src="assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js" type="text/javascript"></script>
		<script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
            TableManageButtons.init();

        </script>
</body>
</html>
