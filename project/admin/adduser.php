<?php include("../inc/header-admin.inc.php") ?>
<?php
 require_once 'dbconfig.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if (isset($_POST['user_type'])         &&
      isset($_POST['password'])          &&
      isset($_POST['username'])    )
  {
    
    $user_type          = get_post($conn, 'user_type');
    $password           = get_post($conn, 'password');
    $username           = get_post($conn, 'username');
    
    $token = password_hash($password, PASSWORD_DEFAULT);;
    $query    = "INSERT INTO users VALUES" .
      "('0','$user_type', '$token' ,'$username')";
    $result   = $conn->query($query);

  	if (!$result){
          $message = "INSERT failed: $query<br>" . $conn->error . "<br><br>";
        }else{
          $message = "Data inserted successfully" ;
        }
  }

  
  function get_post($conn, $var)  { 

    return $conn->real_escape_string($_POST[$var]);
  
    }
  
?>
<div class="admin-wrapper">
<h2>Add User</h2>
<div class="admin-wrapper">
  <form action="adduser.php" method="post">
   <div class="form-row">  
      <div class="form-group col-md-6">
      Username: <input class="form-control" type="text" name="username">
      Password: <input class="form-control" type="text" name="password"> 
     </div>
     <div class="form-group col-md-6">
      User Type:  <select class="form-control" name="user_type">
                 <?php
                    $query  = "SELECT * FROM user_codes";
                    $result = $conn->query($query);
                    if (!$result) die ("Database access failed: " . $conn->error);

                    $rows = $result->num_rows;
                    
                    for ($j = 0 ; $j < $rows ; ++$j)
                    {
                        $result->data_seek($j);
                        $row = $result->fetch_array(MYSQLI_NUM);
                    ?>
                        <option value="<?php echo "$row[0]"; ?>"><?php echo "$row[1]"; ?></option>
                    <?php
                    }
                    ?>
                </select> 
       </div>
       <div class="form-group col-md-6">
           <input type="submit" class="btn btn-custom" value="ADD USER">
       </div>
      </div></form>
  <span><?php echo $message; ?></span>
</div>

<div class="admin-return">
<a href="http://pizzom.myweb.cs.uwindsor.ca/60334/project/admin/"> <- Back to Admin Area</a>
</div>
</div>
<?php 
 $result->close();
  $conn->close();
  
include("../inc/footer.inc.php") ?>