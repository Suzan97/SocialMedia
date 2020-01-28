
&amp;lt;?php
  // including FusionCharts PHP wrapper
  include(&amp;quot;/path/to/fusioncharts.php&amp;quot;);
?&amp;gt;

&amp;lt;html&amp;gt;

&amp;lt;head&amp;gt;
  &amp;lt;!-- including FusionCharts JavaScript file --&amp;gt;
  &amp;lt;script type=&amp;quot;text/javascript&amp;quot; src=&amp;quot;/path/to/fusioncharts.js&amp;quot;&amp;gt;&amp;lt;/script&amp;gt;
  &amp;lt;script type=&amp;quot;text/javascript&amp;quot; src=&amp;quot;/path/to/fusioncharts.charts.js&amp;quot;&amp;gt;&amp;lt;/script&amp;gt;
&amp;lt;/head&amp;gt;

&amp;lt;/html&amp;gt;

&amp;lt;?php

    //setting up connection with database
    $host_db=&amp;quot;localhost&amp;quot;; // MySQL host server (might vary depending upon user)
    $user_db=&amp;quot;root&amp;quot;; // MySQL database username
    $pass_db=&amp;quot;&amp;quot;; // MySQL password
    $name_db=&amp;quot;tulime&amp;quot;; // name of the database

?&amp;gt;
$dbhandle = new mysqli($host_db, $user_db, $pass_db, $name_db);

if ($dbhandle -&amp;gt; connect_error) {
    exit(&amp;quot;There was an error with your connection: &amp;quot;.$dbhandle - &amp;gt; connect_error);
}
$strQuery = &amp;quot;'SELECT
   posts.user_id,
   users.user_id,
   users.username
FROM
    posts,users
WHERE
	posts.user_id=users.user_id
ORDER BY
    username DESC; &amp;quot;;

$result = $dbhandle-&amp;gt;query($strQuery) or exit(&amp;quot;Error code ({$dbhandle-&amp;gt;errno}): {$dbhandle-&amp;gt;error}&amp;quot;);

if ($result) {

  // creating an associative array to store the chart attributes
  $arrData = array(
    &amp;quot;chart&amp;quot; =&amp;gt; array(
      &amp;quot;theme&amp;quot; =&amp;gt; &amp;quot;fint&amp;quot;,
      &amp;quot;caption&amp;quot; =&amp;gt; &amp;quot;Browser Market Share&amp;quot;,
      &amp;quot;subcaption&amp;quot; =&amp;gt; &amp;quot;February 2016&amp;quot;,
      &amp;quot;captionFontSize&amp;quot; =&amp;gt; &amp;quot;24&amp;quot;,
      &amp;quot;paletteColors&amp;quot; =&amp;gt; &amp;quot;#A2A5FC, #41CBE3, #EEDA54, #BB423F #,F35685&amp;quot;,
      &amp;quot;baseFont&amp;quot; =&amp;gt; &amp;quot;Quicksand, sans-serif&amp;quot;,
      //more chart configuration options
    )
  );

  $arrData[&amp;quot;data&amp;quot;] = array();

  // iterating over each data and pushing it into $arrData array
  while ($row = mysqli_fetch_array($result)) {
    array_push($arrData[&amp;quot;data&amp;quot;], array(
      &amp;quot;label&amp;quot; =&amp;gt; $row[&amp;quot;browser&amp;quot;],
      &amp;quot;value&amp;quot; =&amp;gt; $row[&amp;quot;shareval&amp;quot;]
    ));
  }

  $jsonEncodedData = json_encode($arrData);

}
&amp;lt;div id=&amp;quot;doughnut-chart&amp;quot;&amp;gt;A beautiful donut chart is on its way!&amp;lt;/div&amp;gt;

$var = new FusionCharts(&amp;quot;type of chart&amp;quot;,
                &amp;quot;unique chart id&amp;quot;,
                &amp;quot;width of chart&amp;quot;,
                &amp;quot;height of chart&amp;quot;,
                &amp;quot;div id to render the chart&amp;quot;,
                &amp;quot;type of data&amp;quot;,
                &amp;quot;actual data&amp;quot;)

                // creating FusionCharts instance
$doughnutChart = new FusionCharts(&amp;quot;doughnut2d&amp;quot;, &amp;quot;browserShareChart&amp;quot; , &amp;quot;100%&amp;quot;, &amp;quot;450&amp;quot;, &amp;quot;doughnut-chart&amp;quot;, &amp;quot;json&amp;quot;, $jsonEncodedData);

                // FusionCharts render method
$doughnutChart-&amp;gt;render();

                // closing database connection
$dbhandle-&amp;gt;close();
