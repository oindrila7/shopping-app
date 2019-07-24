<?php
session_start();
require("config.php");

if(isset($_COOKIE["password"]))
{

}
  
if(isset($_SESSION['SESS_LOGGEDIN'])) 
{
  header("Location: " . $config_basedir);
}

if(isset($_POST['submit']))
{
  $loginsql = "SELECT * FROM logins WHERE username = '" . $_POST['userBox']. "' AND password = '" . sha1($_POST['passBox']) . "'";
  $loginres = mysqli_query($db, $loginsql);
  $numrows = mysqli_num_rows($loginres);
  if($numrows == 1)
  {
    $loginrow = mysqli_fetch_assoc($loginres);

    if (isset($_POST['rememberMe'])) {
      setcookie("username", $loginrow['username'], time() + 3600);
      setcookie("password", $_POST['passBox'], time() + 3600);
    }

    $_SESSION['SESS_LOGGEDIN'] = 1;
    $_SESSION['SESS_USERNAME'] = $loginrow['username'];
    $_SESSION['SESS_USERID'] = $loginrow['customer_id'];
    $ordersql = "SELECT id FROM orders WHERE customer_id = " . $_SESSION['SESS_USERID'] . " AND status < 2";
    $orderres = mysqli_query($db, $ordersql);
    $orderrow = mysqli_fetch_assoc($orderres);
    $_SESSION['SESS_ORDERNUM'] = $orderrow['id'];
    header("Location: " . $config_basedir);
  }
  else
  {
    header("Location: http://" .$_SERVER['HTTP_HOST']. $_SERVER['SCRIPT_NAME'] . "?error=1");
  }
}

else
{
  require("header.php");
?>
<h1>Customer Login</h1>
<p>Please enter your username and password to log into the websites. If you do not have an account, you can get one for free by <a style="background-color: yellow" href="register.php">registering</a>. For admin login click <a style="background-color: green" href="adminLogin.php">here</a></p>
<p>
<?php
if(isset($_GET['error'])) {
echo "<strong>Incorrect username/password</strong>";
}
?>

<form name="login" onSubmit="return formValidation();" action="<?php $_SERVER['SCRIPT_NAME']; ?>" method="POST">
<table>
<tr>
<td>Username</td>
<td><input type="textbox" name="userBox" value="<?php if(isset($_COOKIE["username"])) {echo $_COOKIE["username"];} ?>">
</tr>
<tr>
<td>Password</td>
<td><input type="password" name="passBox" value="<?php if(isset($_COOKIE["password"])) {echo $_COOKIE["password"];} ?>">
</tr>
<tr>
<td></td>
<td> <input type="checkbox" name="rememberMe" value="1"> Remember Me</td>
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
