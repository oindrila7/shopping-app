
<?php
session_start();
require("config.php");
if(isset($_SESSION['SESS_LOGGEDIN']) == TRUE) {

}

if(isset($_POST['submit']))
{
  if(empty($_POST['forenameBox']) ||
empty($_POST['surnameBox']) ||
empty($_POST['add1Box']) ||
empty($_POST['add2Box']) ||
empty($_POST['add3Box']) ||
empty($_POST['postcodeBox']) ||
empty($_POST['phoneBox']) ||
empty($_POST['emailBox']))
{
header("Location: " . $basedir . "register.php?error=1");
exit;
} else {
  $sql="select * from logins where username='".$_POST["userBox"]."'";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));
	$numrows = mysqli_num_rows($result);
  if ($numrows > 0) {
    header("Location: " . $basedir . "register.php?error=2");
    exit;
  } 
  else {
    $regsql = "INSERT INTO customers (`id`, `forname`, `surname`, `add1`, `add2`, `add3`, `postcode`, `phone`, `email`, `registered`)
    VALUES (NULL, '" . $_POST['forenameBox'] . "', '" . $_POST['surnameBox'] . "', '" . $_POST['add1Box'] . "', '" .  $_POST['add2Box'] . "', '" . $_POST['add3Box'] . "', '" . $_POST['postcodeBox'] . "', '" . $_POST['phoneBox'] . "', '" . $_POST['emailBox'] . "', '1')";
    mysqli_query($db, $regsql);

    $loginsql = "INSERT INTO `logins` (`id`, `customer_id`, `username`, `password`)
    VALUES (NULL, " . mysqli_insert_id($db) . ", '" . $_POST['userBox']. "', '" . sha1($_POST['passBox']) . "');";
    mysqli_query($db, $loginsql);
    header("Location: " . $config_basedir.'login.php');
  }
}
}

else {
require("header.php");
?>
<h1>Customer Registration</h1>
 
Please enter your username and password to Register into the websites. 
 
<?php
if(isset($_GET['error'])) {
  if ($_GET['error'] == 1) {
    echo "<div><strong>All fields must be filled</strong></div>";
  }
  else {
    echo "<div><strong>Username must be unique</strong></div>";
  }
}
?>
<form name="registration" onSubmit="return formValidation();" action="<?php $_SERVER['SCRIPT_NAME']; ?>" method="POST">
<table>
<tbody>
<tr>
<td>Username</td>
<td><input type="textbox" name="userBox" onkeyup="showHint()" /></td>
<td><span id="txtHint" style="border:1px solid red; visibility:hidden;"></span></td>
</tr>
<tr>
<td>Password</td>
<td><input type="password" name="passBox" /></td>
</tr>
<tr>
<td>First Name</td>
<td><input type="text" name="forenameBox"></td>
</tr>
<tr>
<td>Last Name</td>
<td><input type="text" name="surnameBox"></td>
</tr>
<tr>
<td>House Number, Street</td>
<td><input type="text" name="add1Box"></td>
</tr>
<tr>
<td>Town/City</td>
<td><input type="text" name="add2Box"></td>
</tr>
<tr>
<td>Country</td>
<td><input type="text" name="add3Box"></td>
</tr>
<tr>
<td>Postcode</td>
<td><input type="text" name="postcodeBox"></td>
</tr>
<tr>
<td>Phone</td>
<td><input type="text" name="phoneBox"></td>
</tr>
<tr>
<td>Email</td>
<td><input type="text" name="emailBox"></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="submit" value="Register" /></td>
</tr>
</tbody>
</table>
</form>
<script src="./js/reg-validation.js"></script>
 
<?php
}
require("footer.php");
?>