<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveemployee.php" method="post">
<center><h4><i class="icon-plus-sign icon-large"></i> Add employee</h4></center>
<hr>
<div id="ac">
<span> Full Name : </span><input type="text" style="width:265px; height:30px;" name="name" placeholder="Full Name" Required/><br>

<span>ID Number : </span><input type="text" style="width:265px; height:30px;" name="id" placeholder="ID Number"/><br>
<span>Qualifications : </span><input type="text" style="width:265px; height:30px;" name="qua" placeholder="Qualifications"/><br>

<span>Role </span><select type="text" style="width:265px; height:30px;" name="role"><option>cashier</option><option>admin</option></select><br>
<span>Gross Salary </span><input type="number" style="width:265px; height:30px;" name="sal" placeholder="Gross Salary"/><br>

<div style="float:right; margin-right:10px;">
<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save</button>
</div>
</div>
</form>