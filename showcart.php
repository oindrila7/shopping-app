<?php
	session_start();
	require('config.php');
	require("header.php");
	require("functions.php");
	echo "<h1>Your shopping cart</h1>";
	showcart();
	if(isset($_SESSION['SESS_ORDERNUM'])) {
		$sess_ordernum=$_SESSION['SESS_ORDERNUM'];
		$sql = "SELECT * FROM orderitems WHERE order_id =$sess_ordernum";
		$result = mysqli_query($db, $sql) or die(mysqli_error($db));
		$numrows = mysqli_num_rows($result);
	}
	require("footer.php");
?>
