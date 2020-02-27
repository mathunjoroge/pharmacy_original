<?php
session_start();
include('../connect.php');
$a = $_POST['invoice'];
$b = $_POST['product'];
$batch = $_POST['batch'];
$c = $_POST['quantity'];
$w = $_POST['pt'];
$disc = $_POST['pc'];
$date = $_POST['date'];
$totaldisc=$_POST['pr']*$disc*0.01;
$price=$_POST['pr']-$totaldisc;
$result = $db->prepare("SELECT * FROM products WHERE product_id=:product_id");
$result->bindParam(':product_id', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$p=$price-$row['o_price'];
$bal = $row['qty'];
$pid=$row['product_id'];
$m =$_SESSION['SESS_FIRST_NAME'];
$balance = $bal-$c;
}
//edit qty in batch
/*$sql = "UPDATE batch 
        SET quantity=quantity-?
		WHERE product_id=? AND batch_no=?";
		$q = $db->prepare($sql);
$q->execute(array($c,$b,$batch )); */

//edit qty
$sql = "UPDATE products 
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($c,$b));

$amount=$price*$c;
$profit=$p*$c;
// query
$sql = "INSERT INTO sales_order (invoice,product,quantity,amount,price,profit,discount,balance) VALUES (:a,:b,:c,:d,:f,:h,:disc,:bal)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$amount,':f'=>$price,':h'=>$profit,':disc'=>$disc,':bal'=>$balance));
header("location: sales.php?id=cash&invoice=$a");


?>
