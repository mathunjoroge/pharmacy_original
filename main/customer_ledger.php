<?php
require_once('auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<title>
Customer ledger
</title>
</title>
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

<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<!--sa poip up-->
<script src="argiepolicarpio.js" type="text/javascript" charset="utf-8"></script>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>
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
</head>
<body>

<?php include('navfixed.php');?>
	
	
	
	<div class="container">
     
	<div class="contentheader">
			<i class="icon-list"></i> Customer Legder
			</div>
			<ul class="breadcrumb">
			<li><a href="index.php">Dashboard</a></li> /
			<li class="active">Customer Legder</li>
			</ul><script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=700, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>

<div style="margin-top: -19px; margin-bottom: 21px;">
<?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='admin') {
?>
<a  href="statementslist.php"><button class="btn btn-success btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>     

<?php
}
?>
<?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='cashier') {
?>
<a  href="cashier.php"><button class="btn btn-success btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>     

<?php
}
?>
</div>
<div class="content" id="content">

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
include('../connect.php');
$tftft=$_GET['cname'];
$resulta = $db->prepare("SELECT * FROM sales WHERE name= :a");
$resulta->bindParam(':a', $tftft);
$resulta->execute();
for($i=0; $rowa = $resulta->fetch(); $i++){
$name=$rowa['name'];
$amount=$rowa['amount'];
}
$resultas = $db->prepare("SELECT * FROM customer WHERE customer_name= :b");
$resultas->bindParam(':b', $name);
$resultas->execute();
for($i=0; $rowas = $resultas->fetch(); $i++){
echo 'Name : '.$rowas['customer_name'].'<br>';
echo 'Address : '.$rowas['address'].'<br>';
echo 'Contact : '.$rowas['contact'].'<br>';
$balcal=$rowas['customer_name'];


}

?>
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			
			<th> Date </th>
			<th> type </th>			
			<th> confirm/check No</th>			
			<th> Payment amount </th>
			
		</tr>
	</thead>
	<tbody>
		<tr class="record">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		
			
			<td><strong><?php echo $rowa['amount2']; ?></strong></td>
			
			</tr>
			<?php
				$tftft=$_GET['cname'];
				$result = $db->prepare("SELECT * FROM collection WHERE name= :userid ORDER BY transaction_id DESC Limit 10");
				$result->bindParam(':userid', $tftft);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			
			<td><?php $date =$row['date2'];
                $d112 = strtotime ( $date ) ;
                $d112 = date ( 'j/m/Y' , $d112 );
                echo $d112; ?></td>
			<td><?php echo $row['type']; ?></td>
			<td><?php echo $row['confirm']; ?></td>
			<td><?php echo formatMoney($row['amount2'], true); ?></td>
			
			</tr>
			<?php
				}
			?>
			<tr>
			<th colspan="3" style="border-top:1px solid #999999"> Total payments: </th>
			<th colspan="1" style="border-top:1px solid #999999">  
				 
			<?php
				$tftft=$_GET['cname'];
				
				$results = $db->prepare("SELECT sum(amount2) FROM collection WHERE name LIKE '%".$tftft."%' ORDER BY `date2`");
				
				$results->execute();
				for($i=0; $rows = $results->fetch(); $i++){
				$payments=$rows['sum(amount2)'];
				echo formatMoney($payments, true);
				}
				?>
			</th>

		</tr>
		</tr>
			<?php
				
			?>
			<tr>
			<th colspan="3" style="border-top:1px solid #999999"> balance: </th>
			<th colspan="1" style="border-top:1px solid #999999">  
				 
			<?php
				$tftft=$_GET['cname'];
				$c='credit';
				
				$results = $db->prepare("SELECT sum(amount) FROM sales WHERE type LIKE '%".$c."%' AND name LIKE '%".$tftft."%'");
				
				$results->execute();
				for($i=0; $rows = $results->fetch(); $i++){
				$salec=$rows['sum(amount)'];
				echo  formatMoney($salec-$payments, true);;
				}
				?>
			</th>

		</tr>
				
		
	</tbody>
</table>
<div><a rel="facebox" href="addledger.php?invoice=<?php echo $_GET['cname']; ?>&amount=<?php echo $rowa['amount2']; ?>" style="margin-top: 10px;"><button class="btn btn-success"><i class="icon-plus-sign icon-large"></i> Add cash Payment</button></a><a rel="facebox" href="mpesa1.php?invoice=<?php echo $_GET['cname']; ?>&amount=<?php echo $rowa['amount2']; ?>" style="margin-top: 10px;"><button class="btn btn-success"><i class="icon-plus-sign icon-large"></i> Add Mpesa Payment</button></a><a rel="facebox" href="bank1.php?invoice=<?php echo $_GET['cname']; ?>&amount=<?php echo $rowa['amount2']; ?>" style="margin-top: 10px;"><button class="btn btn-success"><i class="icon-plus-sign icon-large"></i> Add  bank Payment</button></a><br><br>
</div>
</div>
<button  style="width: 123px; height:35px; margin-top:-2px; float:right;" class="btn btn-success btn-large"><a href="javascript:Clickheretoprint()"><i class="icon icon-print icon-large"></i> Print</a></button>
<div class="clearfix"></div>
</div>
</body>
<?php include('footer.php');?>


</html>