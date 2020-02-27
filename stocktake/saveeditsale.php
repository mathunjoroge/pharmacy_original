<?php
// configuration
include('../connect.php');

// new data
$a = $_POST['qty'];
$c=$_POST['pc'];
$b=$a*$row['price'] - ($row['price'] * ($c / 100));


$id = $_POST['memi'];
$result = $db->prepare("SELECT * FROM sales_order WHERE product_id= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$asasa=$row['price'] - ($row['price'] * ($mn / 100));
$id=$row['product_code']


// query
$sql = "UPDATE sales_order
        SET  qty=?, amount=?, discount=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$b,$b,$c));
header("editsale.php?id=$id");

?><?php }?>