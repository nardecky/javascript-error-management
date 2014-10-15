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

        $name = test_input($_GET['userid']);        
        $group = test_input($_GET['group']);

	$search = "SELECT * FROM Group_Members WHERE memberid='$name'";
	$sResult = mysql_query($search);
	$num = mysql_num_rows($sResult);
        $query = "INSERT INTO Group_Members (id, memberid, groupid) VALUE (NULL,  '$name', '$group')";
        $result = mysql_query($query);
        mysql_close($dbc);
        header('Location: group.php');

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = mysql_real_escape_string($data);
  return $data;
}
?>

