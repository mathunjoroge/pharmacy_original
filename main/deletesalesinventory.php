<?php
	include('../connect.php');
	$id=$_GET['id'];
	$qty=$_GET['qty'];
	$batch=$_GET['batch'];
	$prod=$_GET['prod_id'];
	//update batch table
	$sql = "UPDATE batch
			SET quantity=quantity+?
			WHERE product_id=? AND batch_no=?";
	$q = $db->prepare($sql);
	$q->execute(array($qty,$prod,$batch));
//update products table
	$sql = "UPDATE products 
        SET qty=qty+?
		WHERE product_id=?";
		$q = $db->prepare($sql);
	$q->execute(array($qty,$prod));

	//update sales order table table
	$result = $db->prepare("DELETE FROM sales_order WHERE transaction_id= :id");
	$result->bindParam(':id', $id);
	$result->execute();
		header("location: sales_inventory.php");
?>