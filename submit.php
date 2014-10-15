<?php

//if post method request called
if ($_SERVER["REQUEST_METHOD"] == "POST") {

//define global variables to this file
$nameERR = $passERR = "";
$name = $password = "";
$flag_one = 1;
$flag_two = 1;

//define database variables
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'n0thx');
define('DB_NAME', 'mydb');
$dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die('Could not connect to MySQL: '.mysql_error());
@mysql_select_db(DB_NAME) OR die('Could not select database: '.mysql_error());


  //if name is left empty
  if (empty($_POST["name"])) {
    $nameERR = "name is required";
  }
  //else there is input
  else {
    $name = test_input($_POST["name"]);

    //get username from database
    $userResults = mysql_query("SELECT * FROM Users WHERE userid = '$name'");
 
    //if query returns empty
    if (mysql_num_rows($userResults) == 0) {
        $nameERR = "Incorrect username.";
	$passERR = "";
	$flag_one = 0;
	}
    else
	$flag_one = 1;
  }

  //check if password is empty
  if (empty($_POST["password"])) {
    $passERR = "password is required";

  }
  //check to see if password matches
  else{
    $name = test_input($_POST["name"]);
    $password = test_input($_POST["password"]);
    $passResults = mysql_query("SELECT * FROM Users WHERE userid = '$name' AND password = '$password'");
    if(mysql_num_rows($passResults) == 0) {
	$nameERR = "Incorrect Login";
	$passERR = "Incorrect Password.";
	$flag_two = 0;
    }
    else{
        $flag_two = $flag_one = 1;
    }
  }
  
  mysql_close($dbc); 
  //if all checks out get time and username and redirect user
    
  //extract data from the post
  extract($_POST);

  //set POST variables
  $url = 'http://104.131.195.37/index.php';
  $fields = array(
  'nameErr' => urlencode($nameERR),
  'passErr' => urlencode($passERR),
			);

   //url-ify the data for the POST
   foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
   rtrim($fields_string, '&');

   //open connection
   $ch = curl_init();

   //set the url, number of POST vars, POST data
   curl_setopt($ch,CURLOPT_URL, $url);
   curl_setopt($ch,CURLOPT_POST, count($fields));
   curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

   //execute post
   $result = curl_exec($ch);

   //close connection
   curl_close($ch);
   
   //if errors we start over. Else we succesfully logged in
   if($flag_one == 0 || $flag_two == 0){
     header('Location:104.131.195.37/index.php');
   }
   else{
     //send user through to dashboard page ;
     header('Location:104.131.195.37/dashboard.php');
   }

}
else{
  header('Location:http://104.131.195.37/index.php');
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = mysql_real_escape_string($data);
  return $data;
}
?>


