<?php

if(isset($_POST){
createUser();
}
else if(isset($_GET){
}
else if(isset($_PUT){
}
else if(isset($_DELETE){
}



function createUser(){
if(!isset($_POST['email']) || !isset($_POST['firstname'] || !isset($_POST['lastname'] || !isset($_POST['passwd']){
  //redirect to login
}
else {
  $email = mysql_real_escape_string(htmlspecialchars(trim($_POST['email'])));
  $fname = mysql_real_escape_string(htmlspecialchars(trim($_POST['firstname'])));
  $lname = mysql_real_escape_string(htmlspecialchars(trim($_POST['lastname'])));
  $lname = mysql_real_escape_string(htmlspecialchars(trim($_POST['passwd'])));


}

}

?>
