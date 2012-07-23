<?php

/*

UsignedThread, an IcyApril creation.

Licence: Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported (CC BY-NC-SA 3.0)
Licence URL: https://creativecommons.org/licenses/by-nc-sa/3.0/
License Legal: https://creativecommons.org/licenses/by-nc-sa/3.0/legalcode

Searching for a moment like this.
Raised with your act as a guidance.
Lead by your words and your lies. I cannot take it.

Searching for a moment like this.
Raised with your act as a guidance. I cannot take it.
*/

define('includeAllow', TRUE);
$page = 'index.php';
include('includes/connect.php');
include('includes/functions.php');
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
      <script src="./bootstrap/js/html5.js"></script>
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
        <h1>Welcome to <?=$sitename?>!</h1>
        <p>To get in contact with us, just create a thread.</p>
        <p><a class="btn btn-primary btn-large" href="new.php">Make a thread &raquo;</a></p>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="span12">
        <center>
          <h2>Already have a thread?</h2>
           <p>You will need both your auth key and thread ID to view a thread.</p>
          <p><a class="btn" href="thread.php">View a thread &raquo;</a></p>
          </center>
           <hr />
        </div>
        <div class="span12">
        <center>
          <h2>What is a thread?</h2>
           <p>A thread is a secure communication channel for a anonymous "guest" to communicate with a "host" who runs the installation of the tool.</p>
          </center>
           <hr />
        </div>
      </div>
        <div class="span12">
        <center>
          <h2>When are threads used?</h2>
           <p>Threads can be used for any reason, from receiving support to communicating sensitive material to a news organisations.</p>
          </center>
           <hr />
        </div>
        <div class="span12">
        <center>
          <h2>How can I secure my thread communication?</h2>
           <p>Some basic measures include <a href="https://torproject.org">Tor</a>, ensuring that the URL starts with HTTPS as opposed to HTTP. Note that UnsignedThread does not magically secure all your communications, it is only as secure as both the host running the service and the guest using the service wants it to be.</p>
          </center>
           <hr />
        </div>
        <div class="span12">
        <center>
          <h2>Some last words...</h2>
           <p> Think seriously in dangerous situations, and only talk talk about serious matters with organisations and people you trust.</p>
          </center>
        </div>
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
