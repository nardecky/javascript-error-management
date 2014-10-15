<?php
  session_start();
  if(!isset($_SESSION['userid'])){
   header('Location:/index.php');
  }

  //CHeck if user trying to access is an admin
  if(!$_SESSION['type'] == "Admin" || !$_SESSION['type'] == "admin"){
     header('Location:error/403.html');
  }

  if($_SERVER["REQUEST_METHOD"] == "POST") {

        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASSWORD', 'n0thx');
        define('DB_NAME', 'mydb');
        $dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die('Could not connect to MySQL: '.mysql_error());
        @mysql_select_db(DB_NAME) OR die('Could not select database: '.mysql_error());
        $user_id = test_input($_GET['userid']);
#        $id = $_POST['id'];
 #       $first = $_POST['fname'];
  #      $last = $_POST['lname'];
   #     $pass = $_POST['pw'];
        #print $user_id;
        $query = "UPDATE Users SET type='Admin' WHERE userid= '$user_id'";
        $result = mysql_query($query);
        mysql_close($dbc);
        header('Location: admin.php');
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = mysql_real_escape_string($data);
  return $data;
}

?>
