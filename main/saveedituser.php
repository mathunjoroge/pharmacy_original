<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];
$a = $_POST['a'];
$pass = md5($_POST['b']);
$b = md5($pass);
$c = $_POST['c'];
$d = $_POST['d'];
$e = $_POST['e'];
$f = $_POST['f'];
$g = $_POST['g'];
// query
$sql = "UPDATE user 
        SET username=?, password=?, contact=?, name=?, position=?, idno=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$b,$c,$a,$e,$f,$id));
header("location: user.php");

?>