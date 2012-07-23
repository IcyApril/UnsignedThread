<?php
define('includeAllow', TRUE);
$page = 'thread.php';
include('../includes/connect.php');
include('../includes/functions.php');
session_start();

if ($_SESSION['adminloggedin']) {
header('Location: index.php');
die('You are already logged in!');
}

if ($_POST['username']) { $username = htmlspecialchars(mysql_real_escape_string($_POST['username']));}
if ($_POST['password']) { $password = htmlspecialchars(mysql_real_escape_string($_POST['password']));}

if ($username && $password) {
$hashedpassword =  hash('sha512', $password.$auth_salt);

$sql= 'SELECT * FROM `admins` WHERE user="'.$username.'" AND password="'.$hashedpassword.'"';

$result = mysql_query($sql);

while($row = mysql_fetch_array($result))
  {
  $user = $row['user'];
  }

	if ($user == $username) {
		$_SESSION['adminloggedin'] = TRUE;
		header('Location: index.php');
		die('Log-in details correct: - <a href="index.php">Home</a>');
	} else {
		echo "<h2>Incorrect details entered.</h2>";
	}

}
?>
<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta charset="utf-8"> 
<title><?=$sitename?> Log-in</title> 
    <!-- Le styles -->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
</head>
<body>
<div class="container">
<div id="form" class="modal hide fade in slide down" style="display: none; ">
            <div class="modal-header">
              <a class="close" data-dismiss="modal">×</a>
              <h3>Log-in</h3>
            </div>
            <div class="modal-body">

        <div class="well">
<center>
<form name="input" action="login.php" method="post">
<h3>User:</h3>
<input type="text" name="username" class="input-xlarge"/>
<br />
<h3>Password:</h3>
<input type="password" name="password" class="input-xlarge"/>
<br />
<input class="btn btn-success" type="submit" value="Submit" />
</form></center>
</div>

	        
            </div>
            <div class="modal-footer">
              <a href="#" class="btn" data-dismiss="modal">Close</a>
            </div>
          </div>
          <h1>Log-in…</h1>
          <p>Please login...</p>
<p><a data-toggle="modal" href="#form" class="btn btn-primary btn-large">Show login form.</a> <a href="../index.php" class="btn btn-large">Leave and return to homepage.</a></p>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../bootstrap/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap-transition.js"></script>
    <script src="../bootstrap/js/bootstrap-alert.js"></script>
    <script src="../bootstrap/js/bootstrap-modal.js"></script>
    <script src="../bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="../bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="../bootstrap/js/bootstrap-tab.js"></script>
    <script src="../bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="../bootstrap/js/bootstrap-popover.js"></script>
    <script src="../bootstrap/js/bootstrap-button.js"></script>
    <script src="../bootstrap/js/bootstrap-collapse.js"></script>
    <script src="../bootstrap/js/bootstrap-carousel.js"></script>
    <script src="../bootstrap/js/bootstrap-typeahead.js"></script>

</body>
</html>