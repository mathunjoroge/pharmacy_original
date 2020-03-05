<?php
require_once('auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>
Products
</title>


 <link href="css/bootstrap.css" rel="stylesheet">
   <script src="vendors/jquery-1.7.2.min.js"></script>
    <script src="vendors/bootstrap.js"></script>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />


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
<script src="jeffartagame.js" type="text/javascript" charset="utf-8"></script>
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

<script>
function sum() {
            var txtFirstNumberValue = document.getElementById('txt1').value;
            var txtSecondNumberValue = document.getElementById('txt2').value;
            var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt3').value = result;
				
            }
			
			 var txtFirstNumberValue = document.getElementById('txt11').value;
            var result = parseInt(txtFirstNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt22').value = result;				
            }
			
			 var txtFirstNumberValue = document.getElementById('txt11').value;
            var txtSecondNumberValue = document.getElementById('txt33').value;
            var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt55').value = result;
				
            }
			
			 var txtFirstNumberValue = document.getElementById('txt4').value;
			 var result = parseInt(txtFirstNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt5').value = result;
				}
			
        }
</script>
<body>
<?php include('navfixed.php');?>

			 <div class="hero-unit-clock"></ul>             
          </div><!--/.well -->
        </div><!--/span-->
        <div class="container">

	<div class="contentheader">
			<i class="icon-table"></i> Products
			</div>
			<ul class="breadcrumb">
			<li><a href="index.php">Dashboard</a></li> /
			<li class="active">Products</li>
			</ul>
<div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="index.php"><button class="btn btn-success btn-large" style="float: left;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a><div style="margin-top: -19px; margin-bottom: 21px;">

<a  href="categories.php"><button class="btn btn-success btn-large" style="float: right;">add category</button>&nbsp;</a></span>
			<?php 
			include('../connect.php');
				$result = $db->prepare("SELECT * FROM products WHERE `active`=1 ORDER BY qty DESC");
				$result->execute();
				$rowcount = $result->rowcount();
			?>
			
			<?php 
			include('../connect.php');
				$result = $db->prepare("SELECT * FROM products where qty < level AND  `active`=1 ORDER BY product_id DESC");
				$result->execute();
				$rowcount123 = $result->rowcount();

			?>
				<div style="text-align:center;">
			Total Number of Products:  <font color="green" style="font:bold 22px 'Aleo';">[<?php echo $rowcount;?>]</font>
			</div>
			<?php if ($rowcount123>0) {
				# code...
			?>
			
			<div style="text-align:center;">
			<font style="color:rgb(255, 95, 66); font:bold 22px 'Aleo';"><?php echo $rowcount123;?></font><a rel="facebox" href="level.php">  <button class="btn btn-primary">Low running products</button></a>
			</div><?php } ?>
</div><div class="container" align="center">
<input type="text" style="padding:0.8em;" name="filter" value="" id="filter" placeholder="Search Product..." autocomplete="off" />
<a rel="facebox" href="addproduct.php"><Button type="submit" class="btn btn-info" style="float:right; width:230px; height:35px;" /><i class="icon-plus-sign icon-large"></i> Add Product</button></a><br><br>
<table class="hoverTable" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="12%"> Brand Name </th>
			<th width="14%"> Generic Name </th>
			<th width="6%"> buying Price </th>
			<th width="6%"> Selling Price </th>
			<th width="6%"> wholesale price </th>
			<th width="6%"> maximun retail discount </th>
			<th width="6%"> opening stock </th>
			<th width="5%"> Qty Left </th>
			<th width="5%"> Reorder Level </th>
			<th width="8%"> Value </th>
			<th width="8%"> Action </th>
		</tr>
	</thead>
	<tbody>
		
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
				include('../connect.php');
				$start=0;
				$limit=1000;
					if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
else{
	$id=1;
}
				$result = $db->prepare("SELECT *, o_price * qty as total FROM products WHERE `active`=1 LIMIT $start, $limit");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
				$total=$row['total'];
				$reorder=$row['level'];
				$availableqty=$row['qty'];
				if ($availableqty<$reorder) {
				echo '<tr class="record">';
				}
				else {
				echo '<tr class="record">';
				}
			?>
			<td><?php echo $row['product_code']; ?></td>
			<td><?php echo $row['gen_name']; ?></td>
	        <td><?php
			$oprice=$row['o_price'];
			echo formatMoney($oprice, true);
			?></td>
			<td><?php echo $row['price']; ?></td>
			<td><?php
			$pprice=$row['wholesaleprice'];
			echo formatMoney($pprice, true);
			?></td>
			<td><?php if (isset($row['maxdiscpr'])) {
				echo $row['maxdiscpr']."%";
				# code...
			}  ?></td>
			<td><?php echo $row['instock']; ?></td>
			<td><?php echo $row['qty']; ?></td>
			<td><?php echo $row['level']; ?></td>
			<?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='admin') {
?>			
			<td>
			<?php
			$total=$row['total'];
			echo formatMoney($total, true);
			?>
			</td><td><a rel="facebox" title="Click to edit the product" href="editproduct.php?id=<?php echo $row['product_id']; ?>"><button class="btn btn-warning"><i class="icon-edit"></i> </button> </a>
			<a href="deleteproduct.php?id=<?php echo $row['product_id']; ?>" title="Click to Delete the product"><button class="btn btn-danger"><i class="icon-trash"></i></button></a></td>
			</tr>
			<?php }
				
			?>
			<?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='pharmacist') {
?>			
			<td>
			&nbsp;
			</td><td>&nbsp;</td>
			</tr>
			<?php } }
				
			?>	
		
	</tbody>
</table>
<?php

			include('../connect.php');
				$result = $db->prepare("SELECT * FROM products WHERE `active`=1   ORDER BY product_id DESC");
				$result->execute();
				$rowcount123 = $result->rowcount();

			
//calculate total page number for the given table in the database 
$total=ceil($rowcount123/$limit); ?>
<ul >
<?php if($id>1)
{
	//Go to previous page to show previous 10 items. If its in page 1 then it is inactive
	echo "<button class='btn btn-primary'><a href='?id=".($id-1)."' class='button'>PREVIOUS</a></button>";
}
?>

<?php
if($id!=$total)
{
	////Go to previous page to show next 10 items.
	echo "<button class='btn btn-primary'><a href='?id=".($id+1)."' class='button'>NEXT</a></button>";
}
?>



<div class="clearfix"></div>
</div>
</div>
</div>

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
 if(confirm("Sure you want to delete this Product? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "deleteproduct.php",
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
</body>
<?php include('footer.php');?>

</html>
