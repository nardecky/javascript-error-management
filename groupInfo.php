<?php
        session_start();
          //Check for initialized session
        if(!isset($_SESSION['type'])){
           header('Location:/index.php');
        }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Question Reality</title>
<link media="all" type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
<link media="all" type="text/css" rel="stylesheet" href="css/dashboard.css">
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
<div class="container-fluid">
<a class="navbar-brand" href="addash.php">Question Reality</a>
<p class="navbar-text">Signed in as <?php echo $_SESSION['userid'] ?></p>
<ul class="nav navbar-nav navbar-right">
<li><p class="navbar-text">Login Time: <?php echo $_SESSION['time']?></p></li>
<li><a href='admin.php'>Users</a></li>
<li><a href='logout.php' class="navbar-button navbar-right">Logout</a></li>
</ul>
</div>
</nav>
   <div style="padding: 50pt;">

   <form method='post' action='createGroup.php'>
        <input type='text' name='group' placeholder='New group name'><br/><br/>
        <input type='text' name='owner' placeholder='Group owner'><br/>
        <br/><input type='submit' value='Create'>
    </form>

        </div>
</body>
</html>


