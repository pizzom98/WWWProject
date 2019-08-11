<?php require_once 'dbconfig.php';?>
<?php include("../inc/header-admin.inc.php") ?>
<?php
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if (isset($_POST['delete']) && isset($_POST['checkboxes']))
  {
    
    foreach($_POST['checkboxes'] as $username) {
      
       $query  = "DELETE FROM users WHERE username='$username'";
       $result = $conn->query($query);
  	if (!$result) echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
   
    }
  }

?>
<script src="../js/checkboxes.js"></script> 
<div class="admin-wrapper">
  <form action="users.php" method="post">
  <div style="padding-bottom:0.5vw;">
  <input type="hidden" name="delete" value="yes">
  <input type="submit" class="btn btn-custom" value="DELETE">
  </div>

  <form id="checkForm">
  <div class="table-responsive">
  <table class="table">
    <thead>
        <tr> 
            <th>User ID</th>
            <th>User Type</th>
            <th>Username</th>
            <th><input type="checkbox" onClick="check_all(this)"/></th> 
        </tr>
    </thead>
    <tbody> 
    
    
<?php
  $query  = "SELECT user_id, user_type, username  FROM users";
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
     <?php

     $query2  = "SELECT * FROM user_codes WHERE user_type='$row[1]'";
     $result2 = $conn->query($query2);
     if (!$result2) die ("Database access failed: " . $conn->error);
     $user_codes_row = $result2->fetch_array(MYSQLI_NUM);
     ?>
     <td><?php echo "$user_codes_row[1]"; ?></td>
     <?php  $result2->close(); ?>
     <td><?php echo "$row[2]"; ?></td>
     <td><input type="checkbox" name="checkboxes[]" value="<?php echo "$row[2]" ?>"></td>
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
<?php include("../inc/footer.inc.php") ?>