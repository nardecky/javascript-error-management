<?php
session_start();
  if(!isset($_SESSION['userid'])){
   header('Location:/index.php');
  }

  //CHeck if user trying to access is an admin

  if($_SERVER["REQUEST_METHOD"] == "POST") {

        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASSWORD', 'n0thx');
        define('DB_NAME', 'mydb');
        $dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die('Could not connect to MySQL: '.mysql_error());
        @mysql_select_db(DB_NAME) OR die('Could not select database: '.mysql_error());
        $user_id = $_SESSION['userid'];
        $id = test_input($_POST['id']);
        $first = test_input($_POST['fname']);
        $last = test_input($_POST['lname']);
        $pass = test_input($_POST['pw']);
        $message = "UPDATE Users SET ";

        if( !empty($id) ){

          $find = mysql_query("SELECT * FROM Users WHERE userid='$id'");

          if( mysql_num_rows($find) == 0 ){
            $query = $message ."userid='".$id."' WHERE userid='".$user_id."'";
	    $_SESSION['userid'] = $id;         
            mysql_query($query);  
          }
        }

        if( !empty($first) ){
          $query = $message ."firstname='".$first."' WHERE userid='".$user_id."'";
          mysql_query($query);
        }

        if( !empty($last) ){
          $query = $message ."lastname='".$last."' WHERE userid='".$user_id."'";
          mysql_query($query);
        }

        if( !empty($pass) ){
          $query = $message ."password='".$pass."' WHERE userid='".$user_id."'";
          mysql_query($query);
        }

        $result = mysql_query($query);
        mysql_close($dbc);
        header('Location: dashboard.php');
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = mysql_real_escape_string($data);
  return $data;
}

?>

