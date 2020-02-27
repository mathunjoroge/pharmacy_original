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
$asasa=$_POST['pr'] - ($_POST['pr'] * ($disc*0.01));

$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$code=$row['product_code'];
$gen=$row['gen_name'];
$name=$row['product_name'];
$p=$asasa-$row['o_price'];
$negprofit=-$row['o_price'];
$bal = $row['qty'];
$pid=$row['product_id'];
$m =$_SESSION['SESS_FIRST_NAME'];
$balance = $bal-$c;
$promo=$row['promotionqty'];
$promoqty=$row['promotion_number'];
$multiplier=floor($c/$promo);

}



$sql = "UPDATE products 
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($c,$b));

$d=$asasa*$c;
$profit=$p*$c;
// query
$sql = "INSERT INTO sales_order (invoice,product,quantity,amount,price,profit,date,discount,batch,balance) VALUES (:a,:b,:c,:d,:f,:h,:k,:disc,:bt,:bal)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':f'=>$asasa,':h'=>$profit,':k'=>$date,':disc'=>$disc,':bt'=>$batch,':bal'=>$balance));
//find if bonus exists
$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
	$promo=$row['promotionqty'];
	$promo=$row['promotionqty'];
	$promoqty=$row['promotion_number'];
	$multiplier=floor($c/$promo);

}

if ($promo>0) {

	$bonus=$promoqty*$multiplier;
	$reset=1;
	$bonusprice=-$negprofit;
	$bonusamount=0;
	//post a bonus
	$sql = "INSERT INTO sales_order (invoice,product,quantity,amount,price,profit,date,discount,batch,balance,has_bonus) VALUES (:a,:b,:c,:d,:f,:h,:k,:disc,:bt,:bal,:bonus)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$bonus,':d'=>$bonusamount,':f'=>$bonusprice,':h'=>$negprofit,':k'=>$date,':disc'=>$disc,':bt'=>$batch,':bal'=>$balance,':bonus'=>$reset));
//update qty
$sql = "UPDATE products 
        SET qty=qty-?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($bonus,$b));

	# code...
}

header("location: sales.php?id=cash&invoice=$a");


?>
