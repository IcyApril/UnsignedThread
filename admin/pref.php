<?php

session_start();

define('includeAllow', TRUE);
$page = 'pref.php';
include('../includes/connect.php');
include('../includes/functions.php');

// TEST IF ADMIN?

if (!$_SESSION['adminloggedin'] == TRUE) {
header('Location: login.php');
die('Please <a href="login.php">login</a>');
}

// END TEST

$newuser = htmlspecialchars(mysql_real_escape_string($_POST['newuser']));
$newpassword = htmlspecialchars(mysql_real_escape_string($_POST['newpassword']));

if ($newuser && $newpassword) {
$hashedpassword =  hash('sha512', $newpassword.$auth_salt);
$sql = 'INSERT INTO admins (id, user, password) VALUES (NULL, "'.$newuser.'", "'.$hashedpassword.'")';
if (!mysql_query($sql))  {
  $error = TRUE;
  }
}

$passwordchangeid = htmlspecialchars(mysql_real_escape_string($_POST['passwordchangeid']));
$passwordchangenewpassword = htmlspecialchars(mysql_real_escape_string($_POST['passwordchangenewpassword']));

if ($passwordchangeid && $passwordchangenewpassword) {
$hashedpassword =  hash('sha512', $passwordchangenewpassword.$auth_salt);
$sql = 'UPDATE admins SET password="'.$hashedpassword.'" WHERE id='.$passwordchangeid;
if (!mysql_query($sql))  {
  $error = TRUE;
  }
}

$namechangeid = htmlspecialchars(mysql_real_escape_string($_POST['namechangeid']));
$namechangenewname = htmlspecialchars(mysql_real_escape_string($_POST['namechangenewname']));

if ($namechangeid && $namechangenewname) {
$sql = 'UPDATE admins SET user="'.$namechangenewname.'" WHERE id='.$namechangeid;
if (!mysql_query($sql))  {
  $error = TRUE;
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?=$sitename?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/_src/bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="/_src/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/_src/bootstrap/js/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

<?php include('includes/nav.php'); ?>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1><?=$sitename?> Management Console</h1>
        <p>Preferences…</p>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="span12">
        <div class="well">
<center><h2>Add Host</h2>
<form name="input" action="pref.php" method="post">
<h3>Username:</h3>
<input type="text" name="newuser" class="input-xlarge"/>
<br />
<h3>Password:</h3>
<input type="password" name="newpassword" class="input-xlarge"/>
<br />
<input type="submit" value="Submit" />
</form></center>
</div>
        </div>
        
        <div class="span12">
        <div class="well">
<center><h2>Hosts</h2></center>
      <?php
$quey1="SELECT * FROM admins";
$result=mysql_query($quey1) or die(mysql_error());
?>
<table class="table table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" class="db-table">
<tr>
<th>ID</th>
<th>Name</th>
<th>Password Hash</th>
</tr>
<?php
while($row=mysql_fetch_array($result)){
echo "</td><td>";
echo $row['id'];
echo "</td><td>";
echo $row['user'];
echo "</td><td>";
echo $row['password'];
echo "</td></tr>";
}
echo "</table>";
?>
</div>
</div>
        <div class="span12">
        <div class="well">
<center><h2>Edit Host Password</h2>
<form name="input" action="pref.php" method="post">
<h3>ID:</h3>
<input type="text" name="passwordchangeid" class="input-xlarge"/>
<br />
<h3>Password:</h3>
<input type="password" name="passwordchangenewpassword" class="input-xlarge"/>
<br />
<input type="submit" value="Submit" />
</form></center>
</div>
        <div class="well">
<center><h2>Edit Host Name</h2>
<form name="input" action="pref.php" method="post">
<h3>ID:</h3>
<input type="text" name="namechangeid" class="input-xlarge"/>
<br />
<h3>Name:</h3>
<input type="text" name="namechangenewname" class="input-xlarge"/>
<br />
<input type="submit" value="Submit" />
</form></center>
</div>

        </div>
        
		</div>

      <hr>
<?php include('../includes/footer.php'); ?>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/_src/bootstrap/js/jquery.js"></script>
    <script src="/_src/bootstrap/js/bootstrap-transition.js"></script>
    <script src="/_src/bootstrap/js/bootstrap-alert.js"></script>
    <script src="/_src/bootstrap/js/bootstrap-modal.js"></script>
    <script src="/_src/bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="/_src/bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="/_src/bootstrap/js/bootstrap-tab.js"></script>
    <script src="/_src/bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="/_src/bootstrap/js/bootstrap-popover.js"></script>
    <script src="/_src/bootstrap/js/bootstrap-button.js"></script>
    <script src="/_src/bootstrap/js/bootstrap-collapse.js"></script>
    <script src="/_src/bootstrap/js/bootstrap-carousel.js"></script>
    <script src="/_src/bootstrap/js/bootstrap-typeahead.js"></script>

  </body>
</html>
