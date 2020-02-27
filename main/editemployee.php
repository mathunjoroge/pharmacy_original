<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM employees WHERE id= :userid");
	$result->bindParam(':userid', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveeditemployee.php" method="post">
<center><h4><i class="icon-edit icon-large"></i> Edit employee</h4></center>
<hr>

<div id="ac">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<span>Name: </span><input type="text" style="width:265px; height:30px;" name="a" value="<?php echo $row['name']; ?>" /><br>
<span>ID Number: </span><input type="text" style="width:265px; height:30px;" name="b" value="<?php echo $row['idno']; ?>" /><br>
<span>Qualifications : </span><input type="text" style="width:265px; height:30px;" name="c" value="<?php echo $row['qualifications']; ?>" /><br>
<span>Role : </span><input type="text" style="width:265px; height:30px;" name="d" value="<?php echo $row['role']; ?>" /><br>
<span>Gross Salary : </span><input type="text" style="width:265px; height:30px;" name="e" value="<?php echo $row['amount']; ?>" /><br>

<div style="float:right; margin-right:10px;">

<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save Changes</button>
</div>
</div>
</form>
<?php
}
?>