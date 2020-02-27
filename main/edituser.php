<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM user WHERE id= :userid");
	$result->bindParam(':userid', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveedituser.php" method="post">
<center><h4><i class="icon-edit icon-large"></i> Edit user</h4></center>
<hr>

<div id="ac">
<input type="hidden" name="memi" value="<?php echo $id; ?>" />
<span>username: </span><input type="text" style="width:265px; height:30px;" name="a" value="<?php echo $row['username']; ?>" /><br>
<span>password: </span><input type="password" style="width:265px; height:30px;" name="b" placeholder="new password"  required /><br>
<span>Contact : </span><input type="text" style="width:265px; height:30px;" name="c" value="<?php echo $row['contact']; ?>" /><br>
<span> </span><input type="hidden" style="width:265px; height:30px;" name="d" value="<?php echo $row['name']; ?>" /><br>
<span>position : </span><select name="e"  required><option></option><option>pharmacist</option><option>cashier</option><option>admin</option></select><br>
<span>Id Number </span><input type="text" style="width:265px; height:30px;" name="f" value="<?php echo $row['idno']; ?>" /><br>
<div style="float:right; margin-right:10px;">

<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save Changes</button>
</div>
</div>
</form>
<?php
}
?>