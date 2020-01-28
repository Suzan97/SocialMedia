<?php
include('./database/DB.php');
session_start();
if(isset($_SESSION['adminname'])){

$adminname = $_SESSION['adminname'];
//$role = $_SESSION['role'];
}else
{
	// header('location:index.html');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Tulime</title>
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

<div class="form-style-2-heading"></div>

</div>
      </nav>
    </aside>
    <article id="contents">
	<div class='form-style-2-heading'> Available Jobs report</div>
	<span id="login_circle"></span>
	<div class="form-style-2">

<?php

// Establish Connection
$nowtime = date('H:i:s');
//echo $nowtime;
$sql ="SELECT * FROM posts ";
$result =$connect->query($sql);
if ($result ->num_rows>0){
	//output data of each row
	echo"
	<div class='table-rep-plugin'>
                                <div class='table-responsive' data-pattern='priority-columns'>
                                    <table id='datatable-buttons' class='table  table-striped'>
	<thead>
	<tr>
	<th>#</th>
	<th>Title</th>
	<th>Department</th>
	<th>Date Posted</th>
	<th>Applications</th>
	<th>Sector</th>
	</tr>
	</thead>
	<tbody>
	";
	$arrayof = array();
	$arrayof2 = array();
	while($row =$result->fetch_assoc()){

		$sql2 ="SELECT * FROM posts WHERE id='".$row["id"]."'";
$result2 =$connect->query($sql2);


while($row2 =$result2->fetch_assoc()){
	$sectorname = $row2["post"];
}

$sql3 ="SELECT COUNT(Job_ID) AS totalapplicants FROM applications WHERE Job_ID='".$row["Job_ID"]."'";
$result3 =$connect->query($sql3);
while($row3 =$result3->fetch_assoc()){
	$jobapplicants = $row3["likes"];

}



		echo"<tr>
		<td>" . $row['id']. "</button></td>
		<td>" . $row['user_id']. "</button></td>
		<td>" . $row['post']. "</button></td>
		<td>" . $row['posted_at'] . "</button></td>
		<td>" . $username." </td>
		<td>" . $sectorname."</td>
		</tr>";


		array_push($arrayof2,$row['id']);
		array_push($arrayof,$jobapplicants);

	}
	$listofjobsbookingsarray =  implode(', ',$arrayof);

	$listofjobsarray =  '"'.implode('", "',$arrayof2).'"';
	echo"</tbody></table></div></div>";
}else{echo "0 results";}
$connect->close();
?>

</div>
      <div id="canvas-holder" style="width:100%">
		<canvas id="chart-area"></canvas>
	</div>

    </article>
  </div>
  <footer id="copyrights">
    <p><small>&copy; 2019 <a href="">All rights reserved</a></small></p>

  </footer>
</div>
<script src="js/jquery-3.1.1.min.js"></script>
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
<script src="assets/plugins/chart.js/chart.min.js"></script>
<script>
var ctx = document.getElementById("chart-area").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $listofjobsarray; ?>],
        datasets: [{
            label: '# of Applications',
            data: [<?php echo $listofjobsbookingsarray; ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
</body>
</html>
