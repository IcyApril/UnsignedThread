<?php
session_start();

define('includeAllow', TRUE);
$page = 'new.php';
include('includes/connect.php');
include('includes/functions.php');

$authkey = htmlspecialchars(mysql_real_escape_string($_POST['authkey']));
$post = htmlspecialchars(mysql_real_escape_string($_POST['post']));

if ($authkey && $post) {
$hashedauthkey =  hash('sha512', $authkey.$auth_salt);
$sql = 'INSERT INTO posts (id, auth, post, status, dt) VALUES (NULL, "'.$hashedauthkey.'", "'.$post.'", 4, NOW())';
if (!mysql_query($sql))  {
  $error = TRUE;
  }
}
$id = mysql_insert_id();

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
    <link href="./bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="./bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

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
                $('#posttooltip').tooltip({'placement':'top', 'trigger' : 'hover'});
            });
    }
</script>

  </head>

  <body>

<?php include('includes/nav.php'); ?>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Chat with <?=$sitename?>.</h1>
      </div>
      
      
      <div class="row">
        
        <div class="span6">
        <div class="hero-unit">
          <h2>Chat with <?=$sitename?>.</h2>
           <p>You can start an anonymous thread with <?=$sitename?> by filling in the form on the right.</p>
          <h2>Already have a thread?</h2>
           <p>You will need both your auth key and thread ID to view a thread.</p>
          <p><a class="btn" href="thread.php">View a thread &raquo;</a></p>
          </div> <!-- /hero-unit -->
        </div> <!-- /span6 -->
        
        <div class="span6">
        <center>
        <div class="well">
<?php if($post xor $authkey) { ?>
<div class="alert alert-error">
<button class="close" data-dismiss="alert">&times;</button>
<p>Both fields must be filled in!</p>
</div>
<?php } if ($authkey && $post) {
if($error == TRUE) {
?>
<div class="alert alert-error">
<button class="close" data-dismiss="alert">&times;</button>
<p>An internal error has occurred, please try submitting later.</p>
</div>
<?
} else { ?>
<div class="alert alert-success">
Your thread has been created:
Your thread ID is: <b><a href="thread.php?id=<?=$id?>"><?=$id?></a> <br /></b>
To access your thread, you must enter in your auth key (<b><?=$authkey?></b>). Note your auth key has now been hashed and is in a non-human readable format.
Please <b>ensure you have recorded both pieces of data</b>, you will not be able to read your thread without them!
</div>
<? }

 } else if (!($authkey && $post)) {?>
<h2>Create a new thread:</h2>
<form name="input" action="new.php" method="post">
<h3><a rel="tooltip" title="Your auth key is used later to access your thread. Make it strong, yet memorable." id="authkeytooltip">Auth Key</a>:</h3>
<input type="password" name="authkey" class="input-xlarge"/>
<br />
<h3><a rel="tooltip" title="Your message goes here..." id="posttooltip">Post</a>:</h3>
<textarea name="post" rows="5" cols="20" class="input-xlarge">
<?=$post ?>
</textarea>
<br />
<input type="submit" value="Submit" />
</form>
<?php } ?>
        </div> <!-- /well -->
          </center>
        </div> <!-- /span 6 -->
        
      </div>
      
      <hr>

<?php include('includes/footer.php'); ?>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./bootstrap/js/jquery.js"></script>
    <script src="./bootstrap/js/bootstrap-transition.js"></script>
    <script src="./bootstrap/js/bootstrap-alert.js"></script>
    <script src="./bootstrap/js/bootstrap-modal.js"></script>
    <script src="./bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="./bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="./bootstrap/js/bootstrap-tab.js"></script>
    <script src="./bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="./bootstrap/js/bootstrap-popover.js"></script>
    <script src="./bootstrap/js/bootstrap-button.js"></script>
    <script src="./bootstrap/js/bootstrap-collapse.js"></script>
    <script src="./bootstrap/js/bootstrap-carousel.js"></script>
    <script src="./bootstrap/js/bootstrap-typeahead.js"></script>

  </body>
</html>
