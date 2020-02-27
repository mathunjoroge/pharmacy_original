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
      disp_setting+="scrollbars=yes,width=700, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><h3 align="center">M&C pharmacy</h3><h3 align="center">profit and loss account</h3><body onLoad="self.print()" style="width: 700px; font-size:auto; font-family:arial; font-weight:normal;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
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
<div class="container-fluid">
     
	<div class="container">
	<div class="contentheader">
			<i class="icon-bar-chart"></i> profit and loss
			</div>
			<ul class="breadcrumb">
			
			<li class=""></li>
			</ul>

<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="statementslist.php"><button class="btn btn-success btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
</div>
<form action="profit&loss.php" method="get">
<center><strong>From : <input type="text" style="width: 223px; height:10px; padding:14px;" name="d1" class="tcal" autocomplete="off" /> To: <input type="text" style="width: 223px; padding:14px;height:10px;" name="d2" class="tcal" autocomplete="off" />
 <button class="btn btn-success" style="width: 123px; height:30px; margin-top:-8px;margin-left:8px;" type="submit"><i class="icon icon-search icon-large"></i> submit</button>
</strong></center>
</form><div id="content">

<div class="content">
<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
profit and loss from&nbsp;<?php $date = $_GET['d1'] ;
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
		<th width="13%"> &nbsp;</th>
			<th width="13%"> &nbsp; </th>			
			
			<th width="16%"> &nbsp; </th>
			<th width="18%"> total sales </th>
			<th width="13%"> gross Profit </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
			    $d1=date('Y-m-d',strtotime($_GET['d1']))." 00:00:00"; 
				$d2=date('Y-m-d',strtotime($_GET['d2']))." 59:59:59"; 
				include('../connect.php');               
				$result = $db->prepare("SELECT * FROM sales WHERE date>=:a AND date<=:b ORDER by transaction_id DESC ");
				$result->bindParam(':a', $date1);
				$result->bindParam(':b', $date2);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			
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
				$results = $db->prepare("SELECT sum(amount) FROM sales WHERE date>=:a AND date<=:b");
				$results->bindParam(':a', $d1);
				$results->bindParam(':b', $d2);
				$results->execute();
				for($i=0; $rows = $results->fetch(); $i++){
				$dsdsd=$rows['sum(amount)'];
				echo formatMoney($dsdsd, true);
				}
				?>
			</th>
				<th colspan="1" style="border-top:1px solid #999999">
			<?php 
				$resultia = $db->prepare("SELECT sum(profit) FROM sales WHERE date>=:a AND date<=:b");
				$resultia->bindParam(':a', $d1);
				$resultia->bindParam(':b', $d2);
				$resultia->execute();
				for($i=0; $ab = $resultia->fetch(); $i++){
				$cd=$ab['sum(profit)'];
				echo formatMoney($cd, true);
				}
				?>
		
				</th>
		</tr>
	</thead>
</table>
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
		<th width="13%"> &nbsp;</th>
			<th width="13%"> &nbsp; </th>			
			
			<th width="16%"> &nbsp; </th>
			<th width="18%"> total expiries </th>
			<th width="13%"> &nbsp; </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
                $date2 = date ('Y-m-d' , $date2);               
				$result = $db->prepare("SELECT * FROM sales WHERE date>=:a AND date<=:b ORDER by transaction_id DESC ");
				$result->bindParam(':a', $d1);
				$result->bindParam(':b', $d2);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			
			</tr>
			<?php
				}
			?>
		
	</tbody>
	<thead>
		<tr>
			<th colspan="3" style="border-top:1px solid #999999"> Total expiries: </th>
			<th colspan="1" style="border-top:1px solid #999999"> 
			<?php
				$results = $db->prepare("SELECT sum(amount) FROM expiriestt WHERE date>=:a AND date<=:b");
				$results->bindParam(':a', $d1);
				$results->bindParam(':b', $d2);
				$results->execute();
				for($i=0; $rows = $results->fetch(); $i++){
				$expiries=$rows['sum(amount)'];
				echo formatMoney($expiries, true);
				}
				?>
			</th>
				<th colspan="1" style="border-top:1px solid #999999">&nbsp
		
				</th>
		</tr>
	</thead>
