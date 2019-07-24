<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbdatabase = "shopping";
$config_basedir = "http://localhost/shopping/";
$config_sitename = "Shopping App";
$db = mysqli_connect($dbhost, $dbuser, $dbpassword) or die(mysqli_error($db));
mysqli_select_db($db, $dbdatabase) or die(mysqli_error($db));
?>
