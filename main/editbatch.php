<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM batch WHERE id= :userid");
	$result->bindParam(':userid', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveeditbatch.php" method="post">
<center><h4><i class="icon-edit icon-large"></i> Edit batch</h4></center>
<hr>
<div id="ac">
<input type="hidden" name="memi" value="<?php echo $id; ?>" />
<input type="hidden" name="prod" value="<?php echo $row['product_id']; ?>" />
<input type="hidden" name="myqt" value="<?php echo $row['quantity']; ?>" />
<span>Batch No </span><input type="text" style="width:265px; height:30px;" name="batch" value="<?php echo $row['batch_no']; ?>" /><br>

<span>Expiry Date</span><input type="text" style="width:265px; height:30px;"  name="exp" value="<?php echo $row['expirydate']; ?>" /><br>
<span>Quantity: </span><input type="text" style="width:265px; height:30px;"  name="qty" value="<?php echo $row['quantity']; ?>" Required/>

<div style="float:right; margin-right:10px;">

<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save Changes</button>
</div>
</div>
</form>
<?php
}
?>
