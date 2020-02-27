<?php
session_start();
include('../connect.php');
$a = $_POST['invoice'];
$b = $_POST['cashier'];
$c = $_POST['date'];
$d = $_POST['ptype'];
$e = $_POST['amount'];
$z = $_POST['profit'];
$cname = $_POST['cname'];
$h = $_POST['opdno'];
if($d=='credit') {
$f = $_POST['due_date'];
$Today = date('y:m:d',mktime());
$new = date('l, F d, Y', strtotime($Today));
$f ="";
$sql = "INSERT INTO sales (invoice_number,cashier,date,type,amount,profit,due_date,name,opdno) VALUES (:a,:b,:c,:d,:e,:z,:f,:g,:h)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':z'=>$z,':f'=>$f,':g'=>$cname,':h'=>$h));
header("location: preview.php?invoice=$a");
exit();
}
if($d=='credit') {
$f = $_POST['credit'];
$sql = "INSERT INTO sales (invoice_number,cashier,date,type,amount,profit,due_date,name,opdno) VALUES (:a,:b,:c,:d,:e,:z,:f,:g,:h)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':z'=>$z,':f'=>$f,':g'=>$cname,':h'=>$h));
header("location: preview.php?invoice=$a");
exit();
}
// query



?>