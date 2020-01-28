<?php
include('database/DB.php');



$query = "SELECT posted_at FROM posts GROUP BY posted_at DESC";


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Posts charts</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    </head>
    <body>
        <br /><br />
        <div class="container">
            <h3 align="center">Chart</h3>
            <br />

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="panel-title">Month Wise Profit Data</h3>
                        </div>
                        <div class="col-md-3">
                            <select name="month" class="form-control" id="month">
                                <option value="">Select Month</option>
                            <?php
                            foreach($result as $row)
                            {
                                echo '<option value="'.$row["posted_at"].'">'.$row["posted_at"].'</option>';
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="chart_area" style="width: 1000px; height: 620px;"></div>
                </div>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback();

function load_monthwise_data(month, title)
{
    var temp_title = title + ' '+posted_at+'';
    $.ajax({
        url:"fetch.php",
        method:"POST",
        data:{posted_at:posted_at},
        dataType:"JSON",
        success:function(data)
        {
            drawMonthwiseChart(data, temp_title);
        }
    });
}

function drawMonthwiseChart(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Month');
    data.addColumn('number', 'Profit');
    $.each(jsonData, function(i, jsonData){
        var month = jsonData.month;
        var profit = parseFloat($.trim(jsonData.profit));
        data.addRows([[month, profit]]);
    });
    var options = {
        title:chart_main_title,
        hAxis: {
            title: "Months"
        },
        vAxis: {
            title: 'Posts'
        }
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
    chart.draw(data, options);
}

</script>

<script>

$(document).ready(function(){

    $('#month').change(function(){
        var month = $(this).val();
        if(month != '')
        {
            load_monthwise_data(month, 'Month Wise Profit Data For');
        }
    });

});

</script>
