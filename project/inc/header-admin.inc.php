<?php session_start(); ?>
<html>
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="http://pizzom.myweb.cs.uwindsor.ca/60334/project/css/project.css">
        <link rel="stylesheet" type="text/css" href="http://pizzom.myweb.cs.uwindsor.ca/60334/project/css/bootstrap.min.css">
    
    </head>
<body>  

<!--Navbar-->
<nav class="navbar navbar-expand-sm navbar-dark header-wrapper">

  <!-- Navbar brand -->
  <a class="navbar-brand" href="#">BMS</a>

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse" id="basicExampleNav">

    <!-- Links -->
    <ul class="navbar-nav col-auto">
      <li class="nav-item">
        <a class="nav-link" href="http://pizzom.myweb.cs.uwindsor.ca/60334/project/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://pizzom.myweb.cs.uwindsor.ca/60334/project/categories.php">Categories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://pizzom.myweb.cs.uwindsor.ca/60334/project/search.php">Search</a>
      </li>
      <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){ 
                echo '<li class="nav-item"><a class="nav-link" href="http://pizzom.myweb.cs.uwindsor.ca/60334/project/admin">Tools</a></li>';
                echo '<li class="nav-item"><a class="nav-link" href="http://pizzom.myweb.cs.uwindsor.ca/60334/project/admin/logout.php">Logout, '.$_SESSION["username"].'</a></li>';
             }else{ 
                echo '<li class="nav-item"><a class="nav-link" href="http://pizzom.myweb.cs.uwindsor.ca/60334/project/login.php">Login</a></li>';
             } ?>
    <!-- Links -->
  </div>
  <!-- Collapsible content -->

</nav>
<!--/.Navbar-->