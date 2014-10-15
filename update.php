<?php
  session_start();
  if(!isset($_SESSION['userid'])){
   header('Location:/index.php');
  }

  //CHeck if user trying to access is an admin
  if(!$_SESSION['type'] == "Admin" && !$_SESSION['type'] == "admin"){
     header('Location:error/403.html');
  }

  if($_SERVER["REQUEST_METHOD"] == "POST") {

        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASSWORD', 'n0thx');
        define('DB_NAME', 'mydb');
        $dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die('Could not connect to MySQL: '.mysql_error());
        @mysql_select_db(DB_NAME) OR die('Could not select database: '.mysql_error());
	$user_id = $_GET['id'];

	$id = test_input($_POST['id']);
	$first = test_input($_POST['fname']);
	$last = test_input($_POST['lname']);
	$pass = test_input($_POST['pw']);
	#print $user_id;
        $message = "UPDATE Users SET ";

        //update query call
        if( !empty($id) ){

          $find = mysql_query("SELECT * FROM Users WHERE userid='$id'");

          if( mysql_num_rows($find) == 0 ){
            $query = $message ."userid='".$id."' WHERE userid='".$user_id."'";
		if($_GET['id'] == $_SESSION['userid'])
			$_SESSION['userid'] = $id;         
          mysql_query($query);  
          }
          else
            header("Location: information.php?userid=$user_id&error=1");
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
        
//	$query = "UPDATE Users SET userid='".$id."', firstname='".$first."', lastname='".$last."', password='".$pass."' WHERE userid='".$user_id."'";
//	$result = mysql_query($query);
	mysql_close($dbc);
	header('Location: admin.php');
	


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
