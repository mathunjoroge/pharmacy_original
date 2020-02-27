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
$sql = "UPDATE sales_order
        SET quantity=?, amount=?, balance=balance+? WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($f,$p,$diff,$id));

$sql = "UPDATE products 
			SET qty=qty-?
			WHERE product_id=?";
	$q = $db->prepare($sql);
	$q->execute(array($diff,$prod));
	//updating batch
	$sql = "UPDATE batch
			SET quantity=quantity-?
			WHERE product_id=? AND batch_no=?";
	$q = $db->prepare($sql);
	$q->execute(array($diff,$prod,$batch));

	//update deviation table
	$sql = "UPDATE deviation
			SET orqty=orqty-?,deviation=deviation-?
			WHERE product_id=? AND batch_no=?";
	$q = $db->prepare($sql);
	$q->execute(array($diff,$prod,$prod,$batch));
header("location: stocktake.php?id=cash&invoice=$inv");

?>
