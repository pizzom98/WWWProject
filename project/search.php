<?php include("inc/header-admin.inc.php") ?>
<?php
 require_once 'dbconfig.php';
  
 
?>
<script src="js/ajax.js"> </script> 

<div class="admin-wrapper">
<h2>Search</h2>
  <div class="wall">
    <section class="content">   
        <div class="col-xs-12">
        <form name='ajax' onsubmit='return false;'>
        <input class="form-control" name='ptitle' id='ptitle' type='text' onkeyup='searchtitle();'>
        </form> 
        <div id="result">
        <?php require_once 'search_table.php'; ?>
        </div>
     </section>
   </div>
</div>
<?php include("inc/footer.inc.php") ?>