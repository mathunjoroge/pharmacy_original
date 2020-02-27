<?php include('../connect.php');
				$result = $db->prepare("SELECT * FROM products ORDER BY qty DESC");
				$result->execute();
				$setter = $result->rowcount();
	{
		
		$id=$setter+1;
		 ?>

		<?php } ?>
		<?php
$Today = date('y:m:d',time());
                $new = date('d/m/Y', strtotime($Today));
                echo $new;
session_start();
include('../connect.php');
$a = $_POST['code'];
$c = $_POST['retail'];
$qty = $_POST['qty'];
$f = $_POST['o_price'];
$g = $c-$f;
$h = $_POST['gen']; 
$i = $_POST['exdate']; 
$j=$qty;
$k = $_POST['level'];   
$bn='entry batch';
$date=$new;
$maxr = $_POST['maxr'];
$wsp = $_POST['wholesale'];
$maxpricer =(100-$maxr)*0.01; //this is my fraction for retail
 //this is my fraction for retail 

// query
$sql = "INSERT INTO products (product_code,price,qty,o_price,profit,gen_name,instock,level,datep,maxdiscpr,wholesaleprice) VALUES (:a,:c,:e,:f,:g,:h,:j,:k,:m,:n,:o)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':c'=>$c,':e'=>$qty,':f'=>$f,':g'=>$g,':h'=>$h,':j'=>$j,':k'=>$k,':m'=>$date,':n'=>$maxr,':o'=>$wsp));
//add a product into batch table

$sql = "INSERT INTO batch (date,product_id,batch_no,expirydate,quantity) VALUES (:date,:pid,:bn,:edate,:c)";
$q = $db->prepare($sql);
$q->execute(array(':date'=>$date,':pid'=>$id,':bn'=>$bn,':edate'=>$i,':c'=>$qty));

header("location: products.php");
?>