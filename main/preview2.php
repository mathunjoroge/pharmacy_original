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
$result = $db->prepare("SELECT * FROM pending WHERE invoice= :userid");
$result->bindParam(':userid', $invoice);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$cname=$row['name'];
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
$finalcode='RS-'.createRandomPassword();
?>



 <script language="javascript" type="text/javascript">
/* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */
<!-- Begin
var timerID = null;
var timerRunning = false;
function stopclock (){
if(timerRunning)
clearTimeout(timerID);
timerRunning = false;
}
function showtime () {
var now = new Date();
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds()
var timeValue = "" + ((hours >12) ? hours -12 :hours)
if (timeValue == "0") timeValue = 12;
timeValue += ((minutes < 10) ? ":0" : ":") + minutes
timeValue += ((seconds < 10) ? ":0" : ":") + seconds
timeValue += (hours >= 12) ? " P.M." : " A.M."
document.clock.face.value = timeValue;
timerID = setTimeout("showtime()",1000);
timerRunning = true;
}
function startclock() {
stopclock();
showtime();
}
window.onload=startclock;
// End -->
</SCRIPT>
<body style="text-transform:capitalize;">

<?php include('navfixed.php');?>
	
				
	<a href="purchaseslist.php?"><button class="btn btn-primary"><i class="icon-arrow-left"></i> back</button></a>

<div class="content" id="content">
<div style="margin: 0 auto; padding: 20px; width: 900px; font-weight: normal;">
	<div style="width: 100%; height: 190px;" >
	<div style="width: 900px; float: left;">
	<center><div style="font:bold 25px 'Aleo';">purchases record</div>
	elians Pharmacy	
	</center>
	<div>
	<?php
	$resulta = $db->prepare("SELECT * FROM customer WHERE customer_name= :a");
	$resulta->bindParam(':a', $cname);
	$resulta->execute();
	for($i=0; $rowa = $resulta->fetch(); $i++){
	$address=$rowa['address'];
	$contact=$rowa['contact'];
	}
	?>
	</div>
	</div>
	<div style="width: 136px; float: left; height: 70px;">
	<table cellpadding="3" cellspacing="0" style="font-family: arial; font-size: 12px;text-align:left;width : 100%;">

		<tr>
			
		</tr>
			<td>INV:</td>
			<td><?php echo $invoice ?></td>
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
					$result = $db->prepare("SELECT * FROM pending WHERE invoice= :userid");
					$result->bindParam(':userid', $id);
					$result->execute();
					for($i=0; $row = $result->fetch(); $i++){
				?>
				<tr class="record">
				<td><?php echo $row['gen_name']; ?></td>
				<td><?php echo $row['product_code']; ?></td>				
				<td><?php echo $row['qty']; ?></td>
				<td>
				<?php
				$ppp=$row['price'];
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
	<td>Viewing As:</td>
			<td><?php echo $_SESSION['SESS_FIRST_NAME'];?></td>
			
	
	</div>
	</div>
<div class="pull-right" style="margin-right:100px;">
		<a href="javascript:Clickheretoprint()" style="font-size:20px;"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
		</div>	
</div>
</div>


