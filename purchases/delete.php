<?php
	include('../connect.php');
	$id=$_GET['id'];
	$c=$_GET['qty'];
	$d=$_GET['code'];
	$e=$_GET['invoice'];	
$sql = "UPDATE products 
			SET qty=qty-?
			WHERE product_id=?";
	$q = $db->prepare($sql);
	$q->execute(array($c,$d));
	//update balance for bincard
	$result = $db->prepare("DELETE FROM pending WHERE transaction_id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
	header("location: purchase.php?id=cash&invoice=$d"); 
?>