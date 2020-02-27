<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['product'];
$a = $_POST['qtybuy'];
$b = $_POST['qtyfree'];
$c = $_POST['reason'];

// query
$sql = "UPDATE products
        SET  promotionqty=?,
        promotion_number=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$b,$id));
//check whether reason for promotion exist
$result = $db->prepare("SELECT * FROM promotion where product_id=:a");
$result->bindParam(':a', $id);
$result->execute();
$rowcount = $result->rowcount();
if ($rowcount>=1) {
	$sql ="UPDATE promotion
        SET  reason=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($c,$id));
	# code...
}
if ($rowcount==0) {

	$sql = "INSERT INTO promotion (product_id,reason) VALUES (:a,:b)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$id,':b'=>$c));
	# code...
}
header("location: promotion.php");

?>