<?php include("../inc/header-admin.inc.php") ?>
<?php
require_once 'dbconfig.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query  = "SELECT categories.category_name, COUNT(*) as cnt FROM `books` INNER JOIN categories ON books.category=categories.category_id GROUP BY category";
$result = $conn->query($query);

if (!$result) die ("Database access failed: " . $conn->error);
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div id="piechart"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Category', 'Books per Category'],
  <?php 
    while($row = mysqli_fetch_array($result)){
        echo "['".$row["category_name"]."', ".$row["cnt"]."],";
    }
  ?>
  
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Books Per Category', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>


<div class="admin-return">
<a href="http://pizzom.myweb.cs.uwindsor.ca/60334/project/admin/"> <- Back to Admin Area</a>
</div>
</div>
<?php
$result->close();
$result2->close();
$conn->close();
include("../inc/footer.inc.php") ?>