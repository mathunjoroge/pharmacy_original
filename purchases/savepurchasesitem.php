<?php
session_start();
include('../connect.php');
$a = $_POST['invoice'];
$b = $_POST['product'];
$c = $_POST['qty'];
$cc = $_POST['cost'];

$dt =$_POST['date'];

$result = $db->prepare("SELECT * FROM products WHERE product_code= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

}
//edit qty in purchases item


//edit qty
$sql = "UPDATE products 
        SET qty=qty+?
		WHERE product_code=?";
$q = $db->prepare($sql);
$q->execute(array($c,$b));
$sql = "UPDATE purchases 
        SET cost=cost+?
		WHERE invoice_number=?";

header("location:  sales.php?id=cash&invoice=$a");
?>