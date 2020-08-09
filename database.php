<?php

$host="localhost";
$root="root"; 
$root_password="";
$database="pharmacy"; 

    try {
        $db = new PDO("mysql:host=$host", $root, $root_password);

        $db->exec("CREATE DATABASE `$database`;
                CREATE USER '$root'@'localhost' IDENTIFIED BY '$root_password';
                GRANT ALL ON `$database`.* TO '$root'@'localhost';
                FLUSH PRIVILEGES;") 
        or die(print_r($db->errorInfo(), true));

    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }
$conn = new mysqli($host, $root, $root_password, $database);
$filename = 'pharmacy_db.sql'; 
$op_data = '';
$lines = file($filename);
foreach ($lines as $line)
{
    if (substr($line, 0, 2) == '--' || $line == '')//This IF Remove Comment Inside SQL FILE
    {
        continue;
    }
    $op_data .= $line;
    if (substr(trim($line), -1, 1) == ';')//Breack Line Upto ';' NEW QUERY
    {
        $conn->query($op_data);
        $op_data = '';
    }
}
echo "Tables Created Inside " . $database . " Database.......";
header("location: index.php");
?>
