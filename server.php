<?php
require('config.php');

if(isset($_REQUEST["uname"])){
	$sql="select * from logins where username='".$_REQUEST["uname"]."'";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	$numrows = mysqli_num_rows($result);
	if ($numrows > 0) {
		echo "Username already taken!";
	}
}
?>