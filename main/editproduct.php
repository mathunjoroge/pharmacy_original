<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveeditproduct.php" method="post">
<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM products WHERE product_id= :product_id");
	$result->bindParam(':product_id', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
		$_SESSION['supp']=$row['supplier'];
?>
<center><h4><i class="icon-edit icon-large"></i> Edit Product</h4></center>
<hr>
<div id="ac">
<input type="hidden" name="memi" value="<?php echo $id; ?>" />
Brand Name : <input type="text" style="width:265px; height:30px;"  name="code" value="<?php echo $row['product_code']; ?>" Required/><br>
<span>Generic Name : </span><input type="text" style="width:265px; height:30px;"  name="gen" value="<?php echo $row['gen_name']; ?>"/><br>
<span>buying Price : </span><input type="text" style="width:265px; height:30px;" id="txt2" name="o_price" value="<?php echo $row['o_price']; ?>" onkeyup="sum();" Required/><br>
<span>retail price: </span><input type="text" style="width:265px; height:30px;"  name="price" value="<?php echo $row['price']; ?>" onkeyup="sum();" Required/><br>
<span>wholesale price:</span><input type="text" id="" style="width:265px; height:30px;" name=" wholesaleprice" placeholder="" onkeyup="sum();" value="<?php echo $row['wholesaleprice']; ?>" Required><br>
<span>max discount retail:</span><input type="text" id="" style="width:265px; height:30px;" name="maxr"  onkeyup="sum();" value="<?php echo $row['maxdiscre']; ?> %" Required><br>
<span> </span><input type="hidden" style="width:265px; height:30px;" min="0" name="sold" value="<?php echo $row['instock']; ?>" /><br>
<span>quantity left </span><input type="number" style="width:265px; height:30px;" min="0" name="qtyl" value="<?php echo $row['qty']; ?>" /><br>
<span>Re-order Level </span><input type="number" style="width:265px; height:30px;" min="0" name="level" value="<?php echo $row['level']; ?>" /><br>
<div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save Changes</button>
</div>
</div>
</form>
<?php
}
?>

