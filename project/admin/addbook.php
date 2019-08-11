<?php include("../inc/header-admin.inc.php") ?>
<?php
 require_once 'dbconfig.php';
  
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  
  if (isset($_POST['title'])           &&
      isset($_POST['isbn'])            &&
      isset($_POST['published_date'])  &&
      isset($_POST['category'])        &&
      isset($_POST['author'])          &&
      isset($_POST['description']))
  {
    
    $title              = get_post($conn, 'title');
    $isbn               = get_post($conn, 'isbn');
    $published_date     = get_post($conn, 'published_date');
    $category           = get_post($conn, 'category');
    $author             = get_post($conn, 'author');
    $description        = get_post($conn, 'description');

    $name =  mt_rand(). "-" .$_FILES['file']['name'];
    $target_dir = "../pictures/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension
    //if( in_array($imageFileType,$extensions_arr) ){
       
       $query    = "INSERT INTO books VALUES('0','$title', '$isbn', '$published_date' ,'$category', '$author', '$description','$name')";
       $result = mysqli_query($conn,$query);
        
       if (!$result){
          $message = "INSERT failed: $query<br>" . $conn->error . "<br><br>";
       }else{
          $message = "Data inserted successfully" ;
       } 
       // Upload file
       move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

    //}

       

     
  }

  
  function get_post($conn, $var)  { 

    return $conn->real_escape_string($_POST[$var]);
  
    }
  
?>
<div class="admin-wrapper">
<h2>Add a Book</h2>
  <form action="addbook.php" method="post" enctype='multipart/form-data'>
    <div class="form-row">
      <div class="form-group col-md-6">
      Title: <input class="form-control" type="text" name="title">
      ISBN: <input class="form-control" type="text" name="isbn"> 
      </div>
      <div class="form-group col-md-6">
      Published Date (MM/DD/YYYY) : <input class="form-control" type="text" name="published_date"> 
      Category:  <select class="form-control" name="category">
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
                        <option value="<?php echo "$row[0]"; ?>"><?php echo "$row[1]"; ?></option>
                    <?php
                    }
                    ?>
                </select> 
      </div>
      <div class="form-group col-md-12">
       Author: <input class="form-control" type="text" name="author">
      </div>
      <div class="form-group col-md-12">
       Description: (Max 300 words) <textarea class="form-control" rows="4" cols="50" name="description"></textarea>
      </div>
      <div class="form-group col-md-6">
       Select Book Cover to Upload: <input class="form-control-file" type='file' name='file' style="padding-bottom: 1.5vw;"/>
      <input type="submit" class="btn btn-custom" value="ADD RECORD">
      </div>
    </form>
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