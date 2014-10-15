<?php

//name $_POST['name']
//email $_POST['email']
//password $_POST['password_one']
//password $_POST['password_two']


// check if post request has been made from signup
if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

    //define php variables
    $nameERR = $passoneERR = $passtwoERR = $emailERR = $db_error = "";
    $name = $_POST['name'];
    $nflag = $eflag = $pflag_one = $pflag_two = 1;

    //define database variables
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'n0thx');
    define('DB_NAME', 'mydb');
    $dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die('Could not connect to MySQL: '.mysql_error());
    @mysql_select_db(DB_NAME) OR die('Could not select database: '.mysql_error());


     //check if name field empty
     if( empty( $_POST['name']) ){
       $nameERR = "Please enter name.";
       $nflag = 0;
     }
     //check if valid entry for a name
     else if(!preg_match("/^[a-zA-Z ]*$/",$_POST['name'])){ 
       $nameERR = "Only letters and white space allowed";
       $nflag = 0;
     }


     //check if field empty
     if( empty( $_POST['email']) ){
       $emailERR = "Please enter email.";
       $eflag = 0;
     }
     //check if valid email
     else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
       $emailERR = "Invalid email format";
       $eflag = 0;
     }

     //check if field empty
     if( empty( $_POST['password_one']) ){
       $passoneERR = "Please enter password";
       $pflag_one = 0;
     }
     //check if field empty
     if( empty( $_POST['password_two']) ){
       $passtwoERR = "Please enter password";
       $pflag_two = 0;
     }

     //if we got this far it means we can now check the data against the database
     if( $nflag &&  $eflag && $pflag_one && $pflag_two ) {
      
       $tmpname = test_input($_POST['email']); 
       $tmp_p = test_input($_POST['password_one']);
       $tmp_n = test_input($_POST['name']);
       $last_n = test_input($_POST['lastname']);

       //get username from database
       $userResults = mysql_query("SELECT * FROM Users WHERE userid = '$tmpname'");
 
       //if query returns empty
       if (mysql_num_rows($userResults) == 0){ 
         
         //see if email exists already

         //make sure passwords match
         if( $_POST['password_one'] == $_POST['password_two'] ) {
           
           //add user to DB
           $user_info = "INSERT INTO Users (userid, password, firstname, lastname, type) VALUES ('$tmpname','$tmp_p', '$tmp_n', '$last_n','User')";
           $result = mysql_query($user_info);

           //DB returns  1 if succsessful insert
           if( $result ) {
             
             //insert user into group
             $user_info = "INSERT INTO Groups (ownerid) VALUE ('$tmpname')";
             $result = mysql_query($user_info);
             
             //if successful insert themselve into group
             $query = mysql_query("SELECT * FROM Groups WHERE ownerid='$tmpname'");
             $group = mysql_fetch_array($query);
             $result_group = mysql_query("INSERT INTO Group_Members (memberid, groupid) VALUES ('$tmpname', '".$group['id']."')");
             
             if( !$result || !$result_group || !$query)
               $db_error="Experienced problem adding you to the system. Please try again.";
             else
               header('Location:/'); 
             
             //close db
             mysql_close($dbc);

           }
           //else display error to user
           else
             $db_error = "There was an error adding you to our system. Please try again.";

         }
         else{
           $passtwoERR = $passoneERR = "Password doesn't match.";
           $passoneERR = "passwords dont match";
         } 
      
       }
       else{
         $emailERR = "Email already exists.";
       }

     } /* End DB checks */    

        
     //close Database
     mysql_close($dbc);
 
     //set POST variables
     extract($_POST);
    
     //post request back 
     $url = 'http://104.131.195.37/signup.php';
     $fields = array(
     'nameErr' => urlencode($nameERR),
     'passoneErr' => urlencode($passoneERR),
     'passtwoErr' => urlencode($passtwoERR),
     'emailErr' => urlencode($emailERR),
     'name' => urlencode($name),
     'db_err' => urlencode($db_error),
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
