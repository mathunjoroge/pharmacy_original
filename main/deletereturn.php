<?php
	include('../connect.php');
	$id=$_GET['id'];
	$product_id=$_GET['product_id'];
	$qty=$_GET['qty'];
	$invoice=$_GET['invoice'];
	//edit batch
	$sql = "UPDATE products
			SET qty=qty-?
			WHERE product_id=?";
	$q = $db->prepare($sql);
	$q->execute(array($qty,$product_id));
	//delete entry
	$result = $db->prepare("DELETE FROM returns WHERE transaction_id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
	header("location: returns.php?id=cash&invoice=$invoice")
?>