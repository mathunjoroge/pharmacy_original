<?php
require_once('auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><html>
<head>
	<!-- js -->
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script><head>

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
<!--sa poip up-->

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
			<i class="icon-bar-chart"></i> Stock card
			</div>
			<ul class="breadcrumb">
			<li><p>&nbsp;</p></li> 
			<li class="active">&nbsp;</li>
			</ul>

<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="inventory.php"><button class="btn btn-success btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>


</div>
<div class="container">
	

<form action="testing.php" method="get" >


<select autofocus name="term" style="width:430px;font-size:0.8em;" class="chzn-select" id="mySelect">
<option></option>
<?php include '../connect.php';
$result = $db->prepare("SELECT* FROM products ");
$result->execute();
?>
    <?php for ($i = 0; $row = $result->fetch(); $i++): ?>
    <option value="<?php echo $row['product_id']; ?>" >
        <?=$row['gen_name'];?> -
            <?=$row['product_code'];?>
    </option>
<?php endfor;?>
</select>
<strong>From : <input type="text" style="width: 150px; padding:14px;" name="d1" class="tcal" value="" /> To: <input type="text" style="width: 150px; padding:14px;" name="d2" class="tcal" value="" /></span>
 <button class="btn btn-info" style="width: 150px; height:35px; margin-top:-8px;margin-left:8px;" type="submit"><i class="icon icon-search icon-large"></i>Generate</button>
</strong>
</form><div class="content" id="content">
	<?php
			include('../connect.php');
			$gen=$_GET['term'];
				$result = $db->prepare("SELECT* FROM products WHERE product_id=:generic");
				$result->bindParam(':generic', $gen);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
				$gname=$row['gen_name'];
				$bname=$row['product_code']; ?>
			<?php
				}
			?>
<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
<center>generated bincard for <?php echo $bname; ?>: <?php echo $gname; ?></div>
<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">from&nbsp;<?php $date = $_GET['d1'] ;
                $d11 = strtotime ( $date ) ;
                $d11 = date ( 'j/m/Y' , $d11 );
                echo $d11; ?>&nbsp;to&nbsp;<?php $date = $_GET['d2'] ;
                $d112 = strtotime ( $date ) ;
                $d112 = date ( 'j/m/Y' , $d112 );
                echo $d112;  ?>
</center></div>
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;width: 80%;">
	<thead>
		<tr>
		
			<th > Date </th>
			<th > Dispensed/Received </th>
			<th >&nbsp;</th>
			<th > qty </th>
			<th > balance </th>
		</tr>
	</thead>
	<tbody>
		<tr class="record"> <?php
			include('../connect.php');
			$gen=$_GET['term'];
				$result = $db->prepare("SELECT product_id, instock, datep  FROM products WHERE product_id=:generic");
				$result->bindParam(':generic', $gen);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){ ?>
			<td><?php $date = $row['datep']; 
			$d11 = strtotime ( $date ) ;
                $d11 = date ( 'j/m/Y' , $d11 );
                echo $d11; ?></td>
			<td>initial stock</td>
			<td>&nbsp;</td>			
			<td><strong><?php echo''; ?></strong></td>
			<td><?php echo $row['instock']; ?></td> 
			
			</tr><?php
				}
			?>
		
			<?php
				include('../connect.php');
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				$gen=$_GET['term'];
				$result = $db->prepare("SELECT *  FROM sales_order RIGHT OUTER JOIN products ON products.product_id=sales_order.product WHERE product=:generic AND date BETWEEN :a AND :b ORDER by transaction_id ASC ");
				$result->bindParam(':a', $d1);
				$result->bindParam(':b', $d2);
				$result->bindParam(':generic', $gen);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			
			
		
	</tbody>
	<tr class="record">
			<td><?php $date = $row['date']; 
			$d11 = strtotime ( $date ) ;
                $d11 = date ( 'j/m/Y' , $d11 );
                echo $d11; ?></td>
			<td><?php echo ''; ?></td>
			<td><?php echo ''; ?></td>
			<td><?php echo $row['quantity']; ?></td>
			<td><?php echo $row['balance']; ?></td>
			<?php } ?>
			
			</tr>
			
		
	</tbody>
</table>
<?php include 'footer.php'; ?>
</html>