<?php
// configuration
include('../connect.php');

// new data

$a = $_POST['a'];
$first=$a/2;
$second=$first/100;
$last=1-$second;

// query
$sql = "UPDATE products
        SET  maxdiscws=?, maxdiscwsp=?";

$q = $db->prepare($sql);
$q->execute(array($last,$first));
header("location: wholesale.php");

?>