<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="sales.php?id=22" method="post">
<center><h4><i class="icon-plus-sign icon-large"></i> Add Purchase</h4></center>
<p><h4 style="text-align:center;">Enter the supplier details and click save</h4></p>
<hr>
<div style="text-align:center;">
<div id="ac">
		<?php
			$Today = date('d/m/20y',mktime());
			$new = date('l, F d, Y', strtotime($Today));
		
				?>

<span>Date: <br></span><input style="width:265px; height:30px;" name="date" value="<?php echo "$Today"; ?>" /><br>
<span>Invoice Number: </span><input type="text" style="width:265px; height:30px;" name="iv" /><br>


<span>Supplier : </span>
<select name="supplier" style="width:265px; height:30px;">
	<?php
	include('../connect.php');
	$result = $db->prepare("SELECT * FROM supliers");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option><?php echo $row['suplier_name']; ?></option>
	<?php
	}
	?>
</select><br>
<span>Remarks<br> </span><input type="text" style="width:265px; height:30px;" name="remarks" /><br>

<span>purchase_type:<br> </span><select name="purchase_type" type="text" style="width:265px; height:30px;"><option>credit</option><option>Cash</option><option>offset</option></select><br>
<span>&nbsp;</span><input id="btn" type="submit" value="save" />
</div>
</div>
</form>