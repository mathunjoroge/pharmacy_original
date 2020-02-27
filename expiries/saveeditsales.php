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
$diff =$myqt-$f;
$batch=$_POST['batch'];
$p=$f*$g;

// query
$sql = "UPDATE expiries
        SET qty=?, amount=? WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($f,$p,$id));

$sql = "UPDATE products 
			SET qty=qty+?
			WHERE product_id=?";
	$q = $db->prepare($sql);
	$q->execute(array($diff,$prod));
	//updating batch
	$sql = "UPDATE batch
			SET quantity=quantity+?
			WHERE product_id=? AND batch_no=?";
	$q = $db->prepare($sql);
	$q->execute(array($diff,$prod,$batch));
header("location: sales.php?id=cash&invoice=$inv");

?>
