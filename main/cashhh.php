<?php
require_once('auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>
Sales Report
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
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script>
<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=700, height=400, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><h4 align="center">Winsor Pharmacy</h4><body align="center" onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>


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
<body>
<?php include('navfixed.php');?>
<div class="container">
      
	
	<div class="contentheader">
			<i class="icon-bar-chart"></i> Sales Report
			</div>
			<ul class="breadcrumb">
			<li><p>&nbsp;</p></li> 
			<li class="active">&nbsp;</li>
			</ul>

<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="index.php"><button class="btn btn-success btn-large" style="float: none;"><i class="icon icon-home icon-large"></i> Back</button></a>


</div>

<form action="cashhh.php" method="GET">
<center><strong>From : <input type="text" style="width: 223px; padding:14px;" name="d1" class="tcal" value="" autocomplete="off" /> To: <input type="text" style="width: 223px; padding:14px;" name="d2" class="tcal" value="" autocomplete="off" />
 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit"><i class="icon icon-search icon-large"></i> Search</button>
</strong></center>
</form>
<div class="content" id="content">
<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
cash summary from&nbsp;<?php $date = $_GET['d1'] ;
                $d11 = strtotime ( $date ) ;
                $d11 = date ( 'j/m/Y' , $d11 );
                echo $d11; ?>&nbsp;to&nbsp;<?php $date = $_GET['d2'] ;
                $d112 = strtotime ( $date ) ;
                $d112 = date ( 'j/m/Y' , $d112 );
                echo $d112;  ?>
</div>
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
		<th >  </th>
						
			
			<th > </th>
			<th > Amount </th>
			<th > Profit </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$d1=date('Y-m-d',strtotime($_GET['d1']))." 00:00:00"; 
				$d2=date('Y-m-d',strtotime($_GET['d2']))." 59:59:59";
				$result = $db->prepare("SELECT *  FROM sales WHERE date>=:a AND date<=:b ORDER by transaction_id DESC ");
				$result->bindParam(':a', $d1);
				$result->bindParam(':b', $d2);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			
			<?php
				}
			?>
		
	</tbody>
	<thead>
		<tr>
			<th colspan="2" style="border-top:1px solid #999999"> Total sales: </th>
			<th colspan="1" style="border-top:1px solid #999999"> 
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
				$d1=date('Y-m-d',strtotime($_GET['d1']))." 00:00:00"; 
				$d2=date('Y-m-d',strtotime($_GET['d2']))." 59:59:59";
				$result = $db->prepare("SELECT sum(amount) AS sum FROM sales WHERE date>=:a AND date<=:b");
				$result->bindParam(':a', $d1);
				$result->bindParam(':b', $d2);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
				$total=$row['sum'];
				echo formatMoney($total, true);
				
				}
				?>
			</th>
				<th colspan="1" style="border-top:1px solid #999999">
			<?php 
			$d1=date('Y-m-d',strtotime($_GET['d1']))." 00:00:00"; 
				$d2=date('Y-m-d',strtotime($_GET['d2']))." 59:59:59";
				$result = $db->prepare("SELECT sum(profit) AS profit FROM sales WHERE date>=:a AND date<=:b");
				$result->bindParam(':a', $d1);
				$result->bindParam(':b', $d2);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
				$profit=$row['profit'];
				echo formatMoney($profit, true);
				}
				?>
		
				</th>
		</tr>
		<thead>
		<tr>
			<th colspan="2" style="border-top:1px solid #999999"> Total cash sales: </th>
			<th colspan="1" style="border-top:1px solid #999999"> 
			<?php
			$c='cash';
				$d='paid';
				$result = $db->prepare("SELECT sum(amount) as sum FROM sales WHERE type=:c  AND date>=:a AND date<=:b");
				$result->bindParam(':a', $d1);
				$result->bindParam(':b', $d2);
				$result->bindParam(':c', $c);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
				$cashs=$row['sum'];
				echo formatMoney($cashs, true);
				}
				
				
				?>
			</th>
				<th colspan="1" style="border-top:1px solid #999999">
			<?php 
				$c='cash';
				$d='paid';
				$result = $db->prepare("SELECT sum(profit) AS profit FROM sales WHERE type=:c  AND date>=:a AND date<=:b");
				$result->bindParam(':a', $d1);
				$result->bindParam(':b', $d2);
				$result->bindParam(':c', $c);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
				$total=$row['profit'];
				echo formatMoney($total, true);
				}
				?>
		
				</th>
		</tr>
		<thead>
		<tr>
			<th colspan="2" style="border-top:1px solid #999999"> Total cash payments by customers: </th>
			<th colspan="1" style="border-top:1px solid #999999"> 
			<?php
				$result = $db->prepare("SELECT sum(amount2) AS sum FROM collection WHERE date2>=:a AND date2<=:b");
				$result->bindParam(':a', $d1);
				$result->bindParam(':b', $d2);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
				$paymentsc=$row['sum'];
				echo formatMoney($paymentsc, true);
				
				}
				?>
			</th>
				<th colspan="1" style="border-top:1px solid #999999">
			<?php 
				
				?>
		
				</th>
		</tr>
		
			
		<tr>
			<th colspan="2" style="border-top:1px solid #999999"> Total expenses: </th>
			<th colspan="1" style="border-top:1px solid #999999"> 
			<?php
			
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				$result = $db->prepare("SELECT sum(amount) FROM expenses WHERE date>=:a AND date<=:b");
				$result->bindParam(':a', $d1);
				$result->bindParam(':b', $d2);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
				$exp=$row['sum(amount)'];
				echo formatMoney($exp, true);
				}
				?>
			</th>
				<th colspan="1" style="border-top:1px solid #999999">
			
		
				</th>
		</tr>
		<tr><?php $tcash=$cashs+$paymentsc;
		$cashout=$exp;
		$tcashav=$tcash-$cashout;
		 ?>
			<th colspan="2" style="border-top:1px solid #999999"> Total cash available: </th>
			<th colspan="1" style="border-top:1px solid #999999"> 
			<?php
			
				
				echo '';
				
				?>
			</th>
				<th colspan="1" style="border-top:1px solid #999999">
			<?php 
				echo formatMoney($tcashav, true);
				?>
		
				</th>
		</tr>

	</thead>
</table>
</div>
<button  style="float:right;" class="btn btn-success btn-large"><a href="javascript:Clickheretoprint()"> Print</button></a>
<div class="clearfix"></div>
</div>
</div>
</div>

</body>
<script src="js/jquery.js"></script>
 
<?php include('footer.php');?>
</html>