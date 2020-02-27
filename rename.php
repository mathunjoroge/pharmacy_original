<?php 
unlink('index.php');
rename('renew.php', 'index.php');
header ("location: index.php");
?>