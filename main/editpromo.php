<?php
	include('../connect.php');
	$id=$_GET['id'];
	$reason=$_GET['reason'];
	$promqty=$_GET['promqty'];
	$promno=$_GET['promno'];
		
?>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="savereason.php" method="post">
<center><h4><i class="icon-edit icon-large"></i> Edit promotion</h4></center>
<hr>
<div id="ac">
<input type="hidden" name="product" value="<?php echo $id; ?>" />
<span>qty to buy </span><input type="text" style="width:265px; height:30px;"  name="qtybuy" value="<?php echo $promqty; ?>" required/><br>
<span>qty to get </span><input type="text" style="width:265px; height:30px;"  name="qtyfree" value="<?php echo $promno; ?>" required/><br>
<span>reason</span><input type="text" style="width:265px; height:30px;"  name="reason" value="<?php echo $reason; ?>" required/><br>
<div style="float:left; margin-right:10px;">

<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save Changes</button>
</div>
</div>
</form>


