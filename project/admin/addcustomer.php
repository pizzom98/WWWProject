<?php include("../inc/header-admin.inc.php") ?>
<?php
 require_once 'dbconfig.php';
  
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['province']))
  {
    
    $fname = get_post($conn, 'fname');
    $lname = get_post($conn, 'lname');
    $address = get_post($conn, 'address');
    $city = get_post($conn, 'city');
    $province = get_post($conn, 'province');

    $query    = "INSERT INTO customer VALUES" .
      "('0','$fname', '$lname', '$address' ,'$city', '$province', '0')";
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
<h2>Add a Customer</h2>
  <form action="addcustomer.php" method="post">
    <div class="form-row">
      <div class="form-group col-md-6">
        First Name: <input class="form-control" type="text" name="fname">
        Last Name: <input class="form-control" type="text" name="lname"> 
      </div>
      <div class="form-group col-md-6">
        Address: <input class="form-control" type="text" name="address"> 
        City: <input class="form-control" type="text" name="city">
      </div>
      <div class="form-group col-md-12" style="padding-bottom: 1.5vw;">
        Province: <input class="form-control" type="text" name="province">
      </div>
      <div class="form-group col-md-6">
        <input type="submit" class="btn btn-custom" value="ADD CUSTOMER">
      </div>
    </div>
  </form>
  <span><?php echo $message; ?></span>

<div class="admin-return">
<a href="http://pizzom.myweb.cs.uwindsor.ca/60334/project/admin/"> <- Back to Admin Area</a>
</div>
</div>
<?php 
 $result->close();
  $conn->close();
  
include("../inc/footer.inc.php") ?>