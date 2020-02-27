<?php
session_start();
include('../connect.php');
$date = date('Y-m-d');
                $d11 = strtotime ( $date ) ;
                $d11 = date ('Y-m-d' , $d11);
                echo $d11;
$a = $d11;
$b = $_POST['exp'];
$c = $_POST['amt'];
$d = $_SESSION['SESS_FIRST_NAME'];
$e = $_POST['rmk'];
// query
$sql = "INSERT INTO salaries (date,employee,amount,paidby,rmks) VALUES (:a,:b,:c,:d,:e)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e));
header("location: salaries.php");


?>