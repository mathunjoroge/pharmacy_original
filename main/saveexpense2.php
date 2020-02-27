<?php
session_start();
include('../connect.php');
$a = $_POST['dt'];
$b = $_POST['exp'];
$c = $_POST['amt'];
$d = $_SESSION['SESS_FIRST_NAME'];



// query
$sql = "INSERT INTO expenses (date,name,amount,recorded) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d));
header("location: expenses2.php");


?>