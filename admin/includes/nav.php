<?php
if(!defined('includeAllow')){die('Direct access not premitted');}
?>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.php"><?=$sitename?> Management Console</a>
          <div class="nav-collapse">
            <ul class="nav">
              <?php if($page == 'index.php') {?><li class="active"><?php } else {?><li><?php } ?><a href="index.php">Browser</a></li>
              <?php if($page == 'thread.php') {?><li class="active"><?php } else {?><li><?php } ?><a href="thread.php">View Thread</a></li>
              <?php if($page == 'pref.php') {?><li class="active"><?php } else {?><li><?php } ?><a href="pref.php">Preferences</a></li>
              <?php if($page == 'killsession.php') {?><li class="active"><?php } else {?><li><?php } ?><a href="../killsession.php">Log-out</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
