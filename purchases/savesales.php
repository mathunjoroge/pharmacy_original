<?php
session_start();
include('../connect.php');
$a = $_POST['invoice'];
$b = $_POST['cashier'];
$c = $_POST['date'];
$d = $_POST['ptype'];
$e = $_POST['amount'];

$cname = $_POST['supp'];
$h = $_POST['invoicesup'];




$sql = "INSERT INTO purchases2 (invoice_number,cashier,date,type,amount,name,invoicesupp) VALUES (:a,:b,:c,:d,:e,:g,:h)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':g'=>$cname,':h'=>$h));
header("location: preview.php?invoice=$a");

// query



?>