</table>
</div><h4>expenses</h4>
<div><table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
		<th width="13%"> Transaction Date </th>
			<th width="13%"> expense </th>			
			<th width="16%"> entered by </th>
			<th width="18%"> Amount </th>
		</tr>
	</thead>
	<tbody>
		<?php
				include('../connect.php');
				$result = $db->prepare("SELECT * FROM expenses WHERE date>=:a AND date<=:b ORDER by id DESC ");
				$result->bindParam(':a', $d1);
				$result->bindParam(':b', $d2);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			<td><?php 
			$date = $row['date'];
                $d11 = strtotime ( $date ) ;
                $d11 = date ( 'j/m/Y' , $d11 );
                echo $d11;
                 ?></td>
			<td><?php echo $row['name']; ?></td>
			
			
			<td><?php echo $row['recorded']; ?></td>
			<td><?php
			$dsdsd=$row['amount'];
			echo formatMoney($dsdsd, true);
			?></td>
			
			</tr>
			<?php
				}
			?>
		
	</tbody>
	<thead>
		<tr>
			<th colspan="3" style="border-top:1px solid #999999"> Total expenses: </th>
			<th colspan="1" style="border-top:1px solid #999999"> 
			<?php
				$results = $db->prepare("SELECT sum(amount) AS amount FROM expenses WHERE date>=:a AND date<=:b");
				$results->bindParam(':a', $d1);
				$results->bindParam(':b', $d2);
				$results->execute();
				for($i=0; $rows = $results->fetch(); $i++){
				$ef=$rows['amount'];
				echo formatMoney($ef, true);
				}
				?>
			</th>
				
		</tr>
	</thead>
</table></div><h4>salaries</h4><div><table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
		<th width="13%"> Transaction Date </th>
			<th width="13%"> employee </th>		
			<th width="18%"> Amount </th>
			<th width="16%"> remarks </th>			
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$result = $db->prepare("SELECT * FROM salaries WHERE date>=:a AND date<=:b ORDER by id DESC ");
				$result->bindParam(':a', $d1);
				$result->bindParam(':b', $d2);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			<td><?php $date = $row['date'];
                $d11 = strtotime ( $date ) ;
                $d11 = date ( 'j/m/Y' , $d11 );
                echo $d11; ?></td>
			<td><?php echo $row['employee']; ?></td>
			<td><?php
			$dsdsd=$row['amount'];
			echo formatMoney($dsdsd, true);
			?></td>
			<td><?php echo $row['rmks']; ?></td>
			
			</tr>
			<?php
				}
			?>
		
	</tbody>

	<thead>
		<tr>
			<th colspan="3" style="border-top:1px solid #999999"> Total salaries paid: </th>
			<th colspan="1" style="border-top:1px solid #999999"> 

			<?php
				$results = $db->prepare("SELECT sum(amount) FROM salaries WHERE date>=:a AND date<=:b");
				$results->bindParam(':a', $d1);
				$results->bindParam(':b', $d2);
				$results->execute();
				for($i=0; $rows = $results->fetch(); $i++){
				$gh=$rows['sum(amount)'];
				echo formatMoney($gh, true);
				}
				?><?php $texp=$gh+$ef+$expiries; $netprofit=$cd-$texp;  ?>
			</th>
		</tr>
	</thead>
	<thead>
		<tr>
			<th colspan="3" style="border-top:1px solid #999999"> net profit </th>
			<th colspan="1" style="border-top:1px solid #999999"> 

			<?php
				echo formatMoney($netprofit, true);
				?>
			</th>
				
		</tr>
	</thead>
</table>
<?php $texp=$gh+$ef+$expiries; $netprofit=$cd-$texp;  ?>
<h4>summary</h4><div><table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
					
		</tr>
	</thead>
	<thead>
		<tr>
			<th colspan="3" style="border-top:1px solid #999999"> gross profit </th>
			<th colspan="1" style="border-top:1px solid #999999"> <?php echo formatMoney($cd, true); ?>
				
			</th>
		</tr>
	</thead>
	<thead>
		<tr>
			<th colspan="3" style="border-top:1px solid #999999"> less expenses </th>
			<th colspan="1" style="border-top:1px solid #999999"> <?php echo formatMoney($ef, true); ?>
				
			</th>
		</tr>
	</thead>
	<thead>
		<tr>
			<th colspan="3" style="border-top:1px solid #999999"> less salaries </th>
			<th colspan="1" style="border-top:1px solid #999999"> <?php echo formatMoney($gh, true); ?>
				
			</th>
		</tr>
	</thead><thead>
		<tr>
			<th colspan="3" style="border-top:1px solid #999999"> less expiries </th>
			<th colspan="1" style="border-top:1px solid #999999"> <?php echo formatMoney($expiries, true); ?>
				
			</th>
		</tr>
	</thead>
	<thead>
		<tr>
			<th colspan="3" style="border-top:1px solid #999999"> net profit </th>
			<th colspan="1" style="border-top:1px solid #999999"> 

			<?php
				echo formatMoney($netprofit, true);
				?>
			</th>
				
		</tr>
	</thead>
</table></div></div></div>

<div class="clearfix"><button  style="float:right;" class="btn btn-success btn-large"><a href="javascript:Clickheretoprint()"> Print</button></a></div>
</div>
</div>
</div></div>

</body>
<script src="js/jquery.js"></script>
<?php include('footer.php');?>
</html>