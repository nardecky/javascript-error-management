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
        $query = "DELETE FROM Group_Members WHERE memberid= '".$_GET['userid']."' AND groupid='".$_GET['group']."'";
        $result = mysql_query($query);
        mysql_close($dbc);
	if($_SESSION['type'] == "Admin" || $_SESSION['type'] == "admin"){
        	header('Location: group.php');
	}
	else
		header('Location: userGroup.php');

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = mysql_real_escape_string($data);
  return $data;
}

?>

