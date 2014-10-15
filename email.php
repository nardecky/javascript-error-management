<?php


if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
  //define database variables
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASSWORD', 'n0thx');
  define('DB_NAME', 'mydb');
  $dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die('Could not connect to MySQL: '.mysql_error());

  @mysql_select_db(DB_NAME) OR die('Could not select database: '.mysql_error());
  
  //error variable
  $eflag = "1";
  $password = "";
  
  if( empty( $_POST['email']) ){
    header('Location:forgotpassword.php?error=1');
    $eflag = "0";
  }
  //check for legal email first (so cannot mess with our database
  $tmp_email = test_input($_POST['email']);

  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('Location:/forgotpassword.php?error=1');
    $eflag = "0";
  }
  
  // $query = "DELETE FROM Users WHERE userid= '".$_GET['userid']."'";
  if( $eflag ) {  
    //query for name.
    $userResults = mysql_query("SELECT * FROM Users WHERE userid = '$tmp_email'");
       
    //check if found
    if( mysql_num_rows($userResults) == 0) {
      header('Location:/forgotpassword.php?error=1');
    }
    //if found change and send password
    else {
      // $row = mysql_fetch_assoc($userResults);
      
      //generate random password
      $password = randomPassword();
      
      //change password in databass
      $query = "UPDATE Users SET password = '$password' WHERE userid = '$tmp_email'";
  
      //send database query. If fails dont send email
      if( mysql_query($query) ) {
        //message for email
        $m1 = "Hi there, ";
        $m2 = "\n\nWe thank you for your patience, your new password is $password ";
        $m3 = "\n\nThank you- \nQuestion Reality Team";
        $message = "$m1" . "$m2" . "$m3";
        $message = wordwrap($message, 70, "\r\n");
        $sent = mail("$tmp_email", 'Password Recovery', $message );
       
        //mail sending but not recieved. Put password in querystring for now for testing purposes 
        if( $sent ) {
          header("Location:/forgotpassword.php?success=1");
        }
        else
          header('Location:/forgotpassword.php?fail=1');
     
      }
      //else there was a db error
      else
        header('Location:/forgotpassword.php?dbfail=1');
    }

  } /* end eflag if */
  
  
  mysql_close($dbc);
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


function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

?>
