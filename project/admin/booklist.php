<?php require_once 'dbconfig.php';?>
<?php include("../inc/header-admin.inc.php") ?>
<?php
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if (isset($_POST['delete']) && isset($_POST['checkboxes']))
  {
    
    foreach($_POST['isbns'] as $isbn) {
      
       $query  = "DELETE FROM books WHERE isbn='$isbn'";
       $result = $conn->query($query);
  	if (!$result) echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
   
    }
  }

?>
<script src="../js/checkboxes.js"></script> 
<div class="admin-wrapper">
  <form action="booklist.php" method="post">
  <div style="padding-bottom:0.5vw;">
  <input type="hidden" name="delete" value="yes">
  <input type="submit" class="btn btn-custom" value="DELETE">
  </div>


  <form id="checkForm">
  <div class="table-responsive">
  <table class="table">
    <thead>
        <tr> 
            <th>Book ID</th>
            <th>Title</th>
            <th>ISBN</th>
            <th>Published Date</th> 
            <th>Category</th> 
            <th>Author</th> 
            <th>Description</th>
            <th><input type="checkbox" onClick="check_all(this)"/></th> 
        </tr>
    </thead>
    <tbody> 
    
    
<?php
  $query  = "SELECT * FROM books";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);

  $rows = $result->num_rows;
  
  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);

    
?>
   <tr>
     <td><?php echo "$row[0]"; ?></td>
     <td><a class="book-link" href="http://pizzom.myweb.cs.uwindsor.ca/60334/project/viewbook.php?book=<?php echo $row[1]?>"><?php echo $row[1]; ?></a></td>
     <td><?php echo "$row[2]"; ?></td>
     <td><?php echo "$row[3]"; ?></td>
 <?php
     $query2  = "SELECT * FROM categories WHERE category_id='$row[4]'";
     $result2 = $conn->query($query2);
     if (!$result2) die ("Database access failed: " . $conn->error);
     $category_row = $result2->fetch_array(MYSQLI_NUM);
    ?>
     <td><?php echo "$category_row[1]"; ?></td>
     <?php  $result2->close(); ?>
     <td><?php echo "$row[5]"; ?></td>
     <td><?php echo "$row[6]"; ?></td>
     <td class="hidden"><?php echo "$row[7]"; ?></td>
     <td><input type="checkbox" name="checkboxes[]" value="<?php echo "$row[3]" ?>"></td>
  </tr>
<?php
  }
?>
    
                </tbody>
            </table>
          </div>
        </form>
    </form>

<div class="admin-return">
<a href="http://pizzom.myweb.cs.uwindsor.ca/60334/project/admin/"> <- Back to Admin Area</a>
</div>
</div>
<?php
  $result->close();
  $conn->close();
  
  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
?>
<?php 
 $result->close();
  $conn->close();
  
include("../inc/footer.inc.php") ?>
