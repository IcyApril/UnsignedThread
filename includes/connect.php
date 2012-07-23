<?php
if(!defined('includeAllow')){die('Direct access not premitted');}
/* Database config */

$db_host		= 'localhost'; // In most cases you should leave this alone.
$db_user		= 'root'; // MySQL username.
$db_pass		= ''; // MySQL password.
$db_database	= 'unsignedthread'; // MySQL database name.

/* User config */

$installed = FALSE; // IMPORTANT: Change this to $installed = TRUE; after your first login to the managment console.

$sitename = 'My Site';
$auth_salt = 'y5:5/cWH~gf`I$ZP!mHU?JT[%O33@R?Rm,(N-^_!_AgwzNW2jMCCU,0-0ncJ_0-q%.YM@tyx<E'; // IMPORTANT - change this to a random string, random length, punctuation, letters and numbers. If this is changed after installed, old posts may not readable…

$initialadminusername = 'admin'; // CHANGE THESE VARIABLES TO YOUR INITIAL USERNAME
$initialadminpassword = 'admin'; // AND PASSWORD (after set-up I advise you comment these lines out!)

$deleteold = TRUE; //CHANGE TO FALSE TO DISABLE AUTO CLEAN-UPS

// OK! Were all done!

$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');

mysql_select_db($db_database,$link);
mysql_query("SET NAMES UTF8");
if ($deleteold == TRUE) {
mysql_query("DELETE FROM posts WHERE dt < DATE_SUB(NOW(), INTERVAL 6 MONTH)");
mysql_query("DELETE FROM replies WHERE dt < DATE_SUB(NOW(), INTERVAL 6 MONTH)");
}
if ($installed == FALSE) {
  $sql0 = "CREATE TABLE IF NOT EXISTS `admins` (\n"
. "`id` int(11) NOT NULL AUTO_INCREMENT,\n"
. "`user` varchar(250) NOT NULL,\n"
. "`password` varchar(128) NOT NULL,\n"
. "PRIMARY KEY (`id`),\n"
. "UNIQUE KEY `user` (`user`)\n"
. ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;\n\n";

  $sql1 = "CREATE TABLE IF NOT EXISTS `posts` (\n"
. "`id` int(11) NOT NULL AUTO_INCREMENT,\n"
. "`auth` varchar(128) NOT NULL,\n"
. "`post` text NOT NULL,\n"
. "`status` varchar(255) NOT NULL DEFAULT '0',\n"
. "`dt` datetime NOT NULL,\n"
. "PRIMARY KEY (`id`)\n"
. ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;\n\n";

  $sql2 = "CREATE TABLE IF NOT EXISTS `replies` (\n"
. "`id` int(11) NOT NULL AUTO_INCREMENT,\n"
. "`pid` int(11) NOT NULL,\n"
. "`role` varchar(255) NOT NULL,\n"
. "`dt` datetime NOT NULL,\n"
. "`post` text NOT NULL,\n"
. "PRIMARY KEY (`id`)\n"
. ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;\n";

    mysql_query($sql0);
    mysql_query($sql1);
    mysql_query($sql2);
$hashedinitialadminpassword =  hash('sha512', $initialadminpassword.$auth_salt);
$sql = "INSERT IGNORE INTO `admins` (`id`, `user`, `password`) VALUES (1, '$initialadminusername', '$hashedinitialadminpassword');";
    mysql_query($sql) or die(mysql_error());
   }