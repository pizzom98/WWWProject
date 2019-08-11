<?php include("inc/header-admin.inc.php") ?>
<?php
 require_once 'dbconfig.php';
 $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
 
 
?>
<div class="homepage-wrapper">
<h3>Categories</h3>
    
<?php
  $query  = "SELECT * FROM categories";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);

  $rows = $result->num_rows;
  
  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);
?>
   
   <div class="col-md-6 col-sm-6 col-xs-12 left category-links">
    <a href="http://pizzom.myweb.cs.uwindsor.ca/60334/project/bookcategory.php?category=<?php echo $row[0];?>"><?php echo $row[1];?></a>
   </div>

<?php
  }
?>

</div>
<?php 
 $result->close();
  $conn->close();
  

include("inc/footer.inc.php") ?>