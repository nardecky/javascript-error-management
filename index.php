<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8" />
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <!-- add red to error messages -->
  <style>
    .error {color: #FF0000;}
  </style>
</head>
<body>
  <div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
      <div class="panel panel-info" >
        <div class="panel-heading">
          <div class="panel-title">Sign In
            <span class="error" style="margin-left:15px"></span>
          </div>
          <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="forgotpassword.php">Forgot password?</a></div>
        </div>
        <div style="padding-top:30px" class="panel-body" >
        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12">
      </div>
      <form id="loginform" class="form-horizontal" role="form" method="post" action="login.php">
        <span class="error">* <?php if(isset($_GET['error'])){ echo "Invalid email/password combination" ;} ?></span>
        <div style="margin-bottom: 25px" class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input id="login-username" type="text" class="form-control" name="userid" value="" placeholder="email">
        </div>
        <!--span class="error">* </span-->
        <div style="margin-bottom: 25px" class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <input id="login-password" type="password" class="form-control" name="password" placeholder="password" value="">
        </div>
       <div class="input-group">
         <div class="checkbox">
           <label>
             <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
           </label>
         </div>
       </div>
       <div style="margin-top:10px" class="form-group">
       <!-- Button -->
         <div class="col-sm-12 controls">
           <input type="submit" name="login" value="Login" id="btn-login">
           <!--<a id="btn-login" href="#" class="btn btn-success">Login </a>-->
         </div>
       </div>
<!-- hidden field fix to php form
<input type="hidden" name="sudo_name" value="'<'?php $name?>" submit='dashboard.php'>
-->
       <div class="form-group">
         <div class="col-md-12 control">
           <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
             Don't have an account!
             <a href="signup.php">
               Sign Up Here
             </a>
             <a href="about.html">Features Here</a>
           </div>
         </div>
      </div>
     </form>
  </div>
 </div>
</div>
<div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
<div class="panel panel-info">
<div class="panel-heading">
<div class="panel-title">Sign Up</div>
<div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
</div>
<div class="panel-body" >
<form id="signupform" class="form-horizontal" action="signup.php" role="form">
<div id="signupalert" style="display:none" class="alert alert-danger">
<p>Error:</p>
<span></span>
</div>
<div class="form-group">
<label for="email" class="col-md-3 control-label">Email</label>
<div class="col-md-9">
<input type="text" class="form-control" name="email" placeholder="Email Address">
</div>
</div>
<div class="form-group">
<label for="firstname" class="col-md-3 control-label">First Name</label>
<div class="col-md-9">
<input type="text" class="form-control" name="firstname" placeholder="First Name">
</div>
</div>
<div class="form-group">
<label for="lastname" class="col-md-3 control-label">Last Name</label>
<div class="col-md-9">
<input type="text" class="form-control" name="lastname" placeholder="Last Name">
</div>
</div>
<div class="form-group">
<label for="password" class="col-md-3 control-label">Password</label>
<div class="col-md-9">
<input type="password" class="form-control" name="passwd" placeholder="Password">
</div>
</div>
<div class="form-group">
<label for="icode" class="col-md-3 control-label">Invitation Code</label>
<div class="col-md-9">
<input type="text" class="form-control" name="icode" placeholder="">
</div>
</div>
<div class="form-group">
<!-- Button -->
<div class="col-md-offset-3 col-md-9">
<button id="btn-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
<span style="margin-left:8px;">or</span>
</div>
</div>
<div style="border-top: 1px solid #999; padding-top:20px" class="form-group">
<div class="col-md-offset-3 col-md-9">
<button id="btn-fbsignup" type="button" class="btn btn-primary"><i class="icon-facebook"></i> Sign Up with Facebook</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</body>
</html>

