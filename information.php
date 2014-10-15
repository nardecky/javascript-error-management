<?php
	session_start();
          //Check for initialized session
       	if(!isset($_SESSION['type'])){
           header('Location:/index.php');
        }

          //CHeck if user trying to access is an admin
          if(!($_SESSION['type'] == "Admin") && !($_SESSION['type'] == "admin")){
             header('Location:error/403.html');
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
		<li><a href='group.php'>Groups</a></li>
	        <li><a href='logout.php' class="navbar-button navbar-right">Logout</a></li>
	    </ul>
	</div>
    </nav>
    <div style="padding: 50pt;">
    <!--<table style="align: center; width: 300pt;">
        <tr>
            <td>Test</td>
            <td>Test2</td>
        </tr>
    </table>-->

    <?php
        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASSWORD', 'n0thx');
        define('DB_NAME', 'mydb');
        $dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die('Could not connect to MySQL: '.mysql_error());
        @mysql_select_db(DB_NAME) OR die('Could not select database: '.mysql_error());
        $query = "SELECT * FROM Users WHERE userid='".$_GET['userid']."'";
        $result = mysql_query($query);
        $numOfAccs = mysql_num_rows($result);
	$row = mysql_fetch_array($result, MYSQL_NUM);
        if(isset( $_GET['error']) )
          print"<span style='color:#FF0000;'> Username already exists </span>";
	print "<form method='post' action='update.php?id=".$_GET['userid']."'>";
	print "<br/>$row[0]<br/>";
	print "<input type='text' name='id' placeholder='New email'>";
	print "<br/>$row[1]<br/>";
        print "<input type='text' name='fname' placeholder='New first name'>";
        print "<br/>$row[2]<br/>";
        print "<input type='text' name='lname' placeholder='New last name'>";
        print "<br><label>Password:</label>";
        print "<br/><input type='password' name='pw' placeholder='New password'>";
	print "<br/><input type='submit' value='Update'>";
	print "</form>";

	?>
	</div>
</body>
</html>
