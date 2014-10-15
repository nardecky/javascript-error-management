<?php
  session_start();
  if(!isset($_SESSION['userid'])){
   header('Location:/');
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
<div class="container-fluid">
<div class="row graph-row">
<div class="col-xs-10 col-xs-offset-1">
<h1>Error Collecting <small>Add this code to your website to start collecting errors!</small></h1>
<p><code>
<br>var AjaxTCRExamples = {};
<br>AjaxTCRExamples.errorReportingURL = "http://104.131.195.37/errorCollector.php";
<br>AjaxTCRExamples.encodeValue = function(val)
<br>{
<br> var encodedVal;
<br> if (!encodeURIComponent)
<br> {
<br>   encodedVal = escape(val);
<br>   /* fix the omissions */
<br>   encodedVal = encodedVal.replace(/@/g, '%40');
<br>   encodedVal = encodedVal.replace(/\//g, '%2F');
<br>   encodedVal = encodedVal.replace(/\+/g, '%2B');
<br> }
<br> else
<br> {
<br>   encodedVal = encodeURIComponent(val);
<br>   /* fix the omissions */
<br>   encodedVal = encodedVal.replace(/~/g, '%7E');
<br>   encodedVal = encodedVal.replace(/!/g, '%21');
<br>   encodedVal = encodedVal.replace(/\(/g, '%28');
<br>   encodedVal = encodedVal.replace(/\)/g, '%29');
<br>   encodedVal = encodedVal.replace(/'/g, '%27');
<br> }
<br> /* clean up the spaces and return */
<br> return encodedVal.replace(/\%20/g,'+'); 
<br>}    
<br> 
<br>AjaxTCRExamples.reportJSError = function (errorMessage,url,lineNumber)
<br>{
<br>    function sendRequest(url,payload)
<br>    {
<br>         var img = new Image();
<br>         img.src = url+"?group=<?php echo $_SESSION['groupid'];?>&"+payload;
<br>    }
<br>    
<br>    var payload = "url=" + AjaxTCRExamples.encodeValue(url);
<br>    payload += "&message=" + AjaxTCRExamples.encodeValue(errorMessage);
<br>    payload += "&line=" + AjaxTCRExamples.encodeValue(lineNumber);
<br> 
<br>    sendRequest(AjaxTCRExamples.errorReportingURL,payload);
<br> 
<br>    alert("JavaScript Error Encountered.  \nSite Administrators have been notified.");
<br> 
<br>    return true; 
<br>}
<br> 
<br>AjaxTCRExamples.registerErrorHandler = function () 
<br>{    
<br>    if (window.onerror) // then one exists
<br>      {
<br>       var oldError = window.onerror;
<br>       var newErrorHandler = function (errorMessage,url,lineNumber) { AjaxTCRExamples.reportJSError(errorMessage,url,lineNumber); oldError(errorMessage,url,lineNumber); }
<br>       window.onerror = newErrorHandler;
<br>      }
<br>    else
<br>      window.onerror = AjaxTCRExamples.reportJSError;
<br>}
<br> 
<br>AjaxTCRExamples.registerErrorHandler();
</code></p>
</div>
</div>
</div>

</body>
</html>
