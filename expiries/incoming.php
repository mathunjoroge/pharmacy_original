<?php
session_start();
include('../connect.php');
$a = $_POST['invoice'];
$b = $_POST['product'];
$batch = $_POST['batch'];
$b = $_POST['product'];
$c = $_POST['quantity'];
$d = $_POST['exp'];
$w = $_POST['pt'];
$disc = $_POST['pc'];
$date = $_POST['date'];
$asasa=$_POST['pr'] - ($_POST['pr'] * ($disc*0.01));
$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$p=$asasa-$row['o_price'];
$pp=$row['o_price'];
$bal = $row['qty'];
$balance = $bal-$c;
$amount=$c*$pp;
$deviation=$bal-$c;
//edit qty in batch
$sql = "UPDATE batch 
        SET quantity=quantity-?
		WHERE product_id=? AND batch_no=?";
		$q = $db->prepare($sql);
$q->execute(array($c,$b,$batch ));

//edit qty
$sql = "UPDATE products 
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($c,$b));
$profit=$p*$c;
$exp='expiry';

// query
$sql = "INSERT INTO expiries (invoice,product,qty,amount,date,batch,expdate) VALUES (:a,:b,:c,:d,:f,:h,:i)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$amount,':f'=>$date,':h'=>$batch,':i'=>$d));

// prepare for bincard
$sql = "INSERT INTO sales_order (balance) VALUES (:a)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$balance));

header("location: expiry.php?id=cash&invoice=$a");
}


?>
