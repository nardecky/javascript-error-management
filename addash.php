<?php
  session_start();
  if(!isset($_SESSION['userid'])){
   header('Location:/');
  }

  //CHeck if user trying to access is an admin
  if(!($_SESSION['type'] == "Admin") && !($_SESSION['type'] == "admin") ){
     header('Location:error/403.html');
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
        <li><p class="navbar-text">Login Time: <?php echo $_SESSION['time']?></p></li>
	<li><a href='admin.php'>Users</a></li>
	<li><a href='group.php'>Groups</a></li>
        <li><a href='logout.php' class="navbar-button navbar-right">Logout</a></li>
    </ul>
</div>
</nav>
<div class="container-fluid">
<div class="row graph-row">
  <div class="col-xs-5 col-xs-offset-1">
    <a href="#" class="thumbnail">
      <img src="images/pie_chart.jpg" alt="...">
    </a>
  </div>
  <div class="col-xs-5">
    <a href="#" class="thumbnail">
      <img src="images/graph.jpg" alt="...">
    </a>
  </div>
</div>
<div class="row tag-row">
  <div class="col-xs-8 col-xs-offset-2">
    <p>
    <button type="button" class="btn btn-default btn-xs">ReferenceError</button>
    <button type="button" class="btn btn-default btn-xs">SyntaxError</button>
    <button type="button" class="btn btn-default btn-xs">TypeError</button>
    <button type="button" class="btn btn-default btn-xs">URIError</button>
    </p>
  </div>
</div>
  <div class="row" >
  <div class="col-xs-8 col-xs-offset-2">
  <ul class="list-group error-list">
        <li class="list-group-item"><a href="#"> Error 1</a></li>
        <li class="list-group-item"><a href="#"> Error 2</a></li>
        <li class="list-group-item"><a href="#"> Error 3</a></li>
        <li class="list-group-item"><a href="#"> Error 4</a></li>
  </ul>
</div>
</div>
</body>
</html>

