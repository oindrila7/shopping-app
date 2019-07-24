<?php
session_start();
require("config.php");
require("functions.php");

if(isset($_POST['chequesubmit']))
{
  if(empty($_POST['traxId']))
  {
    header("Location: " . $basedir . "checkout-pay.php?error=1");
    exit;
  }
  else{
    $upsql = "UPDATE orders SET status = 2,payment_type = 2, transaction_id = '" . $_POST['traxId'] . "' WHERE id = ". $_SESSION['SESS_ORDERNUM'];
    $upres = mysqli_query($db, $upsql);

    if(isset($_SESSION['SESS_LOGGEDIN']))
    {
      unset($_SESSION['SESS_ORDERNUM']);
    }
    else
    {
      $_SESSION['SESS_CHANGEID'] = 1;
    }
    require("header.php");
    ?>
    <h1>Payed by bKash</h1>
    <p>Transaction Id: <?php echo $_POST['traxId'] ?></p>

    <?php
  }
}
else
{
  require("header.php");
  echo "<h1>Payment</h1>";
  showcart();
?>





<h2>Select a payment method</h2>

<?php
if(isset($_GET['error'])) {
  echo "<div><strong>TraxId Must Be Given</strong></div>";
}
?>

<form action='checkout-pay.php' method='POST'>
<table cellspacing=10>
<tr>
<td><h3>bKash</h3></td>
<td>
If you would like to pay by bKash, you can send the final amount to our number: 
</td>
<td>016XXXXXXXX</td>
</tr>
<tr>
<td>Please Provide Your Transaction Id: </td>
<td>
<input type="text" name="traxId">
</td>
<td><input type="submit" name="chequesubmit" value="Pay by bKash"></td>
</tr>
</table>
</form>
<?php
}
require("footer.php");
?>
