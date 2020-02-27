<?php
require_once('auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


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
<title>
purchases
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
    <link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<!--sa poip up-->
</head>
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
	<?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='cashier') {
?>
<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>">Cash</a>

<a href="../index.php">Logout</a>
<?php
}
if($position=='admin' || 'cashier') {
?>
	

			  
<?php } ?>				
          </div><!--/.well -->
        </div><!--/span-->
	
		<div class="container" ><div class="contentheader">
			<i class="icon-money"></i> purchases
			</div>
			<ul class="breadcrumb">
			<a href="../main/index.php"><li>Dashboard</li></a> /
			<li class="active">purchases</li>
			</ul>
<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="../main/index.php"><button class="btn btn-success btn-large" style="float: none;" ><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a><?php 
			include('../connect.php');
				$result = $db->prepare("SELECT * FROM products where qty < level ORDER BY product_id DESC");
				$result->execute();
				$rowcount123 = $result->rowcount();

			?><?php if ($rowcount123>0) {
				# code...
			?>
			
			<div style="text-align:center;">
			<font style="color:rgb(255, 95, 66); font:bold 22px 'Aleo';"><?php echo $rowcount123;?></font><a rel="facebox" href="../main/level.php">  <button class="btn btn-primary">Low running products</button></a>
			</div><?php } ?>
		</div>
		<script type="text/javascript" src="jquery-1.8.0.min.js"></script>
<div class="container">
<form action="incoming.php" method="post" >
<input type="hidden" name="pt" value="<?php echo $_GET['id']; ?>" />
<input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
<select autofocus name="product" style="width:500px;" class="chzn-select" required >
<option></option>
	<?php
	include('../connect.php');
	$result = $db->prepare("SELECT * FROM products");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch();
		 $i++){
	?>
		<option value="<?php echo $row['product_id'];?>"><?php echo $row['product_code']; ?> - <?php echo $row['gen_name']; ?>  </option>
	<?php
				}

			?>
</select>

<input type="number" name="qty"  min="1" placeholder="Qty" autocomplete="off" style="width: 65px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" required>
<input type="number" name="cost" placeholder="cost" autocomplete="off" style="width: 72px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" required/>
<input type="hidden" name="date" value="<?php $date = date('Y-m-d');
                $d11 = strtotime ( $date ) ;
                $d11 = date ('Y-m-d' , $d11);
                echo $d11; ?>" />
<Button type="submit" class="btn btn-info" style="width: 123px; height:35px; margin-top:-5px;" /><i class="icon-plus-sign icon-large" ></i> Add</button>
</form>
<div id="printableArea">
<table class="table table-bordered" id="resultTable" data-responsive="table">
	<thead>
		<tr>
			<th> Product Name </th>
			<th> Generic Name </th>
			<th> Category / Description </th>
			<th> Price </th>
			<th> Qty </th>
			<th> cost </th>
			<th> Action </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				$id=$_GET['invoice'];
				include('../connect.php');
				$result = $db->prepare("SELECT product_code,gen_name,product,product_name,amount, o_price,pending.qty AS qty,transaction_id  FROM pending RIGHT OUTER JOIN products ON products.product_id=pending.product WHERE invoice= :userid AND amount!= ''");
				$result->bindParam(':userid', $id);
				$result->execute();
				for($i=1; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			<td hidden><?php echo $row['product']; ?></td>
			<td><?php echo $row['product_code']; ?></td>
			<td><?php echo $row['gen_name']; ?></td>
			<td><?php echo $row['product_name']; ?></td>
			<td>
			<?php
			$ppp=$row['amount']/$row['qty'];
			echo formatMoney($ppp, true);
			?>
			</td>
			<td><?php echo $row['qty']; ?></td>
			<td>
			<?php
			$dfdf=$row['amount'];
			echo formatMoney($dfdf, true);
			?>
			</td>
			
			</td>
			<td width="90"><a rel="facebox" href="editspurchase.php?id=<?php echo $row['transaction_id']; ?>"><button class="btn btn-mini btn-warning"><i class="icon icon-remove"></i> edit </button></a>
				
			<a href="delete.php?id=<?php echo $row['transaction_id']; ?>&invoice=<?php echo $_GET['invoice']; ?>&dle=<?php echo $_GET['id']; ?>&qty=<?php echo $row['qty'];?>&code=<?php echo $row['product'];?>"><button class="btn btn-mini btn-warning"><i class="icon icon-remove"></i> Cancel </button></a>
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
			
			<th>  </th>
		</tr>
			<tr>
				<th colspan="5"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
				<td colspan="1"><strong style="font-size: 12px; color: #222222;">
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
				$sdsd=$_GET['invoice'];
				$resultas = $db->prepare("SELECT sum(amount) FROM pending WHERE invoice= :a");
				$resultas->bindParam(':a', $sdsd);
				$resultas->execute();
				for($i=0; $rowas = $resultas->fetch(); $i++){
				$fgfg=$rowas['sum(amount)'];
				echo formatMoney($fgfg, true);
				}
				?>
				
				<th></th>
			</tr>
		
	</tbody>
</table><br>
<a rel="facebox" href="checkout.php?pt=<?php echo $_GET['id']?>&invoice=<?php echo $_GET['invoice']?>&total=<?php echo $fgfg ?>&totalprof=<?php echo '' ?>&cashier=<?php echo $_SESSION['SESS_FIRST_NAME']?>"><button class="btn btn-success btn-large btn-block" ><i class="icon icon-save icon-large" accesskey="s"></i> SAVE</button></a>
<div class="clearfix"></div>
</div>
</div>
</div></div>
</body>
<?php include('footer.php');?>
</html>