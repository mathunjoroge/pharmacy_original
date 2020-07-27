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
$finalcode=createRandomPassword();
?>
</head>
<body>
<?php include('navfixed.php');?>
	

				</ul>                               
          </div><!--/.well -->
        </div><!--/span-->
        <div class="container">

	<div class="contentheader">
			
			</div>
			<?php
	include('../connect.php');
	$result = $db->prepare("SELECT * FROM settings");
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
			$name=$row['name']; 
	?>
			
			<font style=" font:bold 44px 'Aleo'; text-shadow:1px 1px 25px #000; color:green;"><center><?php echo $name; ?></center></font> <?php } ?>
<div id="mainmain">
	<?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='cashier') { 
	header("location:cashierindex.php");
 
?>
<?php } ?>
<?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='pharmacist') {
?>
<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><font color="green"><i class="icon-user-md icon-2x"></i><br> Sales</a>               
<a href="products.php"><i class="icon-list-alt icon-2x"></i><br> Drugs</a>      
<a href="customer.php"><i class="icon-group icon-2x"></i><br> customers</a>     
<a href="supplier.php"><i class="icon-group icon-2x"></i><br> Suppliers</a>
<a href="../purchases/purchase.php?id=cash&invoice=<?php echo $finalcode ?>"><font ><i class="icon-shopping-cart icon-2x"></i></font><br> record Purchase</a> 
<a href="../wholesale/sales.php?id=cash&invoice=<?php echo $finalcode ?>"><font ><i class="icon-shopping-cart icon-2x"></i></font><br> wholesale</a><?php
  $Today = date('m/d/y',time());
  $new = date('m/d/20y', strtotime($Today));
  ?>
<a href="cashhh.php?d1=<?php echo $new; ?>&d2=<?php echo $new; ?>"><i class="icon-money icon-2x"></i><br>today's cash</a>     
<?php
}
?>
	<?php
if($position=='admin') {
?>
<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><font color="green"><i class="icon-money icon-2x"></i><br> Sales</a>               
<a href="products.php"><i class="icon-list-alt icon-2x"></i><br> Drugs</a>      
<a href="customer.php"><i class="icon-group icon-2x"></i><br> customers</a>     
<a href="supplier.php"><i class="icon-group icon-2x"></i><br> Suppliers</a>     
<a href="../purchases/purchase.php?id=cash&invoice=<?php echo $finalcode ?>"><font ><i class="icon-shopping-cart icon-2x"></i></font><br> Record Purchase</a> 
<a href="../wholesale/sales.php?id=cash&invoice=<?php echo $finalcode ?>"><font ><i class="icon-shopping-cart icon-2x"></i></font><br>wholesale</a>
<a href="#"><font ><i class="icon-cogs icon-2x"></i></font><br> settings</a>
<a href="inventory.php"><font ><i color="green" class="icon-desktop icon-2x"></i></font><br> inventory adjustments</a>
<a href="admin.php"><font ><i class="icon-user icon-2x"></i></font><br> Admin</a>
<?php
  $Today = date('m/d/y',time());
  $new = date('m/d/20y', strtotime($Today));
  ?>
<a href="cashhh.php?d1=<?php echo $new; ?>&d2=<?php echo $new; ?>"><i class="icon-money icon-2x"></i><br>today's cash</a> 

<?php } ?>


<div class="clearfix"></div>
</div>
</div>
</div>
</div>
</body>
<?php include('footer.php'); ?>
</html>
