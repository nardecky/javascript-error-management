<!DOCTYPE html>   
 <html>
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <title>Signup</title>
   <link href="css/bootstrap.css" rel="stylesheet">
   <link href="css/bootstrap-responsive.css" rel="stylesheet">
   <style>
     .error {color: #FF0000;margin-left:10px;}
   </style>
 </head>
 <body>
   <div class="container">
     <span style="margin:auto; color:#FF0000;"><h1><?php echo $_POST['db_err'] ?></h1></span>

     <form class="form-horizontal" id="registration" role="form" method="post" action="adduser.php" style="margin:auto; width:450px; margin-top:100px;border:solid black 1px; border-color:#BCE8F1; padding:15px; border-radius:5px;">
     <fieldset>
       <legend>Signup Form</legend>
       <div class="control-group">
         <label class="control-label">Firstname:</label>
       <div class="controls">
         <input type="text" id="username" name="name" value="<?php echo $_POST['name'] ?>">
         <span class="error">* <?php echo $_POST['nameErr'];?></span>
       </div>
     </div>
     <div class="control-group">
       <label class="control-label">Lastname:</label>
     <div class="controls">
       <input type="text" class="password" name="lastname" value="">
     </div>
     <div class="control-group">
       <label class="control-label">Password:</label>
       <div class="controls">
         <input type="password" class="password" name="password_one">
         <span class="error">* <?php echo $_POST['passoneErr'];?></span>
       </div>
     </div>
     <div class="control-group">
       <label class="control-label">Password(Re-enter):</label>
       <div class="controls">
         <input type="password" class="password" name="password_two">
         <span class="error">* <?php echo $_POST['passtwoErr'];?></span>
       </div>
    </div>
    <div class="control-group">
      <label class="control-label">Email (username) </label>
      <div class="controls">
        <input type="text" id="email" name="email">
        <span class="error">* <?php echo $_POST['emailErr'];?></span>
     </div>
    </div>
    <div class="control-group">
      <label class="control-label"></label>
      <div class="controls">
        <input type="submit" class="btn btn-success" value="Submit">
      </div>
    </div>
    <a href="index.php" style="float:right;">Go Back </a>
    </fieldset>
    </form>
  </div>
</body>
</html>

