<?php include("../inc/header-admin.inc.php") ?>

   <div class="admin-wrapper">
        <h2>Admin Area</h2>
        <ul class="admin-menu">
            <li><a href="booklist.php">Book List</a></li>
            <li><a href="addbook.php">Add a Book</a></li>
            <li><a href="checkout.php">Check Out Book</a></li>
            <li><a href="checkin.php">Check In Book</a></li>
            <li><a href="addcustomer.php">Add Customer</a></li>
            <li><a href="customerlist.php">Customer List</a></li>
            <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["user_type"] === 2){ ?>
            <li><a href="users.php">User Profiles</a></li>
            <li><a href="adduser.php">Add User</a></li>
            <li><a href="passwordreset.php">Reset Password</a></li>
            <li><a href="category_report.php">Category Report</a></li>
            <li><a href="customer_location_report.php">Customer Location Report</a></li>
            <?php } ?>
            <li><a href="passwordreset.php">Reset Password</a></li>
        </ul>
    </div>

<?php 
include("../inc/footer.inc.php") ?>