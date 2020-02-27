<?php
	include('../connect.php');
	$id=$_GET['trans_id'];
	$a=$_GET['invoice'];
	$qty=$_GET['qty'];
	$product_id=$_GET['prod_id'];
	$b=1;
	//edit qty in products table
	$sql = "UPDATE products 
			SET qty=qty+?
			WHERE product_id=?";
	$q = $db->prepare($sql);
	$q->execute(array($qty,$product_id));
	// delete the transaction
	$result = $db->prepare("DELETE FROM sales_order WHERE transaction_id= :transaction_id");
	$result->bindParam(':transaction_id', $id);
	$result->execute();
	//select total bonus
	$result = $db->prepare("SELECT sum(quantity) AS quantity FROM sales_order WHERE invoice= :a AND has_bonus=:b AND product=:c");
	$result->bindParam(':a', $a);
	$result->bindParam(':b', $b);
	$result->bindParam(':c', $product_id);
	$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
	$totalqty = $row['quantity'];
	$sql = "UPDATE products 
			SET qty=qty+?
			WHERE product_id=?";
	$q = $db->prepare($sql);
	$q->execute(array($totalqty,$product_id)); 
}
    $result = $db->prepare("DELETE FROM sales_order WHERE invoice= :a AND has_bonus=:b AND product=:c");
	$result->bindParam(':a', $a);
	$result->bindParam(':b', $b);
	$result->bindParam(':c', $product_id);
	$result->execute();


	header("location: sales.php?id=$sdsd&invoice=$a"); 
?>