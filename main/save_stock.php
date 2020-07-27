<?php
include('../connect.php');
session_start();
$a = $_POST['drug_id']; 
$b = $_POST['qty'];
$c = $_POST['new_qty'];
// 
foreach (array_keys($a) as $key) {
    $final_qty = $c[$key];
    $initial_qty = $b[$key];
    $drug_id = $a[$key];

   $sql = "INSERT INTO stock_take (initial_qty,final_qty,drug_id) VALUES ('$final_qty', '$final_qty', $drug_id)";
   $q = $db->prepare($sql);
$q->execute();
//update products table with new qtys
$sql = "UPDATE products
        SET  instock=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($final_qty,$drug_id));
}
header("location:stocktake.php");
?>