<?php
  $p_title = $_REQUEST['ptitle'];
  require ('dbconfig.php');
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
  $query  = "SELECT  * FROM books WHERE title LIKE '%$p_title%' OR author LIKE '%$p_title%'";
  $result = $conn->query($query);
  if (!$result) die($conn->error);
$rows = $result->num_rows;

echo '<div id="table_ajax">';

for ($j = 0 ; $j < $rows ; ++$j)
  { 

    echo '<div class="col-md-3 col-sm-6 col-xs-12 left">';
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo '<a href="http://pizzom.myweb.cs.uwindsor.ca/60334/project/viewbook.php?book='.$row['title'].'"><img class="book-cover" src="images/'.$row['book_image'].'";></a>';
    echo '<p>'. $row['title'].', '.$row['author'];
    $query2  = "SELECT * FROM categories WHERE category_id=".$row['category'];
    $result2 = $conn->query($query2);
    if (!$result2) die ("Database access failed: " . $conn->error);
    $category_row = $result2->fetch_array(MYSQLI_NUM);
    echo '<br>'.$category_row[1].'</p></div>';
    
  }
 echo '</div>'; 
  $result->close();
  $conn->close();
?>
