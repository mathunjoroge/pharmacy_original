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
stock take
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
<!--sa poip up-->


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
<a  href="../main/index.php"><button class="btn btn-success btn-large" style="float: none;" ><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
</div>	<div style="text-align:center;">
			<font style="color:rgb(255, 95, 66);; font:bold 22px 'Aleo';"><?php echo $rowcount123; ?></font><a rel="facebox" href="level.php">  <button class="btn btn-primary">Low running products</button></a>
			</div>
</div>
<div class="container">

<form action="incoming.php" method="post" >


<input type="hidden" name="pt" value="<?php echo $_GET['id']; ?>" />
<input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
      <select autofocus name="product" style="width:430px;font-size:0.8em;" class="chzn-select" id="mySelect">
<option></option>
<?php include '../connect.php';
$result = $db->prepare("SELECT* FROM products RIGHT OUTER JOIN batch ON batch.product_id=products.product_id WHERE quantity>=1 ORDER BY expirydate  ASC");
$result->execute();
?>
    <?php for ($i = 0; $row = $result->fetch(); $i++): ?>
    <option value="<?php echo $row['product_id']; ?>" data-qty="<?=$row['quantity'];?>" data-pr="<?=$row['o_price']*$row['markup'];?>" data-exp="<?=$row['expirydate'];?>" data-batch="<?=$row['batch_no'];?>" data-maxdisc="<?=$row['maxdiscre'];?>" data-maxdiscpc="<?=$row['maxdiscpr'];?>">
        <?=$row['gen_name'];?> -
            <?=$row['product_code'];?>
    </option>
<?php endfor;?>
</select>

<span id="price" contenteditable="true" name="price"></span>
<script>
$('#mySelect').on('change', function (event) {
    var selectedOptionIndex = event.currentTarget.options.selectedIndex;
    var price = event.currentTarget.value;
    var quantity = event.currentTarget.options[selectedOptionIndex].dataset.qty;
    var price = event.currentTarget.options[selectedOptionIndex].dataset.pr;
    var exp = event.currentTarget.options[selectedOptionIndex].dataset.exp;
    var batch = event.currentTarget.options[selectedOptionIndex].dataset.batch;
    var discountmax = event.currentTarget.options[selectedOptionIndex].dataset.maxdiscpc;
    var minprice = event.currentTarget.options[selectedOptionIndex].dataset.maxdisc;
    var myinput= document.getElementById('myqty');
    document.getElementById('deviate').value = quantity-myinput;
$('[name=qty]').val(quantity);
$('[name=pr]').val(price);
$('[name=exp]').val(exp);
$('[name=batch]').val(batch);


});
</script>

<input type="text" name="batch"  placeholder="batch" autocomplete="off" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;">
<input  name="qty" min="1" placeholder="in stock" autocomplete="off" id="deviatee" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" readonly />
<input type="number" name="quantity" min="1" max="" placeholder="qty" id="myqty" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" required>
<input type="text" name="deviate" placeholder="deviation" id="deviate" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" readonly="">

<input  name="exp" placeholder="expiry" autocomplete="off" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" readonly />
<input type="hidden" name="pr" min="1" placeholder="price" id="fpr" step=".00001" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;">

<input type="hidden" name="pc" max="" placeholder="disc" id="disc" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" />
<input type="hidden" name="date" value="<?php echo date('m/d/y'); ?>" />

<Button type="submit" class="btn btn-info" style="width: 123px; height:35px; margin-top:-5px;" /><i class="icon-plus-sign icon-large" ></i> Add</button>
</form>
<table class="table table-bordered" id="resultTable" data-responsive="table">
	<thead>
		<tr>
			<th> Product Name </th>
			<th> Generic Name </th>
			<th> Category / Description </th>
			
			<th> Qty </th>
			<th> deviation </th>
			
			<th> Action </th>
		</tr>
	</thead>
	<tbody>

			<?php
$id = $_GET['invoice'];
include '../connect.php';
$result = $db->prepare("SELECT * FROM sales_order WHERE invoice= :userid AND qty!= ''");
$result->bindParam(':userid', $id);
$result->execute();
for ($i = 1; $row = $result->fetch(); $i++) {
	?>
			<tr class="record">
			<td hidden><?php echo $row['product']; ?></td>
			<td><?php echo $row['product_code']; ?></td>
			<td><?php echo $row['gen_name']; ?></td>
			<td><?php echo $row['name']; ?></td>
			
			<td><?php echo $row['qty']; ?></td>
			<td>
			<?php
$dfdf = $row['qty']-$row['balance'];
	echo $dfdf;
	?>
			</td>
			
			<td width="90"><a rel="facebox" href="editsales.php?id=<?php echo $row['transaction_id']; ?>"><button class="btn btn-mini btn-warning"><i class="icon icon-edit"></i> edit </button></a>
			<a href="delete.php?id=<?php echo $row['transaction_id']; ?>&invoice=<?php echo $_GET['invoice']; ?>&dle=<?php echo $_GET['id']; ?>&qty=<?php echo $row['qty']; ?>&code=<?php echo $row['product']; ?>"><button class="btn btn-mini btn-warning"><i class="icon icon-remove"></i> Cancel </button></a>

			</tr>
			<?php
}
?>
			

	</tbody>
</table><br>
<a rel="facebox" href="checkout.php?pt=<?php echo $_GET['id'] ?>&invoice=<?php echo $_GET['invoice'] ?>&total=<?php echo $fgfg ?>&totalprof=<?php echo $asd ?>&cashier=<?php echo $_SESSION['SESS_FIRST_NAME'] ?>"><button class="btn btn-success btn-large btn-block" accesskey="s"><i class="icon icon-save icon-large" accesskey="s"></i> SAVE</button></a>
<div class="clearfix"></div>
</div>
</div>


</body>
<?php include 'footer.php';?>
</html>