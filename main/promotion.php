<?php
require_once('auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


	<?php
include '../connect.php';
$result = $db->prepare("SELECT * FROM products where qty < level ORDER BY product_id DESC");
$result->execute();
$rowcount123 = $result->rowcount();

?>
<html>
<head>
	<!-- js -->
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : 'src/loading.gif',
      closeImage   : 'src/closelabel.png'
    })
  })
</script>
<title>
Dispense
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
<?php
function createRandomPassword() {
	$chars = "003232303232023232023456789";
	srand((double) microtime() * 1000000);
	$i = 0;
	$pass = '';
	while ($i <= 7) {

		$num = rand() % 33;

		$tmp = substr($chars, $num, 1);

		$pass = $pass . $tmp;

		$i++;

	}
	return $pass;
}
$finalcode = 'INV-' . createRandomPassword();
?>
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
			<i class="icon-money"></i> Sales
			</div>
			<ul class="breadcrumb">
			<a href="index.php"><li>Dashboard</li></a> /
			<li class="active">Sales</li>
			</ul>
<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="index.php"><button class="btn btn-success btn-large" style="float: none;" ><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
			
			<div style="text-align:center;">
			<font style="color:rgb(255, 95, 66); font:bold 22px 'Aleo';"><?php echo $rowcount123;?></font><a rel="facebox" href="level.php">  <button class="btn btn-primary">Low running products</button></a>
			</div>
</div>
<div class="container">
	<table style="border: 0px;padding: 0px;" id="resultTable"   data-responsive="table">
	<thead>
		<tr>
			<th> Product  </th>
			<th> stock available </th>
			<th> qty to buy </th>
			<th> qty free </th>
			<th> reason </th>
			<th> Action </th>
		</tr>
	</thead>
	<tbody>

<form action="savereason.php" method="post" >
 <td><select autofocus name="product" style="width:430px;font-size:0.8em;" class="chzn-select" id="mySelect">
<option></option>
<?php include '../connect.php';
$result = $db->prepare("SELECT* FROM products  WHERE qty>=1");
$result->execute();
?>
    <?php for ($i = 0; $row = $result->fetch(); $i++): ?>
    <option value="<?php echo $row['product_id']; ?>" data-qty="<?=$row['qty'];?>" data-pr="<?=$row['price'];?>"  data-minpr="<?=$row['maxdiscre']; ?>" data-bpr="<?=$row['o_price']; ?>" data-maxdiscpc="<?=$row['maxdiscpr'];?>">
        <?=$row['gen_name']; ?> -
            <?=$row['product_code'];?>
    </option>
<?php endfor;?>
</select></td>

<span id="price" contenteditable="true" name="price"></span>
<script>
$('#mySelect').on('change', function (event) {
    var selectedOptionIndex = event.currentTarget.options.selectedIndex;
    var price = event.currentTarget.value;
    var quantity = event.currentTarget.options[selectedOptionIndex].dataset.qty;
    var price = event.currentTarget.options[selectedOptionIndex].dataset.pr;
    var exp = event.currentTarget.options[selectedOptionIndex].dataset.exp;
    var batch = event.currentTarget.options[selectedOptionIndex].dataset.batch;
    var discountmax = event.currentTarget.options[selectedOptionIndex].dataset.maxdiscpc;//max dis
    var minprice = event.currentTarget.options[selectedOptionIndex].dataset.minpr;
    var buyingprice = event.currentTarget.options[selectedOptionIndex].dataset.bpr;// my fraction
    var miniprice =price*minprice;
    var minimumprice =Math.round(miniprice);
$('[name=qty]').val(quantity);
$('[name=bp]').val(buyingprice);
$('[name=pr]').val(Math.round(price));
$('[name=exp]').val(exp);
$('[name=batch]').val(batch);
document.getElementById('qtyy').max =quantity;
document.getElementById('disc').max =discountmax;
document.getElementById('pricemin').min =buyingprice;
});
</script>
<td><input  name="qty" min="1" placeholder="in stock" autocomplete="off" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" readonly /></td>
<td><input  name="qtybuy" placeholder="buying" autocomplete="off"  value="" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" required /></td>
<td><input type="number"  name="qtyfree" min="" placeholder="qty free"   style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" required></td>
<td><input type="text" name="reason"  placeholder="reason"  style="width: 90px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" required/></td>
<td><Button type="submit" class="btn btn-info" style="width: 123px; height:35px; margin-top:-5px;" /><i class="icon-plus-sign icon-large" ></i> Add</button></td>
</form></tbody>
</table>
<table class="table table-bordered" id="resultTable" data-responsive="table">
	<thead>
		<tr>
			<th> Product Name </th>
			<th> Generic Name </th>
			<th> Qty to buy </th>
			<th> qty to get </th>
			<th> reason </th>
			<th> Action </th>
		</tr>
	</thead>
	<tbody>

			<?php
$qty =1 ;
include '../connect.php';
$result = $db->prepare("SELECT *  FROM  products JOIN promotion ON products.product_id=promotion.product_id WHERE promotionqty>=:qty");
$result->bindParam(':qty', $qty);
$result->execute();
for ($i = 1; $row = $result->fetch(); $i++) {
	?>
			<tr class="record">
			<td><?php echo $row['product_code']; ?></td>
			<td><?php echo $row['gen_name']; ?></td>			
			<td>
			<?php echo $row['promotionqty']; ?> </td>
			<td><?php echo $row['promotion_number']; ?></td>
			<td>
			<?php echo $row['reason']; ?></td>
			
			<td ><a rel="facebox" href="editpromo.php?id=<?php echo $row['product_id']; ?>&reason=<?php echo $row['reason']; ?>&promqty=<?php echo $row['promotionqty']; ?>&promno=<?php echo $row['promotion_number']; ?>"><span><button class="btn btn-mini btn-warning"><i class="icon icon-edit"></i> edit </button></a>
				<script type="text/javascript"></script>
			<a href="end.php?product_id=<?php echo $row['product_id']; ?>"><button class="btn btn-mini btn-warning" onClick="alert('do you want to end the promotion?')"><i class="icon icon-remove"></i>end promotion</button></span></a>

			</tr>
			<?php
}
?>
</table>
<div class="clearfix">
</div>
</div>
</div>


</body>
<?php include 'footer.php';?>
</html>