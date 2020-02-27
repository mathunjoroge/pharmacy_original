<?php
session_start(); 
include('../connect.php');
    $a = $_POST['name'];
$b = $_POST['address'];
$c= $_POST['telephone'];
$d = $_POST['slogan'];   
$sql = "UPDATE settings
        SET  name=?,
             address=?,
             phone=?,
             slogan=?";
$q = $db->prepare($sql);
$q->execute(array($a,$b,$c,$d)); 
header("location: index.php?");
 ?>
 