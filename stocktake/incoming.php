<?php
session_start();
include('../connect.php');
$percent='0.01';
$m='1.33';

$a = $_POST['invoice'];
$b = $_POST['product'];
$c = $_POST['qty'];
$w = $_POST['pt'];
$bn=$_POST['batch'];
$qty=$_POST['quantity'];
$dev=$c-$qty;
$date = $_POST['date'];
$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$code=$row['product_code'];
$gen=$row['gen_name'];
$name=$row['product_name'];
$pid=$row['product_id'];
$orqtyy=$row['qty'];
$adjustedbal=$orqtyy+$dev;

$result = $db->prepare("SELECT * FROM batch WHERE product_id= :userid AND batch_no = :batch");
$result->bindParam(':userid', $b);
$result->bindParam(':batch', $bn);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$batchqty=$row['quantity'];
$devv=$batchqty-$qty;

//edit qty
$sql = "UPDATE products 
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($devv,$pid));


$st='stocktake';
$bl='';
// query
$sql = "INSERT deviation (date,product_id,batch_no,orqty,deviation) VALUES (:date,:pid,:bn,:b,:c)";
$q = $db->prepare($sql);
$q->execute(array(':date'=>$date,':pid'=>$pid,':bn'=>$bn,':b'=>$qty,':c'=>$dev));

// query
$sql = "INSERT INTO sales_order (invoice,product,quantity,amount,price,date,batch,balance,st) VALUES (:a,:b,:c,:d,:f,:k,:bt,:bal,:st)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$qty,':d'=>$bl,':f'=>$bl,':k'=>$date,
	':bt'=>$bn,':bal'=>$adjustedbal,':st'=>$st));

//update batch
$sql = "UPDATE batch 
        SET quantity=quantity-?
		WHERE batch_no=? AND product_id=? ";
$q = $db->prepare($sql);
$q->execute(array($dev,$bn,$pid));
header("location: stocktake.php?id=$w&invoice=$a");

?>
<?php }} ?>