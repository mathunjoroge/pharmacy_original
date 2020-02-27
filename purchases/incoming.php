<?php
session_start();
include('../connect.php');
$percent='0.01';
$mn=$_POST['cost'];
$a = $_POST['invoice'];
$b = $_POST['product'];
$c = $_POST['qty'];
$w = $_POST['pt'];
$date1 = strtotime ($_POST['date']);
$date2 = date ('Y-m-d' , $date1);
$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$asasa=$mn/$c;
$code=$row['product_code'];
$gen=$row['gen_name'];
$name=$row['product_name'];
$pid=$row['product_id'];
$first=$row['o_price']*$row['qty']; //(qty1*price1)
$second=$mn;// (qty2*pric2)
$third=$c+$row['qty']; // qty1+qty2
$fourth=$first+$second;//(qty1*price1)+(qty2*pric2)
$fifth=$fourth/$third;

//(qty1*price1)+(qty2*pric2)/qty1+qty2
//edit qty
$sql = "UPDATE products 
        SET  o_price=?, qty=qty+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($fifth,$c,$b));
$fffffff=$asasa;
$d=$fffffff*$c;
// query
/*$sql = "INSERT INTO batch (date,product_id,batch_no,expirydate,quantity) VALUES (:date,:pid,:bn,:edate,:c)";
$q = $db->prepare($sql);
$q->execute(array(':date'=>$date2,':pid'=>$pid,':bn'=>$bn,':edate'=>$d11,':c'=>$c)); */

// query
$sql = "INSERT INTO pending (invoice,product,qty,price,amount,date) VALUES (:a,:b,:c,:f,:mn,:k)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':f'=>$asasa,':mn'=>$mn,':k'=>$date2));
header("location: purchase.php?id=$w&invoice=$a");

?>
<?php } ?>