<?php
// configuration
include('../connect.php');

// new data

$a = $_POST['a'];
$first=$a;
$second=$first/100;
$last=1-$first;

// query
$sql = "UPDATE products
        SET  maxdiscre=?, maxdiscpr=?";

$q = $db->prepare($sql);
$q->execute(array($last,$first));
header("location: retail.php");

?>