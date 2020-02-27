<?php
session_start();
include('../connect.php');
$a = $_POST['invoice'];
$b = $_POST['cashier'];
$c = $d11;
$d = $_POST['ptype'];
$e = $_POST['amount'];
$z = $_POST['profit'];
$xx = $_POST['reset'];
if($d=='credit') {
$f = $_POST['due'];

$sql = "INSERT INTO sales (invoice_number,cashier,type,amount,profit,due_date,paid) VALUES (:a,:b,:d,:e,:z,:f,:xx)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':d'=>$d,':e'=>$e,':z'=>$z,':f'=>$f,':xx'=>$xx));
header("location: preview.php?invoice=$a");
exit();
}
if($d=='cash') {
$f = $_POST['cash'];
$sql = "INSERT INTO sales (invoice_number,cashier,type,amount,profit,cashtendered,paid) VALUES (:a,:b,:d,:e,:z,:f,:xx)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':d'=>$d,':e'=>$e,':z'=>$z,':f'=>$f,':xx'=>$xx));
$rest=1;
$sql = "UPDATE sales_order 
        SET rest=?
		WHERE invoice=?";
$q = $db->prepare($sql);
$q->execute(array($rest,$a));
header("location: preview.php?invoice=$a");
exit();
}
// query



?>
