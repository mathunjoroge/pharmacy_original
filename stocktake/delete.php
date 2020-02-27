<?php
	include('../connect.php');
	$id=$_GET['id'];
	$c=$_GET['invoice'];
	$sdsd=$_GET['dle'];
	$wapak=$_GET['code'];
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM sales_order WHERE transaction_id= :userid");
	$result->bindParam(':userid', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){	
		$qt=$row['quantity'];
		$inv=$row['invoice'];
		$prod=$row['product'];	
		$batch=$row['batch'];
		

		// edit batch
		$sql = "UPDATE batch
			SET quantity=quantity-?
			WHERE product_id=? AND batch_no=?";
	$q = $db->prepare($sql);
	$q->execute(array($qt,$prod,$batch));

	//edit qty in products table
	$sql = "UPDATE products 
			SET qty=qty-?
			WHERE product_id=?";
	$q = $db->prepare($sql);
	$q->execute(array($qt,$wapak));
	//update balance for bincard
	$reset= '';
	$sql = "UPDATE sales_order
        SET quantity=?, amount=?, balance=balance-?,quantity=?, price=?, profit=?,discount=? WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($reset,$reset,$qt,$reset,$reset,$reset,$reset,$id));
//
$result->execute();
	header("location: stocktake.php?id=$sdsd&invoice=$c"); }
?>