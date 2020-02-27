<?php
require_once('auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

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
<a  href="index.php"><button class="btn btn-success btn-large" style="float: left;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
<?php include('../connect.php');
             //select hospital details
                 $result = $db->prepare("SELECT * FROM settings");
                $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $name=$row['name'];
        $address=$row['address'];
        $phone=$row['phone'];
        $slogan=$row['slogan']; 

    }
         ?>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                    	<?php 
                    	if (!isset($name)) {
                    	 	# code...
                    	?>&nbsp;
                    	 <a rel="facebox" href="addpharmacy.php">
  <button  class="btn btn-primary" style="border-radius: 2px;">add pharmacy details</button></a>
      
      <?php } ?>
<?php 
if (isset($name)) {
	# code...
?>&nbsp;
<a rel="facebox" href="editpharmacy.php?name=<?php echo $name; ?>&phone=<?php echo $phone; ?>&slogan= <?php echo $slogan; ?>&address=<?php echo $address; ?>">
  <button  class="btn btn-primary" style="border-radius: 2px;">edit pharmacy details</button></a>			

	<div class="contentheader"><?php } ?>
			
			</div>
			
			<font style=" font:bold 44px 'Aleo'; text-shadow:1px 1px 25px #000; color:green;"><center>admin tools</center></font>
<div id="mainmain">




<a href="expenseslist2.php"><font ><i class="icon-shopping-cart icon-2x"></i></font><br> expenses</a> 


<a href="statementslist.php"><font ><i class="icon-bar-chart icon-2x"></i></font><br> Statements and reports</a>

<a href="user.php"><font ><i class="icon-group icon-2x"></i></font><br> users</a>

<a href="../expiries/expiry.php?id=cash&invoice=<?php echo $finalcode ?>"><i class="icon-bar-chart icon-2x"></i><br> expiries</a>
<a href="expiriesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"></i><br> expiries report</a>
<a href="sales_inventory.php"><i class="icon-bar-chart icon-2x"></i><br> deletesales</a>
<div class="clearfix"></div>
</div>
</div>
</div>
</div>
</body>
<?php include('footer.php'); ?>
</html>
