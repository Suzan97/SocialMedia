<?php
session_start();
$con=mysqli_connect('localhost', 'root', '','tulime')
    or die("Could not establish connection");

mysqli_select_db($con,'tulime') or
    die ("Could not select the db");

if(isset($_SESSION['adminname'])){

    $adminname = $_SESSION['adminname'];
    //$role = $_SESSION['role'];
}else
{
    header('location:adminsign.php');
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
        <title>Tulime</title>
        <link rel="shortcut icon" href="css/Images/hoe1.png" type="image/x-icon">
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
<!--
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
-->
        <style>
            table {
                border-collapse: collapse;
                width: 70%;
                align-content: center;
                margin-left: 10%;


            }

            th, td {
                text-align: left;
                padding: 8px;
                height: 50px;
            }

            tr:nth-child(even){background-color: #f2f2f2}

            th {
                background-color:  darkgray;
                color: white;
            }
        </style>
    </head>
    <body>
        <div class="resize"></div>
        <div id="Wrapper">
            <?php  ?>
            <!--<div id="Wrapper2">
<aside id="sidebar-wrapper">
<nav class="sidebar">
<div class="form-style-2">-->
            <?php //include_once('greport.php'); ?>


            <?php include_once('greport.php'); ?>
            <div class="resize"></div>
            <div id="Wrapper">
                <?php //include_once('header.php'); ?>
                <div id="Wrapper2">
                    <aside id="sidebar-wrapper">
                        <nav class="sidebar">
                            <div class="form-style-2">









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

                            <div class="form-style-2-heading">Report</div>
                            <?php

//                            $sql ="SELECT       `ticket_id`,
//                            COUNT(`ticket_id`) AS `mosttevents`
//                            FROM     `tickets`
//                            GROUP BY `ticket_id`
//                            ORDER BY `mostlikes` DESC
//                            LIMIT    1;";
//
//
//                            $result =$con->query($sql);
//                            if ($result ->num_rows>0){
//                                //output data of each row
//                                while($row =$result->fetch_assoc()){
//
//                                    $sql2 ="SELECT * FROM ticket WHERE Event_id='".$row["mostlikes"]."' ";
//                                    $result2 =$con->query($sql2);
//                                    while($row1 =$result2->fetch_assoc()){
//                                        $Ticket_id = $row1["Ticket_id"];
//                                        $Event_id = $row1["Event_id"];
//                                        $Event_Name = $row1["Event_Name"];
//                                        $Ticket_Price = $row1["Ticket_Price"];
//                                        $username = $row1["username"];
//
//                                    }
//
//                                    $sql3 ="SELECT * FROM event WHERE event_id='".$event_id."' ";
//                                    $result3 =$con->query($sql3);
//                                    while($row1 =$result3->fetch_assoc()){
//                                        $Event_Name = $row1["Event_Name"];
//                                    }
//                                }
//                                $sql5 ="SELECT * FROM ticket WHERE user_id='".$user_id."' ";
//                                $result5 =$con->query($sql5);
//                                while($row1 =$result5->fetch_assoc()){
//                                    $username = $row1["username"];
//                                }
//
//
//                            }


                            $sql23 ="SELECT `id`,Max(`likes`) AS `mostlikes`
                            FROM     `posts`
                            GROUP BY `id`
                            ORDER BY `mostlikes` DESC
                            LIMIT    1;";
                            $result23 =$con->query($sql23);
                            if ($result23 ->num_rows>0){
                                while($row23 =$result23->fetch_assoc()){
                                    $mostlikes = $row23["mostlikes"];
                                }
                            }
                            else{
                                $mostlikes = 0;
                            }


                            $sql24 ="SELECT       `user_id`
                                FROM     `posts`
                                GROUP BY `user_id`
                                ORDER BY COUNT(*) DESC
                                LIMIT    1;";
                            $result24 =$con->query($sql24);
                            if ($result24 ->num_rows>0){
                                while($row24 =$result24->fetch_assoc()){

                                    $sql33 ="SELECT * FROM users WHERE user_id='".$row24["user_id"]."' ";
                                    $result33 =$con->query($sql33);
                                    while($row13 =$result33->fetch_assoc()){
                                        $mostuser = $row13["username"];
                                    }
                                }
                            }
                            // $sql25 ="SELECT       `Event_id`
                            //     FROM     `event`
                            //     GROUP BY `Event_id`
                            //     ORDER BY COUNT(*) DESC
                            //     LIMIT    1;";
                            // $result25 =$con->query($sql25);
                            // if ($result25 ->num_rows>0){
                            //     while($row25 =$result25->fetch_assoc()){
                            //
                            //         $sql43 ="SELECT * FROM event WHERE Event_id='".$row25["Event_id"]."' ";
                            //         $result43 =$con->query($sql43);
                            //         while($row16 =$result43->fetch_assoc()){
                            //             $famouslocation = $row16["Location"];
                            //         }
                            //     }
                            // }

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
                                                <td>Higgest likes in post</td>
                                                <td><?php echo $mostlikes; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Most active user</td>
                                                <td><?php echo $mostuser; ?></td>
                                            </tr>
                                             <!-- <tr>
                                                <td>Most Searched location</td>
                                                <td><?php echo $famouslocation; ?></td>
                                            </tr> -->



                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>


                    </article>
                </div>
                <footer id="copyrights">
                    <p><small>&copy; 2019 <a href="">All rights reserved</a></small></p>

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
        </div>
    </body>
</html>
