<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];
$a = $_POST['a'];

// query
$sql = "UPDATE cat
        SET  name=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$id));
header("location: categories.php");

?>