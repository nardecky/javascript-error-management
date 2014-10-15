<?php

if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

//define database variables
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'n0thx');
define('DB_NAME', 'mydb');
$dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die('Could not connect to MySQL: '.mysql_error());
@mysql_select_db(DB_NAME) OR die('Could not select database: '.mysql_error());


  //if userid is left empty
  if (empty($_POST["userid"])|| empty($_POST["password"])) {
     header('Location:/?error=1');
  }
  //else there is input
  else {
    $userid = test_input($_POST["userid"]);
    $password = test_input($_POST["password"]);

    //get user from database
    $userResults = mysql_query("SELECT * FROM Users WHERE userid = '$userid' AND password = '$password'");
 
    //if query returns empty
    if (mysql_num_rows($userResults) == 0) {
     header('Location:/?error=1');
    }
    else {
      session_start();
      $row = mysql_fetch_array($userResults);
      $_SESSION['userid'] = $row['userid'];
      $_SESSION['time'] = date('H:i:s');
      $_SESSION['type'] = $row['type'];
      if(($_SESSION['type'] == "Admin") || ($_SESSION['type'] == "admin")){
        header('Location: addash.php');
      }
      else {
        //load groupid into session
        $groupResults = mysql_query("SELECT groupid  FROM Group_Members WHERE memberid = '" . $row['userid'] ."'");
	$groupId = mysql_fetch_assoc($groupResults);
	$_SESSION['groupid'] = $groupId['groupid'];

        $groups = array($groupId);
        while($group_row = mysql_fetch_assoc($groupResults)){
           array_push($groups, $group_row['groupid']);
        }

        $_SESSION['groups'] = $groups;
        
        header('Location:dashboard.php');
      }
    }

  }
}
else
  header('Location:/');


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = mysql_real_escape_string($data);
  return $data;
}
?>


