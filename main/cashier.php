 <html>
<?php
	require_once('auth.php');
?>
<head>
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

<title>

cashier
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
      disp_setting+="scrollbars=yes,width=700, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><h4 align="center">Winsor Pharmacy</h4><body onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;">');          
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
			<i class="icon-bar-chart"></i> unpaid transactions
			</div>
			<ul class="breadcrumb">
			<li><p>&nbsp;</p></li> 
			<li class="active">&nbsp;</li>
			</ul>

<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="cashierindex.php"><button class="btn btn-success btn-large" style="float: none;"><i class="icon icon-home icon-large"></i> home</button></a>


</div>
<form action="cashsave.php" method="get">
</form>

<table class="table table-bordered" id="resultTable" align="center" data-responsive="table" style="text-align: left;width: 50%;">
	<thead>
		<tr>
		<th width="">  Date </th>
		<th width=""> served by </th>
		<th width=""> total</th>
		<th width=""> tendered amount</th>
			
			
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$a='cash';
				$b=0;				
				$result = $db->prepare("SELECT *  FROM sales WHERE `type`=:cash AND  `paid`=:b ORDER BY transaction_id ASC ");
			$result->bindParam(':cash', $a);
			$result->bindParam(':b', $b);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			<td><?php $date = $row['date'];
                $d11 = strtotime ( $date ) ;
                $d11 = date ( 'j/m/Y' , $d11 );
                echo $d11;?></td>
			
			
			
			<td><?php echo $row['cashier']; ?></td>
			<td><a rel="facebox" href="checkcash.php?pt=<?php echo $row['transaction_id'] ?>&invoice=<?php echo $row['invoice_number'] ?>&total=<?php echo $row['amount'] ?>&totalprof=<?php echo $row['profit'] ?>&cashier=<?php echo $row['cashier'] ?>"><u><?php
			$dsdsd=$row['amount'];
			echo formatMoney($dsdsd, true);
			?></u></a></td>
			<td><?php
			$dsdsdd=$row['cashtendered'];
			echo formatMoney($dsdsdd, true);
			?></td>
			
			</tr>
			<?php
				}
			?>
		
	</tbody>
	<thead>
		<tr>
			<th colspan="3" style="border-top:1px solid #999999"> Total: </th>
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
				$a='cash';
				$b=0;
				$results = $db->prepare("SELECT sum(amount) FROM sales WHERE  `type`=:cash AND paid=:b");
				$results->bindParam(':cash',$a);
				$results->bindParam(':b',$b);
				$results->execute();
				for($i=0; $rows = $results->fetch(); $i++){
				$dsdsd=$rows['sum(amount)'];
				echo formatMoney($dsdsd, true);
				}
				?>
			</th>
				
		</tr>
	</thead>
</table>

<button  style="float:left;" class="btn btn-success btn-large"><a href="selecustomer.php"> customer payment</button></a>
</div><div class="clearfix"></div>
</div>
</div>
</div>

</body>
<script src="js/jquery.js"></script>
  <script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this update? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "deleteexpiriestt.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<?php include('footer.php');?>
</html>