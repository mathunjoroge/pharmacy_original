<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM returns WHERE transaction_id= :userid");
	$result->bindParam(':userid', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
		$am=$row['amount'];
		$qt=$row['qty'];
		$inv=$row['invoice'];
		$prod=$row['product'];
		$myqt=$row['qty'];
		$price=$row['price'];
?>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveeditreturn.php" method="post">
<center><h4><i class="icon-edit icon-large"></i> Edit return</h4></center>
<hr>
<div id="ac">
<input type="hidden" name="prod" value="<?php echo $prod; ?>" />
	<input type="hidden" name="invoice" value="<?php echo $inv; ?>" />
	<input type="hidden" name="myqt" value="<?php echo $myqt; ?>" />
	<input type="hidden" name="memi" value="<?php echo $id; ?>" />
<span> </span><input type="hidden" style="width:265px; height:30px;"  name="prod" value="<?php echo $row['product']; ?>" readonly/><br>
<span>quantity </span><input type="text" style="width:265px; height:30px;"  name="qty" value="<?php echo $row['qty']; ?>" /><br>
<span> price</span><input type="text" style="width:265px; height:30px;"  name="price" value="<?php echo $row['price']; ?>" /><br>
<div style="float:left; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save Changes</button>
</div>
</div>
</form>
<?php
}
?>
