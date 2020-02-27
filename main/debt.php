<?php
require_once('auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<title>
Accounts Receivable
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
   docprint.document.write('</head><body onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
</head>
<body>
<?php
	include('navfixed.php');
?>
	
	
	<div class="container-fluid">
      <div class="row-fluid">
	<div class="span2">
          <div class="well sidebar-nav">
                  <ul class="nav nav-list">
              <li><a href="#"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li> 
				<li><a href="salesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"></i> Sales Report</a>							</li>
				<li><a href="collection.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"></i> Collection Report</a>                     </li>
				<li class="active"><a href="accountreceivables.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"></i> Accounts Receivable Report</a>    </li>
				<li><a rel="facebox" href="select_customer.php"><i class="icon-user icon-2x"></i> Customer Ledger</a>                   </li>
				<li><a href="products.php"><i class="icon-table icon-2x"></i> Products</a>                                              </li>
				<li><a href="customer.php"><i class="icon-group icon-2x"></i> Customers</a>                                             </li>
				<li><a href="supplier.php"><i class="icon-group icon-2x"></i> Suppliers</a>                                             </li>
				<li><a href="purchaseslist.php"><i class="icon-inbox icon-2x"></i> Purchases</a></li>
				</ul>              
          </div><!--/.well -->
        </div><!--/span-->
	<div class="span10">
	<div class="contentheader">
			<i class="icon-bar-chart"></i> Account Receivables Report
			</div>
			<ul class="breadcrumb">
			<li><a href="index.php">Dashboard</a></li> /
			<li class="active">Account Receivables Report</li>
			</ul>


<div id="maintable">
<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="index.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
</div>
<form action="debt.php" method="get">
	<input class="form-control" placeholder="customer" name="term" id="srch-term" type="text"  >
 <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;" type="submit"><i class="icon icon-search icon-large"></i> Search</button>


</form>
<div class="content" id="content">
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			
			<th width="15%"> Date </th>
			
			<th width="15%"> Invoice Number </th>
			
			<th width="15%"> Due Date </th>
			<th width="15%"> Amount Due </th>
			
			
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				
				$c='credit';
				$d='paid';
if (!empty($_REQUEST['term'])) {

$term = mysql_real_escape_string($_REQUEST['term']);}
				$result = $db->prepare("SELECT * FROM sales WHERE type=:c  AND name LIKE '%".$term."%'  ORDER BY `date` ASC");
				$d='paid';
				$result->bindParam(':c', $c);
				
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
				<td><?php echo $row['date']; ?></td>
			<td><?php echo $row['invoice_number']; ?></td>
			
			
			<td><?php echo $row['due_date']; ?></td>
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
			<th colspan="2" style="border-top:1px solid #999999"> Total : </th>
			<th colspan="1" style="border-top:1px solid #999999"> 
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
				
				$c='credit';
				$results = $db->prepare("SELECT sum(amount) FROM sales WHERE type=:c  AND name LIKE '%".$term."%' ORDER BY `name` ASC");
				
				$results->bindParam(':c', $c);
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

</div>
<div class="clearfix"><button  style="width: 123px; height:35px; margin-top:-2px; float:right;" class="btn btn-success btn-large"><a href="javascript:Clickheretoprint()"><i class="icon icon-print icon-large"></i> Print</a></button></div>
</div>
</body>
<?php include('footer.php');?>

</html>