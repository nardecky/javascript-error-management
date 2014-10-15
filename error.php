<?php
  session_start();
  if(!isset($_SESSION['userid']) || !isset($_GET['id'])){
   header('Location:/');
  }
  $ip = $errorTime = $url = $line = $message = 0;

  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASSWORD', 'n0thx');
  define('DB_NAME', 'mydb');
  $dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die('Could not connect to MySQL: '.mysql_error());
  @mysql_select_db(DB_NAME) OR die('Could not select database: '.mysql_error());

  $errorId = $_GET['id'];
  $g = $_SESSION['groupid'];
  $statement = "SELECT * FROM Errors WHERE id = " . mysql_real_escape_string($errorId) . " AND groupid = " . $_SESSION['groupid'] ;
  $query = mysql_query($statement);

  if($row = mysql_fetch_assoc($query)){
    $ip = $row['userIP'];
    $errorTime = $row['errortime'];
    $url = $row['url'];
    $line = $row['line'];
    $message = $row['message'];
  }
  else{
    header('Location:/');
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

<body style="font-family: sans-serif">
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

    <div style="padding: 50pt;">
	 
        <span style="color: red"><?php echo $ip; ?></span>  <br />         
	<p>
	<?php
		echo '<br>' . $line;
		echo '<br>' . $message;
		echo '<br>' . $errorTime;
		echo '<br>' . $url;
		print("<br><a href='deleteError.php?e=".$errorId."'>Delete</a>");
	?>
	</p>
	<hr>
        
        <br />

	<?php
  		$dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die('Could not connect to MySQL: '.mysql_error());
		@mysql_select_db(DB_NAME) OR die('Could not select database: '.mysql_error());
		$errorQuery = "SELECT * FROM Comments WHERE errorid='".mysql_real_escape_string($errorId)."'";
		$errorResult = mysql_query($errorQuery);
		$num = mysql_num_rows($errorResult);
		$counter = 1;
		if($num == 0)
			print("No comments.");
		else {
            		while($row = mysql_fetch_array($errorResult, MYSQL_NUM)) {
                		print(" <p style='background-color: cyan; border: 2pt solid black;'>
					<br/><span> #: </span>".$counter."
					<br/><span> User: </span>".$row[2]."
					<br><span>Severity Rating: </span>".$row[5]."
		                        <br/><span> Comment: </span>".$row[3]."
		                        <br/><span> Time: </span>".$row[4]."");
					if($_SESSION['userid'] == $row[2])
			                        print("<br/><a href='deleteComment.php?c=".$row[0]."'> Delete</a><br/><br/></p>");
					$counter++;
			}
	        }
		print("<br>	
			<div>
		            <form method='post' action='errSend.php?id=".$errorId."'>
		                <label><strong>Comment</strong></label><br/>
		                <textarea style='border: 1pt solid black' name='comment'></textarea><br/>
				<input type='number' name='rating' min='1' max='5'><br />
		                <input type='submit' value='Reply' style='text-transform: uppercase; padding: 5pt;'/>
 		           </form>
		        </div>");
	?>
        
    </div>
</body>
</html>
