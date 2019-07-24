<?php
session_start();
require("config.php");
if(isset($_SESSION['SESS_ADMINLOGGEDIN'])) {
header("Location: " . $config_basedir."adminorders.php");
}
if(isset($_POST['submit']))
{
$loginsql = "SELECT * FROM admin WHERE username = '" . $_POST['userBox'] . "' AND password = '" . $_POST['passBox'] . "'";
$loginres = mysqli_query($db, $loginsql) or die(mysqli_error($db));
$numrows = mysqli_num_rows($loginres);
if($numrows == 1)
{
$loginrow = mysqli_fetch_assoc($loginres);
$_SESSION['SESS_ADMINLOGGEDIN'] = 1;
header("Location: " . $config_basedir . "adminorders.php");
}
else
{
header("Location: " . $config_basedir . "adminlogin.php?error=1");
}
}
else
{
require("header.php");
echo "<h1>Admin Login</h1>";
if(@$_GET['error'] == 1) {
echo "<strong>Incorrect username/password!</strong>";
}
?>
<p>
<form name="login" onSubmit="return formValidation();" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">
<table>
<tr>
<td>Username</td>
<td><input type="textbox" name="userBox">
</tr>
<tr>
<td>Password</td>
<td><input type="password" name="passBox">
</tr>
<tr>
<td></td>
<td><input type="submit" name="submit" value="Log in">
</tr>
</table>
</form>
<script src="./js/login-validation.js"></script>
<?php
}
require("footer.php");
?>
