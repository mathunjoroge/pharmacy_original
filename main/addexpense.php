<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveexpense.php" method="post">
<center><h4><i class="icon-plus-sign icon-large"></i> record expense</h4></center>
<hr>
		
<div id="ac">
<span> </span><input type="hidden" style="width:265px; height:30px;" name="dt" value="<?php $date = date('Y-m-d');
                $d11 = strtotime ( $date ) ;
                $d11 = date ('Y-m-d' , $d11);
                echo $d11; ?>" Required/><br>


<select  style="width:265px; height:30px;"  name="exp"><option></option>
			<?php
	include('../connect.php');
	
	$result = $db->prepare("SELECT * FROM expenselist");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['name'];?>"><?php echo $row['name']; ?>  </option>
	<?php
				}
			?><br>

<span>amount </span><input type="number" style="width:265px; height:30px;" name="amt" placeholder="amount"/><br>
<div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save</button>
</div>
</div>
</form>