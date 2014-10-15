<?php

  session_start();
  if(!isset($_SESSION['userid'])){
   header('Location:/index.php');
  }
      if($_SESSION['type'] == "Admin" || $_SESSION['type'] == "admin"){
        header('Location:addash.php');
      }
      else {
        header('Location:dashboard.php');
      }

?>
