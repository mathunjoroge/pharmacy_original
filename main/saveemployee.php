<?php
session_start();
include('../connect.php');
$a = $_POST['name'];
$b = $_POST['id'];
$c = $_POST['qua'];
$d = $_POST['role'];
$e = $_POST['sal'];
// query
$sql = "INSERT INTO employees (name,idno,qualifications,role,amount) VALUES (:a,:b,:c,:d,:e)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e));
header("location: employees.php");
?>