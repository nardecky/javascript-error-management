<?php
  session_start();
  if(!isset($_SESSION['userid'])){
   header('Location:/index.php');
  }

  function printErrorLinks(){
  $groupID = $_SESSION['groupid'];
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASSWORD', 'n0thx');
  define('DB_NAME', 'mydb');
  $dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die('Could not connect to MySQL: '.mysql_error());
  @mysql_select_db(DB_NAME) OR die('Could not select database: '.mysql_error());


  $statement = "SELECT id, groupid, message FROM Errors WHERE groupid = " . $_SESSION['groupid'] ;
  $results = mysql_query($statement);
  
  while($row = mysql_fetch_assoc($results)){
    echo "<li class='list-group-item'>From Group ".$row['groupid'].":<br><a href='error.php?id=" . $row['id'] . "'>" . substr($row['message'], 0, 20) . "</a></li>";
  }
}
?>

<!doctype html>
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
    <a class="navbar-brand" href="adminhome.php">Question Reality</a>
    <p class="navbar-text">Signed in as <?php echo $_SESSION['userid'] ?></p>
    <ul class="nav navbar-nav navbar-right">
        <li><p class="navbar-text">Login Time: <?php echo $_SESSION['time'] ?></p></li>
      
	<li><a href='regInfo.php'>Account Information</a></li>
	<li><a href='userGroup.php'>Groups</a></li>
        <li><a href='logout.php' class="navbar-button navbar-right">Logout</a></li>
    </ul>
</div>
</nav>

<div style='text-align: center'><a href='get_script.php'><strong>Grab Collector Here</strong></a><br/>
<hr>
<label style='align: center'>Errors</label></div>
  <div class="row" >
  <div class="col-xs-8 col-xs-offset-2">
  <ul class="list-group error-list">
	<?php
	printErrorLinks();
	?>
  </ul>
</div>
</div>

</body>
</html>


