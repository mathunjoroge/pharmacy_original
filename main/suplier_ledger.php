<html>
<head>
<title>
supplier Ledger
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
<body style="text-transform:capitalize;">

<?php include('navfixed.php');?>
	
	
	
	<div class="container">
      
	<div class="contentheader">
			<i class="icon-list"></i> Supplier Legder
			</div>
			<ul class="breadcrumb">
			<li><a href="index.php">Dashboard</a></li> /
			<li class="active">Supplier Legder</li>
			</ul>

<div id="maintable">
<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="statementslist.php"><button class="btn btn-success btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
</div>
<?php
include('../connect.php');
$tftft=$_GET['cname'];
$resulta = $db->prepare("SELECT * FROM supliers WHERE suplier_name= :a");
$resulta->bindParam(':a', $tftft);
$resulta->execute();
for($i=0; $rowa = $resulta->fetch(); $i++){
$name=$rowa['suplier_name'];

}
$resultas = $db->prepare("SELECT * FROM supliers WHERE suplier_name= :b");
$resultas->bindParam(':b', $name);
$resultas->execute();
for($i=0; $rowas = $resultas->fetch(); $i++){
echo 'Name : '.$rowas['suplier_name'].'<br>';
echo 'Address : '.$rowas['suplier_address'].'<br>';
echo 'Contact person: '.$rowas['suplier_contact'].'<br>';
echo 'Contact  '.$rowas['contact_person'].'<br>';
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
				$result = $db->prepare("SELECT * FROM payments WHERE name= :userid ORDER BY paymentid DESC Limit 10");
				$result->bindParam(':userid', $tftft);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			<td><?php echo $row['date2']; ?></td>
			<td><?php echo $row['type']; ?></td>
			<td><?php echo $row['confirm']; ?></td>
			<td><?php echo $row['amount2']; ?></td>
			
			</tr>
			<?php
				}
			?>
		
	</tbody>
</table>
<a rel="facebox" href="addsledger.php?invoice=<?php echo $_GET['cname']; ?>&amount=<?php echo $rowa['amount2']; ?>" style="margin-top: 10px;"><button class="btn btn-success"><i class="icon-plus-sign icon-large"></i> Add cash Payment</button></a><a rel="facebox" href="mpesa.php?invoice=<?php echo $_GET['cname']; ?>&amount=<?php echo $rowa['amount2']; ?>" style="margin-top: 10px;"><button class="btn btn-success"><i class="icon-plus-sign icon-large"></i> Add Mpesa Payment</button></a><a rel="facebox" href="bank.php?invoice=<?php echo $_GET['cname']; ?>&amount=<?php echo $rowa['amount2']; ?>" style="margin-top: 10px;"><button class="btn btn-success"><i class="icon-plus-sign icon-large"></i> Add  bank Payment</button></a><br><br>
<div class="clearfix"></div>
</div>
</body>
<?php include('footer.php');?>


</html>