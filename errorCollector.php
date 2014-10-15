<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'n0thx');
define('DB_NAME', 'mydb');
$dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die('Could not connect to MySQL: '.mysql_error());
@mysql_select_db(DB_NAME) OR die('Could not select database: '.mysql_error());


if (isset($_GET['group'])){
  $groupId = htmlentities(substr(urldecode($_GET['group']),0,1024));
}
else {
  die("invalid id");
}

/* pull the error information from the query string */
if (isset($_GET['url']))
    $url = htmlentities(substr(urldecode($_GET['url']),0,1024));
else
    $url = "";
 
if (isset($_GET['message']))
    $message = htmlentities(substr(urldecode($_GET['message']),0,1024));
else
    $message = "";
 
if (isset($_GET['line']))
    $line = htmlentities(substr(urldecode($_GET['line']),0,1024));
else
    $line = "";
 
$userIP =  $_SERVER['REMOTE_ADDR'];;
$currentTime = date("M d y h:i:s A");


 
$statement = sprintf("INSERT INTO Errors(groupid, url, message, line, userIP, errortime) VALUES (%s, '%s', '%s', '%s', '%s', '%s');", $groupId, $url, $message, $line, $userIP, $currentTime);


$result = mysql_query($statement);

mysql_close($dbc);
 
// send the right headers
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header("HTTP/1.1 204 No Content\n\n");

exit();     
?>
