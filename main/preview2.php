<!DOCTYPE html>
<html>
<head>
<?php require_once ("auth.php"); ?>
<title>
Preview Invoice
</title>
<link href="css/bootstrap.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">

<link rel="stylesheet" href="css/font-awesome.min.css">
<style type="text/css">

.sidebar-nav {
padding: 9px 0;
}
</style>
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script language="javascript">
function Clickheretoprint()
{ 
var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
disp_setting+="scrollbars=yes,width=800, height=400, left=100, top=25"; 
var content_vlue = document.getElementById("content").innerHTML; 

var docprint=window.open("","",disp_setting); 
docprint.document.open(); 
docprint.document.write('</head><body onLoad="self.print()" style="width: 800px; font-size: 13px; font-family: arial;">');          
docprint.document.write(content_vlue); 
docprint.document.close(); 
docprint.focus(); 
}
</script>
<?php
$invoice=$_GET['invoice'];
include('../connect.php');
$result = $db->prepare("SELECT * FROM pending WHERE invoice= :invoice");
$result->bindParam(':invoice', $invoice);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$invoice=$row['invoice'];
$date=$row['date'];

$cashier=$row['cashier'];

$pt=$row['type'];
$am=$row['amount'];
if($pt=='cash'){
$cash=$row['due_date'];
$amount=$cash-$am;
}
}
?>
<?php
function createRandomPassword() {
$chars = "003232303232023232023456789";
srand((double)microtime()*1000000);
$i = 0;
$pass = '' ;
while ($i <= 7) {

$num = rand() % 33;

$tmp = substr($chars, $num, 1);

$pass = $pass . $tmp;

$i++;

}
return $pass;
}
$finalcode='INV-'.createRandomPassword();
?>
<body style="text-transform:capitalize;">
<?php include('navfixed.php');?>
<div class="container">
<a href="purchaseslist.php"><button class="btn btn-primary"><i class="icon-arrow-left"></i>back</button></a>&nbsp;&nbsp;	<a href="sales.php?id=cash&invoice=<?php echo rand(); ?>"><button class="btn btn-primary"><i class="icon-arrow-left"></i> Go to sales</button></a>

<div class="container" id="content">
<div style="margin: 0 auto; padding: 20px; width: 900px; font-weight: normal;">
<?php
include('../connect.php');
$result = $db->prepare("SELECT * FROM settings");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$jina=$row['name']; 
$mahali=$row['address']; 
$simu=$row['phone']; 
$slogan=$row['slogan']; 
?>
<center><p style="font:bold 25px 'Aleo';"><?php echo $jina; ?></p></center>
<center><p><?php echo $mahali; ?></p></center>
<center><p><?php echo $simu; ?><?php } ?></center>
<center><p>purchases record</p></center>
<?php 
$id=$_GET['invoice'];
$result = $db->prepare("SELECT * FROM purchases2 WHERE invoice_number=:a");
$result->bindParam(':a', $id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$invoicee=$row['invoicesupp']; 

?>
<?php } ?>

<div style="width: 136px; float: left; height: 70px;">
<table cellpadding="3" cellspacing="0" style="font-family: arial; font-size: 12px;text-align:left;width : 100%;">

<tr>

</tr>
<td>INVOICE:</td>
<td><?php echo $invoicee ?></td>
</tr>
<tr>
<td>Date :</td>
<td><?php echo $date ?></td>
</tr>
</table>

</div>
<div class="clearfix"></div>
</div>
<div style="width: 100%; margin-top:-70px;">
<table border="1" cellpadding="4" cellspacing="0" style="font-family: arial; font-size: 12px;	text-align:left;" width="100%">
<thead>
<tr>

<th> Brand Name </th>
<th > Generic Name </th>
<th> Qty </th>
<th> Price </th>
<th> discount </th>
<th> Amount </th>
</tr>
</thead>
<tbody>


<?php
$id=$_GET['invoice'];
$result = $db->prepare("SELECT product_code,gen_name,product,product_name,amount, o_price,pending.qty AS qty, pending.amount, discount FROM pending RIGHT OUTER JOIN products ON products.product_id=pending.product WHERE invoice= :invoice");
$result->bindParam(':invoice', $id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?>
<tr class="record">
<td><?php echo $row['gen_name']; ?></td>
<td><?php echo $row['product_code']; ?></td>				
<td><?php echo $row['qty']; ?></td>
<td>
<?php
$ppp=$row['amount']/$row['qty'];
echo formatMoney($ppp, true);
?>
</td>
<td>
<?php
$ddd=$row['discount'];
echo formatMoney($ddd, true);
?>
</td>
<td>
<?php
$dfdf=$row['amount'];
echo formatMoney($dfdf, true);
?>
</td>
</tr>
<?php
}
?>

<tr>
<td colspan="5" style=" text-align:right;"><strong style="font-size: 12px;">Total: &nbsp;</strong></td>
<td colspan="2"><strong style="font-size: 12px;">
<?php
$sdsd=$_GET['invoice'];
$resultas = $db->prepare("SELECT sum(amount) FROM pending WHERE invoice= :a");
$resultas->bindParam(':a', $sdsd);
$resultas->execute();
for($i=0; $rowas = $resultas->fetch(); $i++){
$fgfg=$rowas['sum(amount)'];
echo formatMoney($fgfg, true);
}
?>
</strong></td>
</tr>
<?php if($pt=='cash'){
?>
<tr>
<td colspan="5"style=" text-align:right;"><strong style="font-size: 12px; color: #222222;">Cash Tendered:&nbsp;</strong></td>
<td colspan="2"><strong style="font-size: 12px; color: #222222;">
<?php
echo formatMoney($cash, true);
?>
</strong></td>
</tr>
<?php
}
?>
<tr>
<td colspan="5" style=" text-align:right;"><strong style="font-size: 12px; color: #222222;">
<font style="font-size:20px;">
<?php
if($pt=='cash'){
echo 'Change:';
}
if($pt=='credit'){
echo 'Due Date:';
}
?>&nbsp;
</strong></td>
<td colspan="2"><strong style="font-size: 15px; color: #222222;">
<?php
function formatMoney($number, $fractional=false) {
if ($fractional) {
$number = sprintf('%.2f', $number);
}
while (true) {
$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
if ($replaced != $number) {
$number = $replaced;
} else {
break;
}
}
return $number;
}
if($pt=='credit'){
echo $cash;
}
if($pt=='cash'){
echo formatMoney($amount, true);
}
?>
</strong></td>
</tr>

</tbody>
</table>
<div><p>&nbsp;</p></div>
<td>viewing as:</td>
<td><?php echo $_SESSION['SESS_FIRST_NAME']; ?></td>


</div>
</div>
<div class="pull-right" style="margin-right:100px;">
<a href="javascript:Clickheretoprint()" style="font-size:20px;"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
</div>	
</div>
</div>
</body>
</html>


