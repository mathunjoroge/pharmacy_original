<?php
	$Today = date('m/d/Y',time());
	$new = date('m/d/Y', strtotime($Today));
	
	?>
	<?php
session_start();
include('../connect.php');
$a = $_POST['invoice'];
$b = $_POST['cashier'];
$c = $new;
$d = $_POST['ptype'];
$e = $_POST['amount'];
$z = $_POST['profit'];
$cname = $_POST['cname'];
$xx = $_POST['reset'];
$xxx = $_POST['cash'];
if ($d =="credit") {
	# code...
}

$sql = "INSERT INTO sales (invoice_number,cashier,date,type,amount,profit,name,cashtendered,paid) VALUES (:a,:b,:c,:d,:e,:z,:cname,:xxx,:xx)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':z'=>$z,':cname'=>$cname,':xxx'=>$xxx,':xx'=>$xx));
header("location: preview.php?invoice=$a&ptype=$d");


if ($d=="cash") {
	header("location: makepay.php?invoice=$a&cname=$cname&cashier=$b&profit=$z&amount=$e&ptype=$d");
	# code...
}

// query



?>
