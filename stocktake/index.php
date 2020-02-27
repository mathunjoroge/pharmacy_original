Fr<!DOCTYPE html>
<html>
<head>
<title>
Pharmacy
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
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : 'src/loading.gif',
      closeImage   : 'src/closelabel.png'
    })
  })
</script>
<?php
	require_once('auth.php');
?>
<?php
function createRandomPassword() {
	$chars = "0013232303232023232023456789";
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
</head>
<body style="text-transform:capitalize;">
<?php include('navfixed.php');?>
	<?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='lab') {
?>
<?php
}
if($position=='lab') {
?>

<a href="lab1.php">Logout</a>
<?php
}
if($position=='admin' || "cashier") {
?>
	
	
	<div class="contentheader">
			<i class="icon-dashboard"></i> Dashboard
			</div>
			<ul class="breadcrumb">
			<li class="active">Dashboard</li>
			</ul>
			<font style=" font:bold 44px 'Aleo'; text-shadow:1px 1px 25px #000; color:green;"><center>company name: Pharmacy</center></font>
<div id="mainmain">



<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><font color="green"><i class="icon-user-md icon-2x"></i><br> Dispense</a>               
<a href="products.php"><i class="icon-list-alt icon-2x"></i><br> Drugs</a>      
<a href="customer.php"><i class="icon-group icon-2x"></i><br> Deparment</a>     
<a href="supplier.php"><i class="icon-group icon-2x"></i><br> Suppliers</a>     
<a href="../salesreport"><i class="icon-bar-chart icon-2x"></i><br> Sales Report</a>
<a href="../consumption/sales_order_list.php"><i class="icon-bar-chart icon-2x"></i><br> Consumption Report</a>
<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><font color="blue"><i class="icon-shopping-cart icon-2x"></i></font><br> Record Purchase</a> 
<a href="purchaseslist.php"><font color="blue"><i class="icon-shopping-cart icon-2x"></i></font><br> view Purchase</a>
<a href="select_customer.php"><font color="blue"><i class="icon-shopping-cart icon-2x"></i></font><br> Record Payment</a>
<a href="statetest.php?term=&nbsp;"><font color="blue"><i class="icon-shopping-cart icon-2x"></i></font><br> Customer Statements</a>
<a href="accountreceivables.php?d1=0&d2=0"><font color="blue"><i class="icon-shopping-cart icon-2x"></i></font><br> Accounts Payable</a>
<a href="http://localhost/others/main/sales.php?id=cash&invoice=<?php echo $finalcode ?>"><font color="blue"><i class="icon-shopping-cart icon-2x"></i></font><br> Dept Dispense</a>
<?php
}
?>
<div class="clearfix"></div>
</div>
</div>
</div>
</div>
</body>
<?php include('footer.php'); ?>
</html>
