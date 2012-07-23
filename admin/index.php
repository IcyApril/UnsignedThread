<?php

session_start();

define('includeAllow', TRUE);
$page = 'index.php';
include('../includes/connect.php');
include('../includes/functions.php');

// TEST IF ADMIN?

if (!$_SESSION['adminloggedin'] == TRUE) {
header('Location: login.php');
die('Please <a href="login.php">login</a>');
}

// END TEST

$status = htmlspecialchars(mysql_real_escape_string($_GET['status']));
$id = htmlspecialchars(mysql_real_escape_string($_GET['id']));
$page = htmlspecialchars(mysql_real_escape_string($_GET['pages']));

if ($page) {
$realpage = $page-1;
$lowerbound = $realpage*50;
$upperbound = $lowerbound+100;
$nextpage = $page+1;
} else {
$page = 1;
$realpage = 0;
$lowerbound = 0;
$upperbound = 100;
$nextpage = $page+1;
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
      <script src="../bootstrap/js/html5.js"></script>
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
        <h1><?=$sitename?> Management Console</h1><br />
        <p><a class="btn btn-primary btn-large" href="index.php">All threads &raquo;</a>
        <a class="btn btn-primary btn-large" href="index.php?status=4">New threads &raquo;</a>
        <a class="btn btn-primary btn-large" href="index.php?status=1">Host Reply &raquo;</a>
        <a class="btn btn-primary btn-large" href="index.php?status=2">User threads &raquo;</a>
        <a class="btn btn-primary btn-large" href="index.php?status=3">Closed threads &raquo;</a>
        </p>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="span12">
        <?php
        if($status) {
$quey1="SELECT * FROM posts WHERE id AND status=$status ORDER BY dt DESC";
} else {
$quey1="SELECT * FROM posts WHERE id BETWEEN $lowerbound AND $upperbound ORDER BY dt DESC";
}
$pg1="SELECT COUNT(id) FROM posts";
$pgresult=mysql_query($pg1) or die(mysql_error());
while($row=mysql_fetch_array($pgresult)){
$totpages = intval($row['COUNT(id)']/100+1);
}

if (($page > $totpages) || ($page < 0)) {
die('<p>No more pages. :(</p>'); }

$result=mysql_query($quey1) or die(mysql_error());
?>
<table class="table table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" class="db-table">
<tr>
<th>ID</th>
<th>Status</th>
<th>Truncated Initial Post</th>
<th>Date/Time</th>
</tr>
<?php
while($row=mysql_fetch_array($result)){
echo "</td><td>";
echo '<a href="thread.php?id='.$row['id'].'">'.$row['id'].'</a>';
echo "</td><td>";
echo statusIDtoPhraseFormatted($row['status']);
echo "</td><td>";
echo trunc($row['post'],15);
echo "</td><td>";
echo $row['dt'];
echo "</td></tr>";
}
echo "</table>";
?>
           <hr />
        </div>
      </div>

      <hr>

<?php if (!($status)) {?>
You are at page: <?=$page?> of <?=$totpages?> <?php if($page < $totpages) { ?><a href='index.php?pages=<?=$nextpage?>'>Page: <?=$nextpage?></a> <?php } ?>
<form name="pages" action="index.php" method="get">
Go to page: <input type="text" name="pages" />
<input type="submit" value="Go" />
</form>
<?php } ?>
<?php include('../includes/footer.php'); ?>

    </div> <!-- /container -->

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
