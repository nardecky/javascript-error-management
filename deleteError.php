<?php
	session_start();
          //Check for initialized session
          if(!isset($_SESSION['type'])){
           header('Location:/index.php');
          }

        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASSWORD', 'n0thx');
        define('DB_NAME', 'mydb');;
        $dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die('Could not connect to MySQL: '.mysql_error());
        @mysql_select_db(DB_NAME) OR die('Could not select database: '.mysql_error());

        $err = test_input($_GET['e']);

        $query = "DELETE FROM Comments WHERE errorid='$err'";
	$clear = mysql_query($query);
	$errorQuery = "DELETE FROM Errors WHERE id='$err'";
        $result = mysql_query($errorQuery);
        mysql_close($dbc);
        header('Location: dashboard.php');




function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = mysql_real_escape_string($data);
  return $data;
}

