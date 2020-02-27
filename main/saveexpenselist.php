<?php
session_start();
include('../connect.php');

$a = $_POST['name'];
$b = $_POST['dt'];

$c= $_SESSION['SESS_FIRST_NAME'];



// query
$sql = "INSERT INTO expenselist (name,date,addedby) VALUES (:a,:b,:c)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c));
header("location: explist.php");


?>