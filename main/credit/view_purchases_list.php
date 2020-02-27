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
	require_once('auth.php');
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
</head><?php include('../connect.php');?>
<?php
	require_once('auth.php');
?>
<?php include('navfixed.php');?>
<body>
	

<div style="width:70%;align:center; left:20%;"><link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align:right;">
	<thead>
		<tr>
			<th width="50%">Generic Name </th>
			<th width="3%"> Qty </th>
			<th width="8%"> value </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$id=$_GET['iv'];
				$result = $db->prepare("SELECT * FROM purchases_item WHERE invoice= :userid");
				$result->bindParam(':userid', $id);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			<td><?php
			$rrrrrrr=$row['name'];
			$resultss = $db->prepare("SELECT * FROM products WHERE product_code= :asas");
			$resultss->bindParam(':asas', $rrrrrrr);
			$resultss->execute();
			for($i=0; $rowss = $resultss->fetch(); $i++){
			echo $rowss['product_code'] ."&nbsp;:".$rowss['gen_name'];
			}
			?></td>
			<td><?php echo $row['qty']; ?></td>
			<td>
			<?php
			$dfdf=$row['cost'];
			echo formatMoney($dfdf, true);
			?>
			</td>
			</tr>
			<?php
				}
			?>
			<tr>
				<td colspan="2"><strong style="font-size: 12px; color: #222222;">Total:</strong></td>
				<td><strong style="font-size: 12px; color: #222222;">
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
				$sdsd=$_GET['iv'];
				$resultas = $db->prepare("SELECT sum(cost) FROM purchases_item WHERE invoice= :a");
				$resultas->bindParam(':a', $sdsd);
				$resultas->execute();
				for($i=0; $rowas = $resultas->fetch(); $i++){
				$fgfg=$rowas['sum(cost)'];
				echo formatMoney($fgfg, true);
				}
				?>
				</strong></td>
			</tr>
		
	</tbody>
</table>
</div>
</body>
</html>