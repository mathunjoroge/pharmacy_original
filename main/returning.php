<?php
session_start();
include('../connect.php');
$percent='0.01';
$a = $_POST['invoice'];
$b = $_POST['product'];
$c = $_POST['qty'];
$w = $_POST['pt'];
$price=$_POST['price'];
$date1 = strtotime ($_POST['date']);
$date2 = date ('Y-m-d' , $date1);
$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$code=$row['product_code'];
$gen=$row['gen_name'];
$name=$row['product_name'];
$mn=$price*$c;
$pid=$row['product_id'];
$first=$row['o_price']*$row['qty']; //(qty1*price1)
$second=$mn;// (qty2*pric2)
$third=$c+$row['qty']; // qty1+qty2
$fourth=$first+$second;//(qty1*price1)+(qty2*pric2)
$fifth=$fourth/$third;

//(qty1*price1)+(qty2*pric2)/qty1+qty2
//edit qty
$sql = "UPDATE products 
        SET   qty=qty+?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($c,$b));
$fffffff=$asasa;
$d=$fffffff*$c;

// query
$sql = "INSERT INTO returns (invoice,product,qty,amount,date) VALUES (:a,:b,:c,:mn,:k)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':mn'=>$mn,':k'=>$date2));
header("location: returns.php?id=$w&invoice=$a");

?>
<?php } ?>