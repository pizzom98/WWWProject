<?php include("inc/header-admin.inc.php") ?>
<?php
 require_once 'dbconfig.php';
 $book = $_GET['book'];
 $conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error) die($conn->connect_error);

 $query  = "SELECT books.book_id, books.title, books.isbn, books.published_date, books.author, categories.category_name, books.description, books.book_image FROM books INNER JOIN categories ON books.category=categories.category_id WHERE title LIKE '%$book%'";
 $result = $conn->query($query);
 if (!$result) die ("Database access failed: " . $conn->error);
 $row = $result->fetch_array(MYSQLI_ASSOC);

?>
<div class="homepage-wrapper">

    <div class="col-md-3 col-sm-6 col-xs-12 left view-image">
        <?php $image_src = "pictures/".$row['book_image']; ?>
        <img class="book-cover" src=<?php echo $image_src; ?>>
    </div>

    <div class="col-md-9 col-sm-6 col-xs-12 left view-info">
        Author: <span><?php echo $row['author']; ?></span><br>
        Title: <span><?php echo $row['title']; ?></span><br>
        ISBN: <span><?php echo $row['isbn']; ?></span><br>
        Published Date: <span><?php echo $row['published_date']; ?></span><br>
        Category: <span><?php echo $row['category_name']; ?></span>
    </div>

    <div class="col-12 left view-discription">
        <p><?php echo $row['description']; ?></p>
    </div>
    
    <?php  $result2->close(); ?>


</div>
<?php 
$result->close();
$conn->close();
include("inc/footer.inc.php") ?>