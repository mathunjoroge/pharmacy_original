<?php
	include('../connect.php');
	$id=$_GET['trans_id'];
	$a=$_GET['invoice'];
	$c=$_GET['qty'];
	$d=$_GET['prod_id'];
		
	//edit qty in products table
	$sql = "UPDATE products 
			SET qty=qty+?
			WHERE product_id=?";
	$q = $db->prepare($sql);
	$q->execute(array($c,$d));
	//update balance for bincard
	$reset= 0;
	$cash= 'cash';
	$sql = "UPDATE sales_order
        SET quantity=?, amount=?, balance=balance+?,  price=?, profit=?,discount=? WHERE transaction_id=?";
$q = $db->prepare($sql);
$q->execute(array($reset,$reset,$c,$reset,$reset,$reset,$id));
	header("location: sales.php?id=$cash&invoice=$a"); 
?>
 