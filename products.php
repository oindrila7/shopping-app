<?php
require("config.php");
require("functions.php");
require("header.php");
$prodcatsql = "SELECT * FROM products WHERE cat_id = " . $_GET['id'] . ";";
$prodcatres = mysqli_query($db, $prodcatsql);
$numrows = mysqli_num_rows($prodcatres);
if($numrows == 0)
{
echo "<h1>No products</h1>";
echo "There are no products in this category.";
}
else
{
echo "<table cellpadding='10'>";
while($prodrow = mysqli_fetch_assoc($prodcatres))
{
echo "<tr>";
if(empty($prodrow['image'])) {
echo "<td><img
src='./productimages/dummy.jpg' alt='". $prodrow['name'] . "'></td>";
}
else {
echo "<td><img src='./productimages/" . $prodrow['image']. "' alt='". $prodrow['name'] . "'></td>";
}
echo "<td>";
echo "<h2>" . $prodrow['name'] . "</h2>";
echo "<p>" . $prodrow['description'];
echo "<p><strong>OUR PRICE: &pound;". sprintf('%.2f', $prodrow['price']) . "</strong>";
echo "<p>[<a href='addtobasket.php?id=". $prodrow['id'] . "'>buy</a>]";
echo "</td>";
echo "</tr>";
}
echo "</table>";
}
require("footer.php");
?>
