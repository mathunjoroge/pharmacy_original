<?php
require_once('auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
      disp_setting+="scrollbars=yes,width=1000, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 100%; font-size: 13px; font-family: arial;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
<?php
$invoice=$_GET['invoice'];
include('../connect.php');
$result = $db->prepare("SELECT * FROM sales WHERE invoice_number= :userid");
$result->bindParam(':userid', $invoice);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$invoice=$row['invoice_number'];
$date = $row['date'];
                $d11 = strtotime ( $date ) ;
                $d11 = date ( 'd/m/Y' , $d11 );
               
$cash=$row['cashtendered'];
$cashier=$row['cashier'];

$pt=$row['type'];
$am=$row['amount'];
if($pt=='cash'){
$cash=$row['cashtendered'];
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
?><body style="text-transform:capitalize;">

<?php include('navfixed.php');?>
<div class="container-fluid">
      <div class="row-fluid">

			</form>
			  </div>
			</li>
				
				</ul>           
          </div><!--/.well -->
        </div><!--/span-->
		
	<div class="span10">
	<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><button class="btn btn-success" id="back"><i class="icon-arrow-left"></i> New sale</button></a>

<div class="container" id="content">
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
	<center><p>Sales Returns</p></center>
	<?php
	$resulta = $db->prepare("SELECT * FROM customer WHERE customer_name= :a");
	$resulta->bindParam(':a', $cname);
	$resulta->execute();
	for($i=0; $rowa = $resulta->fetch(); $i++){
	$address=$rowa['address'];
	$contact=$rowa['contact'];
	}
	?>
	
			<p>INV: <?php echo $invoice ?></p>
		
			<p>Date : <?php echo $d11 ?></p>
		
	<table border="1" cellpadding="4" cellspacing="0" style="font-family: arial; font-size: 12px;	text-align:left;" width="100%">
		<thead>
			<tr>
				<th >description&nbsp;  </th>
				<th> Qty&nbsp;   </th>
				<th> Price&nbsp; </th>
				<th> discount&nbsp; </th>
				<th> Amount </th>
			</tr>
		</thead>
		<tbody>	
			
				<?php
					$id=$_GET['invoice'];
					$result = $db->prepare("SELECT * FROM returns RIGHT OUTER JOIN products ON products.product_id=returns.product WHERE invoice= :userid");
					$result->bindParam(':userid', $id);
					$result->execute();
					for($i=0; $row = $result->fetch(); $i++){
				?>
				<tr class="record">
				<td><?php echo $row['product_code']; ?>&nbsp;&nbsp; <?php echo $row['gen_name']; ?>&nbsp;&nbsp; </td>				
				<td><?php echo $row['quantity']; ?>&nbsp;&nbsp; </td>
				<td>
				<?php
				$ppp=$row['amount']/$row['quantity'];
				echo $ppp;
				?>&nbsp;&nbsp; 
				</td>
				<td>
				<?php
				$ddd=$row['discount'];
				echo formatMoney($ddd, true);
				?>&nbsp;&nbsp; 
				</td>
				<td>
				<?php $dfdf=$row['amount'];	echo $dfdf;	?>	</td>
				</tr>
				<?php
					}
				?>
			
				<tr>
					<td colspan="4">Total: &nbsp;</td>
					<td colspan="1">
					<?php
					$sdsd=$_GET['invoice'];
					$resultas = $db->prepare("SELECT sum(amount) FROM returns WHERE invoice= :a");
					$resultas->bindParam(':a', $sdsd);
					$resultas->execute();
					for($i=0; $rowas = $resultas->fetch(); $i++){
					$fgfg=$rowas['sum(amount)'];
					echo $fgfg;
					}
					?>
					</td>
				</tr>
				<tr>
					<td colspan="4" style="">
					
					<?php
					if($pt=='cash'){
					echo 'Change:';
					}
					if($pt=='credit'){
					echo 'Due Date:';
					}
					?>&nbsp;
					</td>
					<td colspan="1">
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
					</td>

				</tr>
				<tr>
					<td colspan="4"style="">served by:&nbsp;</td>
					<td colspan="2">
					<?php
					echo $_SESSION['SESS_FIRST_NAME'];
					?>
					</td>
				</tr>
				<tr>
					<td colspan="5"style=""><?php
					echo $slogan;
					?>&nbsp;</td>
					
				</tr>
				<tr>
					<td colspan="4"style=""></td>
					<td colspan="2">
					&nbsp;</td>
				</tr>
						
		</tbody></table>
			
	</div>
	</div>	
		<a href="javascript:Clickheretoprint()" style="font-size:20px;" id="print">
			<script type="text/javascript">document.getElementById('print').click();
			document.getElementById('back').click();			
		</script><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
		</div>	
</div>
</div>


