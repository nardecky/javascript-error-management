<?php
  session_start();
  //Check for initialized session
  if(!isset($_SESSION['type'])){
   header('Location:/index.php');
  }  

  //CHeck if user trying to access is an admin
  if(!($_SESSION['type'] == "Admin") && !($_SESSION['type'] == "admin") ){
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

    <style>
	table {
		width: 100%;
		border: 1pt solid black;
	}	

	tr {
		border: 1pt solid black;
	}

	td {
		border: 1pt solid black;
		vertical-align: middle;
		text-align: center;
		padding: 30pt;
	}
    </style>
</head>
<body>
    <nav class="navbar navbar-default" role="navigation">
          <div class="container-fluid">
	    <a class="navbar-brand" href="addash.php">Question Reality</a>
	    <p class="navbar-text">Signed in as <?php echo $_SESSION['userid'] ?></p>
	    <ul class="nav navbar-nav navbar-right">
        	<li><p class="navbar-text">Login Time: <?php echo $_SESSION['time'] ?></p></li>
		<li><a href='admin.php'>Users</a></li>
		<li><a href="group.php">Groups</a></li>
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
        $query = "SELECT * FROM Users WHERE type='User' OR userid='".$_SESSION['userid']."'";

        $result = mysql_query($query);
        $numOfAccs = mysql_num_rows($result);
        print   "<table>";
        if($numOfAccs == 0)
            print("<tr><td>No accounts.</td></tr>");
        else {

	    print "<tr><td style='border: none;'>List of Users</td></tr><tr><td>Email</td><td>First Name</td><td>Last Name</td></tr>";
            while($row = mysql_fetch_array($result, MYSQL_NUM))
                print("<tr>
			<td>".$row[0]."</td>
			<td>".$row[1]."</td>
			<td>".$row[2]."</td>
			<td><a href='information.php?userid=".$row[0]."'>Update</a></td>
			<td><a href='delete.php?userid=".$row[0]."'>Delete</a></td></tr>");
	}
        print   "</table>";
    ?>
    </div>
</body>
</html>
