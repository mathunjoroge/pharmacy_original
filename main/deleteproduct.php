<?php
	include('../connect.php');
	$id=$_GET['id'];
	$sql = "UPDATE products
        SET  active=0
		WHERE product_id=$id";

?>