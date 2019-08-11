<?php include("inc/header-admin.inc.php") ?>
<?php
 require_once 'dbconfig.php';
 $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
 
 
?>
<div class="homepage-wrapper">
<h1 class="site-title">Welcome to the BMS</h1><br>
<h3>New Arrivals</h3>
    
<?php
  $query  = "SELECT book_image, title, author, category FROM books";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);

  $rows = 8;
  
  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);
?>
   

<div class="col-md-3 col-sm-6 col-xs-12 left">
     <?php $image_src = "pictures/".$row[0]; ?>
     <a href="http://pizzom.myweb.cs.uwindsor.ca/60334/project/viewbook.php?book=<?php echo $row[1]; ?>"><img class="book-cover" src=<?php echo $image_src; ?>></a>
     <p><?php echo $row[1]; ?>, <?php echo $row[2]; ?>
     <?php
     $query2  = "SELECT * FROM categories WHERE category_id='$row[3]'";
     $result2 = $conn->query($query2);
     if (!$result2) die ("Database access failed: " . $conn->error);
     $category_row = $result2->fetch_array(MYSQLI_NUM);
    ?>
    <br><?php echo "$category_row[1]"; ?></p>
    <?php  $result2->close(); ?>
</div>
<?php
  }
?>

</div>

</div>
<?php 
 $result->close();
  $conn->close();
  
include("inc/footer.inc.php") ?>