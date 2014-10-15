<?php

	session_start();
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
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

        $name = test_input($_SESSION['userid']);
        $err = test_input($_GET['id']);
	$time = date('H:i:s');

        $person = "SELECT DISTINCT memberid FROM Group_Members WHERE memberid='$name'";
	$error = "SELECT id FROM Errors WHERE id='$err'";
        $query = "INSERT INTO Comments (id, errorid, userid, text, commenttime, rating) VALUE (NULL,  ($error), ($person), '".$_POST['comment']."', '$time', '".$_POST['rating']."')";
        $result = mysql_query($query);
        mysql_close($dbc);
        header('Location: dashboard.php');
}

	else
		header('Location: /');

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = mysql_real_escape_string($data);
  return $data;
}
?>

