<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];
$inv = $_POST['invoice'];
$f = $_POST['qty'];
$g = $_POST['price'];
$prod = $_POST['prod'];
$myqt = $_POST['myqt'];
$diff =$f-$myqt;
$p=$f*$g;


// query
$sql = "UPDATE returns
        SET qty=?, amount=?,price=?  WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($f,$p,$g,$id));

$sql = "UPDATE products 
			SET qty=qty+?
			WHERE product_id=?";
	$q = $db->prepare($sql);
	$q->execute(array($diff,$prod));

header("location: returns.php?id=cash&invoice=$inv");

?>
