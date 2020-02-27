<?php
	require_once('auth.php');
?>
<!DOCTYPE html>
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
<body>
<?php include('navfixed.php');?>
	
	

				</ul>                               
          </div><!--/.well -->
        </div><!--/span-->
        <div class="container"><p>&nbsp;</p>
        	<div style="margin-top: 3%; margin-bottom: 21px;">
<a  href="admin.php"><button class="btn btn-success btn-large" style="float: left;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>

			

	<div class="contentheader">
			
			</div>
			
			<font style=" font:bold 44px 'Aleo'; text-shadow:1px 1px 25px #000; color:green;"><center>statements</center></font>
<div id="mainmain">
<a href="purchaseslist.php"><font ><i class="icon-shopping-cart icon-2x"></i></font><br> view Purchase</a>
<a href="select_customer.php"><font ><i class="icon-shopping-cart icon-2x"></i></font><br> customer Payment and statement</a>
<a href="selectsupplier.php"><font ><i class="icon-shopping-cart icon-2x"></i></font><br> supplier Payment</a>
<a href="suppstatements.php?term=&nbsp;"><font ><i class="icon-bar-chart icon-2x"></i></font><br>supplier Statements</a>
<a href="salesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"></i><br> Sales Report</a>
<a href="consumptionlist.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"></i><br> Consumption Report</a>
<a href="profit&loss.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"></i><br> profit and loss</a>
<a href="customerstatement.php?d1=0&d2=0&term=&nbsp;"><i class="icon-bar-chart icon-2x"></i><br> customer statements</a>
<a href="selectsupplier2.php"><font ><i class="icon-shopping-cart icon-2x"></i></font><br> supplier balance</a>

<div class="clearfix"></div>
</div>
</div>
</div>
</div>
</body>
<?php include('footer.php'); ?>
</html>
