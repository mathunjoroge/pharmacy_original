<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];
$a = $_POST['code'];
$z = $_POST['gen'];
$g = $_POST['o_price'];
$j = $_POST['sold'];
$k = $_POST['price'];
$m = $_POST['level'];
$qtyl = $_POST['qtyl'];
$l = $_POST['wholesaleprice'];
$maxr = $_POST['maxr'];
$maxws = $_POST['maxws']/2;
$maxpricer =(100-$maxr)*0.01; //this is my fraction for retail
$maxpricews =(100-$maxws)*0.01;
// query
$sql = "UPDATE products 
        SET product_code=?,gen_name=?,o_price=?,price=?,wholesaleprice=?,level=?,maxdiscre=?,qty=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$z,$g,$k,$l,$m,$maxr,$qtyl,$id));
header("location: products.php?");

?>
