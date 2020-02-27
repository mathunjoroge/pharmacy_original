<?php
session_start();
include('../connect.php');
$a = $_POST['name'];
$b = $_POST['address'];
$c= $_POST['telephone'];
$d = $_POST['slogan'];

$sql = "INSERT INTO settings (name,address,phone,slogan) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d));
header("location: index.php?"); 
?>

