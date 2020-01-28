<?php

$dataPoints = array();
//Best practice is to create a separate file for handling connection to database
try{
     // Creating a new connection.
    // Replace your-hostname, your-db, your-username, your-password according to your database
    $link = new \PDO(   'mysql:host=localhost;dbname=tulime',
                         'root',
                         '',
                        array(
                            \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                    );

    $handle = $link->prepare('SELECT
   posts.user_id,
   users.user_id,
   users.username
FROM
    posts,users
WHERE
	posts.user_id=users.user_id
ORDER BY
    username DESC

');
    $handle->execute();
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);

    foreach($result as $row){
        array_push($dataPoints, array("username"=> $row->username, "user_id"=> $row->user_id));
    }
	$link = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}

?>
<!DOCTYPE HTML>
<html>
<head>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">

window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "PHP Column Chart from Database"
	},
	data: [{
		type: "line", //change type to bar, line, area, pie, etc
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>


</body>
</html>
