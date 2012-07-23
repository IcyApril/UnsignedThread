<?php
define('includeAllow', TRUE);
$page = 'thread.php';
include('../includes/connect.php');
include('../includes/functions.php');
session_start();

// TEST IF ADMIN?

if (!$_SESSION['adminloggedin'] == TRUE) {
header('Location: login.php');
die('Please <a href="login.php">login</a>');
}

// END TEST

if ($_GET['id']) { $id = htmlspecialchars(mysql_real_escape_string($_GET['id'])); unset($_SESSION['id']);}
if ($_POST['id']) { $id = htmlspecialchars(mysql_real_escape_string($_POST['id'])); unset($_SESSION['id']);}

if (!$id) {
	$id = $_SESSION['id'];
}


$replypost = htmlspecialchars(mysql_real_escape_string($_POST['replypost']));

if ($id) {
if (!$hashedauthkey) {
$hashedauthkey =  hash('sha512', $authkey);
}
$sql= 'SELECT * FROM `posts` WHERE id='.$id;

$result = mysql_query($sql);

while(@$row = mysql_fetch_array($result))
  {
  $dbpostid = $row['id'];
  $dbauth = $row['auth'];
  $post = $row['post'];
  $status = $row['status'];
  $postdt = $row['dt'];
  }

$_SESSION['id'] = $id;
$_SESSION['auth'] = $dbauth;

$statusname = statusIDtoPhrase($status);

if (!$dbpostid && !$_GET['id']) {
$error = TRUE;
}

// HANDLE REPLIES
if ($replypost) {

$hashedauthkey =  hash('sha512', $authkey);
$sql= 'SELECT * FROM `posts` WHERE id='.$_SESSION['id'];

$result = mysql_query($sql);

while($row = mysql_fetch_array($result))
  {
  $doesexist = $row['id'];
  }
if ($doesexist) {

$sql = 'INSERT INTO replies (pid, role, dt, post) VALUES ('.$id.', "host", NOW(), "'.$replypost.'")';
if (!mysql_query($sql))  {
  $error = TRUE;
  } else {$replied = TRUE;
  mysql_query('UPDATE posts SET status=1 WHERE id='.$id);
  }

} else {
session_destroy();
die('POST DOES NOT EXIST!');
}

}

// END REPLIES

// MANAGE CLOSE

if ($_GET['closethread']) { $closethread = mysql_real_escape_string($_GET['closethread']);}

if ($closethread) {
$sql = 'UPDATE posts SET status=3 WHERE id='.$id;
if (!mysql_query($sql))  {
  $error = TRUE;
  } else {$closed = TRUE;
  }

}
}

// END CLOSE

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
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">

<script type="text/javascript">
    window.onload = function()
    {
            $(document).ready(function(){
                $('#authkeytooltip').tooltip({'placement':'top', 'trigger' : 'hover'});
            });
            $(document).ready(function(){
                $('#idtooltip').tooltip({'placement':'top', 'trigger' : 'hover'});
            });
            $(document).ready(function(){
                $('#replytooltip').tooltip({'placement':'top', 'trigger' : 'hover'});
            });
    }
</script>

  </head>

  <body>

<?php include('includes/nav.php'); ?>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1><?=$sitename?> Management Console</h1>
      </div>
      
      
      <div class="row">
        
        <div class="span4">
        <div class="hero-unit">
        <?php if ($dbpostid == "") { ?>
          <h2>View/reply to a thread.</h2>
           <p>To view/reply to an existing thread, fill in the form on the right.</p>
          <h2>No thread?</h2>
          <p><a class="btn" href="new.php">Make a thread &raquo;</a></p>
        <?php } else {?>
        <h2>Viewing thread ID: <?=$dbpostid?></h2><br />
        <p>The post is currently <?=$statusname?>.</p>
        <hr />
<form name="reply" action="thread.php" method="post">
<h3><a rel="tooltip" title="Enter in your reply to this thread." id="replytooltip">Reply</a>:</h3>
<textarea name="replypost" rows="5" cols="20" class="input-xlarge"></textarea>
<br />
<input type="submit" value="Submit" />
</form>
<p><a class="btn btn-primary btn-large" href="thread.php?id=<?=$id?>">Reload thread &raquo;</a></p>
<p><a class="btn" href="thread.php?id=<?=$id?>&closethread=1">Close Thread &raquo;</a></p>
        
        <?php } ?>
          </div> <!-- /hero-unit -->
        </div> <!-- /span6 -->
        
        <div class="span8">
        <div class="oldwell">
<?php
if($error == TRUE) {
?>
<div class="alert alert-error">
<button class="close" data-dismiss="alert">&times;</button>
<p>No thread with those details exists!</p>
</div>
<? } ?>
<?php if ($dbpostid == "") { ?>
<div class="well">
<center>
<form name="input" action="thread.php" method="post">
<h3><a rel="tooltip" title="Enter the post ID, this was generated for you." id="idtooltip">ID</a>:</h3>
<input type="text" name="id" class="input-xlarge" value="<?=$id?>"/>
<br />
<input type="submit" value="Submit" />
</form>
</center>
</div> <!-- /oldwell -->
<?php } else { ?>

<?php if($replied == TRUE) {
?>
<div class="alert alert-success">
<button class="close" data-dismiss="alert">&times;</button>
<p>You have replied to this post!</p>
</div>
<? } ?>

<?php
$sql= 'SELECT * FROM `replies` WHERE pid='.$id.' ORDER BY dt DESC';

$result = mysql_query($sql);

while(@$row = mysql_fetch_array($result))
  {
  echo '<div class="well"><center>'.$row['post'].'</center>';
  echo '<hr /><span class="label label-info">'.$row['role'].' reply | '.$row['dt'].'</span><br /></div>';
  }
?>
<div class="well">
<center><?=$post?></center>
<hr />
<span class="label label-info">Original post | <?=$postdt?></span>
</div> <!-- /well -->
<?php } ?>
        </div>
        </div> <!-- /span 6 -->
        
      </div>
      
      <hr>

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