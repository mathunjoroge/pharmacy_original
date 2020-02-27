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
<a  href="index.php"><button class="btn btn-success btn-large" style="float: none;" ><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>&nbsp;<a  href="returns.php?id=cash&invoice=<?php echo $finalcode ?>""><button class="btn btn-success btn-large" style="float: none;" >sales return</button></a>&nbsp;<?php
if ($_SESSION['SESS_LAST_NAME'] ='admin') {
	# code...

 ?><a  href="promotion.php"><button class="btn btn-success btn-large" style="float: none;">create promotion</button></a> <?php } ?>
</div>	<?php if ($rowcount123>0) {
				# code...
			?>
			
			<div style="text-align:center;">
			<font style="color:rgb(255, 95, 66); font:bold 22px 'Aleo';"><?php echo $rowcount123;?></font><a rel="facebox" href="level.php">  <button class="btn btn-primary">Low running products</button></a>
			</div><?php } ?>
</div>
<div class="container">
	<table style="border: 0px;padding: 0px;"  id="resultTable" data-responsive="table">
	<thead>
		<tr>
			<th> Product  </th>
			<th> qty </th>
			<th> stock available </th>
			<th> buying price </th>
			<th> price </th>
			<th> discount </th>
			<th> Action </th>
		</tr>
	</thead>
	<tbody>

<form action="incoming.php" method="post" >


<input type="hidden" name="pt" value="<?php echo $_GET['id']; ?>" />
<input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
      <td><select autofocus name="product" style="width:430px;font-size:0.8em;" class="chzn-select" id="mySelect">
<option></option>
<?php include '../connect.php';
$result = $db->prepare("SELECT* FROM products  WHERE qty>=1");
$result->execute();
?>
    <?php for ($i = 0; $row = $result->fetch(); $i++): ?>
    <option value="<?php echo $row['product_id']; ?>" data-qty="<?=$row['qty'];?>" data-pr="<?=$row['price'];?>"  data-minpr="<?=$row['maxdiscre']; ?>" data-bpr="<?=$row['o_price']; ?>" data-maxdiscpc="<?=$row['maxdiscpr'];?>">
        <?=$row['gen_name'];?> -
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
<input type="hidden" name="batch"  placeholder="batch" autocomplete="off" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;">
<td><input type="number" name="quantity" min="1" max="" placeholder="qty" id="qtyy" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" required></td>
<td><input  name="qty" min="1" placeholder="in stock" autocomplete="off" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" readonly /></td>
<td><input  name="bp" placeholder="buying" autocomplete="off" id="buyingprice" value="" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" readonly /></td>
<td><input type="" id="pricemin" name="pr" min="" placeholder="price" id="fpr"  style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;"></td>
<input type="hidden" name="date"  value="<?php $date = date('Y-m-d');
                $d11 = strtotime ( $date ) ;
                $d11 = date ('Y-m-d' , $d11);
                echo $d11; ?>" />
<td><input type="number" name="pc" max="" placeholder="disc" value="0" id="disc" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" /></td>
<td><Button type="submit" class="btn btn-info" style="width: 123px; height:35px; margin-top:-5px;" /><i class="icon-plus-sign icon-large" ></i> Add</button></td>
</form></tbody>
</table>
<table class="table table-bordered" id="resultTable" data-responsive="table">
	<thead>
		<tr>
			<th> Product Name </th>
			<th> Generic Name </th>
			<th> Price </th>
			<th> Qty </th>
			<th> Amount </th>
			<th> discount </th>
			<th> Action </th>
		</tr>
	</thead>
	<tbody>

			<?php
$id = $_GET['invoice'];
include '../connect.php';
$result = $db->prepare("SELECT *  FROM sales_order  RIGHT OUTER JOIN products ON products.product_id=sales_order.product WHERE invoice= :userid AND `rest`=0 AND amount!=0");
$result->bindParam(':userid', $id);
$result->execute();
for ($i = 1; $row = $result->fetch(); $i++) {
	?>
			<tr class="record">
			<td hidden><?php echo $row['product']; ?></td>
			<td><?php echo $row['product_code']; ?></td>
			<td><?php echo $row['gen_name']; ?></td>
			<?php $disc = $row['discount'];?>
			<td>
			<?php echo $row['price']; ?>
			</td>
			<td><?php echo $row['quantity']; ?></td>
			<td>
			<?php
$dfdf = $row['amount'];
	echo $dfdf;
	?>
			</td>
			<td>
			<?php
echo $row['discount'];

	?>
			</td>
			<td width="90"><a rel="facebox" href="editsales.php?id=<?php echo $row['transaction_id']; ?>"><button class="btn btn-mini btn-warning"><i class="icon icon-edit"></i> edit </button></a>
			<a href="delete.php?trans_id=<?php echo $row['transaction_id']; ?>&invoice=<?php echo $_GET['invoice']; ?>&qty=<?php echo $row['quantity']; ?>&prod_id=<?php echo $row['product']; ?>"><button class="btn btn-mini btn-warning"><i class="icon icon-remove"></i> Cancel </button></a>

			</tr>
			<?php
}
?>
			<tr>
			<th> </th>
			<th>  </th>
			<th>  </th>
			<th>  </th>
			<th>  </th>
			<td> Total Amount: </td>
			<td>  </td>
			<th>  </th>
		</tr>
			<tr>
				<th colspan="5"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
				<td colspan="1"><strong style="font-size: 12px; color: #222222;">
				<?php
function formatMoney($number, $fractional = false) {
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
	return round($number);
}
$sdsd = $_GET['invoice'];
$resultas = $db->prepare("SELECT sum(amount) AS amount FROM sales_order WHERE invoice= :a AND `rest`=0");
$resultas->bindParam(':a', $sdsd);
$resultas->execute();
for ($i = 0; $rowas = $resultas->fetch(); $i++) {
	$fgfg = $rowas['amount'];
	
	echo $fgfg;
}
?>
				</strong></td>
				<td colspan="1"><strong style="font-size: 12px; color: #222222;">
			<?php
$resulta = $db->prepare("SELECT sum(profit) FROM sales_order WHERE invoice= :b AND `rest`=0");
$resulta->bindParam(':b', $sdsd);
$resulta->execute();
for ($i = 0; $qwe = $resulta->fetch(); $i++) {
	$asd = $qwe['sum(profit)'];

}
?>

				</td>
				<th></th>
			</tr>

	</tbody>
</table><br>
<?php if (isset($fgfg)) {
	# code...
?>
<a rel="facebox" href="checkout.php?pt=<?php echo $_GET['id'] ?>&invoice=<?php echo $_GET['invoice'] ?>&total=<?php echo $fgfg ?>&totalprof=<?php echo $asd ?>&cashier=<?php echo $_SESSION['SESS_FIRST_NAME'] ?>"><button class="btn btn-success btn-large btn-block" accesskey="s"><i class="icon icon-save icon-large" accesskey="s"></i> SAVE</button></a><?php }?>
<div class="clearfix"></div>
</div>
</div>


</body>
<?php include 'footer.php';?>
</html>