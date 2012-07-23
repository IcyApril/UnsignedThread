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
          <a class="brand" href="index.php"><?=$sitename?></a>
          <div class="nav-collapse">
            <ul class="nav">
              <?php if($page == 'index.php') {?><li class="active"><?php } else {?><li><?php } ?><a href="index.php">Home</a></li>
              <?php if($page == 'new.php') {?><li class="active"><?php } else {?><li><?php } ?><a href="new.php">Create a Thread</a></li>
              <?php if($page == 'thread.php') {?><li class="active"><?php } else {?><li><?php } ?><a href="thread.php">View Thread</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
