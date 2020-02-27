<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("DELETE FROM user WHERE id= :id");
	$result->bindParam(':id', $id);
	$result->execute();
?>