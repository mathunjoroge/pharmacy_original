<?php
require_once('auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><html>
<head>
<!-- js -->
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script><head>
<title>
bincard
</title>
<link href="vendors/uniform.default.css" rel="stylesheet" media="screen">
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<style type="text/css">
body {
padding-top: 60px;
padding-bottom: 40px;
}
.sidebar-nav {
padding: 9px 0;
}

</style>
<link href="css/bootstrap-responsive.css" rel="stylesheet">

<!-- combosearch box-->

<script src="vendors/jquery-1.7.2.min.js"></script>
<script src="vendors/bootstrap.js"></script>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include 'navfixed.php';?>
<?php
$position = $_SESSION['SESS_LAST_NAME'];
if ($position == 'cashier') {
?>
<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>">Cash</a>

<a href="../index.php">Logout</a>
<?php
}
if ($position == 'admin' || 'cashier') {
?>



<?php }?>
</div><!--/.well -->
</div>
<div class="container">	
<div class="contentheader">
<i class="icon-bar-chart"></i> Stock card
</div>
<ul class="breadcrumb">
<li><p>&nbsp;</p></li> 
<li class="active">&nbsp;</li>
</ul>

<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="inventory.php"><button class="btn btn-success btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>


</div>
<div class="container">


<form action="bincard.php" method="GET" >


<select autofocus name="product" style="width:430px;font-size:0.8em;" class="chzn-select" id="mySelect" required>
<option></option>
<?php include '../connect.php';
$result = $db->prepare("SELECT* FROM products ");
$result->execute();
?>
<?php for ($i = 0; $row = $result->fetch(); $i++): ?>
<option value="<?php echo $row['product_id']; ?>" >
<?=$row['gen_name'];?> -
<?=$row['product_code'];?>
</option>
<?php endfor;?>
</select>

<strong>From : <input type="text" style="width: 150px; padding:14px;" name="d1" class="tcal" autocomplete="off" value="" required/> To: <input type="text" style="width: 150px; padding:14px;" name="d2" class="tcal" value="" autocomplete="off" required/></span>
<button class="btn btn-info" style="width: 150px; height:35px; margin-top:-8px;margin-left:8px;" type="submit"><i class="icon icon-search icon-large"></i>Generate</button>
</strong>
</form><div class="content" id="content">
<?php
if (isset($_GET['d1'])) {
# code...
$d1=$_GET['d1']." 00:00:00"; 
$d2=$_GET['d2'].""." 23:59:59";
$date1=date("Y-m-d H:i:s", strtotime($d1));
$date2=date("Y-m-d H:i:s", strtotime($d2));
$product_id=$_GET['product'];
?>
<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
<center>generated bincard for <?php echo $product_id; ?>: <?php echo $product_id; ?></div>
<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">from&nbsp;<?php 
echo date("D d-M-Y", strtotime($d1)); ?>&nbsp;to&nbsp;
<?php 
echo date("D d-M-Y", strtotime($d2));  ?>
</center></div>
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;width: 80%;">
<thead>
<tr>

<th > Date </th>
<th > Dispensed/Received </th>
<th >&nbsp;</th>
<th > qty </th>
<th > balance </th>
</tr>
</thead>
<tbody>
<tr class="record"> <?php

$result = $db->prepare("SELECT  sales_order.date AS sales_date, quantity, balance  FROM sales_order	WHERE (sales_order.product=:product_id AND sales_order.date >=:a AND sales_order.date<=:b)");
$result->bindParam(':a', $date1);
$result->bindParam(':b', $date2);
$result->bindParam(':product_id', $product_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$sales_date=$row['sales_date'];
$purchase_date="";
$sales_qty=$row['quantity'];
$purchase_qty="";
?>
</tbody>
<tr class="record">
<td><?php if (isset($sales_date)) {
echo $sales_date;
} 
else{
echo $purchase_date;
} ?></td>
<td>
	<?php if (isset($sales_qty)) {
echo "sales";
} 
else{
echo "purchases";
} ?>
</td>
<td><?php echo ''; ?></td>
<td><?php if (isset($sales_qty)) {
echo $sales_qty;
} 
else{
echo $purchase_qty;
} ?></td>
<td><?php echo $row['balance']; ?></td>
<?php } ?>
<table class="table" style="width: 70%;"><tr>
<th>total dispensed</th>

<?php $result = $db->prepare("SELECT sum(quantity)AS sum  FROM sales_order WHERE product=:product_id AND date >=:a and date<=:b");
$result->bindParam(':a', $date1);
$result->bindParam(':b', $date2);
$result->bindParam(':product_id', $product_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ ?>
<th ><?php echo $row['sum'];  ?></th><?php } ?>
</tr> </table>
</tr>
</tbody>
</table>
<table class="table table-bordered">
	<tr>
		<th>date</th>
		<th>quantity</th>
	</tr>
	<?php
$result = $db->prepare("SELECT  pending.date AS purchase_date, qty AS quantity  FROM pending	WHERE (pending.product=:product_id AND pending.date >=:a AND pending.date<=:b)");
$result->bindParam(':a', $date1);
$result->bindParam(':b', $date2);
$result->bindParam(':product_id', $product_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$purchase_date=$row['purchase_date'];
$purchase_qty=$row['quantity'];
?><tr>
	<td><?php print $purchase_date; ?></td>
	<td><?php print $purchase_qty; ?></td>
<?php } ?>
	</tr>
</table>
<?php } ?>
<?php include 'footer.php'; ?>
</html>