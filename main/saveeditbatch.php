<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];
$batch=$_POST['batch'];
$g = $_POST['exp'];
$f = $_POST['qty'];
$prod = $_POST['prod'];
$myqt = $_POST['myqt'];
$diff =$f-$myqt;

// query

$sql = "UPDATE products 
			SET qty=qty+?
			WHERE product_id=?";
	$q = $db->prepare($sql);
	$q->execute(array($diff,$prod));
	//updating batch
	$sql = "UPDATE batch
			SET batch_no=?,expirydate=?,quantity=quantity+?
			WHERE id=?";
	$q = $db->prepare($sql);
	$q->execute(array($batch,$g,$diff,$id));
header("location: productbn.php");

?>
