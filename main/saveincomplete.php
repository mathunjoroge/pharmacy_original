<?php
session_start();
include('../connect.php');
$a = $_POST['invoice'];
$f = $_POST['cash'];
$g = $_POST['reset'];
$sql = "UPDATE sales
        SET cashtendered=cashtendered+?, paid=? WHERE invoice_number=?";
$q = $db->prepare($sql);
$q->execute(array($f,$g,$a));
header("location: incomplete.php");
exit();

// query



?>
