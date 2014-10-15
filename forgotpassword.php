<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Forgot Password </title>
</head>
<body>
  <div id="form" style="margin:auto;width:600px;border:solid black 1px; border-radius:5px;border-color:#BCE8F1;padding:10px;">
  <h1>Password Recovery</h1>
  <span style="color:#FF0000;"> <?php if(isset($_GET['fail'])){ echo "Email failed to send. Try again please." ;}?></span>
  <span style="color:#FF0000;"> <?php if(isset($_GET['error'])){ echo "Invalid email" ;}?></span>
  <span style="color:green;"> <?php if( isset($_GET['success'])){ echo "New password sent";} ?></span>
  <span style="color:#FF0000;"> <?php if( isset($_GET['dbfail'])){ echo "We experienced technical difficulties. Please try again.";} ?></span>
  <form action="email.php" method="post">
    <input type="text" placeholder="enter your email" name="email">
    <input type="submit" value="Send">
  </form>
  <br>
  <a href="index.php">Go Back </a>
  </div>
</body>
</html>
