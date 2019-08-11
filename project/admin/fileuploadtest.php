<?php
 require_once 'dbconfig.php';
  
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);


if(session_status() == PHP_SESSION_NONE){
    //session has not started
    session_start();
    $_SESSION["Test"] = 'true';
}


if( $_SESSION["Test"] === 'true'){echo "session active!!"; session_destroy();} 
?>
