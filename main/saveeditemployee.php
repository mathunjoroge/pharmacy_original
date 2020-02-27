<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['id'];
$a = $_POST['a'];
$b = $_POST['b'];
$c = $_POST['c'];
$d = $_POST['d'];
$e = $_POST['e'];


// query
$sql = "UPDATE employees 
        SET name=?, idno=?, qualifications=?, role=?, amount=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$b,$c,$d,$e,$id));
header("location: employees.php");

?>