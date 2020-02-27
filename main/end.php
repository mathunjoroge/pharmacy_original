<?php
	include('../connect.php');
	$id=$_GET['product_id'];
	$result = $db->prepare("DELETE FROM promotion WHERE product_id= :id");
	$result->bindParam(':id', $id);
	$result->execute();
	//end promotion
	$a=0;	
	$sql = "UPDATE products
        SET  promotionqty=?,
        promotion_number=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$a,$id));
header("location: promotion.php");
?>