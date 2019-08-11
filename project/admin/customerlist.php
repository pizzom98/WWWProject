<?php require_once 'dbconfig.php';?>
<?php include("../inc/header-admin.inc.php") ?>
<?php
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if (isset($_POST['delete']) && isset($_POST['checkboxes']))
  {
    
    foreach($_POST['checkboxes'] as $cust_id) {
      
       $query  = "DELETE FROM classics WHERE isbn='$cust_id'";
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
  <table class="table table bordered">
    <thead>
        <tr> 
            <th>Customer ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Address</th> 
            <th>City</th> 
            <th>Province</th>
            <th>Late Fee ($)</th> 
            <th><input type="checkbox" onClick="check_all(this)"/></th> 
        </tr>
    </thead>
    <tbody> 
    
    
<?php
  $query  = "SELECT * FROM customer";
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
     <td><?php echo "$row[1]"; ?></td>
     <td><?php echo "$row[2]"; ?></td>
     <td><?php echo "$row[3]"; ?></td>
     <td><?php echo "$row[4]"; ?></td>
     <td><?php echo "$row[5]"; ?></td>
     <td><?php echo "$row[6]"; ?></td>
     <td class="hidden"><?php echo "$row[7]"; ?></td>
     <td><input type="checkbox" name="checkboxes[]" value="<?php echo "$row[0]" ?>"></td>
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